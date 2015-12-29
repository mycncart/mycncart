<?php echo $header; ?>
<div class="container">
  <header>
    <div class="row">
      <div class="col-sm-12"><img src="view/image/logo.png" alt="MyCnCart" title="MyCnCart" /></div>
    </div>
  </header>
  <h1>升级</h1>
  <div class="row">
    <div class="col-sm-9">
      <?php if ($error_warning) { ?>
      <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php } ?>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
          <p><b>请小心进行如下升级步骤！</b></p>
          <ol>
            <li>在论坛中提交遇到的相关升级错误</li>
            <li>升级后，清除浏览器Cookies避免token错误。</li>
            <li>按下Ctrl + F5键至少两次，加载后台管理页面以强制浏览器更新css的修改。</li>
            <li>访问并编辑后台网站管理员分组，选择所有。</li>
            <li>访问并编辑后台系统设置，更新所有并保存。即时没有做任何修改，也要保存。</li>
            <li>访问网站前台，按下 Ctrl + F5 至少两次，强制浏览器加载新的CSS。</li>
          </ol>
        </fieldset>
        <div class="buttons">
          <div class="text-right">
            <input type="submit" value="继续" class="button" />
          </div>
        </div>
      </form>
    </div>
    <div class="col-sm-3">
      <ul class="list-group">
        <li class="list-group-item"><b>升级</b></li>
        <li class="list-group-item">完成</li>
      </ul>
    </div>
  </div>
</div>
<?php echo $footer; ?>