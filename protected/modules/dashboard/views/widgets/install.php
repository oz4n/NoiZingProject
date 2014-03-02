<?php
/* @var $this PluginsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'More' => array('/dashboard/more/index'),
        'Components' => array('/dashboard/components/index'),
        'Install Widget',       
    )
);
?>