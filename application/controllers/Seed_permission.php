<?php
class Seed_permission extends CI_Controller
{
  function index()
  {
    if (stripos(PHP_OS, "WIN") === 0) {
      $permission = json_decode(file_get_contents(APPPATH . '\\controllers\permission.json'), true);
    } else {
      $permission = json_decode(file_get_contents(APPPATH . '/controllers/permission.json'), true);
    }
    foreach ($permission as $one) {
      $cm = $this->db->get_where('module', ['module' => $one['module']])->row();
      if ($cm) {
        $moduleCode = $cm->moduleCode;
      } else {
        $this->db->insert('module', ['module' => $one['module']]);
        $moduleCode = $this->db->insert_id();
      }
      foreach ($one['permission'] as $two) {
        $cp = $this->db->get_where('permission', ['permission' => $two['permission']])->row();
        if ($cp) {
          echo 'permission ' . $two['permission'] . ' is exist';
          if (['description'] != $cp->description) {
            $this->db->where('permission', $two['permission'])->update('permission', ['description' => $two['description']]);
            if ($this->db->affected_rows()) {
              echo '<br>';
              echo 'update desc permission ' . $cp->description . ' to => ' . $two['description'];
            }
          }

          echo '<br>';
        } else {
          $this->db->insert('permission', ['moduleCode' => $moduleCode, 'permission' => $two['permission'], 'description' => $two['description']]);
          $id = $this->db->insert_id();
          echo 'permission ' . $two['permission'] . ' success add with id ' . $id;
          echo '<br>';
        }
      }
    }
    echo '<br><br>';
    //set to su
    $per = $this->db->get_where('permission', ['deleteAt' => NULL])->result();
    foreach ($per as $r) {
      $cp = $this->db->get_where('role_permission', ['permissionCode' => $r->permissionCode])->row();
      if ($cp) {
        echo 'role permission ' . $r->permission . ' is exist in super admin';
        echo '<br>';
      } else {
        $this->db->insert('role_permission', ['permissionCode' => $r->permissionCode, 'roleCode' => 1]);
        $id = $this->db->insert_id();
        echo 'role permission '  . $r->permission . ' success add to super admin with id ' . $id;
        echo '<br>';
      }
    }
  }
}
