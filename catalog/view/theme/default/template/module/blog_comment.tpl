<h3><?php echo $heading_title; ?></h3>
<div class="sidebar">
    <ul class="nav nav-tabs nav-stacked">
    	
        <?php foreach ($comments as $comment) { ?>
        <li>
            <i class="fa fa-commenting"></i> <?php echo $comment['text']; ?>
            <div class="text-right"><strong>----<?php echo $comment['author']; ?></strong></div>
        </li>
        <?php } ?>

    </ul>
</div>