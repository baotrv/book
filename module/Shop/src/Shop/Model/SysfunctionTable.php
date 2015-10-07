<?php
namespace Shop\Model;

use Admin\Model\NestedTable;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class SysfunctionTable extends NestedTable {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway	= $tableGateway;
	}
public function parentById($arrParam = null, $options = null){
		//CHECK OBJECT EQUAL CHILDER ONE PARNETID
		if($options['task'] == 'form-sysfunction-parnetid') {
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				//ARRAY ID POST ARRPARAM
				$select->columns(array('id'))
						->order('id DESC');
				//IF OBJECT > 0
				if ($arrParam > 0){
					$select->where->equalTo('parent',$arrParam);
				}
			})->current();
		}
		//CHECK OBJECT EQUAL CHILDER ARRAY PARENTID
		if($options['task'] == 'form-sysfunction-array-parnetid') {
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
	
	public function getItem($arrParam = null, $options = null){
		if($options['task'] == 'sysfunction-backend') {
			
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('id','name','url','menu','status','show','parent','ordering','href','level','left','right'))
						->where->equalTo('id', $arrParam['id']);
				;
			})->current();
		}
	
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null){
		
		if($options['task'] == 'sysfunction-backend') {
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				
				$select->columns(array(
							'id','name','url','menu','status','show','parent','ordering','href','level','left','right'
						))
						->order(array('left ASC'))
						->where->lessThanOrEqualTo('level', 3)
						->where->greaterThan('level', 0);
				;
			});
		}
		
		if($options['task'] == 'list-breadcrumb') {
			
			$result	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('id','name','url','menu','status','show','ordering','href','level','left','right'))
						->order('left ASC')
						->where->greaterThan('level', 0)
						->where->lessThanOrEqualTo('left', $arrParam->left)
						->where->greaterThanOrEqualTo('right', $arrParam->right)
				;
			});
		}
		
		if($options['task'] == 'list-branch') {
			$items	= $this->tableGateway->select(function (Select $select) use ($arrParam){
				$select->columns(array('id','name','url','menu','status','show','ordering','href','level','left','right'))
					   ->order('left ASC')
					   ->where->greaterThan('level', 0)
					   ->where->between('left',$arrParam->left,$arrParam->right)
				;
			});
			foreach ($items as $item){
				$result[]	= $item->id;
				
			}
					
		}
		return $result;
	}
	
}