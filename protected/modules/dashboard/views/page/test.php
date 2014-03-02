
<div class="container">
    <div class="row">
        <div class="span6">
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'uploadform',
                'action'=>'up',
//                'htmlOptions' => array('enctype' => 'multipart/form-data'),
                'enableAjaxValidation' => true,
            ));
             $this->widget('ext.ajaxform.JAjaxForm', array(
                'formId' => 'uploadform',
                'options' => array(
                    'dataType' => 'json',
                    'beforeSubmit' => 'js:function(formData,$form,options) {  /*$("#p-save").button("loading");*/  }',
                    'success' => 'js:function(responseText,statusText) { console.log(responseText); $("#p-save").button("reset"); $("#d-save").button("reset"); alert(responseText.msg); }',
                ),
            ));
            ?>
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 128px; height: 128px;">
                    <img src="http://www.placehold.it/128x128/EFEFEF/AAAAAA" />
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 128px; height: 128px;"></div>
                <span class="btn btn-file">
                    <span class="fileupload-new">Select image</span>
                    <span class="fileupload-exists">Change</span>
                    <input type="file" name='file'/>
                </span>
                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
           
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'icon' => 'file',
                'type' => 'primary',
                'label' => 'Save Changes',
                'loadingText' => 'Loading...',
                'htmlOptions' => array('id' => 'p-save'),
            ));
            ?>
            <?php $this->endWidget(); ?> 
        </div>
    </div>
</div>
