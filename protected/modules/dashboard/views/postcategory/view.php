<?php
/* @var $this CategoryController */
/* @var $model Navigasi */

$this->breadcrumbs=array(
	'Navigasis'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Navigasi', 'url'=>array('index')),
	array('label'=>'Create Navigasi', 'url'=>array('create')),
	array('label'=>'Update Navigasi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Navigasi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Navigasi', 'url'=>array('dashboard')),
);
?>

<h1>View Navigasi #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type',
		'paren_navigasi_id',
	),
)); ?>
