<?php
namespace Block;
use Zend\View\Helper\AbstractHelper;

class BlkSysfunction extends AbstractHelper {
	
	protected $_data;
	
	public function __invoke(){
		require_once 'BlkSysfunction/default.phtml';
	}
	
	public function setData($table,$parent){
		$this->_data['item']		= $table->listItem(null, array('task' => 'sysfunction-backend'));
		$this->_data['parentbyid']	= $parent;
		return $this->_data ;
	}
}