<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'structure';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/structure_model', 'structure');
    }

    public function index()
    {
        $profile = getProfileWeb();
        $userPermission = getPermissionFromUser();
        if (!in_array('RSTRUCTURE', $userPermission)) {
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
                "text" => "Struktur"
            ]
        ], 'Data Struktur');
        $params['description'] = $profile['structure'];
        $data['_view'] = $this->module . '/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CSTRUCTURE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $parent = [
                '0' => 'Rujukan'
            ];
            $p = $this->structure->get_all();
            foreach ($p as $k => $v) {
                $parent[$v['structureCode']] = $v['name'];
            }
            $params = [
                'title' => 'Add Data',
                'structureCode' => NULL,
                'name' => NULL,
                'title' => NULL,
                'structureParent' => '',
                'parent' => $parent
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Struktur",
                    "url" => base_url('structure/index')
                ],
                [
                    "text" => "Add Struktur"
                ]
            ], 'Add Struktur');
            $data['_view'] = $this->module . '/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $structureCode = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('USTRUCTURE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($structureCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID structure is required"
                );
            } else {
                $structure = $this->structure->get_by_id($structureCode);
                if ($structure == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Document not found!"
                    );
                } else {
                    $parent = [
                        '0' => 'Rujukan'
                    ];
                    $p = $this->structure->get_all();
                    foreach ($p as $k => $v) {
                        if($v['structureCode'] != $structureCode){
                            $parent[$v['structureCode']] = $v['name'];
                        }
                    }
                    $params = [
                        'title' => 'Edit Data',
                        'structureCode' => $structure['structureCode'],
                        'name' => $structure['name'],
                        'title' => $structure['title'],
                        'structureParent' => $structure['structureParent'],
                        'parent' => $parent
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Struktur",
                            "url" => base_url('structure/index')
                        ],
                        [
                            "text" => "Edit Struktur"
                        ]
                    ], 'Edit Struktur');
                    $data['_view'] = $this->module . '/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
