<?php
/* @var $contact Contact */
/* @var $this ProntController */
/* @var $guestbook GuestBook */

$this->breadcrumbs = array(
    'separator' => '<i class="icon-angle-right"></i>',
    'htmlOptions' => array('class' => 'pull-right'),
    'homeLink' => CHtml::link('Home', Yii::app()->createUrl('/site/default/index')),
    'links' => array(
        'Buku Tamu'
        ));
$this->pageTitle = "Buku Tamu";
$this->subPageTitle = "Buku Tamu";
?>
<div class="row-fluid" style="margin-top: 10px;">
    <div class="span9">       

        <?php if (Yii::app()->user->hasFlash('guestbook')): ?>
            <?php
            $this->widget('bootstrap.widgets.TbListView', array(
                'dataProvider' => $guestbook->search(),
                'template' => "<ul>{items}</ul>\n{pager}",
                'itemView' => '_view',
            ));
            ?>  
            <div class="alert alert-success">
                <?php echo Yii::app()->user->getFlash('guestbook'); ?>
            </div>
        <?php else: ?>
            <?php
            $this->widget('bootstrap.widgets.TbListView', array(
                'dataProvider' => $guestbook->search(),
                'pagerCssClass' => 'pagination pull-right',
                'template' => "<ul>{items}</ul>{pager}",
                'itemView' => '_view',
            ));
            ?>        
        <div class="alert alert-info " style="margin-top: 80px;">
                Silahkan pergunakan daftar alamat yang tertera dan form isian dibawah ini untuk memberikan saran dan masukan atau apabila Anda membutuhkan informasi lainnya.
            </div>
            <?php
            $this->renderPartial('_form', array('guestbook' => $guestbook));
            ?>
        <?php endif; ?>
    </div>
    <div class="span3">

    </div>
</div>

