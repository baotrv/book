<?php
return array(
	'db' => array(
			'driver' 	=> 'Pdo_Mysql',            
// 			'database' 	=> 'ct_pro',
			'charset' 	=> 'utf8',
	        //'hostname'	=> 'localhost',		// www.zend.vn
	        
            //'dsn' => 'mysql:host=localhost;dbname=vic_hoiphunu_test',
	       'dsn' => 'mysql:host=192.168.1.104;dbname=ct_pro',
            'driver_options' => array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ),
	),
	
	'service_manager'	=> array(
			'factories'	=> array(
				'Zend\Db\Adapter\Adapter'	=> 'Zend\Db\Adapter\AdapterServiceFactory',
			),
			'aliases' => array(
				'dbConfig'					=> 'Zend\Db\Adapter\Adapter',
			),
	)
);
