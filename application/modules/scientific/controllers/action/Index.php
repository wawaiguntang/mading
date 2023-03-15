<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'scientific';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/scientific_model', 'scientific');
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
        $list = $this->scientific->get_datatables();
        $data = array();
        foreach ($list as $scientific) {
            $row = array();
            $row[] = '
            <div class="d-flex px-2 py-1">
                <div>
                    <img src="' . base_url('assets/display/images/scientific/' . $scientific->image) . '" class="avatar avatar-sm me-3">
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-xs">' . $scientific->name . '</h6>
                </div>
            </div>
            ';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . wordwrap($scientific->description, 60, "<br>\n", TRUE) . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center align-items-center'>
                " . ((in_array('UINFORMATIONLOBBY', $userPermission)) ? '<a href="' . base_url('scientific/index/edit/' . $scientific->scientificCode) . '" class="a-spa d-flex align-items-center"><i class="ri-edit-2-line ri-lg text-warning mx-1" scientific="button" title="Update"></i></a>' : '') . "
                " . ((in_array('DINFORMATIONLOBBY', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" role="button" title="Delete" onclick="deleteData(' . $scientific->scientificCode . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->scientific->count_all(),
            "recordsFiltered" => $this->scientific->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CINFORMATIONLOBBY', $userPermission)) {
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
                    'description' => form_error('description'),
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
                    'description' => $this->input->post('description'),
                );
                $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                $config['upload_path']          = path_by_os(FCPATH . 'assets/display/images/scientific/');
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
                $insert = $this->scientific->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add scientific";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add scientific";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }
    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UINFORMATIONLOBBY', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('scientificCode') == '' || $this->input->post('scientificCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID scientific is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $scientific = $this->scientific->get_by_id($this->input->post('scientificCode'));
                if ($scientific == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Cover not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'name' => form_error('name'),
                            'description' => form_error('description'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $insert = array(
                            'name' => $this->input->post('name'),
                            'description' => $this->input->post('description'),
                        );
                        if (!isset($_FILES['image']) || $_FILES['image']['name'] == NULL) {
                            $insert['image'] = $scientific->image;
                        } else {


                            $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                            $config['upload_path']          = path_by_os(FCPATH . 'assets/display/images/scientific/');
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

                        $up = $this->scientific->update(array('scientificCode' => $this->input->post('scientificCode')), $insert);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update scientific";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update scientific";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }
    public function delete($scientificCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DINFORMATIONLOBBY', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($scientificCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID scientific is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $scientific = $this->scientific->get_by_id($scientificCode);
                if ($scientific == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Cover not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $del = $this->scientific->delete_by_id($scientificCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete scientific";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete scientific";
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
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
    }
}
