<?php
namespace Admin\Controller;

use Zendvn\Controller\ActionController;
use Zend\Form\FormInterface;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

use Zendvn\Paginator\Paginator as ZendvnPaginator;

class PermissionController extends ActionController
{
	public function init(){
		
		// SESSION FILTER
		$ssFilter	= new Container(__CLASS__);
		$this->_params['ssFilter']['order_by']				= !empty($ssFilter->order_by) ? $ssFilter->order_by : 'id';
		$this->_params['ssFilter']['order']					= !empty($ssFilter->order) ? $ssFilter->order : 'DESC';
		$this->_params['ssFilter']['filter_status']			= $ssFilter->filter_status;
		$this->_params['ssFilter']['filter_controller']		= $ssFilter->filter_controller;
		$this->_params['ssFilter']['filter_keyword_type']	= $ssFilter->filter_keyword_type;
		$this->_params['ssFilter']['filter_keyword_value']	= $ssFilter->filter_keyword_value;
		$this->_params['ssFilter']['filter_count_perpage']	= !empty($ssFilter->filter_count_perpage) ? $ssFilter->filter_count_perpage : '5';
		
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
		
		$this->_options['tableName']	= 'Admin\Model\PermissionTable';
		$this->_options['formName']		= 'formAdminPermission';
		
		
		// DATA
		$this->_params['data']	= $this->getRequest()->getPost()->toArray();
		
	}
	
    public function indexAction()
    {
    	$total			= $this->getTable()->countItem($this->_params, array('task' => 'list-item'));
    	$items			= $this->getTable()->listItem($this->_params, array('task' => 'list-item'));
    	$slbController	= $this->getServiceLocator()->get('Admin\Model\PermissionTable')->itemInSelectbox();
    	return new ViewModel(array(
    			'items'			=>	$items,
    			'paginator' 	=> ZendvnPaginator::createPaginator($total, $this->_params['paginator']),
    			'ssFilter'		=> $this->_params['ssFilter'],
    			'slbController'	=> $slbController,
    	));
    }
    
    public function filterAction()
    {
    	if($this->getRequest()->isPost()){
    		$ssFilter		= new Container(__CLASS__);
    		$data			= $this->_params['data'];
    		$ssFilter->order_by				= $data['order_by'];
    		$ssFilter->order				= $data['order'];
    		$ssFilter->filter_status		= $data['filter_status'];
			$ssFilter->filter_controller	= $data['filter_controller'];
    		$ssFilter->filter_keyword_type	= $data['filter_keyword_type'];
    		$ssFilter->filter_keyword_value	= $data['filter_keyword_value'];
    		$ssFilter->filter_count_perpage	= $data['filter_count_perpage'];
    		
    		$btnClear	= $data['btn-clear'];
    		
    		if($btnClear == 'btn-clear'){
    			$ssFilter->offsetUnset('filter_keyword_type');
    			$ssFilter->offsetUnset('filter_keyword_value');
    		}
    	}
    	$this->goAction();
    }
    
    public function statusAction()
    {
    	if($this->getRequest()->isPost()){
    		$flagAction = $this->getTable()->changeStatus($this->_params['data'], array('task' => 'change-status'));
    		if($flagAction == true) $this->flashMessenger()->addMessage('Trạng thái của phần tử đã được cập nhật thành công!');
    	}
    	$this->goAction();
    }
    
    public function groupAcpAction()
    {
    	if($this->getRequest()->isPost()){
    		$flagAction = $this->getTable()->changeStatus($this->_params['data'], array('task' => 'change-group-acp'));
    		if($flagAction == true) $this->flashMessenger()->addMessage('Group ACP của phần tử đã được cập nhật thành công!');
    	}
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
    	$this->goAction();
    }
    
    public function deleteAction()
    {
    	$message	= 'Vui lòng chọn vào phần tử mà bạn muốn xóa!';
    	if($this->getRequest()->isPost()){
    		$flagAction = $this->getTable()->deleteItem($this->_params['data'], array('task' => 'multi-delete'));
    		if($flagAction == true) $message	= 'Các phần tử đã được xóa thành công!';
    	}
    	$this->flashMessenger()->addMessage($message);
    	$this->goAction();
    }
    
    public function formAction()
    {
    	$myForm		= $this->getForm();
    	$task		= 'add-item';
    	$this->_params['data']['id']		= $this->params('id');
    	
    	if(!empty($this->_params['data']['id'])) {
    		$item	= $this->getTable()->getItem($this->_params['data']);

    		if(!empty($item)){
    			$myForm->setInputFilter(new \Admin\Form\PermissionFilter(array('id' => $this->_params['data']['id'])));
    			
    			$myForm->bind($item);
    			$task	= 'edit-item';
    		}
    	}
    	
    	if($this->getRequest()->isPost()){
    		$action	= $this->_params['data']['action'];
    		$myForm->setData($this->_params['data']);
    		 
    		if($myForm->isValid()){
    			$this->_params['data']		= $myForm->getData(FormInterface::VALUES_AS_ARRAY);
    			$id	= $this->getTable()->saveItem($this->_params['data'], array('task' => $task));
    			$this->flashMessenger()->addMessage('Dữ liệu đã được lưu thành công!');
    			if($action == 'save-close') $this->goAction();
    			if($action == 'save-new') 	$this->goAction(array('action' => 'form'));
    			if($action == 'save') 		$this->goAction(array('action' => 'form', 'id' => $id));
    		}
    	}
    
    	return new ViewModel(array(
    			'myForm'	=> $myForm,
    	));
    }
}