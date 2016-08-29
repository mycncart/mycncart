<h3><?php echo $heading_title; ?></h3>
<?php if($presses) { ?>
<div class="list-group">
	<?php foreach ($presses as $press) { ?>
  <a href="<?php echo $press['href']; ?>" class="list-group-item"><?php echo $press['name']; ?></a>
    <?php } ?>
</div>
<?php } ?>