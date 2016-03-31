<?php if($logged) { ?>

<?php } elseif($weibo_login_authorized) { ?>

<?php } elseif($is_weixin) { ?>

<?php } else { ?>
<div class="panel panel-default">
  <div class="panel-body"><a href="<?php echo $code_url; ?>"><img src="../image/weibo_login.png" title="<?php echo $text_weibo_login; ?>" alt="<?php echo $text_weibo_login; ?>" border="0" /></a></span> 
  </div>
</div>
<?php } ?>