<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'cover';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/cover_model', 'cover');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RINFORMATIONLOBBY', $userPermission)) {
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
                "text" => "Information Lobby"
            ]
        ], 'Data Cover');
        $data['_view'] = $this->module . '/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CINFORMATIONLOBBY', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Add Data',
                'coverCode' => NULL,
                'name' => NULL,
                'image' => NULL,
                'description' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Information Lobby",
                    "url" => base_url('cover/index')
                ],
                [
                    "text" => "Add Cover"
                ]
            ], 'Add Cover');
            $data['_view'] = $this->module . '/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $coverCode = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UINFORMATIONLOBBY', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($coverCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID cover is required"
                );
            } else {
                $cover = $this->cover->get_by_id($coverCode);
                if ($cover == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'coverCode' => $cover->coverCode,
                        'name' => $cover->name,
                        'image' => $cover->image,
                        'description' => $cover->description,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Information Lobby",
                            "url" => base_url('cover/index')
                        ],
                        [
                            "text" => "Edit Cover"
                        ]
                    ], 'Edit Cover');
                    $data['_view'] = $this->module . '/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
