<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'service';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/service_model', 'service');
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
        $list = $this->service->get_datatables();
        $data = array();
        foreach ($list as $service) {
            $row = array();
            $row[] = '
            <div class="d-flex px-2 py-1">
                <div>
                    <img src="' . base_url('assets/front/img/service/' . $service->image) . '" class="avatar avatar-sm me-3">
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-xs">' . $service->name . '</h6>
                    <p class="text-xs text-secondary mb-0">' . $service->url . '</p>
                </div>
            </div>
            ';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . wordwrap($service->description, 60, "<br>\n", TRUE) . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center align-items-center'>
                " . ((in_array('USERVICE', $userPermission)) ? '<a href="' . base_url('service/index/edit/' . $service->serviceCode) . '" class="a-spa d-flex align-items-center"><i class="ri-edit-2-line ri-lg text-warning mx-1" service="button" title="Update"></i></a>' : '') . "
                " . ((in_array('DSERVICE', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" role="button" title="Delete" onclick="deleteData(' . $service->serviceCode . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->service->count_all(),
            "recordsFiltered" => $this->service->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CSERVICE', $userPermission)) {
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
                    'url' => form_error('url'),
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
                    'url' => $this->input->post('url'),
                    'description' => $this->input->post('description'),
                );
                $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                $config['upload_path']          = path_by_os(FCPATH . 'assets/front/img/service/');
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
                $insert = $this->service->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add service";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add service";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }
    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('USERVICE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('serviceCode') == '' || $this->input->post('serviceCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID service is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $service = $this->service->get_by_id($this->input->post('serviceCode'));
                if ($service == NULL) {
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
                            'url' => form_error('url'),
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
                            'url' => $this->input->post('url'),
                            'description' => $this->input->post('description'),
                        );
                        if (!isset($_FILES['image']) || $_FILES['image']['name'] == NULL) {
                            $insert['image'] = $service->image;
                        } else {


                            $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                            $config['upload_path']          = path_by_os(FCPATH . 'assets/front/img/service/');
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

                        $up = $this->service->update(array('serviceCode' => $this->input->post('serviceCode')), $insert);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update service";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update service";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }
    public function delete($serviceCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DSERVICE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($serviceCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID service is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $service = $this->service->get_by_id($serviceCode);
                if ($service == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Service not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $del = $this->service->delete_by_id($serviceCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete service";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete service";
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
        $this->form_validation->set_rules('url', 'URL', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
    }
}
