<?php

class M_dashboard extends CI_Model{
	public function tampil_data($limit, $start){
		return $this->db->get('tbl_barang', $limit, $start);
 }
}