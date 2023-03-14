<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article/article_model', 'article');
        $this->load->database();
        visitor();
    }
    public function index()
    {
        // $data['article'] = $this->article->get_all();
        $data['_view'] = 'berita';
        $this->load->view('layouts/front/main', $data);
    }

    public function list()
    {
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

        $data['status'] = TRUE;
        $data['data'] = $berita;
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    var $table = 'article';
    var $column_search = array('title', 'content'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('articleCode' => 'asc'); // default order 


    private function _get_article()
    {
        $categoryCode = $this->input->post('categoryCode');
        $search = $this->input->post('search');
        $page = $this->input->post('page');

        $this->db
            ->select('*, article.createAt as created')
            ->from($this->table)
            ->join('category', 'category.categoryCode=article.categoryCode')
            ->join('user', 'user.userCode=article.userCode')
            ->where($this->table . '.deleteAt', NULL);
        if ($categoryCode != '0') {
            $this->db->where([
                'category.categoryCode' => $categoryCode
            ]);
        }
        $i = 0;

        foreach ($this->column_search as $item) {
            if ($search != '') {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                } else {
                    $this->db->or_like($item, $search);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if ($page == 1) {
            $this->db->limit(6, 0);
        } else {
            $this->db->limit(6, (($page * 6) - 7));
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_all()
    {
        $this->db->from($this->table)->where('deleteAt', NULL);
        return $this->db->count_all_results();
    }

    public function detail($slug = '')
    {
        if ($slug == '') {
            redirect('berita-dan-kegiatan');
        }
        $article = $this->article->get_by_slug($slug);
        if ($article == NULL) {
            redirect('berita-dan-kegiatan');
        }

        $data['tag'] = $this->db->join('tag as t', 't.tagCode=at.tagCode')->get_where('article_tag as at', [
            'at.deleteAt' => NULL,
            'articleCode' => $article['articleCode']
        ])->result_array();

        $data['tags'] = $this->db->join('tag as t', 't.tagCode=at.tagCode')
            ->order_by('at.tagCode', 'desc')->limit(5, 0)
            ->get_where('article_tag as at', [
                'at.deleteAt' => NULL
            ])->result_array();

        $category = $this->db
            ->select('*')
            ->order_by('category.categoryCode', 'desc')->limit(5, 0)
            ->get_where('category', [
                'category.deleteAt' => NULL
            ])->result_array();
        
        $tCategory = [];
        foreach($category as $k => $v){
            $temp = $v;
            $temp['total'] = count($this->db->get_where('article',[
                'deleteAt' => NULL,
                'categoryCode' => $v['categoryCode']
            ])->result_array());
            
            $tCategory[] = $temp;
        }
        $data['category'] = $tCategory;

        $data['terkait'] = $this->db
            ->select('*,article.createAt as created')
            ->from('article')
            ->join('category', 'category.categoryCode=article.categoryCode')
            ->join('user', 'user.userCode=article.userCode')
            ->order_by('article.articleCode', 'desc')->limit(4, 0)
            ->where('article.deleteAt', NULL)
            ->where('article.categoryCode', $article['categoryCode'])
            ->where('article.articleCode !=', $article['articleCode'])
            ->get()->result_array();

        $data['article'] = $article;
        $data['_view'] = 'berita_detail';
        $this->load->view('layouts/front/main', $data);
    }
}
