<?php
/* @var $this MenuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'homeLink' => CHtml::link('Home', array('/dashboard/default/index')),
    'links' => array(
        'More' => array('/dashboard/more/index'),
        'Appearance' => array('/dashboard/appearance/index'),
        'Menus',
    )
);
?>

<div id="content">
    <div class="container">
        <div class="box">
            <form class="form-horizontal" style="padding-top: 20px;">
                <div class="control-group">
                    <label for="menu" class="control-label">Select a menu to edit :</label>
                    <div class="controls">
                        <select name="menu" id="menu">
                            <option value="84" selected="selected">
                                Menu 1 (Primary Menu)					
                            </option>
                            <option value="86">
                                menu 2 (Social Menu)					
                            </option>
                        </select>
                        <input type="submit" class="btn" value="Select">

                        or <a href="#">create a new menu</a>.
                    </div>
                </div>

            </form>
        </div> 
    </div>
    <div class="container">
        <div class="row-fluid"> 
            <div class="span4">
                <div class="accordion box" id="basic-accordion">
                   
                    <div class="accordion-group">
                        <div class="accordion-heading box-header">
                            
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#basic-accordion" href="#accordion-pagecat">
                                <i class="icon-list"></i> Pages
                            </a>
                        </div>
                        <div id="accordion-pagecat" class="accordion-body in collapse">
                            <div class="accordion-inner">
                                <?php
                                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                    'id' => 'pages-form',
                                    'action' => array('/dashboard/menu/addpagetomenu'),
                                    'htmlOptions' => array(),
                                    'enableAjaxValidation' => true,
                                ));
                                $this->widget('ext.ajaxform.JAjaxForm', array(
                                    'formId' => 'pages-form',
                                    'options' => array(
                                        'cache' => false,
                                        'dataType' => 'json',
                                        'beforeSubmit' => 'js:function(formData,$form,options) {  $.each($("#tree-pages-id").dynatree("getSelectedNodes"), function() { formData.push({"name":"NavMenu[termTaxonomy][]","value":this.data.id}); }); $("#action-btnpage-loading").button("loading"); }',
                                        'success' => 'js:function(response) { if(response.data == false){ $("#action-btnpage-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); }else{ $("#action-btnpage-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); $.fn.yiiGridView.update("menu-grid"); } }',
                                    ),
                                ));
                                $pages = new ECategoryComponent($navmenu, 'pages');
                                $pages->id = "tree-pages-id";
                                $pages->renderTreeforNavmenu();
                                echo "<hr>";
                                $this->widget('bootstrap.widgets.TbButton', array(
                                    'buttonType' => 'submit',
                                    'icon' => 'ok',
                                    'type' => 'primary',
                                    'label' => 'Add To Menu',
                                    'loadingText' => 'Loading...',
                                    'htmlOptions' => array('id' => 'action-btnpage-loading', 'class' => 'btn'),
                                ));
                                $this->endWidget();
                                ?>     
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading box-header">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#basic-accordion" href="#accordion-cat">
                                <i class="icon-list-alt"></i> Categories
                            </a>
                        </div>
                        <div id="accordion-cat" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <?php
                                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                    'id' => 'cat-form',
                                    'action' => array('/dashboard/menu/addcattomenu'),
                                    'htmlOptions' => array(),
                                    'enableAjaxValidation' => true,
                                ));
                                $this->widget('ext.ajaxform.JAjaxForm', array(
                                    'formId' => 'cat-form',
                                    'options' => array(
                                        'cache' => false,
                                        'dataType' => 'json',
                                        'beforeSubmit' => 'js:function(formData,$form,options) {   $.each($("#tree-category-id").dynatree("getSelectedNodes"), function() { formData.push({"name":"NavMenu[termTaxonomy][]","value":this.data.id}); }); $("#action-btncat-loading").button("loading"); }',
                                        'success' => 'js:function(response) { if(response.data == false){ $("#action-btncat-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); }else{ $("#action-btncat-loading").button("reset"); $.msgGrowl({type: response.type, title: response.title, text: response.text}); $.fn.yiiGridView.update("menu-grid"); } }',
                                    ),
                                ));
                                $cat = new ECategoryComponent($navmenu, 'category');
                                $cat->id = "tree-category-id";
                                $cat->renderTreeforNavmenu();
                                echo "<hr>";
                                $this->widget('bootstrap.widgets.TbButton', array(
                                    'buttonType' => 'submit',
                                    'icon' => 'ok',
                                    'type' => 'primary',
                                    'label' => 'Add To Menu',
                                    'loadingText' => 'Loading...',
                                    'htmlOptions' => array('id' => 'action-btncat-loading', 'class' => ''),
                                ));
                                $this->endWidget();
                                ?> 
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading box-header">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#basic-accordion" href="#accordion-link">
                                <i class="icon-link"></i> Link
                            </a>
                        </div>
                        <div id="accordion-link" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>Menu Link</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading box-header">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#basic-accordion" href="#accordion-plugin">
                                <i class="icon-list"></i> Plugin
                            </a>
                        </div>
                        <div id="accordion-plugin" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>Menu Plugin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span8">           
                <div class="box">
                    <div class="box-header">
                        <span class="title">Menu Name</span>
                    </div>
                    <div id="cat-content-scroll" class="box-content scrollable" style="padding: 10px;">
                        <h4>Menu Structure</h4>
                        <p>
                            Drag each item into the order you prefer. Click the arrow on the right of the item to reveal additional configuration options.
                        </p>
                        <div class="dd" id="nestable" style="width: 60%">
                            <?php $navmenu->dataTreeStore(); ?>
                        </div>  
                    </div>
                    <div class="box-footer" style="padding: 5px;">
                        <a class="pull-right" href="javascrift:;" style="padding-right: 6px;"><i class="icon-ok"></i>Appley</a>
                    </div>
                </div>            
            </div>         
        </div>
    </div>
</div>
