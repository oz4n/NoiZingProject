<?php
/* @var $this TagsController */
/* @var $tags Page */
?>
<div class="blog margin-bottom-30">
	<div class="headline">
		<h3><?php echo $tags->title; ?></h3>
	</div>
	<?php if ($tags->post_status === 'info'): ?>
		<div style="margin-top:-20px;">
			<ul class="unstyled inline blog-tags">
				<li>
					<i class="icon-calendar"></i><a><?php echo date('F j, Y', $tags->create_time); ?></a>
				</li>
				<li>
					<i class="icon-user"></i> <?php echo CHtml::link($tags->account->username, 'mailto:' . $tags->account->email); ?>
				</li>
				<li>
					<i class="icon-comment"></i> <a>With (<?php echo $tags->commentCount; ?>) Comments </a>
				</li>
			</ul>
		</div>
	<?php endif; ?>
	<div style="margin-top:5px;">
		<?php
		echo $tags->content;
		?>
	</div>
	<?php if ($tags->post_status === 'info'): ?>
		<div style="margin-top: 20px; padding-top: 3px; border-top: 1px solid #eee">
			<ul class="unstyled inline blog-tags">
				<li><i class="icon-th-list"></i> <?php echo implode(", ", $tags->catlinks($tags->id)); ?></li>
				<li><i class="icon-tags"></i> <?php echo implode(', ', $tags->taglinks); ?></li>
			</ul>
		</div>
	<?php endif; ?>
</div>
<?php if ($tags->comment_status == "E"): ?>
	<div class="comment-chat">
		<b><i class="icon-comment"></i> Comments (0)</b>
		<ul class="chat-box timeline">
			<?php foreach ($comment->findAllByPostID($tags->id) as $com): ?>
				<li class="arrow-box-left gray">
					<div class="avatar">
						<?php echo Yii::app()->gravatar->getGravatar($com->email, 45); ?>
						<!--						<img class="avatar-small" src="http://beer2code.com/themes/core-admin/images/avatars/avatar1.jpg">-->
					</div>
					<div class="info">
                    <span class="name">
                        <strong class="indent"><?php echo $com->author; ?></strong>
                    </span>
						<span class="time"><i
								class="icon-time"></i> <?php echo date('F j, Y \a\t h:i a', $com->create_time); ?></span>
					</div>
					<div class="content">
						<p>
							<?php echo $com->content; ?>
						</p>
						<?php foreach ($comment->findAllByPostID($tags->id, $com->id) as $comc): ?>
							<?php if ($com->id === $comc->parent_replay): ?>
								<div class="media">
									<a class="pull-left img-child" href="#">
										<!--										<img class="media-object avatar-small img-circle"-->
										<!--										     src="http://beer2code.com/themes/core-admin/images/avatars/avatar1.jpg"-->
										<!--										     alt="">-->
										<?php echo Yii::app()->gravatar->getGravatar($comc->email, 45); ?>
									</a>

									<div class="media-body">
										<div class="info-child">
			                                <span class="name-child">
			                                    <strong class="indent"><?php echo $comc->author; ?></strong>
			                                </span>
											<br>
											<span class="time-child">
												<?php echo date('F j, Y \a\t h:i a', $comc->create_time); ?>
											</span>
										</div>
										<p style="text-align: justify">
											<?php echo $comc->content; ?>
										</p>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>

				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php if (Yii::app()->user->hasFlash('commentSubmitted')): ?>
		<div style="margin-top: 20px;"  class="alert alert-success">
			<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
		</div>
	<?php endif; ?>
	<div class="headline"><h3>Leave a comment</h3></div>
	<?php
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'comment-form', 'type' => 'vertical', 'enableAjaxValidation' => true));
	echo $form->textFieldRow($comment, 'author', array('prepend' => '<i class="icon-user"></i>', 'class' => 'input-xlarge'));
	echo $form->textFieldRow($comment, 'email', array('prepend' => '<i class="icon-envelope-alt"></i>', 'class' => 'input-xlarge'));
	echo $form->textFieldRow($comment, 'url', array('prepend' => '<i class=" icon-link"></i>', 'class' => 'input-xlarge'));
	echo $form->textAreaRow($comment, 'content', array('class' => 'span12', 'rows' => 8,));
	?>
	<?php if (extension_loaded('gd')): ?>
		<div class="control-group">
			<div class="controls">
				<?php $this->widget('CCaptcha'); ?>
			</div>
		</div>
		<?php echo $form->textFieldRow($comment, 'verifyCode', array('class' => 'span7', 'prepend' => '<i class="icon-lock"></i>')); ?>
		<span
			class="help-block ">Masukkan huruf seperti yang terlihat pada gambar di atas. Huruf tidak Case-Sensitive.</span>
	<?php endif; ?>
	<button type="submit" class="btn-u">Send Comment</button>
	<?php $this->endWidget(); ?>
<?php endif; ?>

