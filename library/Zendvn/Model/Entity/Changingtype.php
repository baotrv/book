<?php
namespace Zendvn\Model\Entity;
class Changingtype {
	
	public $Id;
	public $Code;
	public $Name;
	public $Desription;
	public $Sort;
	public $Created;
	public $Creator;
	public $Modified;
	public $Modifier;
	public $Parentid;
	
	public function exchangeArray($data){
		$this->Id				= (!empty($data['Id'])) ? $data['Id'] : null;
		$this->Code				= (!empty($data['Code'])) ? $data['Code'] : null;
		$this->Name				= (!empty($data['Name'])) ? $data['Name'] : null;
		$this->Desription		= (!empty($data['Desription'])) ? $data['Desription'] : null;
		$this->Sort				= (!empty($data['Sort'])) ? $data['Sort'] : null;
		$this->Created			= (!empty($data['Created'])) ? $data['Created'] : null;
		$this->Creator			= (!empty($data['Creator'])) ? $data['Creator'] : null;
		$this->Modified			= (!empty($data['Modified'])) ? $data['Modified'] : null;
		$this->Modifier			= (!empty($data['Modifier'])) ? $data['Modifier'] : null;
		$this->Parentid			= (!empty($data['Parentid'])) ? $data['Parentid'] : null;
	}
	public function getArrayCopy(){
		$result = get_object_vars($this);		
		return $result;
	}
}
?>