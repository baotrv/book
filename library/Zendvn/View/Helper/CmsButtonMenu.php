<?php
namespace Zendvn\View\Helper;
use Zend\View\Helper\AbstractHelper;

class CmsButtonMenu extends AbstractHelper {
	
	public function __invoke($id, $menu, $options = null){
	
		$classStatus	= ($menu == 1) ? 'success' : 'default';
		
		return sprintf('<a href="#" onclick="javascript:changeMenu(\'%s\',\'%s\')" class="label label-%s"><i class="fa fa-check"></i></a>', 
						$id, $menu, $classStatus);
	}
}