<h3><?php echo $heading_title; ?></h3>
<div class="row">
  <?php foreach ($blogs as $blog) { ?>
  <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
      <div class="caption">
        <h4><a href="<?php echo $blog['href']; ?>"><?php echo $blog['name']; ?></a></h4>
        <p><?php echo $blog['brief']; ?></p>
        
      </div>
    </div>
  </div>
  <?php } ?>
</div>
