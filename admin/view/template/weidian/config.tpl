<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-cheque" class="form-horizontal">
        
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-weidian-appkey"><span data-toggle="tooltip" title="<?php echo $help_weidian_appkey; ?>"><?php echo $entry_weidian_appkey; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="weidian_appkey" value="<?php echo $weidian_appkey; ?>" placeholder="<?php echo $entry_weidian_appkey; ?>" id="input-weidian-appkey" class="form-control" />
              <?php if ($error_weidian_appkey) { ?>
              <div class="text-danger"><?php echo $error_weidian_appkey; ?></div>
              <?php } ?>
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-weidian-secret"><span data-toggle="tooltip" title="<?php echo $help_weidian_secret; ?>"><?php echo $entry_weidian_secret; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="weidian_secret" value="<?php echo $weidian_secret; ?>" placeholder="<?php echo $entry_weidian_secret; ?>" id="input-weidian-secret" class="form-control" />
              <?php if ($error_weidian_secret) { ?>
              <div class="text-danger"><?php echo $error_weidian_secret; ?></div>
              <?php } ?>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>