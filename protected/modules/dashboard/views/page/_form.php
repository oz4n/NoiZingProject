<?php
/* @var $this PostController */
/* @var $page Post */
/* @var $form TbActiveForm */
?>
<div class="row-fluid">

    <div class="span8" >       
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'pages-form',
            'enableAjaxValidation' => true,
        ));
        $this->widget('ext.ajaxform.JAjaxForm', array(
            'formId' => 'pages-form',
            'options' => array(
                'dataType' => 'json',
                'beforeSubmit' =>  'js:function(formData,$form,options) {  $.each($("#tree-pages-id").dynatree("getSelectedNodes"), function() { formData.push({"name":"Page[categories][]","value":this.data.id}); }); $("#action-loading").button("loading"); }',
                'success' => 'js:function(response) { if(response.data == false){ $("#action-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); }else{ $("#action-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); } }',
            ),
        ));

        echo $form->textField($page, 'title', array('size' => 60, 'maxlength' => 128, 'class' => 'span12', 'placeholder' => 'Title...'));
        Yii::import('ext.imperavi-redactor.ImperaviRedactorWidget');
        $this->widget('ImperaviRedactorWidget', array(
            'model' => $page,
            'attribute' => 'content',
             'htmlOptions' => array('style' => 'width:98%', 'rows' => 3,'id'=>'redactor-texarea'),
            'options' => array(
                'convertVideoLinks' => true,
                'convertImageLinks' => true,
                'focus' => true,
                'toolbarFixed' => true,
                'placeholder' => 'Content...',
                'imageUpload' => Yii::app()->createUrl('/dropbox/cache/uploadimage'),
                'imageGetJson' => Yii::app()->createUrl('/dropbox/cache/getimage'),
                'fileUpload' => Yii::app()->createUrl('/dropbox/cache/uploadfile'),
                'linkAnchor' => true,
                'linkEmail' => true, 
            ),
            'plugins' => array(
                'fullscreen' => array(
                    'js' => array('fullscreen.js',),
                ),
                'redmore' => array(
                    'js' => array('redmore.js',),
                ),
            ),
        ));
        ?>
        <hr>
        <?php
        $this->widget('CAutoComplete', array(
            'model' => $page,
            'attribute' => 'tags',
            'width' => '219',
            'resultsClass' => 'dropdown-menu droppy-menu',
            'cssFile' => Yii::app()->baseUrl . '/themes/ac.css',
            'url' => array('suggestTags'),
            'multiple' => true,
            'htmlOptions' => array('placeholder' => 'Tags...', 'class' => 'span12')
        ));
        ?>  
    </div>

    <div class="span4" > 
        <div class="box pages">
            <div class="box-header">
                <span class="title">Pages</span>              
            </div>
            <div id="page-content-scroll" class="box-content" style="padding-left: 5px;">
                <?php
                Yii::app()->clientScript->registerScript('id-slimScroll-pages-content-scroll', '$("#pages-content-scroll").slimScroll({ alwaysVisible: true, railVisible: true, size: "5px", height: "150px",borderRadius:"0px", railBorderRadius:"0px", color:"#828282", railColor:"#f8f8f8",railOpacity:"100"});', CClientScript::POS_READY);
                $pages = new ECategoryComponent($page, 'pages');
                $pages->id = "tree-pages-id";
                $pages->renderTree();
                ?>   
            </div>
            <div class="box-footer" style="padding: 5px;">                
                <a class="pull-right" href="#" style="padding-right: 6px;"><i class="icon-plus"></i>Add Page</a>
            </div>
        </div>
       
       <div class="box pages">
            <div class="box-header">
                <span class="title">Page Options</span>                
            </div>
            <div class="box-content scrollable" style="max-height: 350px; overflow-y: auto; padding: 10px">
                <label>Page Status</label>
                <?php
                echo $form->dropDownList($page, 'status', Lookup::items('PostStatus'), array('class' => 'span12'));
                ?>
            </div>           
        </div> 

        <hr>

        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'icon' => 'file',
            'type' => 'primary',
            'label' => 'Save Changes',
            'loadingText' => 'Loading...',
            'htmlOptions' => array('id'=>'action-loading','class' => 'btn-block btn-big-block btn-large'),
        ));
        ?>
        <?php $this->endWidget(); ?>       
    </div>
</div>
