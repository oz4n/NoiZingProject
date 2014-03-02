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
			<li class="arrow-box-left gray">
				<div class="avatar"><img class="avatar-small" src="http://beer2code.com/themes/core-admin/images/avatars/avatar1.jpg"></div>
				<div class="info">
                    <span class="name">
                        <span class="label label-blue">TASK</span> <strong class="indent">John</strong> completed this task: <strong
		                    class="strikethrough">Core Admin</strong>
                    </span>
					<span class="time"><i class="icon-time"></i> 6 minutes ago</span>
				</div>
				<div class="content">
					<blockquote>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
						labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
						laboris nisi ut aliquip ex ea commodo consequat.
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
						labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
						laboris nisi ut aliquip ex ea commodo consequat.
					</blockquote>
					<div>
						<a href="#"><i class="icon-paper-clip"></i> <b>project_news.docx</b></a>
					</div>
					<div class="media">
						<a class="pull-left img-child" href="#">
							<img class="media-object avatar-small img-circle"
							     src="http://beer2code.com/themes/core-admin/images/avatars/avatar1.jpg" alt="">
						</a>

						<div class="media-body">
							<div class="info">
                                <span class="name">
                                    <strong class="indent">ozan rock</strong>
                                </span>
								<span class="time"><i class="icon-time"></i> 3 minutes ago</span>
							</div>
							<blockquote style="text-align: justify">Donec id elit non mi porta gravida at eget metus.
								Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
								massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed
								odio dui.
							</blockquote>
							July 23, 2013
						</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
<?php endif; ?>

