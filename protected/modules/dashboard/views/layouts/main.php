<!doctype html>
<!--[if lt IE 7]> 
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> 
<![endif]-->
<!--[if IE 7]>    
<html class="no-js lt-ie9 lt-ie8" lang="en"> 
<![endif]-->
<!--[if IE 8]>    
<html class="no-js lt-ie9" lang="en"> 
<![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang="en"> 
    <!--<![endif]-->
    <head>        
        <?php 
        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/css/font-awesome.css');
        
        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/css/bootstrap.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/css/bootstrap-responsive.css');
        
        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/css/application.css');
        
        $cs = Yii::app()->clientScript;
        $cs->scriptMap=array(
            'jquery.js'=>Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/libs/jquery.js',
        );
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/js/plugins/nicescroll/jquery.nicescroll.min.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/js/plugins/slimscroll/jquery.slimscroll.min.js', CClientScript::POS_END);
        
//        Yii::app()->clientScript->registerScript('id-niceScroll-body', ' $("body").niceScroll({enablekeyboard:false,zindex:102, cursorcolor:"#000000", cursoropacitymax:0.6,cursorwidth:5});', CClientScript::POS_READY);
//        Yii::app()->clientScript->registerScript('id-niceScroll-body', ' $("html").niceScroll({enablekeyboard:false,zindex:102,styler:"fb"});', CClientScript::POS_READY);
//        Yii::app()->clientScript->registerScript('id-niceScroll-body-textarea', ' $("#redactor-texarea").niceScroll({enablekeyboard:false,cursorcolor:"#000", cursorwidth:5});', CClientScript::POS_READY);
//        Yii::app()->clientScript->registerScript('id-niceScroll-body-textarea', ' $("#redactor-texarea").slimScroll({height: "807px",alwaysVisible: true});', CClientScript::POS_READY);
        Yii::app()->clientScript->registerScript('loadUrl-id', 'function loadUrl(location){this.document.location.href = location;}', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/themes/dashboard/dark/js/libs/bootstrap/bootstrap.min.js', CClientScript::POS_END);
        ?>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body class="scrollable">
        <div id="wrapper">
            <?php
            $this->renderPartial("/layouts/topbar");
            $this->renderPartial("/layouts/header");
            $this->renderPartial("/layouts/masthead");
            echo $content;
            ?>
        </div>
        <?php // $this->renderPartial("/layouts/footer"); ?>        
    </body>
</html>
