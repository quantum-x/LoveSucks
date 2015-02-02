<?php
App::uses('AppModel', 'Model');
/**
 * CreditCard Model
 *
 */
class CreditCard extends AppModel {
    public $useTable = false;

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'card_number' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'A credit card number is required',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'validCC' => array(
                'rule' => array('cc','fast',true),
                'message' => 'The credit card number you supplied was invalid.'
            )
		),
		'cvv' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'CVV is required',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'validCVV' => array(
                'rule' => array('custom', '/[0-9]{3,4}/'),
                'message' => 'A valid CVV is required'
            )
		),
		'exp_m' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Expiry Month is required',
				'allowEmpty' => false,
				'required' => true,
			),
            'between'=>array(
                'rule'=>array('between', 1, 12),
                'message'=>'Expiry Month is invalid'
            ),
        ),
		'exp_y' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Expiry Year is required',
				'allowEmpty' => false,
				'required' => true,
			),
            'isCurrent' => array(
                'rule'    => array('isCurrentCard'),
                'message' => 'Credit Card has expired'
            )
		)
    );

    public function isCurrentCard($field=array()) {
        //Check to see if a CC has a valid date
        if ($this->data['CreditCard']['exp_y'] < date('Y')) return false;
        if ($this->data['CreditCard']['exp_y'] == date('Y') && $this->data['CreditCard']['exp_m'] < date('m')) return false;
        return true;
    }

}
