<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MX_Controller
{
    private $module = 'barcode';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/product_model', 'product');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RPRODUCT', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $params = [
            'userPermission' => $userPermission
        ];
        $data['status'] = TRUE;
        $data['breadcrumb'] = breadcrumb([
            [
                "text" => "Barcode",
                "url" => base_url('barcode/product/index')
            ],
            [
                "text" => "Product",
            ]
        ], 'Data Product');
        $data['_view'] = $this->module . '/product/index';
        $data['params'] = $params;
        viewRender($data);
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
            $data['status'] = TRUE;
            $params = [
                'title' => 'Add Data',
                'productCode' => NULL,
                'name' => NULL,
                'code' => NULL,
                'buyPrice' => NULL,
                'sellPrice' => NULL,
                'quantity' => NULL,
                'unitCode' => "",
                'categoryCode' => "",
                'supplierCode' => "",
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Barcode",
                    "url" => base_url('barcode/product/index')
                ],
                [
                    "text" => "Product",
                    "action" => "backPrevious()"
                ],
                [
                    "text" => "Add Product"
                ]
            ], 'Add Product');
            $data['_view'] = $this->module . '/product/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $productCode = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UPRODUCT', $userPermission)) {
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
            } else {
                $product = $this->product->get_by_id($productCode);
                if ($product == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'productCode' => $product->productCode,
                        'name' => $product->name,
                        'code' => $product->code,
                        'buyPrice' => $product->buyPrice,
                        'sellPrice' => $product->sellPrice,
                        'quantity' => $product->quantity,
                        'unitCode' => $product->unitCode,
                        'categoryCode' => $product->categoryCode,
                        'supplierCode' => $product->supplierCode,
                        'unit' => $product->unit,
                        'category' => $product->category,
                        'supplier' => $product->supplier,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Barcode",
                            "url" => base_url('barcode/product')
                        ],
                        [
                            "text" => "Product",
                            "action" => "backPrevious()"
                        ],
                        [
                            "text" => "Edit Product"
                        ]
                    ], 'Edit Product');
                    $data['_view'] = $this->module . '/product/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function printOne(string $productCode = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RPRODUCT', $userPermission)) {
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
                        'message'         => "Role not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $code = $product->code;
                    $nameStore = 'Bunda Toserba';
                    $supplier = $product->supplier;
                    $name = $product->name;
                    $price = $product->sellPrice;

                    $this->load->library('PDF_Code128');
                    $pdf = new PDF_Code128('P', 'mm', [55, 55]);
                    $pdf->AddPage();
                    $pdf->SetFont('Arial', 'B', 7);
                    $pdf->setXY(5.5, 1);
                    $pdf->MultiCell(44, 2, $nameStore, 0, 'C', false);
                    $pdf->setXY(5.5, 0);
                    $pdf->Code128(2.5, 3.5, $code, 50, 5);

                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->setXY(2.5, 8.5);
                    $pdf->Cell(50, 3, $code, 0, 0, 'C', false);

                    $pdf->SetFont('Arial', 'B', 3);
                    $pdf->setXY(2.5, 8.5);
                    $pdf->Cell(50, 3, $supplier, 0, 0, 'R', false);
                    $pdf->SetFont('Arial', 'B', 5);
                    $pdf->SetXY(1.5, 11);
                    $pdf->MultiCell(34, 3, $name, 0, 'L', false);
                    $pdf->SetXY(35.5, 11);
                    $pdf->MultiCell(17.5, 3, $price, 0, 'R', false);
                    $pdf->Output();
                }
            }
        }
    }
}
