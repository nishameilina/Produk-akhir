<?php  

Class Produk extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('role_id') != '2' ){
			$this->session->set_flashdata('Anda Belum Login','<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Username atau Password Anda Salah!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>');
			redirect('auth/login');

		}
	}
	public function detail($id_brg)
	{
		$data['barang'] = $this->model_barang->detail_brg($id_brg);
		$this->load->view ('dashboard/templates/header');
		$this->load->view ('dashboard/templates/sidebar');
		$this->load->view ('detail_barang', $data);
		$this->load->view ('dashboard/templates/footer');
	}
}