<?php
/* @var $this PageController */
/* @var $page Post */
$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Pages' => array('pages/index'),
        'List Pages',               
    )
);
?>
<div id="content">
    <div class="container">
        <div class="row-fluid">
            <div class="span8">
                <?php
                $this->widget('bootstrap.widgets.TbListView', array(    
                    'id'=>'pages-list',
                    'dataProvider' => $page->search(),
                    'ajaxUpdate'=>true,        
                    'itemView' => '_view',
                    'template' => "{items}\n{pager}",
                ));
                ?>
            </div>
            <div class="span4">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Add New Page',
                    'url' => array('page/create'),
                    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'large', // null, 'large', 'small' or 'mini'
                    'htmlOptions' => array('class' => 'btn-block btn-big-block')
                ));
                ?>
            </div>
        </div>

    </div>

</div>
