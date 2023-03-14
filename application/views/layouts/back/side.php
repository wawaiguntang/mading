<?php
$profile = getProfileWeb();
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl ms-3 my-3 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?= base_url('dashboard/index') ?>">
            <img src="<?php echo base_url($profile['icon']) ?>" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold"><?php echo $profile['name'] ?></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-75" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <?php
            $menuHtml = '';
            $userPermission = getPermissionFromUser();
            if (stripos(PHP_OS, "WIN") === 0) {
                $pathMenu = APPPATH . 'views\\layouts\\menu.json';
            } else {
                $pathMenu = APPPATH . 'views/layouts/menu.json';
            }
            $menu = json_decode(file_get_contents($pathMenu), true);
            foreach ($menu['menu'] as $k => $v) {
                if (isset($v['menu'])) {
                    $header = false;
                    $menu = [];
                    $menuUrls = [];
                    foreach ($v['menu'] as $m => $n) {
                        foreach ($userPermission as $p => $q) {
                            if (in_array($q, $n['access'])) {
                                $header = true;
                                $menu[] = $n;
                                $menuUrls[] = $n['url'];
                                break;
                            }
                        }
                    }

                    if ($header == true) {
                        $menuHtml .= '<li class="nav-item">
                            <a data-bs-toggle="collapse" href="#' . $v['code'] . '" class="nav-link ' . (in_array($this->uri->uri_string(), $menuUrls) ? 'active' : '') . ' collapsed" aria-controls="' . $v['code'] . '" role="button" aria-expanded="' . (in_array($this->uri->uri_string(), $menuUrls) ? 'true' : 'false') . '">
                                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center ' . (in_array($this->uri->uri_string(), $menuUrls) ? 'text-white' : 'text-gray') . '">
                                ' . $v['icon'] . '
                                </div>
                                <span class="nav-link-text ms-1">' . $v['header'] . '</span>
                            </a>
                            <div class="collapse ' . (in_array($this->uri->uri_string(), $menuUrls) ? 'show' : '') . '" id="' . $v['code'] . '" style="">
                                <ul class="nav ms-4 ps-3">';
                        foreach ($menu as $d => $c) {
                            $menuHtml .= '
                                    <li class="nav-item">
                                        <a class="route-link nav-link ' . ($this->uri->uri_string() == $c['url'] ? 'active' : '') . '" href="' . base_url($c['url']) . '">
                                            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center ' . ($this->uri->uri_string() == $c['url'] ? 'text-white' : 'text-gray') . '">
                                                ' . $c['icon'] . '
                                            </div>
                                            <span class="nav-link-text ms-1">' . $c['text'] . '</span>
                                        </a>
                                    </li>
                                    ';
                        }
                        $menuHtml .= '     
                                </ul>
                            </div>
                        </li>';
                    }
                } else {
                    $menuHtml .= '
                        <li class="nav-item">
                            <a class="route-link nav-link ' . ($this->uri->uri_string() == $v['url'] ? 'active' : '') . '" href="' . base_url($v['url']) . '">
                                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center ' . ($this->uri->uri_string() == $v['url'] ? 'text-white' : 'text-gray') . '">
                                    ' . $v['icon'] . '
                                </div>
                                <span class="nav-link-text ms-1">' . $v['text'] . '</span>
                            </a>
                        </li>';
                }
            }
            echo $menuHtml;

            ?>
        </ul>
    </div>
</aside>