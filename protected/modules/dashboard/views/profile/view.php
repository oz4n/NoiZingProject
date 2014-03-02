<?php
$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->account_id,
);

$this->menu=array(
	array('label'=>'List Profile','url'=>array('index')),
	array('label'=>'Create Profile','url'=>array('create')),
	array('label'=>'Update Profile','url'=>array('update','id'=>$model->account_id)),
	array('label'=>'Delete Profile','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->account_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Profile','url'=>array('dashboard')),
);
?>

<h1>View Profile #<?php echo $model->account_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'account_id',
		'first_name',
		'last_name',
		'gender',
		'address',
		'about',
		'birthday',
		'image',
	),
)); ?>
