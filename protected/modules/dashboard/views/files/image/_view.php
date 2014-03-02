<?php $img = json_decode($data->url_thumbnail_share); ?>
<div class="og-child" id="image<?php echo $data->id; ?>" >
    <a href="javascript:;" data-largesrc="<?php echo $img->torginal->imgurl; ?>" data-title="IF I control Your Life" data-description="Swiss chard pumpkin bunya nuts maize plantain aubergine napa cabbage soko coriander sweet pepper water spinach winter purslane shallot tigernut lentil beetroot.">
        <!--<img class="lazy" width="181" src="<?php // echo Yii::app()->baseUrl . "/themes/js/plugins/lazyload/img/loading.gif" ?>" data-original="<?php // echo $img->T232X155->imgurl; ?>" alt="<?php echo $data->files_uid; ?>" />-->
        <img class="lazy" width="181" src="<?php echo $img->T232X155->imgurl; ?>" alt="<?php echo $data->files_uid; ?>" />
    </a>
    <div class="icon-action" style="position: absolute;">
        <div class="iaction">
            <a href="javascript:;" class="iaction-remove" data-id="<?php echo $data->id; ?>" ><i class="i-remove icon-remove" ></i></a>
            <a href="javascript:;" class="iaction-edit" ><i class="i-edit icon-edit" ></i></a>
            <a href="javascript:;" class="iaction-ok" ><i class="i-ok icon-ok" ></i></a>
        </div>
    </div>
</div>