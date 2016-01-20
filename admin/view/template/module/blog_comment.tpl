<form action="<?php echo $action_com;?>" method="post" id="formcom">
<div class="form-horizontal">
	<div class="row">
		<div class="col-sm-2">
			<ul class="nav nav-pills nav-stacked">
				<?php if ($excom) { ?>
				<?php foreach ($excom as $extension) { ?>
				<?php $actived = (empty($module_comid))?"class='active'":''; ?>
				<li <?php echo $actived; ?>><a href="<?php echo $extension['edit']; ?>" ><i class="fa fa-plus-circle"></i> <?php echo $extension['name']; ?></a></li>
				<?php $i=0; foreach ($extension['module'] as $module) { $i++;?>
				<?php $active = ($module['module_id'] == $module_comid)?'class="active"':''; ?>
				<li <?php echo $active; ?>><a href="<?php echo $module['edit']; ?>" ><i class="fa fa-minus-circle"></i> <?php echo $module['name']; ?></a></li>
				<?php } //end modules?>
				<?php } //end extensions?>
				<?php } //end if?>
			</ul>
		</div>
		<!-- End ul #module -->

		<div class="col-sm-8">
			<div class="pull-left">
				<a class="btn btn-success" title="" onclick="$('#formcom').submit();" data-toggle="tooltip" data-original-title="Save"><i class="fa fa-save"> Save </i></a>
				<?php if(!empty($module_comid)) { ?>
				<a onclick="confirm('Are you sure?') ? location.href='<?php echo $delete_com; ?>' : false;" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"> Delete</i></a>
				<?php } ?>
			</div>
			<div class="tab-content" id="tab-content-blogcomment">
				<div class="tab-pane active" id="tab-module-pavblogcomment">
					<table class="table noborder">
						<tr>
							<td class="col-sm-2"><?php echo $objlang->get('entry_module_name'); ?></td>
							<td class="col-sm-10">
								<input class="form-control" type="text" placeholder="<?php echo $objlang->get('entry_module_name'); ?>" value="<?php echo isset($name_com)?$name_com:''; ?>" name="pavblogcomment_module[name]" />
							</td>
						</tr>
						<tr>
							<td class="col-sm-2"><?php echo $objlang->get('entry_carousel'); ?></td>
							<td class="col-sm-10">
								<input class="form-control" type="text" name="pavblogcomment_module[limit]" value="<?php echo $limit_com; ?>">
							</td>
						</tr>
						<tr>
							<td class="col-sm-2"><?php echo $entry_status; ?></td>
							<td class="col-sm-10">
								<select name="pavblogcomment_module[status]" id="input-status" class="form-control">
									<?php if($status_com) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
					</table>
				</div>
			</div><!-- End div .tab-content module-->		
		</div>
	</div>
</div>
</form>
<style type="text/css">
	.noborder tbody > tr > td {border: 1px solid #fff;}
</style>