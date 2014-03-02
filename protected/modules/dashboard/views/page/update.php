<?php
/* @var $this PostController */
/* @var $page Post */
$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Pages' => array('pages/index'),
        'Edit Page'=>array('pages/update/id/'.$page->id),
        ucwords($page->title)
    )
);
?>
<div id="content">
    <div class="container">
        <?php echo $this->renderPartial('_form', array('page' => $page)); ?>
    </div>
</div>