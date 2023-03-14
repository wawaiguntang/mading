<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'profile';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/profile_model', 'profile');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RPO', $userPermission)) {
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
                "text" => "Profil Pejabat Struktural"
            ]
        ], 'Data Profil Pejabat Struktural');
        $data['_view'] = $this->module . '/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPO', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'titlePage' => 'Add Data',
                'poCode' => NULL,
                'name' => NULL,
                'title' => NULL,
                'image' => NULL,
                'fb' => NULL,
                'yt' => NULL,
                'ig' => NULL,
                'tw' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Profil Pejabat Struktural",
                    "url" => base_url('profile/index')
                ],
                [
                    "text" => "Add Profil Pejabat Struktural"
                ]
            ], 'Add Profil Pejabat Struktural');
            $data['_view'] = $this->module . '/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $poCode = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UPO', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($poCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID profile is required"
                );
            } else {
                $profile = $this->profile->get_by_id($poCode);
                if ($profile == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $params = [
                        'titlePage' => 'Edit Data',
                        'poCode' => $profile->poCode,
                        'name' => $profile->name,
                        'title' => $profile->title,
                        'image' => $profile->image,
                        'fb' => $profile->fb,
                        'yt' => $profile->yt,
                        'ig' => $profile->ig,
                        'tw' => $profile->tw,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Profil Pejabat Struktural",
                            "url" => base_url('profile/index')
                        ],
                        [
                            "text" => "Edit Profil Pejabat Struktural"
                        ]
                    ], 'Edit Profil Pejabat Struktural');
                    $data['_view'] = $this->module . '/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
