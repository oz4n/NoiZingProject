<?php
/* @var $this CategoryController */
/* @var $category Term */
/* @var $form TbActiveForm */
$this->breadcrumbs = array(
   'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Post' => array('post/index'),
        'Page Categories',
    )
);

?>
<!--
<div class="container">
    <h2> <i class="icon-book" style="margin-top: 8px; padding-right: 10px;"></i>Categories</h2>
</div>-->
<div id="content">
    <div class="container">
        <div class="row-fluid"> 
            <div class="span4">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'category-form',
                    'action' => Yii::app()->createUrl('/dashboard/postcategory/create'),
                    'type' => 'vertical',
                    'enableAjaxValidation' => true,
                    'htmlOptions' => array()
                ));

                $this->widget('ext.ajaxform.JAjaxForm', array(
                    'formId' => 'category-form',
                    'options' => array(
                        'dataType' => 'json',
                        'beforeSubmit' => 'js:function(formData,$form,options) { $("#action-loading").button("loading"); }',
                        'success' => 'js:function(response) {if(response.data == false){ $("#action-loading").button("reset"); $.msgGrowl({ type: response.type, title: response.title, text: response.text }); }else{ $("#action-loading").button("reset"); $.msgGrowl({ type: response.type, title: response.title, text: response.text }); $.fn.yiiGridView.update("category-grid"); $("#drop-category-list").append("<option value=" + response.id + ">" + response.name + "</option>"); } }',
                    ),
                ));
                ?>
                <div class="control-group">                    
                    <div class="controls">
                        <?php echo $form->textFieldRow($category, 'name', array('required', 'class' => 'span12')); ?>                        
                        <span class="help-block ">The name is how it appears on your site.</span>
                    </div>
                </div>
                <div class="control-group">                  
                    <div class="controls">     
                        <?php echo $form->textFieldRow($category, 'slug', array('required', 'class' => 'span12')); ?>                                               
                        <span class="help-block">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</span>
                    </div>
                </div>           
                <div class="control-group">                                   
                    <div class="controls">
                        <?php echo $form->dropDownListRow($category, 'parent', TermTaxonomy::loadCategorys("page_category"), array('encode' => false, 'class' => 'span6', 'id' => 'drop-category-list')); ?>
                        <span class="help-block">Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children termTaxonomies for Bebop and Big Band. Totally optional.</span>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->dropDownListRow($category, 'status', Lookup::items("CategoryStatus"), array('class' => 'span6')); ?>                     
                        <span class="help-block">The "status" is a property that is used to validate the category for publications.</span>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->textAreaRow($category, 'description', array('class' => 'span12', 'rows' => 5)); ?>                     
                        <span class="help-block">The description is not prominent by default; however, some themes may show it.</span>
                    </div>
                </div>
                <hr/>
                <?php
                $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Add New Category', 'icon' => 'plus', 'htmlOptions' => array('class' => 'btn-primary', 'id' => 'action-loading', 'data-loading-text' => 'Loading...')));
                $this->endWidget();
                ?>
            </div> 
            <div class="span8">               
                <?php $this->widget('bootstrap.widgets.TbGridView', $category->dataPostCategoryStore()); ?>
                <div class="alert alert-info"><strong>Note:</strong> Deleting a category does not delete the posts in that category. Instead, posts that were only assigned to the deleted category are set to the category <strong >Uncategorized.</strong>                    </div>
            </div>
        </div>
    </div>
</div>
<?php
//Yii::app()->clientScript->registerScript('das','
//        var c = $("#drop-category-list").children();        
//        for (var i = 0; i < c.length; i++) {            
//            if(ds[i].value == 0){   
//                $("#drop-category-list option[value=\'" + c[i].value + "\']").remove();
//            }
//            console.log(ds[i].value)
//        }
//    ', CClientScript::POS_READY); 
?>
<script>
//    $.ajax({url: vurl, data: {"Term[name]": vname, "Term[slug]":vslug}, dataType: "JSON", type: "POST"}).done(function(result) {
//        $.msgGrowl({type: "success", title: "Update Categorie", text: "berhasil" });
//        $.fn.yiiGridView.update("category-grid");       
//    });

    jQuery(function($) {
//        $('#btn-save-cat').click(function() {
//            var btn = $(this);
//            btn.button('loading');
//            setTimeout(function() {
//               $("#action-loading").button('reset');
//            }, 3000);
//        });
    });
</script>