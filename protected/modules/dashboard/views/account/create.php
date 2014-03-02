<?php
/* @var $this AccountController */
/* @var $post Post */
$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'Accaounts'=>array('/dashboard/account/index'),
        'Add Account'
    )
);
?>         
<?php
//Yii::app()->clientScript->registerScript('account-serch-btn-id', "
//$('.input-append form').keydown(function(event){ if(event.keyCode == 13) { event.preventDefault(); notification(\"Pleas select serch list\",'blue',5000); return false; } });
//$('.input-append form .btn-serch-data').get(0).setAttribute('type', 'button');   
//", CClientScript::POS_END);
?>
<div id="content">
<div class="container">
    <div class="row-fluid">
        <div class="span3"></div>
        <div class="span9">
            <?php echo $this->renderPartial('_form', array('account' => $account)); ?>
        </div>
    </div>    
</div>
</div>