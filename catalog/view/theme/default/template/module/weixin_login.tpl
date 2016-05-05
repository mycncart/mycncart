<?php if($logged) { ?>
hello
<?php } elseif($is_weixin) { ?>
<div class="panel panel-default">
  <div class="panel-body"><a href="<?php echo $weixin_login; ?>"><img src="../image/weixin_login.png" title="<?php echo $text_weixin_login; ?>" alt="<?php echo $text_weixin_login; ?>" border="0" /></a></span> 
  </div>
</div>
<?php } else { ?>
<div class="panel panel-default">
  <div class="panel-body"><a href="<?php echo $wxpclogin_url; ?>"><img src="../image/weixin_login.png" title="<?php echo $text_weixin_login; ?>" alt="<?php echo $text_weixin_login; ?>" border="0" /></a></span> 
  </div>
</div>
<?php } ?>