<?php
/**
 * CurrencyFixture
 *
 */
class CurrencyFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'currency' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'symbol' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 3, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'CURR' => array('column' => 'currency', 'unique' => 0),
			'SYM' => array('column' => 'symbol', 'unique' => 0)
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
			'currency' => 'Lorem ip',
			'symbol' => 'L'
		),
	);

}
