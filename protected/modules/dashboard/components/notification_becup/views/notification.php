<?php
echo CHtml::link('<i class="img-white-users"></i>', "", array('id' => 'pop-users', 'style' => 'cursor: pointer;'));
echo CHtml::Link($comment != null ? '<i class="img-red-comments" id="img-red"></i>' : '<i class="img-white-comments"></i>', "", array('id' => 'pop-comments', 'style' => 'cursor: pointer;'));
echo CHtml::link('<i class="img-white-globe"></i>', "", array('id' => 'pop-setting', 'style' => 'cursor: pointer;'));
?>
<div id="pop-setting-show" class=" popover-notification globel-setting">
    <div class="arrow"></div>
    <h3 class="popover-title"><b>Global Setting</b></h3>
    <div class="popover-content">
        <p>Content</p>
    </div>
    <div class="popover-footer">Global Setting</div>
</div>

<div id="pop-comments-show" class="popover-notification comments-setting" >
    <div class="arrow"></div>
    <h3 class="popover-title"><b>New Message</b>        
        <span class="label label-important" style="background:#a80009;" id="con-newMessage">0</span>       
    </h3>
    <div class="popover-content">                             
        <div id="user-comments">
            <div class="notification-loadings"></div>
        </div>      
        <div id="more-msg" style="margin-top:10px;"></div>
        <div id="slimscroll-id"></div>
    </div>
    <div id="more-loadings"></div>
    <div class="popover-footer"><?php echo CHtml::link("View All", Yii::app()->request->hostInfo . Yii::app()->baseUrl . "/index.php/dashboard/comment", array('class' => 'btn btn-small', 'style' => 'float:right;')); ?></div>
</div>

<div id="pop-users-show" class=" popover-notification users-setting">
    <div class="arrow"></div>
    <h3 class="popover-title">Users Settings</h3>
    <div class="popover-content">
      content
    </div>
    <div class="popover-footer">User Setting</div>
</div>
