<?php

return CMap::mergeArray(
            CMap::mergeArray(require __DIR__. DS . 'prontPluginsUrlRules.php',require __DIR__. DS . 'prontUrlRules.php'),
            CMap::mergeArray(require __DIR__. DS . 'adminUrlRules.php',require __DIR__. DS . 'adminPluginsUrlRules.php')
        );