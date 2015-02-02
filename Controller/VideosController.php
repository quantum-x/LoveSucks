<?php
App::uses('AppController', 'Controller');

/**
 * Purchases Controller
 *
 * @property CardType $CardType
 * @property PaginatorComponent $Paginator
 */
class VideosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public $helpers = array('Cache');
    public $cacheAction = array(
        'view' => "+5 days",
    );

    public function view($_order_slug) {
        //Loads up an order via slug
        //Clean it up.
        $order_slug = preg_replace('`[^0-9a-zA-Z_-]`','', $_order_slug);
        if ($order_slug != $_order_slug) throw new NotFoundException('Video not found');
        $this->loadModel('Order');
        $this->Order->recursive = -1;
        $this->Order->Behaviors->load('Containable');

        $options = array('conditions' => array('Order.slug' => $order_slug),
                         'contain' => array('Transaction','User','Size','Status', 'Video', 'Transaction' => ['Currency']));
        $order = $this->Order->find('first', $options);

        if ($order === false || empty($order)) {
            //404 die
            throw new NotFoundException('Video not found');
        } else {
            //Anonymize the name
            $first_name = explode(' ',$order['User']['name']);
            $first_name = reset($first_name);
            //$order['User']['name'] = str_pad(strtoupper($first_name[0]),strlen($first_name),'*');
            $order['User']['name'] = ucfirst($first_name);
            $this->set('video', $order);
        }
    }

}
