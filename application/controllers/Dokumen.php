<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('document/document_model', 'document');
        visitor();
    }
    public function index()
    {
        $rr = $this->document->get_all();
        $document = build($rr, 0, 'documentCode', 'documentParent');

        $this->viewTree($document);
        $data['document'] = $this->html;

        $data['_view'] = 'dokumen';
        $this->load->view('layouts/front/main', $data);
    }

    public $html = '';
    public function viewTree($arr)
    {
        foreach ($arr as $k => $v) {
            if (isset($v['children'])) {
                $this->html .= '<li>
                            <a href="#">' . $v['name'] . '</a>
                            <ul>';
                $this->viewTree($v['children']);
                $this->html .= '
                            </ul>
                        </li>';
            } else {
                $this->html .= '<li>
                            <a href="' . base_url('dokumen/' . $v['slug']) . '">' . $v['name'] . '</a>
                        </li>';
            }
        }
    }

    public function detail($slug = '')
    {
        (isLogin() == false) ? redirect('auth/index') : '';
        if ($slug == '') {
            redirect('dokumen');
        }
        $dokumen = $this->document->get_by_slug($slug);
        if ($dokumen['status']) {
            $data['dokumen'] = $dokumen['data'];
            $this->downToUp($dokumen['data']);
        } else {
            redirect('dokumen');
        }

        $re = array_reverse($this->nameArr);

        $data['name'] = implode(' ', $re);
        $data['_view'] = 'dokumen_detail';
        $this->load->view('layouts/front/main', $data);
    }

    public $nameArr = [];
    public function downToUp($data)
    {
        $this->nameArr[] = $data['name'];
        if ($data['documentParent'] != '0') {
            $d = $this->document->get_by_id($data['documentParent']);
            $this->downToUp($d);
        }
    }
}
