<?php
/* @var $this CommentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Comments',                
    )
);
?>
<div class="container">
    <?php
 
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'comment-grid',
        'type' => 'condensed',
        'dataProvider' => $model->search(),
        'template' => "{items}",
        'selectableRows' => 2,
        'columns' => array(
            array(
                'class' => 'CCheckBoxColumn',
                'id' => 'id',
                'value' => '$data->id'
            ),            
//            array(
//                'name' => 'author',
//                'header' => 'Authors',
//                'type' => 'html',
//                'htmlOptions' =>array('style'=>'width:180px;'),
//                'value' => '
//                    "<div class=\"media\">".
//                    "<a class=\"pull-left\" href=\"$data->url\" >".
//                        Yii::app()->gravatar->getGravatar($data->email).
//                    "</a>".
//                    "<div class=\"media-body\">".
//                        CHtml::link("<b>".$data->author."</b>", $data->url).
//                        "<p>".                        
//                        CHtml::link($data->email,"mailto:".$data->email).
//                        "<br>".
//                        CHtml::link($data->url,$data->url).
//                        "</p>". 
//                    "</div>".
//                    "</div>"
//                    '
//            ), 
            array(
                'name' => 'create_time',
                'header' => 'Contents',
                'type' =>'html',  
                'htmlOptions' =>array('class'=>'comments-cart'),
                'value' => '
                    $data->getComents($data->status,$data->id,$data->post_id,$data->create_time,$data->content,$data->url,$data->email,$data->author)
                    ',                
            ),  
            array(
                'name' => 'create_time',
                'header' => 'Response To',
                'type' =>'html',
                'value' =>'$data->getPostNameByid($data->post_id)',
                'htmlOptions' =>array('style'=>'width:220px;'),
            ),
        ),
    ));
    ?>
</div>
