<?php
/* @var $this TagController */
/* @var $tag Tag */
/* @var $form TbActiveForm */

$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Articles' => array('post/index'),        
        'Tags',               
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
                    'id' => 'tag-form',
                    'action' => Yii::app()->createUrl('/dashboard/tag/create'),
                    'type' => 'vertical',
                    'enableAjaxValidation' => true,
                    'htmlOptions' => array()
                ));

                $this->widget('ext.ajaxform.JAjaxForm', array(
                    'formId' => 'tag-form',
                    'options' => array(
                        'dataType' => 'json',
                        'beforeSubmit' => 'js:function(formData,$form,options) { $("#action-loading").button("loading"); }',
                        'success' => 'js:function(response) { if(response.data == false){ $("#action-loading").button("reset"); $.msgGrowl({ type: response.type, title: response.title, text: response.text }); }else{ $("#action-loading").button("reset"); $.msgGrowl({ type: response.type, title: response.title, text: response.text }); $.fn.yiiGridView.update("tag-grid"); } }',
                    ),
                ));
                ?>
                <div class="control-group">                    
                    <div class="controls">
                        <?php echo $form->textFieldRow($tag, 'name', array('required', 'class' => 'span12')); ?>                        
                        <span class="help-block ">The name is how it appears on your site.</span>
                    </div>
                </div>
               
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->textAreaRow($tag, 'description', array('class' => 'span12', 'rows' => 5)); ?>                     
                        <span class="help-block">The description is not prominent by default; however, some themes may show it.</span>
                    </div>
                </div>
                <hr/>
                <?php
                $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Add New Tag', 'icon' => 'plus', 'htmlOptions' => array('class' => 'btn-primary','id'=>'action-loading','data-loading-text'=>'Loading...')));
                $this->endWidget();
                ?>
            </div> 
            <div class="span8">               
                <?php $this->widget('bootstrap.widgets.TbGridView', $tag->dataStore()); ?>  
                <div class="alert alert-info"><strong>Note:</strong> Deleting a tag does not delete the posts in that tag. Instead, posts that were only assigned to the deleted tag are set to the tag <strong >Uncategorized.</strong>                    </div>
            </div>
        </div>
    </div>
</div>
<?php
//Yii::app()->clientScript->registerScript('das','
//        var c = $("#drop-tag-list").children();        
//        for (var i = 0; i < c.length; i++) {            
//            if(ds[i].value == 0){   
//                $("#drop-tag-list option[value=\'" + c[i].value + "\']").remove();
//            }
//            console.log(ds[i].value)
//        }
//    ', CClientScript::POS_READY); 
?>
<script>
//    $.ajax({url: vurl, data: {"Term[name]": vname, "Term[slug]":vslug}, dataType: "JSON", type: "POST"}).done(function(result) {
//        $.msgGrowl({type: "success", title: "Update Categorie", text: "berhasil" });
//        $.fn.yiiGridView.update("tag-grid");       
//    });
</script>