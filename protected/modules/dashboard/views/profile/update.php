<?php
$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->account_id=>array('view','id'=>$model->account_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Profile','url'=>array('index')),
	array('label'=>'Create Profile','url'=>array('create')),
	array('label'=>'View Profile','url'=>array('view','id'=>$model->account_id)),
	array('label'=>'Manage Profile','url'=>array('dashboard')),
);
?>

<h1>Update Profile <?php echo $model->account_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>