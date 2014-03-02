<?php

return array(
    'modules' => CMap::mergeArray(
            array(
                'dashboard',
                'site',
                'gii' => array(
                    'class' => 'system.gii.GiiModule',
                    'password' => 'admin',
                    'generatorPaths' => array(
                        'bootstrap.gii'
                    ),
                ),
            ),
            require (dirname(__FILE__) . DS . 'plugins.php')
    )
);