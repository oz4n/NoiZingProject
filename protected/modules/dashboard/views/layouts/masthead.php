<div id="masthead">

    <div class="container">
        <?php
        if (isset($this->breadcrumbs)):
//            $this->widget('zii.widgets.CBreadcrumbs', $this->breadcrumbs);
             $this->widget('bootstrap.widgets.TbBreadcrumbsnew', $this->breadcrumbs); 
        endif
        ?>
    </div> 

</div> 