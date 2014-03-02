<?php

/**
 * This extension is a lightweight wrapper for phpthumb (http://phpthumb.gxdlabs.com/)
 * After creating a thumbnail object via Yii::app()->phpThumb->create("../images/image.jpg")
 * you can use any methods phpthumb provides (@link "https://github.com/masterexploder/PHPThumb/wiki/Basic-Usage")
 * inclusing method chaining.
 * To update the phpThumb library just put the complete phpThumb folder into "./lib"
 *
 * @license PHP Thumb is released under MIT license, so is this extension
 * @author Johannes "Haensel" Bauer <thehaensel@gmail.com>
 */
require_once(dirname(__FILE__) . '/lib/phpThumb/src/ThumbLib.inc.php');
require_once(dirname(__FILE__) . '/EThumbnail.php');

/**
 * This class creates thumbnail objects that can be used to manipulate images. Activate this component
 * by adding 
 * <p>'phpThumb'=>array('class'=>'ext.EPhpThumb.EPhpThumb')
 * <p>to your main config.
 * If you need to provide phpThumb specific options as described at 
 * <p>@link "https://github.com/masterexploder/PHPThumb/wiki/Getting-Started"
 * <p>use the "options" parameter of this component
 * <p>
 * @author Johannes "Haensel" Bauer <thehaensel@gmail.com>
 */
class EPhpThumb extends CComponent {

    public $options = array();
    private static $_phpThumbOptions;

    public function init() {
        self::$_phpThumbOptions = $this->options;
    }

    /**
     * Creates a new EThumbnail object allowing to manipulate the image file provided via $filePath
     * @param string $filePath the image file path.
     * @return PhpThumb object
     */
    public function create($filePath) {
        return new EThumbnail(EPhpThumb::thumbFactory($filePath));
    }

    /**
     * Creates a new phpThumb object.
     * @param string $filePath the image file path.
     * @return PhpThumb object
     */
    protected static function thumbFactory($filePath) {
        try {
            return PhpThumbFactory::create($filePath, self::$_phpThumbOptions);
        } catch (Exception $e) {
            throw new CException($e->getMessage(), $e->getCode());
        }
    }
    
    
    public function T1024X768($image_path,$image_save){
        $thumb = $this->create($image_path);
        $thumb->adaptiveResize(1024,768);
        $thumb->save($image_save);        
    }
    
    public function T232X155($image_path,$image_save){
        $thumb = $this->create($image_path);
        $thumb->adaptiveResize(232,155);
        $thumb->save($image_save);     
    }
    
    public function T255X255($image_path,$image_save){
        $thumb = $this->create($image_path);
        $thumb->adaptiveResize(255,255);
        $thumb->save($image_save);     
    }
    
    public function T60X60($image_path,$image_save){
        $thumb = $this->create($image_path);
        $thumb->adaptiveResize(60,60);
        $thumb->save($image_save);     
    }
    
    public function T800X534($image_path,$image_save){
        $thumb = $this->create($image_path);
        $thumb->adaptiveResize(800,534);
        $thumb->save($image_save);     
    }
    
    public function T800X600($image_path,$image_save){
        $thumb = $this->create($image_path);
        $thumb->adaptiveResize(800,600);
        $thumb->save($image_save);     
    }
    
    public function T100X74($image_path,$image_save){
        $thumb = $this->create($image_path);
        $thumb->adaptiveResize(100,74);
        $thumb->save($image_save);     
    }
    
    public function orginal($image_path,$image_save){
        $thumb = $this->create($image_path);
        $thumb->resize(768);
        $thumb->save($image_save); 
    }

    public function orginal100($image_path,$image_save){
        $thumb = $this->create($image_path);
        $thumb->resize(100);
        $thumb->save($image_save);
    }
    

}

