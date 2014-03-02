<div class="articels" style="margin-bottom: 20px;">
    <div class="articels-content">        
        <h4><?php echo CHtml::link($data->title, '#', array('style' => 'text-decoration:none')); ?></h4>
        <div style="font-size: 12px; padding-bottom: 5px;"> 
            <span ><i class="icon-calendar" style="margin-top: 1px;"></i><?php echo date('F d, Y', $data->create_time); ?></span> 
            <span style="padding-left: 5px;"><i class="icon-user" style="margin-top: 1px;"></i><?php echo 'By ' . $data->account->username; ?></span>        
            <span style="padding-left: 5px;"><i class="icon-eye-open" style="margin-top: 1px;"></i><?php echo 'With (' . $data->post_view . ') View'; ?></span>
        </div>
        <div class="media">
         
            <div class="media-body">
                <?php
                if (preg_match('/<!--more(.*?)?-->/', $data->content, $mch)) {
                    $content = explode($mch[0], $data->content, 2);
                    echo $content[0];
                }
                else
                    echo $data->content;
                ?>   
            </div>
        </div>

    </div>
   
    <div class="articels-footer">
        <span style="font-weight: bold;">Tags :</span> <?php echo $data->tags; ?><br>
        <span style="font-weight: bold;">Categories :</span> <?php  echo $data->category($data->id); ?><br>
        <span class="articels-actions">
            <?php
            echo CHtml::link('Edit', Yii::app()->createUrl('dashboard/page/update', array('id' => $data->id)), array('style' => 'text-decoration:none')) . ' | ';
//            echo CHtml::link('Quick Edit', Yii::app()->createUrl('dashboard/pages/update', array('id' => $data->id)), array('style' => 'text-decoration:none')) . ' | ';
            echo CHtml::link('Delete', 'javascript:;', array('style' => 'text-decoration:none','class'=>'delete-box','id' => $data->id)) . ' | ';
            echo CHtml::link('View', '#', array('style' => 'text-decoration:none',));
            ?>
        </span>       
    </div>
</div>
<script>
    jQuery(function($){
        $().live('click',function(){
            
        });
    });
</script>