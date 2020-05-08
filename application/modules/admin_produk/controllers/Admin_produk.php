<?php 

class Admin_produk extends CI_Controller{
public function __construct(){
		parent::__construct();

		if($this->session->userdata('role_id') != '1' ){
			$this->session->set_flashdata('Anda Belum Login','<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Username atau Password Anda Salah!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
			redirect('login/auth/login');

		}
	}
	
	public function index()
	{
		$data['tbl_barang'] = $this->model_barang->tampil_data()->result();

		$this->load->view('admin/templates_admin/header');
		$this->load->view('admin/templates_admin/sidebar');
		$this->load->view('admin_produk/admin_produk', $data);
		$this->load->view('admin/templates_admin/footer');
	}

	public function tambah_aksi()
	{
		$nm_brg			=$this->input->post('nm_brg');
		$kategori			=$this->input->post('kategori');
		$harga		=$this->input->post('harga');
		$keterangan			=$this->input->post('keterangan');
		$stok		=$this->input->post('stok');
		$gambar		=$_FILES['gambar']['name'];
		if ($gambar = ''){}else{
			$config ['upload_path'] = './uploads';
			$config ['allowed_types'] = 'jpg|jpeg|png|gif';

			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('gambar')){
				echo "gambar gagal di upload!";
			}else {
				$gambar=$this->upload->data('file_name');
			}
		}
		
		$data = array (
			'nm_brg'		=>$nm_brg,
			'kategori'		=>$kategori,
			'harga'			=>$harga,
			'keterangan'	=>$keterangan,
			'stok'			=>$stok,
			'gambar'		=>$gambar
		);

		$this->model_barang->tambah_barang($data, 'tbl_barang');
		redirect('admin_produk');

	}

	public function edit($id)
	{
		$where = array('id_brg' =>$id);
		$data['tbl_barang'] = $this->model_barang->edit_barang($where, 'tbl_barang')->result();
		$this->load->view('admin/templates_admin/header');
		$this->load->view('admin/templates_admin/sidebar');
		$this->load->view('edit_barang', $data);
		$this->load->view('admin/templates_admin/footer');
	}

	public function update(){
		$id 			= $this->input->post('id_brg');
		$nm_brg 		= $this->input->post('nm_brg');
		$kategori 		= $this->input->post('kategori');
		$harga			= $this->input->post('harga');
		$keterangan		= $this->input->post('keterangan');
		$stok			= $this->input->post('stok');

		$data = array(

			'nm_brg'		=>$nm_brg,
			'kategori'		=>$kategori,
			'harga'			=>$harga,
			'keterangan'	=>$keterangan,
			'stok'			=>$stok

		);

		$where = array(
			'id_brg' => $id
		);

		$this->model_barang->update_data($where,$data, 'tbl_barang');
		redirect('admin_produk');
	}

	public function hapus ($id)
	{
		$where = array('id_brg' =>$id);
		$this->model_barang->hapus_data($where, 'tbl_barang');
		redirect('admin_produk');
	}
}