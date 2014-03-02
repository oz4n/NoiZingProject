<?php
/* @var $this PostController */
/* @var $post Post */
$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Posts' => array('post/index'),        
        'List Posts',               
    )
);
?>
<div id="content">
    <div class="container">
        <div class="row-fluid">
            <div class="span8">
                <?php
                $this->widget('bootstrap.widgets.TbListView', array(    
                    'id'=>'post-list',
                    'dataProvider' => $post->search(),
                    'ajaxUpdate'=>true,        
                    'itemView' => '_view',
                    'template' => "{items}\n<div class='container'>{pager}</div>",
                ));
                ?>
            </div>
            <div class="span4">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Add New Post',
                    'url' => array('post/create'),
                    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'large', // null, 'large', 'small' or 'mini'
                    'htmlOptions' => array('class' => 'btn-block btn-big-block')
                ));
                ?>

            </div>
        </div>

    </div>

</div>
