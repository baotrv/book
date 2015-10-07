<?php
namespace Zendvn\View\Helper\Url;
use Zendvn\Filter\CreateURLFriendly;

use Zend\View\Helper\AbstractHelper;

class LinkSysfunction extends AbstractHelper {
	
	public function __invoke(){
		$urlHelper	= $this->getView()->plugin('url');
		$filter		= new CreateURLFriendly();
		
		if(URL_FRIENDLY == true){	
			return $urlHelper('routeHome');
		}else{
			return $urlHelper('routeHome');
		}
		
		return $urlHelper('home/default', array(
				'controller'=> 'index', 
				'action' 	=> 'index'));
		
	}
}