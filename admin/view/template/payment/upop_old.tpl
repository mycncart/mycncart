<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
 <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      <div class="buttons"><a onclick="$('#form').submit();" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></a>
      <a onclick="location = '<?php echo $cancel; ?>';" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
       </div>
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
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-pencil"></i><img src="view/image/payment/upop.jpg" alt="" /> <?php echo $heading_title; ?></h3>
     
    </div>
    <div class="panel-body">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form-group required">
        
        <tr>
            <td><span class="required">*</span> <?php echo $text_pay_name; ?></td>
            <td><input type="text" name="upop_pay_name" value="<?php echo $upop_pay_name; ?>" />
              <?php if ($error_upop_pay_name) { ?>
              <span class="error"><?php echo $error_upop_pay_name; ?></span>
              <?php } ?></td>
          </tr>
        
        <tr>
            <td><?php echo $text_pay_desc; ?></td>
            <td><textarea name="upop_pay_desc" cols="40" rows="5" style="width: 557px; height: 88px;"><?php echo $upop_pay_desc; ?></textarea></td>
          </tr>
        
        
          <tr>
            <td><span class="required">*</span> <?php echo $text_business_name; ?></td>
            <td><input type="text" name="upop_business_name" value="<?php echo $upop_business_name; ?>" />
              <?php if ($error_upop_business_name) { ?>
              <span class="error"><?php echo $error_upop_business_name; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $text_environment_type; ?></td>
            <td>
            
            <select name="upop_environment_type">
				  <?php foreach ($array_upop_environment_type as $item_upop_environment_type) { ?>
                    <?php if ($item_upop_environment_type['value'] == $upop_environment_type) { ?>
                        <option value="<?php echo $item_upop_environment_type['value']; ?>" selected="selected"><?php echo $item_upop_environment_type['title']; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $item_upop_environment_type['value']; ?>"><?php echo $item_upop_environment_type['title']; ?></option>
                    <?php } ?>
                <?php } ?>
			</select>
            </td>
          </tr>

          <tr>
            <td><?php echo $text_test_business_account; ?></td>
            <td><input type="text" name="upop_test_business_account" value="<?php echo $upop_test_business_account; ?>" /></td>
          </tr>   
          
          <tr>
            <td><?php echo $text_test_business_key; ?></td>
            <td><input type="text" name="upop_test_business_key" value="<?php echo $upop_test_business_key; ?>" /></td>
          </tr>   
          
          <tr>
            <td><?php echo $text_pm_business_account; ?></td>
            <td><input type="text" name="upop_pm_business_account" value="<?php echo $upop_pm_business_account; ?>" /></td>
          </tr>   
          
          <tr>
            <td><?php echo $text_pm_business_key; ?></td>
            <td><input type="text" name="upop_pm_business_key" value="<?php echo $upop_pm_business_key; ?>" /></td>
          </tr>   
          
          <tr>
            <td><?php echo $text_production_business_account; ?></td>
            <td><input type="text" name="upop_production_business_account" value="<?php echo $upop_production_business_account; ?>" /></td>
          </tr>   
          
          <tr>
            <td><?php echo $text_production_business_key; ?></td>
            <td><input type="text" name="upop_production_business_key" value="<?php echo $upop_production_business_key; ?>" /></td>
          </tr>  
          
          
   
          <tr>
            <td><?php echo $entry_order_status; ?></td>
            <td><select name="upop_order_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $upop_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="upop_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $upop_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="upop_status">
                <?php if ($upop_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="upop_sort_order" value="<?php echo $upop_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  </div>
</div>
<?php echo $footer; ?> 