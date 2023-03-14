<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends MX_Controller
{
    private $module = 'barcode';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/category_model', 'category');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RCATEGORY', $userPermission)) {
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
                "url" => base_url('barcode/category/index')
            ],
            [
                "text" => "Category",
            ]
        ], 'Data Category');
        $data['_view'] = $this->module . '/category/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CCATEGORY', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Add Data',
                'categoryCode' => NULL,
                'category' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Barcode",
                    "url" => base_url('barcode/category/index')
                ],
                [
                    "text" => "Category",
                    "action" => "backPrevious()"
                ],
                [
                    "text" => "Add Category"
                ]
            ], 'Add Category');
            $data['_view'] = $this->module . '/category/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $categoryCode = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UCATEGORY', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($categoryCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID category is required"
                );
            } else {
                $category = $this->category->get_by_id($categoryCode);
                if ($category == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'categoryCode' => $category->categoryCode,
                        'category' => $category->category,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Barcode",
                            "url" => base_url('barcode/category')
                        ],
                        [
                            "text" => "Category",
                            "action" => "backPrevious()"
                        ],
                        [
                            "text" => "Edit Category"
                        ]
                    ], 'Edit Category');
                    $data['_view'] = $this->module . '/category/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
