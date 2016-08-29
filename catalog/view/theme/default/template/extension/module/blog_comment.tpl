<h3><?php echo $heading_title; ?></h3>
<?php if($comments) { ?>
<div class="list-group">
	<?php foreach ($comments as $comment) { ?>
  		<li class="list-group-item">
        <i class="fa fa-commenting"></i> <?php echo $comment['text']; ?>
        <div class="text-right"><strong>----<?php echo $comment['author']; ?></strong></div>
        </li>
    <?php } ?>
</div>
<?php } ?>