<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'article';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/article_model', 'article');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RARTICLE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'userPermission' => $userPermission
        ];
        $data['status'] = TRUE;
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Article"
            ]
        ], 'Data Article');
        $data['_view'] = $this->module . '/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CARTICLE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {

            $data['status'] = TRUE;
            $params = [
                'titlePage' => 'Add Data',
                'articleCode' => NULL,
                'title' => NULL,
                'categoryCode' => '',
                'category' => [
                    '1' => 'Berita',
                    '2' => 'Kegiatan'
                ],
                'content' => '',
                'tags' => []
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Artikel",
                    "url" => base_url('article/index')
                ],
                [
                    "text" => "Add Artikel"
                ]
            ], 'Add Artikel');
            $data['_view'] = $this->module . '/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $articleCode = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UARTICLE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($articleCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID article is required"
                );
            } else {
                $article = $this->article->get_by_id($articleCode);
                if ($article == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $tags = $this->db->join('tag as t', 't.tagCode=at.tagCode')
                        ->order_by('at.tagCode', 'desc')->limit(5, 0)
                        ->get_where('article_tag as at', [
                            'at.deleteAt' => NULL,
                            'at.articleCode' => $article['articleCode']
                        ])->result_array();
                    $params = [
                        'titlePage' => 'Add Data',
                        'articleCode' => $article['articleCode'],
                        'title' => $article['title'],
                        'categoryCode' => $article['categoryCode'],
                        'category' => [
                            '1' => 'Berita',
                            '2' => 'Kegiatan'
                        ],
                        'content' => $article['content'],
                        'tags' => $tags
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Artikel",
                            "url" => base_url('article/index')
                        ],
                        [
                            "text" => "Edit Artikel"
                        ]
                    ], 'Edit Artikel');
                    $data['_view'] = $this->module . '/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
