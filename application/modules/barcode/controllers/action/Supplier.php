<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SUpplier extends MX_Controller
{
    private $module = 'barcode';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/supplier_model', 'supplier');
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
        $list = $this->supplier->get_datatables();
        $data = array();
        foreach ($list as $supplier) {
            $row = array();
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $supplier->supplier . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center align-items-center'>
                " . ((in_array('USUPPLIER', $userPermission)) ? '<a href="' . base_url('barcode/supplier/edit/' . $supplier->supplierCode) . '" class="a-spa d-flex align-items-center"><i class="ri-edit-2-line ri-lg text-warning mx-1" supplier="button" title="Update"></i></a>' : '') . "
                " . ((in_array('DSUPPLIER', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" supplier="button" title="Delete" onclick="deleteData(' . $supplier->supplierCode . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->supplier->count_all(),
            "recordsFiltered" => $this->supplier->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CSUPPLIER', $userPermission)) {
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
                    'supplier' => form_error('supplier')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'supplier' => $this->input->post('supplier'),
                );
                $insert = $this->supplier->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add supplier";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add supplier";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }
    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('USUPPLIER', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('supplierCode') == '' || $this->input->post('supplierCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID supplier is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $supplier = $this->supplier->get_by_id($this->input->post('supplierCode'));
                if ($supplier == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SUpplier not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'supplier'     => form_error('supplier')
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'supplier' => $this->input->post('supplier'),
                        );
                        $up = $this->supplier->update(array('supplierCode' => $this->input->post('supplierCode')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update supplier";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update supplier";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }
    public function delete($supplierCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DSUPPLIER', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($supplierCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID supplier is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $supplier = $this->supplier->get_by_id($supplierCode);
                if ($supplier == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "SUpplier not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $del = $this->supplier->delete_by_id($supplierCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete supplier";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete supplier";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('supplier', 'SUpplier', 'trim|required');
    }
}
