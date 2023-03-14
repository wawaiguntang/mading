<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'document';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/document_model', 'document');
    }

    public function index()
    {
        $profile = getProfileWeb();
        $userPermission = getPermissionFromUser();
        if (!in_array('RDOCUMENT', $userPermission)) {
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
                "text" => "Dokumen"
            ]
        ], 'Data Dokumen');
        $params['description'] = $profile['document'];
        $data['_view'] = $this->module . '/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CDOCUMENT', $userPermission)) {
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
            $p = $this->document->get_all();
            foreach ($p as $k => $v) {
                $parent[$v['documentCode']] = $v['name'];
            }
            $params = [
                'title' => 'Add Data',
                'documentCode' => NULL,
                'name' => NULL,
                'slug' => NULL,
                'file' => NULL,
                'documentParent' => '',
                'parent' => $parent
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Dokumen",
                    "url" => base_url('document/index')
                ],
                [
                    "text" => "Add Dokumen"
                ]
            ], 'Add Dokumen');
            $data['_view'] = $this->module . '/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $documentCode = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UDOCUMENT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($documentCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID document is required"
                );
            } else {
                $document = $this->document->get_by_id($documentCode);
                if ($document == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Document not found!"
                    );
                } else {
                    $parent = [
                        '0' => 'Rujukan'
                    ];
                    $p = $this->document->get_all();
                    foreach ($p as $k => $v) {
                        $parent[$v['documentCode']] = $v['name'];
                    }
                    $params = [
                        'title' => 'Edit Data',
                        'documentCode' => $document['documentCode'],
                        'name' => $document['name'],
                        'file' => $document['file'],
                        'slug' => $document['slug'],
                        'documentParent' => $document['documentParent'],
                        'parent' => $parent
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Dokumen",
                            "url" => base_url('document/index')
                        ],
                        [
                            "text" => "Edit Dokumen"
                        ]
                    ], 'Edit Dokumen');
                    $data['_view'] = $this->module . '/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
