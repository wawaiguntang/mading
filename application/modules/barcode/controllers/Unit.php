<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends MX_Controller
{
    private $module = 'barcode';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/unit_model', 'unit');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RUNIT', $userPermission)) {
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
                "text" => "Barcode",
                "url" => base_url('barcode/unit/index')
            ],
            [
                "text" => "Unit",
            ]
        ], 'Data Unit');
        $data['_view'] = $this->module . '/unit/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CUNIT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Add Data',
                'unitCode' => NULL,
                'unit' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Barcode",
                    "url" => base_url('barcode/unit/index')
                ],
                [
                    "text" => "Unit",
                    "action" => "backPrevious()"
                ],
                [
                    "text" => "Add Unit"
                ]
            ], 'Add Unit');
            $data['_view'] = $this->module . '/unit/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $unitCode = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UUNIT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($unitCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID unit is required"
                );
            } else {
                $unit = $this->unit->get_by_id($unitCode);
                if ($unit == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'unitCode' => $unit->unitCode,
                        'unit' => $unit->unit,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Barcode",
                            "url" => base_url('barcode/unit')
                        ],
                        [
                            "text" => "Unit",
                            "action" => "backPrevious()"
                        ],
                        [
                            "text" => "Edit Unit"
                        ]
                    ], 'Edit Unit');
                    $data['_view'] = $this->module . '/unit/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
