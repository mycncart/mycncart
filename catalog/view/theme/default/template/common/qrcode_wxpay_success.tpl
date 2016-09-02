<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1 class="text-center"><?php echo $heading_title; ?></h1>
      <div class="text-center">
        <p>
          <img alt="微信扫码支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data=<?php echo urlencode($code_url); ?>" style="width:150px;height:150px;">
        </p>
      </div>
      <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
	setInterval("ajaxstatus()", 3000);    
});

function ajaxstatus() {
		$.ajax({
		url: '<?php echo $ajax_check_order_status; ?>&order_id=<?php echo $order_id; ?>',
		dataType: 'json',
		success: function(json) {
			if (json['success']) {
				window.location.href = "index.php?route=checkout/success";
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
} 
</script>
<?php echo $footer; ?>
