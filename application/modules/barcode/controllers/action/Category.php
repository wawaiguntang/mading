<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends MX_Controller
{
    private $module = 'barcode';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/category_model', 'category');
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
        $list = $this->category->get_datatables();
        $data = array();
        foreach ($list as $category) {
            $row = array();
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $category->category . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center align-items-center'>
                " . ((in_array('UCATEGORY', $userPermission)) ? '<a href="' . base_url('barcode/category/edit/' . $category->categoryCode) . '" class="a-spa d-flex align-items-center"><i class="ri-edit-2-line ri-lg text-warning mx-1" category="button" title="Update"></i></a>' : '') . "
                " . ((in_array('DCATEGORY', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" category="button" title="Delete" onclick="deleteData(' . $category->categoryCode . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->category->count_all(),
            "recordsFiltered" => $this->category->count_filtered(),
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
                    'category' => form_error('category')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'category' => $this->input->post('category'),
                );
                $insert = $this->category->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add category";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add category";
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
            if ($this->input->post('categoryCode') == '' || $this->input->post('categoryCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID category is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $category = $this->category->get_by_id($this->input->post('categoryCode'));
                if ($category == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Category not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'category'     => form_error('category')
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'category' => $this->input->post('category'),
                        );
                        $up = $this->category->update(array('categoryCode' => $this->input->post('categoryCode')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update category";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update category";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }
    public function delete($categoryCode)
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
            if ($categoryCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID category is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $category = $this->category->get_by_id($categoryCode);
                if ($category == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Category not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $del = $this->category->delete_by_id($categoryCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete category";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete category";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
    }
}
