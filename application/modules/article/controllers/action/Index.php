<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'article';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');

        $this->load->model($this->module . '/article_model', 'article');
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
        $list = $this->article->get_datatables();
        $data = array();
        foreach ($list as $article) {
            $row = array();
            $row[] = '
            <div class="d-flex px-2 py-1">
                <div>
                    <img src="' . base_url('assets/front/img/article/' . $article->image) . '" class="avatar avatar-sm me-3">
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-xs">' . $article->title . '</h6>
                    <p class="text-xs text-secondary mb-0">' . $article->slug . '</p>
                </div>
            </div>
            ';
            $row[] = '<p class="text-sm d-flex py-auto my-auto">' . $article->category . '</p>';
            $tags = $this->db->join('tag as t', 't.tagCode=at.tagCode')
                ->order_by('at.tagCode', 'desc')->limit(5, 0)
                ->get_where('article_tag as at', [
                    'at.deleteAt' => NULL,
                    'at.articleCode' => $article->articleCode
                ])->result_array();

            $htmlTAG = '<div class="d-flex flex-column">';
            foreach ($tags as $k => $v) {
                $htmlTAG .= '<p class="text-xs text-secondary mb-0">#' . $v['tag'] . '</p>';
            }
            $htmlTAG .= '</div>';

            $row[] = $htmlTAG;

            $row[] = "
                <div class='d-flex justify-content-center align-items-center'>
                " . ((in_array('UARTICLE', $userPermission)) ? '<a href="' . base_url('article/index/edit/' . $article->articleCode) . '" class="a-spa d-flex align-items-center"><i class="ri-edit-2-line ri-lg text-warning mx-1" article="button" title="Update"></i></a>' : '') . "
                " . ((in_array('DARTICLE', $userPermission)) ? '<i class="ri-delete-bin-line ri-lg text-danger mx-1" role="button" title="Delete" onclick="deleteData(' . $article->articleCode . ')"></i>' : '') . "
                </div>
                ";

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->article->count_all(),
            "recordsFiltered" => $this->article->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CARTICLE', $userPermission)) {
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
                    'title' => form_error('title'),
                    'content' => form_error('content'),
                    'categoryCode' => form_error('categoryCode')
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $insert = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'categoryCode' => $this->input->post('categoryCode'),
                    'slug' => slugify($this->input->post('title')) . "-" . rand(1, 100),
                    'userCode' => $this->session->userdata('userCode')
                );
                if (!isset($_FILES['image']) || $_FILES['image']['name'] == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => 'Thumbnail harus diisi'
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
                $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                $config['upload_path']          = path_by_os(FCPATH . 'assets/front/img/article/');
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['file_name']            = $file_name;
                $config['overwrite']            = true;
                $config['max_size']             = 10240;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => 'Thumbnail gagal di upload'
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $uploaded_data = $this->upload->data();
                    $insert['image'] = $uploaded_data['file_name'];
                }
                $insert = $this->article->save($insert);
                if ($insert) {
                    $tags = [];
                    foreach ($this->input->post('tags') as $k => $v) {
                        $check = $this->db->get_where('tag', [
                            'tag' => $v
                        ])->row_array();
                        if ($check != null) {
                            $tags[] = [
                                'articleCode' => $insert,
                                'tagCode' => $check['tagCode']
                            ];
                        } else {
                            $inTag = $this->db->insert('tag', [
                                'tag' => $v
                            ]);
                            $idTag = $this->db->insert_id();
                            $tags[] = [
                                'articleCode' => $insert,
                                'tagCode' => $idTag
                            ];
                        }
                    }
                    $insertAT = $this->db->insert_batch('article_tag', $tags);

                    $data['status'] = TRUE;
                    $data['message'] = "Success to add article";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to add article";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }
    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UARTICLE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;
            if ($this->input->post('articleCode') == '' || $this->input->post('articleCode') == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID article is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $article = $this->article->get_by_id($this->input->post('articleCode'));
                if ($article == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Category not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $this->_validate();

                    if ($this->form_validation->run() == FALSE) {
                        $errors = array(
                            'title' => form_error('title'),
                            'content' => form_error('content'),
                            'categoryCode' => form_error('categoryCode')
                        );
                        $data = array(
                            'status'         => FALSE,
                            'errors'         => $errors
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $update = array(
                            'title' => $this->input->post('title'),
                            'content' => $this->input->post('content'),
                            'categoryCode' => $this->input->post('categoryCode')
                        );
                        if (!isset($_FILES['image']) || $_FILES['image']['name'] == NULL) {
                            $update['image'] = $article['image'];
                        } else {
                            $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                            $config['upload_path']          = path_by_os(FCPATH . 'assets/front/img/article/');
                            $config['allowed_types']        = 'jpg|jpeg|png';
                            $config['file_name']            = $file_name;
                            $config['overwrite']            = true;
                            $config['max_size']             = 10240;

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if (!$this->upload->do_upload('image')) {
                                $data = array(
                                    'status'         => FALSE,
                                    'message'         => 'Thumbnail gagal di upload'
                                );
                                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                            } else {
                                $uploaded_data = $this->upload->data();
                                $update['image'] = $uploaded_data['file_name'];
                            }
                        }

                        $up = $this->article->update(array('articleCode' => $this->input->post('articleCode')), $update);
                        if ($up) {
                            $this->db->update('article_tag', ['deleteAt' => date('Y-m-d H:i:s')], ['articleCode' => $article['articleCode']]);
                            $tags = [];
                            foreach ($this->input->post('tags') as $k => $v) {
                                $check = $this->db->get_where('tag', [
                                    'tag' => $v
                                ])->row_array();
                                if ($check != null) {
                                    $tags[] = [
                                        'articleCode' => $article['articleCode'],
                                        'tagCode' => $check['tagCode']
                                    ];
                                } else {
                                    $inTag = $this->db->insert('tag', [
                                        'tag' => $v
                                    ]);
                                    $idTag = $this->db->insert_id();
                                    $tags[] = [
                                        'articleCode' => $article['articleCode'],
                                        'tagCode' => $idTag
                                    ];
                                }
                            }
                            if ($tags != NULL) {
                                $insertAT = $this->db->insert_batch('article_tag', $tags);
                            }
                            $data['status'] = TRUE;
                            $data['message'] = "Success to update article";
                        } else {
                            $data['status'] = FALSE;
                            $data['message'] = "Failed to update article";
                        }
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
                }
            }
        }
    }
    public function delete($articleCode)
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('DARTICLE', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($articleCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID article is required"
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $article = $this->article->get_by_id($articleCode);
                if ($article == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Category not found!"
                    );
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $del = $this->article->delete_by_id($articleCode);
                    if ($del) {
                        $data['status'] = TRUE;
                        $data['message'] = "Success to delete article";
                    } else {
                        $data['status'] = FALSE;
                        $data['message'] = "Failed to delete article";
                    }
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }
    private function _validate()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'trim|required');
        $this->form_validation->set_rules('categoryCode', 'Category', 'trim|required');
    }


    function upload_image()
    {
        if (isset($_FILES["image"]["name"])) {
            $config['upload_path'] = path_by_os('./assets/front/img/article/');
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
            $config['file_name']            = $file_name;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $this->upload->display_errors();
                return FALSE;
            } else {
                $data = $this->upload->data();
                echo base_url() . 'assets/front/img/article/' . $data['file_name'];
            }
        }
    }

    //Delete image summernote
    function delete_image()
    {
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
    }
}
