<?php
/* @var $this GuestbookController */
/* @var $model GuestBook */

$this->breadcrumbs=array(
	'Guest Books'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List GuestBook', 'url'=>array('index')),
	array('label'=>'Create GuestBook', 'url'=>array('create')),
	array('label'=>'Update GuestBook', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GuestBook', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GuestBook', 'url'=>array('dashboard')),
);
?>

<h1>View GuestBook #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'email',
		'web_url',
		'content',
		'create_time',
	),
)); ?>
