<?php if($logged) { ?>

<?php } elseif ($is_weixin) { ?>

<div class="list-group">
	<a href="<?php echo $weixin_login; ?>" class="list-group-item"><img src="catalog/view/theme/default/image/weixin_login.png" title="<?php echo $text_weixin_login; ?>" alt="<?php echo $text_weixin_login; ?>" border="0" /></a>
</div>
<?php } else { ?>

<div class="list-group">
	<a href="<?php echo $wxpclogin_url; ?>" class="list-group-item"><img src="catalog/view/theme/default/image/weixin_login.png" title="<?php echo $text_weixin_login; ?>" alt="<?php echo $text_weixin_login; ?>" border="0" /></a>
</div>
<?php } ?>