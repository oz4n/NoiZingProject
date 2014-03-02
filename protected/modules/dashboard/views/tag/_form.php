<?php
/* @var $this TagController 
 * @var $tag Tag
 * @var $form TbActiveForm
 */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'tag-form', 'type' => 'vertical', 'enableAjaxValidation' => true));
$this->widget('ext.ajaxform.JAjaxForm', array(
    'formId' => 'tag-form',
    'options' => array(
        'dataType' => 'json',
        'beforeSubmit' => 'js:function(formData,$form,options) { $("#action-loading").button("loading");  }',
        'success' => 'js:function(response) { if(response.data == false){ $("#action-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); }else{ $("#action-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); } }',
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
$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Update Changes', 'icon' => 'ok', 'htmlOptions' => array('class' => 'btn-primary','id'=>'action-loading','data-loading-text'=>'Loading...')));
$this->endWidget();
?>

