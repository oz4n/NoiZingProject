<div class="testimonial-container">
    <div class="title"><h3><?php echo $title; ?></h3></div>
    <div class="testimonials-carousel" data-autorotate="2000" style="overflow: hidden; width: 100%;" role="application" aria-live="polite">	<a href="#carousel-1-0" class="mr-rotato-next mr-rotato-disabled" aria-disabled="true"></a><a href="#carousel-1-0" class="mr-rotato-prev"></a>
        <ul class="carousel" id="carousel-1-0" style="margin-left: -300%; float: left; width: 400%; -webkit-transition: margin-left 0.3s ease;" aria-activedescendant="carousel-1-0-slide3">
            <?php
            $data = $this->getRecentTweets();
            for ($i = 0; $i < $limit; $i++):
                ?>
                <li class="testimonial" style="float: left; width: 25%;" role="tabpanel document" id="carousel-1-0-slide0" aria-hidden="true">
                    <div class="testimonials" style=" padding: 10px 10px 20px 10px; ">
                        <div class="media" style="margin-left: -5px;">
                            <?php echo CHtml::link(CHtml::image($data[$i]->user->profile_image_url, '', array('class' => 'img-rounded', 'width' => '40', 'heigt' => '40')), 'https://twitter.com/' . $data[$i]->user->screen_name, array('class' => 'pull-left', 'target' => '_blank')); ?>
                            <div class="media-body">
                                <?php
                                echo '<b>' . str_replace('+0000', '', $data[$i]->created_at) . '</b>';                                
                                echo '<p>'.Yii::app()->regex->replaceLink($data[$i]->text).'</p>';
                                ?> 
                            </div>
                        </div>
                    </div>
                    <div class="testimonials-bg"></div>
                    <div class="testimonials-author">
                        <?php
                        echo CHtml::link("@" . $data[$i]->user->screen_name, 'https://twitter.com/' . $data[$i]->user->screen_name, array('target' => '_blank'));
                        ?>                    
                    </div>
                </li>
            <?php endfor; ?>
        </ul>

    </div>

</div>