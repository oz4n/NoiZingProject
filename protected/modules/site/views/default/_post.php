<?php
/* @var $data Post */
?>
<div class="span3 item">
    <div class="thumbnail-style thumbnail-kenburn">
        <div class="thumbnail-img">
            <div class="overflow-hidden"><img  src="<?php echo $data->imglink; ?>" alt="" /></div>	
                <?php echo CHtml::link('Selengkapnya <i class="icon-angle-right"></i>', $data->url, array('rel'=>'tooltip',"data-original-title"=>$data->title,'class' => 'btn-more hover-effect')); ?>
        </div>
        <h6><?php echo TextHelper::character_limiter($data->title, 20); ?></h6>
        <p><?php echo TextHelper::word_limiter(strip_tags($data->content), 15); ?></p>
    </div>
</div>
