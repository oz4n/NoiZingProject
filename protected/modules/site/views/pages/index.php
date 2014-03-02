<?php
/* @var $this PagesController */
/* @var $pages Page */
Yii::app()->session['menu'] = $_GET['menu'];
$this->pageTitle = $_GET['menu'];
$this->subPageTitle = ucwords($pagemenu->name);
$this->meta_keywords = $_GET['menu'];

$this->breadcrumbs = array(
	'separator' => '<i class="icon-angle-right"></i>',
	'htmlOptions' => array('class' => 'pull-right'),
	'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
	'links' => array(ucwords($pagemenu->name))
);
?>
<div class="row-fluid">
	<div class="span8">
		<?php
		$this->widget('bootstrap.widgets.TbListView', array(
			'dataProvider' => $pages,
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
