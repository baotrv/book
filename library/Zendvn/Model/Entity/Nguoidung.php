<?php
namespace Zendvn\Model\Entity;

class Nguoidung {
	//Id,ten_nguoi,ngay_sinh,gioi_tinh,cmnd,trang_thai,nghe_nghiep,nhom_nguoi_dung
	public $id;
	public $ten_nguoi;
	public $ngay_sinh;
	public $gioi_tinh;
	public $cmnd;
	public $trang_thai;
	public $nghe_nghiep;
	public $nhom_nguoi_dung_id;

	public function exchangeArray($data){
		$this->id					= (!empty($data['id'])) ? $data['id'] : null;
		$this->ten_nguoi			= (!empty($data['ten_nguoi'])) ? $data['ten_nguoi'] : null;
		$this->ngay_sinh			= (!empty($data['ngay_sinh'])) ? $data['ngay_sinh'] : null;
		$this->gioi_tinh			= (!empty($data['gioi_tinh'])) ? $data['gioi_tinh'] : 0;
		$this->cmnd					= (!empty($data['cmnd'])) ? $data['cmnd'] : null;
		$this->trang_thai			= (!empty($data['trang_thai'])) ? $data['trang_thai'] : 0;
		$this->nghe_nghiep			= (!empty($data['nghe_nghiep'])) ? $data['nghe_nghiep'] : null;
		$this->nhom_nguoi_dung_id	= (!empty($data['nhom_nguoi_dung_id'])) ? $data['nhom_nguoi_dung_id'] : null;

	}
	
	public function getArrayCopy(){
		$result = get_object_vars($this);
		//$result['trang_thai']				= ($result['trang_thai'] == 1) ? 'active' : 'inactive';
		//$result['nhom_nguoi_dung_id']			= $result['nhom_nguoi_dung_id'];
		//unset($result['nhom_nguoi_dung_id']);

		return $result;
	}

}