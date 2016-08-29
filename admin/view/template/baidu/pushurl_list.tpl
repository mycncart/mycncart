<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
     	<button type="button" data-toggle="tooltip" title="<?php echo $button_push; ?>" class="btn btn-default" onclick="$('#form-pushurl').attr('action', '<?php echo $push; ?>').submit()"><?php echo $button_push; ?></button>
        
        <a href="<?php echo $category; ?>" data-toggle="tooltip" title="<?php echo $button_category; ?>" class="btn btn-primary"><?php echo $button_category; ?></a>
        
        <a href="<?php echo $product; ?>" data-toggle="tooltip" title="<?php echo $button_product; ?>" class="btn btn-primary"><?php echo $button_product; ?></a>
        
        <a href="<?php echo $information; ?>" data-toggle="tooltip" title="<?php echo $button_information; ?>" class="btn btn-primary"><?php echo $button_information; ?></a>
        
        <a href="<?php echo $manufacturer; ?>" data-toggle="tooltip" title="<?php echo $button_manufacturer; ?>" class="btn btn-primary"><?php echo $button_manufacturer; ?></a>
        
        <a href="<?php echo $blog; ?>" data-toggle="tooltip" title="<?php echo $button_blog; ?>" class="btn btn-primary"><?php echo $button_blog; ?></a>
        
        <a href="<?php echo $press; ?>" data-toggle="tooltip" title="<?php echo $button_press; ?>" class="btn btn-primary"><?php echo $button_press; ?></a>
        
      	<a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-pushurl').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-url"><?php echo $entry_url; ?></label>
                <input type="text" name="filter_url" value="<?php echo $filter_url; ?>" placeholder="<?php echo $entry_url; ?>" id="input-url" class="form-control" />
              </div>
            </div>
            
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-pushed"><?php echo $entry_pushed; ?></label>
                <select name="filter_pushed" id="input-pushed" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_pushed) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <?php } ?>
                  <?php if (!$filter_pushed && !is_null($filter_pushed)) { ?>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>
              </div>
              
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
            
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-pushurl">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php echo $column_id; ?></td>
                  <td class="text-left"><?php if ($sort == 'url') { ?>
                    <a href="<?php echo $sort_url; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_url; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_url; ?>"><?php echo $column_url; ?></a>
                    <?php } ?></td>
                  
                  <td class="text-right"><?php echo $column_pushed; ?></td>
                  <td class="text-right"><?php echo $column_push_date; ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($pushurls) { ?>
                <?php foreach ($pushurls as $pushurl) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($pushurl['pushurl_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $pushurl['pushurl_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $pushurl['pushurl_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $pushurl['pushurl_id']; ?></td>
                  <td class="text-left"><?php echo $pushurl['url']; ?></td>
                  <td class="text-right"><?php echo $pushurl['pushed']; ?></td>
                  <td class="text-right"><?php echo $pushurl['push_date']; ?></td>
                  <td class="text-right"><a href="<?php echo $pushurl['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
  
  <script type="text/javascript"><!--
$('#button-jump').on('click', function() {
	var url = 'index.php?route=baidu/pushurl&token=<?php echo $token; ?>';

	var pnum = $('input[name=\'pnum\']').val();

	if (pnum) {
		url += '&page=' + encodeURIComponent(pnum);
	}

	location = url;
});
//--></script> 


  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=baidu/pushurl&token=<?php echo $token; ?>';

	var filter_url = $('input[name=\'filter_url\']').val();

	if (filter_url) {
		url += '&filter_url=' + encodeURIComponent(filter_url);
	}
	
	var filter_pushed = $('select[name=\'filter_pushed\']').val();

	if (filter_pushed != '*') {
		url += '&filter_pushed=' + encodeURIComponent(filter_pushed);
	}


	location = url;
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name=\'filter_url\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=baidu/pushurl/autocomplete&token=<?php echo $token; ?>&filter_url=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['url'],
						value: item['pushurl_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_url\']').val(item['label']);
	}
});

//--></script></div>
<?php echo $footer; ?>