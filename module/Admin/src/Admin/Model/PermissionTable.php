<?php
namespace Admin\Model;

use Zend\Db\Sql\Where;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;

class PermissionTable extends AbstractTableGateway {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway	= $tableGateway;
	}
	
	public function itemInSelectbox($arrParam = null, $options = null){
		if($options == null) {
			$items	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('id','controller_permission'))
					   ->order('id DESC');	
			});
			$result = array();
			if(!empty($items)){
				foreach ($items as $item){
					$result[$item->controller_permission] = $item->controller_permission;
				}
			}
		}
		if($options['task'] == 'form-permission') {
			$items	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('id','controller_permission'))
				->order('controller_permission DESC')
				->where->equalTo('controller_permission','');
			});
			$result = array();
			if(!empty($items)){
				foreach ($items as $item){
					$result[$item->controller_permission] = $item->controller_permission;
				}
			}
		}
		return $result;
	}
	
	public function countItem($arrParam = null, $options = null){
		if($options['task'] == 'list-item') {
			
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$ssFilter	= $arrParam['ssFilter'];
				
							
				if(!empty($ssFilter['filter_controller'])){
					$select->where->equalTo('controller_permission',$ssFilter['filter_controller']);
				}
				
				if(!empty($ssFilter['filter_keyword_type']) && !empty($ssFilter['filter_keyword_value'])){
					if($ssFilter['filter_keyword_type'] != 'all') {
						$select->where->like($ssFilter['filter_keyword_type'], '%'.$ssFilter['filter_keyword_value'].'%');
					}else{
						$select->where->NEST
									  ->like('name_permission', '%'.$ssFilter['filter_keyword_value'].'%')
									  ->or
									  ->equalTo('id', $ssFilter['filter_keyword_value'])
									  ->UNNEST;
					}
				}
				
			})->count();
			
		}
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null){
		
		if($options['task'] == 'list-item') {
			
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$paginator	= $arrParam['paginator'];
				$ssFilter	= $arrParam['ssFilter'];
				
				$select->columns(array(
							'id', 'name_permission', 'module_permission', 'controller_permission', 'action_permission'
						))
						->limit($paginator['itemCountPerPage'])
						->offset(($paginator['currentPageNumber'] - 1) * $paginator['itemCountPerPage']);
								
				if(!empty($ssFilter['filter_controller'])){
					$select->where->equalTo('controller_permission',$ssFilter['filter_controller']);
				}
				
				if(!empty($ssFilter['filter_keyword_type']) && !empty($ssFilter['filter_keyword_value'])){
					if($ssFilter['filter_keyword_type'] != 'all') {
						$select->where->like($ssFilter['filter_keyword_type'], '%'.$ssFilter['filter_keyword_value'].'%');
					}else{
						$select->where->NEST
									  ->like('name_permission', '%'.$ssFilter['filter_keyword_value'].'%')
									  ->or
									  ->equalTo('id', $ssFilter['filter_keyword_value'])
									  ->UNNEST;
					}
				}
				
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
				$where	= array('id IN ('.$cid.')');
				$this->tableGateway->update($data, $where);
				return true;
			}
		}
		
		return false;
	}
	
	public function getItem($arrParam = null, $options = null){
	
		if($options == null) {
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
					$select->columns(array('id', 'name_permission','module_permission','controller_permission','action_permission'));
					$select->where->equalTo('id', $arrParam['id']);
			})->current();
		}
	
		return $result;
	}
	
	public function ordering($arrParam = null, $options = null){
	
		if($options == null) {
			if(!empty($arrParam['cid'])){
				foreach ($arrParam['cid'] as $id) {
					$data 	= array('ordering' => $arrParam['ordering'][$id]);
					$where	= array('id' => $id);
					$this->tableGateway->update($data, $where);
				}
				return true;
			}
		}
		
		return false;
	
	}
	
	public function deleteItem($arrParam = null, $options = null){
	
		if($options['task'] == 'multi-delete') {
			if(!empty($arrParam['cid'])){
				$where = new Where();
				$where->in('id', $arrParam['cid']);
				$this->tableGateway->delete($where);
				return true;
			}
		}
		return false;
	}
	
	public function saveItem($arrParam = null, $options = null){

		if($options['task'] == 'add-item') {
			$data	= array(
				'name_permission'			=> $arrParam['name_permission'],		
				'module_permission'			=> $arrParam['module_permission'],
				'controller_permission'		=> $arrParam['controller_permission'],
				'action_permission'			=> $arrParam['action_permission'],
			);
			
			$this->tableGateway->insert($data);
			return $this->tableGateway->getLastInsertValue();
		}
		if($options['task'] == 'edit-item') {
			$data	= array(
				'name_permission'			=> $arrParam['name_permission'],		
				'module_permission'			=> $arrParam['module_permission'],
				'controller_permission'		=> $arrParam['controller_permission'],
				'action_permission'			=> $arrParam['action_permission'],	
			);
				
			$this->tableGateway->update($data, array('id' => $arrParam['id']));
			return $arrParam['id'];
		}
	}
}