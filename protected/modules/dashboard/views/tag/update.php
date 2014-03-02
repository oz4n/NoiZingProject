<?php
/* @var $this TagController */
/* @var $tag Tag */

$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Articles' => array('post/index'),        
        'Tags' => array('index'),        
        'Edit Tag' => array('tag/update/id/'.$tag->id), 
        ucwords($tag->name)
    )
);
?>
<div id="content">
    <div class="container">       
        <div class="row-fluid">
            <div class="span3"></div>
            <div class="span9">
                <?php echo $this->renderPartial('_form', array('tag' => $tag)); ?>
            </div>
        </div>
    </div>
</div>