<?php

// ['_view','params','breadcrumb']
function viewRender($data)
{
  $CI = &get_instance();
  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && $data['_view']) {
    if ($data['_view']) {
      $par = isset($data['params']) ? $data['params'] : [];
      $dataRender['breadcrumb'] = isset($data['breadcrumb']) ? $data['breadcrumb'] : [];
      $dataRender['html'] = $CI->load->view($data['_view'], $par, TRUE);
    } else {
      $dataRender['html'] = 'Content Not Set';
    }
    $isLogin = isset($data['isLogin']) ? $data['isLogin'] : false;
    if ($isLogin) {
      $dataRender['isLogin'] = true;
    }
    $dataRender['status'] = true;
    return $CI->output->set_content_type('application/json')->set_output(json_encode($dataRender));
  } else {
    $isLogin = isset($data['isLogin']) ? $data['isLogin'] : false;
    if ($isLogin) {
      $CI->load->view($data['_view']);
    } else {
      $params =  isset($data['params']) ? $data['params'] : [];
      $params['_view'] = $data['_view'];
      $params['breadcrumb'] = isset($data['breadcrumb']) ? $data['breadcrumb'] : null;
      return $CI->load->view('layouts/back/main', $params);
    }
  }
}
