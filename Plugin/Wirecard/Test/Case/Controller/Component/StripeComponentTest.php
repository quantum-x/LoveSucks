<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('WirecardComponent', 'Wirecard.Controller/Component');

class TestPaymentController extends Controller {
	// hi
}

class WirecardComponentTest extends CakeTestCase {

	public $WirecardComponent = null;
	public $Controller = null;

	public function setUp() {
		if (!Configure::read('Wirecard.TestSecret')) {
			throw new CakeException('Wirecard.TestSecret must be set in APP/Config/bootstrap.php');
		}
		parent::setUp();
		$Collection = new ComponentCollection();
		$this->WirecardComponent = new WirecardComponent($Collection);
		$CakeRequest = new CakeRequest();
		$CakeResponse = new CakeResponse();
		$this->Controller = new TestPaymentController($CakeRequest, $CakeResponse);

		Configure::write('Wirecard.currency', null);
		Configure::write('Wirecard.fields', null);
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->WirecardComponent);
		unset($this->Controller);
	}

	public function testStartupDefaults() {
		$this->WirecardComponent->startup($this->Controller);

		$this->assertTrue(class_exists('Wirecard'));
		$this->assertEquals('usd', $this->WirecardComponent->currency);
		$this->assertEquals('Test', $this->WirecardComponent->mode);
		$expected = array('stripe_id' => 'id');
		$this->assertEquals($expected, $this->WirecardComponent->fields);
	}

	public function testStartupWithSettings() {
		Configure::write('Wirecard.mode', 'Live');
		Configure::write('Wirecard.currency', 'xxx');
		Configure::write('Wirecard.fields', array(
			'stripe_id' => 'id',
			'stripe_last4' => array('card' => 'last4'),
			'stripe_address_zip_check' => array('card' => 'address_zip_check'),
			'stripe_cvc_check' => array('card' => 'cvc_check'),
			'stripe_amount' => 'amount'
		));

		$this->WirecardComponent->startup($this->Controller);
		$this->assertTrue(class_exists('Wirecard'));
		$this->assertEquals('xxx', $this->WirecardComponent->currency);
		$this->assertEquals('Live', $this->WirecardComponent->mode);
		$expected = array(
			'stripe_id' => 'id',
			'stripe_last4' => array(
				'card' => 'last4'
			),
			'stripe_address_zip_check' => array(
				'card' => 'address_zip_check'
			),
			'stripe_cvc_check' => array(
				'card' => 'cvc_check'
			),
			'stripe_amount' => 'amount'
		);
		$this->assertEquals($expected, $this->WirecardComponent->fields);
	}

	/**
	 * @expectedException CakeException
	 * @expectedExceptionMessage Wirecard API key is not set.
	 */
	public function testStartupWithNoApiKey() {
		Configure::write('Wirecard.TestSecret', null);
		$this->WirecardComponent->startup($this->Controller);
	}

	/**
	 * @expectedException CakeException
	 * @expectedExceptionMessage The required stripeToken or stripeCustomer fields are missing.
	 */
	public function testChargeInvalidData() {
		$data = array();
		$this->WirecardComponent->charge($data);

		$data = array('amount' => 7, 'something' => 'wrong');
		$this->WirecardComponent->charge($data);
	}

	public function testChargeDefaults() {
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			'card' => array(
			'number' => '4242424242424242',
			'exp_month' => 12,
			'exp_year' => 2020,
			'cvc' => 777,
			'name' => 'Casi Robot',
			'address_zip' => '91361'
		)));
		$data = array('amount' => 7.45, 'stripeToken' => $token->id);
		$result = $this->WirecardComponent->charge($data);
		$this->assertRegExp('/^ch\_[a-zA-Z0-9]+/', $result['stripe_id']);

		$charge = Wirecard_Charge::retrieve($result['stripe_id']);
		$this->assertEquals($result['stripe_id'], $charge->id);
		$data['amount'] = $data['amount'] * 100;
		$this->assertEquals($data['amount'], $charge->amount);
	}

	public function testChargeLargeAmount() {
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			'card' => array(
			'number' => '4242424242424242',
			'exp_month' => 12,
			'exp_year' => 2020,
			'cvc' => 777,
			'name' => 'Large Amount',
			'address_zip' => '91361'
		)));
		$data = array('amount' => 1000, 'stripeToken' => $token->id);
		$result = $this->WirecardComponent->charge($data);
		$this->assertRegExp('/^ch\_[a-zA-Z0-9]+/', $result['stripe_id']);

		$charge = Wirecard_Charge::retrieve($result['stripe_id']);
		$this->assertEquals($result['stripe_id'], $charge->id);
		$data['amount'] = $data['amount'] * 100;
		$this->assertEquals($data['amount'], $charge->amount);
	}

	/**
	 * @expectedException CakeException
	 * @expectedExceptionMessage Amount is required and must be numeric.
	 */
	public function testChargeMissingAmount() {
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			'card' => array(
			'number' => '4242424242424242',
			'exp_month' => 12,
			'exp_year' => 2020,
			'cvc' => 777,
			'name' => 'Invalid Amount',
			'address_zip' => '91361'
		)));
		$data = array('stripeToken' => $token->id);
		$result = $this->WirecardComponent->charge($data);
	}

	/**
	 * @expectedException CakeException
	 * @expectedExceptionMessage Amount is required and must be numeric.
	 */
	public function testChargeInvalidAmount() {
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			'card' => array(
			'number' => '4242424242424242',
			'exp_month' => 12,
			'exp_year' => 2020,
			'cvc' => 777,
			'name' => 'Invalid Amount',
			'address_zip' => '91361'
		)));
		$data = array('amount' => 'casi', 'stripeToken' => $token->id);
		$result = $this->WirecardComponent->charge($data);
	}

	public function testChargeWithDescriptionAndFields() {
		Configure::write('Wirecard.fields', array(
			'stripe_id' => 'id',
			'stripe_last4' => array('card' => 'last4'),
			'stripe_cvc_check' => array('card' => 'cvc_check'),
			'stripe_amount' => 'amount'
		));

		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			"card" => array(
			"number" => "4242424242424242",
			"exp_month" => 12,
			"exp_year" => 2020,
			"cvc" => 777
		)));
		$data = array(
			'amount' => 5.45,
			'stripeToken' => $token->id,
			'description' => 'Casi Robot - casi@robot.com'
		);

		$result = $this->WirecardComponent->charge($data);
		$this->assertRegExp('/^ch\_[a-zA-Z0-9]+/', $result['stripe_id']);

		$charge = Wirecard_Charge::retrieve($result['stripe_id']);

		$data['amount'] = $data['amount'] * 100;
		$this->assertEquals($data['amount'], $charge->amount);

		$this->assertEquals($result['stripe_id'], $charge->id);
		$this->assertEquals($result['stripe_last4'], $charge->card->last4);
		$this->assertEquals($result['stripe_cvc_check'], $charge->card->cvc_check);
	}

	public function testChargeWithInvalidFields() {
		Configure::write('Wirecard.fields', array(
			'beer_list_1' => 'hops',
			'stripe_last4' => array('card' => 'casi'),
			'stripe_cvc_check' => array('card' => 'robot'),
			'beer_list_2' => 'malts'
		));

		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			"card" => array(
			"number" => "4242424242424242",
			"exp_month" => 12,
			"exp_year" => 2020,
			"cvc" => 777
		)));
		$data = array(
			'amount' => 5.45,
			'stripeToken' => $token->id,
			'description' => 'Casi Robot - casi@robot.com'
		);

		$result = $this->WirecardComponent->charge($data);
		$this->assertRegExp('/^ch\_[a-zA-Z0-9]+/', $result['stripe_id']);

		$charge = Wirecard_Charge::retrieve($result['stripe_id']);

		$data['amount'] = $data['amount'] * 100;
		$this->assertEquals($data['amount'], $charge->amount);

		$this->assertEquals($result['stripe_id'], $charge->id);
		$this->assertArrayNotHasKey('beer_list_1', $result);
		$this->assertArrayNotHasKey('stripe_last4', $result);
		$this->assertArrayNotHasKey('stripe_cvc_check', $result);
		$this->assertArrayNotHasKey('beer_list_2', $result);
	}

	public function testChargeCardError() {
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			"card" => array(
			"number" => "4000000000000002",
			"exp_month" => 12,
			"exp_year" => 2020,
			"cvc" => 777
		)));
		$data = array('amount' => 1.77, 'stripeToken' => $token->id);
		$result = $this->WirecardComponent->charge($data);
		$this->assertInternalType('string', $result);
		$this->assertEquals('Your card was declined.', $result);
	}

	public function testChargeInvalidRequestError() {
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$data = array('amount' => 2.77, 'stripeToken' => 'tok_0MzJoNA8ZPrspx');
		$result = $this->WirecardComponent->charge($data);
		$this->assertInternalType('string', $result);
		$this->assertContains('Invalid token id:', $result);
	}


	/**
	 * @expectedException STRIPE_AUTHENTICATIONERROR
	 * @expectedExceptionMessage Invalid API Key provided
	 */
	public function testChargeAuthError() {
		Configure::write('Wirecard.TestSecret', '123456789');
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			"card" => array(
			"number" => "4242424242424242",
			"exp_month" => 12,
			"exp_year" => 2020,
			"cvc" => 777
		)));
		$data = array('amount' => 3.77, 'stripeToken' => $token->id);
		$result = $this->WirecardComponent->charge($data);
	}

	public function testCreateCustomerInvalidToken() {
		$this->WirecardComponent->startup($this->Controller);
		$data = array('stripeToken' => '12345');
		$result = $this->WirecardComponent->customerCreate($data);
		$this->assertContains('Invalid token id:', $result);
	}

	public function testCreateCustomer() {
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			'card' => array(
			'number' => '4242424242424242',
			'exp_month' => 12,
			'exp_year' => 2020,
			'cvc' => 777,
			'name' => 'Casi Robot',
			'address_zip' => '91361'
		)));
		$data = array(
			'stripeToken' => $token->id,
			'description' => 'casi@robot.com'
		);
		$result = $this->WirecardComponent->customerCreate($data);
		$this->assertRegExp('/^cus\_[a-zA-Z0-9]+/', $result['stripe_id']);

		$customer = Wirecard_Customer::retrieve($result['stripe_id']);
		$this->assertEquals($result['stripe_id'], $customer->id);
		$customer->delete();
	}

	public function testCreateCustomerWithFields() {
		Configure::write('Wirecard.fields', array(
			'customer_id' => 'id',
			'description' => 'description',
			'customer_email' => 'email',
			'another' => 'field',
			'something' => 'notusedhere'
		));
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			'card' => array(
			'number' => '4242424242424242',
			'exp_month' => 12,
			'exp_year' => 2020,
			'cvc' => 777,
			'name' => 'Casi Robot',
			'address_zip' => '91361'
		)));
		$data = array(
			'stripeToken' => $token->id,
			'description' => 'A Test!',
			'email' => 'casi@robot.com'
		);
		$result = $this->WirecardComponent->customerCreate($data);
		$this->assertRegExp('/^cus\_[a-zA-Z0-9]+/', $result['customer_id']);

		$customer = Wirecard_Customer::retrieve($result['customer_id']);
		$this->assertEquals($result['customer_id'], $customer->id);
		$this->assertEquals($result['description'], $customer->description);
		$this->assertEquals($result['customer_email'], $customer->email);
		$customer->delete();
	}

	public function testCreateCustomerWithInvalidFields() {
		Configure::write('Wirecard.fields', array(
			'another' => 'field',
			'something' => 'notusedhere'
		));
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			'card' => array(
			'number' => '4242424242424242',
			'exp_month' => 12,
			'exp_year' => 2020,
			'cvc' => 777,
			'name' => 'Casi Robot',
			'address_zip' => '91361'
		)));
		$data = array(
			'stripeToken' => $token->id,
			'description' => 'A Test!',
			'email' => 'casi@robot.com'
		);
		$result = $this->WirecardComponent->customerCreate($data);
		$this->assertRegExp('/^cus\_[a-zA-Z0-9]+/', $result['stripe_id']);

		$customer = Wirecard_Customer::retrieve($result['stripe_id']);
		$this->assertEquals($result['stripe_id'], $customer->id);
		$this->assertArrayNotHasKey('another', $result);
		$this->assertArrayNotHasKey('something', $result);
		$customer->delete();
	}

	public function testCreateCustomerAndCharge() {
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			'card' => array(
			'number' => '4242424242424242',
			'exp_month' => 12,
			'exp_year' => 2020,
			'cvc' => 777,
			'name' => 'Casi Robot',
			'address_zip' => '91361'
		)));
		$data = array(
			'stripeToken' => $token->id,
			'description' => 'Create Customer & Charge',
			'email' => 'casi@robot.com',
		);
		$result = $this->WirecardComponent->customerCreate($data);
		$this->assertRegExp('/^cus\_[a-zA-Z0-9]+/', $result['stripe_id']);

		$customer = Wirecard_Customer::retrieve($result['stripe_id']);
		$this->assertEquals($result['stripe_id'], $customer->id);

		$chargeData = array(
			'amount' => '14.69',
			'stripeCustomer' => $customer->id
		);
		$charge = $this->WirecardComponent->charge($chargeData);
		$this->assertRegExp('/^ch\_[a-zA-Z0-9]+/', $charge['stripe_id']);

		$charge = Wirecard_Charge::retrieve($charge['stripe_id']);

		$chargeData['amount'] = $chargeData['amount'] * 100;
		$this->assertEquals($chargeData['amount'], $charge->amount);

		$customer->delete();
	}

	public function testCreateCustomerAndSubscribeToPlan() {
		$this->WirecardComponent->startup($this->Controller);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));

		// create a plan for this test
		Wirecard_Plan::create(array(
			'amount' => 2000,
			'interval' => "month",
			'name' => "Test Plan",
			'currency' => 'usd',
			'id' => 'testplan')
		);

		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));
		$token = Wirecard_Token::create(array(
			'card' => array(
			'number' => '4242424242424242',
			'exp_month' => 12,
			'exp_year' => 2020,
			'cvc' => 777,
			'name' => 'Casi Robot',
			'address_zip' => '91361'
		)));
		$data = array(
			'stripeToken' => $token->id,
			'plan' => 'testplan',
			'description' => 'Create Customer & Subscribe to Plan',
			'email' => 'casi@robot.com',
		);
		$result = $this->WirecardComponent->customerCreate($data);
		$this->assertRegExp('/^cus\_[a-zA-Z0-9]+/', $result['stripe_id']);

		$customer = Wirecard_Customer::retrieve($result['stripe_id']);
		$this->assertEquals($result['stripe_id'], $customer->id);
		$this->assertEquals($data['plan'], $customer->subscription->plan->id);

		// delete the plan
		$plan = Wirecard_Plan::retrieve('testplan');
		$plan->delete();

		$customer->delete();
	}

	public function testCustomerRetrieveAndUpdate() {
		$this->WirecardComponent->startup($this->Controller);
		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));

		$token = Wirecard_Token::create(array(
			'card' => array(
			'number' => '4242424242424242',
			'exp_month' => 12,
			'exp_year' => 2020,
			'cvc' => 777,
			'name' => 'Casi Robot',
			'address_zip' => '91361'
		)));
		$data = array(
			'stripeToken' => $token->id,
			'description' => 'Original Description',
			'email' => 'casi@robot.com',
		);
		$result = $this->WirecardComponent->customerCreate($data);
		$this->assertRegExp('/^cus\_[a-zA-Z0-9]+/', $result['stripe_id']);

		$customer = $this->WirecardComponent->customerRetrieve($result['stripe_id']);
		$this->assertEquals($result['stripe_id'], $customer->id);

		$customer->description = 'An updated description';
		$customer->save();

		$customer = $this->WirecardComponent->customerRetrieve($result['stripe_id']);
		$this->assertEquals('An updated description', $customer->description);

		$customer->delete();
	}

	public function testCustomerRetrieveNotFound() {
		$this->WirecardComponent->startup($this->Controller);
		Wirecard::setApiKey(Configure::read('Wirecard.TestSecret'));

		$customer = $this->WirecardComponent->customerRetrieve('invalid');
		$this->assertFalse($customer);
	}

}
