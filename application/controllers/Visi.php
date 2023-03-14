<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Visi extends CI_Controller
{
    public function __construct()
    {
        
        parent::__construct();
        visitor();
    }
    public function index()
    {
        $profile = getProfileWeb();
        $data['visi'] = $profile['visi'];
        $data['misi'] = $profile['misi'];
        $data['_view'] = 'visi';
        $this->load->view('layouts/front/main', $data);
    }
}
