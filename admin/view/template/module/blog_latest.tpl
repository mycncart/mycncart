<form action="<?php echo $action_lat;?>" method="post" id="formlat">
<div class="form-horizontal">
	<div class="row">
		<div class="col-sm-2">
			<ul class="nav nav-pills nav-stacked">
				<?php if ($exlat) { ?>
				<?php foreach ($exlat as $extension) { ?>
				<?php $actived = (empty($module_latid))?"class='active'":''; ?>
				<li <?php echo $actived; ?>><a href="<?php echo $extension['edit']; ?>" ><i class="fa fa-plus-circle"></i> <?php echo $extension['name']; ?></a></li>
				<?php $i=0; foreach ($extension['module'] as $module) { $i++;?>
				<?php $active = ($module['module_id'] == $module_latid)?'class="active"':''; ?>
				<li <?php echo $active; ?>><a href="<?php echo $module['edit']; ?>" ><i class="fa fa-minus-circle"></i> <?php echo $module['name']; ?></a></li>
				<?php } //end modules?>
				<?php } //end extensions?>
				<?php } //end if?>
			</ul>
		</div>
		<!-- End ul #module -->

		<div class="col-sm-8">
			<div class="pull-left">
				<a class="btn btn-success" title="" onclick="$('#formlat').submit();" data-toggle="tooltip" data-original-title="Save"><i class="fa fa-save"> Save </i></a>
				<?php if(!empty($module_latid)) { ?>
				<a onclick="confirm('Are you sure?') ? location.href='<?php echo $delete_lat; ?>' : false;" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"> Delete</i></a>
				<?php } ?>
			</div>
			<div class="tab-content" id="tab-content-blogcomment">
				<div class="tab-pane active" id="tab-module-pavblogcomment">
					
					<table class="table noborder">
						<tr>
							<td class="col-sm-2"><?php echo $objlang->get('entry_module_name'); ?></td>
							<td class="col-sm-10">
								<input class="form-control" type="text" placeholder="<?php echo $objlang->get('entry_module_name'); ?>" value="<?php echo isset($name_lat)?$name_lat:''; ?>" name="pavbloglatest_module[name]" />
							</td>
						</tr>
						<tr>
							<td class="col-sm-2"><?php echo $entry_status; ?></td>
							<td class="col-sm-10">
								<select name="pavbloglatest_module[status]" id="input-status" class="form-control">
									<?php if($status_lat) { ?>
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
					<ul class="nav nav-tabs" id="language-pavbloglatest">
						<?php foreach ($languages as $language) {?>
						<li><a href="#tab-module-language-<?php echo $language["language_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
						<?php } ?>
					</ul>
					<div class="tab-content">
						<?php foreach ($languages as $language) {?>
						<div class="tab-pane" id="tab-module-language-<?php echo $language["language_id"]; ?>">
							<table class="table noborder">
								<tr>
									<td class="col-sm-2"><?php echo $objlang->get("entry_description"); ?></td>
									<td class="col-sm-10">
										<textarea id="pavbloglatest_module_description_<?php echo $language['language_id'];?>" name="pavbloglatest_module[description][<?php echo $language['language_id']; ?>]">
											<?php echo isset($description[$language['language_id']])?$description[$language['language_id']]:''; ?>
										</textarea>
									</td>
								</tr>
							</table>
						</div>
						<?php } ?>
					</div>
					<table class="table no-border">
							<!-- Prefix Class -->
							<tr>
								<td class="col-sm-2"><?php echo $objlang->get("entry_prefixclass"); ?></td>
								<td class="col-sm-10"><input class="form-control" type="text" name="pavbloglatest_module[prefixclass]" value="<?php echo $prefixclass; ?>"></td>
							<tr>
							<!-- //Tab Product -->
							<tr>
								<td class="col-sm-2"><?php echo $objlang->get("entry_tabs"); ?></td>
								<td class="col-sm-10"><select class="form-control" name="pavbloglatest_module[tabs]">
									<?php foreach ($selectabs as $tab => $tabName ) { ?>
									<?php $selected = ($tabs == $tab)?'selected="selected"':'';?>
									<option value="<?php echo $tab; ?>" <?php echo $selected; ?>><?php echo addslashes($tabName); ?></option>
									<?php } ?>
								</select></td>
							<tr>
							<!-- //Dimension (W x H) and Resize Type: -->
							<tr>
								<td class="col-sm-2"><?php echo $entry_dimension; ?></td>
								<td class="col-sm-10">
								<input style="width:20%" class="form-control" type="text" name="pavbloglatest_module[width]" value="<?php echo $width; ?>" size="3" />
								x <input style="width:20%" class="form-control" type="text" name="pavbloglatest_module[height]" value="<?php echo $height; ?>" size="3" /></td>
							<tr>

							<!-- //Max Columns - Limit Items In Carousel: -->
							</tr>
								<td class="col-sm-2"><?php echo $objlang->get("entry_carousel"); ?></td>
								<td class="col-sm-10">
									<input style="width:20%" class="form-control" type="text" name="pavbloglatest_module[cols]" value="<?php echo $cols; ?>" size="3" />
									x <input style="width:20%" class="form-control" type="text" name="pavbloglatest_module[limit]" value="<?php echo $limit_lat; ?>" size="3" />
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
<script type="text/javascript">
	<?php foreach ($languages as $language) { ?>
		$("#pavbloglatest_module_description_<?php echo $language['language_id']?>").summernote({ height: 150 });
	<?php } ?>
	$('#language-pavbloglatest li:first-child a').tab('show');
</script>