<div class="list-group">
  <?php foreach ($press_categories as $press_category) { ?>
  <?php if ($press_category['press_category_id'] == $press_category_id) { ?>
  <a href="<?php echo $press_category['href']; ?>" class="list-group-item active"><?php echo $press_category['name']; ?></a>
  <?php if ($press_category['children']) { ?>
  <?php foreach ($press_category['children'] as $child) { ?>
  <?php if ($child['press_category_id'] == $child_id) { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item active">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
  <?php } else { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
  <?php } ?>
  <?php } ?>
  <?php } ?>
  <?php } else { ?>
  <a href="<?php echo $press_category['href']; ?>" class="list-group-item"><?php echo $press_category['name']; ?></a>
  <?php } ?>
  <?php } ?>
</div>
