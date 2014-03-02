<?php
/* @var $this PostController */
/* @var $post Post */
$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Posts' => array('post/index'),
        'Add New Post',
    )
);
?>
<div id="content">
    <div class="container">
        <?php echo $this->renderPartial('_form', array('post' => $post)); ?>
    </div>
</div>




