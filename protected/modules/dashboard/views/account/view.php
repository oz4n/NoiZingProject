

<?php
//Yii::app()->clientScript->registerScript('account-serch-btn-id', "
//            $('.input-append form').keydown(function(event){ if(event.keyCode == 13) { event.preventDefault(); notification(\"Pleas select serch list\",'blue',5000); return false; } });
//            $('.input-append form .btn-serch-data').get(0).setAttribute('type', 'button');   
//            ", CClientScript::POS_END);
?>
<div class="container">
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'data' => $model,
        'attributes' => array(
            'id',
            'username',
            'password',
            'salt',
            'email',
            'level',
        ),
    ));
    ?>
</div>

