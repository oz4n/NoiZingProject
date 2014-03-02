
<?php
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal', 'options' => array('keyboard' => false), 'width' => 8, 'htmlOptions' => array()));
?>

<div class="modal-header">
    <h4>Images</h4>
</div>

<div class="modal-body">
    <div id="mytab">
        <ul id="yw4" class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#upload-image">Upload Image</a></li>
            <li><a data-toggle="tab" href="#all-image">All Image</a></li>
        </ul>
        <div class="tab-content">
            <div id="upload-image" class="tab-pane fade active in" style="height: 320px;">

                <?php
                $this->widget('ext.dropzone.EDropzone', array(
                    'name' => 'file',
//                    'model' => $post,
//                    'onRender' =>false,
//                    'attribute' => 'file',
//                    'url' => $this->createUrl('/dashboard/post/test'),
                    'url' => Yii::app()->createUrl('/dropbox/cache/uploadimage'),
                    'mimeTypes' => array('image/jpeg', 'image/png'),
                    'onSuccess' => 'console.log(file)',
                    'options' => array(
                        'thumbnailWidth' => 100,
                        'thumbnailHeight' => 74
                    ),
                ));
                ?>

            </div>
            <div id="all-image" class="tab-pane fade" style="height: 320px">
                <div class="row-fluid">
                    <div class="span7" style="width: 63%">
                        <div id="img-scroll" style="margin-left: -8.8px;" data-lengt="0">

                        </div>
                    </div>
                    <div class="span3" style="margin-left: 9.2px;">
                        <div id="image-thumb-scroll">
                            <?php // Yii::app()->clientScript->registerScript('id-slimScroll-image-thumb-view', '$("#image-thumb-scroll").slimScroll({ alwaysVisible: false, railVisible: false, size: "5px",width:"380px", height: "310px",borderRadius:"0px", railBorderRadius:"0px", color:"#828282", railColor:"#f8f8f8",railOpacity:"100"});', CClientScript::POS_READY); ?>
                            <div class="media">
                                <a class="pull-left" href="javascript:;" style="padding-right: 5px;">
                                    <img id="image-thumb-view" class="media-object" style="width: 100px;" src="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Media heading</h4>                                  
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Insert',
        'url' => 'javascript:;',
        'htmlOptions' => array('data-dismiss' => 'modal', 'id' => 'img-insert'),
    ));

    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Close',
        'url' => 'javascript:;',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>