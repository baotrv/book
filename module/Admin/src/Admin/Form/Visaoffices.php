<?php
namespace Admin\Form;
use \Zend\Form\Form as Form;
use Admin\Model\VisaofficesTable;
class Visaoffices extends Form {
	
	public function __construct(VisaofficesTable $visaofficesTable){
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
		));
		
		// ID
		$this->add(array(
				'name' 			=> 'Id',
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
		
		// Code
		$this->add(array(
				'name'			=> 'Code',
				'type'			=> 'Text',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'Code',
						'placeholder'	=> 'Nhập Mã',
				),
				'options'		=> array(
						'label'				=> 'Mã',
						'label_attributes'	=> array(
								'for'		=> 'Code',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
		// Name 
		$this->add(array(
				'name'			=> 'Name',
				'type'			=> 'Text',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'Name',
						'placeholder'	=> 'Nhập tên',
				),
				'options'		=> array(
						'label'				=> 'Tên',
						'label_attributes'	=> array(
								'for'		=> 'Name',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
		// Description
		$this->add(array(
				'name'			=> 'Desription',
				'type'			=> 'Textarea',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'Desription',
				),
				'options'		=> array(
						'label'				=> 'Miêu tả',
						'label_attributes'	=> array(
								'for'		=> 'Desription',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
// 		// Parent
// 		$this->add(array(
// 				'name'			=> 'parent_by_id',
// 				'type'			=> 'Select',
// 				'options'		=> array(
// 						'empty_option'	=> '-- Chọn --',
// 						'value_options'	=> $provinceTable->itemInSelectbox(),
// 						'label'	=> 'Cấp cha',
// 						'label_attributes'	=> array(
// 								'for'		=> 'parent_by_id',
// 								'class'		=> 'col-xs-3 control-label',
// 						),
// 				),
// 				'attributes'	=> array(
// 						'class'			=> 'form-control',
// 				),
// 		));
		
		// Sort
		$this->add(array(
				'name'			=> 'Sort',
				'type'			=> 'Text',
				'attributes'	=> array(
						'class'			=> 'form-control',
						'id'			=> 'Sort',
						'placeholder'	=> 'Nhập xắp sếp',
				),
				'options'		=> array(
						'label'				=> 'Xắp sếp',
						'label_attributes'	=> array(
								'for'		=> 'Sort',
								'class'		=> 'col-xs-3 control-label',
						)
				),
		));
		
// 		// Address
// 		$this->add(array(
// 				'name'			=> 'Address',
// 				'type'			=> 'Text',
// 				'attributes'	=> array(
// 						'class'			=> 'form-control',
// 						'id'			=> 'Address',
// 						'placeholder'	=> 'Nhập địa chỉ',
// 				),
// 				'options'		=> array(
// 						'label'				=> 'Địa chỉ',
// 						'label_attributes'	=> array(
// 								'for'		=> 'Address',
// 								'class'		=> 'col-xs-3 control-label',
// 						)
// 				),
// 		));
		
// 		// Phone
// 		$this->add(array(
// 				'name'			=> 'Phone',
// 				'type'			=> 'Text',
// 				'attributes'	=> array(
// 						'class'			=> 'form-control',
// 						'id'			=> 'Phone',
// 						'placeholder'	=> 'Nhập điện thoại',
// 				),
// 				'options'		=> array(
// 						'label'				=> 'Điện thoại',
// 						'label_attributes'	=> array(
// 								'for'		=> 'Phone',
// 								'class'		=> 'col-xs-3 control-label',
// 						)
// 				),
// 		));
		
// 		// Fax
// 		$this->add(array(
// 				'name'			=> 'Fax',
// 				'type'			=> 'Text',
// 				'attributes'	=> array(
// 						'class'			=> 'form-control',
// 						'id'			=> 'Fax',
// 						'placeholder'	=> 'Nhập Fax',
// 				),
// 				'options'		=> array(
// 						'label'				=> 'Fax',
// 						'label_attributes'	=> array(
// 								'for'		=> 'Fax',
// 								'class'		=> 'col-xs-3 control-label',
// 						)
// 				),
// 		));
		
// 		// Email
// 		$this->add(array(
// 				'name'			=> 'Email',
// 				'type'			=> 'Text',
// 				'attributes'	=> array(
// 						'class'			=> 'form-control',
// 						'id'			=> 'Email',
// 						'placeholder'	=> 'Nhập Email',
// 				),
// 				'options'		=> array(
// 						'label'				=> 'Email',
// 						'label_attributes'	=> array(
// 								'for'		=> 'Email',
// 								'class'		=> 'col-xs-3 control-label',
// 						)
// 				),
// 		));
		
// 		// Website
// 		$this->add(array(
// 				'name'			=> 'Website',
// 				'type'			=> 'Text',
// 				'attributes'	=> array(
// 						'class'			=> 'form-control',
// 						'id'			=> 'Website',
// 						'placeholder'	=> 'Nhập Website',
// 				),
// 				'options'		=> array(
// 						'label'				=> 'Website',
// 						'label_attributes'	=> array(
// 								'for'		=> 'Website',
// 								'class'		=> 'col-xs-3 control-label',
// 						)
// 				),
// 		));
		
// 		// Ngaytrahoso
// 		$this->add(array(
// 				'name'			=> 'Ngaytrahoso',
// 				'type'			=> 'Text',
// 				'attributes'	=> array(
// 						'class'			=> 'form-control',
// 						'id'			=> 'Ngaytrahoso',
// 						'placeholder'	=> 'Nhập Ngày',
// 				),
// 				'options'		=> array(
// 						'label'				=> 'Ngày trả hồ sơ',
// 						'label_attributes'	=> array(
// 								'for'		=> 'Ngaytrahoso',
// 								'class'		=> 'col-xs-3 control-label',
// 						)
// 				),
// 		));
		
// 		// Biennhan
// 		$this->add(array(
// 				'name'			=> 'Biennhan',
// 				'type'			=> 'Text',
// 				'attributes'	=> array(
// 						'class'			=> 'form-control',
// 						'id'			=> 'Biennhan',
// 						'placeholder'	=> 'Nhập biên nhận',
// 				),
// 				'options'		=> array(
// 						'label'				=> 'Biên nhận',
// 						'label_attributes'	=> array(
// 								'for'		=> 'Biennhan',
// 								'class'		=> 'col-xs-3 control-label',
// 						)
// 				),
// 		));
		
// 		// Gionhan
// 		$this->add(array(
// 				'name'			=> 'Gionhan',
// 				'type'			=> 'Text',
// 				'attributes'	=> array(
// 						'class'			=> 'form-control',
// 						'id'			=> 'Gionhan',
// 						'placeholder'	=> 'Nhập giờ nhận',
// 				),
// 				'options'		=> array(
// 						'label'				=> 'Giờ nhận',
// 						'label_attributes'	=> array(
// 								'for'		=> 'Gionhan',
// 								'class'		=> 'col-xs-3 control-label',
// 						)
// 				),
// 		));
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