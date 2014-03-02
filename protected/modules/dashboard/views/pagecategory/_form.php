<?php
/* @var $this CategoryController */
/* @var $pagecategory Term */
/* @var $form TbActiveForm */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'pagecategory-form', 'type' => 'vertical', 'enableAjaxValidation' => true));
$this->widget('ext.ajaxform.JAjaxForm', array(
    'formId' => 'pagecategory-form',
    'options' => array(
        'dataType' => 'json',
        'beforeSubmit' => 'js:function(formData,$form,options) { $("#action-loading").button("loading");  }',
        'success' => 'js:function(response) { if(response.data == false){ $("#action-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); }else{ $("#action-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); } }',
    ),
));
?>
<div class="control-group">
    <div class="controls">
        <?php echo $form->textFieldRow($pagecategory, 'name', array('required', 'class' => 'span12')); ?>       
        <span class="help-block ">The name is how it appears on your site.</span>
    </div>
</div>    
<div class="control-group">
    <div class="controls">
        <?php echo $form->textFieldRow($pagecategory, 'slug', array('required', 'class' => 'span12')); ?>      
        <span class="help-block">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</span>
    </div>
</div>           
<div class="control-group">                    
    <div class="controls">
        <?php echo $form->dropDownListRow($pagecategory, 'parent', TermTaxonomy::loadCategorys(), array('encode' => false, 'class' => 'span6')); ?>        
        <span class="help-block">Categories, unlike tags, can have a hierarchy. You might have a Jazz pagecategory, and under that have children termTaxonomies for Bebop and Big Band. Totally optional.</span>
    </div>
</div>
<div class="control-group">    
    <div class="controls">
        <?php echo $form->dropDownListRow($pagecategory, 'status', Lookup::items("CategoryStatus"), array('class' => 'span6')); ?>       
        <span class="help-block">The "status" is a property that is used to validate the pagecategory for publications.</span>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <?php echo $form->textAreaRow($pagecategory, 'description', array('class' => 'span12', 'rows' => 5)); ?>        
        <span class="help-block">The description is not prominent by default; however, some themes may show it.</span>
    </div>
</div>
<hr/>
<?php
$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Update Changes', 'icon' => 'ok', 'htmlOptions' => array('class' => 'btn-primary','id'=>'action-loading','data-loading-text'=>'Loading...')));
$this->endWidget();
?>

