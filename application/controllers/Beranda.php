<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('article/article_model', 'article');
        $this->load->model('service/service_model', 'service');
        $this->load->database();
        visitor();
    }
    public function index()
    {
        $profile = getProfileWeb();
        $berita = [];
        foreach ($this->_get_article() as $k => $v) {
            $temp = $v;
            $temp['password'] = '';
            $temp['tags'] = $this->db->join('tag as t', 't.tagCode=at.tagCode')->get_where('article_tag as at', [
                'at.deleteAt' => NULL,
                'articleCode' => $v['articleCode']
            ])->result_array();
            $temp['created'] = tanggal_indo($v['created']);
            $temp['content'] = substr(strip_tags($v['content']), 0, 250);
            $berita[] = $temp;
        }

        $data['service'] = $this->service->get_all();
        $data['kegiatan'] = $berita;
        $data['_view'] = 'beranda';
        $this->load->view('layouts/front/main', $data);
    }


    var $table = 'article';
    var $column_search = array('title', 'content'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('articleCode' => 'desc'); // default order 

    private function _get_article()
    {
        $this->db
            ->select('*, article.createAt as created')
            ->from($this->table)
            ->join('category', 'category.categoryCode=article.categoryCode')
            ->join('user', 'user.userCode=article.userCode')
            ->where($this->table . '.deleteAt', NULL)
            ->where($this->table . '.categoryCode', '2');
    
        $this->db->limit(3, 0);
        $query = $this->db->get();
        return $query->result_array();
    }
}
