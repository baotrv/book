<?php
namespace Admin\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Where;

class SysfunctionTable extends NestedTable {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway	= $tableGateway;
	}
	
	public function itemInSelectbox($arrParam = null, $options = null){
		if($options['task'] == 'list-level') {
			$items	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('id','level'))
					   ->order('level DESC')
					   ->limit(1);
				;
			})->current();
			$result = array();
			if(!empty($items)){
				for($i = 1; $i <= $items->level; $i++) $result[$i]	= 'Level ' . $i;
			}
		}
		
		if($options['task'] == 'form-sysfunction') {
			$items	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('id','name', 'level'))
				->order('left ASC')
				;
			});
			
			$result = array();
			if(!empty($items)){
				foreach ($items as $item) {
					$result[$item->id]	= str_repeat('------|', $item->level) . ' ' . $item->name;
				}
			}
		}
		
		if($options['task'] == 'list-group') {
			$items	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('id','name', 'level'))
					   ->order('left ASC')
					   ->where->greaterThan('left', 0)
				;
			});
					
				$result = array();
				if(!empty($items)){
					foreach ($items as $item) {
						$result[$item->id]	= str_repeat('------|', $item->level - 1) . ' ' . $item->name;
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
					$select->where->equalTo(TABLE_SYSFUNCTION.'.status',$status);
				}
				
				if(!empty($ssFilter['filter_level'])){
					$select->where->lessThanOrEqualTo(TABLE_SYSFUNCTION.'.level', $ssFilter['filter_level']);
				}
				
				if(!empty($ssFilter['filter_keyword_type']) && !empty($ssFilter['filter_keyword_value'])){
					if($ssFilter['filter_keyword_type'] != 'all') {
						$select->where->like(TABLE_SYSFUNCTION. $ssFilter['filter_keyword_type'], '%'.$ssFilter['filter_keyword_value'].'%');
					}else{
						$select->where->NEST
									  ->like('name', '%'.$ssFilter['filter_keyword_value'].'%')
									  ->or
									  ->equalTo(TABLE_SYSFUNCTION.'.id', $ssFilter['filter_keyword_value'])
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
							'id','name','url','menu','status','show','parent','ordering','href','level','left','right'
						))
						->join(
							array('s' => TABLE_SYSFUNCTION),
							TABLE_SYSFUNCTION.'.parent = s.id',
							array('pleft' => 'left', 'pright' => 'right'),
							$select::JOIN_LEFT		
						)
						->limit($paginator['itemCountPerPage'])
						->offset(($paginator['currentPageNumber'] - 1) * $paginator['itemCountPerPage'])
						->where->greaterThan(TABLE_SYSFUNCTION.'.level', 0);
				;
				
				if(!empty($ssFilter['order_by']) && !empty($ssFilter['order'])){
						$select->order(array(TABLE_SYSFUNCTION .'.'. $ssFilter['order_by'] . ' ' . $ssFilter['order']));
				}
				
				if(!empty($ssFilter['filter_status'])){
					$status	= ($ssFilter['filter_status'] == 'active') ? 1 : 0;
					$select->where->equalTo(TABLE_SYSFUNCTION.'.status',$status);
				}
				
				if(!empty($ssFilter['filter_level'])){
					$select->where->lessThanOrEqualTo(TABLE_SYSFUNCTION.'.level', $ssFilter['filter_level']);
				}
				
				
				if(!empty($ssFilter['filter_keyword_type']) && !empty($ssFilter['filter_keyword_value'])){
					if($ssFilter['filter_keyword_type'] != 'all') {
						$select->where->like(TABLE_SYSFUNCTION . $ssFilter['filter_keyword_type'], '%'.$ssFilter['filter_keyword_value'].'%');
					}else{
						$select->where->NEST
									  ->like(TABLE_SYSFUNCTION.'.name', '%'.$ssFilter['filter_keyword_value'].'%')
									  ->or
									  ->equalTo(TABLE_SYSFUNCTION.'.id', $ssFilter['filter_keyword_value'])
									  ->UNNEST;
					}
				}
				
				$select->order(array('left ASC'));
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
	
	public function changeShow($arrParam = null, $options = null){
		if($options['task'] == 'change-show') {
			if($arrParam['show_id'] > 0){
				$data 	= array('show' => ($arrParam['show_value'] == 1) ? 0 : 1);
				$where	= array('id' => $arrParam['show_id']);
				$this->tableGateway->update($data, $where);
				return true;
			}
		}
	
		if($options['task'] == 'change-multi-show') {
			if(!empty($arrParam['cid'])){
				$data 	= array('show' => $arrParam['show_value']);
				$cid	= implode(',', $arrParam['cid']);
				$where	= array('id IN ('.$cid.')');
				$this->tableGateway->update($data, $where);
				return true;
			}
		}
	
		return false;
	}
	
	public function changeMenu($arrParam = null, $options = null){
		if($options['task'] == 'change-menu') {
			if($arrParam['menu_id'] > 0){
				$data 	= array('menu' => ($arrParam['menu_value'] == 1) ? 0 : 1);
				$where	= array('id' => $arrParam['menu_id']);
				$this->tableGateway->update($data, $where);
				return true;
			}
		}
	
		if($options['task'] == 'change-multi-menu') {
			if(!empty($arrParam['cid'])){
				$data 	= array('menu' => $arrParam['menu_value']);
				$cid	= implode(',', $arrParam['cid']);
				$where	= array('id IN ('.$cid.')');
				$this->tableGateway->update($data, $where);
				return true;
			}
		}
	
		return false;
	}
	
	public function moveItem($arrParam = null, $options = null){
		if($options == null) {
			if($arrParam['status_id'] > 0){
				if($arrParam['status_value'] == 'up') $this->moveUp($arrParam['status_id']);
				if($arrParam['status_value'] == 'down') $this->moveDown($arrParam['status_id']);
				return true;
			}
		}
	
		return false;
	}
	
	public function getItem($arrParam = null, $options = null){
	
		if($options == null) {
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
					$select->columns(array('id','name','url','menu','status','show','parent','ordering','href','level','left','right'));
					$select->where->equalTo('id', $arrParam['id']);
			})->current();
		}
	
		return $result;
	}
	
// 	public function ordering($arrParam = null, $options = null){
	
// 		if($options == null) {
// 			if(!empty($arrParam['cid'])){
// 				foreach ($arrParam['cid'] as $id) {
// 					$data 	= array('ordering' => $arrParam['ordering'][$id]);
// 					$where	= array('id' => $id);
// 					$this->tableGateway->update($data, $where);
// 				}
// 				return true;
// 			}
// 		}
		
// 		return false;
// 	}
	
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
				'name'		=> $arrParam['name'],	
				'href'		=> $arrParam['href'],
				'url'		=> $arrParam['url'],	
				'parent'	=> $arrParam['parent'],	
				'menu'		=> ($arrParam['menu'] 	== 'active') ? 1 : 0,
				'show'		=> ($arrParam['show']	== 'active') ? 1 : 0,
				'status'	=> ($arrParam['status'] == 'active') ? 1 : 0,	
				'parent'	=> $arrParam['parent'],		
			);

			if(!empty($arrParam['href'])){
				$config		= array(
						array('HTML.AllowedElements', 'p,s,u,em,strong,span'),
						array('HTML.AllowedAttributes', 'style'),
				);
				 
				$filter			= new \Zendvn\Filter\Purifier($config);
				$data['url']	= $filter->filter($arrParam['url']);
			}
			
			$this->insertNode($data, $arrParam['parent'], array('position' => 'right'));
			return $this->tableGateway->getLastInsertValue();
		}
		if($options['task'] == 'edit-item') {
			$data	= array(
				'name'		=> $arrParam['name'],	
				'href'		=> $arrParam['href'],
				'url'		=> $arrParam['url'],	
				'parent'	=> $arrParam['parent'],	
				'menu'		=> ($arrParam['menu'] == 'active') ? 1 : 0,
				'show'		=> ($arrParam['show'] == 'active') ? 1 : 0,
				'status'	=> ($arrParam['status'] == 'active') ? 1 : 0,	
				'parent'	=> $arrParam['parent'],
			);
			
				
			if(!empty($arrParam['href'])){
				$config		= array(
						array('HTML.AllowedElements', 'p,s,u,em,strong,span'),
						array('HTML.AllowedAttributes', 'style'),
				);
					
				$filter			= new \Zendvn\Filter\Purifier($config);
				$data['url']	= $filter->filter($arrParam['url']);
			}
			
			if($arrParam['parent'] == $arrParam['id']) $arrParam['parent'] = null;
			$this->updateNode($data, $arrParam['id'], $arrParam['parent']);
			return $arrParam['id'];
		}
	}
}