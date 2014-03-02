<div id="topbar" >
<!--<div id="topbar" >-->
    <div class="container">
        <a href="javascript:;" id="menu-trigger" class="dropdown-toggle" data-toggle="dropdown" data-target="#">
            <i class="icon-cog"></i>
        </a>
        <div id="top-nav">
            <ul>
                <li class="dropdown">
                    <a href="<?php echo Yii::app()->createUrl('site/default/index'); ?>">
                        <i class="icon-share-alt"></i>View Your Site	
                    </a>
                </li>
            </ul>

            <ul class="pull-right">
                <li><a href="javascript:;"><i class="icon-user"></i><?php echo Yii::app()->user->name; ?></a></li>              
                <li><a href="<?php echo Yii::app()->createUrl('site/default/logout'); ?>"><i class="icon-off"></i>Logout</a></li>
            </ul>

        </div>

    </div>

</div>