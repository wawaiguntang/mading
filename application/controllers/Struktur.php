<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Struktur extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('structure/structure_model', 'structure');
        visitor();
    }
    public function index()
    {
        $data['_view'] = 'struktur';
        $this->load->view('layouts/front/main', $data);
    }

    public function listData()
    {
        $rr = $this->structure->get_all();

        if ($rr != NULL) {
            $structure = $this->tree($rr, 0, 'structureCode', 'structureParent');
            $structure = $structure[0];
        } else {
            $structure = [];
        }

        $data['status'] = TRUE;
        return $this->output->set_content_type('application/json')->set_output(json_encode($structure));
        // name: "Lao Lao",
        //         title: "general manager",
        //         children: [{
        //                 name: "Bo Miao",
        //                 title: "department manager",
        //                 className: "middle-level",
        //                 children: [{
        //                         name: "Li Jing",
        //                         title: "senior engineer",
        //                         className: ""
        //                     },
    }

    function tree(array &$elements, $parentId = 0, $id, $parent)
    {

        $branch = array();

        foreach ($elements as &$element) {

            if ($element[$parent] == $parentId) {
                $children = $this->tree($elements, $element[$id], $id, $parent);
                if ($children) {
                    $element['children'] = $children;
                }
                if ($element['structureParent'] != 0) {
                    $element['className'] = 'middle-level';
                }else{
                    $element['className'] = 'product-dept';
                    
                }
                $branch[] = $element;
                unset($element);
            }
        }
        return $branch;
    }
}
