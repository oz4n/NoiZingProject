<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticelsController
 *
 * @author melengo
 */
class ArticelsController extends ClientController {

    private $_model;
    public $layout = 'site.views.layouts.blog.1.main';

    public function actions() {
//        return array(
//            'tweet.' => 'testProvider',
//        );
    }

    public function actionTest() {
        $model = Yii::app()->db->createCommand()->select('max(position) as max')->from('navigasi')->where('type="M"')->queryScalar();
        echo $model;
        //max(values)
    }

    public function actionIndex() {
        $layouts = 1;
        $criteria = new CDbCriteria(array(
                    'condition' => "status= 'P'",
                    'order' => 'update_time DESC',
                    'with' => 'commentCount',
                ));
        if (isset($_GET['tag']))
            $criteria->addSearchCondition('tags', $_GET['tag']);

        $dataProvider = new CActiveDataProvider('Post', array(
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['postsPerPage'],
                    ),
                    'criteria' => $criteria,
                ));


        $this->render('index', array(
            'pages' => $dataProvider,
            'layouts' => $layouts
        ));
    }

   
    public function actionView() {

        $post = $this->loadModel();
        $layouts = 1;
        $comment = $this->newComment($post);
        $this->render('view', array(
            'model' => $post,
            'comment' => $comment,
            'layouts' => $layouts
        ));
    }

    protected function newComment($post) {
        $comment = new Comment;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
            echo CActiveForm::validate($comment);
            Yii::app()->end();
        }
        if (isset($_POST['Comment'])) {
            $comment->attributes = $_POST['Comment'];
            if ($post->addComment($comment)) {
                if ($comment->status == 'D')
                    Yii::app()->user->setFlash('commentSubmitted', '<strong>Thank you for your comment!</strong> Your comment will be posted once it is approved.');
                $this->refresh();
            }
        }
        return $comment;
    }

    public function actionReplay() {

        $comment = new Comment;
        if (isset($_POST['Comment'])) {
            if (Yii::app()->user->isGuest) {
                $comment->author = $_POST['Comment']['author'];
                $comment->email = $_POST['Comment']['email'];
                $comment->url = $_POST['Comment']['url'];
                $comment->content = $_POST['Comment']['content'];
                $comment->post_id = $_POST['Comment']['post_id'];
                $comment->parent_replay = $_POST['Comment']['parent_replay'];
                $comment->status = 'D';
                $comment->save();
                $data = '<div class="media">' .
                        CHtml::link(Yii::app()->gravatar->getGravatar($_POST['Comment']['email'], 20), "mailto:" . $_POST['Comment']['email'], array('class' => 'pull-left')) .
                        '<div clsas="media-body">' .
                        '<b>' . CHtml::link($_POST['Comment']['author'], $_POST['Comment']['url']) . " | " . str_replace("+0000", "", date('r A', time())) . '</b>' .
                        '<p>' . $_POST['Comment']['content'] . '</p>' .
                        '</div>' .
                        '</div>';
                echo json_encode(array('success' => true, 'html' => $data));
            } else {
                $account = Account::model()->findAccount();
                $comment->author = $account->username;
                $comment->email = $account->email;
                $comment->url = Yii::app()->request->hostInfo;
                $comment->content = $_POST['Comment']['content'];
                $comment->post_id = $_POST['Comment']['post_id'];
                $comment->parent_replay = $_POST['Comment']['parent_replay'];
                $comment->status = 'P';
                $comment->save();
                $data = '<div class="media">' .
                        CHtml::link(Yii::app()->gravatar->getGravatar(Account::model()->findAccount()->email, 20), "mailto:" . $account->email, array('class' => 'pull-left')) .
                        '<div clsas="media-body">' .
                        '<b>' . CHtml::link($account->username, Yii::app()->request->hostInfo) . " | " . str_replace("+0000", "", date('r A', time())) . '</b>' .
                        '<p>' . $_POST['Comment']['content'] . '</p>' .
                        '</div>' .
                        '</div>';
                echo json_encode(array('html' => $data));
            }
        } else {
            throw new CHttpException(404, 'The requested pages does not exist.');
        }
    }

    public function loadModel() {
        if (isset($_GET['id'])) {
            return $this->loadId();
        } else {
            return $this->loadSlug();
        }
    }

    public function loadId() {
        if ($this->_model === null) {
            if (isset($_GET['id'])) {
                if (Yii::app()->user->isGuest)
                    $condition = "status= 'P'";
                else
                    $condition = '';
                $this->_model = Post::model()->findByPk($_GET['id'], $condition);

                if (!isset($this->_model->count)) {
                    throw new CHttpException(404, 'The requested pages does not exist.');
                } else {
                    $this->_model->count = $this->_model->count + 1;
                    $this->_model->save();
                }
            }
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested pages does not exist.');
        }
        return $this->_model;
    }

    public function loadSlug() {
        if ($this->_model === null) {
            if (isset($_GET['slug'])) {
                if (Yii::app()->user->isGuest)
                    $condition = "status= 'P'";
                else
                    $condition = '';
                $this->_model = Post::model()->findByAttributes(array('slug' => $_GET['slug']), array('condition' => $condition));

                if (!isset($this->_model->count)) {
                    throw new CHttpException(404, 'The requested pages does not exist.');
                } else {
                    $this->_model->count = $this->_model->count + 1;
                    $this->_model->save();
                }
            }
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested pages does not exist.');
        }
        return $this->_model;
    }

}
