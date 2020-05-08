<?php  

Class Pembayaran extends CI_Controller{

	public function index()
	{
		$data['tbl_barang'] = $this->model_barang->tampil_data()->result();
		$this->load->view ('templates/header');
		$this->load->view ('templates/sidebar');
		$this->load->view ('dashboard', $data);
		$this->load->view ('templates/footer');
		
	}

	public function proses_pembayaran()
	{
		$this->load->view ('dashboard/templates/header');
		$this->load->view ('dashboard/templates/sidebar');
		$this->load->view ('pembayaran');
		$this->load->view ('dashboard/templates/footer');
	}
	
	public function proses_pesanan()
	{
		$this->load->view ('dashboard/templates/header');
		$this->load->view ('dashboard/templates/sidebar');
		$this->load->view ('proses_pesanan');
		$this->load->view ('dashboard/templates/footer');
	}
}