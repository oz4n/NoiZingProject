<?php
/* @var $this CategoryController */
/* @var $category Term */
$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Articles' => array('post/index'),        
        'Categories'=>array('index'),               
        'Edit Category'=>array('category/update/id/'.$category->id),               
        ucwords($category->name),               
    )
);
?>
<div id="content">
    <div class="container">
        <div class="row-fluid">
            <div class="span3"></div>
            <div class="span9">
                <?php 
                $category->description = $category->termTaxonomies[0]->description;
                $category->status = $category->termTaxonomies[0]->status;
                $category->parent = $category->termTaxonomies[0]->parent;
                echo $this->renderPartial('_form', array('category' => $category)); 
                ?>
            </div>
        </div>
    </div>
</div>