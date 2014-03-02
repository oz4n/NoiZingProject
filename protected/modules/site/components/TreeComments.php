<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TreeComments
 *
 * @author melengo
 */
class TreeComments extends IWidgets {

    public $table;
    public $model;

    public function run() {
        $this->commentTree($this->table);
        parent::run();
    }
    
    private function commentTree($array, $parent = 0, $level = 0) { 
        $post = Post::model()->find('slug="'.$_GET['slug'].'"');
        foreach ($array as $key => $value) {
            if ($value['parent_replay'] == $parent) {
                Yii::app()->clientScript->registerScript('sc-urp-' . $value['id'], '$("body").on("click","#comment-r-' . $value['id'] . '",function(){ if($("#comments-replay-' . $value['id'] . '").is(":hidden")){ $("#comments-replay-' . $value['id'] . '").slideDown(200); }else{ $("#comments-replay-' . $value['id'] . '").slideUp(200); } });', CClientScript::POS_END);
                Yii::app()->clientScript->registerScript('sc-crp-' . $value['id'], '$("body").on("click","#replay-cencel-' . $value['id'] . '",function(){ $("#comments-replay-' . $value['id'] . '").slideUp(200); });', CClientScript::POS_READY);
                Yii::app()->clientScript->registerScript('sc-srp-' . $value['id'], '$("body").on("click","#replay-submit-' . $value['id'] . '",function(){ $("#comment-loadings-' . $value['id'] . '").show(); });', CClientScript::POS_READY);
                
              
                echo '<div class="media span9" style="margin-left: -4px; margin-top:20px;" id="replay-user-'.$value['id'].'">';               
              
                echo CHtml::link(Yii::app()->gravatar->getGravatar($value['email']), "mailto:".$value['email'],array('class'=>'pull-left'));
                echo '<div class="media-body parent-comments">';
                echo "<div class='ie ze'></div>";
                echo '<div class="comment-by" style="border-bottom: 1px solid #EEEEEE; "><b>' . $value['authorLink']." | " .  str_replace("+0000", "", date('r A', $value['create_time'])). '</b></div>';                
                echo '<p style="margin-top:50px;">' . nl2br(CHtml::encode($value['content'])) . '</p>';                
                echo CHtml::link('<i class="icon-share-alt"></i> Replay','#replay-user-'.$value['id'],array('class'=>'pull-right','id'=>'comment-r-'.$value['id']));
                echo "</div>";
                echo "</div>";
               
                
                $model = Comment::model()->findAll('status="P" && parent_replay='.$value['id']);
                
               
                echo '<div class="media child-comments span8">';                
                foreach ($model as $v) {
                    echo '<div class="media">';   
                    echo CHtml::link(Yii::app()->gravatar->getGravatar($v->email,20), "mailto:" . $v->email, array('class' => 'pull-left'));
                    echo '<div class="media-body">';
                    echo '<b>' . $v->authorLink . " | " . str_replace("+0000", "", date('r A', $v->create_time)) . '</b>';
                    echo '<p>' . nl2br(CHtml::encode($v->content)) . '</p>'; 
                    echo "</div>";
                    echo "</div>";
                }     
                echo '<span id="app-rep-'.$value['id'].'"></span>';
                
                echo '<div class="media" id="comments-replay-'.$value['id'].'" style="display:none;">';
                echo CHtml::link(Yii::app()->gravatar->getGravatar("oz4n.rock@gmail.com",20), "mailto:oz4n.rock@gmail.com", array('class' => 'pull-left'));
                echo '<div class="media-body">';                
                    $form = $this->beginWidget('CActiveForm', array('id' => 'comment-form','enableAjaxValidation' => false));                 
                    if(Yii::app()->user->isGuest):
                        echo '<div class="field">';
                        echo '<div class="input-prepend">';
                        echo '<span class="add-on"><i class="icon-user"></i></span>';
                        echo $form->textField($this->model, 'author', array('size' => 60, 'maxlength' => 128,'placeholder'=>'Author...'));
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="field">';
                        echo '<div class="input-prepend">';
                        echo '<span class="add-on"><i class="icon-envelope"></i></span>';
                        echo $form->textField($this->model, 'email', array('size' => 60, 'maxlength' => 128,'placeholder'=>'E-mail...'));
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="field">';
                        echo '<div class="input-prepend">';
                        echo '<span class="add-on"><i class="icon-bookmark"></i></span>';
                        echo $form->textField($this->model, 'url', array('size' => 60, 'maxlength' => 128,'placeholder'=>'Url...'));
                        echo '</div>';
                        echo '</div>';
                    endif;
                    
                    echo '<div class="field">';                   
                    echo $form->textArea($this->model, 'content', array('rows' => 6, 'cols' => 50,'placeholder'=>'Content...'));
                    echo $form->hiddenField($this->model, 'parent_replay', array('value' => $value['id']));                    
                    echo $form->hiddenField($this->model, 'post_id', array('value' => $post->id));                   
                    echo '</div>';                    
                    echo '<div class="field ">';   
                    
                    echo CHtml::ajaxSubmitButton('Replay', array('articels/replay'), array(
                          'type' => 'POST',
                          'dataType' => 'json',
                          'success' => 'function(data, e){ $("#comment-loadings-' . $value['id'] . '").hide(); $.msgGrowl({ type: "success", title: "Replay", text: " Your replay will be posted once it is approved." }); $("#app-rep-' . $value['id'] . '").append(data.html).fadeIn("slow"); }',
                    ),array('id'=>'replay-submit-'.$value['id'],'class'=>'btn btn-small','style'=>'width:60px; height: 26px;'));
                    echo ' ',CHtml::link('Cencel', '#replay-user-'.$value['id'],array('style'=>'margin-top:-14px;','class'=>'btn btn-small','id' => 'replay-cencel-'.$value['id']));
                    echo '<div id="comment-loadings-'.$value['id'].'" style="height: 28px; width: 28px; display: none; float: right; background: url('.Yii::app()->baseUrl.'/themes/site/img/loading.gif'.') no-repeat 1px;"></div>';
                    echo '</div>';
                    $this->endWidget();
                echo '</div>';
                echo '</div>'; 
                echo "</div>";
               
            }
        }
    }
    
//    private function commentTree($array, $parent = 0, $level = 0) {       
//        foreach ($array as $key => $value) {
//            if ($value['parent_replay'] == $parent) {
//                echo '<div class="media" style="padding-top: 20px; border-top: solid 1px #EEE;">';
//                echo '<span class="pull-left">';
//                echo Yii::app()->gravatar->getGravatar($value['email']);
//                echo '</span>';
//                echo '</span>';
//                echo '<div class="media-body">';
//                echo '<div class="comment-by"><strong>' . $value['authorLink'] . '</strong><span class="reply">/<a href="post.html#">Reply</a></span> <span class="date">' . date('F j, Y', $value['create_time']) . '</span></div>';
//                echo '<p>' . nl2br(CHtml::encode($value['content'])) . '</p>';
//                $this->commentTree($array, $value['id'], $level);
//                echo "</div>";
//                echo "</div>";
//            }
//        }
//    }

//    private function generateTree($array, $parent = 0, $level = 0) {
//        $has_children = false;
//        foreach ($array as $key => $value) {
//            if ($value['parent_replay'] == $parent) {
//                if ($has_children === false) {
//                    $has_children = true;
//                    echo '<ul>';
//                    $level++;
//                }
//                echo '<li style="margin-left: 20px;">'.$value['authorLink'];
//                $this->generateTree($array, $value['id'], $level);
//                echo '</li>';
//            }
//        }
//        if ($has_children === true)
//            echo '</ul>';
//    }
}
