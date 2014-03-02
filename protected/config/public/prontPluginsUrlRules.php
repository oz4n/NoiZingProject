<?php

return array(    
    'page/guestbook' => 'guestbook/site/index',
    'page/guestbook/captcha/reload/<refresh:.*?>' => 'guestbook/site/captcha',
    'page/contacts' => 'contact/site/index',
    'page/contacts/captcha/reload/<refresh:.*?>' => 'contact/site/captcha',
    
);
