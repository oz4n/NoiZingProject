<?php
/* @var $form_contact ContactForm */
/* @var $form TbActiveForm */
/* @var $this ProntController */
?>
<div class="headline"><h3>Kirim Pesan</h3></div>
<?php if (Yii::app()->user->hasFlash('contact')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>
<?php else: ?>
    <div class="alert alert-info">
        Silahkan pergunakan daftar alamat yang tertera dan form isian dibawah ini untuk memberikan saran dan masukan atau apabila Anda membutuhkan informasi lainnya.
    </div>
<?php endif; ?>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'contact-form', 'type' => 'vertical', 'enableAjaxValidation' => true));

echo $form->textFieldRow($form_contact, 'name', array('prepend' => '<i class="icon-user"></i>', 'class' => 'input-xlarge'));
echo $form->textFieldRow($form_contact, 'email', array('prepend' => '<i class="icon-envelope-alt"></i>', 'class' => 'input-xlarge'));
echo $form->textFieldRow($form_contact, 'web_url', array('prepend' => '<i class=" icon-link"></i>', 'class' => 'input-xlarge'));
echo $form->textFieldRow($form_contact, 'subject', array('prepend' => '<i class="icon-bookmark"></i>', 'class' => 'input-xlarge '));
echo $form->textAreaRow($form_contact, 'content', array('class' => 'span12', 'rows' => 8,));
?>
<?php if (extension_loaded('gd')): ?>   
    <div class="control-group">
        <div class="controls">
            <?php $this->widget('CCaptcha'); ?> 
        </div>
    </div>  
    <?php echo $form->textFieldRow($form_contact, 'verifyCode', array('class' => 'span7', 'prepend' => '<i class="icon-lock"></i>')); ?>  
    <span class="help-block ">Masukkan huruf seperti yang terlihat pada gambar di atas. Huruf tidak Case-Sensitive.</span>
<?php endif; ?>
<p><button type="submit" class="btn-u">Send Message</button></p>
<?php $this->endWidget(); ?>