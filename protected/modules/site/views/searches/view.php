<?php
/* @var $this TagsController*/
/* @var $tags Page*/
$this->subPageTitle = ucwords($_GET['tag']);
$this->meta_keywords = $tags->tags;
$this->meta_description = $tags->title;
$this->meta_author = $tags->account->username;
$this->pageTitle = $tags->title;
$this->breadcrumbs = array(
	'separator' => '<i class="icon-angle-right"></i>',
	'htmlOptions' => array('class' => 'pull-right'),
	'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
	'links' => array(ucwords($_GET['tag']) => Yii::app()->createUrl('/site/tags/index', array('tag' => $_GET['tag'])), ucwords($tags->title))
);
?>
<div class="row-fluid">
	<div class="span8">
		<?php
		$this->renderPartial('_view_detail', array(
			'tags' => $tags,
			'layouts' => $layouts
		));
		?>
	</div>
	<div class="span4"></div>
</div>