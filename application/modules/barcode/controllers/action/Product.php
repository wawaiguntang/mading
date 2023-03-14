<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MX_Controller
{
    private $module = 'barcode';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '/product_model', 'product');
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
        $list = $this->product->get_datatables();
        $data = array();
        foreach ($list as $product) {
            $row = array();
            $nameCode = '';
            $nameCode .= '<div class="d-flex flex-column">';
            $nameCode .= '<p class="text-sm d-flex py-0 my-0 text-bold">' . $product->code . '</p>';
            $nameCode .= '<p class="text-xs d-flex py-0 my-0 ">' . $product->name . '</p>';
            $nameCode .= '</div>';

            $row[] = $nameCode;
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $product->category . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $product->unit . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $product->supplier . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $product->buyPrice . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $product->quantity . '</p>';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $product->sellPrice . '</p>';

            $row[] = "
                <div class='d-flex justify-content-center align-items-center'>
                " . ((in_array('RPRODUCT', $userPermission)) ? '<a href="' . base_url('barcode/product/printOne/' . $product->productCode) . '" class="d-flex align-items-center"><i class="fa fa-barcode mx-1" role="button" title="Barcode"></i></a>' : '') . "
                " . ((in_array('UPRODUCT', $userPermission)) ? '<a href="' . base_url('barcode/product/edit/' . $product->productCode) . '" class="a-spa d-flex align-items-center"><i class="ri-edit-2-line ri-lg text-warning mx-1" product="button" title="Update"></i></a>' : '') . "
                " . ((in_array('DPRODUCT', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" product="button" title="Delete" onclick="deleteData(' . $product->productCode . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->product->count_all(),
            "recordsFiltered" => $this->product->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CPRODUCT', $userPermission)) {
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
                    'code' => form_error('code'),
                    'buyPrice' => form_error('buyPrice'),
                    'sellPrice' => form_error('sellPrice'),
                    'quantity' => form_error('quantity'),
                    'unitCode' => form_error('unitCode'),
                    'categoryCode' => form_error('categoryCode'),
                    'supplierCode' => form_error('supplierCode'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'name' => $this->input->post('name'),
                    'code' => $this->input->post('code'),
                    'buyPrice' => $this->input->post('buyPrice'),
                    'sellPrice' => $this->input->post('sellPrice'),
                    'quantity' => $this->input->post('quantity'),
                    'unitCode' => $this->input->post('unitCode'),
                    'categoryCode' => $this->input->post('categoryCode'),
                    'supplierCode' => $this->input->post('supplierCode'),
                );
                $insert = $this->product->save($insert);
                if ($insert) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to add product";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add product";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }
    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UPRODUCT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('productCode') == '' || $this->input->post('productCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID product is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $product = $this->product->get_by_id($this->input->post('productCode'));
                if ($product == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Product not found!"
                    );
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'name' => form_error('name'),
                            'code' => form_error('code'),
                            'buyPrice' => form_error('buyPrice'),
                            'sellPrice' => form_error('sellPrice'),
                            'quantity' => form_error('quantity'),
                            'unitCode' => form_error('unitCode'),
                            'categoryCode' => form_error('categoryCode'),
                            'supplierCode' => form_error('supplierCode'),
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'name' => $this->input->post('name'),
                            'code' => $this->input->post('code'),
                            'buyPrice' => $this->input->post('buyPrice'),
                            'sellPrice' => $this->input->post('sellPrice'),
                            'quantity' => $this->input->post('quantity'),
                            'unitCode' => $this->input->post('unitCode'),
                            'categoryCode' => $this->input->post('categoryCode'),
                            'supplierCode' => $this->input->post('supplierCode'),
                        );
                        $up = $this->product->update(array('productCode' => $this->input->post('productCode')), $update);
                        if ($up) {
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update product";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update product";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }
    public function delete($productCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DPRODUCT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($productCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID product is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $product = $this->product->get_by_id($productCode);
                if ($product == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Product not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $del = $this->product->delete_by_id($productCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete product";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete product";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('code', 'Code', 'trim|required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric');
        $this->form_validation->set_rules('buyPrice', 'Buy Price', 'trim|required|numeric');
        $this->form_validation->set_rules('sellPrice', 'Sell Price', 'trim|required|numeric');
        $this->form_validation->set_rules('supplierCode', 'Supplier', 'trim|required');
        $this->form_validation->set_rules('categoryCode', 'Category', 'trim|required');
        $this->form_validation->set_rules('unitCode', 'Unit', 'trim|required');
    }

    public function getCategory(string $categoryCode = "")
    {
        $json = [];
        $search = $this->input->get("q");
        if (!empty($search)) {
            $this->db->like("category", $search);
        }
        $query = $this->db->select("categoryCode as id, category as text")
            ->where("deleteAt", NULL)
            ->get("category");
        $json = $query->result_array();
        $result = [];
        if ($categoryCode != "") {
            foreach ($json as $k => $v) {
                if ($categoryCode == $v['id']) {
                    $result[] =  ['id' => $v['id'], 'text' => $v['text'], 'selected' => true];
                } else {
                    $result[] =  ['id' => $v['id'], 'text' => $v['text']];
                }
            }
        } else {
            $result = $json;
        }
        echo json_encode(array_reverse($result));
    }

    public function getUnit()
    {
        $json = [];
        $search = $this->input->get("q");
        if (!empty($search)) {
            $this->db->like("unit", $search);
        }
        $query = $this->db->select("unitCode as id, unit as text")
            ->where("deleteAt", NULL)
            ->get("unit");
        $json = $query->result();
        if (empty($search)) {
            $json[] = ['id' => '', 'text' => '-- Unit --'];
        }
        echo json_encode(array_reverse($json));
    }

    public function getSupplier()
    {
        $json = [];
        $search = $this->input->get("q");
        if (!empty($search)) {
            $this->db->like("supplier", $search);
        }
        $query = $this->db->select("supplierCode as id, supplier as text")
            ->where("deleteAt", NULL)
            ->get("supplier");
        $json = $query->result();
        if (empty($search)) {
            $json[] = ['id' => '', 'text' => '-- Supplier --'];
        }
        echo json_encode(array_reverse($json));
    }
}
