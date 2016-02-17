<?php if ($testmode) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $text_testmode; ?></div>
<?php } ?>
<form action="<?php echo $action; ?>" method="post">
  <input type="hidden" name="merchantId" value="<?php echo $merchantId; ?>" />
  <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
  <input type="hidden" name="orderRef" value="<?php echo $orderRef; ?>" />
  <input type="hidden" name="currCode" value="<?php echo $currCode; ?>" />
  <input type="hidden" name="successUrl" value="<?php echo $successUrl; ?>" />
  <input type="hidden" name="failUrl" value="<?php echo $failUrl; ?>" />
  <input type="hidden" name="cancelUrl" value="<?php echo $cancelUrl; ?>" />
  <input type="hidden" name="payType" value="<?php echo $payType; ?>" />
  <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
  <input type="hidden" name="mpsMode" value="<?php echo $mpsMode; ?>" />
  <input type="hidden" name="payMethod" value="<?php echo $payMethod; ?>" />
  <input type="hidden" name="secureHash" value="<?php echo $secureHash; ?>" />
  <input type="hidden" name="remark" value="<?php echo $remark; ?>" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
  <input type="hidden" name="oriCountry" value="<?php echo $oriCountry; ?>" />
  <input type="hidden" name="destCountry" value="<?php echo $destCountry; ?>" />
  <div class="buttons">
    <div class="pull-right">
      <input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary" />
    </div>
  </div>
</form>
