<?php
namespace Admin\Controller;

use Zendvn\Controller\ActionController;
use Zend\Form\FormInterface;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

use Zendvn\Paginator\Paginator as ZendvnPaginator;

class StaffController extends ActionController
{
	public function init(){
		// SESSION FILTER
		$ssFilter	= new Container(__CLASS__);
		$this->_params['ssFilter']['order_by']				= !empty($ssFilter->order_by) ? $ssFilter->order_by : 'Sort';
		$this->_params['ssFilter']['order']					= !empty($ssFilter->order) ? $ssFilter->order : 'ASC';
		$this->_params['ssFilter']['filter_status']			= $ssFilter->filter_status;
		$this->_params['ssFilter']['filter_group_acp']		= $ssFilter->filter_group_acp;
		$this->_params['ssFilter']['filter_keyword_type']	= $ssFilter->filter_keyword_type;
		$this->_params['ssFilter']['filter_keyword_value']	= $ssFilter->filter_keyword_value;
		$this->_params['ssFilter']['filter_count_perpage']	= !empty($ssFilter->filter_count_perpage) ? $ssFilter->filter_count_perpage : '5';
		
		// PARENTID FILTER 
		$this->_params['ssFilter']['parent_id']				= $this->params()->fromRoute('id',0);
		$this->_params['ssFilter']['parent_by_id']			= $this->params()->fromRoute('parent',0);
		// PAGINATOR
		/* $this->_paginator['itemCountPerPage'] số bản ghi trên trang
		 * $this->_paginator['pageRange'] số trang hiển thị
		 * $this->_paginator['currentPageNumber'] trang hiện tại
		 */
		$this->_paginator['itemCountPerPage']	= (int)$this->_params['ssFilter']['filter_count_perpage'];
		$this->_paginator['pageRange']			= 5;
		$this->_paginator['currentPageNumber']	= $this->params()->fromRoute('page',1);
		$this->_params['paginator']				= $this->_paginator;
		
		// OPTIONS
		
		$this->_options['tableName']	= 'Admin\Model\StaffTable';
		$this->_options['formName']		= 'formAdminStaff';

		// DATA
		$this->_params['data']	= $this->getRequest()->getPost()->toArray();
	}
	
    public function indexAction()
    {
    	$total		= $this->getTable()->countItem($this->_params, array('task' => 'list-item'));
    	$items		= $this->getTable()->listItem($this->_params, array('task' => 'list-item'));
    	$parentById	= $this->getServiceLocator()->get('Admin\Model\StaffTable')->parentById($this->_params['ssFilter'],null);
    	$slbParent	= $this->getServiceLocator()->get('Admin\Model\StaffTable')->itemInSelectbox($this->_params['ssFilter'],null);
    	return new ViewModel(array(
    			'items'			=>	$items,
    			'paginator' 	=> ZendvnPaginator::createPaginator($total, $this->_params['paginator']),
    			'ssFilter'		=> $this->_params['ssFilter'],
    			'parentbyid'	=> $parentById,
    			'slbParent'		=> $slbParent,
    	));
    }
    
    public function filterAction()
    {
    	if($this->getRequest()->isPost()){
    		//CREATE OBJECT SESSION
    		$ssFilter		= new Container(__CLASS__);
    		//CREATE OBJECT DATA
    		$data			= $this->_params['data'];
    		$ssFilter->order_by				= $data['order_by'];
    		$ssFilter->order				= $data['order'];
    		$ssFilter->filter_status		= $data['filter_status'];
    		$ssFilter->filter_group_acp		= $data['filter_group_acp'];
    		$ssFilter->filter_keyword_type	= $data['filter_keyword_type'];
    		$ssFilter->filter_keyword_value	= $data['filter_keyword_value'];
    		$ssFilter->filter_count_perpage	= $data['filter_count_perpage'];
			// $ssFilter->parent_id			= $this->request['id'];
    		
    		//BUTTON CLEAR
    		$btnClear						= $data['btn-clear'];    		
    		if($btnClear == 'btn-clear'){
    			$ssFilter->offsetUnset('filter_keyword_type');
    			$ssFilter->offsetUnset('filter_keyword_value');
    		}
    	}
    	//REDIRECT BY TOROUTE
    	$this->goAction();
    }
    
    public function statusAction()
    {
    	if($this->getRequest()->isPost()){
    		$flagAction = $this->getTable()->changeStatus($this->_params['data'], array('task' => 'change-status'));
    		if($flagAction == true) $this->flashMessenger()->addMessage('Trạng thái của phần tử đã được cập nhật thành công!');
    	}
    	//REDIRECT BY TOROUTE
    	$this->goAction();
    }
    
    public function groupAcpAction()
    {
    	if($this->getRequest()->isPost()){
    		$flagAction = $this->getTable()->changeStatus($this->_params['data'], array('task' => 'change-group-acp'));
    		if($flagAction == true) $this->flashMessenger()->addMessage('Group ACP của phần tử đã được cập nhật thành công!');
    	}
    	//REDIRECT BY TOROUTE
    	$this->goAction();
    }
    
    public function multiStatusAction()
    {
    	$message	= 'Vui lòng chọn vào phần tử mà bạn muốn thay đổi trạng thái!';
    	if($this->getRequest()->isPost()){
    		$flagAction = $this->getTable()->changeStatus($this->_params['data'], array('task' => 'change-multi-status'));
    		if($flagAction == true) $message	= 'Trạng thái của phần tử đã được cập nhật thành công!';
    	}
    	$this->flashMessenger()->addMessage($message);
    	//REDIRECT BY TOROUTE
    	$this->goAction();
    }
    
    public function orderingAction()
    {
    	$message	= 'Vui lòng chọn vào phần tử mà bạn muốn thay đổi thứ tự sắp xếp!';
    	if($this->getRequest()->isPost()){
    		$flagAction = $this->getTable()->ordering($this->_params['data']);
    		if($flagAction == true) $message	= 'Thứ tự sắp xếp phần tử đã được cập nhật thành công!';
    	}
    	$this->flashMessenger()->addMessage($message);
    	//REDIRECT BY TOROUTE
    	$this->goAction();
    }
    
    public function deleteAction()
    {
    	$message	= 'Vui lòng chọn vào phần tử mà bạn muốn xóa!';
    	if($this->getRequest()->isPost()){
    		$flagAction = $this->getTable()->deleteItem($this->_params['data'], array('task' => 'multi-delete'));
    		if($flagAction == true) $message	= 'Các phần tử đã được xóa thành công!';    		
    	}else{
    		$flagAction = $this->getTable()->deleteItem($this->_params['ssFilter'], array('task' => 'one-delete'));
    		if($flagAction == true) $message	= 'phần tử đã được xóa thành công!';
    	}
    	$this->flashMessenger()->addMessage($message);
    	//REDIRECT BY TOROUTE
		$this->goAction();
    }
    
    public function formAction()
    {
    	$myForm		= $this->getForm();
    	$task		= 'add-item';
    	$this->_params['data']['Id']			= !empty($this->params('id'))?$this->params('id'):0;
    	$this->_params['data']['parent_by_id']	= $this->params('parent');
    	if(!empty($this->_params['data']['Id'])) {
    		//CREATE OBJECT ITEM DATA
    		$item	= $this->getTable()->getItem($this->_params['data']);
    		if(!empty($item)){
    			//BIND DATA FROM FORM
    			$myForm->bind($item);
    			$task	= 'edit-item';
    		}
    	}
    	
    	if($this->getRequest()->isPost()){
    		//GET ACTION FROM OBJECT DATA
    		$action	= $this->_params['data']['action'];
    		//SET DATA BY FORM
    		$myForm->setData($this->_params['data']);
    		if($myForm->isValid()){
    			//GET DATA FROM FORM
    			$this->_params['data']		= $myForm->getData(FormInterface::VALUES_AS_ARRAY);
    			//SAVE DATA RETURN $ID
    			$id	= $this->getTable()->saveItem($this->_params, array('task' => $task));
    			$this->flashMessenger()->addMessage('Dữ liệu đã được lưu thành công!');
    			//GET PARENTID FROM OBJECT SSFILTER
    			$parentById = $this->_params['ssFilter']['parent_by_id'];
    			if($action == 'save-close') $this->goAction(array('action' => 'index', 'id' => $parentById));
    			if($action == 'save-new') 	$this->goAction(array('action' => 'form','id' =>0,'parent' => $parentById));
    			if($action == 'save') 		$this->goAction(array('action' => 'form', 'id' => $id,'parent' => $parentById));
    		}
    	}
    	//GET PARENT BY ID
    	$parentById	= $this->getServiceLocator()->get('Admin\Model\StaffTable')->parentById($this->_params['ssFilter'],array('task'=>'form-staff'));
    	//CREATE SELECTBOX
    	$slbParent	= $this->getServiceLocator()->get('Admin\Model\StaffTable')->itemInSelectbox($this->_params['ssFilter'],array('task'=>'form-staff'));
    	//DATA PUT OUT VIEW
    	return new ViewModel(array(
    			'myForm'		=> $myForm,
    			'ssFilter'		=> $this->_params['data'],
    			'parentbyid'	=> $parentById,
    			'slbParent'		=> $slbParent,
    	));
    }
}
