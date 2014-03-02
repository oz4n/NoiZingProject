<?php

Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . DS . '..' . DS . '..' . DS . 'extensions' . DS . 'bootstrap');
return array(
    'basePath' => dirname(__FILE__) . DS . '..' . DS . '..',
    'name' => "Black Holes!",
    'preload' => array('log', 'bootstrap'),
    'import' => CMap::mergeArray(require (dirname(__FILE__) . DS . 'widgets.php'), require (dirname(__FILE__) . DS . 'app.php')),
    'defaultController' => 'site',
);