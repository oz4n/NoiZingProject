<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ENotification
 *
 * @author melengo
 */
class ENotification extends CWidget {

    public static $_model;

    public function __construct() {
        parent::__construct();
        self::$_model = new Comment();
    }

    public static function actions() {
        parent::actions();
        return array(
            'msg' => 'dashboard.components.notification.actions.actionNotification'
        );
    }

    public function init() {
        parent::init();
        $this->generetJS();
        $this->generetJSnotification();
        $this->renderContent();
    }

    protected function renderContent() {
        $comment = self::$_model->model()->findAll('status="D"');
        $this->render('notification', array('comment' => $comment));
    }
        
    protected function generetJS() {
        /* Global Message notification js generet */
         Yii::app()->clientScript->registerScript('script-function', '
                 function DeleteMSG(cmid){
                    console.log("function DeleteMSG");
                    $("body").on("click","#delete-message-" + cmid,function(){  
                        $(".media-msg-id-"+cmid).fadeOut(1000);
                        $.ajax({
                        type: "POST",
                        "dataType":"json",
                        url: "' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . "/index.php/dashboard/comment/delete" . '",
                        data: {id:cmid},
                        success: function(data,e){
                           $.fn.yiiGridView.update("comment-grid");
                        }
                      });                   
                    });
                 }
                 var attrid = "";
                 function EditFadein(cmid,parentid){
                    console.log("function EditFadein");
                    var content = $("#content-"+cmid).html();                     
                    attrid = $("#btn-replay-"+cmid).attr("value");                  
                    $("#form-replay-"+cmid).fadeIn("slow"); 
                    $("#textarea-"+cmid).val(content); 
                    $("#form-action-"+cmid).attr("action","' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/message.msg/id/"+cmid);
                    $("#btn-replay-"+cmid).text("Update");
                    $("#btn-replay-"+cmid).attr("onclick", "EditSubmit(attrid)");    
                    $("#action-msg-"+cmid).attr("value", "editmsg");    
                    $("#btn-replay-"+cmid).attr("id","btn-edit-"+cmid);                     
                    $("#texthidden-comment-replay-"+cmid).attr("value",parentid);
                 }
                 
                 function ReplayFadein(cmid){
                    console.log("function ReplayFadein");
                    $("#textarea-"+cmid).val(" ");
                    $("#form-replay-"+cmid).fadeIn("slow"); 
                    $("#form-action-"+cmid).attr("action","' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/message.msg' . '");
                    $("#btn-edit-"+cmid).attr("id","btn-replay-"+cmid);                        
                    attrid = $("#btn-replay-"+cmid).attr("value");
                    $("#btn-replay-"+cmid).attr("onclick", "ReplaySubmit(attrid)");
                    $("#btn-replay-"+cmid).text("Replay"); 
                    $("#action-msg-"+cmid).attr("value", "replaymsg"); 
                    $("#btn-replay-"+cmid).attr("id","btn-replay-"+cmid);
                    $("#texthidden-comment-replay-"+cmid).attr("value",cmid); 
                   
                 }
                 
                 function CencelBooton(cmid){
                     console.log("function CencelBooton");
                     $("#form-replay-"+cmid).fadeOut("slow"); 
                     $("#textarea-"+cmid).text(" ");
                     $("#btn-replay-"+cmid).attr("id","btn-edit-"+cmid); 
                     $("#btn-edit-"+cmid).attr("id","btn-replay-"+cmid); 
                     $("#textarea-"+cmid).val(" ");
                 }
               
                 function ReplaySubmit(cmid){
                    console.log("function ReplaySubmit");
                    var url = $("#form-action-"+cmid).attr("action");
                     $(".loading-"+cmid).show();
                    $.ajax({
                        type: "POST",
                        url: url,
                        "dataType":"json",
                        data: $("#form-action-"+cmid).serialize(),
                        success: function(data,e){                
                            $(".loading-"+cmid).hide();
                           $("#parent-replay-"+cmid).append(data.html).fadeIn("slow");                       
                           $.fn.yiiGridView.update("comment-grid");
                        }
                    }); 
                 }
                 
                 function EditSubmit(cmid){
                    var content = $("#textarea-"+cmid).val();
                    $(".loading-"+cmid).show();
                    var url = $("#form-action-"+cmid).attr("action");
                    $.ajax({
                      type: "POST",
                      url: url,
                      data: $("#form-action-"+cmid).serialize(),
                      success: function(data,e){ 
                         $("#content-"+cmid).text(content).fadeIn("slow"); 
                         $.fn.yiiGridView.update("comment-grid");
                         $(".loading-"+cmid).hide();
                      }
                    }); 
                 }
                 
                 function Approve(cmid){
                    $("#pending-"+cmid).fadeOut(1000);
                    $("#approve-message-"+cmid).fadeOut(1000);
                    $.ajax({
                        type: "POST",
                        "dataType":"json",
                        url: "' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/message.msg/id/" + cmid,
                        data:{id:cmid,action:"msgapprove"},
                        success: function(data,e){
                           if(data.sucsess == true){
                                var conmsg = $("#con-newMessage").text();
                                var total = conmsg - 1;
                                $("#con-newMessage").text(total);
                                if(total === 0){
                                    $("#img-red").attr("class","img-white-comments");
                                    $("#con-newMessage").remove();
                                }
                                $.fn.yiiGridView.update("comment-grid");
                           }else{
                                $.msgbox("<h4 style=\"margin-top:20px;\">Reload Your Page?</h4>", {
                                    type: "error",
                                    buttons : [
                                      {type: "submit", value: "Reload"},                                    
                                    ]
                                  }, function(result) {
                                     if(result === "Reload"){
                                        window.location.reload();
                                     }
                                });
                           }
                        }
                    });
                 }
                ', CClientScript::POS_END);
    }

    protected function generetJSnotification() {
        Yii::app()->clientScript->registerScript('script-c', '$("body").on("click","#pop-setting",function(){  if($("#pop-setting-show").is(":hidden")){$("#pop-setting-show").show();}else{$("#pop-setting-show").hide();} });', CClientScript::POS_READY);
        Yii::app()->clientScript->registerScript('script-s', '$("body").on("click","#pop-users",function(){  if($("#pop-users-show").is(":hidden")){ $(".notification-loadings").show(); $("#pop-users-show").show(); }else{ $("#pop-users-show").hide();} });', CClientScript::POS_READY);
        Yii::app()->clientScript->registerScript('script-comments-not', ' 
            $("textarea").autosize();  
            $("body").on("click","#pop-comments",function(){                       
            if($("#pop-comments-show").is(":hidden")){
                    $("#pop-comments-show").show();
                    $(".notification-loadings").show(); 
                    jQuery.ajax({
                        "type":"POST",
                        "dataType":"json",
                        data:{action:"allmsg"},
                        "url":"' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/message.msg",
                        "success":function(cm, e){   
                            var leng = cm.parent.length;                                                       
                            $("#con-newMessage").text(cm.count);
                            $(".notification-loadings").hide();                                      
                            $(".popover-content").slimScroll({
                                height: "450px", 
                                railVisible: true,                                
                                wheelStep: 10
                            }).bind("slimscroll", function(e, pos){                              
                                if(pos === "bottom"){                                   
                                   $("#more-loadings").show();
                                   $.ajax({
                                        type: "POST",
                                        "dataType":"json",
                                        url: "' . Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/index.php/dashboard/comment/message.msg",
                                        data: {offset:leng,action:"moremsg"},
                                        success: function(data,e){ 
                                           var con = data.more.length;  
                                           maxcon = con;  
                                           $(".popover-content").slimScroll({ scroll: "500px;" });
                                           if(con === 0){
                                                $("#more-loadings").remove();
                                           }else{
                                                for (i=0; i<con; i++) {
                                                    $("#more-msg").append(data.more[i].moremsg).fadeIn();
                                                }
                                                for (i=0; i<data.morechild.length; i++) {
                                                    $("#parent-"+data.morechild[i].id).append(data.morechild[i].child).fadeIn();
                                                }
                                                $("#more-loadings").hide();
                                                leng = leng + 5;
                                                
                                           }                                     
                                        }
                                   }); 
                                }else{
                                   $("#more-loadings").hide();
                                }
                            });                                       
                            if(cm.parent.length == 0 ){
                                $("#user-comments").append("<b>Not Font ...</b>").fadeIn();
                            }else{
                                for (i=0; i<cm.parent.length; i++) {
                                    $("#user-comments").append(cm.parent[i].parent).fadeIn();
                                }
                                for (i=0; i<cm.child.length; i++) {
                                    $("#parent-"+cm.child[i].id).append(cm.child[i].child).fadeIn();
                                }
                            }
                        }});                                   
                }else{
                    $("#user-comments").empty();
                    $("#more-msg").empty();
                    $("#pop-comments-show").hide();                                
                } });', CClientScript::POS_READY);
    }

}

