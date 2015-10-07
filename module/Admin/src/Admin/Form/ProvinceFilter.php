<?php
namespace Admin\Form;

use Zend\InputFilter\InputFilter;

class ProvinceFilter extends InputFilter {
	
	public function __construct(){
		// Title
		$this->add(array(
				'name'		=> 'Title',
				'required'	=> true,
				'validators'	=> array(
						array(
								'name'		=> 'NotEmpty',
								'break_chain_on_failure'	=> true
						),
						array(
								'name'		=> 'StringLength',
								'options'	=> array('min' => 4, 'max' => 200),
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