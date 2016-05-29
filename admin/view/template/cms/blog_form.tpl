<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-blog" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-blog" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
            <li><a href="#tab-links" data-toggle="tab"><?php echo $tab_links; ?></a></li>
            <li><a href="#tab-gallery" data-toggle="tab"><?php echo $tab_gallery; ?></a></li>
            <li><a href="#tab-design" data-toggle="tab"><?php echo $tab_design; ?></a></li>
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
                    <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="blog_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_title[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-brief<?php echo $language['language_id']; ?>"><?php echo $entry_brief; ?></label>
                    <div class="col-sm-10">
                      <textarea name="blog_description[<?php echo $language['language_id']; ?>][brief]" rows="5" placeholder="<?php echo $entry_brief; ?>" id="input-brief<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['brief'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="blog_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" class="form-control summernote" id="input-description<?php echo $language['language_id']; ?>"><?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="blog_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="blog_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                    <div class="col-sm-10">
                      <textarea name="blog_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-tag<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_tag; ?>"><?php echo $entry_tag; ?></span></label>
                    <div class="col-sm-10">
                      <input type="text" name="blog_description[<?php echo $language['language_id']; ?>][tag]" value="<?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['tag'] : ''; ?>" placeholder="<?php echo $entry_tag; ?>" id="input-tag<?php echo $language['language_id']; ?>" class="form-control" />
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="tab-pane" id="tab-data">
              
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                  <?php if ($error_keyword) { ?>
                  <div class="text-danger"><?php echo $error_keyword; ?></div>
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
                <label class="col-sm-2 control-label" for="input-featured"><?php echo $entry_featured; ?></label>
                <div class="col-sm-10">
                  <select name="featured" id="input-featured" class="form-control">
                    <?php if ($featured) { ?>
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
                <label class="col-sm-2 control-label" for="input-hits"><?php echo $entry_hits; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="hits" value="<?php echo $hits; ?>" placeholder="<?php echo $entry_hits; ?>" id="input-hits" class="form-control" />
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-created"><?php echo $entry_created; ?></label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="created" value="<?php echo $created; ?>" placeholder="<?php echo $entry_created; ?>" data-date-format="YYYY-MM-DD" id="input-created" class="form-control" />
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-user"><?php echo $entry_user; ?></label>
                <div class="col-sm-10">
                  <select name="user_id" id="input-user" class="form-control">
                    <?php foreach ($users as $user) { ?>
                    <?php if ($user['user_id'] == $user_id) { ?>
                    <option value="<?php echo $user['user_id']; ?>" selected="selected"><?php echo $user['username']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $user['user_id']; ?>"><?php echo $user['username']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-video-code; ?>"><?php echo $entry_video_code; ?></label>
                <div class="col-sm-10">
                  <textarea name="video_code" rows="5" placeholder="<?php echo $entry_video_code; ?>" id="input-video-code" class="form-control"><?php echo $video_code; ?></textarea>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-links">
              <div class="tab-pane" id="tab-links">
              <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-blog-category"><?php echo $entry_blog_category; ?></label>
                  <div class="col-sm-10">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($blog_categories as $blog_category) { ?>
                      <div class="checkbox">
                        <label>
                          <?php if (in_array($blog_category['blog_category_id'], $blog_blog_category)) { ?>
                          <input type="checkbox" name="blog_blog_category[]" value="<?php echo $blog_category['blog_category_id']; ?>" checked="checked" />
                          <?php echo $blog_category['name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="blog_blog_category[]" value="<?php echo $blog_category['blog_category_id']; ?>" />
                          <?php echo $blog_category['name']; ?>
                          <?php } ?>
                        </label>
                      </div>
                      <?php } ?>
                    </div>
                   
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-product-related"><?php echo $entry_product_related; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="prelated" value="" placeholder="<?php echo $entry_product_related; ?>" id="input-product-related" class="form-control" />
                    <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($product_relateds as $product_related) { ?>
                      <div id="product-related<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                        <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-blog-related"><?php echo $entry_blog_related; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="brelated" value="" placeholder="<?php echo $entry_blog_related; ?>" id="input-blog-related" class="form-control" />
                    <div id="blog-related" class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($blog_relateds as $blog_related) { ?>
                      <div id="blog-related<?php echo $blog_related['blog_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $blog_related['title']; ?>
                        <input type="hidden" name="blog_related[]" value="<?php echo $blog_related['blog_id']; ?>" />
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="height: 150px; overflow: auto;">
                    <div class="checkbox">
                      <label>
                        <?php if (in_array(0, $blog_store)) { ?>
                        <input type="checkbox" name="blog_store[]" value="0" checked="checked" />
                        <?php echo $text_default; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="blog_store[]" value="0" />
                        <?php echo $text_default; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php foreach ($stores as $store) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($store['store_id'], $blog_store)) { ?>
                        <input type="checkbox" name="blog_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                        <?php echo $store['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="blog_store[]" value="<?php echo $store['store_id']; ?>" />
                        <?php echo $store['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              
            </div>
            
            </div>
            
            <div class="tab-pane" id="tab-design">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_store; ?></td>
                      <td class="text-left"><?php echo $entry_layout; ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left"><?php echo $text_default; ?></td>
                      <td class="text-left"><select name="blog_layout[0]" class="form-control">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($blog_layout[0]) && $blog_layout[0] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <?php foreach ($stores as $store) { ?>
                    <tr>
                      <td class="text-left"><?php echo $store['title']; ?></td>
                      <td class="text-left"><select name="blog_layout[<?php echo $store['store_id']; ?>]" class="form-control">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($blog_layout[$store['store_id']]) && $blog_layout[$store['store_id']] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            
            <div class="tab-pane" id="tab-gallery">
              <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-article-list-gallery-display"><?php echo $entry_article_list_gallery_display; ?></label>
                  <div class="col-sm-10">
                      <select name="article_list_gallery_display" id="input-article-list-gallery-display" class="form-control">
                          <option value="CLASSIC" <?php echo ($article_list_gallery_display == 'CLASSIC' ? 'selected="selected"' : '') ?>><?php echo $text_classic; ?></option>
                          <option value="SLIDER" <?php echo ($article_list_gallery_display == 'SLIDER' ? 'selected="selected"' : '') ?>><?php echo $text_slider; ?></option>
                      </select>
                  </div>
              </div>
              <div class="table-responsive">
                  <table id="images" class="table table-striped table-bordered table-hover">
                      <thead>
                          <tr>
                              <td class="text-left"><?php echo $entry_image; ?> / <?php echo $entry_link ?></td>
                              <td class="text-center" style="width: 100px"><?php echo $entry_width; ?></td>
                              <td class="text-center" style="width: 100px"><?php echo $entry_height; ?></td>
                              <td class="text-center" ><?php echo $entry_sort_order; ?></td>
                              <td class="text-center"><?php echo $entry_type; ?></td>
                              <td></td>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $gallery_row = 0; ?>
                          <?php foreach ($article_galleries as $article_gallery) { ?>
                              <tr id="gallery-row<?php echo $gallery_row; ?>">
                                  <?php if($article_gallery['type'] == 'IMG'): ?>
                                  <td class="text-left"><a href="" id="thumb-image<?php echo $gallery_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $article_gallery['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="article_gallery[<?php echo $gallery_row; ?>][path]" value="<?php echo $article_gallery['path']; ?>" id="input-image<?php echo $gallery_row; ?>" /></td>
                                  <td class="text-center"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][width]" value="<?php echo $article_gallery['width']; ?>" placeholder="<?php echo $entry_width; ?>" class="form-control" /></td>
                                  <td class="text-center"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][height]" value="<?php echo $article_gallery['height']; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" /></td>
                                  <td class="text-right"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][sort_order]" value="<?php echo $article_gallery['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
                                  <td class="text-center"><input type="hidden" name="article_gallery[<?php echo $gallery_row; ?>][type]" value="<?php echo $article_gallery['type']; ?>" /><?php echo $entry_image ?></td>
                                  <td class="text-center"><button type="button" onclick="$('#gallery-row<?php echo $gallery_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                  <?php elseif($article_gallery['type'] == 'YOUTUBE'): ?>
                                  <td class="text-left"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][path]" value="<?php echo $article_gallery['path']; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" /></td>
                                  <td class="text-center"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][width]" value="<?php echo $article_gallery['width']; ?>" placeholder="<?php echo $entry_width; ?>" class="form-control" /></td>
                                  <td class="text-center"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][height]" value="<?php echo $article_gallery['height']; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" /></td>
                                  <td class="text-right"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][sort_order]" value="<?php echo $article_gallery['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
                                  <td class="text-center"><input type="hidden" name="article_gallery[<?php echo $gallery_row; ?>][type]" value="<?php echo $article_gallery['type']; ?>" /><?php echo $entry_youtube?></td>
                                  <td class="text-center"><button type="button" onclick="$('#gallery-row<?php echo $gallery_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                  <?php elseif($article_gallery['type'] == 'SOUNDCLOUD'): ?>
                                  <td class="text-left"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][path]" value="<?php echo $article_gallery['path']; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" /></td>
                                  <td class="text-center"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][width]" value="<?php echo $article_gallery['width']; ?>" placeholder="<?php echo $entry_width; ?>" class="form-control" /></td>
                                  <td class="text-center"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][height]" value="<?php echo $article_gallery['height']; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" /></td>                                             
                                  <td class="text-right"><input type="text" name="article_gallery[<?php echo $gallery_row; ?>][sort_order]" value="<?php echo $article_gallery['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
                                  <td class="text-center"><input type="hidden" name="article_gallery[<?php echo $gallery_row; ?>][type]" value="<?php echo $article_gallery['type']; ?>" /><?php echo $entry_soundcloud ?></td>
                                  <td class="text-center"><button type="button" onclick="$('#gallery-row<?php echo $gallery_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                  <?php endif;  ?>
                              </tr>
                              <?php $gallery_row++; ?>
                          <?php } ?>
                      </tbody>
                      <tfoot>
                          <tr>
                              <td colspan="5"></td>
                              <td class="text-left" style="width: 230px">
                                      <div class="col-sm-10" style="padding: 0">
                                          <select id="gallery-type" class="form-control">
                                              <option value="Image"><?php echo $entry_image ?></option>
                                              <option value="Youtube"><?php echo $entry_youtube ?></option>
                                              <option value="SoundCloud"><?php echo $entry_soundcloud ?></option>
                                          </select>
                                      </div>
                                      <div class="col-sm-2" style="padding: 0 1px">
                                          <button type="button" onclick="window['add' + $('#gallery-type').val()]();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                                      </div>
                              </td>
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
  <script type="text/javascript"><!--
// Category
$('input[name=\'blog_category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=cms/blog_category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					manufacturer_id: 0,
					name: '<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['blog_category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'blog_category\']').val(item['label']);
		$('input[name=\'blog_category_id\']').val(item['value']);
	}
});
//--></script> 

  <script type="text/javascript"><!--
  
  // Product Related
$('input[name=\'prelated\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'prelated\']').val('');

		$('#product-related' + item['value']).remove();

		$('#product-related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_related[]" value="' + item['value'] + '" /></div>');
	}
});

$('#product-related').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script>


  <script type="text/javascript"><!--
  
  // Blog Related
$('input[name=\'brelated\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=cms/blog/autocomplete&token=<?php echo $token; ?>&filter_title=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['title'],
						value: item['blog_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'brelated\']').val('');

		$('#blog-related' + item['value']).remove();

		$('#blog-related').append('<div id="blog-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="blog_related[]" value="' + item['value'] + '" /></div>');
	}
});

$('#blog-related').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script>

  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script>

<script type="text/javascript"><!--
    var gallery_row = <?php echo $gallery_row; ?>;

    function addImage() {
        html  = '<tr id="gallery-row' + gallery_row + '">';
        html += '  <td class="text-left"><a href="" id="thumb-image' + gallery_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /><input type="hidden" name="article_gallery[' + gallery_row + '][path]" value="" id="input-image' + gallery_row + '" /></td>';
        html += '  <td class="text-center"><input type="text" name="article_gallery[' + gallery_row + '][width]" value="" placeholder="<?php echo $entry_width; ?>" class="form-control" /></td>';
        html += '  <td class="text-center"><input type="text" name="article_gallery[' + gallery_row + '][height]" value="" placeholder="<?php echo $entry_height; ?>" class="form-control" /></td>';
        html += '  <td class="text-right"><input type="text" name="article_gallery[' + gallery_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
        html += '  <td class="text-center"><input type="hidden" name="article_gallery[' + gallery_row + '][type]" value="IMG" /><?php echo $entry_image ?></td>';
        html += '  <td class="text-center"><button type="button" onclick="$(\'#gallery-row' + gallery_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#images tbody').append(html);

        gallery_row++;
    }
    function addYoutube() {
        html  = '<tr id="gallery-row' + gallery_row + '">';
        html += '  <td class="text-left"><input type="text" name="article_gallery[' + gallery_row + '][path]" value="" id="input-image' + gallery_row + '" class="form-control" /></td>';
        html += '  <td class="text-center"><input type="text" name="article_gallery[' + gallery_row + '][width]" value="" placeholder="<?php echo $entry_width; ?>" class="form-control" /></td>';
        html += '  <td class="text-center"><input type="text" name="article_gallery[' + gallery_row + '][height]" value="" placeholder="<?php echo $entry_height; ?>" class="form-control col-xs-2" /></td>';
        html += '  <td class="text-right"><input type="text" name="article_gallery[' + gallery_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
        html += '  <td class="text-center"><input type="hidden" name="article_gallery[' + gallery_row + '][type]" value="YOUTUBE" /><?php echo $entry_youtube ?></td>';
        html += '  <td class="text-center"><button type="button" onclick="$(\'#gallery-row' + gallery_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#images tbody').append(html);

        gallery_row++;
    }
    function addSoundCloud() {
        html  = '<tr id="gallery-row' + gallery_row + '">';
        html += '  <td class="text-left"><input type="text" name="article_gallery[' + gallery_row + '][path]" value="" id="input-image' + gallery_row + '" class="form-control" /></td>';
        html += '  <td class="text-center"><input type="text" name="article_gallery[' + gallery_row + '][width]" value="" placeholder="<?php echo $entry_width; ?>" class="form-control" /></td>';
        html += '  <td class="text-center"><input type="text" name="article_gallery[' + gallery_row + '][height]" value="" placeholder="<?php echo $entry_height; ?>" class="form-control" /></td>';
        html += '  <td class="text-right"><input type="text" name="article_gallery[' + gallery_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
        html += '  <td class="text-center"><input type="hidden" name="article_gallery[' + gallery_row + '][type]" value="SOUNDCLOUD" /><?php echo $entry_soundcloud ?></td>';
        html += '  <td class="text-center"><button type="button" onclick="$(\'#gallery-row' + gallery_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#images tbody').append(html);

        gallery_row++;
    }
//--></script> 
    

  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
<?php echo $footer; ?> 