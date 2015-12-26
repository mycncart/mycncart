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
      <h3 class="panel-title"><i class="fa fa-pencil"></i><img src="view/image/payment/chinapay.jpg" alt="" /> <?php echo $heading_title; ?></h3>
      
    </div>
    <div class="panel-body">
    	<div style="margin:15px;">
    		<?php echo $text_account_warning; ?>
    	</div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form-group required">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_id; ?></td>
            <td><input type="text" name="chinapay_id" value="<?php echo $chinapay_id; ?>" />
            <?php if ($error_id) { ?>
              <span class="error"><?php echo $error_id; ?></span>
            <?php } ?>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_key; ?></td>
            <td><input type="text" name="chinapay_key" value="<?php echo $chinapay_key; ?>" />
            <?php if ($error_key) { ?>
              <span class="error"><?php echo $error_key; ?></span>
            <?php } ?>	
          </tr>
          <tr>
            <td><?php echo $entry_callback; ?></td>
            <td><textarea cols="40" rows="5"><?php echo $callback; ?></textarea></td>
          </tr>          
             
          <tr>
            <td><?php echo $entry_total; ?></td>
            <td><input type="text" name="chinapay_total" value="<?php echo $chinapay_total; ?>" /></td>
          </tr>          
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="chinapay_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $chinapay_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="chinapay_status">
                <?php if ($chinapay_status) { ?>
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
            <td><input type="text" name="chinapay_sort_order" value="<?php echo $chinapay_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  </div>
</div>
<?php echo $footer; ?> 