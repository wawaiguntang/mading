<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'profile';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/profile_model', 'profile');
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
        $list = $this->profile->get_datatables();
        $data = array();
        foreach ($list as $profile) {
            $row = array();
            $row[] = '
            <div class="d-flex px-2 py-1">
                <div>
                    <img src="' . base_url('assets/front/img/profile/' . $profile->image) . '" class="avatar avatar-sm me-3">
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-xs">' . $profile->name . '</h6>
                    <p class="text-xs text-secondary mb-0">' . $profile->title . '</p>
                </div>
            </div>
            ';
            $rodd = '<div class="d-flex flex-column mb-0" > ';
            $rodd .= '<p class="text-sm d-flex py-0 my-0">Youtube :' . $profile->yt . '</p>';
            $rodd .= '<p class="text-sm d-flex py-0 my-0">Instagram :' . $profile->ig . '</p>';
            $rodd .= '<p class="text-sm d-flex py-0 my-0">Twitter :' . $profile->tw . '</p>';
            $rodd .= '<p class="text-sm d-flex py-0 my-0">Facabook :' . $profile->fb . '</p>';
            $rodd .= '</div>';
            $row[] = $rodd;
            $row[] = "
                <div class='d-flex justify-content-center align-items-center'>
                " . ((in_array('UPO', $userPermission)) ? '<a href="' . base_url('profile/index/edit/' . $profile->poCode) . '" class="a-spa d-flex align-items-center"><i class="ri-edit-2-line ri-lg text-warning mx-1" profile="button" title="Update"></i></a>' : '') . "
                " . ((in_array('DPO', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" role="button" title="Delete" onclick="deleteData(' . $profile->poCode . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->profile->count_all(),
            "recordsFiltered" => $this->profile->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
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
            $this->validation_for = 'add';
            $data = array();
            $data['status'] = TRUE;

            $this->_validate();

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'name' => form_error('name'),
                    'title' => form_error('title'),
                    'yt' => form_error('yt'),
                    'fb' => form_error('fb'),
                    'ig' => form_error('ig'),
                    'tw' => form_error('tw'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                if (!isset($_FILES['image']) || $_FILES['image']['name'] == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => 'Gambar harus diisi'
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
                $insert = array(
                    'name' => $this->input->post('name'),
                    'title' => $this->input->post('title'),
                    'yt' => $this->input->post('yt'),
                    'fb' => $this->input->post('fb'),
                    'ig' => $this->input->post('ig'),
                    'tw' => $this->input->post('tw'),
                );
                $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                $config['upload_path']          = path_by_os(FCPATH . 'assets/front/img/profile/');
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['file_name']            = $file_name;
                $config['overwrite']            = true;
                $config['max_size']             = 10240;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => 'Gambar gagal di upload'
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $uploaded_data = $this->upload->data();
                    $insert['image'] = $uploaded_data['file_name'];
                }
                $insert = $this->profile->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add profile";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add profile";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }
    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UPO', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('poCode') == '' || $this->input->post('poCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID profile is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $profile = $this->profile->get_by_id($this->input->post('poCode'));
                if ($profile == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Service not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'name' => form_error('name'),
                            'title' => form_error('title'),
                            'yt' => form_error('yt'),
                            'fb' => form_error('fb'),
                            'ig' => form_error('ig'),
                            'tw' => form_error('tw'),
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
                            'yt' => $this->input->post('yt'),
                            'fb' => $this->input->post('fb'),
                            'ig' => $this->input->post('ig'),
                            'tw' => $this->input->post('tw'),
                        );
                        if (!isset($_FILES['image']) || $_FILES['image']['name'] == NULL) {
                            $insert['image'] = $profile->image;
                        } else {


                            $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                            $config['upload_path']          = path_by_os(FCPATH . 'assets/front/img/profile/');
                            $config['allowed_types']        = 'jpg|jpeg|png';
                            $config['file_name']            = $file_name;
                            $config['overwrite']            = true;
                            $config['max_size']             = 10240;

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('image')) {
                                $data = array(
                                    'status'         => FALSE,
                                    'message'         => 'Gambar gagal di upload'
                                );
                                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                            } else {
                                $uploaded_data = $this->upload->data();
                                $insert['image'] = $uploaded_data['file_name'];
                            }
                        }

                        $up = $this->profile->update(array('poCode' => $this->input->post('poCode')), $insert);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update profile";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update profile";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }
    public function delete($poCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DPO', $userPermission)) {
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
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $profile = $this->profile->get_by_id($poCode);
                if ($profile == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Service not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $del = $this->profile->delete_by_id($poCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete profile";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete profile";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('yt', 'Youtube', 'trim|required');
        $this->form_validation->set_rules('tw', 'Twitter', 'trim|required');
        $this->form_validation->set_rules('ig', 'Instagram', 'trim|required');
        $this->form_validation->set_rules('fb', 'Facebook', 'trim|required');
    }
}
