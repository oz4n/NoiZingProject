<?php
//Yii::app()->clientScript->registerScript('account-serch-btn-id', "           
//            $('.menuManage > ul >li > a.add-data').get(0).setAttribute('href', '" . Yii::app()->baseUrl . "/index.php/dashboard/post/create');
//            ", CClientScript::POS_END);
?>

<div id="content">
    <div class="container">

        <div class="row-fluid">
            <div class="span3"></div>
            <div class="span9">
                <?php
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'account-grid',
                    'type' => 'bordered',
                    'dataProvider' => $post->search(),
                    'template' => "{items}{pager}",
                    'selectableRows' => 2,
                    'columns' => array(
                        array(
                            'class' => 'CCheckBoxColumn',
                            'id' => 'id',
                            'value' => '$data->id'
                        ),
                        array('name' => 'title', 'header' => 'Title'),
                        array('name' => 'tags', 'header' => 'Tags'),
                        array(
                            'name' => 'status',
                            'header' => 'Status',
                            'value' => 'Lookup::item("PostStatus",$data->status)',
                            'filter' => Lookup::items('PostStatus'),
                        ),
                        array(
                            'name' => 'create_time',
                            'header' => 'Create Time',
                            'filter' => false,
                            'value' => 'date("F j, Y",$data->create_time);'
                        ),
                        array(
                            'name' => 'update_time',
                            'header' => 'Update Time',
                            'filter' => false,
                            'value' => 'date("F j, Y",$data->update_time);'
                        ),
                        array(
                            'header' => 'Action',
                            'class' => 'bootstrap.widgets.TbButtonColumn',
                            'buttons' => array(
                                'view' => array(
                                    'label' => 'view',
                                ),
                                'update' => array(
                                    'label' => 'edit',
                                ),
                                'delete' => array(
                                    'label' => 'delete',
                                ),
                            ),
                        ),
                    ),
                    'htmlOptions' => array('style' => 'padding-top:10px;')
                ));
                ?>
            </div>
        </div>
    </div>
</div>


