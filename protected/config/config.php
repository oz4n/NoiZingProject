<?php

$map = CMap::mergeArray(
                CMap::mergeArray(
                        require(dirname(__FILE__) . '/public/params.php'), require(dirname(__FILE__) . '/public/components.php')
                ), CMap::mergeArray(
                        require(dirname(__FILE__) . '/public/modules.php'), require(dirname(__FILE__) . '/public/main.php')
                )
);

return CMap::mergeArray($map, require(dirname(__FILE__) . '/public/controllerMap.php'));

