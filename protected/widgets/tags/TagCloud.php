<?php



class TagCloud extends IWidgets {

    public function getRecentTags() {
        return Tag::model()->findTagWeights(Yii::app()->params['widgets']['tag']['maxtag']);
    }

    protected function renderContent() {
        $title = Yii::app()->params['widgets']['tag']['title'];
        $this->render('recentTags', array('title' => $title));
    }

}