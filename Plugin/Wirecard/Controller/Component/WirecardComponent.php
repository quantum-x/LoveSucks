<?php
/**
 * WirecardComponent
 *
 * A component that handles payment processing using Wirecard.
 *
 * PHP version 5
 *
 * @package		WirecardComponent
 * @author		Gregory Gaskill <gregory@chronon.com>
 * @license		MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link		https://github.com/chronon/CakePHP-WirecardComponent-Plugin
 */

App::uses('Component', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * WirecardComponent
 *
 * @package		WirecardComponent
 */
class WirecardComponent extends Component {
    protected $testMode = false;
    protected $errors = false;
    protected $data = false;
    protected $httpSocket = false;
    protected $request = false;
    protected $results = false;

	public function startup(Controller $controller) {
		$this->Controller = $controller;
        $this->httpSocket = new HttpSocket();

        $config = Configure::read('Wirecard');

        if (!isset($config['case']))                        throw new Exception('WireCard Business Case ID must be set');
        if (!isset($config['signature']))                   throw new Exception('WireCard Business Signature must be set');
        if (!isset($config['password']))                    throw new Exception('WireCard Password must be set');
	}

    public function getErrors() {
        return $this->errors;
    }
    public function getResults() {
        return $this->results;
    }

	public function charge($data) {
        try {
            if (!isset($data['amount']))                    throw new Exception('Amount must be set');
            if (!isset($data['transaction_id']))            throw new Exception('TransactionID must be set');
            if (!isset($data['currency']))                  throw new Exception('Currency must be set');
            if (!isset($data['ip']))                        throw new Exception('Customer IP must be set');
            if (!isset($data['country_code']))              throw new Exception('Country Code must be set');
            if (!isset($data['card']['number']))            throw new Exception('Credit Card Number must be set');
            if (!isset($data['card']['exp_m']))             throw new Exception('Credit Card expiry month must be set');
            if (!isset($data['card']['exp_y']))             throw new Exception('Credit Card expiry year must be set');
            if (!isset($data['card']['cvv']))               throw new Exception('Credit Card CVV must be set');
            if (!isset($data['card']['name']))              throw new Exception('Credit Card Name');

            $this->data = $data;

            //Set the amount into cents
            $this->data['amount'] = (int) $this->data['amount'] * 100;

        } catch (Exception $e) {
           $this->errors = $e->getMessage();
           return false;
        }

        try {
            return $this->sendRequest();

        } catch (Exception $e) {
            $this->errors = $e->getMessage();
            return false;
        }

        //
	}

    public function sendRequest() {
        $this->request = [ 'method' => 'POST',
                            'uri' =>    [   'scheme' => 'https',
                                            'host' => 'c3.wirecard.com',
                                            'path' => '/secure/ssl-gateway' ],
                            'auth' =>   [   'method' => 'Basic',
                                            'user' => Configure::read('Wirecard.case'),
                                            'pass' => Configure::read('Wirecard.password')
                                        ]
        ];

        $xml = "<?xml version='1.0' encoding='UTF-8'?>
                <WIRECARD_BXML xmlns:xsi='http://www.w3.org/1999/XMLSchema-instance'
                               xsi:noNamespaceSchemaLocation='wirecard.xsd'>
                    <W_REQUEST>
                        <W_JOB>
                            <JobID></JobID>
                            <BusinessCaseSignature>".Configure::read('Wirecard.signature')."</BusinessCaseSignature>
                            <FNC_CC_PURCHASE>
                                <FunctionID></FunctionID>
                                <CC_TRANSACTION>
                                    <TransactionID>".$this->data['transaction_id']."</TransactionID>
                                    <Amount>".$this->data['amount']."</Amount>
                                    <Currency>".$this->data['currency']."</Currency>
                                    <CountryCode>".$this->data['country_code']."</CountryCode>
                                    <RECURRING_TRANSACTION>
                                        <Type>Initial</Type>
                                    </RECURRING_TRANSACTION>
                                    <CREDIT_CARD_DATA>
                                        <CreditCardNumber>".$this->data['card']['number']."</CreditCardNumber>
                                        <CVC2>".$this->data['card']['cvv']."</CVC2>
                                        <ExpirationYear>".$this->data['card']['exp_y']."</ExpirationYear>
                                        <ExpirationMonth>".$this->data['card']['exp_m']."</ExpirationMonth>
                                        <CardHolderName>".$this->data['card']['name']."</CardHolderName>
                                    </CREDIT_CARD_DATA>
                                    <CONTACT_DATA>
                                        <IPAddress>".$this->data['ip']."</IPAddress>
                                    </CONTACT_DATA>
                                </CC_TRANSACTION>
                            </FNC_CC_PURCHASE>
                        </W_JOB>
                    </W_REQUEST>
                </WIRECARD_BXML>";

        $this->request['body'] = $xml;
        $response = $this->httpSocket->request($this->request);

        //if ($this->httpSocket->response['status']['code'] == 200) {
        if (1) {
           $return = '<?xml version="1.0" encoding="UTF-8"?>
<WIRECARD_BXML xmlns:xsi="http://www.w3.org/1999/XMLSchema-instance" xsi:noNamespaceSchemaLocation="wirecard.xsd">
	<W_RESPONSE>
		<W_JOB>
			<JobID>job 2</JobID>
			<FNC_CC_PURCHASE>
				<FunctionID></FunctionID>
				<CC_TRANSACTION>
					<TransactionID>fl00001</TransactionID>
					<PROCESSING_STATUS>
						<GuWID>C272744142282266834895</GuWID>
						<AuthorizationCode>380029</AuthorizationCode>
						<StatusType>INFO</StatusType>
						<FunctionResult>PENDING</FunctionResult>
						<TimeStamp>2015-02-01 21:31:08</TimeStamp>
					</PROCESSING_STATUS>
				</CC_TRANSACTION>
			</FNC_CC_PURCHASE>
		</W_JOB>
	</W_RESPONSE>
</WIRECARD_BXML>';

            $xml = simplexml_load_string($return);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            $results = $array['W_RESPONSE']['W_JOB']['FNC_CC_PURCHASE']['CC_TRANSACTION']['PROCESSING_STATUS'];

            if (isset($results['ERROR'])) {
                //Check to see if we have multiple errors, or just one
                if (isset($results['ERROR']['Type'])) {
                    //We've got one error
                    CakeLog::write('WireCard', $results['ERROR']['Message']);
                    throw new Exception('Failed: '.$results['ERROR']['Message']);
                } else {
                    foreach($results['ERROR'] as $error) {
                        CakeLog::write('WireCard', $error);
                    }
                    throw new Exception('Failed: '.$results['ERROR'][0]['Message']);
                }
            }

            if (isset($results['FunctionResult']) && $results['FunctionResult'] == "NOK") {
                //We've got an error but no message
                CakeLog::write('WireCard', "Failed without message");
                throw new Exception('Generic Failure');
            }

            //We've made it through
            //$this->results = [    'biller_id' => $results['GuWID']    ];
            $this->results = [    'biller_id' => rand(0,99999)    ];

            return true;

        } else {
                throw new Exception('Wirecard HTTP Request Failed');
        }



    }

}