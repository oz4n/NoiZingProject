<?php

return array(
    'login' => 'site/default/login',
    'logout' => 'site/default/logout',
    'home' => 'site/default/index',


	'category/captcha/reload/<refresh:.*?>'=>'site/categories/captcha',
    'category/<category:.*?>/<slug:.*?>/' => 'site/categories/view',
	'categories/<category:.*?>/page/<Post_page:.*?>'=>'site/categories/index/',
    'categories/<category:.*?>/' => 'site/categories/index',


	'tags/<tag:.*?>/page/<Post_page:.*?>'=>'site/tags/index',
	'tag/captcha/reload/<refresh:.*?>'=>'site/tags/captcha',
    'tags/<tag:.*?>/' => 'site/tags/index',
    'tag/<tag:.*?>/<slug:.*?>/' => 'site/tags/view',


	'page/captcha/reload/<refresh:.*?>'=>'site/pages/captcha',
    'page/<menu:.*?>/<slug:.*?>/' => 'site/pages/view',
	'pages/<menu:.*?>/<Post_page:.*?>'=>'site/pages/index',
    'page/<menu:.*?>/' => 'site/pages/index',


    'searches/'=>'site/searches/index',
   
    'link/<link:.*?>/<year:\d+>/<month:\d+>/<slug:.*?>' => 'site/default/viewpermalink',


	'news/captcha/reload/<refresh:.*?>'=>'site/news/captcha',
	'news/page/<Post_page:.*?>'=>'site/news/index',
	'news/'=>'site/news/index',
    'new/<slug:.*?>' => 'site/news/view',
	'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
);