<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends MX_Controller
{
    private $module = 'barcode';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/supplier_model', 'supplier');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RSUPPLIER', $userPermission)) {
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
                "url" => base_url('barcode/supplier/index')
            ],
            [
                "text" => "Supplier",
            ]
        ], 'Data Supplier');
        $data['_view'] = $this->module . '/supplier/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CSUPPLIER', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Add Data',
                'supplierCode' => NULL,
                'supplier' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Barcode",
                    "url" => base_url('barcode/supplier/index')
                ],
                [
                    "text" => "Supplier",
                    "action" => "backPrevious()"
                ],
                [
                    "text" => "Add Supplier"
                ]
            ], 'Add Supplier');
            $data['_view'] = $this->module . '/supplier/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $supplierCode = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('USUPPLIER', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($supplierCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID supplier is required"
                );
            } else {
                $supplier = $this->supplier->get_by_id($supplierCode);
                if ($supplier == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'supplierCode' => $supplier->supplierCode,
                        'supplier' => $supplier->supplier,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Barcode",
                            "url" => base_url('barcode/supplier')
                        ],
                        [
                            "text" => "Supplier",
                            "action" => "backPrevious()"
                        ],
                        [
                            "text" => "Edit Supplier"
                        ]
                    ], 'Edit Supplier');
                    $data['_view'] = $this->module . '/supplier/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
