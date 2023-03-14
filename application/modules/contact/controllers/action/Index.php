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
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
            die();
        }
    }

    public function update()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UCONTACT', $userPermission)) {
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

            $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('noHp', 'No HP', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('map', 'Map', 'trim|required');
            $this->form_validation->set_rules('ig', 'Instagram', 'trim|required');
            $this->form_validation->set_rules('tw', 'Twitter', 'trim|required');
            $this->form_validation->set_rules('fb', 'Facebook', 'trim|required');
            $this->form_validation->set_rules('yt', 'Youtube', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $errors = array(
                    'nama'     => form_error('nama'),
                    'noHp'     => form_error('noHp'),
                    'email'     => form_error('email'),
                    'alamat'     => form_error('alamat'),
                    'map'     => form_error('map'),
                    'ig'     => form_error('ig'),
                    'tw'     => form_error('tw'),
                    'fb'     => form_error('fb'),
                    'yt'     => form_error('yt'),
                );
                $data = array(
                    'status'         => FALSE,
                    'errors'         => $errors
                );
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $profile['contact'] = [
                    'nama'     => $this->input->post('nama'),
                    'noHp'     => $this->input->post('noHp'),
                    'email'     => $this->input->post('email'),
                    'alamat'     => $this->input->post('alamat'),
                    'map'     => $this->input->post('map'),
                    'mediaSosial' => [
                        'ig'     => $this->input->post('ig'),
                        'tw'     => $this->input->post('tw'),
                        'fb'     => $this->input->post('fb'),
                        'yt'     => $this->input->post('yt'),
                    ]

                ];
                //Encode the array back into a JSON string.
                $json = json_encode($profile, TRUE);
                $up = file_put_contents(path_by_os(APPPATH . '/setting/profile_web.json'), $json);

                if ($up) {
                    $data['status'] = TRUE;
                    $data['message'] = "Success to update conctact";
                } else {
                    $data['status'] = FALSE;
                    $data['message'] = "Failed to update conctact";
                }
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }
}
