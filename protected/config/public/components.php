<?php

return array(
    'components' => array(      
        'user' => array(
            'class' => 'application.components.EWebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('/login')
        ),

        'Encrypter' => array(
            'class' => 'ext.encrypt.Encrypter',
            'key' => 'melengoinemolid'
        ),
        'CMobile' => array(
            'class' => 'ext.mobile.CMobileDetect',
        ),
        'CInfo' => array(
            'class' => 'ext.info.CInfo',
        ),
        'CUrl' => array(
            'class' => 'ext.CUrl',
//            'config' => array(
//                'uri_protocol'=>'AUTO',
//                'permitted_uri_chars'=>'a-z 0-9~%.:_\-',
//                'enable_query_strings' => false,
//                'url_suffix' => '',
//                'uri_protocol' =>'AUTO',
//                )
        ),
//        'cache' => array(
//            'class' => 'system.caching.CMemCache',
//            'servers' => array(
//                array('host' => 'server1', 'port' => 11211, 'weight' => 60),
//                array('host' => 'server2', 'port' => 11211, 'weight' => 40),
//            ),
//        ),
        'phpThumb' => array(
            'class' => 'ext.EPhpThumb.EPhpThumb',
            'options' => array()
        ),
        'EFind' => array(
            'class' => 'ext.ftp.EFind'
        ),
        'XFTP' => array(
            'class' => 'ext.ftp.XFTP'
        ),
        'IDropboxClient' => array(
            'class' => 'ext.idropbox.IDropboxClient',   
            'access_token' => 'FobuXak3rXoAAAAAAAAAAbimyjf7JiZKzIPfnl5XBAxT2jnHGEJEajzu8fwf8xTb'
        ),
        'gravatar' => array(
            'class' => 'ext.gravatar.Gravatar',
            'properti' => array(
                'size' => 30,
                'rating' => null,
                'border' => null,
                'gdefault' => null
            ),
        ),
        'twitter' => array(
            'class' => 'ext.twitteroauth.ItwiterOAouth',
            'consumer_key' => 'Ue0CvVsItwUuSabpX6g7lw',
            'consumer_secret' => 'nDBhxIvWbbmZF0Q7QvmhFS5SGFNeISdQUvkdLJsqE',
            'access_token' => '190856664-SwfL89r1s3Z2hgjOrLEFOij0HiHxsoKk9cvK264w',
            'access_token_secret' => 'tgxYugrwcOlRIbZexlIrZWTwjqBBQsmdiLGsIzJuXCw',
        ),
//        'facebook' => array(
//            'class' => 'application.extensions.yii-facebook-opengraph.SFacebook',
//            'appId' => '154374271049',
//            'secret' => 'da788d917dc46d6ee754bb9c2cf601b9',
//            'fileUpload' => false, // needed to support API POST requests which send files
//            'trustForwarded' => false, // trust HTTP_X_FORWARDED_* headers ?
//            'locale' => 'en_US', // override locale setting (defaults to en_US)
//            'jsSdk' => true, // don't include JS SDK
//            'async' => true, // load JS SDK asynchronously
//            'jsCallback' => false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
//            'status' => true, // JS SDK - check login status
//            'cookie' => true, // JS SDK - enable cookies to allow the server to access the session
//            'oauth' => true, // JS SDK - enable OAuth 2.0
//            'xfbml' => true, // JS SDK - parse XFBML / html5 Social Plugins
//            'frictionlessRequests' => true, // JS SDK - enable frictionless requests for request dialogs
//            'html5' => true, // use html5 Social Plugins instead of XFBML
//            'ogTags' => array(// set default OG tags
//                'title' => 'MY_WEBSITE_NAME',
//                'description' => 'MY_WEBSITE_DESCRIPTION',
//                'image' => 'URL_TO_WEBSITE_LOGO',
//            ),
//        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'regex' => array(
            'class' => 'ext.regularexpression.IRegularExpression',
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;port=3306;dbname=yii_noizing',
//            'connectionString' => 'mysql:host=localhost;port=3306;dbname=apsq6151_db',
            'emulatePrepare' => true,
            'username' => 'root',
//            'username' => 'apsq6151_user',
            'password' => '',
//            'password' => 'blink_182',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),
        'apsdb' => array(
            'connectionString' => 'mysql:host=124.81.245.26;dbname=fids',
            'username'         => 'root',
            'password'         => 'blink_182',          
            'class'            => 'CDbConnection'
        ),
        'errorHandler' => array(
            'errorAction' => '/site/default/error',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'caseSensitive' => true,
            'rules' => require __DIR__. DS . 'urlRules.php',
            'urlSuffix' => ''
        ),
//        'log' => array(
//            'class' => 'CLogRouter',
//            'routes' => array(
//                array(
//                    'class' => 'CFileLogRoute',
//                    'levels' => 'error, warning',
//                ),
//                // uncomment the following to show log messages on web pages
//                array(
//                    'class' => 'CWebLogRoute',
//                ),
//            ),
//        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager' => array(
                    'maxButtonCount' => 5,
                    'cssFile' => false,
                ),
                'CJuiDatePicker' => array(
                    'language' => 'ru',
                ),
//                'ERedactorWidget' => array(
//                    'options' => array(                        
//                        'buttons' => array(
//                            'formatting', '|', 'bold', 'italic', 'deleted', '|',
//                            'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
//                            'image', 'video', 'link','file', '|', 'html',
//                        ),
//                    ),
//                ),
            ),
        ),
//        'facebook'=>array(
//            'class' => 'application.extensions.facebook.IFacebook',
//            'app_id' => '154374271049',
//            'secret' => '88288a7ef5f50dd25f8df2c7881342ca',
//        ),
    )
);