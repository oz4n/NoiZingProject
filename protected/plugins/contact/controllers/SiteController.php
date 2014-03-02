<?php

class SiteController extends ClientController {

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact pages
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'foreColor' => 0x000000,
            ),
            // pages action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/pages&view=FileName
            'pages' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionIndex() {
        $this->layout = 'contact.views.layouts.site.main';
        $form_contact = new GuestBook();
        $contact = new Contact();
        if (isset($_POST['GuestBook'])) {            
            $form_contact->attributes = $_POST['GuestBook'];
            $form_contact->create_time = time();
            if ($form_contact->save()) {                
                $headers = "From: {$form_contact->email}\r\nReply-To: {$form_contact->email}";
                mail(Yii::app()->params['adminEmail'], $form_contact->subject, "Website : ".$form_contact->web_url.'<br>'.$form_contact->content, $headers);              
                Yii::app()->user->setFlash('contact', '<strong>Pesan Anda berhasil terkirim!</strong> Terima kasih telah menghubungi kami. Kami akan merespon anda sesegera mungkin.');
                $this->refresh();
            }
        }
        $this->render('index', array(           
            'form_contact' => $form_contact,
            'contact' => $contact
                )
        );
    }

}