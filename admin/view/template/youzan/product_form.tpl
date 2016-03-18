<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                     <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="product_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" class="form-control summernote" id="input-description<?php echo $language['language_id']; ?>"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : ''; ?></textarea>
                      <?php if (isset($error_description[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_description[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="tab-pane" id="tab-data">
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_youzan_category; ?></label>
                <div class="col-sm-10">
                  <select name="youzan_category_id" id="input-youzan-category-id" class="form-control">
                    <option value="0"><?php echo $text_none; ?></option>
                    <?php foreach ($youzan_categories as $youzan_category) { ?>
                    <?php if ($youzan_category['cid'] == $youzan_category_id) { ?>
                    <option value="<?php echo $youzan_category['cid']; ?>" selected="selected"><?php echo $youzan_category['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $youzan_category['cid']; ?>"><?php echo $youzan_category['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_youzan_promotion; ?></label>
                <div class="col-sm-10">
                  <select name="youzan_promotion_id" id="input-youzan-promotion-id" class="form-control">
                    <option value="0"><?php echo $text_none; ?></option>
                    <?php foreach ($youzan_promotions as $youzan_promotion) { ?>
                    <?php if ($youzan_promotion['id'] == $youzan_promotion_id) { ?>
                    <option value="<?php echo $youzan_promotion['id']; ?>" selected="selected"><?php echo $youzan_promotion['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $youzan_promotion['id']; ?>"><?php echo $youzan_promotion['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_youzan_tag; ?></label>
                <div class="col-sm-10">
                  <select name="youzan_tag_id" id="input-youzan-tag-id" class="form-control">
                    <option value="0"><?php echo $text_none; ?></option>
                    <?php foreach ($youzan_tags as $youzan_tag) { ?>
                    <?php if ($youzan_tag['id'] == $youzan_tag_id) { ?>
                    <option value="<?php echo $youzan_tag['id']; ?>" selected="selected"><?php echo $youzan_tag['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $youzan_tag['id']; ?>"><?php echo $youzan_tag['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-is-virtual"><?php echo $entry_youzan_is_virtual; ?></label>
                <div class="col-sm-10">
                  <select name="is_virtual" id="input-is-virtual" class="form-control">
                    <?php if ($is_virtual) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                    <option value="0"><?php echo $text_no; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_yes; ?></option>
                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-shipping-fee"><?php echo $entry_youzan_post_fee; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="post_fee" value="<?php echo $post_fee; ?>" placeholder="<?php echo $entry_youzan_post_fee; ?>" id="input-model" class="form-control" />
                  
                </div>
              </div>
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-price"><?php echo $entry_youzan_price; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="price" value="<?php echo $price; ?>" placeholder="<?php echo $entry_youzan_price; ?>" id="input-price" class="form-control" />
                </div>
              </div>
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-origin-price"><?php echo $entry_youzan_origin_price; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="origin_price" value="<?php echo $origin_price; ?>" placeholder="<?php echo $entry_youzan_origin_price; ?>" id="input-origin-price" class="form-control" />
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-buy-url"><?php echo $entry_youzan_buy_url; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="buy_url" value="<?php echo $buy_url; ?>" placeholder="<?php echo $entry_youzan_buy_url; ?>" id="input-buy-url" class="form-control" />
                </div>
              </div>
              
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-outer-id"><?php echo $entry_youzan_outer_id; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="outer_id" value="<?php echo $outer_id; ?>" placeholder="<?php echo $entry_youzan_outer_id; ?>" id="input-outer-id" class="form-control" />
                  <?php if ($error_outer_id) { ?>
                  <div class="text-danger"><?php echo $error_outer_id; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-buy-quota"><?php echo $entry_youzan_buy_quota; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="buy_quota" value="<?php echo $buy_quota; ?>" placeholder="<?php echo $entry_youzan_buy_quota; ?>" id="input-buy-quota" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-quantity"><?php echo $entry_youzan_quantity; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="quantity" value="<?php echo $quantity; ?>" placeholder="<?php echo $entry_youzan_quantity; ?>" id="input-quantity" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-hide-quantity"><?php echo $entry_youzan_hide_quantity; ?></label>
                <div class="col-sm-10">
                  <select name="hide_quantity" id="input-hide-quantity" class="form-control">
                    <?php if ($hide_quantity) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                    <option value="0"><?php echo $text_no; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_yes; ?></option>
                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-is-display"><?php echo $entry_youzan_is_display; ?></label>
                <div class="col-sm-10">
                  <select name="is_display" id="input-is-display" class="form-control">
                    <?php if ($is_display) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                    <option value="0"><?php echo $text_no; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_yes; ?></option>
                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-join-level-discount"><?php echo $entry_youzan_join_level_discount; ?></label>
                <div class="col-sm-10">
                  <select name="join_level_discount" id="input-join-level-discount" class="form-control">
                    <?php if ($join_level_discount) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                    <option value="0"><?php echo $text_no; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_yes; ?></option>
                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
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
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
<?php echo $footer; ?>
