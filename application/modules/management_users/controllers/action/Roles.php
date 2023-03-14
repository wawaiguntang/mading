<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends MX_Controller
{
    private $module = 'management_users';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/users_model', 'users');
        $this->load->model($this->module . '/roles_model', 'roles');
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
        $list = $this->roles->get_datatables();
        $data = array();
        foreach ($list as $role) {
            $row = array();
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $role->role . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center align-items-center'>
                " . ((in_array('UR', $userPermission)) ? '<a href="' . base_url('management_users/roles/edit/' . $role->roleCode) . '" class="a-spa d-flex align-items-center"><i class="ri-edit-2-line ri-lg text-warning mx-1" role="button" title="Update"></i></a>' : '') . "
                " . ((in_array('DR', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" role="button" title="Delete" onclick="deleteData(' . $role->roleCode . ')"></i>' : '') . "
                " . ((count(array_intersect($userPermission, ['RRP', 'CRP', 'DRP'])) > 0) ? '<a href="' . base_url('management_users/roles/info/' . $role->roleCode) . '" class="a-spa d-flex align-items-center"><i class="ri-information-line ri-lg text-primary mx-1" role="button" title="Info"></i></a>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->users->count_all(),
            "recordsFiltered" => $this->users->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CR', $userPermission)) {
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
                    'role' => form_error('role')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'role' => $this->input->post('role'),
                    'status' => 'Dynamic'
                );
                $insert = $this->roles->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add role";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add role";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }
    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UR', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('roleCode') == '' || $this->input->post('roleCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID role is required"
                );
            } else {
                $role = $this->roles->get_by_id($this->input->post('roleCode'));
                if ($role == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'role'     => form_error('role')
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'role' => $this->input->post('role'),
                        );
                        $up = $this->roles->update(array('roleCode' => $this->input->post('roleCode')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update role";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update role";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }
    public function delete($roleCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DR', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($roleCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID role is required"
                );
            } else {
                $role = $this->roles->get_by_id($roleCode);
                if ($role == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $del = $this->roles->delete_by_id($roleCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete role";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete role";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
    }
    public function deletePermission($rpCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DRP', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($rpCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID role permission is required"
                );
            } else {
                $up = $this->roles->get_role_permission_id($rpCode);
                if ($up == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role permission not found!"
                    );
                } else {
                    $del = $this->roles->delete_role_permission_id($rpCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['roleCode'] = $up->roleCode;
                        $data['message'] = "Success to delete permission from role";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete permission from role";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
    public function addPermission($roleCode = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CUP', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($roleCode == '' || $roleCode == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID role is required"
                );
            } else {
                $data = array();
                $data['status'] = TRUE;
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules('permissionCode', 'Permission', 'trim|required');
                $this->form_validation->set_rules('roleCode', 'Role', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $errors = array(
                        'permissionCode' => form_error('permissionCode'),
                        'roleCode' => form_error('roleCode')
                    );
                    $data = array(
                        'status'         => FALSE,
                        'errors'         => $errors
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $insert = array(
                        'permissionCode' => $this->input->post('permissionCode'),
                        'roleCode' => $this->input->post('roleCode'),
                    );
                    $where = $insert;
                    $where['deleteAt'] = NULL;
                    $check = $this->db->get_where('role_permission', $where)->row_array();
                    if ($check == NULL) {
                        $insert = $this->db->insert('role_permission', $insert);
                        if ($insert) {
                            $data['status'] = TRUE;
                            $data['roleCode'] = $roleCode;
                            $data['message'] = "Success add permission to role";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed add permission to role";
                        }
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed add permission to role, permission already exists";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
}
