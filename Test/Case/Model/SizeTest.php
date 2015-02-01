<?php
App::uses('Size', 'Model');

/**
 * Size Test Case
 *
 */
class SizeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.size',
		'app.order',
		'app.user',
		'app.status',
		'app.transaction',
		'app.video'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Size = ClassRegistry::init('Size');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Size);

		parent::tearDown();
	}

}
