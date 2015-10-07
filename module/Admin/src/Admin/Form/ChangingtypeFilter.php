<?php
namespace Admin\Form;

use Zend\InputFilter\InputFilter;

class ChangingtypeFilter extends InputFilter {
	
	public function __construct(){
		// Title
		$this->add(array(
				'name'		=> 'Name',
				'required'	=> true,
				'validators'	=> array(
						array(
								'name'		=> 'NotEmpty',
								'break_chain_on_failure'	=> true
						),
						array(
								'name'		=> 'StringLength',
								'options'	=> array('min' => 2, 'max' => 200),
								'break_chain_on_failure'	=> true
						),
				)
		));
		
		// Parentid
// 		$this->add(array(
// 				'name'		=> 'Parentid',
// 				'required'	=> false,
// 		));
		
	}
}