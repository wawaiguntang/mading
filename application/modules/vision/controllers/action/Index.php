<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'contact';
    private $validation_for = '';

    public function __construct()
    {
        parent::__construct();
        if (isLogin() == false) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You must login first!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $this->load->library('upload');

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
            die();
        }
    }

    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UVISION', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->validation_for = 'update';
            $data = array();
            $data['status'] = TRUE;

            $profile = getProfileWeb();

            $this->form_validation->set_rules('titleVisi', 'Title', 'trim|required');
            $this->form_validation->set_rules('contentVisi', 'Description', 'trim|required');
            $this->form_validation->set_rules('titleMisi', 'Title', 'trim|required');
            $this->form_validation->set_rules('contentMisi', 'Description', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'titleVisi'     => form_error('titleVisi'),
                    'contentVisi'     => form_error('contentVisi'),
                    'titleMisi'     => form_error('titleMisi'),
                    'contentMisi'     => form_error('contentMisi'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $profile['visi']['title'] = $this->input->post('titleVisi');
                $profile['visi']['description'] = $this->input->post('contentVisi');
                if (!isset($_FILES['imageVisi']) || $_FILES['imageVisi']['name'] == NULL) {
                    $profile['visi']['image'] = $profile['visi']['image'];
                } else {
                    $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                    $config['upload_path']          = path_by_os(FCPATH . 'assets/front/img/visi/');
                    $config['allowed_types']        = 'jpg|jpeg|png';
                    $config['file_name']            = $file_name;
                    $config['overwrite']            = true;
                    $config['max_size']             = 10240;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('imageVisi')) {
                        $data = array(
                            'status'         => FALSE,
                            'message'         => 'Gambar gagal di upload'
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $uploaded_data = $this->upload->data();
                        $profile['visi']['image'] = $uploaded_data['file_name'];
                    }
                }

                $profile['misi']['title'] = $this->input->post('titleMisi');
                $profile['misi']['description'] = $this->input->post('contentMisi');
                if (!isset($_FILES['imageMisi']) || $_FILES['imageMisi']['name'] == NULL) {
                    $profile['misi']['image'] = $profile['misi']['image'];
                } else {
                    $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
                    $config['upload_path']          = path_by_os(FCPATH . 'assets/front/img/visi/');
                    $config['allowed_types']        = 'jpg|jpeg|png';
                    $config['file_name']            = $file_name;
                    $config['overwrite']            = true;
                    $config['max_size']             = 10240;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('imageMisi')) {
                        $data = array(
                            'status'         => FALSE,
                            'message'         => 'Gambar gagal di upload'
                        );
                        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } else {
                        $uploaded_data = $this->upload->data();
                        $profile['misi']['image'] = $uploaded_data['file_name'];
                    }
                }
               
                //Encode the array back into a JSON string.
                $json = json_encode($profile, TRUE);
                $up = file_put_contents(path_by_os(APPPATH . '/setting/profile_web.json'), $json);

                if ($up) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to update vision";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to update vision";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    function upload_image()
    {
        if (isset($_FILES["image"]["name"])) {
            $config['upload_path'] = path_by_os('./assets/front/img/visi/');
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $file_name = str_replace('.', '', md5(rand())) . '-' . uniqid();
            $config['file_name']            = $file_name;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $this->upload->display_errors();
                return FALSE;
            } else {
                $data = $this->upload->data();
                echo base_url() . 'assets/front/img/visi/' . $data['file_name'];
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
