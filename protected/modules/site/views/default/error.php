<?php
/* @var $this DefaultController */
/* @var $form  TbActiveForm */
$this->subPageTitle = 'Page Not Founded';
$this->breadcrumbs = array('separator' => '<i class="icon-angle-right"></i>', 'htmlOptions' => array('class' => 'pull-right'), 'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')), 'links' => array($code));
?>
<div class="row-fluid page-404">
    <p><i><?php echo $code; ?></i> <span>The Page cannot be found</span></p>
</div>