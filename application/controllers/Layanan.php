<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('service/service_model', 'service');
        visitor();
    }
    public function index()
    {
        $data['service'] = $this->db->limit(3, 0)->get_where('service', ['deleteAt' => NULL])->result_array();
        $data['_view'] = 'layanan';
        $this->load->view('layouts/front/main', $data);
    }
}
