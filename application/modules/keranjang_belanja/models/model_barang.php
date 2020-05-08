<?php

class Model_barang extends CI_Model{
	public function tampil_data(){
		return $this->db->get('tbl_barang');
	$this->load->library('pagination'); // Load librari paginationnya
 	$query = "SELECT * FROM tbl_barang"; // Query untuk menampilkan semua data siswa
			 $config['base_url'] = base_url('keranjang_belanja/index.php');
			 $config['total_rows'] = $this->db->query($query)->num_rows();
			 $config['per_page'] = 5;
			 $config['uri_segment'] = 3;
			 $config['num_links'] = 3;
 // Style Pagination
 // Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
			$config['full_tag_open'] = '<ul class="pagination pagination-sm m-t-xs m-b-xs">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';

			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			$config['next_link'] = ' <i class="glyphicon glyphicon-menu-right"></i> ';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';

			$config['prev_link'] = ' <i class="glyphicon glyphicon-menu-left"></i> ';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['num_tag_open'] = '<li>';
 			$config['num_tag_close'] = '</li>';
 // End style pagination

$this->pagination->initialize($config); // Set konfigurasi paginationnya
	$page = ($this->uri->segment($config['uri_segment'])) ?
$this->uri->segment($config['uri_segment']) : 0;
 	$query .= " LIMIT ".$page.", ".$config['per_page'];
 	$data['limit'] = $config['per_page'];
 	$data['total_rows'] = $config['total_rows'];
 	$data['pagination'] = $this->pagination->create_links(); //Generate link pagination nya sesuai config diatas
 	$data['tbl_barang'] = $this->db->query($query)->result();
 	return $data;
 }


	public function tambah_barang($data,$table){
		$this->db->insert($table, $data);
		
	}

	public function edit_barang($where,$table){
		return $this->db->get_where($table,$where);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function find($id)
	{
		$result = $this->db->where('id_brg', $id)
						   ->limit(1)
						   ->get('tbl_barang');
		if($result->num_rows() > 0){
			return $result->row();
		}else{
			return array();
		}
	}

	public function detail_brg($id_brg)
	{
		$result = $this->db->where('id_brg',$id_brg)->get('tbl_barang');
		if($result->num_rows() > 0){
			return $result->result();
		}else {
			return false;
		}
	}
}