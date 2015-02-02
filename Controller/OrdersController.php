<?php
App::uses('AppController', 'Controller');

/**
 * Purchases Controller
 *
 * @property CardType $CardType
 * @property PaginatorComponent $Paginator
 */
class OrdersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator','Wirecard.Wirecard');

    public function beforeFilter() {
        $this->Security->blackHoleCallback = 'blackhole';

        parent::beforeFilter();
    }

    public function blackhole($type) {
        //var_dump($type);
    }

    public function view($_order_slug) {
        //Loads up an order via slug
        //Clean it up.
        $order_slug = preg_replace('`[^0-9a-zA-Z_-]`','', $_order_slug);
        if ($order_slug != $_order_slug) throw new NotFoundException('Order not found');

        $this->Order->recursive = -1;
        $this->Order->Behaviors->load('Containable');

        $options = array('conditions' => array('Order.slug' => $order_slug),
                         'contain' => array('Transaction','User','Size','Status', 'Video', 'Transaction' => ['Currency']));
        $order = $this->Order->find('first', $options);

        if ($order === false || empty($order)) {
            //404 die
            throw new NotFoundException('Order not found');
        } else {
            $this->set('order', $order);
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Order->saveAll( $this->request->data, array('validate' => 'only'))) {

                //We're going to determine the user's currency based on their location.
                //If they've got an EU locale, it's going to be EUR
                //If not, USD
                $this->loadModel('Currency');
                $this->loadModel('Status');
                $this->loadModel('User');
                $this->loadModel('Order');
                $this->loadModel('Transaction');
                $this->loadModel('Price');

                if ($this->_getCurrentLang() == "en_US") {
                    $currency = "USD";
                } else {
                    $currency = "EUR";
                }
                $currency_id = $this->Currency->find('first',['fields' => 'Currency.id', 'conditions' => ['currency' => $currency], 'recursive' => -1])['Currency']['id'];

                //Find the price for this size + currency
                $price = $this->Price->find('first',['fields' => 'Price.price', 'conditions' => ['currency_id' => $currency_id, 'size_id' => $this->request->data['Order']['size_id']], 'recursive' => -1])['Price']['price'];

                $data = [   'amount' => $price,
                            'transaction_id' => $this->createUniqueID(),
                            'currency' => $currency,
                            'currency_id' => $currency_id,
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'country_code' => 'US',
                            'card' => [ 'number' => $this->request->data['CreditCard']['card_number'],
                                        'exp_m' => sprintf('%02d',$this->request->data['CreditCard']['exp_m']),
                                        'exp_y' => $this->request->data['CreditCard']['exp_y'],
                                        'cvv' => $this->request->data['CreditCard']['cvv'],
                                        'name' => $this->request->data['User']['name']
                            ]
                ];

                //Prepare the generic variables
                $this->request->data['Order']['slug'] = $data['transaction_id'];
                $this->request->data['Transaction']['currency_id'] = $data['currency_id'];
                $this->request->data['Transaction']['amount'] = $data['amount'];

                if (!$this->Wirecard->charge($data)) {
                    $this->request->data['Transaction']['status_id'] = $this->Status->find('first',['fields' => 'Status.id', 'conditions' => ['status' => 'declined'], 'recursive' => -1])['Status']['id'];
                    $this->request->data['Transaction']['result'] = $this->Wirecard->getErrors();
                    $this->request->data['Order']['status_id'] = $this->Status->find('first',['fields' => 'Status.id', 'conditions' => ['status' => 'declined'], 'recursive' => -1])['Status']['id'];
                    $result = false;
                } else {
                    //We have success. This is nice.
                    //Build up the models and save the fucking things
                    $results = $this->Wirecard->getResults();

                    $this->request->data['Transaction']['biller_id'] = $results['biller_id'];
                    $this->request->data['Transaction']['status_id'] = $this->Status->find('first',['fields' => 'Status.id', 'conditions' => ['status' => 'completed'], 'recursive' => -1])['Status']['id'];
                    $this->request->data['Order']['status_id'] = $this->Status->find('first',['fields' => 'Status.id', 'conditions' => ['status' => 'ordered'], 'recursive' => -1])['Status']['id'];
                    $result = true;
                }

                //Check to see if we already have this user. If we do, we'll update their details
                $user_id = $this->User->find('first',['fields' => 'User.id', 'conditions' => ['email' => $this->request->data['User']['email']],
                                           'recursive' => -1])['User']['id'];
                if ($user_id !== false)    {
                    $this->request->data['User']['id'] = $user_id;
                }

                //Prepare to save everything
                unset($this->request->data['CreditCard']);
                if ($this->Order->saveAll( $this->request->data)) {
                    //$this->request->data['Order']['id'] = $this->Order->getInsertID();
                    //Send the email..
                    $Email = new CakeEmail('default');
                    $Email  ->template('order_invoice');
                    $Email  ->emailFormat('both');
                    $Email  ->to($this->request->data['User']['email']);
                    $Email  ->subject(__('FL: Your recent purchase'));
                    $Email  ->viewVars([
                                       'order' => $this->request->data,
                                       'offline_url' => Router::url(array('controller' => 'orders', 'action' => 'view', $this->request->data['Order']['slug']), true),
                                       'order_url' => Router::url(array('controller' => 'orders', 'action' => 'view', $this->request->data['Order']['slug']), true),
                                       'unsub_url' => Router::url(array('controller' => 'users', 'action' => 'unsubscribe', base64_encode($this->request->data['User']['email'])), true)
                                       ]);
                    $Email  ->send();

                    if ($result === true) {
                        return $this->redirect(
                            array('controller' => 'orders', 'action' => 'view', $this->request->data['Order']['slug'])
                        );
                    } else  {
                        $this->set('hasErrors',true);
                        $this->Session->setFlash(__('The order was declined. Please try again..'));
                    }
                } else {
                    CakeLog::write('Order', "Failed to save order models - order was: ".var_export($this->request->data));
                    if ($result === true) {
                        $this->Session->setFlash(__('Your order was successful, but we had a technical issue in updating the database. We will take care of it and keep you informed'));
                    } else  {
                        $this->set('hasErrors',true);
                        $this->Session->setFlash(__('The order was declined. Please try again..'));
                    }
                }

            } else {
                $this->set('hasErrors',true);
            }


/*            $this->Order->create();
            if ($this->Order->save($this->request->data)) {
                $this->Session->setFlash(__('The order has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The order could not be saved. Please, try again.'));
            }*/
        }
    }

    protected function createUniqueID() {
        return 'FL-'.$this->GetBase62(time().sprintf("%06d",rand(0,999999)));
    }
    protected function GetBase62($num) {
        $_characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($_characters); // 62
        $string = $_characters[$num % $base];

        if (strlen($num) >= 10)	$num	=	str_split($num,9); else $num[0] = $num;
        foreach ($num as $v)	while (($v = intval($v / $base)) > 0) $string = $_characters[$v % $base] . $string;
        return $string;
    }

}
