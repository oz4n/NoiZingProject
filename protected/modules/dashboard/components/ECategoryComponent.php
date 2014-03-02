<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ECategoryComponent
 *
 * @author melengo
 */

class ECategoryComponent extends CWidget {

    public $post;
    public $id;
    public $type;
    protected $_categoryTree = array();
    protected $_categoryFlat = array();

    public function __construct($post, $type) {
        $this->post = $post;
        $this->type = $type;
    }

    public function renderTree() {
        if ($this->findParentZeroEqual($this->type) == true) {
            $this->widget('ext.dynatree.DynaTree', array(
                'id' =>  $this->id,
                'attribute' => CHtml::activeName($this->post, 'categories'),
                'data' => $this->getCategoryTree('tree', $this->type),
                'selection' => Relationships::getIds('term_taxonomy_id', 'post_id', $this->post->id),
            ));
        }else{
            return false;
        }
    }
    public function renderTreeforNavmenu() {
        if ($this->findParentZeroEqual($this->type) == true) {
            $this->widget('ext.dynatree.DynaTree', array(
                'id' =>  $this->id,
                'attribute' => CHtml::activeName($this->post, 'termTaxonomy'),
                'data' => $this->getCategoryTree('tree', $this->type),
                'options' => array(
                    'checkbox' => true
                )
//            'selection' => Relationships::getIds('term_taxonomy_id', 'post_id', $this->post->id),
            ));
        } else {
            return false;
        }
    }
    protected function getCategoryTree($format,$type) {
        $categories = TermTaxonomy::model()->findAll(array('condition' => 'type="'.$type.'"'));
        foreach ($categories as $c) {
            if ($c->parent == null)
                $c->parent = 0;
            $this->_categoryTree[$c->parent][$c->id] = $c->term->name . ' (' . $c->postsCount . ')';
        }

        switch ($format) {
            case 'flat':
                $this->level2Label();
                return $this->_categoryFlat;
                break;
            case 'tree':
                return $this->formatTree();
                break;
        }
    }

    protected function level2Label($parent_id = 0, $level = 0) {
        foreach ($this->_categoryTree[$parent_id] as $key => $val) {
            $this->_categoryFlat[$key] = str_repeat('&nbsp;', 4 * $level) . $val;
            if (isset($this->_categoryTree[$key]) && $key > 0)
                $this->level2Label($key, $level + 1);
        }
    }

    protected function formatTree($parent_id = 0) {
        $data = array();
        foreach ($this->_categoryTree[$parent_id] as $key => $val) {
            $children = isset($this->_categoryTree[$key]) ? $this->formatTree($key) : null;
            $expand = $children ? true : false;
            $data[] = array('id' => $key, 'title' => $val, 'icon' => false, 'expand' => $expand, 'children' => $children);
        }
        return $data;
    }
    
    protected function findParentZeroEqual($type){
        if(TermTaxonomy::model()->findAll(array('condition' => 'type="'.$type.'" && parent=0')) != null){
            return true;
        }else {
            return false;
        }
    }

}
