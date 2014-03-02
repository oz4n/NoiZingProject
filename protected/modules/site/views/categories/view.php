<?php
/* @var $this TagsController*/
/* @var $tags Page*/
$this->subPageTitle = ucwords($_GET['category']);
$this->meta_keywords = $categories->tags;
$this->meta_description = $categories->title;
$this->meta_author = $categories->account->username;
$this->pageTitle = $categories->title;
$this->breadcrumbs = array(
	'separator' => '<i class="icon-angle-right"></i>',
	'htmlOptions' => array('class' => 'pull-right'),
	'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
	'links' => array(ucwords($_GET['category']) => Yii::app()->createUrl('/site/categories/index', array('category' => $_GET['category'])), ucwords($categories->title))
);
?>
<div class="row-fluid">
	<div class="span8">
		<?php
		$this->renderPartial('_view_detail', array(
			'categories' => $categories,
			'comment' => $comment,
			'layouts' => $layouts
		));
		?>
	</div>
	<div class="span4"></div>
</div>