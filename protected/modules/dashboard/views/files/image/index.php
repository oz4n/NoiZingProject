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
//        $("#image" +imgid+ " > a").css({"display":"none"});
//        $("#image" +imgid+ " > div.icon-action").css({"display":"none"});
//        $(".og-expander").css({"display":"inlain"});
        $("#image" + imgid).fadeOut("slow",function(){
            $(this).remove();
            $.ajax({  
                    url: "' . Yii::app()->createUrl('/dropbox/cache/deleteimage') . '",  
                    dataType: "json",
                    type:"POST",  
                    data: {id:imgid}, 
                    success: function(html){  
                        console.log(html);
                    }  
            });
        });       
    });
    ', CClientScript::POS_READY);
?>

<div id="content">
    <div class="container-fluid" id="mydiv">
        
        <div id="og-grid" class="og-grid" style="padding-right:13px;">
            <?php
            $criteria = new CDbCriteria;
            $criteria->order = 'id DESC';
            $criteria->condition = 'type="img"';
            $file = DropboxFiles::model()->findAll($criteria);
            foreach ($file as $v):
                $img = json_decode($v->url_thumbnail_share);
                ?>
               <div class="og-child" id="image<?php echo $v->id; ?>" >
                    <a href="javascript:;" data-largesrc="<?php echo $img->torginal->imgurl; ?>" data-title="IF I control Your Life" data-description="Swiss chard pumpkin bunya nuts maize plantain aubergine napa cabbage soko coriander sweet pepper water spinach winter purslane shallot tigernut lentil beetroot.">
                        <img class="lazy" width="181" src="<?php  echo Yii::app()->baseUrl . "/themes/js/plugins/lazyload/img/loading.gif" ?>" data-original="<?php echo $img->T232X155->imgurl; ?>" alt="<?php echo $v->files_uid; ?>" />
                      
                    </a>
                    <div class="icon-action" style="position: absolute;">
                        <div class="iaction">
                            <a href="javascript:;" class="iaction-remove" data-id="<?php echo $v->id; ?>" ><i class="i-remove icon-remove" ></i></a>
                            <a href="javascript:;" class="iaction-edit" ><i class="i-edit icon-edit" ></i></a>
                            <a href="javascript:;" class="iaction-ok" ><i class="i-ok icon-ok" ></i></a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>