<?php

return array(
    'params' => array(
        'title' => 'Black Holes!',
        'adminEmail' => 'dashboard@aps-lombok.com',
        'postsPerPage' => 4,
        'recentCommentCount' => 10,
        'commentNeedApproval' => true,
        'copyrightInfo' => 'Copyright &copy; 2009 by My Company.',
        'widgets' => array(
            'tag' => array(
                'title' => 'Recent Tags',
                'maxtag' => 20,
            ),
            'comment' => array(
                'title' => 'Recent Comments',
                'maxcomment' => 5
            ),
        ),
        'home' => array(
            'status' => 1,
            'layouts' => array(
                'one' => 1,
                'two' => 2,
                'tree' => 3,
            )
        ),
        'data' => array(
            'articel' => array(
                'icons' => dirname(__FILE__) . DS . '../../../data/icons/',
                'thumbnails' => dirname(__FILE__) . DS . '../../../data/icons/thumbnails/',
            ),
            'media' => array(
                'documents' => '/data/medias/documents/',
                'images' => '/data/medias/images/',
                'thumbnails' => '/data/medias/thumbnails/',
                'videos' => '/data/medias/videos/',
            ),
        ),
        'dropbox_cache' => array(
            'documents' => dirname(__FILE__) . DS . '../../../cache/documents/',
            'images' => dirname(__FILE__) . DS . '../../../cache/images/orginal/',
            'thumbnails' => dirname(__FILE__) . DS . '../../../cache/images/thumbnails/',
            'videos' => dirname(__FILE__) . DS . '../../../cache/images/',
        ),
        'plugins' => array(
            'path' => dirname(__FILE__) . DS . '../../../protected/components/',
            'cache_config_path' => dirname(__FILE__) . DS . '../../../protected/runtime/',
            'file_config' => dirname(__FILE__) . DS . '../../../protected/config/public/modules.php',
            'url_rules_config_file' => dirname(__FILE__) . DS . '../../../protected/config/public/urlRules.php',
        ),
        'img' => array(
            'default_img' => 'themes/site/unify/img/carousel/6.jpg',
            'array_default_img' => array(
                'themes/site/unify/img/carousel/4.jpg',
                'themes/site/unify/img/carousel/5.jpg',
                'themes/site/unify/img/carousel/6.jpg',
            )
        )
    )
);
