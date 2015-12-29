<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-pp-std-uk" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <?php if (isset($error['error_warning'])) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error['error_warning']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-pp-std-uk" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-status" data-toggle="tab"><?php echo $tab_order_status; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="entry-wxpay-mchid"><span data-toggle="tooltip" title="<?php echo $help_mchid; ?>"><?php echo $entry_wxpay_mchid; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="wxpay_mchid" value="<?php echo $wxpay_mchid; ?>" placeholder="<?php echo $entry_wxpay_mchid; ?>" id="entry-wxpay-mchid" class="form-control"/>
                  <?php if ($error_wxpay_mchid) { ?>
                  <div class="text-danger"><?php echo $error_wxpay_mchid; ?></div>
                  <?php } ?>
                </div>
              </div>
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="entry-wxpay-appid"><span data-toggle="tooltip" title="<?php echo $help_appid; ?>"><?php echo $entry_wxpay_appid; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="wxpay_appid" value="<?php echo $wxpay_appid; ?>" placeholder="<?php echo $entry_wxpay_appid; ?>" id="entry-wxpay-appid" class="form-control"/>
                  <?php if ($error_wxpay_appid) { ?>
                  <div class="text-danger"><?php echo $error_wxpay_appid; ?></div>
                  <?php } ?>
                </div>
              </div>
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="entry-wxpay-key"><span data-toggle="tooltip" title="<?php echo $help_key; ?>"><?php echo $entry_wxpay_key; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="wxpay_key" value="<?php echo $wxpay_key; ?>" placeholder="<?php echo $entry_wxpay_key; ?>" id="entry-wxpay-key" class="form-control"/>
                  <?php if ($error_wxpay_key) { ?>
                  <div class="text-danger"><?php echo $error_wxpay_key; ?></div>
                  <?php } ?>
                </div>
              </div>
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="entry-wxpay-appsecret"><span data-toggle="tooltip" title="<?php echo $help_appsecret; ?>"><?php echo $entry_wxpay_appsecret; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="wxpay_appsecret" value="<?php echo $wxpay_appsecret; ?>" placeholder="<?php echo $entry_wxpay_appsecret; ?>" id="entry-wxpay-appsecret" class="form-control"/>
                  <?php if ($error_wxpay_appsecret) { ?>
                  <div class="text-danger"><?php echo $error_wxpay_appsecret; ?></div>
                  <?php } ?>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="wxpay_total" value="<?php echo $wxpay_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control"/>
                </div>
              </div>
              
             
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-wxpay-sort-order"><?php echo $entry_wxpay_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="wxpay_sort_order" value="<?php echo $wxpay_sort_order; ?>" placeholder="<?php echo $entry_wxpay_sort_order; ?>" id="input-wxpay-sort-order" class="form-control"/>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
                <div class="col-sm-10">
                  <select name="wxpay_geo_zone_id" id="input-geo-zone" class="form-control">
                    <option value="0"><?php echo $text_all_zones; ?></option>
                    <?php foreach ($geo_zones as $geo_zone) { ?>
                    <?php if ($geo_zone['geo_zone_id'] == $wxpay_geo_zone_id) { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_wxpay_status; ?></label>
                <div class="col-sm-10">
                  <select name="wxpay_status" id="input-wxpay-status" class="form-control">
                    <?php if ($wxpay_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-debug"><span data-toggle="tooltip" title="<?php echo $help_log; ?>"><?php echo $entry_log; ?></span></label>
                <div class="col-sm-10">
                  <select name="wxpay_log" id="input-debug" class="form-control">
                    <?php if ($wxpay_log) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
            </div>
            
            
            
            <div class="tab-pane" id="tab-status">
              
             
             
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $help_trade_success; ?>"><?php echo $entry_trade_success_status; ?></span></label>
                <div class="col-sm-10">
                  <select name="wxpay_trade_success_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $wxpay_trade_success_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>