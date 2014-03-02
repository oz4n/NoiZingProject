<?php


class ERedactorProntWidget extends CWidget {
   
    const PACKAGE_ID = 'redactor-widget';

  
    protected $assetsPath;

    protected $assetsUrl;
  
    public $options = array();
    public $imgLink;
    public $imgData;
    public $fileLink;
    public $fileData;
    public $autosaveLink;
    public $interval;
    public $content;


    public $selector;

     public function init() {
        parent::init();
        if ($this->assetsPath === null) {
            $this->assetsPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
        }
        if ($this->assetsUrl === null) {
            $this->assetsUrl = Yii::app()->assetManager->publish($this->assetsPath);
        }
        $this->registerClientScript();
    }

    /**
     * Run widget.
     */
    public function run() {
        echo "<div id='$this->id'>";
        echo $this->content;
        echo "</div>";
    }

    /**
     * Register CSS and scripts.
     */
    protected function registerClientScript() {
        $cs = Yii::app()->clientScript;
        if (!isset($cs->packages[self::PACKAGE_ID])) {
            $cs->packages[self::PACKAGE_ID] = array(
                'basePath' => $this->assetsPath,
                'baseUrl' => $this->assetsUrl,
                'js' => array(
                    'lib/jquery-1.8.2.min.js',
                    'js/redactor.js',
                    'js/plugins/fullscreen.js',                    
                    'js/plugins/redmore.js',   
                 
//                    'js/lang/id.js',                    
                ),
                'css' => array(
                    'css/rd.css',
//                    'css/icons.css',
                ),
                'depends' => array(
                    'jquery',
                ),
            );
        }
        $cs->registerPackage(self::PACKAGE_ID);

//        $cs->registerScript(
//                __CLASS__ . '#' . $this->id, '$(' . CJavaScript::encode($this->selector) . ').redactor({ 
//                    focus: true,
//                    fixed: true,                    
//                    plugins: ["fullscreen","redmore"], 
//                    autosave:"' . $this->autosaveLink . '",
//                    interval: ' . $this->interval . ',                   
//                    imageUpload:"' . $this->imgLink . '",
//                        fileUpload:"' . $this->fileLink . '",
//                            imageGetJson:"' . $this->imgData . '"
//                                });', CClientScript::POS_END
//        );
         $cs->registerScript(
                __CLASS__ . '#' . $this->id, "
                function ClickToEdit() {".
                    "$('#".$this->id."')."."redactor({ 
                        focus: true, 
                        fixed: true, 
                        plugins: ['fullscreen','redmore','dropbox'],
                        imageUpload:'".$this->imgLink."',
                        fileUpload:'".$this->fileLink."',
                        imageGetJson:'".$this->imgData."'
                     });".
                "}"."
                function ClickToSave() {".
                    "var html = $('#".$this->id."')."."getCode();".
                    "$('#".$this->id."')."."destroyEditor();".
                "}", CClientScript::POS_END
        );
    }

}

