<?php
namespace Zendvn\View\Helper;
use Zend\View\Helper\AbstractHelper;

class CmsButtonShow extends AbstractHelper {
	
	public function __invoke($id, $show, $options = null){
	
		$classStatus	= ($show == 1) ? 'success' : 'default';
		
		return sprintf('<a href="#" onclick="javascript:changeShow(\'%s\',\'%s\')" class="label label-%s"><i class="fa fa-check"></i></a>', 
						$id, $show, $classStatus);
	}
}