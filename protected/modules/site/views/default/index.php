<div id="portfolio-wrapper" class="row-fluid" style="margin-top: 10px;">
    <!--<div class="headline"><h3>Informasi Terbaru</h3></div>-->
    <!--        <ul class="thumbnails">-->
<!--    <div class="span12">-->
    <?php
    Yii::import('ext.ciHelpers.TextHelper');
//    $this->widget('bootstrap.widgets.TbListView', array(
//        'dataProvider' => $post,
//        'itemView' => '_post',
//        'template' => "{items}",
////            'htmlOptions' => array('style' => 'padding-top:0;')
//    ));
    foreach($post as $data):
    ?>
    <!--        </ul>-->
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
    <?php endforeach; ?>
</div>
<div>More</div>
<!--</div>-->
<script>
    jQuery(document).ready(function () {

        $('#portfolio-wrapper').imagesLoaded(function () {

            var $container = $('#portfolio-wrapper');
            $select = $('#filters select');

            // initialize Isotope
            $container.isotope({
                // options...
                resizable: false, // disable normal resizing
                // set columnWidth to a percentage of container width
                masonry: { columnWidth: $container.width() / 12 }
            });

            // update columnWidth on window resize
            $(window).smartresize(function () {

                $container.isotope({
                    // update columnWidth to a percentage of container width
                    masonry: { columnWidth: $container.width() / 12 }
                });
            });


            $container.isotope({
                itemSelector: '.item'
            });

            $select.change(function () {

                var filters = $(this).val();

                $container.isotope({
                    filter: filters
                });

            });

            var $optionSets = $('#filters .option-set'),
                $optionLinks = $optionSets.find('a');

            $optionLinks.click(function () {

                var $this = $(this);
                // don't proceed if already selected
                if ($this.hasClass('selected')) {
                    return false;
                }
                var $optionSet = $this.parents('.option-set');
                $optionSet.find('.selected').removeClass('selected');
                $this.addClass('selected');

                // make option object dynamically, i.e. { filter: '.my-filter-class' }
                var options = {},
                    key = $optionSet.attr('data-option-key'),
                    value = $this.attr('data-option-value');
                // parse 'false' as false boolean
                value = value === 'false' ? false : value;
                options[ key ] = value;
                if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
                    // changes in layout modes need extra logic
                    changeLayoutMode($this, options)
                } else {
                    // otherwise, apply new options
                    $container.isotope(options);
                }

                return false;

            });

        });

    });
</script>