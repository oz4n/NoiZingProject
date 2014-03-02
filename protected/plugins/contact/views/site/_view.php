<?php /* @var $data Contact */ ?>
<div class="headline"><h3><?php echo $data->name; ?></h3></div>
<ul class="unstyled who margin-bottom-20">
    <li><a href="javascript:;"><i class="icon-home"></i><?php echo $data->location; ?></a></li>
    <li><a href="javascript:;"><i class="icon-exchange"></i><?php echo $data->address; ?></a></li>            
    <li><a href="javascript:;"><i class="icon-phone-sign"></i><?php echo $data->phone; ?></a></li>
    <li><a href="javascript:;"><i class="icon-fighter-jet"></i><?php echo $data->fax; ?></a></li>
    <li><a href="mailto:<?php echo $data->email; ?>"><i class="icon-envelope-alt"></i><?php echo $data->email; ?></a></li>
    <li><a href="<?php echo $data->website; ?>" target="_blank"><i class="icon-globe"></i><?php echo $data->website; ?></a></li>
</ul>
