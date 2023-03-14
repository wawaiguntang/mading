<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'service';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/service_model', 'service');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RSERVICE', $userPermission)) {
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
                "text" => "Layanan"
            ]
        ], 'Data Layanan');
        $data['_view'] = $this->module . '/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CSERVICE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Add Data',
                'serviceCode' => NULL,
                'name' => NULL,
                'url' => NULL,
                'image' => NULL,
                'description' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Layanan",
                    "url" => base_url('service/index')
                ],
                [
                    "text" => "Add Layanan"
                ]
            ], 'Add Layanan');
            $data['_view'] = $this->module . '/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $serviceCode = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('USERVICE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($serviceCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID service is required"
                );
            } else {
                $service = $this->service->get_by_id($serviceCode);
                if ($service == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'serviceCode' => $service->serviceCode,
                        'name' => $service->name,
                        'url' => $service->url,
                        'image' => $service->image,
                        'description' => $service->description,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Layanan",
                            "url" => base_url('service/index')
                        ],
                        [
                            "text" => "Edit Layanan"
                        ]
                    ], 'Edit Layanan');
                    $data['_view'] = $this->module . '/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
