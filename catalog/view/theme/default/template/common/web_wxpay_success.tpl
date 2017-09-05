<?php echo $header; ?>
<div class="container">
	<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li>
			<a href="<?php echo $breadcrumb['href']; ?>">
				<?php echo $breadcrumb['text']; ?> </a>
		</li>
		<?php } ?> </ul>
	<div class="row">
		<?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_right) { ?>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>">
			<?php echo $content_top; ?>
			<div class="text-center" id="waiting">
				<h3>
					<?php echo $text_back; ?> </h3>
				<p>
					<?php echo $text_content; ?> </p>
			</div>
			<div class="text-center" id="payment" style="display: none;">
				<h3>微信支付失败</h3>
				<p style="margin-bottom: 20px;">非常抱歉！本次支付尚未成功。
					<br />我们没有获取带微信反馈的支付成功结果。</p>
				<h3>
					<a id="tryagain">再次获取</a> 或
					<a href="index.php?route=checkout/checkout">重新支付</a>
				</h3>
			</div>
			<?php echo $content_bottom; ?> </div>
		<?php echo $column_right; ?> </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		loopajax();
		$('#tryagain').click(function() {
			$('#payment').css("display", "none");
			$('#waiting').css("display", "block");
			loopajax();
		});
	});

	function loopajax() {
		var timesRun = 0;
		var interval = setInterval(function() {
			$.ajax({
				url: '<?php echo $ajax_check_order_status; ?>&order_id=<?php echo $order_id; ?>',
				dataType: 'json',
				success: function(json) {
					if(json['success']) {
						window.location.href = "index.php?route=checkout/success";
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
			timesRun += 1;
			if(timesRun >= 8) {
				clearInterval(interval);
				$('#payment').css("display", "block");
				$('#waiting').css("display", "none");
			}
		}, 1000);
	}
</script>
<?php echo $footer; ?>