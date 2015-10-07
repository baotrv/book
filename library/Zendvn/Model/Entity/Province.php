<?php
namespace Zendvn\Model\Entity;
class Province {
	public $Id;
	public $Code;
	public $Title;
	public $Parentid;
	public $Sort;
	public $Address;
	public $Phone;
	public $Fax;
	public $Email;
	public $Website;
	public $Ngaytrahoso;
	public $Biennhan;
	public $Gionhan;
	
	public function exchangeArray($data){
		$this->Id				= (!empty($data['Id'])) ? $data['Id'] : null;
		$this->Code				= (!empty($data['Code'])) ? $data['Code'] : null;
		$this->Title			= (!empty($data['Title'])) ? $data['Title'] : null;
		$this->Parentid			= (!empty($data['Parentid'])) ? $data['Parentid'] : null;
		$this->Sort				= (!empty($data['Sort'])) ? $data['Sort'] : null;
		$this->Address			= (!empty($data['Address'])) ? $data['Address'] : null;
		$this->Phone			= (!empty($data['Phone'])) ? $data['Phone'] : null;
		$this->Fax				= (!empty($data['Fax'])) ? $data['Fax'] : null;
		$this->Email			= (!empty($data['Email'])) ? $data['Email'] : null;
		$this->Website			= (!empty($data['Website'])) ? $data['Website'] : null;
		$this->Ngaytrahoso		= (!empty($data['Ngaytrahoso'])) ? $data['Ngaytrahoso'] : null;
		$this->Biennhan			= (!empty($data['Biennhan'])) ? $data['Biennhan'] : null;
		$this->Gionhan			= (!empty($data['Gionhan'])) ? $data['Gionhan'] : null;
	}
	public function getArrayCopy(){
		$result = get_object_vars($this);		
		return $result;
	}
}
?>