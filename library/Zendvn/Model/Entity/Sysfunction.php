<?php
namespace Zendvn\Model\Entity;

class Sysfunction {
	//id,name,url,is_menu,is_status,is_show,parent_id,ordering,href_name,level,left,right
	public $id;
	public $name;
	public $url;
	public $menu;
	public $status;
	public $show;
	public $parent;
	public $ordering;
	public $href;
	public $level;
	public $left;
	public $right;
	
	public function exchangeArray($data){
		$this->id				= (!empty($data['id'])) ? $data['id'] : null;
		$this->name				= (!empty($data['name'])) ? $data['name'] : null;
		$this->url				= (!empty($data['url'])) ? $data['url'] : null;
		$this->menu				= (!empty($data['menu'])) ? $data['menu'] : 0;
		$this->status			= (!empty($data['status'])) ? $data['status'] : 0;
		$this->show				= (!empty($data['show'])) ? $data['show'] : 0;
		$this->parent			= (!empty($data['parent'])) ? $data['parent'] : 0;
		$this->ordering			= (!empty($data['ordering'])) ? $data['ordering'] : null;
		$this->href				= (!empty($data['href'])) ? $data['href'] : null;
		$this->level			= (!empty($data['level'])) ? $data['level'] : null;
		$this->left				= (!empty($data['left'])) ? $data['left'] : null;
		$this->right			= (!empty($data['right'])) ? $data['right'] : null;
	}
	public function getArrayCopy(){
		$result = get_object_vars($this);
		$result['menu']		= ($result['menu'] == 1) ? 'active' : 'inactive';
		$result['status']	= ($result['status'] == 1) ? 'active' : 'inactive';
		$result['show']		= ($result['show'] == 1) ? 'active' : 'inactive';
		return $result;
	}
}