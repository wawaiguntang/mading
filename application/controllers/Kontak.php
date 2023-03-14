<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;

class Kontak extends CI_Controller
{
    public function __construct()
    {
        
        parent::__construct();
        // $this->load->model('service/service_model', 'service');
        visitor();
    }
    public function index()
    {
        $profile = getProfileWeb();
        $data['contact'] = $profile['contact'];
        $data['_view'] = 'kontak';
        $this->load->view('layouts/front/main', $data);
    }


    public function sendSuggestion()
    {
        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('type', 'Tipe', 'trim|required');
        $this->form_validation->set_rules('content', 'Isi', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $errors = array(
                'name'     => form_error('name'),
                'type'     => form_error('type'),
                'email'     => form_error('email'),
                'content'     => form_error('content'),
            );
            $data = array(
                'status'         => FALSE,
                'errors'         => $errors
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $insert = [
                'name'     => $this->input->post('name'),
                'type'     => $this->input->post('type'),
                'email'     => $this->input->post('email'),
                'content'     => $this->input->post('content'), 
            ];
            $in = $this->db->insert('suggestion',$insert);
            
            if ($insert) {
                // $this->set('smtp.gmail.com','587','user','password');
                // $this->send($this->input->post('email'),$this->input->post('name'),'emailTo','administrator',$this->input->post('type'),$this->input->post('content'));
                $data['status'] = TRUE;
                $data['message'] = "Berhasil mengirim pesan";
            } else {
                $data['status'] = FALSE;
                $data['message'] = "Gagal mengirim pesan";
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    private $host;
    private $port;
    private $username;
    private $password;
    private function set(string $host, string $port, string $username, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    private function send(string $emailFrom, string $nameFrom, string $emailTo, string $nameTo, string $subject = '', string  $msgHTML = '')
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = $this->host;
        $mail->Port = $this->port;
        $mail->SMTPAuth = true;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->setFrom($emailFrom, $nameFrom);
        $mail->addReplyTo($emailFrom, $nameFrom);
        $mail->addAddress($emailTo, $nameTo);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->msgHTML($msgHTML);
        if (!$mail->send()) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
