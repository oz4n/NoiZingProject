<?php
/* @var $this TagsController */
/* @var $data Page */
/* @var $query Zend_Search_Lucene_Search_QueryParser */

?>
<div class="blog margin-bottom-30">
    <div class="headline">
        <h3><?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?></h3>
    </div>
    <?php if ($data->post_status === 'info'): ?>
        <div style="margin-top:-20px;">
            <ul class="unstyled inline blog-tags">
                <li>
                    <i class="icon-calendar"></i><a><?php echo date('F j, Y', $data->create_time); ?></a>
                </li>
                <li>
                    <i class="icon-user"></i> <?php echo CHtml::link($data->username, 'mailto:' . $data->email); ?>
                </li>
                <li>
                    <i class="icon-comment"></i> <a>With (<?php echo $data->commentCount; ?>) Comments </a>
                </li>
            </ul>
        </div>
    <?php endif; ?>
    <div style="margin-top:3px;">
        <?php
        $this->Widget('IReadMore', array(
            'linkUrl' => $data->url,
            'content' => $data->content,
            'layouts' => $layouts,
            'linkOptions' => array('class' => 'btn-u btn-u-small'),
            'textLabel' => 'Selengkapnya <i class="icon-angle-right"></i>'
        ));
        ?>
    </div>
    <?php if ($data->post_status === 'info'): ?>
        <div style="margin-top:45px; padding-top: 3px; border-top: 1px solid #eee">
            <ul class="unstyled inline blog-tags">
                <li><i class="icon-th-list"></i> <?php echo $data->catlinks; ?></li>
                <li><i class="icon-tags"></i> <?php echo $data->taglinks; ?></li>
            </ul>
        </div>
    <?php endif; ?>
</div>