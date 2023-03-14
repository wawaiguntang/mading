<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'vision';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
    }

    public function index()
    {
        $profile = getProfileWeb();
        $userPermission = getPermissionFromUser();
        if (!in_array('RVISION', $userPermission)) {
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
                "text" => "Visi dan Misi"
            ]
        ], 'Data Visi dan Misi');
        $params['visi'] = $profile['visi'];
        $params['misi'] = $profile['misi'];
        $data['_view'] = $this->module . '/index';
        $data['params'] = $params;
        viewRender($data);
    }
}
