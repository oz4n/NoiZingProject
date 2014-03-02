<?php
/* @var $this TagsController */
/* @var $tags Page */

Yii::app()->session['tag'] = $_GET['tag'];
$this->subPageTitle = ucwords($_GET['tag']);
$this->pageTitle = $_GET['tag'];
$this->meta_keywords = $_GET['tag'];
$this->breadcrumbs = array(
	'separator' => '<i class="icon-angle-right"></i>',
	'htmlOptions' => array('class' => 'pull-right'),
	'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
	'links' => array(ucwords($_GET['tag']))
);
?>
<div class="row-fluid">
	<div class="span8">

		<?php
		$this->widget('bootstrap.widgets.TbListView', array(
			'dataProvider' => $tags,
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
