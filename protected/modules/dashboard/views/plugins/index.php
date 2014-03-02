<?php
/* @var $this PluginsController */
/* @var $plugin Component */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'More' => array('/dashboard/more/index'),
        'Components' => array('/dashboard/components/index'),
        'All Plugins',
    )
);
?>

<div id="content">
    <div class="container">
        <?php
        $this->widget('bootstrap.widgets.TbListView', array(
            'id' => 'post-list',
            'htmlOptions'=>array('class'=>'row'),
            'dataProvider' => $plugin->search(),
            'ajaxUpdate' => true,
            'itemView' => '_view',
            'template' => "{items}\n<div class='span12'>{pager}</div>",
        ));
        ?>
    </div>
</div>