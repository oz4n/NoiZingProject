<?php

/**
 * JAjaxForm class file.
 *
 * @author jerry2801 <jerry2801@gmail.com>
 * @version alpha 4 (2011-3-11) use jQuery Form Plugin V2.65 require jQuery v1.3.2 or later
 * @version alpha 3 (2010-6-17 13:13) required jQuery Form Plugin V2.43
 * @version alpha 2 (2010-4-14 15:08) required jQuery Form Plugin V2.36
 *
 * A typical usage of JAjaxForm is as follows:
 * <pre>
 * $this->widget('ext.ajaxform.JAjaxForm',array(
 *     'formId'=>'myForm1',
 *     'options'=>array(
 *         'dataType'=>'json',
 *         'beforeSubmit'=>'js:function(formData,$form,options) { // return false to cancel submit }',
 *         'success'=>'js:function(responseText,statusText) { alert(responseText); }',
 *     ),
 * ));
 * </pre>
 */
class JAjaxForm extends CWidget {

    public $baseUrl;
    public $formId;
    public $options = array();

    public function init() {
        $this->baseUrl = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'source');
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($this->baseUrl . '/jquery.form.js');
        $options = CJavaScript::encode($this->options);
        $cs->registerScript('ajaxform-' . $this->getId(), '$("#' . $this->formId . '").ajaxForm(' . $options . ');');
    }

}