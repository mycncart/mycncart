<?php echo $header; ?>
<div class="container">
  <header>
      <div class="row">
        <div class="col-sm-6">
          <h1 class="pull-left">4<small>/4</small></h1>
          <h3><?php echo $heading_step_4; ?><br><small><?php echo $heading_step_4_small; ?></small></h3>
        </div>
        <div class="col-sm-6">
          <div id="logo" class="pull-right hidden-xs">
            <img src="view/image/logo.png" alt="MyCnCart" title="MyCnCart" />
          </div>
        </div>
      </div>
  </header>
  <?php if ($success) { ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="alert alert-danger"><?php echo $text_forget; ?></div>
  <div class="visit">
    <div class="row">
      <div class="col-sm-5 col-sm-offset-1 text-center">
        <img src="view/image/icon-store.png">
        <a class="btn btn-secondary" href="../"><?php echo $text_shop; ?></a>
      </div>
      <div class="col-sm-5 text-center">
        <img src="view/image/icon-admin.png">
        <a class="btn btn-secondary" href="../admin/"><?php echo $text_login; ?></a>
      </div>
    </div>
  </div>
  <div class="language" id="module-language" style="display:none;"></div>
  
  
  
  <div class="support text-center">
    <div class="row">
      <div class="col-sm-4">
        <a href="http://www.weibo.com/mycncart" class="icon transition">
          <i class="fa fa-weibo fa-4x"></i>
        </a>
        <h3><?php echo $text_weibo; ?></h3>
        <p><?php echo $text_weibo_info; ?></p>
        <a href="http://www.weibo.com/mycncart"><?php echo $text_weibo_link; ?></a>
      </div>
      <div class="col-sm-4">
        <a href="http://www.mycncart.cn" class="icon transition">
          <i class="fa fa-comments fa-4x"></i>
        </a>
        <h3><?php echo $text_forum; ?></h3>
        <p><?php echo $text_forum_info; ?></p>
        <a href="http://www.mycncart.cn"><?php echo $text_forum_link; ?></a>
      </div>
      <div class="col-sm-4">
        <a href="http://www.mycncart.com" class="icon transition">
          <i class="fa fa-user fa-4x"></i>
        </a>
        <h3><?php echo $text_commercial; ?></h3>
        <p><?php echo $text_commercial_info; ?></p>
        <a href="http://www.mycncart.com" target="_BLANK"><?php echo $text_commercial_link; ?></a>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>