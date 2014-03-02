<?php
/* @var $this GuestbookController */
/* @var $model GuestBook */

$this->breadcrumbs=array(
	'Guest Books'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GuestBook', 'url'=>array('index')),
	array('label'=>'Create GuestBook', 'url'=>array('create')),
	array('label'=>'View GuestBook', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GuestBook', 'url'=>array('dashboard')),
);
?>

<h1>Update GuestBook <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>