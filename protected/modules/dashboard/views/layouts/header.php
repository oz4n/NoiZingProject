<div id="header">
    <div class="container">
        <a href="#" class="brand">Dashboard Admin</a>
        <a href="javascript:;" class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <i class="icon-reorder"></i>
        </a>
        <?php
        $menu = array(
            array(
                'icon' => 'home',
                'label' => '',
                'url' => array('/dashboard/default/index'), 'itemOptions' => array('class' => 'nav-icon')),
            array(
                'icon' => 'icon-user',
                'label' => 'Accounts',
                'itemOptions' => array('class' => 'accounts-list'),
                'url' => '#',
                'items' => array(
                    array('icon' => 'th-list', 'label' => 'All Accounts', 'url' => array('/dashboard/account/index')),
                    array('icon' => 'plus', 'label' => 'Add New', 'url' => array('/dashboard/account/create')),
                    '---',
                    array('icon' => 'flag', 'label' => 'My Frofile', 'url' => array('#')),
                    array('icon' => 'cog', 'label' => 'Personal Settings', 'url' => array('#')),
                )
            ),
            array('label' => 'Posts',
                'icon' => 'tasks',
                'url' => '#',
                'itemOptions' => array('class' => 'articels-list'),
                'items' => array(
                    array('icon' => 'th-list', 'label' => 'All Posts', 'url' => array('/dashboard/post/index')),
                    array('icon' => 'plus', 'label' => 'Add New', 'url' => array('/dashboard/post/create')),
                    '---',
                    array('icon' => 'list-alt', 'label' => 'Categories', 'url' => array('/dashboard/category/index')),                    
                    array('icon' => 'tags', 'label' => 'Tags', 'url' => array('/dashboard/tag/index')),
                ),
            ),
            array(
                'icon' => 'list',
                'label' => 'Pages',
                'url' => array('#'),
                'itemOptions' => array('class' => 'pages-list'),
                'items' => array(
                    array('icon' => 'th-list', 'label' => 'All Pages', 'url' => array('/dashboard/page/index')),
                    array('icon' => 'plus', 'label' => 'Add New', 'url' => array('/dashboard/page/create')),
                    '---',
                    array('icon' => 'list-alt', 'label' => 'Page Categories', 'url' => array('/dashboard/pagecategory/index')),
                )
            ),
            array(
                'icon' => 'comment',
                'label' => 'Comments (' . count(Comment::model()->findAll('status="D"')) . ")",
                'url' => array('/dashboard/comment/index'),
                'itemOptions' => array('class' => 'comment-list'),
            ),
            array(
                'icon' => 'share-alt',
                'label' => '',
                'url' => array('#'),
                'itemOptions' => array('class' => 'more-list nav-icon'),
                'items' => array(
                    array(
                        'icon' => 'eye-open',
                        'label' => 'Appearance',
                        'url' => array('#'),
                        'itemOptions' => array('class' => 'appearance-list'),
                        'linkOptions' => array('onclick' => 'loadUrl("' . Yii::app()->createUrl('dashboard/appearance/index') . '")'),
                        'items' => array(
                            array('icon' => 'align-justify', 'label' => 'Themes', 'url' => array('#')),
                            array('icon' => 'filter', 'label' => 'Menus', 'url' => array('/dashboard/menu/index'), 'linkOptions' => array('class' => 'menu-list')),
                            array('icon' => 'th', 'label' => 'Widgets', 'url' => array('#')),
                            array('icon' => 'hdd', 'label' => 'Header', 'url' => array('#')),
                            array('icon' => 'user', 'label' => 'Beckground', 'url' => array('#')),
                            '---',
                            array('icon' => 'share-alt', 'label' => 'Editor', 'url' => array('#')),
                        ),
                    ),
                    array(
                        'icon' => 'gift',
                        'label' => 'Components',
                        'itemOptions' => array('class' => 'components-list'),
                        'linkOptions' => array('onclick' => 'loadUrl("' . Yii::app()->createUrl('dashboard/components/index') . '")'),
                        'url' => array('#'),
                        'items' => array(
                            array('icon' => 'th-list', 'label' => 'All Widgets', 'url' => array('/dashboard/widgets/index')),
                            array('icon' => 'share-alt', 'label' => 'Install Widgets', 'url' => array('/dashboard/widgets/install')),
                            '---',
                            array('icon' => 'th-list', 'label' => 'All Plugins', 'url' => array('/dashboard/plugins/index')),
                            array('icon' => 'share-alt', 'label' => 'Install Plugins', 'url' => array('/dashboard/plugins/install')),
                        ),
                    ),
                    array(
                        'icon' => 'file',
                        'label' => 'Files',
                        'itemOptions' => array('class' => 'files-list'),
                        'linkOptions' => array('onclick' => 'loadUrl("' . Yii::app()->createUrl('dashboard/files/index') . '")'),
                        'url' => array('#'),
                        'items' => array(
                            array('icon' => 'picture', 'label' => 'Images', 'url' => array('/dashboard/files/image')),
                            array('icon' => 'facetime-video', 'label' => 'Video', 'url' => array('/dashboard/files/video')),
                            array('icon' => 'book', 'label' => 'Document', 'url' => array('/dashboard/files/document')),
                        ),
                    ),
                    array(
                        'icon' => 'wrench',
                        'label' => 'Settings',
                        'itemOptions' => array('class' => 'settings-list'),
                        'linkOptions' => array('onclick' => 'loadUrl("' . Yii::app()->createUrl('dashboard/settings/index') . '")'),
                        'url' => array('#'),
                        'items' => array(
                            array('icon' => 'align-justify', 'label' => 'General', 'url' => array('#')),
                            array('icon' => 'filter', 'label' => 'Permalink', 'url' => array('#')),
                            array('icon' => 'th', 'label' => 'Media', 'url' => array('#')),
                            array('icon' => 'hdd', 'label' => 'Cloud', 'url' => array('#')),
                            array('icon' => 'user', 'label' => 'Social Network', 'url' => array('#')),
                            '---',
                            array('icon' => 'share-alt', 'label' => 'Order', 'url' => array('#')),
                        ),
                    ),
                    '---',
                    array('icon' => 'align-justify', 'label' => 'File Manager', 'url' => array('#')),
                ),
            ),
        );

        $this->widget('dashboard.components.AdminMenu', array(
            'htmlOptions' => array('class' => 'nav-collapse'),
            'items' => array(
                array(
                    'id' => 'main-nav',
                    'htmlOptions' => array('class' => 'pull-right'),
                    'class' => 'bootstrap.widgets.TbMenu',
                    'type' => 'html',
                    'items' => $menu
                ),
            ),
        ));
        ?>
    </div>
</div>
