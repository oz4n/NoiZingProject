<?php
/* @var $this SearchesController */
/* @var $query Zend_Search_Lucene_Search_Query */

$this->pageTitle = $term . ' - Search results';
$this->subPageTitle = "Search";
$this->meta_keywords = $term;
$this->breadcrumbs = array(
    'separator' => '<i class="icon-angle-right"></i>',
    'htmlOptions' => array('class' => 'pull-right'),
    'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
    'links' => array($term)
);
?>



<div class="row-fluid" style="margin-top: 5px;">
    <div class="span8">
        <h4>Search Results for: "<?php echo CHtml::encode($term); ?>"</h4>
        <?php if (!empty($dataProvider->data)): ?>
            <?php
            foreach ($dataProvider->data as $result):
                $this->renderPartial("_view", array("query" => $query, "data" => $result, "layouts" => 1));
            endforeach;
            ?>
            <div class="pagination">
                <?php
                $this->widget('bootstrap.widgets.TbPager', array(
                    'pages' => $page,
                ));
                ?>
            </div>
        <?php else: ?>
            <p class="error">No results matched your search terms.</p>
        <?php endif; ?>
    </div>
    <div class="span4"></div>
</div>