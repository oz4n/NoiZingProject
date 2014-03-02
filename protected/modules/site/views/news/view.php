<?php
/* @var $this PagesController */
/* @var $pages Page */
$this->subPageTitle = "News";
$this->meta_keywords = $pages->tags;
$this->meta_description = $pages->title;
$this->meta_author = $pages->account->username;
$this->pageTitle = $pages->title;
$this->breadcrumbs = array(
	'separator' => '<i class="icon-angle-right"></i>',
	'htmlOptions' => array('class' => 'pull-right'),
	'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
	'links' => array("News" => Yii::app()->createUrl('/site/news/index'), ucwords($pages->title))
);
?>
<div class="row-fluid">
	<div class="span8">
		<?php
		$this->renderPartial('_view_detail', array(
			'pages' => $pages,
			'comment'=>$comment,
			'layouts' => $layouts
		));
		?>
	</div>
	<div class="span4"></div>
</div>