<?php
	/* by author trangngocduclt@gmail.com
	 * 30/07/2015
	 * định nghĩa(definitions) hằng số(constant) cho ứng dụng(application)
	 * constant definitions for the application
	 */
	define('BOOKONLINE_KEY', 'hkjsdsi');
	define('URL_FRIENDLY', true);

	// Đường dẫn thư mục chứa ứng dụng
	define('PATH_APPLICATION', realpath(dirname(__DIR__)));
	
	// Đường dẫn thư mục chứa thư viện
	define('PATH_LIBRARY', PATH_APPLICATION . '/library');
	
	// Đường dẫn thư mục chứa vendor
	define('PATH_VENDOR', PATH_APPLICATION . '/vendor');
	define('HTMLPURIFIER_PREFIX', PATH_VENDOR);
	
	// Đường dẫn thư mục public
	define('PATH_PUBLIC', PATH_APPLICATION . '/public');
	
	// Đường dẫn thư mục captcha
	define('PATH_CAPTCHA', PATH_PUBLIC . '/captcha');
	
	// Đường dẫn thư mục template
	define('PATH_TEMPLATE', PATH_PUBLIC . '/template');
	
	// Đường dẫn thư mục files
	define('PATH_FILES', PATH_PUBLIC . '/files');
	
	// Đường dẫn thư mục scripts
	define('PATH_SCRIPTS', PATH_PUBLIC . '/scripts');
	
	//LINK TO FOLDERS
	define('URL_APPLICATION', 'http://localhost:81/Trithuc_Team01/bookonline');
	define('URL_PUBLIC', URL_APPLICATION . '/public');
	define('URL_TEMPLATE', URL_PUBLIC . '/template');
	define('URL_FILES', URL_PUBLIC . '/files');
	define('URL_SCRIPTS', URL_PUBLIC . '/scripts');
	
	// TABLE NAME
	define('TABLE_PREFIX'						, '');
	define('TABLE_GROUP'						, TABLE_PREFIX . 'group');
	define('TABLE_USER'							, TABLE_PREFIX . 'user');
	define('TABLE_NESTED'						, TABLE_PREFIX . 'nested');
	define('TABLE_CATEGORY'						, TABLE_PREFIX . 'category');
	define('TABLE_BOOK'							, TABLE_PREFIX . 'book');
	define('TABLE_SLIDER'						, TABLE_PREFIX . 'slider');
	define('TABLE_PERMISSION'					, TABLE_PREFIX . 'permission');
	define('TABLE_CART'							, TABLE_PREFIX . 'cart');
	define('TABLE_SYSFUNCTION'					, TABLE_PREFIX . 'sysfunction');
	define('TABLE_NGUOIDUNG'					, TABLE_PREFIX . 'nguoidung');
	define('TABLE_PROVINCE'						, TABLE_PREFIX . 'province');
	define('TABLE_CITIZEN'						, TABLE_PREFIX . 'citizen');
	define('TABLE_COUNTRY'						, TABLE_PREFIX . 'country');
	define('TABLE_COMPONENT_PROFILES'			, TABLE_PREFIX . 'component_profiles');
	define('TABLE_GRANTING_AGENCIES'			, TABLE_PREFIX . 'granting_agencies');
	define('TABLE_VISA_OFFICES'					, TABLE_PREFIX . 'visa_offices');
	define('TABLE_CERTIFIED_PAPER'				, TABLE_PREFIX . 'certified_paper');
	define('TABLE_STAFF'						, TABLE_PREFIX . 'staff');
	define('TABLE_POSITION'						, TABLE_PREFIX . 'position');
	define('TABLE_CHANGING_TYPE'				, TABLE_PREFIX . 'changing_type');
	define('TABLE_BUSINESS_FIELD'				, TABLE_PREFIX . 'business_field');
	define('TABLE_CAREER'						, TABLE_PREFIX . 'career');
	
	//TÊN CHỨC NĂNG
	define('ENUM_ADD', 'Thêm'); //Thêm - Add - Create
	define('ENUM_ORDERING', 'Cập nhật'); //Cập nhật - Ordering - Update
	define('ENUM_DELETE', 'Xóa'); //Xóa - Delete - Drop
	define('ENUM_ACTIVE', 'Hoạt động'); //Hoạt động - Active - 
	define('ENUM_INACTIVE', 'Không hoạt động'); //Không hoạt động - inActive - 
	define('ENUM_SAVE', 'Lưu'); //Lưu - Save -
	define('ENUM_SAVE_CLOSE', 'Lưu & Đóng'); //Lưu & Đóng - Save & Close -
	define('ENUM_SAVE_NEW', 'Lưu & Thêm'); //Lưu & Thêm - Save & New -
	define('ENUM_CANCEL', 'Hủy'); //Hủy - Cancel -
	
	
	
	
	
	
	
	
	
	
	