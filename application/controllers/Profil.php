<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('profile/profile_model', 'profile');
        visitor();
    }
    public function index()
    {
        $data['profile'] = $this->profile->get_all();
        $data['_view'] = 'profil';
        $this->load->view('layouts/front/main', $data);
    }
}
