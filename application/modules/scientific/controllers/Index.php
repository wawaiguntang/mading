<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'scientific';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/scientific_model', 'scientific');
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
        ], 'Data Scientific');
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
                'scientificCode' => NULL,
                'name' => NULL,
                'image' => NULL,
                'description' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Information Lobby",
                    "url" => base_url('scientific/index')
                ],
                [
                    "text" => "Add Scientific"
                ]
            ], 'Add Scientific');
            $data['_view'] = $this->module . '/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $scientificCode = '')
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
            if ($scientificCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID scientific is required"
                );
            } else {
                $scientific = $this->scientific->get_by_id($scientificCode);
                if ($scientific == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'scientificCode' => $scientific->scientificCode,
                        'name' => $scientific->name,
                        'image' => $scientific->image,
                        'description' => $scientific->description,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Information Lobby",
                            "url" => base_url('scientific/index')
                        ],
                        [
                            "text" => "Edit Scientific"
                        ]
                    ], 'Edit Scientific');
                    $data['_view'] = $this->module . '/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
