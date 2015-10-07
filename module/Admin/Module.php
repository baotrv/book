<?php
namespace Admin;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;

use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
    	$eventManager			= $e->getApplication()->getEventManager();
    	$moduleRouteListener	= new ModuleRouteListener();
    	$moduleRouteListener->attach($eventManager);
    	
    	$adapter	= $e->getApplication()->getServiceManager()->get('dbConfig');
    	GlobalAdapterFeature::setStaticAdapter($adapter);
    }

    public function getFormElementConfig(){
    	return array(
    			'factories'	=> array(
    					'formAdminGroup'	=> function($sm){
    						$myForm	= new \Admin\Form\Group();
    						$myForm->setInputFilter(new \Admin\Form\GroupFilter());
    						return $myForm;
    					},
    					'formAdminUser'	=> function($sm){
    						$groupTable = $sm->getServiceLocator()->get('Admin\Model\GroupTable');
    						$myForm		= new \Admin\Form\User($groupTable);
    						$myForm->setInputFilter(new \Admin\Form\UserFilter());
    						return $myForm;
    					},
    					'formAdminCategory'	=> function($sm){
    						$categoryTable = $sm->getServiceLocator()->get('Admin\Model\CategoryTable');
    						$myForm		= new \Admin\Form\Category($categoryTable);
    						$myForm->setInputFilter(new \Admin\Form\CategoryFilter());
    						return $myForm;
    					},
    					'formAdminBook'	=> function($sm){
    						$categoryTable = $sm->getServiceLocator()->get('Admin\Model\CategoryTable');
    						$myForm		= new \Admin\Form\Book($categoryTable);
    						$myForm->setInputFilter(new \Admin\Form\BookFilter());
    						return $myForm;
    					},
    					'formAdminSlider'	=> function($sm){
    						$bookTable 	= $sm->getServiceLocator()->get('Admin\Model\BookTable');
    						$myForm			= new \Admin\Form\Slider($bookTable);
    						$myForm->setInputFilter(new \Admin\Form\SliderFilter());
    						return $myForm;
    					},
    					'formAdminPermission'	=> function($sm){
    						$permissionTable 	= $sm->getServiceLocator()->get('Admin\Model\PermissionTable');
    						$myForm				= new \Admin\Form\Permission($permissionTable);
    						$myForm->setInputFilter(new \Admin\Form\PermissionFilter());
    						return $myForm;
    					},
    					'formAdminSysfunction'	=> function($sm){
    						$sysfunctionTable 	= $sm->getServiceLocator()->get('Admin\Model\SysfunctionTable');
    						$myForm				= new \Admin\Form\Sysfunction($sysfunctionTable);
    						$myForm->setInputFilter(new \Admin\Form\SysfunctionFilter());
    						return $myForm;
    					},
    					'formAdminProvince'		=> function($sm){
    						$provinceTable 		= $sm->getServiceLocator()->get('Admin\Model\ProvinceTable');
    						$myForm				= new \Admin\Form\Province($provinceTable);
    						$myForm->setInputFilter(new \Admin\Form\ProvinceFilter());
    						return $myForm;
    					},
    					'formAdminCitizen'		=> function($sm){
    						$citizenTable 		= $sm->getServiceLocator()->get('Admin\Model\CitizenTable');
    						$myForm				= new \Admin\Form\Citizen($citizenTable);
    						$myForm->setInputFilter(new \Admin\Form\CitizenFilter());
    						return $myForm;
    					},
    					'formAdminCountry'		=> function($sm){
    						$countryTable 		= $sm->getServiceLocator()->get('Admin\Model\CountryTable');
    						$myForm				= new \Admin\Form\Country($countryTable);
    						$myForm->setInputFilter(new \Admin\Form\CountryFilter());
    						return $myForm;
    					},  
						'formAdminComponentprofiles'	=> function($sm){
    						$componentprofilesTable 	= $sm->getServiceLocator()->get('Admin\Model\ComponentprofilesTable');
    						$myForm						= new \Admin\Form\Componentprofiles($componentprofilesTable);
    						$myForm->setInputFilter(new \Admin\Form\ComponentprofilesFilter());
    						return $myForm;
    					}, 
    					'formAdminGrantingagencies'	=> function($sm){
    						$grantingagenciesTable 		= $sm->getServiceLocator()->get('Admin\Model\GrantingagenciesTable');
    						$provinceTable 				= $sm->getServiceLocator()->get('Admin\Model\ProvinceTable');
    						$myForm						= new \Admin\Form\Grantingagencies($provinceTable,$grantingagenciesTable);
    						$myForm->setInputFilter(new \Admin\Form\GrantingagenciesFilter());
    						return $myForm;
    					},
    					'formAdminVisaoffices'		=> function($sm){
    						$visaofficesTable 		= $sm->getServiceLocator()->get('Admin\Model\VisaofficesTable');
    						$myForm					= new \Admin\Form\Visaoffices($visaofficesTable);
    						$myForm->setInputFilter(new \Admin\Form\VisaofficesFilter());
    						return $myForm;
    					},
    					'formAdminCertifiedpaper'		=> function($sm){
    						$certifiedpaperTable 		= $sm->getServiceLocator()->get('Admin\Model\CertifiedpaperTable');
    						$myForm						= new \Admin\Form\Certifiedpaper($certifiedpaperTable);
    						$myForm->setInputFilter(new \Admin\Form\CertifiedpaperFilter());
    						return $myForm;
    					},
    					'formAdminStaff'		=> function($sm){
    						$staffTable 		= $sm->getServiceLocator()->get('Admin\Model\StaffTable');
    						$provinceTable 				= $sm->getServiceLocator()->get('Admin\Model\ProvinceTable');
    						$myForm				= new \Admin\Form\Staff($staffTable,$provinceTable);
    						$myForm->setInputFilter(new \Admin\Form\StaffFilter());
    						return $myForm;
    					},
    					'formAdminPosition'		=> function($sm){
    						$positionTable 		= $sm->getServiceLocator()->get('Admin\Model\PositionTable');
    						$myForm				= new \Admin\Form\Position($positionTable);
    						$myForm->setInputFilter(new \Admin\Form\PositionFilter());
    						return $myForm;
    					},
    					'formAdminChangingtype'		=> function($sm){
    						$changingtypeTable 		= $sm->getServiceLocator()->get('Admin\Model\ChangingtypeTable');
    						$myForm				= new \Admin\Form\Changingtype($changingtypeTable);
    						$myForm->setInputFilter(new \Admin\Form\ChangingtypeFilter());
    						return $myForm;
    					},
    					'formAdminBusinessfield'	=> function($sm){
    						$businessfieldTable 	= $sm->getServiceLocator()->get('Admin\Model\BusinessfieldTable');
    						$myForm					= new \Admin\Form\Businessfield($businessfieldTable);
    						$myForm->setInputFilter(new \Admin\Form\BusinessfieldFilter());
    						return $myForm;
    					},
    					'formAdminCareer'		=> function($sm){
    						$careerTable 		= $sm->getServiceLocator()->get('Admin\Model\CareerTable');
    						$myForm				= new \Admin\Form\Career($careerTable);
    						$myForm->setInputFilter(new \Admin\Form\CareerFilter());
    						return $myForm;
    					},
    			),
    	);
    }
    
    public function getConfig()
    {
        return array_merge(
    			require_once __DIR__ . '/config/module.config.php',
    			require_once __DIR__ . '/config/router.config.php'
    	);
    }

    public function getAutoloaderConfig()
    {
        return array(
        		'Zend\Loader\ClassMapAutoloader'	=> array(
        				__DIR__ . '/autoload_classmap.php'
        		),
	            'Zend\Loader\StandardAutoloader' => array(
	                'namespaces' => array(
	                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
	                ),
	            ),
        );
    }
	
	public function getServiceConfig(){
		return array(
				'factories'	=> array(
						'GroupTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Group());
							return new TableGateway(TABLE_GROUP, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\GroupTable'	=> function ($sm) {
							$tableGateway	= $sm->get('GroupTableGateway');
							return new \Admin\Model\GroupTable($tableGateway);
						},
						'UserTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\User());
							return new TableGateway(TABLE_USER, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\UserTable'	=> function ($sm) {
							$tableGateway	= $sm->get('UserTableGateway');
							return new \Admin\Model\UserTable($tableGateway);
						},
						'NestedTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Nested());
							return new TableGateway(TABLE_NESTED, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\NestedTable'	=> function ($sm) {
							$tableGateway	= $sm->get('NestedTableGateway');
							return new \Admin\Model\NestedTable($tableGateway);
						},
						'CategoryTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Category());
							return new TableGateway(TABLE_CATEGORY, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\CategoryTable'	=> function ($sm) {
							$tableGateway	= $sm->get('CategoryTableGateway');
							return new \Admin\Model\CategoryTable($tableGateway);
						},
						'BookTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Book());
							return new TableGateway(TABLE_BOOK, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\BookTable'	=> function ($sm) {
							$tableGateway	= $sm->get('BookTableGateway');
							return new \Admin\Model\BookTable($tableGateway);
						},
						'SliderTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Slider());
							return new TableGateway(TABLE_SLIDER, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\SliderTable'	=> function ($sm) {
							$tableGateway	= $sm->get('SliderTableGateway');
							return new \Admin\Model\SliderTable($tableGateway);
						},
						'PermissionTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Permission());
							return new TableGateway(TABLE_PERMISSION, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\PermissionTable'	=> function ($sm) {
							$tableGateway	= $sm->get('PermissionTableGateway');
							return new \Admin\Model\PermissionTable($tableGateway);
						},
						'SysfunctionTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Sysfunction());
							return new TableGateway(TABLE_SYSFUNCTION, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\SysfunctionTable'	=> function ($sm) {
							$tableGateway	= $sm->get('SysfunctionTableGateway');
							return new \Admin\Model\SysfunctionTable($tableGateway);
						},
						'NguoidungTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Nguoidung());
							return new TableGateway(TABLE_NGUOIDUNG, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\NguoidungTable'	=> function ($sm) {
							$tableGateway	= $sm->get('NguoidungTableGateway');
							return new \Admin\Model\NguoidungTable($tableGateway);
						},
						'CartTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Cart());
							return new TableGateway(TABLE_CART, $adapter, null, $resultSetPrototype);
						},
						'ProvinceTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Province());
							return new TableGateway(TABLE_PROVINCE, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\ProvinceTable'	=> function ($sm) {
							$tableGateway	= $sm->get('ProvinceTableGateway');
							return new \Admin\Model\ProvinceTable($tableGateway);
						},
						'CitizenTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Citizen());
							return new TableGateway(TABLE_CITIZEN, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\CitizenTable'	=> function ($sm) {
							$tableGateway	= $sm->get('CitizenTableGateway');
							return new \Admin\Model\CitizenTable($tableGateway);
						},
						'CountryTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Country());
							return new TableGateway(TABLE_COUNTRY, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\CountryTable'	=> function ($sm) {
							$tableGateway	= $sm->get('CountryTableGateway');
							return new \Admin\Model\CountryTable($tableGateway);
						},
						'ComponentprofilesTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\componentprofiles());
							return new TableGateway(TABLE_COMPONENT_PROFILES, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\ComponentprofilesTable'	=> function ($sm) {
							$tableGateway	= $sm->get('ComponentprofilesTableGateway');
							return new \Admin\Model\ComponentprofilesTable($tableGateway);
						},
						'GrantingagenciesTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\grantingagencies());
							return new TableGateway(TABLE_GRANTING_AGENCIES, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\GrantingagenciesTable'	=> function ($sm) {
							$tableGateway	= $sm->get('GrantingagenciesTableGateway');
							return new \Admin\Model\GrantingagenciesTable($tableGateway);
						},
						'VisaofficesTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Visaoffices());
							return new TableGateway(TABLE_VISA_OFFICES, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\VisaofficesTable'	=> function ($sm) {
							$tableGateway	= $sm->get('VisaofficesTableGateway');
							return new \Admin\Model\VisaofficesTable($tableGateway);
						},
						'CertifiedpaperTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Certifiedpaper());
							return new TableGateway(TABLE_CERTIFIED_PAPER, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\CertifiedpaperTable'	=> function ($sm) {
							$tableGateway	= $sm->get('CertifiedpaperTableGateway');
							return new \Admin\Model\CertifiedpaperTable($tableGateway);
						},
						'StaffTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Staff());
							return new TableGateway(TABLE_STAFF, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\StaffTable'	=> function ($sm) {
							$tableGateway	= $sm->get('StaffTableGateway');
							return new \Admin\Model\StaffTable($tableGateway);
						},
						'PositionTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Position());
							return new TableGateway(TABLE_POSITION, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\PositionTable'	=> function ($sm) {
							$tableGateway	= $sm->get('PositionTableGateway');
							return new \Admin\Model\PositionTable($tableGateway);
						},
						'ChangingtypeTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Changingtype());
							return new TableGateway(TABLE_CHANGING_TYPE, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\ChangingtypeTable'	=> function ($sm) {
							$tableGateway	= $sm->get('ChangingtypeTableGateway');
							return new \Admin\Model\ChangingtypeTable($tableGateway);
						},
						'BusinessfieldTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Businessfield());
							return new TableGateway(TABLE_BUSINESS_FIELD, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\BusinessfieldTable'	=> function ($sm) {
							$tableGateway	= $sm->get('BusinessfieldTableGateway');
							return new \Admin\Model\BusinessfieldTable($tableGateway);
						},
						'CareerTableGateway'	=> function ($sm) {
							$adapter			= $sm->get('dbConfig');
							$resultSetPrototype	= new HydratingResultSet();
							$resultSetPrototype->setHydrator(new ObjectProperty());
							$resultSetPrototype->setObjectPrototype(new \Zendvn\Model\Entity\Career());
							return new TableGateway(TABLE_CAREER, $adapter, null, $resultSetPrototype);
						},
						'Admin\Model\CareerTable'	=> function ($sm) {
							$tableGateway	= $sm->get('CareerTableGateway');
							return new \Admin\Model\CareerTable($tableGateway);
						},
				),
		);
	}

	public function getViewHelperConfig(){
		return array(
				'invokables'	=> array(
						'cmsLinkSort'				=> '\Zendvn\View\Helper\CmsLinkSort',
						'cmsInfoPrice'				=> '\Zendvn\View\Helper\CmsInfoPrice',
						'cmsInfoUser'				=> '\Zendvn\View\Helper\CmsInfoUser',
						'cmsInfoAuthor'				=> '\Zendvn\View\Helper\CmsInfoAuthor',
						'cmsLinkAdmin'				=> '\Zendvn\View\Helper\CmsLinkAdmin',
						'cmsButtonStatus'			=> '\Zendvn\View\Helper\CmsButtonStatus',
						'CmsButtonShow'				=> '\Zendvn\View\Helper\CmsButtonShow',
						'CmsButtonMenu'				=> '\Zendvn\View\Helper\CmsButtonMenu',
						'cmsButtonGroupACP'			=> '\Zendvn\View\Helper\CmsButtonGroupACP',
						'cmsButtonSpecial'			=> '\Zendvn\View\Helper\CmsButtonSpecial',
						'cmsButtonMove'				=> '\Zendvn\View\Helper\CmsButtonMove',
						'cmsButtonToolbar'			=> '\Zendvn\View\Helper\CmsButtonToolbar',
						'CmsButtonToolbarDelete'	=> '\Zendvn\View\Helper\CmsButtonToolbarDelete',
						'zvnFormHidden'				=> '\Zendvn\Form\View\Helper\FormHidden',
						'zvnFormSelect'				=> '\Zendvn\Form\View\Helper\FormSelect',
						'zvnFormInput'				=> '\Zendvn\Form\View\Helper\FormInput',
						'zvnFormButton'				=> '\Zendvn\Form\View\Helper\FormButton',						
				),
		);
	}

}