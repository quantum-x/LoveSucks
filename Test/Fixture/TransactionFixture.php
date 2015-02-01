<?php
/**
 * TransactionFixture
 *
 */
class TransactionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'order_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'unique'),
		'amount' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'currency_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => false),
		'status_id' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 2, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'UNIQUE' => array('column' => 'order_id', 'unique' => 1),
			'Indexes' => array('column' => array('order_id', 'amount', 'currency_id', 'status_id'), 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'order_id' => 1,
			'amount' => '',
			'currency_id' => 1,
			'status_id' => 1,
			'created' => '2015-01-10 20:35:37',
			'modified' => '2015-01-10 20:35:37'
		),
	);

}
