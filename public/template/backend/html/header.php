<?php 
	$aliasName	= array(
		'controller'	=> array(
					'group'					=> 'Quản lý nhóm',		
					'user'					=> 'Quản lý người dung',		
					'category'				=> 'Quản lý sản phẩm',		
					'book'					=> 'Quản lý sách',		
					'cart'					=> 'Quản lý xe',		
					'index'					=> 'Bảng điều khiển',		
					'config'				=> 'Cấu hình',		
					'slider'				=> 'Quản lý Slider',
					'permission'			=> 'Quản lý phân quyền',
					'sysfunction'			=> 'Quản lý Chức năng',
				    'province'				=> 'Quản lý địa danh',
					'citizen'				=> 'Quản lý dân tộc',
					'country'				=> 'Quản lý quốc tịch',
					'componentprofiles'		=> 'Quản lý thành phần hồ sơ',
					'grantingagencies'		=> 'Quản lý cơ quan cấp',
					'visaoffices'			=> 'Quản lý cơ quan cấp giấy',
					'certifiedpaper'		=> 'Quản lý loại giấy chứng nhận',
					'staff'					=> 'Quản lý cán bộ',
					'position'				=> 'Quản lý chức vụ',
					'changingtype'			=> 'Quản lý loại thay đổi',
					'businessfield'			=> 'Quản lý lĩnh vực kinh doanh',
					'career'				=> 'Quản lý ngành nghề',
		),
		'action'		=> array(
				'index'		=> 'Danh sách', //'List',
				'info'		=> 'Thông tin', //'Info',
				'add'		=> 'Thêm', 		//'Add',
				'edit'		=> 'Sửa', 		//'Edit',
				'delete'	=> 'Xóa', 		//'Delete',
				'email'		=> 'Email',
				'image'		=> 'Image',
		)
	);
	
	$headerNameParent	= $aliasName['controller'][$this->controller];
	
	if ([$this->action][0] != 'form'){
		$headerNameChild	=$aliasName['action'][$this->action];
	}else {
		$headerNameChild	= '';
	}
	
	$xhtmlHeader	= sprintf('<h1>%s <small>%s</small></h1>', $headerNameParent, $headerNameChild);
	
	
	$xhtmlBreadcrumb		= '';
	if($this->controller != 'index'){
		if($this->action == 'index'){
			$xhtmlBreadcrumb	= sprintf('<li class="active">%s</li><li class="active">%s</li>', $headerNameParent, $headerNameChild);
		}else{
			$xhtmlBreadcrumb	= sprintf('<li class="active"><a href="%s">%s</a></li><li class="active">%s</li>',
											$this->url('adminRoute/default', array('controller' => $this->arrParams['controller'], 'action' => 'index')),
											$headerNameParent, $headerNameChild);
		}
	} 
?>

<!-- HEADER -->
<?php echo $xhtmlHeader; ?>

<!-- BREADCRUMB -->
<!-- 
<ol class="breadcrumb">
	<li><a href="<?php echo $this->url('adminRoute');?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<?php echo $xhtmlBreadcrumb;?>
</ol>
 -->