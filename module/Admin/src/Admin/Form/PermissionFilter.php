<?php
namespace Admin\Form;

use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;

use Zend\InputFilter\InputFilter;

class PermissionFilter extends InputFilter {
	
	public function __construct($options = null){
		
		$exclude = null;
		if(!empty($options['id'])){
			$exclude	= array(
					'field'	=> 'id',
					'value'	=> 	$options['id']	
			);
		}
		
		// Name
		$this->add(array(
				'name'		=> 'name_permission',
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
						array(
								'name'		=> 'DbNoRecordExists',
								'options'	=> array(
										'table'		=> TABLE_PERMISSION,
										'field'		=> 'name_permission',
										'adapter'	=> GlobalAdapterFeature::getStaticAdapter(),
										'exclude'	=> $exclude
								),
								'break_chain_on_failure'	=> true
						),
				)
		));
		
		// Module
		$this->add(array(
				'name'		=> 'module_permission',
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
// 						array(
// 								'name'		=> 'DbNoRecordExists',
// 								'options'	=> array(
// 										'table'		=> TABLE_PERMISSION,
// 										'field'		=> 'module_permission',
// 										'adapter'	=> GlobalAdapterFeature::getStaticAdapter(),
// 										'exclude'	=> $exclude
// 								),
// 								'break_chain_on_failure'	=> true
// 						),
				)
		));
		
		// Controller
		$this->add(array(
				'name'		=> 'controller_permission',
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
// 						array(
// 								'name'		=> 'DbNoRecordExists',
// 								'options'	=> array(
// 										'table'		=> TABLE_PERMISSION,
// 										'field'		=> 'controller_permission',
// 										'adapter'	=> GlobalAdapterFeature::getStaticAdapter(),
// 										'exclude'	=> $exclude
// 								),
// 								'break_chain_on_failure'	=> true
// 						),
				)
		));
		
		// Action
		$this->add(array(
				'name'		=> 'action_permission',
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
// 						array(
// 								'name'		=> 'DbNoRecordExists',
// 								'options'	=> array(
// 										'table'		=> TABLE_PERMISSION,
// 										'field'		=> 'action_permission',
// 										'adapter'	=> GlobalAdapterFeature::getStaticAdapter(),
// 										'exclude'	=> $exclude
// 								),
// 								'break_chain_on_failure'	=> true
// 						),
				)
		));
	}
}