<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuCloud
 *
 * @author melengo
 */
class MenuCloud extends CWidget {

    public function run() {
        $this->renderMenu();
        parent::run();
    }

    protected function treeMenu($array, $parent = 0) {
        $t = new IMachTagHtml();
        $data = array();
        foreach ($array as $v) {
            if ($v['parent'] == $parent) {
                $data[] = array(
                    'id' => $v['id'],
                    'label' => ucwords($v['name']), 
                    'icon' =>$parent == 0 ? '' : 'icon-angle-right',
                    'url' => $v['type'] == 'component' ? Yii::app()->createUrl($v['slug']) : (count($t->getUrlMach($v['slug'])) == 0 ? Yii::app()->createUrl('/site/pages/index', array('menu' => $v['slug'])) : $v['slug']),
                    'items' => $this->treeMenu($array, $v['id']),                    
                );
            }
        }
        return $data;
    }

    public function array_push_array(array &$array) {
        $values = func_get_args();
        array_shift($values);
        foreach ($values as $v) {
            if (is_array($v)) {
                if (count($v) > 0) {
                    foreach ($v as $w) {
                        $array[] = $w;
                    }
                }
            } else {
                $array[] = $v;
            }
        }
        return $array;
    }

    protected function renderMenu() {
        $data = NavMenu::model()->findAll(array('order' => 'position'));
        $dbmenu = $this->treeMenu($data);
        $account = array(              
            array(
                'label' => 'Account',
                'url' => '#',
                'items' => array(
                    array(
                        "label" => 'Dashboard',
                        'icon' =>'home',
                        'url' => array('/dashboard/default/index'),
                    ),
                    array(
                        "label" => 'New Message (' . Comment::model()->getPendingCommentCount() . ')',
                        'icon' =>'comment',
                        'url' => array('/dashboard/comments'),
                    ),                   
                    array(
                        "label" => 'Edit Account',
                        'icon' =>'user',
                        'url' => array('/dashboard/accounts'),
                    ),
                    array(
                        "label" => 'Logout (' . Yii::app()->user->name . ')',
                        'icon' =>'off',
                        'url' => array('/logout'),
                    )
                ), "visible" => !Yii::app()->user->isGuest
                ),
            array('label'=>'<i class="icon-search search-btn"></i>', 'url'=>'','linkOptions'=> array('class'=>'search')),
            );
        $ds = $this->array_push_array($dbmenu, $account);
//        $home = array(array('label' => 'Home','url'=>array('/site/default/index'),'visible' => GlobalConfig::extHome()->status == 1));
//        $mn = $this->array_push_array($home, $ds);
        $arraydata = new CArrayDataProvider($ds, array(
                    'pagination' => array(
                        'pageSize' => 100
                    )
                ));


        $this->widget('bootstrap.widgets.TbNavbar', array(
            'type' => null, // null or 'inverse'
            'fixed' => false,
            'brand' => false,
            'brandUrl' => '#',
            'collapse' => false, // requires bootstrap-responsive.css
             
            'items' => array(                
                array(
                    'class' => 'bootstrap.widgets.TbMenu',                   
                    'items' => $arraydata->rawData,                     
                    'encodeLabel' => false,
                    'htmlOptions' => array('class' => 'top-2')
                ),
            ),
        ));
    }

}

