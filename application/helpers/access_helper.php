<?php

/**
 * Get all permission from user by userCode
 * @param string $userCode optional
 * @return array
 */

function getDateNow()
{
    return date('Y-m-d');
}
function getDateTimeNow()
{
    return date('Y-m-d H:i:s');
}
function getPermissionFromUser(string $userCode = ''): array
{
    $CI = &get_instance();
    $access = [];
    if ($userCode == '') {
        $userCode = $CI->session->userdata('userCode');
    } else {
        $userCode = $userCode;
    }
    if ($userCode == NULL) {
        return $access;
    } else {
        $role = $CI->db->get_where('role_user', ['userCode' => $userCode, 'deleteAt' => NULL])->result_array();
        $tempPermission = [];
        foreach ($role as $k => $v) {
            $permission = $CI->db
                ->select('p.permission')
                ->join('permission p', 'p.permissionCode=rp.permissionCode')
                ->get_where('role_permission rp', ['rp.roleCode' => $v['roleCode'], 'rp.deleteAt' => NULL])
                ->result_array();
            foreach ($permission as $p => $f) {
                if (!in_array($f['permission'], $tempPermission)) {
                    $tempPermission[] = $f['permission'];
                }
            }
        }

        $specialPermission = $CI->db
            ->select('p.permission')
            ->join('permission p', 'p.permissionCode=up.permissionCode')
            ->get_where('user_permission up', ['up.userCode' => $userCode, 'up.deleteAt' => NULL])
            ->result_array();
        foreach ($specialPermission as $k => $v) {
            if (!in_array($v['permission'], $tempPermission)) {
                $tempPermission[] = $v['permission'];
            }
        }
        $access = $tempPermission;
        return array_values($access);
    }
}

/**
 * Check permission of user
 * @param string $permission
 * @return bool
 */
function checkPermission(string $permission): bool
{
    if (in_array($permission, getPermissionFromUser())) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check user is login
 * @return bool
 */
function isLogin(): bool
{
    $CI = &get_instance();
    if ($CI->session->userdata('userCode') == NULL) {
        return false;
    } else {
        return true;
    }
}
