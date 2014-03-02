<?php
/* @var $this PostController */
/* @var $post Post */
/* @var $form TbActiveForm */
?>

<div class="row-fluid">
    <div class="span8">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'post-form',
            'enableAjaxValidation' => true,
        ));
        echo $form->textField($post, 'title', array('size' => 60, 'maxlength' => 128, 'class' => 'span12', 'placeholder' => 'Title...'));
        Yii::import('ext.imperavi-redactor.ImperaviRedactorWidget');

        $this->widget('ImperaviRedactorWidget', array(
            'model' => $post,
            'attribute' => 'content',
            'htmlOptions' => array('style' => 'width:98%', 'rows' => 3, 'id' => 'redactor-texarea'),
            'options' => array(
                'convertVideoLinks' => true,
                'convertImageLinks' => true,
                'focus' => true,
                'toolbarFixed' => true,
                'placeholder' => 'Content...',
                'imageUpload' => Yii::app()->createUrl('/dropbox/cache/uploadimage'),
                'imageGetJson' => Yii::app()->createUrl('/dropbox/cache/getredactorimages'),
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
            'model' => $post,
            'attribute' => 'tags',
            'width' => '219',
            'resultsClass' => 'dropdown-menu droppy-menu',
            'cssFile' => Yii::app()->baseUrl . '/themes/ac.css',
            'url' => array('suggestTags'),
            'multiple' => true,
            'htmlOptions' => array('placeholder' => 'Tags...', 'class' => 'span12')
        ));
        ?>
        <div>
            Choose from the most used tags
        </div>
    </div>

    <div class="span4">
        <div class="box categories">
            <div class="box-header">
                <span class="title">Categories </span>
            </div>
            <div id="cat-content-scroll" class="box-content scrollable" style="padding-left: 5px;">
                <?php
                Yii::app()->clientScript->registerScript('id-slimScroll-cat-content-scroll', '$("#cat-content-scroll").slimScroll({ alwaysVisible: true, railVisible: true, size: "5px", height: "150px",borderRadius:"0px", railBorderRadius:"0px", color:"#828282", railColor:"#f8f8f8",railOpacity:"100"});', CClientScript::POS_READY);
                $cat = new ECategoryComponent($post, 'category');
                $cat->id = "tree-category-id";
                $cat->renderTree();
                ?>
            </div>
            <div class="box-footer" style="padding: 5px;">
                <a class="pull-right" href="#" style="padding-right: 6px;"><i class="icon-plus"></i>Add Category</a>
            </div>
        </div>


        <div class="box pages">
            <div class="box-header">
                <span class="title">Post Options</span>
            </div>
            <div class="box-content scrollable" style="padding: 10px">
                <label>Post Status</label>
                <?php
                echo $form->dropDownList($post, 'status', Lookup::items('PostStatus'), array('class' => 'span12'));
                ?>
                <label>Comment Status</label>
                <?php
                echo $form->dropDownList($post, 'comment_status', Lookup::items('PostCommentStatus'), array('class' => 'span12'));
                ?>
            </div>
        </div>

        <div class="box pages">
            <div class="box-header">
                <span class="title">Featured Image</span>
            </div>
            <div class="box-content scrollable" style="padding: 10px">
                <?php
                echo $form->hiddenField($post, "icon");
                echo CHtml::image($post->icon, "", array("style" => "width:350px;", "id" => "featured-img-id"));
                ?>
            </div>
            <div class="box-footer" style="padding: 5px;">
                <a class="pull-right" href="javascript:;" data-target="#myModal" id="modal-toggle"
                   data-toggle="modal" style="padding-right: 6px;"><i class="icon-plus"></i>Add Featured Imagee</a>
            </div>
        </div>

        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'icon' => 'file',
            'type' => 'primary',
            'label' => 'Save Change',
            'loadingText' => 'Loading...',
            'htmlOptions' => array('id' => 'action-loading', 'class' => 'btn-block btn-big-block btn-large'),
        ));
        ?>
        <?php $this->endWidget(); ?>
    </div>
</div>

<?php $this->renderPartial('/post/image_modal'); ?>

