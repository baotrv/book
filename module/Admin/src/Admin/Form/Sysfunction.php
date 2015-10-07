<?php
namespace Admin\Form;
use \Zend\Form\Form as Form;
use Admin\Model\SysfunctionTable;

class Sysfunction extends Form {
	
	public function __construct(SysfunctionTable $sysfunctionTable){
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
				'name'			=> 'name',
				'type'			=> 'Text',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'name',
						'placeholder'	=> 'Nhập tên chức năng',
				),
				'options'		=> array(
						'label'				=> 'Tên chức năng',
						'label_attributes'	=> array(
								'for'		=> 'name',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
		// url
		$this->add(array(
				'name'			=> 'url',
				'type'			=> 'Text',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'url',
						'placeholder'	=> 'Nhập link',
				),
				'options'		=> array(
						'label'				=> 'Link',
						'label_attributes'	=> array(
								'for'		=> 'url',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
		// menu
		$this->add(array(
				'name'			=> 'menu',
				'type'			=> 'Checkbox',
				'options'		=> array(
						'label'				=> 'Ẩn hiện',
						'label_attributes'	=> array(
								'for'		=> 'menu',
								'class'		=> 'col-xs-3 control-label',
						),
						'use_hidden_element'=> true,
						'checked_value' 	=> 'active',
						'unchecked_value' 	=> 'inactive',
							
				),
				'attributes'	=> array(
						'value' 			=> 'inactive',
						'class'				=> 'form-control',
				),
		));
		
		// show
		$this->add(array(
				'name'			=> 'show',
				'type'			=> 'Checkbox',
				'options'		=> array(
						'label'				=> 'Ẩn hiện',
						'label_attributes'	=> array(
								'for'		=> 'show',
								'class'		=> 'col-xs-3 control-label',
						),
						'use_hidden_element'=> true,
						'checked_value' 	=> 'active',
						'unchecked_value' 	=> 'inactive',
							
				),
				'attributes'	=> array(
						'value' 			=> 'inactive',
						'class'				=> 'form-control',
				),
		));
		
		// href
		$this->add(array(
				'name'			=> 'href',
				'type'			=> 'Text',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'href',
						'placeholder'	=> 'Nhập tên hiển thị',
				),
				'options'		=> array(
						'label'				=> 'Tên hiển thị',
						'label_attributes'	=> array(
								'for'		=> 'href',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
		// Parent
		$this->add(array(
				'name'			=> 'parent',
				'type'			=> 'Select',
				'options'		=> array(
						'empty_option'	=> '-- Chọn cấp cha --',
						'value_options'	=> $sysfunctionTable->itemInSelectbox(null, array('task' => 'form-sysfunction')),
						'label'	=> 'Menu cấp cha',
						'label_attributes'	=> array(
								'for'		=> 'parent',
								'class'		=> 'col-xs-3 control-label',
						),
				),
				'attributes'	=> array(
						'class'			=> 'form-control',
				),
		));
		
		// Status			
		$this->add(array(
					'name'			=> 'status',
					'type'			=> 'Checkbox',
					'options'		=> array(
									'label'				=> 'Kích hoạt',
									'label_attributes'	=> array(
											'for'		=> 'status',
											'class'		=> 'col-xs-3 control-label',
									),
									'use_hidden_element'=> true,
									'checked_value' 	=> 'active',
									'unchecked_value' 	=> 'inactive',							
							
					),
					'attributes'	=> array(
									'value' 			=> 'inactive',
									'class'				=> 'form-control',
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