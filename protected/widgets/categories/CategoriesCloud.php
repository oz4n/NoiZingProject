<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriesCloud
 *
 * @author melengo
 */
class CategoriesCloud extends IWidgets {
    
    public function getRecentCategory() {
        $model = Category::model()->with('postsCount')->findAll("type='C'");
        return $this->generateCTree($model);
    }

     private function generateCTree($array, $parent = 0, $level = 0) {
        $has_children = false;
        foreach ($array as $value) {
            if ($value['parent_navigasi_id'] == $parent) {
                if ($has_children === false) {
                    $has_children = true;
                    echo '<ul  style="margin:0; list-style:none;" >';
                    $level++;
                }
                echo CHtml::link(ucwords($value['name']), $value['caturl'])." (".$value['postsCount'].")";
                echo '<li style="margin-left: 10px;">';
                $this->generateCTree($array, $value['id'], $level);
                echo '</li>';
            }
        }
        if ($has_children === true)
            echo '</ul>';
    }
    
    protected function renderContent() {
        $title = "Categories";
        $this->render('recentCategories', array('title' => $title));
    }
}
