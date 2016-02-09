<h3><?php echo $heading_title; ?></h3>
<div class="row">
  <?php foreach ($comments as $comment) { ?>
  <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      
        <div class="text-left"><?php echo $comment['text']; ?></div>
        <div class="text-left"><small><?php echo $comment['author']; ?></small></div>
      
    </div>
  </div>
  <?php } ?>
</div>
