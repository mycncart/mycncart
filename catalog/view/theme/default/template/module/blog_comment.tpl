<h3><?php echo $heading_title; ?></h3>
<div class="row">
  <?php foreach ($comments as $comment) { ?>
  <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      <a href="<?php echo $comment['href']; ?>"><img src="<?php echo $comment['thumb']; ?>" alt="<?php echo $comment['name']; ?>" title="<?php echo $comment['name']; ?>" class="img-responsive" /></a>
      
        <div class="pull-right"><h4><?php echo $comment['author']; ?></h4></div>
        <div class="pull-right"><?php echo $comment['text']; ?></div>
      
    </div>
  </div>
  <?php } ?>
</div>
