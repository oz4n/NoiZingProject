<?php
/* @var $this DefaultController */
/* @var $form  TbActiveForm */
$this->subPageTitle = 'Login';
$this->breadcrumbs = array('separator' => '<i class="icon-angle-right"></i>', 'htmlOptions' => array('class' => 'pull-right'), 'homeLink' => CHtml::link('Home', array('/site/default/index')), 'links' => array('login'));
?>
<div class="row-fluid" style="padding-top: 10px;">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('htmlOptions' => array('class' => 'log-page'))); ?>
    <h3>Login to your account</h3>
    <div class="input-prepend">
        <span class="add-on"><i class="icon-user"></i></span>
        <?php echo $form->textField($model, 'username', array('class' => 'input-xlarge', 'placeholder' => 'Username')); ?>
    </div>
    <div class="input-prepend">
        <span class="add-on"><i class="icon-lock"></i></span>
        <?php echo $form->passwordField($model, 'password', array('class' => 'input-xlarge', 'placeholder' => 'Password')); ?>
    </div>
    <div class="controls  form-inline">
        <label class="checkbox">
            <input type="checkbox" /> Stay Signed in
        </label>
        <?php $this->widget('bootstrap.widgets.TbButton', array('type' => 'success', 'buttonType' => 'submit', 'label' => 'Login', 'icon' => 'ok-sign white', 'htmlOptions' => array('class' => 'btn-u pull-right'))); ?>
        <hr />
        <h4>Forget your Password ?</h4>
        <p><?php echo $form->error($model, 'password', array('style' => 'color:#ff0000;')); ?>no worries, <a class="color-green" href="#">click here</a> to reset your password.</p>
    </div>
    <?php $this->endWidget(); ?>
</div>