<?php if($logged) { ?>

<?php } elseif($qq_login_authorized) { ?>

<?php } elseif($is_weixin) { ?>

<?php } else { ?>
<div class="list-group">
	<a href="<?php echo $qq_login_url; ?>" class="list-group-item"><img src="catalog/view/theme/default/image/qq_login.png" title="<?php echo $text_qq_login; ?>" alt="<?php echo $text_qq_login; ?>" border="0" /></a>
      
</div>
<?php } ?>