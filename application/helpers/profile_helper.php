<?php

/**
 * get all profile in file json
 * @return array
 */
function getProfileWeb(): array
{
    if (stripos(PHP_OS, "WIN") === 0) {
        $json = file_get_contents(APPPATH . '\setting\profile_web.json');
    } else {
        $json = file_get_contents(APPPATH . '/setting/profile_web.json');
    }
    return json_decode($json, true);
}


function tanggal_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);
    return substr($split[2], 0, 2) . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}

function build(array &$elements, $parentId = 0, $id, $parent)
{

    $branch = array();

    foreach ($elements as &$element) {

        if ($element[$parent] == $parentId) {
            $children = build($elements, $element[$id], $id, $parent);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
            unset($element);
        }
    }
    return $branch;
}


function path_by_os(string $path)
{
    if (stripos(PHP_OS, "WIN") === 0) {
        $data = str_replace('/', '\\', $path);
    } else {
        $data = str_replace('\\', '/', $path);
    }
    return $data;
}

function slugify($text)
{
    // Strip html tags
    $text = strip_tags($text);
    // Replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // Transliterate
    setlocale(LC_ALL, 'en_US.utf8');
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // Trim
    $text = trim($text, '-');
    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    // Lowercase
    $text = strtolower($text);
    // Check if it is empty
    if (empty($text)) {
        return 'n-a';
    }
    // Return result
    return $text;
}


function visitor()
{
    $CI = &get_instance();
    $ip    = $CI->input->ip_address();
    $date  = date("Y-m-d");
    $waktu = time();
    $timeinsert = date("Y-m-d H:i:s");

    $s = $CI->db->query("SELECT * FROM visitor WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
    $ss = isset($s) ? ($s) : 0;

    if ($ss == 0) {
        $CI->db->query("INSERT INTO visitor(ip, date, hits, online, time) VALUES('" . $ip . "','" . $date . "','1','" . $waktu . "','" . $timeinsert . "')");
    } else {
        $CI->db->query("UPDATE visitor SET hits=hits+1, online='" . $waktu . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
    }
}

function getVisitor()
{
    $CI = &get_instance();

    $date  = date("Y-m-d");

    $pengunjunghariini  = $CI->db->query("SELECT * FROM visitor WHERE date='" . $date . "' GROUP BY ip")->num_rows(); // Hitung jumlah pengunjung

    $dbpengunjung = $CI->db->query("SELECT COUNT(hits) as hits FROM visitor")->row();

    $totalpengunjung = isset($dbpengunjung->hits) ? ($dbpengunjung->hits) : 0; // hitung total pengunjung

    $bataswaktu = time() - 300;

    $pengunjungonline  = $CI->db->query("SELECT * FROM visitor WHERE online > '" . $bataswaktu . "'")->num_rows(); // hitung pengunjung online

    $data['pengunjunghariini'] = $pengunjunghariini;
    $data['totalpengunjung'] = $totalpengunjung;
    $data['pengunjungonline'] = $pengunjungonline;

    return $data;
}
