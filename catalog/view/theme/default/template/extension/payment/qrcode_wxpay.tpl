<script type="text/javascript">
	function callpay()
	{
		location.href = "<?php echo $redirect; ?>";
	}
</script>

<div class="buttons">
  <div class="pull-right">
    <button type="button" onclick="callpay()"  class="btn btn-primary"> 确认支付</button>
  </div>
</div>
