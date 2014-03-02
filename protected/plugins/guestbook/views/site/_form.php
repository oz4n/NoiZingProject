<?php
/* @var $form TbActiveForm*/
/* @var $this ProntController*/
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'contact-form', 'type' => 'vertical', 'enableAjaxValidation' => true));
echo $form->textFieldRow($guestbook, 'name', array('prepend' => '<i class="icon-user"></i>', 'class' => 'input-xlarge'));
echo $form->textFieldRow($guestbook, 'email', array('prepend' => '<i class="icon-envelope-alt"></i>', 'class' => 'input-xlarge'));
echo $form->textFieldRow($guestbook, 'web_url', array('prepend' => '<i class=" icon-link"></i>', 'class' => 'input-xlarge'));
echo $form->textFieldRow($guestbook, 'subject', array('prepend' => '<i class="icon-bookmark"></i>', 'class' => 'input-xlarge'));
echo $form->textAreaRow($guestbook, 'content', array('class' => 'span12', 'rows' => 8,));
?>
<?php if (extension_loaded('gd')): ?>   
    <div class="control-group">
        <div class="controls">
            <?php $this->widget('CCaptcha'); ?> 
        </div>
    </div>  
    <?php echo $form->textFieldRow($guestbook, 'verifyCode', array('class' => 'span7', 'prepend' => '<i class="icon-lock"></i>')); ?>  
    <div class="control-group">
        <div class="controls">
            <span class="help-block ">Masukkan huruf seperti yang terlihat pada gambar di atas. Huruf tidak Case-Sensitive.</span>
        </div>
    </div>  
<?php endif; ?>
<div class="control-group">
    <div class="controls">
        <button type="submit" class="btn-u">Send Message</button>
    </div>
</div>  
<?php $this->endWidget(); ?>