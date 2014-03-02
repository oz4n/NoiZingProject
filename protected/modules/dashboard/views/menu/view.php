<?php
/* @var $this NavMenuController */
/* @var $model NavMenu */


?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'slug',
		'position',
		'term_id',
		'term_taxonomy_id',
	),
)); ?>
