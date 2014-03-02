<div class="title"><h3><?php echo $title; ?></h3></div>

<?php foreach ($this->getRecentComments() as $comment): ?>
    <div class="media">
        <?php echo CHtml::link(Yii::app()->gravatar->getGravatar($comment->email, 20), "mailto:".$comment->email, array('class' => 'pull-left')); ?>
        <div class="media-body">
            <?php echo $comment->authorLink; ?> on
            <?php echo CHtml::link(CHtml::encode($comment->post->title), $comment->getUrl()); ?>
        </div>
    </div>
<?php endforeach; ?>
