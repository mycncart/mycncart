<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-kefu" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-kefu" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
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
            <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
            <div class="col-sm-10">
              <input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image-title"><?php echo $entry_weixin_image_title; ?></label>
            <div class="col-sm-10">
              <input type="text" name="image_title" value="<?php echo $image_title; ?>" placeholder="<?php echo $entry_weixin_image_title; ?>" id="input-image-title" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_weixin_image; ?></label>
            <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
              <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-qq"><?php echo $entry_qq; ?></label>
            <div class="col-sm-10">
              <div class="table-responsive">
                <table id="qq" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_qq_number; ?></td>
                      <td class="text-left"><?php echo $entry_qq_name; ?></td>
                      <td class="text-left"><?php echo $entry_sort_order; ?></td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $qq_row = 0; ?>
                    <?php foreach ($service_qqs as $service_qq) { ?>
                    <tr id="qq-row<?php echo $qq_row; ?>">
                      <td class="text-left"><input type="text" name="service_qq[<?php echo $qq_row; ?>][qq_number]" value="<?php echo $service_qq['qq_number']; ?>" placeholder="<?php echo $entry_qq_number; ?>" class="form-control" /></td>
                      <td class="text-left"><input type="text" name="service_qq[<?php echo $qq_row; ?>][qq_name]" value="<?php echo $service_qq['qq_name']; ?>" placeholder="<?php echo $entry_qq_name; ?>" class="form-control" /></td>
                      <td class="text-left"><input type="text" name="service_qq[<?php echo $qq_row; ?>][sort_order]" value="<?php echo $service_qq['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
                      
                      <td class="text-left"><button type="button" onclick="$('#qq-row<?php echo $qq_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $qq_row++; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5"></td>
                      <td class="text-left"><button type="button" onclick="addQQ();" data-toggle="tooltip" title="<?php echo $button_qq_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <script type="text/javascript"><!--
var qq_row = <?php echo $qq_row; ?>;

function addQQ() {
	html  = '<tr id="qq-row' + qq_row + '">';
    html += '  <td class="text-right"><input type="text" name="service_qq[' + qq_row + '][qq_number]" value="" placeholder="<?php echo $entry_qq_number; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="service_qq[' + qq_row + '][qq_name]" value="" placeholder="<?php echo $entry_qq_name; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="service_qq[' + qq_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#qq-row' + qq_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#qq tbody').append(html);

	$('.date').datetimepicker({
		pickTime: false
	});

	qq_row++;
}
//--></script>
<?php echo $footer; ?>
