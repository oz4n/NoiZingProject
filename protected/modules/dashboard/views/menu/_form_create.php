<?php
/* @var $this NavMenuController */
/* @var $model NavMenu */
/* @var $form CActiveForm */
?>

<div id="content">
    <div class="container">
        <div class="row-fluid">
            <div class="span3"></div>
            <div class="span9">
                <?php
                /* @var $this CategoryController */
                /* @var $menu Term */
                /* @var $form TbActiveForm */
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'menu-form', 'type' => 'vertical', 'enableAjaxValidation' => true));
                $this->widget('ext.ajaxform.JAjaxForm', array(
                    'formId' => 'menu-form',
                    'options' => array(
                        'dataType' => 'json',
                        'beforeSubmit' => 'js:function(formData,$form,options) { $("#action-loading").button("loading");  }',
                        'success' => 'js:function(response) { if(response.data == false){ $("#action-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); }else{ $("#action-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); } }',
                    ),
                ));
                ?>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->textFieldRow($menu, 'name', array('required', 'class' => 'span12')); ?>       
                        <span class="help-block ">The name is how it appears on your site.</span>
                    </div>
                </div>                          
                <div class="control-group">                    
                    <div class="controls">
                        <?php echo $form->dropDownListRow($menu, 'parent', NavMenu::loadMenus(), array('encode' => false, 'class' => 'span6')); ?>        
                        <span class="help-block">Menus, unlike tags, can have a hierarchy. You might have a Jazz menu, and under that have children menufor Bebop and Big Band. Totally optional.</span>
                    </div>
                </div>
                 <div class="control-group">                    
                    <div class="controls">
                        <?php // echo $form->textFieldRow($menu, 'position', array('required', 'class' => 'span12')); ?>        
                        <?php echo $form->dropDownListRow($menu, 'position', NavMenu::loadCreatePositions($menu->parent), array('encode' => false, 'class' => 'span6')); ?>        
                        <span class="help-block">Menus, unlike tags, can have a hierarchy. You might have a Jazz menu, and under that have children menufor Bebop and Big Band. Totally optional.</span>
                    </div>
                </div>
                <hr/>
                <?php
                $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Update Changes', 'icon' => 'ok', 'htmlOptions' => array('class' => 'btn-primary', 'id' => 'action-loading', 'data-loading-text' => 'Loading...')));
                $this->endWidget();
                ?>


            </div>
        </div>
    </div>
</div>