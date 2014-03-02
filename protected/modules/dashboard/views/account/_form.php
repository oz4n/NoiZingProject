<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'account-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => true,
        ));


echo $form->textFieldRow($account, 'username');
echo $form->textFieldRow($account, 'password');
echo $form->textFieldRow($account, 'salt');
echo $form->textFieldRow($account, 'email');
echo $form->dropDownListRow($account, 'level', Lookup::items('LevelStatus'));
?>    

<hr/>
<div class="controls" style="margin-top: 20px;">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Save Changes', 'icon' => 'plus', 'htmlOptions' => array('class' => 'btn-green'))); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'ok', 'label' => 'Reset', 'htmlOptions' => array('class' => 'btn-green'))); ?>
</div>

<?php $this->endWidget(); ?>
