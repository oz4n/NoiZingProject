<?php
/* @var $this FilesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'More' => array('/dashboard/more/index'),
        'Files' => array('/dashboard/files/index'),
        'Image',
    )
);
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/js/plugins/thumbgrid/css/thumbgrid.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/js/plugins/thumbgrid/js/modernizr.custom.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/js/plugins/thumbgrid/js/thumbgrid.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/js/plugins/colorthief/js/colorthief.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/js/plugins/lazyload/js/jquery.lazyload.js?v=1.9.0', CClientScript::POS_END);
Yii::app()->clientScript->registerScript(uniqid(), 'Grid.init();', CClientScript::POS_READY);
Yii::app()->clientScript->registerScript("id-img-lazy", '$("img.lazy").show().lazyload({effect : "fadeIn"});', CClientScript::POS_READY);
Yii::app()->clientScript->registerScript("id-img-delete", '
    $("a.iaction-remove").live("click",function(){
        var imgid = $(this).attr("data-id");
        $("#image" + imgid).fadeOut("slow",function(){
            $(this).remove();
            $.fn.yiiListView.update("images-list");
            Grid.init();
        });       
    });
    ', CClientScript::POS_READY);
?>

<div id="content">
    <div class="container-fluid" id="mydiv">
          <?php
          $dr = new DropboxFiles();
            $this->widget('bootstrap.widgets.TbListView', array(
                'id' => 'images-list',
                'htmlOptions'=>array('class'=>'og-grid'),
                'dataProvider' => $dr->search(),
                'ajaxUpdate' => true,
                'itemView' => 'image/_view',
                'template' => "{items}",
            ));
          ?>       
    </div>
</div>