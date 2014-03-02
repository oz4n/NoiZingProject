<?php
/* @var $this PostController */
/* @var $post Post */
$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Accaounts',                
    )
);
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
                'dataProvider' => $accounts->search(),
                'template' => "{items}",
                'selectableRows' => 2,
                'columns' => array(
                    array(
                        'class' => 'CCheckBoxColumn',
                        'id' => 'id',
                        'value' => '$data->id'
                    ),
                    array('name' => 'username', 'header' => 'Username'),
                    array('name' => 'password', 'header' => 'Password'),
                    array('name' => 'email', 'header' => 'E-mail'),
                    array(
                        'name' => 'level',
                        'header' => 'Level',
                        'value' => 'Lookup::item("LevelStatus",$data->level)',
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
                'htmlOptions' => array()
            ));
            ?>
        </div>
    </div>
</div>




</div>
