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
                <label class="col-sm-2 control-label" for="entry-pay-name"><?php echo $entry_pay_name; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="upop_pay_name" value="<?php echo $upop_pay_name; ?>" placeholder="<?php echo $entry_upop_pay_name; ?>" id="entry-upop-pay-name" class="form-control"/>
                  <?php if ($error_upop_pay_name) { ?>
                  <div class="text-danger"><?php echo $error_upop_pay_name; ?></div>
                  <?php } ?>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-pay-desc"><?php echo $entry_pay_desc; ?></label>
                <div class="col-sm-10">
                  <textarea name="upop_pay_desc" placeholder="<?php echo $entry_pay_desc; ?>" rows="5" id="input-upop-pay-desc" class="form-control"><?php echo $upop_pay_desc; ?></textarea>
                </div>
              </div>
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="entry-business-name"><?php echo $entry_business_name; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="upop_business_name" value="<?php echo $upop_business_name; ?>" placeholder="<?php echo $entry_business_name; ?>" id="entry-upop-business-name" class="form-control"/>
                  <?php if ($error_upop_business_name) { ?>
                  <div class="text-danger"><?php echo $error_upop_business_name; ?></div>
                  <?php } ?>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-environment-type"><?php echo $entry_environment_type; ?></label>
                <div class="col-sm-10">
                  <select name="upop_environment_type" id="input-environment-type" class="form-control">
                    <?php foreach ($array_upop_environment_type as $item_upop_environment_type) { ?>
                        <?php if ($item_upop_environment_type['value'] == $upop_environment_type) { ?>
                            <option value="<?php echo $item_upop_environment_type['value']; ?>" selected="selected"><?php echo $item_upop_environment_type['title']; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $item_upop_environment_type['value']; ?>"><?php echo $item_upop_environment_type['title']; ?></option>
                        <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-test-business-account"><?php echo $entry_test_business_account; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="upop_test_business_account" value="<?php echo $upop_test_business_account; ?>" placeholder="<?php echo $entry_test_business_account; ?>" id="input-test-business-account" class="form-control"/>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-test-business-key"><?php echo $entry_test_business_key; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="upop_test_business_key" value="<?php echo $upop_test_business_key; ?>" placeholder="<?php echo $entry_test_business_key; ?>" id="input-upop-test-business-key" class="form-control"/>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-pm-business-account"><?php echo $entry_pm_business_account; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="upop_pm_business_account" value="<?php echo $upop_pm_business_account; ?>" placeholder="<?php echo $entry_pm_business_account; ?>" id="input-upop-pm-business-account" class="form-control"/>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-pm-business-key"><?php echo $entry_pm_business_key; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="upop_pm_business_key" value="<?php echo $upop_pm_business_key; ?>" placeholder="<?php echo $entry_pm_business_key; ?>" id="input-upop-pm-business-key" class="form-control"/>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-production-business-account"><?php echo $entry_production_business_account; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="upop_production_business_account" value="<?php echo $upop_production_business_account; ?>" placeholder="<?php echo $entry_production_business_account; ?>" id="input-upop-production-business-account" class="form-control"/>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-production-business_key"><?php echo $entry_production_business_key; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="upop_production_business_key" value="<?php echo $upop_production_business_key; ?>" placeholder="<?php echo $entry_production_business_key; ?>" id="input-upop-production-business-key" class="form-control"/>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="upop_sort_order" value="<?php echo $upop_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
                <div class="col-sm-10">
                  <select name="upop_geo_zone_id" id="input-geo-zone" class="form-control">
                    <option value="0"><?php echo $text_all_zones; ?></option>
                    <?php foreach ($geo_zones as $geo_zone) { ?>
                    <?php if ($geo_zone['geo_zone_id'] == $upop_geo_zone_id) { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="upop_status" id="input-status" class="form-control">
                    <?php if ($upop_status) { ?>
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
                <label class="col-sm-2 control-label"><?php echo $entry_order_status; ?></label>
                <div class="col-sm-10">
                  <select name="upop_order_status_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $upop_order_status_id) { ?>
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