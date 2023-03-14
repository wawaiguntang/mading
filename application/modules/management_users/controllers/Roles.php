<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends MX_Controller
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
        if (!in_array('RR', $userPermission)) {
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
                "url" => base_url('management_users/roles/index')
            ],
            [
                "text" => "Roles",
            ]
        ], 'Data Roles');
        $data['_view'] = $this->module . '/roles/index';
        $data['params'] = $params;
        viewRender($data);
    }

    public function add()
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CR', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            $params = [
                'title' => 'Add Data',
                'roleCode' => NULL,
                'role' => NULL,
            ];
            $data['breadcrumb'] = breadcrumb([
                [
                    "text" => "Management Users",
                    "url" => base_url('management_users/roles/index')
                ],
                [
                    "text" => "Roles",
                    "action" => "backPrevious()"
                ],
                [
                    "text" => "Add Roles"
                ]
            ], 'Add Roles');
            $data['_view'] = $this->module . '/roles/form';
            $data['params'] = $params;
            viewRender($data);
        }
    }

    public function edit(string $roleCode = '')
    {

        $userPermission = getPermissionFromUser();
        if (!in_array('UR', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $data['status'] = TRUE;
            if ($roleCode == '') {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID role is required"
                );
            } else {
                $role = $this->roles->get_by_id($roleCode);
                if ($role == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $params = [
                        'title' => 'Edit Data',
                        'roleCode' => $role->roleCode,
                        'role' => $role->role,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Management Users",
                            "url" => base_url('management_users/roles')
                        ],
                        [
                            "text" => "Roles",
                            "action" => "backPrevious()"
                        ],
                        [
                            "text" => "Edit Roles"
                        ]
                    ], 'Edit Roles');
                    $data['_view'] = $this->module . '/roles/form';
                    $data['params'] = $params;
                    return viewRender($data);
                }
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function info($roleCode)
    {
        $userPermission = getPermissionFromUser();
        if (count(array_intersect($userPermission, ['RRP', 'CRP', 'DRP'])) > 0) {
            $data = array();
            $data['status'] = TRUE;
            if ($roleCode == '' || $roleCode == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID role is required"
                );
            } else {
                $role = $this->roles->get_by_id($roleCode);
                if ($role == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $getModule = $this->db->get_where('module', ['deleteAt' => NULL])->result_array();
                    $permission = [];
                    foreach ($getModule as $g => $f) {
                        $getPermission = $this->db->join('permission', 'permission.permissionCode=role_permission.permissionCode')
                            ->get_where('role_permission', ['permission.moduleCode' => $f['moduleCode'], 'role_permission.deleteAt' => NULL, 'role_permission.roleCode' => $roleCode])
                            ->result_array();
                        foreach ($getPermission as $k => $v) {
                            $permission[$f['module']][$v['rpCode']] = $v['description'];
                        }
                    }

                    $permissionHTML = '';
                    if (in_array('RRP', $userPermission)) {
                        $permissionHTML .= '<table>';
                        foreach ($permission as $r => $k) {
                            if ($k != NULL) {
                                $permissionHTML .= '<tr><th class="d-flex"><p class="fs-6 my-auto fw-bold">' . $r . '</p></th></tr>';
                                foreach ($k as $v => $s) {
                                    $permissionHTML .= '<tr><td class="d-flex"><p class="fs-6 my-auto">  - ' . $s . '</p> ' . ((in_array('DRP', $userPermission)) ? '<i class="ri-delete-bin-line ri-md text-danger my-auto" role="button" title="Delete Permission" onclick="deletePermission(' . $v . ')"></i>' : '') . '</td></tr>';
                                }
                            }
                        }
                        $permissionHTML .= '</table>';
                    } else {
                        $permissionHTML .= '<p>You don\'t have access to see role</p>';
                    }

                    $params = [
                        'userPermission' => $userPermission,
                        'roleCode' => $role->roleCode,
                        'role' => $role->role,
                        'permissionHTML' => $permissionHTML,
                    ];
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Management Users",
                            "url" => base_url('management_users/roles/index')
                        ],
                        [
                            "text" => "Roles",
                            "action" => "backPrevious()"
                        ],
                        [
                            "text" => "Detail Roles"
                        ]
                    ], 'Detail Roles');
                    $data['_view'] = $this->module . '/roles/detail/index';
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

    private function permissionHtml(string $title = '', string $roleCode = '')
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
            'roleCode' => $roleCode,
            'permission' => $permission,
        ];

        return $params;
    }

    public function addPermission($roleCode = '')
    {
        $userPermission = getPermissionFromUser();
        if (!in_array('CRP', $userPermission)) {
            $data = array(
                'status'         => FALSE,
                'message'         => "You don't have access!"
            );
            return $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            if ($roleCode == '' || $roleCode == NULL) {
                $data = array(
                    'status'         => FALSE,
                    'message'         => "ID role is required"
                );
            } else {
                $role = $this->roles->get_by_id($roleCode);
                if ($role == NULL) {
                    $data = array(
                        'status'         => FALSE,
                        'message'         => "Role not found!"
                    );
                } else {
                    $data['status'] = TRUE;
                    $data['breadcrumb'] = breadcrumb([
                        [
                            "text" => "Management Users",
                            "url" => base_url('management_users/roles')
                        ],
                        [
                            "text" => "Roles",
                            "action" => "backPrevious()"
                        ],
                        [
                            "text" => "Detail Roles",
                            "action" => "backPrevious()"
                        ],
                        [
                            "text" => "Add Permission"
                        ]
                    ], 'Add Permission');
                    $data['_view'] = $this->module . '/roles/detail/permission/form';
                    $data['params'] =  $this->permissionHtml('Add Permission', $role->roleCode);
                    viewRender($data);
                }
            }
        }
    }
}
