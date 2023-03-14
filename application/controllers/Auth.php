<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();

        visitor();
    }
    public function index()
    {
        $user = $this->session->userdata('userCode');
        if($user != NULL){
            redirect('dokumen');
        }
        $data = [];
        $this->load->view('signin', $data);
    }

    public function act_login()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === TRUE) {
			$data = $this->db->get_where('user', ['deleteAt' => NULL, 'isActive' => 1, 'email' => $this->input->post('email')])->row_array();
			if ($data == NULL) {
				$this->session->set_flashdata('emailErr', 'email tidak ditemukan');
				redirect('auth/index');
			} else {
				if (password_verify($this->input->post('password'), $data['password'])) {
					$this->session->set_userdata([
						'userCode' => $data['userCode'],
						'name' => $data['name']
					]);
					redirect('dokumen');
				} else {
					$this->session->set_flashdata('passwordErr', 'password salah');
					redirect('auth/index');
				}
			}
		} else {
			redirect('auth/index');
		}
	}
}