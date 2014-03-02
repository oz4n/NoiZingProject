<?php
/* @var $this NavMenuController */
/* @var $model NavMenu */

$this->breadcrumbs=array(
	'Nav Menus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NavMenu', 'url'=>array('index')),
	array('label'=>'Manage NavMenu', 'url'=>array('dashboard')),
);
?>

<h1>Create NavMenu</h1>

<?php echo $this->renderPartial('_form_create', array('model'=>$model)); ?>