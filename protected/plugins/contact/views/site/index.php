<?php
/* @var $contact Contact */

$this->breadcrumbs = array(
    'separator' => '<i class="icon-angle-right"></i>',
    'htmlOptions' => array('class' => 'pull-right'),
    'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
    'links' => array(
        'Kontak kami'
        ));
$this->subPageTitle = 'Kontak kami';
$this->pageTitle = 'Kontak kami';
?>
<div class="row-fluid">    
    <div class="span7">
        <?php $this->renderPartial('_form', array('form_contact' => $form_contact)); ?>
    </div>
    <div class="span5">     
        <?php
        $this->widget('bootstrap.widgets.TbListView', array(
            'id'=>'contact-list-view',
            'dataProvider' => $contact->search(),
            'itemView' => '_view',
            'template' => "{items}\n{pager}",
            'viewData' => array('switch' => true),
        ));
        ?>
    </div>
</div>  