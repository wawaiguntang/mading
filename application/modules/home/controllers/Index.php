<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MX_Controller
{
    private $module = 'home';

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
                "text" => "Beranda"
            ]
        ], 'Data Beranda');
        $params['beranda'] = $profile['beranda'];
        $data['_view'] = $this->module . '/index';
        $data['params'] = $params;
        viewRender($data);
    }
}
