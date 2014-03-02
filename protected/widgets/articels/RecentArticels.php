<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecentArticels
 *
 * @author melengo
 */
class RecentArticels extends IWidgets {
    
    public function getRecentArticels(){
        return Post::model()->findRecentArticels(10);
    }
    
    protected function renderContent() {
        $title = 'Recent Articels';
        $this->render('recentArticels',array('title'=>  $title));
    }
}
