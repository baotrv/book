<?php
namespace Admin\Form;
use Admin\Model\PermissionTable;
use \Zend\Form\Form as Form;
class Permission extends Form {
	
	public function __construct(PermissionTable $permissionTable){
		parent::__construct();
		
		// FORM Attribute
		$this->setAttributes(array(
				'action'	=> '#',
				'method'	=> 'POST',
				'class'		=> 'form-horizontal',
				'role'		=> 'form',
				'name'		=> 'adminForm',
				'id'		=> 'adminForm',
				'style'		=> 'padding-top: 20px;',
				'enctype'	=> 'multipart/form-data'
		));
		
		// ID
		$this->add(array(
				'name' 			=> 'id',
				'attributes' 	=> array(
						'type'  => 'hidden',
				),
		));
		
		// Action
		$this->add(array(
				'name' 			=> 'action',
				'attributes' 	=> array(
						'type'  => 'hidden',
				),
		));
		
		// Name 
		$this->add(array(
				'name'			=> 'name_permission',
				'type'			=> 'Text',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'name_permission',
						'placeholder'	=> 'Enter name',
				),
				'options'		=> array(
						'label'				=> 'Name',
						'label_attributes'	=> array(
								'for'		=> 'name',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
		// Module
		$this->add(array(
				'name'			=> 'module_permission',
				'type'			=> 'Text',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'module_permission',
						'placeholder'	=> 'Enter module',
				),
				'options'		=> array(
						'label'				=> 'Module',
						'label_attributes'	=> array(
								'for'		=> 'module',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
		// Controller 
		$this->add(array(
				'name'			=> 'controller_permission',
				'type'			=> 'Text',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'controller_permission',
						'placeholder'	=> 'Enter controller',
				),
				'options'		=> array(
						'label'				=> 'Controller',
						'label_attributes'	=> array(
								'for'		=> 'controller',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
		// Action
		$this->add(array(
				'name'			=> 'action_permission',
				'type'			=> 'Text',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'action_permission',
						'placeholder'	=> 'Enter module',
				),
				'options'		=> array(
						'label'				=> 'Action',
						'label_attributes'	=> array(
								'for'		=> 'action',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
		
	}
	
	public function showMessage(){
		$messages = $this->getMessages();
		
		if(empty($messages)) return false;
		
		$xhtml = '<div class="callout callout-danger">';
		foreach($messages as $key => $msg){
			$xhtml .= sprintf('<p><b>%s:</b> %s</p>',ucfirst($key), current($msg));
		}
		$xhtml .= '</div>';
		return $xhtml;
	}
	
	
	
	
	
	
	
}