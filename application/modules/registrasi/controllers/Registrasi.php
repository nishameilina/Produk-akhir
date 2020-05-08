<?php 

class Registrasi extends CI_Controller{
	public function index()
	{
		$this->form_validation->set_rules('nama','Nama','required',['required' => 'Nama Wajib diisi!'
		]);
		$this->form_validation->set_rules('username','Username','required',['required' => 'username wajib diisi!'
		]);
		$this->form_validation->set_rules('password_1','Password','required|matches[password_2]',['required' => 'password wajib diisi!','matches' => 'password tidak cocok'
		]);
		$this->form_validation->set_rules('password_2','Password','required|matches[password_1]');

		if($this->form_validation->run() == FALSE){
			$this->load->view('dashboard/templates/header');
		$this->load->view('registrasi');
		$this->load->view('dashboard/templates/footer');
		} else {
			$data = array(
				'id'	=> '',
				'nama'	=> $this->input->post('nama'),
				'username'	=> $this->input->post('username'),
				'password'	=> $this->input->post('password_1'),
				'role_id'	=> 2,
			);
			$this->db->insert('tb_user',$data);
			redirect('login/auth/login');
		}
	}
}