<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends MX_Controller
{
    private $module = 'barcode';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/unit_model', 'unit');
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
        $list = $this->unit->get_datatables();
        $data = array();
        foreach ($list as $unit) {
            $row = array();
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $unit->unit . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center align-items-center'>
                " . ((in_array('UUNIT', $userPermission)) ? '<a href="' . base_url('barcode/unit/edit/' . $unit->unitCode) . '" class="a-spa d-flex align-items-center"><i class="ri-edit-2-line ri-lg text-warning mx-1" unit="button" title="Update"></i></a>' : '') . "
                " . ((in_array('DUNIT', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" unit="button" title="Delete" onclick="deleteData(' . $unit->unitCode . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->unit->count_all(),
            "recordsFiltered" => $this->unit->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CUNIT', $userPermission)) {
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
                    'unit' => form_error('unit')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'unit' => $this->input->post('unit'),
                );
                $insert = $this->unit->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add unit";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add unit";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }
    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UUNIT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('unitCode') == '' || $this->input->post('unitCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID unit is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $unit = $this->unit->get_by_id($this->input->post('unitCode'));
                if ($unit == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Unit not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'unit'     => form_error('unit')
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'unit' => $this->input->post('unit'),
                        );
                        $up = $this->unit->update(array('unitCode' => $this->input->post('unitCode')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update unit";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update unit";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }
    public function delete($unitCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DUNIT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($unitCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID unit is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $unit = $this->unit->get_by_id($unitCode);
                if ($unit == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Unit not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $del = $this->unit->delete_by_id($unitCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete unit";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete unit";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('unit', 'Unit', 'trim|required');
    }
}
