<?php
/* @var $this GuestbookController */
/* @var $data GuestBook */
?>


<li>
    <time class="cbp_tmtime" datetime="<?php echo date('Y-m-d H:i', $data->create_time); ?>"><span><?php echo date('Y-m-d', $data->create_time); ?></span> <span><?php echo date('H:i', $data->create_time); ?></span></time>
    <div class="cbp_tmicon"><a href="<?php echo $data->web_url; ?>" target="_blank"><?php echo Yii::app()->gravatar->getGravatar($data->email, 40); ?></a></div>
    <div class="cbp_tmlabel">
        <h5 class="media-heading"><?php echo $data->name; ?></h5>
        <p style="border-bottom: 1px solid #ffffff; padding-bottom: 10px;"><?php echo $data->content; ?></p>
        <?php foreach (GuestBook::model()->findAll('parent_id=' . $data->id) as $v): ?>
        <div class="media" style="border-bottom: 1px solid #ffffff;">
                <a class="pull-left" href="<?php echo $v->web_url; ?>" target="_blank">
                    <?php echo Yii::app()->gravatar->getGravatar($v->email, 30); ?>
                </a>
                <div class="media-body">
                    <h6 class="media-heading" style="color: #555555;"><?php echo $v->name; ?></h6>
                    <p><?php echo $v->content; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</li>

