<?php
/* @var $this PluginsController */
/* @var $plugin Component */
/* @var $form TbActiveForm */

$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'More' => array('/dashboard/more/index'),
        'Components' => array('/dashboard/components/index'),
        'All Plugins'=> array('/dashboard/plugins/index'),
        'Install Plugins',
    )
);
?>
<div id="content">
    <div class="container">
        <div class="row-fluid">
            <div class="span3">Span3</div>
            <div class="span9">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'plugin-form',
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    'enableAjaxValidation' => true,
                ));

                echo $form->textFieldRow($plugin, 'name',array('class'=>'span6'));
                echo $form->FileFieldRow($plugin, 'file_name',array('class'=>'span6'));
                echo $form->textAreaRow($plugin, 'description',array('class'=>'span12','rows'=>8));
                ?>
                <hr>
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'icon' => 'file',
                    'type' => 'primary',
                    'label' => 'Install Plugin',
                    'loadingText' => 'Loading...',
                    'htmlOptions' => array('id' => 'action-loading', ),
                ));
                ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>