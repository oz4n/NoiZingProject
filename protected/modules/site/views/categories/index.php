<?php
/* @var $this TagsController */
/* @var $tags Page */

Yii::app()->session['category'] = $_GET['category'];
$this->subPageTitle = ucwords($_GET['category']);
$this->pageTitle = $_GET['category'];
$this->meta_keywords = $_GET['category'];
$this->breadcrumbs = array(
	'separator' => '<i class="icon-angle-right"></i>',
	'htmlOptions' => array('class' => 'pull-right'),
	'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
	'links' => array(ucwords($_GET['category']))
);
?>
<div class="row-fluid">
	<div class="span8">
		<?php
		$this->widget('bootstrap.widgets.TbListView', array(
			'dataProvider' => $categories,
			'itemView' => '_view',
			'ajaxUpdate'=>false,
			'template' => "{items}\n{pager}",
			'viewData' => array('switch' => true, 'layouts' => $layouts),
			'htmlOptions' => array('style' => 'padding-top:0;')
		));
		?>
	</div>
	<div class="span4"></div>
</div>
