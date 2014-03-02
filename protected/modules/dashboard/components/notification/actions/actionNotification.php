<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of actionNotification
 *
 * @author melengo
 */
class actionNotification extends CAction {

    private $_model;

    public function run() {
        switch ($_POST["action"]) {
            case $_POST["action"] = "allmsg":
                $this->getAllNotification();
                break;
            case $_POST["action"] = "moremsg":
                $this->getMoreComments();
                break;
            case $_POST["action"] = "replaymsg":
                $this->replay();
                break;
            case $_POST["action"] = "editmsg":
                $this->Update($_GET["id"]);
                break;
            case $_POST["action"] = "msgapprove":
                $this->Approve();
            default:
                break;
        }
    }

    protected function getAllNotification() {
        $comments = Comment::model()->findAll(array('condition' => 'parent_replay=0', 'order' => 'status DESC, create_time DESC', 'limit' => 5));
        $parent = array();
        $child = array();
        foreach ($comments as $v) {
            $post = Post::model()->find("id=" . $v->post_id);
            $replay = Comment::model()->findAll(array('condition' => 'parent_replay=' . $v->id, 'order' => 'create_time ASC', 'limit' => '10'));
            if ($v->status !== "D") {
                foreach ($replay as $vr) {
                    if ($vr->status === "D") {
                        $child[] = array(
                            "id" => $vr->parent_replay,
                            "child" => '<div class="media media-msg-id-' . $vr->id . '">' .
                            CHtml::link(Yii::app()->gravatar->getGravatar($vr->email, 20), $vr->url, array('class' => 'pull-left')) .
                            '<div class="media-body">' .
                            '<span class="pending " id="pending-' . $vr->id . '"><i class="icon-exclamation-sign"></i>Pending </span>' .
                            CHtml::link('<i class="icon-user"></i>' . $vr->author, "mailto:" . $vr->email) .
                            ' | <i class="icon-calendar"></i>' . date("D, M t, Y", $vr->create_time) .
                            '<p style="text-align: justify;" id="content-' . $vr->id . '">' . $vr->content . '</p>' .
                            CHtml::Link('<i class="icon-ok"></i>Approve <i style="color:#000;">|</i> ', '', array("id" => "approve-message-" . $vr->id, 'style' => 'cursor: pointer;  color:#fbb450;', 'onclick' => "Approve($vr->id)")) .  
                            CHtml::link('<i class="icon-share-alt"></i>Replay', '', array('id' => 'replay-message-' . $vr->id, 'style' => 'cursor: pointer;  color:#5bc0de;', 'onclick' => "ReplayFadein($vr->id)")) .
                            "<i style='color:#000;'> |</i> " .
                            CHtml::link("<i class='icon-pencil'></i>Edit", "", array("id" => "edit-message-$vr->id", "style" => "cursor: pointer; color:#57af57;",
                                'onclick' => "EditFadein($vr->id,$vr->parent_replay)")) .
                            "<i style='color:#000;'> |</i> " .
                            CHtml::link("<i class='icon-remove'></i>Delete", "", array('id' => "delete-message-$vr->id", "style" => 'cursor: pointer; color:#ee5f5b;',
                                'onclick' => "DeleteMSG($vr->id)")) .
                            '</div>' .
                            '<div id="form-replay-' . $vr->id . '" style="display:none;">' .
                            '<form id="form-action-' . $vr->id . '" action="' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/replay">' .
                            CHtml::textArea('Comment[content]', '', array('id' => 'textarea-' . $vr->id)) .
                            CHtml::hiddenField('Comment[post_id]', $vr->post_id) .
                            CHtml::hiddenField('Comment[parent_replay]', $vr->id, array('id' => 'texthidden-comment-replay-' . $vr->id)) .
                            CHtml::hiddenField('action', "replaymsg", array("id" => "action-msg-" . $vr->id)) .                            
                            CHtml::link('Replay', "", array('class' => 'btn btn-mini btn-primary', 'id' => 'btn-replay-' . $vr->id, 'onclick' => "", "value" => $vr->id)) . " " .
                            CHtml::link('Cencel', "", array('class' => 'btn btn-mini btn-info', 'id' => 'btn-replay-cencel-' . $vr->id, 'onclick' => "CencelBooton($vr->id)")) .
                            '<div class="loading-' . $vr->id . '"></div>' .
                            '</form>' .
                            '</div>' .
                            '</div>'
                        );
                    } else {
                        $child[] = array(
                            "id" => $vr->parent_replay,
                            "child" => '<div class="media media-msg-id-' . $vr->id . '">' .
                            CHtml::link(Yii::app()->gravatar->getGravatar($vr->email, 20), $vr->url, array('class' => 'pull-left')) .
                            '<div class="media-body">' .
                            CHtml::link('<i class="icon-user"></i>' . $vr->author, "mailto:" . $vr->email) .
                            ' | <i class="icon-calendar"></i>' . date("D, M t, Y", $vr->create_time) .
                            '<p style="text-align: justify;" id="content-' . $vr->id . '">' . $vr->content . '</p>' .
                            CHtml::link('<i class="icon-share-alt"></i>Replay', '', array('id' => 'replay-message-' . $vr->id, 'style' => 'cursor: pointer;  color:#5bc0de;', 'onclick' => "ReplayFadein($vr->id)")) .
                            "<i style='color:#000;'> |</i> " .
                            CHtml::link("<i class='icon-pencil'></i>Edit", "", array("id" => "edit-message-$vr->id", "style" => "cursor: pointer; color:#57af57;",
                                'onclick' => "EditFadein($vr->id,$vr->parent_replay)")) .
                            "<i style='color:#000;'> |</i> " .
                            CHtml::link("<i class='icon-remove'></i>Delete", "", array('id' => "delete-message-$vr->id", "style" => 'cursor: pointer; color:#ee5f5b;',
                                'onclick' => "DeleteMSG($vr->id)")) .
                            '</div>' .
                            '<div id="form-replay-' . $vr->id . '" style="display:none;">' .
                            '<form id="form-action-' . $vr->id . '" action="' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/replay">' .
                            CHtml::textArea('Comment[content]', '', array('id' => 'textarea-' . $vr->id)) .
                            CHtml::hiddenField('Comment[post_id]', $vr->post_id) .
                            CHtml::hiddenField('Comment[parent_replay]', $vr->id, array('id' => 'texthidden-comment-replay-' . $vr->id)) .
                            CHtml::hiddenField('action', "replaymsg", array("id" => "action-msg-" . $vr->id)) .
                            CHtml::link('Replay', "", array('class' => 'btn btn-mini btn-primary', 'id' => 'btn-replay-' . $vr->id, 'onclick' => "", "value" => $vr->id)) . " " .
                            CHtml::link('Cencel', "", array('class' => 'btn btn-mini btn-info', 'id' => 'btn-replay-cencel-' . $vr->id, 'onclick' => "CencelBooton($vr->id)")) .
                            '<div class="loading-' . $vr->id . '"></div>' .
                            '</form>' .
                            '</div>' .
                            '</div>'
                        );
                    }
                }
                $parent[] = array(
                    "parent" => '<div class="media media-msg-id-' . $v->id . '">' .
                    CHtml::link(Yii::app()->gravatar->getGravatar($v->email, 30), $v->url, array('class' => 'pull-left')) .
                    "<b> Response to " . $post->title . "</b>" .
                    '<div class="media-body">' .
                    '<b>' . CHtml::link('<i class="icon-user"></i>' . $v->author, "mailto:" . $v->email)
                    . ' | <i class="icon-calendar"></i> ' . date("D, M t, Y", $v->create_time) .
                    '</b>' .
                    '<p style="text-align: justify;" id="content-' . $v->id . '">' . $v->content . '</p>' .
                    '<b>' .
                    CHtml::link('<i class="icon-share-alt"></i>Replay', '', array('id' => 'replay-message-' . $v->id, 'style' => 'cursor: pointer;  color:#5bc0de;', 'onclick' => "ReplayFadein($v->id)")) .
                    " | " . CHtml::link('<i class="icon-remove"></i>Delete', '', array('id' => 'delete-message-' . $v->id, 'style' => 'cursor: pointer; color:#ee5f5b;', 'onclick' => "DeleteMSG($v->id)")) .
                    " | " . CHtml::link('<i class="icon-pencil"></i>Edit', '', array('id' => 'edit-message-' . $v->id, 'style' => 'cursor: pointer; color:#57af57;', 'onclick' => "EditFadein($v->id,$v->parent_replay)")) .
                    '</b>' .
                    '<div id="form-replay-' . $v->id . '" style="display:none;">' .
                    '<form id="form-action-' . $v->id . '" action="' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/replay">' .
                    CHtml::textArea('Comment[content]', '', array('id' => 'textarea-' . $v->id)) .
                    CHtml::hiddenField('Comment[post_id]', $v->post_id) .
                    CHtml::hiddenField('Comment[parent_replay]', $v->id, array('id' => 'texthidden-comment-replay-' . $v->id)) .
                    CHtml::hiddenField('action', "replaymsg", array("id" => "action-msg-" . $v->id)) .
                    CHtml::link('Replay', "", array('class' => 'btn btn-mini btn-primary', 'id' => 'btn-replay-' . $v->id, 'onclick' => "", 'value' => $v->id)) . " " .
                    CHtml::link('Cencel', "", array('class' => 'btn btn-mini btn-info', 'id' => 'btn-replay-cencel-' . $v->id, 'onclick' => "CencelBooton($v->id)")) .
                    '<div class="loading-' . $v->id . '"></div>' .
                    '</form>' .
                    '</div>' .
                    '<div id="parent-replay-' . $v->id . '"></div>' .
                    '<div id="parent-' . $v->id . '" style="margin-top:10px;"></div>' .
                    '</div>' .
                    '</div>'
                );
            } else {
                foreach ($replay as $vr) {
                    $child[] = array(
                        "id" => $vr->parent_replay,
                        "child" => '<div class="media media-msg-id-' . $vr->id . '">' .
                        CHtml::link(Yii::app()->gravatar->getGravatar($vr->email, 20), $vr->url, array('class' => 'pull-left')) .
                        '<div class="media-body">' .
                        CHtml::link('<i class="icon-user"></i>' . $vr->author, "mailto:" . $vr->email) .
                        ' | <i class="icon-calendar"></i>' . date("D, M t, Y", $vr->create_time) .
                        '<p style="text-align: justify;" id="content-' . $vr->id . '">' . $vr->content . '</p>' .
                        CHtml::link('<i class="icon-share-alt"></i>Replay', '', array('id' => 'replay-message-' . $vr->id, 'style' => 'cursor: pointer;  color:#5bc0de;', 'onclick' => "ReplayFadein($vr->id)")) .
                        "<i style='color:#000;'> |</i> " .
                        CHtml::link("<i class='icon-pencil'></i>Edit", "", array("id" => "edit-message-$vr->id", "style" => "cursor: pointer; color:#57af57;", 'onclick' => "EditFadein($vr->id,$vr->parent_replay)")) .
                        "<i style='color:#000;'> |</i> " .
                        CHtml::link("<i class='icon-remove'></i>Delete", "", array('id' => "delete-message-$vr->id", "style" => 'cursor: pointer; color:#ee5f5b;', 'onclick' => "DeleteMSG($vr->id)")) .
                        '</div>' .
                        '<div id="form-replay-' . $vr->id . '" style="display:none;">' .
                        '<form id="form-action-' . $vr->id . '" action="' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/replay">' .
                        CHtml::textArea('Comment[content]', '', array('id' => 'textarea-' . $vr->id)) .
                        CHtml::hiddenField('Comment[post_id]', $vr->post_id) .
                        CHtml::hiddenField('Comment[parent_replay]', $vr->id, array('id' => 'texthidden-comment-replay-' . $vr->id)) .
                        CHtml::hiddenField('action', "replaymsg", array("id" => "action-msg-" . $vr->id)) .
                        CHtml::link('Replay', "", array('class' => 'btn btn-mini btn-primary', 'id' => 'btn-replay-' . $vr->id, 'onclick' => "", "value" => $vr->id)) . " " .
                        CHtml::link('Cencel', "", array('class' => 'btn btn-mini btn-info', 'id' => 'btn-replay-cencel-' . $vr->id, 'onclick' => "CencelBooton($vr->id)")) .
                        '<div class="loading-' . $vr->id . '"></div>' .
                        '</form>' .
                        '</div>' .
                        '</div>'
                    );
                }

                $parent[] = array(
                    "parent" => '<div class="media media-msg-id-' . $v->id . '">' .
                    CHtml::link(Yii::app()->gravatar->getGravatar($v->email, 20), $v->url, array('class' => 'pull-left')) .
                    "<b> Response to " . $post->title . "</b>" .
                    '<div class="media-body">' .
                    '<b>' . '<span class="pending " id="pending-' . $v->id . '"><i class="icon-exclamation-sign"></i>Pending </span>' .
                    CHtml::link('<i class="icon-user"></i>' . $v->author, "mailto:" . $v->email) .
                    ' <i class="icon-calendar"></i> ' . date("D, M t, Y", $v->create_time) . '</b>' .
                    '<p style="text-align: justify;" id="content-' . $v->id . '">' . $v->content . '</p>' .
                    '<b>' .
                    CHtml::Link('<i class="icon-ok"></i>Approve <i style="color:#000;">|</i> ', '', array("id" => "approve-message-" . $v->id, 'style' => 'cursor: pointer;  color:#fbb450;', 'onclick' => "Approve($v->id)")) .
                    CHtml::link('<i class="icon-share-alt"></i>Replay <i style="color:#000;">|</i> ', "", array('id' => 'replay-message-' . $v->id, 'style' => 'cursor: pointer; color:#5bc0de;', 'onclick' => "ReplayFadein($v->id)")) .
                    CHtml::link('<i class="icon-remove"></i>Delete <i style="color:#000;">|</i> ', "", array('id' => 'delete-message-' . $v->id, 'style' => 'cursor: pointer; color:#ee5f5b;', 'onclick' => "DeleteMSG($v->id)")) .
                    CHtml::link('<i class="icon-pencil"></i>Edit ', "", array('id' => 'edit-message-' . $v->id, 'style' => 'cursor: pointer; color:#57af57;', 'onclick' => "EditFadein($v->id,$v->parent_replay)")) .
                    '</b>' .
                    '<div id="form-replay-' . $v->id . '" style="display:none;">' .
                    '<form id="form-action-' . $v->id . '" action="' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/replay">' .
                    CHtml::textArea('Comment[content]', '', array('id' => 'textarea-' . $v->id)) .
                    CHtml::hiddenField('Comment[post_id]', $v->post_id) .
                    CHtml::hiddenField('Comment[parent_replay]', $v->id, array('id' => 'texthidden-comment-replay-' . $v->id)) .
                    CHtml::hiddenField('action', "replaymsg", array("id" => "action-msg-" . $v->id)) .
                    CHtml::link('Replay', "", array('class' => 'btn btn-mini btn-primary', 'id' => 'btn-replay-' . $v->id, 'onclick' => "", 'value' => $v->id)) . " " .
                    CHtml::link('Cencel', "", array('class' => 'btn btn-mini btn-info', 'id' => 'btn-replay-cencel-' . $v->id, 'onclick' => "CencelBooton($v->id)")) .
                    '<div class="loading-' . $v->id . '"></div>' .
                    '</form>' .
                    '</div>' .
                    '<div id="parent-replay-' . $v->id . '"></div>' .
                    '<div id="parent-' . $v->id . '" style="margin-top:10px;"></div>' .
                    '</div>' .
                    '</div>'
                );
            }
        }

        echo CJSON::encode(array('parent' => $parent, 'child' => $child, 'count' => Comment::model()->getPendingCommentCount()));
    }

    protected function getMoreComments() {
        $model = Comment::model()->findAll(array('condition' => 'parent_replay=0', 'order' => 'status DESC, create_time DESC', "offset" => $_POST["offset"], "limit" => 5));
        $data = array();
        $child = array();
        foreach ($model as $v) {
            $post = Post::model()->find("id=" . $v->post_id);
            $replay = Comment::model()->findAll(array('condition' => 'parent_replay=' . $v->id,));

            foreach ($replay as $vr) {
                $child[] = array(
                    "id" => $vr->parent_replay,
                    "child" => '<div class="media media-msg-id-' . $vr->id . '">' .
                    CHtml::link(Yii::app()->gravatar->getGravatar($vr->email, 20), $vr->url, array('class' => 'pull-left')) .
                    '<div class="media-body">' .
                    CHtml::link('<i class="icon-user"></i>' . $vr->author, "mailto:" . $vr->email) .
                    ' | <i class="icon-calendar"></i>' . date("D, M t, Y", $vr->create_time) .
                    '<p style="text-align: justify;" id="content-' . $vr->id . '">' . $vr->content . '</p>' .
                    CHtml::link('<i class="icon-share-alt"></i>Replay', '', array('id' => 'replay-message-' . $vr->id, 'style' => 'cursor: pointer;  color:#5bc0de;', 'onclick' => "ReplayFadein($vr->id)")) .
                    "<i style='color:#000;'> |</i> " .
                    CHtml::link("<i class='icon-pencil'></i>Edit", "", array("id" => "edit-message-$vr->id", "style" => "cursor: pointer; color:#57af57;", 'onclick' => "EditFadein($vr->id,$vr->parent_replay)")) .
                    "<i style='color:#000;'> |</i> " .
                    CHtml::link("<i class='icon-remove'></i>Delete", "", array('id' => "delete-message-$vr->id", "style" => 'cursor: pointer; color:#ee5f5b;', 'onclick' => "DeleteMSG($vr->id)")) .
                    '</div>' .
                    '<div id="form-replay-' . $vr->id . '" style="display:none;">' .
                    '<form id="form-action-' . $vr->id . '" action="' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/replay">' .
                    CHtml::textArea('Comment[content]', '', array('id' => 'textarea-' . $vr->id)) .
                    CHtml::hiddenField('Comment[post_id]', $vr->post_id) .
                    CHtml::hiddenField('Comment[parent_replay]', $vr->id, array('id' => 'texthidden-comment-replay-' . $vr->id)) .
                    CHtml::hiddenField('action', "replaymsg", array("id" => "action-msg-" . $vr->id)) .
                    CHtml::link('Replay', "", array('class' => 'btn btn-mini btn-primary', 'id' => 'btn-replay-' . $vr->id, 'onclick' => "", "value" => $vr->id)) . " " .
                    CHtml::link('Cencel', "", array('class' => 'btn btn-mini btn-info', 'id' => 'btn-replay-cencel-' . $vr->id, 'onclick' => "CencelBooton($vr->id)")) .
                    '<div class="loading-' . $vr->id . '"></div>' .
                    '</form>' .
                    '</div>' .
                    '</div>'
                );
            }

            $data[] = array(
                "moremsg" => '<div class="media media-msg-id-' . $v->id . '" style="font-weight: normal;">' .
                '<a class="pull-left" href="' . $v->url . '">' .
                Yii::app()->gravatar->getGravatar($v->email, 20) .
                '</a>' .
                "<b> Response to " . $post->title . "</b>" .
                '<div class="media-body">' .
                '<b>' .
                CHtml::link('<i class="icon-user"></i>' . $v->author, "mailto:" . $v->email)
                . ' | <i class="icon-calendar"></i> ' . date("D, M t, Y", $v->create_time) .
                '</b>' .
                '<p style="text-align: justify;" id="content-' . $v->id . '">' . $v->content . '</p>' .
                '<b>' .
                CHtml::link('<i class="icon-share-alt"></i>Replay', '', array('id' => 'replay-message-' . $v->id, 'style' => 'cursor: pointer;  color:#5bc0de;', 'onclick' => "ReplayFadein($v->id)")) .
                " | " . CHtml::link('<i class="icon-remove"></i>Delete', '', array('id' => 'delete-message-' . $v->id, 'style' => 'cursor: pointer; color:#ee5f5b;', 'onclick' => "DeleteMSG($v->id)")) .
                " | " . CHtml::link('<i class="icon-pencil"></i>Edit', '', array('id' => 'edit-message-' . $v->id, 'style' => 'cursor: pointer; color:#57af57;', 'onclick' => "EditFadein($v->id,$v->parent_replay)")) .
                '</b>' .
                '<div id="form-replay-' . $v->id . '" style="display:none;">' .
                '<form id="form-action-' . $v->id . '" action="' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/replay">' .
                CHtml::textArea('Comment[content]', '', array('id' => 'textarea-' . $v->id)) .
                CHtml::hiddenField('Comment[post_id]', $v->post_id) .
                CHtml::hiddenField('Comment[parent_replay]', $v->id, array('id' => 'texthidden-comment-replay-' . $v->id)) .
                CHtml::hiddenField('action', "replaymsg", array("id" => "action-msg-" . $v->id)) .
                CHtml::link('Replay', "", array('class' => 'btn btn-mini btn-primary', 'id' => 'btn-replay-' . $v->id, 'onclick' => "", 'value' => $v->id)) . " " .
                CHtml::link('Cencel', "", array('class' => 'btn btn-mini btn-info', 'id' => 'btn-replay-cencel-' . $v->id, 'onclick' => "CencelBooton($v->id)")) .
                '<div class="loading-' . $v->id . '"></div>' .
                '</form>' .
                '</div>' .
                '<div id="parent-replay-' . $v->id . '"></div>' .
                '<div id="parent-' . $v->id . '"></div>' .
                '</div>' .
                '</div>'
            );
        }
        echo CJSON::encode(array("more" => $data, 'morechild' => $child,));
    }

    protected function replay() {
        $model = new Comment;
        if (isset($_POST['Comment'])) {
            $account = Account::model()->findAccount();
            $model->author = $account->username;
            $model->email = $account->email;
            $model->status = 'P';
            $model->content = $_POST['Comment']['content'];
            $model->parent_replay = $_POST['Comment']['parent_replay'];
            $model->post_id = $_POST['Comment']['post_id'];
            $model->url = Yii::app()->request->hostInfo;
            $model->save();
            $data = '<div class="media media-msg-id-' . $model->id . '" style="font-weight: normal;">' .
                    '<a class="pull-left" href="' . $model->url . '">' .
                    Yii::app()->gravatar->getGravatar($model->email, 20) .
                    '</a>' .
                    '<b>'
                    . CHtml::link('<i class="icon-user"></i>' . $model->author, $model->url) .
                    ' | <i class="icon-calendar"></i>' . date("D, M t, Y", time()) .
                    '</b>' .
                    '<div class="media-body">' .
                    '<p style="text-align: justify;" id="content-' . $model->id . '">' . $model->content . '</p>' .
                    CHtml::link('<i class="icon-share-alt"></i>Replay', '', array('id' => 'replay-message-' . $model->id, 'style' => 'cursor: pointer;  color:#5bc0de;', 'onclick' => "ReplayFadein($model->id)")) .
                    "<i style='color:#000;'> |</i> " .
                    CHtml::link("<i class='icon-pencil'></i>Edit", "", array("id" => "edit-message-$model->id", "style" => "cursor: pointer; color:#57af57;",'onclick' => "EditFadein($model->id,$model->parent_replay)")) .
                    "<i style='color:#000;'> |</i> " .
                    CHtml::link("<i class='icon-remove'></i>Delete", "", array('id' => "delete-message-$model->id", "style" => 'cursor: pointer; color:#ee5f5b;','onclick' => "DeleteMSG($model->id)")) .
                    '</div>' .
                    '<div id="form-replay-' . $model->id . '" style="display:none;">' .
                    '<form id="form-action-' . $model->id . '" action="' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/update/id/' . $model->id . '">' .
                    CHtml::textArea('Comment[content]', '', array('id' => 'textarea-' . $model->id)) .
                    CHtml::hiddenField('Comment[post_id]', $model->post_id) .
                    CHtml::hiddenField('action', "replaymsg", array("id" => "action-msg-" . $model->id)) .
                    CHtml::link('Update', "", array('class' => 'btn btn-mini btn-primary', 'id' => 'btn-edit-' . $model->id,
                        'onclick' => "EditSubmit($model->id)")) . " " .
                    CHtml::link('Cencel', "", array('class' => 'btn btn-mini btn-info', 'id' => 'btn-replay-cencel-' . $model->id,
                        'onclick' => "CencelBooton($model->id)")) .
                    '<div class="loading-' . $model->id . '"></div>' .
                    '</form>' .
                    '</div>' .
                    '</div>'
            ;
            echo CJSON::encode(array('html' => $data));
        }else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    protected function Update($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['Comment'])) {
            $model->attributes = $_POST['Comment'];
            if ($model->save())
                echo CJSON::encode(array('sucsess' => true));
        }
    }

    protected function Approve() {
        if (Yii::app()->request->isPostRequest) {
            $comment = $this->loadModel();
            $comment->approve();
            echo CJSON::encode(array('sucsess' => true));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    protected function loadModel() {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = Comment::model()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested pages does not exist.');
        }
        return $this->_model;
    }

}

