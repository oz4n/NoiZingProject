<!DOCTYPE html>
<!--[if IE 7]> <html lang="en" class="ie7"> <![endif]-->  
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
    <head>  
        <?php $this->renderPartial('/layouts/assets/head/meta'); ?> 
        <?php $this->renderPartial('/layouts/assets/head/css'); ?>      
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <?php $this->renderPartial('/layouts/assets/header'); ?>  
        <?php $this->renderPartial('/layouts/assets/breadcrumbs'); ?>  
        <div class="container"  style="padding: 10px;">
            <div id="google-map" class="map margin-bottom-40"></div>
        </div>
        <div class="container">
            <?php
            echo $content;
            ?> 
        </div>
        <?php $this->renderPartial('/layouts/assets/footer'); ?> 
        <?php $this->renderPartial('/layouts/assets/copyright'); ?> 
        <?php $this->renderPartial('/layouts/assets/head/js'); ?> 
    </body>
</html>

