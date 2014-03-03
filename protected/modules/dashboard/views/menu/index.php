<?php
/* @var $this MenuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'More' => array('/dashboard/more/index'),
        'Appearance' => array('/dashboard/appearance/index'),
        'Menus',
    )
);
?>

<div id="content">
    <div class="container">
        <div class="row-fluid">

            <div class="span4">
                <div class="box" style="padding: 10px">
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'category-form',
                        'action' => Yii::app()->createUrl('/dashboard/category/create'),
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
                            <?php echo $form->textFieldRow($navmenu, 'name', array('required', 'class' => 'span12')); ?>
                            <span class="help-block ">The name is how it appears on your site.</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <?php echo $form->dropDownListRow($navmenu, 'status', Lookup::items("CategoryStatus"), array('class' => 'span6')); ?>
                            <span class="help-block">The "status" is a property that is used to validate the category for publications.</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <?php echo $form->textAreaRow($navmenu, 'description', array('class' => 'span12', 'rows' => 5)); ?>
                            <span class="help-block">The description is not prominent by default; however, some themes may show it.</span>
                        </div>
                    </div>
                    <hr/>
                    <?php
                    $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Add New Menu', 'icon' => 'plus', 'htmlOptions' => array('class' => 'btn-primary', 'id' => 'action-loading', 'data-loading-text' => 'Loading...')));
                    $this->endWidget();
                    ?>
                </div>

            </div>
            <div class="span8">
                <?php $this->widget('bootstrap.widgets.TbGridView', $navmenu->dataMenuStore()); ?>
                <div class="alert alert-info"><strong>Note:</strong> Deleting a category does not delete the posts in
                    that category. Instead, posts that were only assigned to the deleted category are set to the
                    category <strong>Uncategorized.</strong></div>
            </div>
        </div>
    </div>
</div>