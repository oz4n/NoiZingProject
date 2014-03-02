<?php
/* @var $this CategoryController */
/* @var $pagecategory Term */
$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Pages' => array('post/index'),        
        'Pages Categories'=>array('index'),               
        'Edit Pages Category'=>array('pagecategory/update/id/'.$pagecategory->id),               
        ucwords($pagecategory->name),               
    )
);
?>
<div id="content">
    <div class="container">
        <div class="row-fluid">
            <div class="span3"></div>
            <div class="span9">
                <?php 
                $pagecategory->description = $pagecategory->termTaxonomies[0]->description;
                $pagecategory->status = $pagecategory->termTaxonomies[0]->status;
                $pagecategory->parent = $pagecategory->termTaxonomies[0]->parent;
                echo $this->renderPartial('_form', array('pagecategory' => $pagecategory)); 
                ?>
            </div>
        </div>
    </div>
</div>