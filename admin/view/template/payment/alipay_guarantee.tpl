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
                <label class="col-sm-2 control-label" for="entry-alipay-guarantee-seller-email"><span data-toggle="tooltip" title="<?php echo $help_seller_email; ?>"><?php echo $entry_alipay_guarantee_seller_email; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="alipay_guarantee_seller_email" value="<?php echo $alipay_guarantee_seller_email; ?>" placeholder="<?php echo $entry_alipay_guarantee_seller_email; ?>" id="entry-alipay-guarantee-seller-email" class="form-control"/>
                  <?php if ($error_alipay_guarantee_seller_email) { ?>
                  <div class="text-danger"><?php echo $error_alipay_guarantee_seller_email; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="entry-alipay-guarantee-partner"><?php echo $entry_alipay_guarantee_partner; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="alipay_guarantee_partner" value="<?php echo $alipay_guarantee_partner; ?>" placeholder="<?php echo $entry_alipay_guarantee_partner; ?>" id="entry-alipay-guarantee-partner" class="form-control"/>
                  <?php if ($error_alipay_guarantee_partner) { ?>
                  <div class="text-danger"><?php echo $error_alipay_guarantee_partner; ?></div>
                  <?php } ?>
                </div>
              </div>
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="entry-alipay-guarantee-security-code"><?php echo $entry_alipay_guarantee_security_code; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="alipay_guarantee_security_code" value="<?php echo $alipay_guarantee_security_code; ?>" placeholder="<?php echo $entry_alipay_guarantee_security_code; ?>" id="entry-alipay-guarantee-security-code" class="form-control"/>
                  <?php if ($error_alipay_guarantee_security_code) { ?>
                  <div class="text-danger"><?php echo $error_alipay_guarantee_security_code; ?></div>
                  <?php } ?>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="alipay_guarantee_total" value="<?php echo $alipay_guarantee_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control"/>
                </div>
              </div>
              
             
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-alipay-guarantee-sort-order"><?php echo $entry_alipay_guarantee_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="alipay_guarantee_sort_order" value="<?php echo $alipay_guarantee_sort_order; ?>" placeholder="<?php echo $entry_alipay_guarantee_sort_order; ?>" id="input-alipay-guarantee-sort-order" class="form-control"/>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
                <div class="col-sm-10">
                  <select name="alipay_guarantee_geo_zone_id" id="input-geo-zone" class="form-control">
                    <option value="0"><?php echo $text_all_zones; ?></option>
                    <?php foreach ($geo_zones as $geo_zone) { ?>
                    <?php if ($geo_zone['geo_zone_id'] == $alipay_guarantee_geo_zone_id) { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_alipay_guarantee_status; ?></label>
                <div class="col-sm-10">
                  <select name="alipay_guarantee_status" id="input-alipay-guarantee-status" class="form-control">
                    <?php if ($alipay_guarantee_status) { ?>
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
                <label class="col-sm-2 control-label"><?php echo $entry_wait_buyer_pay_status; ?></label>
                <div class="col-sm-10">
                  <select name="alipay_guarantee_wait_buyer_pay_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $alipay_guarantee_wait_buyer_pay_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_wait_seller_send_goods_status; ?></label>
                <div class="col-sm-10">
                  <select name="alipay_guarantee_wait_seller_send_goods_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $alipay_guarantee_wait_seller_send_goods_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_wait_buyer_confirm_goods_status; ?></label>
                <div class="col-sm-10">
                  <select name="alipay_guarantee_wait_buyer_confirm_goods_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $alipay_guarantee_wait_buyer_confirm_goods_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_trade_finished_status; ?></label>
                <div class="col-sm-10">
                  <select name="alipay_guarantee_trade_finished_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $alipay_guarantee_trade_finished_status_id) { ?>
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