<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IReadMore
 *
 * @author melengo
 */
class IReadMore extends CWidget {

    public $limit = 40;
    public $linkUrl;
    public $layouts;
    public $linkOptions = array();
    public $textLabel = 'Read More...';
    public $content;

    public function run() {
        if ($this->layouts == 1) {
            $this->explodeOneContent();
        } elseif ($this->layouts == 2) {
            $this->explodeTwoContent();
        }
        return parent::run();
    }

    private function explodeOneContent() {
        if (preg_match('/<!--more(.*?)?-->/', $this->content, $matches)) {
            $content = explode($matches[0], $this->content, 2);
            echo $content[0] . '<div class="more-post pull-right">'.CHtml::link($this->textLabel, $this->linkUrl, $this->linkOptions).'</div>';
        } else {
            echo $this->content;
        }
    }

    private function explodeTwoContent() {
        $content = strip_tags($this->content);
        $ex = explode(" ", $content);
        $con = count($ex);
        $data = array();
        if ($con > $this->limit) {
            for ($i = 0; $i < $this->limit; $i++) {
                $data[] = $ex[$i];
            }
            echo '<p style="text-align: justify;">'.implode(" ", $data) . '</p>' . CHtml::link($this->textLabel, $this->linkUrl, $this->linkOptions);
        }else{
            echo '<p style="text-align: justify;">'.$content . '</p>' . CHtml::link($this->textLabel, $this->linkUrl, $this->linkOptions);
        }
    }

}