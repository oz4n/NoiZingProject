<?php
/**
 * Created by JetBrains PhpStorm.
 * User: melengo
 * Date: 10/13/13
 * Time: 8:03 PM
 * To change this template use File | Settings | File Templates.
 */

class CommentsController extends ClientController
{
	protected function newComment($post)
	{
		$comment = new Comment;
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
		if (isset($_POST['Comment'])) {
			$comment->attributes = $_POST['Comment'];
			if ($post->addComment($comment)) {
				if ($comment->status == 'D')
					Yii::app()->user->setFlash('commentSubmitted', 'Thank you for your comment. Your comment will be posted once it is approved.');
				$this->refresh();
			}
		}
		return $comment;
	}
}