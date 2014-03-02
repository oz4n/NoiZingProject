<?php

/**
 * TbCrumb class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */
Yii::import('zii.widgets.CBreadcrumbs');

/**
 * Bootstrap breadcrumb widget.
 * @see http://twitter.github.com/bootstrap/components.html#breadcrumbs
 */
class TbBreadcrumbsnew extends CBreadcrumbs {

    /**
     * @var string the separator between links in the breadcrumbs. Defaults to '/'.
     */
    public $separator = '/';

    /**
     * Initializes the widget.
     */
    public function init() {
        if (isset($this->htmlOptions['id']))
            $this->htmlOptions['id'] .= 'breadcrumbs';
        else
            $this->htmlOptions['id'] = 'breadcrumbs';
        
        if (isset($this->htmlOptions['class']))            
            $this->htmlOptions['class'] = '';
    }

    /**
     * Renders the content of the widget.
     * @throws CException
     */
    public function run() {
        // Hide empty breadcrumbs.
        if (empty($this->links))
            return;

        $links = array();

        if (!isset($this->homeLink)) {
            $content = '<span class="breadcrumb-label">'.CHtml::link(Yii::t('zii', '<i class="icon-home"></i> Home'), Yii::app()->homeUrl).'</span>';
            $links[] = $this->renderItem($content);
        } else if ($this->homeLink !== false)
            $links[] = $this->renderItem('<span class="breadcrumb-label"><i class="icon-home"></i> '.$this->homeLink.'</span>');

        foreach ($this->links as $label => $url) {
            if (is_string($label) || is_array($url)) {
                $content = '<span class="breadcrumb-label">'.CHtml::link($this->encodeLabel ? CHtml::encode($label) : $label, $url).'</span>';
                $links[] = $this->renderItem($content);
            }
            else
                $links[] = $this->renderItem($this->encodeLabel ? '<span class="breadcrumb-label">'.CHtml::encode($url).'</span>' : '<span class="breadcrumb-label">'.$url.'</span>', true);
        }

        echo CHtml::tag('div', $this->htmlOptions, implode('', $links));
    }

    /**
     * Renders a single breadcrumb item.
     * @param string $content the content.
     * @param boolean $active whether the item is active.
     * @return string the markup.
     */
    protected function renderItem($content, $active = false) {
        $separator = !$active ? '<span class="divider">' . $this->separator . '</span>' : '';

        ob_start();
        echo CHtml::openTag('div', $active ? array('class' => 'breadcrumb-button') : array('class'=>'breadcrumb-button'));
//        echo $content . $separator;
        echo $content . '<span class="breadcrumb-arrow"><span></span></span>';
        echo '</div>';
        return ob_get_clean();
    }

}
