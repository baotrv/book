<?php
namespace Zendvn\Model\Entity;
class Career {
	
	public $Id;
	public $Code;
	public $Name;
	public $Desription;
	public $Sort;
	public $CAP1;
	public $CAP2;
	public $CAP3;
	public $CAP4;
	public $CAP5;
	public $ParentId;
	public $IsCommon;
	
	public function exchangeArray($data){
		$this->Id				= (!empty($data['Id'])) ? $data['Id'] : null;
		$this->Code				= (!empty($data['Code'])) ? $data['Code'] : null;
		$this->Name				= (!empty($data['Name'])) ? $data['Name'] : null;
		$this->Desription		= (!empty($data['Desription'])) ? $data['Desription'] : null;
		$this->Sort				= (!empty($data['Sort'])) ? $data['Sort'] : null;
		$this->CAP1				= (!empty($data['CAP1'])) ? $data['CAP1'] : null;
		$this->CAP2				= (!empty($data['CAP2'])) ? $data['CAP2'] : null;
		$this->CAP3				= (!empty($data['CAP3'])) ? $data['CAP3'] : null;
		$this->CAP4				= (!empty($data['CAP4'])) ? $data['CAP4'] : null;
		$this->CAP5				= (!empty($data['CAP5'])) ? $data['CAP5'] : null;
		$this->Parentid			= (!empty($data['Parentid'])) ? $data['Parentid'] : null;
		$this->IsCommon			= (!empty($data['IsCommon'])) ? $data['IsCommon'] : null;
	}
	public function getArrayCopy(){
		$result = get_object_vars($this);
		$result['IsCommon']		= ($result['IsCommon'] == 1) ? 'active' : 'inactive';
		return $result;
	}
}
?>