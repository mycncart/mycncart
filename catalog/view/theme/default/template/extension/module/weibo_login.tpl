<?php if($logged) { ?>

<?php } elseif($weibo_login_authorized) { ?>

<?php } elseif($is_weixin) { ?>

<?php } else { ?>
<div class="list-group">
	<a href="<?php echo $code_url; ?>" class="list-group-item"><img src="catalog/view/theme/default/image/weibo_login.png" title="<?php echo $text_weibo_login; ?>" alt="<?php echo $text_weibo_login; ?>" border="0" /></a>
      
</div>
<?php } ?>