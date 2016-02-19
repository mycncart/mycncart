<div class="list-group">
  <?php foreach ($faq_categories as $faq_category) { ?>
  <?php if ($faq_category['faq_category_id'] == $faq_category_id) { ?>
  <a href="<?php echo $faq_category['href']; ?>" class="list-group-item active"><?php echo $faq_category['name']; ?></a>
  <?php if ($faq_category['children']) { ?>
  <?php foreach ($faq_category['children'] as $child) { ?>
  <?php if ($child['faq_category_id'] == $child_id) { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item active">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
  <?php } else { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
  <?php } ?>
  <?php } ?>
  <?php } ?>
  <?php } else { ?>
  <a href="<?php echo $faq_category['href']; ?>" class="list-group-item"><?php echo $faq_category['name']; ?></a>
  <?php } ?>
  <?php } ?>
</div>
