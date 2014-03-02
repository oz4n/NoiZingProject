<?php


class RecentComments extends IWidgets {

    public function getRecentComments() {
        return Comment::model()->findRecentComments(Yii::app()->params['widgets']['comment']['maxcomment']);
    }

    protected function renderContent() {
        $title = Yii::app()->params['widgets']['comment']['title'];
        $this->render('recentComments',array('title'=>  $title));
    }

}