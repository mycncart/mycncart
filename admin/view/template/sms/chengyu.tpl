<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-chengyu" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-chengyu" class="form-horizontal">
        	
            <h4>【广州市程宇网络科技有限公司】短信接口账户申请网址： <a href="http://www.cheng-yu.com.cn/contact.asp" target="_blank">http://www.cheng-yu.com.cn</a>。 申请接口时请提示推荐商为 mycncart.com 即可。 客服QQ： 1143084745  客服电话： 020-29827869</h4>
        
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-userid"><?php echo $entry_userid; ?></label>
            <div class="col-sm-10">
              <input type="text" name="chengyu_userid" value="<?php echo $chengyu_userid; ?>" placeholder="<?php echo $entry_userid; ?>" id="input-userid" class="form-control" />
              <?php if ($error_userid) { ?>
                  <div class="text-danger"><?php echo $error_userid; ?></div>
              <?php } ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-account"><?php echo $entry_account; ?></label>
            <div class="col-sm-10">
              <input type="text" name="chengyu_account" value="<?php echo $chengyu_account; ?>" placeholder="<?php echo $entry_account; ?>" id="input-account" class="form-control" />
              <?php if ($error_account) { ?>
                  <div class="text-danger"><?php echo $error_account; ?></div>
              <?php } ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
            <div class="col-sm-10">
              <input type="text" name="chengyu_password" value="<?php echo $chengyu_password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
              <?php if ($error_password) { ?>
                  <div class="text-danger"><?php echo $error_password; ?></div>
              <?php } ?>
            </div>
          </div>
          
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="chengyu_status" id="input-status" class="form-control">
                <?php if ($chengyu_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 