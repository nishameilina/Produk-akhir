<?php  

Class Dashboard extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('m_dashboard', 'md');

		if($this->session->userdata('role_id') != '2' ){
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
		$config['base_url'] = base_url('dashboard/index');
		$config['total_rows'] = $this->db->count_all('tbl_barang'); //total row
        $config['per_page'] = 3;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = '&raquo;';
        $config['prev_link']        = '&laquo;';
        $config['full_tag_open']    = '<ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = ' <li>';
        $config['next_tagl_close']  = '</li>';
        $config['prev_tag_open']    = ' <li>';
        $config['prev_tagl_close']  = '</li>';
        $config['first_tag_open']   = ' <li>';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open']    = ' <li>';
        $config['last_tagl_close']  = '</li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['data'] = $this->md->tampil_data($config["per_page"], $data['page']);           
 
        $data['paging'] = $this->pagination->create_links();

		//$data['tbl_barang'] = $this->m_dashboard->tampil_data()->result();
		$this->load->view ('templates/header');
		$this->load->view ('templates/sidebar');
		$this->load->view ('dashboard', $data);
		$this->load->view ('templates/footer');
	}
}