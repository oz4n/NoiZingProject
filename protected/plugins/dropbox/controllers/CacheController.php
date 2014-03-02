<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CacheController
 *
 * @author melengo
 */
class CacheController extends Controller {

    public function actionIndex() {
        
    }

    private function getImgMachByName($content, $img_name, $imgdefault = null, $mach = array()) {
        preg_match('/< *img[^>]*src *= *["\']?([^"\']*' . $img_name . '*[^"\']+)/si', $content, $mach);
        if ($mach != null) {
            return $mach[1];
        } else {
            return $imgdefault;
        }
    }
    
    

    private function getUrlByCurl($url) {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $url);
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($curlSession);
        return $data;
        curl_close($curlSession);
    }

    private function resize($path, $name, $thumbnails) {
        Yii::app()->phpThumb->T1024X768($path . $name, $thumbnails . '1024X768/' . $name);
        Yii::app()->phpThumb->T232X155($path . $name, $thumbnails . '232X155/' . $name);
        Yii::app()->phpThumb->T255X255($path . $name, $thumbnails . '255X255/' . $name);
        Yii::app()->phpThumb->T60X60($path . $name, $thumbnails . '60X60/' . $name);
        Yii::app()->phpThumb->T800X534($path . $name, $thumbnails . '800X534/' . $name);
        Yii::app()->phpThumb->T800X600($path . $name, $thumbnails . '800X600/' . $name);
        Yii::app()->phpThumb->T100X74($path . $name, $thumbnails . '100X74/' . $name);
        Yii::app()->phpThumb->orginal($path . $name, $thumbnails . 'orginal/' . $name);
        Yii::app()->phpThumb->orginal100($path . $name, $thumbnails . 'orginal_100/' . $name);
    }

    private function dropbox($path, $name, $thumbnails) {
        Yii::app()->IDropboxClient->upload('/images/orginal/' . $name, $path . $name);
        Yii::app()->IDropboxClient->upload('/images/thumbnail/1024X768/' . $name, $thumbnails . '1024X768/' . $name);
        Yii::app()->IDropboxClient->upload('/images/thumbnail/232X155/' . $name, $thumbnails . '232X155/' . $name);
        Yii::app()->IDropboxClient->upload('/images/thumbnail/255X255/' . $name, $thumbnails . '255X255/' . $name);
        Yii::app()->IDropboxClient->upload('/images/thumbnail/60X60/' . $name, $thumbnails . '60X60/' . $name);
        Yii::app()->IDropboxClient->upload('/images/thumbnail/800X534/' . $name, $thumbnails . '800X534/' . $name);
        Yii::app()->IDropboxClient->upload('/images/thumbnail/800X600/' . $name, $thumbnails . '800X600/' . $name);
        Yii::app()->IDropboxClient->upload('/images/thumbnail/100X74/' . $name, $thumbnails . '100X74/' . $name);
        Yii::app()->IDropboxClient->upload('/images/thumbnail/orginal/' . $name, $thumbnails . 'orginal/' . $name);
        Yii::app()->IDropboxClient->upload('/images/thumbnail/orginal_100/' . $name, $thumbnails . 'orginal_100/' . $name);
    }

    private function getImgJson($path, $name, $thumbnails) {
        $data = array(
            'orginal' => array('path' => $path . $name, 'imgurl' => Yii::app()->baseUrl . '/cache/images/orginal/' . $name),
            'T1024X768' => array('path' => $thumbnails . '1024X768/' . $name, 'imgurl' => Yii::app()->baseUrl . '/cache/images/thumbnails/1024X768/' . $name),
            'T232X155' => array('path' => $thumbnails . '232X155/' . $name, 'imgurl' => Yii::app()->baseUrl . '/cache/images/thumbnails/232X155/' . $name),
            'T255X255' => array('path' => $thumbnails . '255X255/' . $name, 'imgurl' => Yii::app()->baseUrl . '/cache/images/thumbnails/255X255/' . $name),
            'T60X60' => array('path' => $thumbnails . '60X60/' . $name, 'imgurl' => Yii::app()->baseUrl . '/cache/images/thumbnails/60X60/' . $name),
            'T800X534' => array('path' => $thumbnails . '800X534/' . $name, 'imgurl' => Yii::app()->baseUrl . '/cache/images/thumbnails/800X534/' . $name),
            'T800X600' => array('path' => $thumbnails . '800X600/' . $name, 'imgurl' => Yii::app()->baseUrl . '/cache/images/thumbnails/800X600/' . $name),
            'T100X74' => array('path' => $thumbnails . '100X74/' . $name, 'imgurl' => Yii::app()->baseUrl . '/cache/images/thumbnails/100X74/' . $name),
            'torginal' => array('path' => $thumbnails . 'orginal/' . $name, 'imgurl' => Yii::app()->baseUrl . '/cache/images/thumbnails/orginal/' . $name),
            'torginal_100' => array('path' => $thumbnails . 'orginal_100/' . $name, 'imgurl' => Yii::app()->baseUrl . '/cache/images/thumbnails/orginal_100/' . $name),
        );
        return CJSON::encode($data);
    }
    
    public function actionDeleteImage() {
        $path = Yii::app()->params['dropbox_cache']['images'];
        $thumbnails = Yii::app()->params['dropbox_cache']['thumbnails'];
        if (isset($_POST["id"])) {
            $dr = $this->loadID($_POST["id"]);
            $dr->delete();
            unlink($path . $dr->name);
            unlink($thumbnails . '1024X768' . DS . $dr->name);
            unlink($thumbnails . '232X155' . DS . $dr->name);
            unlink($thumbnails . '255X255' . DS . $dr->name);
            unlink($thumbnails . '60X60' . DS . $dr->name);
            unlink($thumbnails . '800X534' . DS . $dr->name);
            unlink($thumbnails . '800X600' . DS . $dr->name);
            unlink($thumbnails . '100X74' . DS . $dr->name);
            unlink($thumbnails . 'orginal' . DS . $dr->name);
            unlink($thumbnails . 'orginal_100' . DS . $dr->name);

            echo json_encode(array("data"=>true));
        }
    }

    public function actionUploadImage() {
        $path = Yii::app()->params['dropbox_cache']['images'];
        $thumbnails = Yii::app()->params['dropbox_cache']['thumbnails'];
        $url = Yii::app()->baseUrl . '/cache/images/thumbnails/orginal/';
        $tmp_name = $_FILES['file']['tmp_name'];
        $uid = mt_rand(100, 99999999999);        
        $type = explode('.', $_FILES['file']['name']);
       
        $name = $uid .'.'. $type[count($type) - 1];
        move_uploaded_file($tmp_name, $path . $name);
        $tl = $this->getImgJson($path, $name, $thumbnails);
        $dropbox = new DropboxFiles();
        $dropbox->files_uid = $uid;
        $dropbox->name = $name;
        $dropbox->status = 'L';
        $dropbox->path = $path . $name;
        $dropbox->mime_type = $_FILES['file']['type'];
        $dropbox->url_share = $url . $name;
        $dropbox->url_thumbnail_share = $tl;
        $dropbox->dropbox_account_id = 1;
        $dropbox->save();
        $this->resize($path, $name, $thumbnails);
        echo json_encode(array(array('filelink' => $url . $name, 'uid' => $uid,'filename'=>$name)));
    }
    
    public function actionUploadFile() {
        $path = Yii::app()->params['dropbox_cache']['documents'];
        $url = Yii::app()->baseUrl . '/cache/documents/';
        $tmp_name = $_FILES['file']['tmp_name'];
        $uid = mt_rand(100, 99999999999);        
        $name = $uid . '-' . $_FILES['file']['name'];
        move_uploaded_file($tmp_name, $path . $name);
        $dropbox = new DropboxFiles();
        $dropbox->files_uid = $uid;
        $dropbox->name = $name;
        $dropbox->status = 'L';
        $dropbox->type = 'document';
        $dropbox->path = $path . $name;
        $dropbox->mime_type = $_FILES['file']['type'];
        $dropbox->url_share = $url . $name;
        $dropbox->dropbox_account_id = 1;
        $dropbox->save();
        echo json_encode(array(array('filelink' => $url . $name, 'uid' => $uid, 'filename' => $name)));
    }
    
    
    
    

    public function actionGetRedactorImages() {
        $data = array();
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';   
        $criteria->condition = 'type="img"';
        $criteria->limit = 28;
        foreach (DropboxFiles::model()->findAll($criteria) as $v) {
            $thumb = json_decode($v->url_thumbnail_share);
            $data[] = array('filelink' => $thumb->torginal->imgurl, 'thumb' => $thumb->T100X74->imgurl, 'title' => $v->name, 'image' => $thumb->torginal->imgurl, 'folder' => 'none','imguid'=>$v->files_uid);
        }
        echo json_encode($data);
    }
    
     public function actionGetModalImages() {
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';   
        $criteria->condition = 'type="img"';
        $criteria->limit = 30;
        $criteria->offset = $_POST['offset'];
        $file = DropboxFiles::model()->findAll($criteria);
        $data = array();
        foreach ($file as $v){
            $img = json_decode($v->url_thumbnail_share);
            $data[] = array('name'=>$v->name,'url'=>$img->T100X74->imgurl);
        }
        echo CJSON::encode($data);
    }
    
    private function loadID($id){
        $dr = DropboxFiles::model()->findByPk($id);
        if ($dr === null)
            throw new CHttpException(404, 'The requested pages does not exist.');
        return $dr;
    }

}

