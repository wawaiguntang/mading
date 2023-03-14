<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Display extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function lobby()
    {
        $this->load->view('display/lobby', []);
    }
}
