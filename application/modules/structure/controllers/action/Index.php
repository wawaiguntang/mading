<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'structure';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/structure_model', 'structure');
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
        if (!in_array('RSTRUCTURE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $rr = $this->structure->get_all();
        $structure = build($rr, 0, 'structureCode', 'structureParent');

        $this->viewTree($structure);
        $data['status'] = TRUE;
        $data['structure'] = '<ul class="wtree">' . $this->html . '</ul>';
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function updateDesc()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('USTRUCTURE', $userPermission)) {
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
                $profile['structure'] = $this->input->post('description');
                //Encode the array back into a JSON string.
                $json = json_encode($profile, TRUE);
                $up = file_put_contents(path_by_os(APPPATH . '/setting/profile_web.json'), $json);

                if ($up) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to update structure";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to update structure";
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
                            <span>' . $v['name'] . '|' . $v['title'] . ' ' . ((in_array('USTRUCTURE', $userPermission)) ? '<a class="a-spa" href="' . base_url('structure/index/edit/' . $v['structureCode']) . '"><i class="ri-edit-2-line ri-lg text-warning mx-1" role="button" title="Update"></i></a>' : '') . ' ' . ((in_array('USTRUCTURE', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" role="button" title="Delete" onclick="deleteData(' . $v['structureCode'] . ')"></i>' : '') . '</span>
                            <ul>';
                $this->viewTree($v['children']);
                $this->html .= '
                            </ul>
                        </li>';
            } else {
                $this->html .= '<li>
                            <span>' . $v['name'] . '|' . $v['title'] . ' ' . ((in_array('USTRUCTURE', $userPermission)) ? '<a class="a-spa" href="' . base_url('structure/index/edit/' . $v['structureCode']) . '"><i class="ri-edit-2-line ri-lg text-warning mx-1" role="button" title="Update"></i></a>' : '') . ' ' . ((in_array('USTRUCTURE', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" role="button" title="Delete" onclick="deleteData(' . $v['structureCode'] . ')"></i>' : '') . '</span>
                        </li>';
            }
        }
    }

    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
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
            $this->validation_for = 'add';
            $data = array();
            $data['status'] = TRUE;

            $this->_validate();

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'name' => form_error('name'),
                    'title' => form_error('title'),
                    'structureParent' => form_error('structureParent'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {

                $insert = array(
                    'name' => $this->input->post('name'),
                    'title' => $this->input->post('title'),
                    'structureParent' => ($this->input->post('structureParent') == NULL ? '0' : $this->input->post('structureParent')),
                );

                $insert = $this->structure->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add structure";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add structure";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('USTRUCTURE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('structureCode') == '' || $this->input->post('structureCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID structure is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $structure = $this->structure->get_by_id($this->input->post('structureCode'));
                if ($structure == NULL) {
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
                            'title' => form_error('title'),
                            'structureParent' => form_error('structureParent'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $insert = array(
                            'name' => $this->input->post('name'),
                            'title' => $this->input->post('title'),
                            'structureParent' => ($this->input->post('structureParent') == NULL ? '0' : $this->input->post('structureParent')),
                        );

                        $up = $this->structure->update(array('structureCode' => $this->input->post('structureCode')), $insert);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update structure";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update structure";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }

    public function delete($structureCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DSTRUCTURE', $userPermission)) {
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
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $structure = $this->structure->get_by_id($structureCode);
                if ($structure == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Structure not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $del = $this->structure->delete_by_id($structureCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete structure";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete structure";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
}
