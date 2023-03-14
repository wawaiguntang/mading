<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'document';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/document_model', 'document');
        if (isLogin() == false) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You must login first!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
            die();
        }
    }
    public function list()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RDOCUMENT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $rr = $this->document->get_all();
        $document = build($rr, 0, 'documentCode', 'documentParent');

        $this->viewTree($document);
        $data['status'] = TRUE;
        $data['document'] = '<ul class="wtree">' . $this->html . '</ul>';
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function updateDesc()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UDOCUMENT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;

            $profile = getProfileWeb();

            $this->form_validation->set_rules('description', 'Description', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'description'     => form_error('description')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $profile['document'] = $this->input->post('description');
                //Encode the array back into a JSON string.
                $json = json_encode($profile, TRUE);
                $up = file_put_contents(path_by_os(APPPATH . '/setting/profile_web.json'), $json);

                if ($up) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to update document";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to update document";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public $html = '';
    public function viewTree($arr)
    {
        $userPermission = getPermissionFromUser();
        foreach ($arr as $k => $v) {
            if (isset($v['children'])) {
                $this->html .= '<li>
                            <span>' . $v['name'] . ' ' . ((in_array('UDOCUMENT', $userPermission)) ? '<a class="a-spa" href="' . base_url('document/index/edit/' . $v['documentCode']) . '"><i class="ri-edit-2-line ri-lg text-warning mx-1" role="button" title="Update"></i></a>' : '') . ' ' . ((in_array('UDOCUMENT', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" role="button" title="Delete" onclick="deleteData(' . $v['documentCode'] . ')"></i>' : '') . '</span>
                            <ul>';
                $this->viewTree($v['children']);
                $this->html .= '
                            </ul>
                        </li>';
            } else {
                $this->html .= '<li>
                            <span>' . $v['name'] . ' ' . ((in_array('UDOCUMENT', $userPermission)) ? '<a class="a-spa" href="' . base_url('document/index/edit/' . $v['documentCode']) . '"><i class="ri-edit-2-line ri-lg text-warning mx-1" role="button" title="Update"></i></a>' : '') . ' ' . ((in_array('UDOCUMENT', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" role="button" title="Delete" onclick="deleteData(' . $v['documentCode'] . ')"></i>' : '') . '</span>
                        </li>';
            }
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('slug', 'URL', 'trim|required');
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
            $this->validation_for = 'add';
            $data = array();
            $data['status'] = TRUE;

            $this->_validate();

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'name' => form_error('name'),
                    'slug' => form_error('slug'),
                    'documentParent' => form_error('documentParent'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                if (!isset($_FILES['file']) || $_FILES['file']['name'] == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => 'PDF harus diisi'
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
                $insert = array(
                    'name' => $this->input->post('name'),
                    'slug' => $this->input->post('slug'),
                    'documentParent' => ($this->input->post('documentParent') == NULL ? '0' : $this->input->post('documentParent')),
                );
                $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                $config['upload_path']          = path_by_os(FCPATH . 'assets/front/pdf/');
                $config['allowed_types']        = 'pdf';
                $config['file_name']            = $file_name;
                $config['overwrite']            = true;
                $config['max_size']             = 10240;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('file')) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => 'PDF gagal di upload'
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $uploaded_data = $this->upload->data();
                    $insert['file'] = $uploaded_data['file_name'];
                }
                $insert = $this->document->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add document";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add document";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UDOCUMENT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('documentCode') == '' || $this->input->post('documentCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID document is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $document = $this->document->get_by_id($this->input->post('documentCode'));
                if ($document == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Document not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'name' => form_error('name'),
                            'slug' => form_error('slug'),
                            'documentParent' => form_error('documentParent'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $insert = array(
                            'name' => $this->input->post('name'),
                            'slug' => $this->input->post('slug'),
                            'documentParent' => ($this->input->post('documentParent') == NULL ? '0' : $this->input->post('documentParent')),
                        );
                        if (!isset($_FILES['file']) || $_FILES['file']['name'] == NULL) {
                            $insert['file'] = $document['file'];
                        } else {


                            $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                            $config['upload_path']          = path_by_os(FCPATH . 'assets/front/pdf/');
                            $config['allowed_types']        = 'pdf';
                            $config['file_name']            = $file_name;
                            $config['overwrite']            = true;
                            $config['max_size']             = 10240;

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('file')) {
                                $data = array(
                                    'status'         => FALSE,
                                    'message'         => 'PDF gagal di upload'
                                );
                                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                            } else {
                                $uploaded_data = $this->upload->data();
                                $insert['file'] = $uploaded_data['file_name'];
                            }
                        }

                        $up = $this->document->update(array('documentCode' => $this->input->post('documentCode')), $insert);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update document";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update document";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }

    public function delete($documentCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DDOCUMENT', $userPermission)) {
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
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $document = $this->document->get_by_id($documentCode);
                if ($document == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Document not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $del = $this->document->delete_by_id($documentCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete document";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete document";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
}
