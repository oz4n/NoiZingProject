<?php
/* @var $this PagesController */
/* @var $pages Page */
$this->pageTitle = "News";
$this->subPageTitle = 'News';
$this->meta_keywords = "news";

$this->breadcrumbs = array(
	'separator' => '<i class="icon-angle-right"></i>',
	'htmlOptions' => array('class' => 'pull-right'),
	'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
	'links' => array("News")
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
