<?php if ($testmode) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $text_testmode; ?></div>
<?php } ?>
<form action="<?php echo $action; ?>" method="post">

	<?php
       while($param=each($params)){ 
         echo "<input type='hidden' id='".$param['key']."' name='".$param['key']."' value='".$param['value']."' />"; 
       }
    ?>
    
  <div class="buttons">
    <div class="pull-right">
      <input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary" />
    </div>
  </div>
</form>
