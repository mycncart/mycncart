<div class="list-group">
  <?php foreach ($blog_categories as $blog_category) { ?>
  <?php if ($blog_category['blog_category_id'] == $blog_category_id) { ?>
  <a href="<?php echo $blog_category['href']; ?>" class="list-group-item active"><?php echo $blog_category['name']; ?></a>
  <?php if ($blog_category['children']) { ?>
  <?php foreach ($blog_category['children'] as $child) { ?>
  <?php if ($child['blog_category_id'] == $child_id) { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item active">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
  <?php } else { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
  <?php } ?>
  <?php } ?>
  <?php } ?>
  <?php } else { ?>
  <a href="<?php echo $blog_category['href']; ?>" class="list-group-item"><?php echo $blog_category['name']; ?></a>
  <?php } ?>
  <?php } ?>
</div>
