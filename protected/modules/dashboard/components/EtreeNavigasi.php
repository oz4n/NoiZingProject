<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * http://yiibook.blogspot.com/2012/05/parent-child-tree-function.html
 */

/**
 * Description of EtreeNavigasi
 *
 * @author melengo
 */
class EtreeNavigasi extends CInputWidget {

    public $type = '';
    public $table = '';
    public $name = null;
    public $chekbox = null;
    public $post_id = '';

    public function run() {
        $table = Category::model()->with('postsCount')->findAll("type='".$this->type."'");
        $this->generateTree($table);
        parent::run();
    }

    private function generateTree($array, $parent = 0, $level = 0) {
        $has_children = false;
        $nav_has_post = NavigasiHasPost::model()->findAll("post_id=51");
        foreach ($array as $value) {
            if ($value['parent_navigasi_id'] == $parent) {
                if ($has_children === false) {
                    $has_children = true;
                    echo '<ul  style="margin:0; list-style:none;">';
                    $level++;
                }
              
                echo CHtml::activeCheckBox($this->model, $this->attribute, array('value'=>$value['id'],'style' => 'margin-top:-3px;')).' '.$value['name']." (".$value['postsCount'].")";
                              
                
                echo '<li style="margin-left: 10px;">';
                $this->generateTree($array, $value['id'], $level);
                echo '</li>';
            }
        }
        if ($has_children === true)
            echo '</ul>';
    }

//    public function getTree() {
//        $data = array();
//        $category = Navigasi::model()->with('postsCount')->findAll("type='C'");
//        foreach ($category as $v) {
//            $data[] = array(
//                'id' => $v->id,
//                'name' => $v->name,
//                'count' => $v->postsCount,
//                'parent_navigasi_id' => $v->parent_navigasi_id,
//            );
//        }
//        $tree = $this->makeTree($data);
//        $this->printNode($tree[0]['children'][0]);
//    }
//
//    private function makeTree($data) {
//        $tree = array(
//            array(
//                'id' => 0,
//                'name' => 'root',
//                'parent_navigasi_id' => 0,
//                'count' => 0,
//                'children' => array()
//            )
//        );
//
//        $treePtr = array(1 => & $tree[0]);
//        foreach ($data as $item) {
//            $children = &$treePtr[$item['parent_navigasi_id']]['children'];
//            $c = count($children);
//            $children[$c] = $item;
//            $children[$c]['children'] = array();
//            $treePtr[$item['id']] = &$children[$c];
//        }
//        return $tree;
//    }
//
//    private function printNode($node) {
//        echo "<ul class='root-id' style='list-style:none; margin-left: 0px;'>" . CHtml::checkBox($this->name, false, array('class' => 'tree-cat', 'style' => 'margin-top:-3px;', 'value' => $node['id'])) . '&nbsp;' . ucwords($node['name']) . " (" . $node['count'] . ")";
//        echo '<li style=" margin-left: 10px;">';
//        foreach ($node['children'] as $child) {
//            $this->printNode($child);
//        }
//        echo "</li></ul>";
//    }

}
