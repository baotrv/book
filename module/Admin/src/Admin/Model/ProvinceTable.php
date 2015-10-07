<?php
Namespace Admin\Model;

use Zend\Db\Sql\Where;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;

class ProvinceTable extends AbstractTableGateway {
		
	protected $tableGateway;
	protected $parent_by_id;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway	= $tableGateway;
	}
	public function parentById($arrParam = null, $options = null){
		if($options == null) {
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
			$select->columns(array('Id','Parentid'));
					$parentId	= $arrParam['parent_id'];
					if ($parentId > 0){
						$select->where->equalTo('Id', $parentId);
					}else{
						$select->where->equalTo('parentId', -1);
					}
			})->current();
		}
		
		if($options['task'] == 'form-province') {
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('Id','Parentid'));
				$parentId 	= $arrParam['parent_by_id'];
				if ($parentId > 0){
					$select->where->equalTo('Id',$parentId);
				}else{
					$select->where->equalTo('Parentid',$parentId);
				}
			})->current();
		}
		//CHECK OBJECT EQUAL CHILDER ONE PARNETID
		if($options['task'] == 'form-province-parnetid') {
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
			//ARRAY ID POST ARRPARAM
				$parentId	= $arrParam['parent_id'];
				$select->columns(array('Id','Parentid'))
					   ->order('Id DESC');
				if ($parentId > 0){
					$select->where->equalTo('Parentid',$parentId);
				}
			})->current();
		}
		//CHECK OBJECT EQUAL CHILDER ARRAY PARENTID
		if($options['task'] == 'form-province-array-parnetid') {
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
			//ARRAY ID POST ARRPARAM
				$arrParentId	= $arrParam['cid'][0];
				$select->columns(array('Id','Parentid'))
						->order('Id DESC');
				//IF OBJECT > 0
				if ($arrParentId > 0){
					$select->where->equalTo('Parentid',$arrParentId);
				}
			})->current();
		}
		return $result;
	}
	
	public function itemInSelectbox($arrParam = null, $options = null){
		if($options == null) {
			$items	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('Id','Title'))
					   ->order('Id DESC');
			});
			$result = array();
			if(!empty($items)){
				foreach ($items as $item){
					$result[$item->Id] = $item->Title;
				}
			}
		}
		
		if($options['task'] == 'form-province') {
			$arrId	= $this->parentById($arrParam,array('task' => 'form-province'));
			//GET PARENT BY ID
			$parentById = $arrParam['parent_by_id'];
			if ($parentById > 0){
				$this->parent_by_id= $arrId->Parentid;
			}else {
				$this->parent_by_id = null;
			}
			$items	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('Id','Title'));
				$select->order('Id DESC');
				$select->where->equalTo('Parentid',$this->parent_by_id);
			});
					
				$result = array();
				if(!empty($items)){
					foreach ($items as $item){
						$result[$item->Id] = $item->Title;
					}
				}
		}
		
		if($options['task'] == 'form-provinceid') {
			$items	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('Id','Title'));
				$select->order('Id DESC');
				$provinceId = 171;
				$select->where->equalTo('Parentid',$provinceId);
			});
				$result = array();
				if(!empty($items)){
					foreach ($items as $item){
						$result[$item->Id] = $item->Title;
					}
				}
		}
		
		if($options['task'] == 'form-user') {
			$items	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('Id','Title'))
				->order('Sort DESC');
				//->where->equalTo('status', 1);
			});
			$result = array();
			if(!empty($items)){
				foreach ($items as $item){
					$result[$item->Id] = $item->Title;
				}
			}
		}
		return $result;
	}
	
	public function countItem($arrParam = null, $options = null){
		if($options['task'] == 'list-item') {
			
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$ssFilter	= $arrParam['ssFilter'];
				
				if(!empty($ssFilter['filter_status'])){
					$status	= ($ssFilter['filter_status'] == 'active') ? 1 : 0;
					$select->where->equalTo('status',$status);
				}
				
				if(!empty($ssFilter['filter_group_acp'])){
					$groupACP	= ($ssFilter['filter_group_acp'] == 'yes') ? 1 : 0;
					$select->where->equalTo('group_acp',$groupACP);
				}
				
				if(!empty($ssFilter['filter_keyword_type']) && !empty($ssFilter['filter_keyword_value'])){
					if($ssFilter['filter_keyword_type'] != 'all') {
						$select->where->like($ssFilter['filter_keyword_type'], '%'.$ssFilter['filter_keyword_value'].'%');
					}else{
						$select->where->NEST
									  ->like('Title', '%'.$ssFilter['filter_keyword_value'].'%')
									  ->or
									  ->equalTo('Id', $ssFilter['filter_keyword_value'])
									  ->UNNEST;
					}
				}
				
				//Select cap cha
					$parentId	= $ssFilter['parent_id'];
					$select->where->equalTo('Parentid', $parentId);
				
			})->count();
			
		}
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null){
		
		if($options['task'] == 'list-item') {
			
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$paginator	= $arrParam['paginator'];
				$ssFilter	= $arrParam['ssFilter'];

				$select->columns(array( 'Id',
										'Code',
										'Title',
										'Parentid',
										'Sort',
										'Address',
										'Phone',
										'Fax',
										'Email',
										'Website',
										'Ngaytrahoso',
										'Biennhan',
										'Gionhan'))
						->limit($paginator['itemCountPerPage'])
						->offset(($paginator['currentPageNumber'] - 1) * $paginator['itemCountPerPage']);
				
				if(!empty($ssFilter['order_by']) && !empty($ssFilter['order'])){
						$select->order(array($ssFilter['order_by'] . ' ' . $ssFilter['order']));
				}
				
				if(!empty($ssFilter['filter_status'])){
					$status	= ($ssFilter['filter_status'] == 'active') ? 1 : 0;
					$select->where->equalTo('status',$status);
				}
				
				if(!empty($ssFilter['filter_group_acp'])){
					$groupACP	= ($ssFilter['filter_group_acp'] == 'yes') ? 1 : 0;
					$select->where->equalTo('group_acp',$groupACP);
				}
				
				if(!empty($ssFilter['filter_keyword_type']) && !empty($ssFilter['filter_keyword_value'])){
					if($ssFilter['filter_keyword_type'] != 'all') {
						$select->where->like($ssFilter['filter_keyword_type'], '%'.$ssFilter['filter_keyword_value'].'%');
					}else{
						$select->where->NEST
									  ->like('Title', '%'.$ssFilter['filter_keyword_value'].'%')
									  ->or
									  ->equalTo('Id', $ssFilter['filter_keyword_value'])
									  ->UNNEST;
					}
				}
				
				//Select cap cha
				$parentId	= $ssFilter['parent_id'];
				$select->where->equalTo('Parentid', $parentId);
			});
			
		}
		return $result;
	}
	
	public function changeStatus($arrParam = null, $options = null){
		if($options['task'] == 'change-status') {
			if($arrParam['status_id'] > 0){
				$data 	= array('status' => ($arrParam['status_value'] == 1) ? 0 : 1);
				$where	= array('id' => $arrParam['status_id']);
				$this->tableGateway->update($data, $where);
				return true;
			}
		}

		if($options['task'] == 'change-group-acp') {
			if($arrParam['status_id'] > 0){
				$data 	= array('group_acp' => ($arrParam['status_value'] == 1) ? 0 : 1);
				$where	= array('id' => $arrParam['status_id']);
				$this->tableGateway->update($data, $where);
				return true;
			}
		}
		
		if($options['task'] == 'change-multi-status') {
			if(!empty($arrParam['cid'])){
				$data 	= array('status' => $arrParam['status_value']);
				$cid	= implode(',', $arrParam['cid']);
				$where	= array('Id IN ('.$cid.')');
				$this->tableGateway->update($data, $where);
				return true;
			}
		}
		
		return false;
	}
	
	public function getItem($arrParam = null, $options = null){
		if($options == null) {
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
					$select->columns(array(	'Id',
											'Code',
											'Title',
											'Parentid',
											'Sort',
											'Address',
											'Phone',
											'Fax',
											'Email',
											'Website',
											'Ngaytrahoso',
											'Biennhan',
											'Gionhan'));
					$select->where->equalTo('Id', $arrParam['Id']);
			})->current();
		}
		return $result;
	}
	
	public function Ordering($arrParam = null, $options = null){
	
		if($options == null) {
			if(!empty($arrParam['cid'])){
				foreach ($arrParam['cid'] as $Id) {
					$data 	= array('ordering' => $arrParam['ordering'][$Id]);
					$where	= array('Id' => $Id);
					$this->tableGateway->update($data, $where);
				}
				return true;
			}
		}
		
		return false;
	
	}
	
public function deleteItem($arrParam = null, $options = null){
		
		if($options['task'] == 'one-delete') {
			if(!empty($arrParam['parent_id'])){
				//CREATE OBJECT WHERE
				$where 	= new Where();
				//CHECK ID EQUAL CHILDER
				$arrId = $this->parentById($arrParam,array('task' => 'form-province-parnetid'));
				
				if (!empty($arrId) && ($arrId->Parentid > 0)){
					return false;
				}else{
					$where->equalTo('Id',$arrParam['parent_id']);
					//ACTION DELETE
					$this->tableGateway->delete($where);
				}
				return true;
			}
		}
		if($options['task'] == 'multi-delete') {
			if(!empty($arrParam['cid'])){
				//CREATE OBJECT WHERE
				$where = new Where();
				//CHECK ID EQUAL CHILDER
				$arrId = $this->parentById($arrParam,array('task' => 'form-province-array-parnetid'));
				if (!empty($arrId) && ($arrId->Parentid > 0)){
					return false;
				}else{
					$where->in('Id', $arrParam['cid']);
					//ACTION DELETE
					$this->tableGateway->delete($where);
				}
				return true;
			}
		}
		return false;
	}
	
	public function saveItem($arrParam = null, $options = null){
		//GET OBJECT SSFILTER FROM ARRPARAM
 		$ssFilter	= $arrParam['ssFilter'];
 		//GET OBJECT SSDATA FROM ARRPARAM
 		$ssData		= $arrParam['data'];
 		//INSERT DATA
		if($options['task'] == 'add-item') {
			$data	= array('Code' 			=> $ssData['Code'], 
							'Title'			=> $ssData['Title'], 
							'Parentid'		=> $ssFilter['parent_by_id'], 
							'Sort'			=> $ssData['Sort'], 
							'Address'		=> $ssData['Address'], 
							'Phone'			=> $ssData['Phone'], 
							'Fax'			=> $ssData['Fax'], 
							'Email'			=> $ssData['Email'], 
							'Website'		=> $ssData['Website'], 
							'Ngaytrahoso'	=> $ssData['Ngaytrahoso'], 
							'Biennhan'		=> $ssData['Biennhan'], 
							'Gionhan'		=> $ssData['Gionhan'],);
			$this->tableGateway->insert($data);
			return $this->tableGateway->getLastInsertValue();
		}
		//UPDATE DATA
		if($options['task'] == 'edit-item') {
			$data	= array('Code' 			=> $ssData['Code'], 
							'Title'			=> $ssData['Title'], 
							'Parentid'		=> $ssFilter['parent_by_id'], 
							'Sort'			=> $ssData['Sort'], 
							'Address'		=> $ssData['Address'], 
							'Phone'			=> $ssData['Phone'], 
							'Fax'			=> $ssData['Fax'], 
							'Email'			=> $ssData['Email'], 
							'Website'		=> $ssData['Website'], 
							'Ngaytrahoso'	=> $ssData['Ngaytrahoso'], 
							'Biennhan'		=> $ssData['Biennhan'], 
							'Gionhan'		=> $ssData['Gionhan'],);				
			$this->tableGateway->update($data, array('id' => $ssData['Id']));
			return $ssData['Id'];
		}
	}
}