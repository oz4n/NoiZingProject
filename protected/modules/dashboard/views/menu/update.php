<?php
/* @var $this NavMenuController */
/* @var $model NavMenu */

$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'More' => array('/dashboard/more/index'),
        'Appearance' => array('/dashboard/appearance/index'),
        'List Menu' => array('/dashboard/menu/index'),
        'Edit Menu',
    )
);
?>

<?php echo $this->renderPartial('_form_update', array('menu'=>$model)); ?>