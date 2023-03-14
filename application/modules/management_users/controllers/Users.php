<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MX_Controller
{
    private $module = 'management_users';

    public function __construct()
    {
        parent::__construct();
        (isLogin() == false) ? redirect('authentication/logout') : '';
        $this->load->model($this->module . '/users_model', 'users');
        $this->load->model($this->module . '/roles_model', 'roles');
    }

    public function index()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('RU', $userPermission)) {
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
                "text" => "Management Users",
                "url" => base_url('management_users/users')
            ],
            [
                "text" => "Users",
            ]
        ], 'Data Users');
        $data['_view'] = $this->module . '/users/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CU', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Add Data',
                'userCode' => NULL,
                'email' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Management Users",
                    "url" => base_url('management_users/users')
                ],
                [
                    "text" => "Users",
                    "action" => "backPrevious()"
                ],
                [
                    "text" => "Add Users",
                ]
            ], 'Add Users');
            $data['_view'] = $this->module . '/users/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $userCode = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('UU', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($userCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID user is required"
                );
            } else {
                $user = $this->users->get_by_id($userCode);
                if ($user == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "User not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'userCode' => $user->userCode,
                        'email' => $user->email,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Management Users",
                            "url" => base_url('management_users/users')
                        ],
                        [
                            "text" => "Users",
                            "action" => "backPrevious()"
                        ],
                        [
                            "text" => "Edit Users",
                        ]
                    ], 'Edit Users');
                    $data['_view'] = $this->module . '/users/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function info($userCode)
    {
        $userPermission = getPermissionFromUser();
        if (count(array_intersect($userPermission, ['RRU', 'RUP'])) > 0) {
            $data = array();
            $data['status'] = TRUE;
            if ($userCode == '' || $userCode == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID user is required"
                );
            } else {
                $user = $this->users->get_by_id($userCode);
                if ($user == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "User not found!"
                    );
                } else {
                    $roleHTML = '';
                    if (in_array('RRU', $userPermission)) {
                        $role = $this->users->get_role_id($userCode);
                        $roleHTML .= '<table>';
                        foreach ($role as $r) {
                            $roleHTML .= '<tr><td class="d-flex"><p class="fs-6 my-auto">' . $r['role'] . '</p> ' . ((in_array('DRU', $userPermission)) ? '<i class="ri-delete-bin-line ri-md text-danger my-auto" role="button" title="Delete Role" onclick="deleteRole(' . $r['ruCode'] . ')"></i>' : '') . '</td></tr>';
                        }
                        $roleHTML .= '</table>';
                    } else {
                        $roleHTML .= '<p>You don\'t have access to see role</p>';
                    }

                    $specialPermissionHTML = '';
                    if (in_array('RUP', $userPermission)) {
                        $specialPermission = $this->users->get_special_permission_id($userCode);
                        $specialPermissionHTML .= '<table>';
                        foreach ($specialPermission as $r) {
                            $specialPermissionHTML .= '<tr><td class="d-flex"><p class="fs-6 my-auto">' . $r['description'] . '</p> ' . ((in_array('DUP', $userPermission)) ? '<i class="ri-delete-bin-line ri-md text-danger my-auto" role="button" title="Delete Special Permission" onclick="deletePermission(' . $r['upCode'] . ')"></i>' : '') . '</td></tr>';
                        }
                        $specialPermissionHTML .= '</table>';
                    } else {
                        $specialPermissionHTML .= '<p>You don\'t have access to see special permission</p>';
                    }
                    $params = [
                        'userPermission' => $userPermission,
                        'userCode' => $user->userCode,
                        'email' => $user->email,
                        'roleHTML' => $roleHTML,
                        'specialPermissionHTML' => $specialPermissionHTML,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Management Users",
                            "url" => base_url('management_users/users')
                        ],
                        [
                            "text" => "Users",
                            "url" => base_url('management_users/users')
                        ],
                        [
                            "text" => "Detail Users",
                        ]
                    ], 'Detail Users');
                    $data['_view'] = $this->module . '/users/detail/index';
                    $data['params'] = $params;
                    viewRender($data);
                }
            }
        } else {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    private function permissionHtml(string $title = '', string $userCode = '', string $permissionCode = '')
    {
        $getModule = $this->db->get_where('module', ['deleteAt' => NULL])->result_array();
        $permission = '';
        foreach ($getModule as $g => $f) {
            $getPermission = $this->db->get_where('permission', ['moduleCode' => $f['moduleCode'], 'deleteAt' => NULL])->result_array();
            $permission .= '<optgroup label="' . $f['module'] . '">';
            foreach ($getPermission as $k => $v) {
                $permission .= '<option value="' . $v['permissionCode'] . '">' . $v['description'] . '</option>';
            }
            $permission .= '</optgroup>';
        }
        $params = [
            'title' => $title,
            'permission' => $permission,
            'permissionCode' => $permissionCode,
            'userCode' => $userCode,
        ];

        return  $params;
    }

    public function permission($userCode = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CUP', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($userCode == '' || $userCode == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID user is required"
                );
            } else {
                $user = $this->users->get_by_id($userCode);
                if ($user == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "User not found!"
                    );
                } else {
                    $data['status'] = TRUE;
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Management Users",
                            "url" => base_url('management_users/users')
                        ],
                        [
                            "text" => "Users",
                            "url" => base_url('management_users/users')
                        ],
                        [
                            "text" => "Detail Users",
                            "action" => "backPrevious"
                        ],
                        [
                            "text" => "Add Special Permission",
                        ],
                    ], 'Special Permission');
                    $data['_view'] = $this->module . '/users/detail/permission/form';
                    $data['params'] = $this->permissionHtml('Add Permission', $user->userCode);
                    viewRender($data);
                }
            }
        }
    }

    private function roleHtml(string $title = '', string $userCode = '', string $roleCode = '')
    {
        $getRole = $this->roles->get_all();
        $roles = [];
        foreach ($getRole as $k => $v) {
            $roles[$v['roleCode']] = $v['role'];
        }
        $params = [
            'title' => $title,
            'roles' => $roles,
            'roleCode' => $roleCode,
            'userCode' => $userCode,
        ];
        return $params;
    }

    public function role($userCode = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CRU', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($userCode == '' || $userCode == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID user is required"
                );
            } else {
                $user = $this->users->get_by_id($userCode);
                if ($user == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "User not found!"
                    );
                } else {
                    $data['status'] = TRUE;
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Management Users",
                            "url" => base_url('management_users/users')
                        ],
                        [
                            "text" => "Users",
                            "url" => base_url('management_users/users')
                        ],
                        [
                            "text" => "Detail Users",
                            "action" => "backPrevious"
                        ],
                        [
                            "text" => "Add Role",
                        ],
                    ], 'Add Role');
                    $data['_view'] = $this->module . '/users/detail/role/form';
                    $data['params'] = $this->roleHtml('Add Role', $user->userCode);
                    viewRender($data);
                }
            }
        }
    }
}
