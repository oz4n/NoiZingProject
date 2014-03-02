<?php
/* @var $this PostController */
/* @var $post Post */
$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Posts' => array('post/index'),        
        'Edit post'=>array('post/update/id/'.$post->id),  
        ucwords($post->title)
    )
);
?>
<div id="content">
    <div class="container">
        <?php echo $this->renderPartial('_form', array('post' => $post)); ?>
    </div>
</div>