
<div class="title"><h3><?php echo $title; ?></h3></div>
<div class="tags" style="text-align: justify;">
    <?php
    foreach ($this->getRecentTags() as $tag => $weight) {
        $link = CHtml::link(CHtml::encode(ucwords($tag)), array('articels/index', 'tag' => strtolower($tag)));
        echo $link . "\n";
    }
    ?>
</div>