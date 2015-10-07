<?php
namespace Zendvn\Model\Entity;

class Permission {

	public $id;
	public $name_permission;
	public $module_permission;
	public $controller_permission;
	public $action_permission;

	public function exchangeArray($data){
		$this->id						= (!empty($data['id'])) ? $data['id'] : null;
		$this->name_permission			= (!empty($data['name_permission'])) ? $data['name_permission'] : null;
		$this->module_permission		= (!empty($data['module_permission'])) ? $data['module_permission'] : null;
		$this->controller_permission	= (!empty($data['controller_permission'])) ? $data['controller_permission'] : null;
		$this->action_permission		= (!empty($data['action_permission'])) ? $data['action_permission'] : null;
	}
	public function getArrayCopy(){
		$result = get_object_vars($this);
		//$result['status']	= ($result['status'] == 1) ? 'active' : 'inactive';
		return $result;
	}
}