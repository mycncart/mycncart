{{ header }} {{ column_left }} 
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-press" data-toggle="tooltip" title="{{ button_save }} " class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="{{ cancel }} " data-toggle="tooltip" title="{{ button_cancel }} " class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1>{{ heading_title }} </h1>
      <ul class="breadcrumb">
        {% for breadcrumb in breadcrumbs %} 
        <li><a href="{{ breadcrumb.href }} ">{{ breadcrumb.text }} </a></li>
        {% endfor %} 
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    {% if error_warning %} 
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> {{ error_warning }} 
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    {% endif %} 
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> {{ text_form }} </h3>
      </div>
      <div class="panel-body">
        <form action="{{ action }} " method="post" enctype="multipart/form-data" id="form-press" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">{{ tab_general }} </a></li>
            <li><a href="#tab-data" data-toggle="tab">{{ tab_data }} </a></li>
            <li><a href="#tab-links" data-toggle="tab">{{ tab_links }} </a></li>
            <li><a href="#tab-design" data-toggle="tab">{{ tab_design }} </a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                {% for language in languages %} 
                <li><a href="#language{{ language.language_id }} " data-toggle="tab"><img src="language/{{ language.code }} /{{ language.code }} .png" title="{{ language.name }} " /> {{ language.name }} </a></li>
                {% endfor %} 
              </ul>
              <div class="tab-content">
                {% for language in languages %} 
                <div class="tab-pane" id="language{{ language.language_id }} ">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title{{ language.language_id }} ">{{ entry_title }} </label>
                    <div class="col-sm-10">
                      <input type="text" name="press_description[{{ language.language_id }} ][title]" value="{{ press_description.language.language_id ? press_description.language.language_id.title : }} '' " placeholder="{{ entry_title }} " id="input-title{{ language.language_id }} " class="form-control" />
                      {% if error_title.language.language_id %} 
                      <div class="text-danger">{{ error_title.language.language_id }} </div>
                      {% endif %} 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description{{ language.language_id }} ">{{ entry_description }} </label>
                    <div class="col-sm-10">
                      <textarea name="press_description[{{ language.language_id }} ][description]" placeholder="{{ entry_description }} " class="form-control summernote" id="input-description{{ language.language_id }} ">{{ press_description.language.language_id ? press_description.language.language_id.description : }} '' </textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title{{ language.language_id }} ">{{ entry_meta_title }} </label>
                    <div class="col-sm-10">
                      <input type="text" name="press_description[{{ language.language_id }} ][meta_title]" value="{{ press_description.language.language_id ? press_description.language.language_id.meta_title : '' }} " placeholder="{{ entry_meta_title }} " id="input-meta-title{{ language.language_id }} " class="form-control" />
                      {% if error_meta_title.language.language_id %} 
                      <div class="text-danger">{{ error_meta_title.language.language_id }} </div>
                      {% endif %} 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description{{ language.language_id }} ">{{ entry_meta_description }} </label>
                    <div class="col-sm-10">
                      <textarea name="press_description[{{ language.language_id }} ][meta_description]" rows="5" placeholder="{{ entry_meta_description }} " id="input-meta-description{{ language.language_id }} " class="form-control">{{ press_description.language.language_id ? press_description.language.language_id.meta_description : }} '' </textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword{{ language.language_id }} ">{{ entry_meta_keyword }} </label>
                    <div class="col-sm-10">
                      <textarea name="press_description[{{ language.language_id }} ][meta_keyword]" rows="5" placeholder="{{ entry_meta_keyword }} " id="input-meta-keyword{{ language.language_id }} " class="form-control">{{ press_description.language.language_id ? press_description.language.language_id.meta_keyword : '' }} </textarea>
                    </div>
                  </div>
                </div>
                {% endfor %} 
              </div>
            </div>
            <div class="tab-pane" id="tab-data">
              
              <div class="form-group">
                <label class="col-sm-2 control-label">{{ entry_image }} </label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="{{ thumb }} " alt="" title="" data-placeholder="{{ placeholder }} " /></a>
                  <input type="hidden" name="image" value="{{ image }} " id="input-image" />
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="{{ help_keyword }} ">{{ entry_keyword }} </span></label>
                <div class="col-sm-10">
                  <input type="text" name="keyword" value="{{ keyword }} " placeholder="{{ entry_keyword }} " id="input-keyword" class="form-control" />
                  {% if error_keyword %} 
                  <div class="text-danger">{{ error_keyword }} </div>
                  {% endif %} 
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">{{ entry_status }} </label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    {% if status %} 
                    <option value="1" selected="selected">{{ text_enabled }} </option>
                    <option value="0">{{ text_disabled }} </option>
                    {% endif %} {% else %}   
                    <option value="1">{{ text_enabled }} </option>
                    <option value="0" selected="selected">{{ text_disabled }} </option>
                     
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">{{ entry_sort_order }} </label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="{{ sort_order }} " placeholder="{{ entry_sort_order }} " id="input-sort-order" class="form-control" />
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-links">
              <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-press-category">{{ entry_press_category }} </label>
                  <div class="col-sm-10">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                      {% for press_category in press_categories %} 
                      <div class="checkbox">
                        <label>
                          {% if in_array(press_category.press_category_id, press_press_category ) %}
                          <input type="checkbox" name="press_press_category[]" value="{{ press_category.press_category_id}} " checked="checked" />
                          {{ press_category.name }} 
                          {% endfor %}{% endif %} {% else %}   
                          <input type="checkbox" name="press_press_category[]" value="{{ press_category.press_category_id }} " />
                          {{ press_category.name }} 
                           
                        </label>
                      </div>
                       
                    </div>
                   
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-related">{{ entry_related }} </label>
                  <div class="col-sm-10">
                    <input type="text" name="related" value="" placeholder="{{ entry_related }} " id="input-related" class="form-control" />
                    <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                      {% for product_related in product_relateds %} 
                      <div id="product-related{{ product_related.product_id }} "><i class="fa fa-minus-circle"></i> {{ product_related.name }} 
                        <input type="hidden" name="product_related[]" value="{{ product_related.product_id }} " />
                      </div>
                      {% endfor %} 
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                <label class="col-sm-2 control-label">{{ entry_store }} </label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="height: 150px; overflow: auto;">
                    <div class="checkbox">
                      <label>
                        {% if in_array(0, press_store ) %}
                        <input type="checkbox" name="press_store[]" value="0" checked="checked" />
                        {{ text_default}} 
                        {% endif %} {% else %}   
                        <input type="checkbox" name="press_store[]" value="0" />
                        {{ text_default }} 
                         
                      </label>
                    </div>
                    {% for store in stores %} 
                    <div class="checkbox">
                      <label>
                        {% if in_array(store.store_id, press_store ) %}
                        <input type="checkbox" name="press_store[]" value="{{ store.store_id}} " checked="checked" />
                        {{ store.name }} 
                        {% endfor %}{% endif %} {% else %}   
                        <input type="checkbox" name="press_store[]" value="{{ store.store_id }} " />
                        {{ store.name }} 
                         
                      </label>
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
                      <td class="text-left">{{ entry_store }} </td>
                      <td class="text-left">{{ entry_layout }} </td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left">{{ text_default }} </td>
                      <td class="text-left"><select name="press_layout[0]" class="form-control">
                          <option value=""></option>
                          {% for layout in layouts %} 
                          {% if press_layout.0  and  press_layout.0  is  layout.layout_id %} 
                          <option value="{{ layout.layout_id }} " selected="selected">{{ layout.name }} </option>
                          {% endfor %}{% endif %} {% else %}   
                          <option value="{{ layout.layout_id }} ">{{ layout.name }} </option>
                           
                           
                        </select></td>
                    </tr>
                    {% for store in stores %} 
                    <tr>
                      <td class="text-left">{{ store.title }} </td>
                      <td class="text-left"><select name="press_layout[{{ store.store_id }} ]" class="form-control">
                          <option value=""></option>
                          {% for layout in layouts %} 
                          {% if press_layout.store.store_id  and  press_layout.store.store_id  is  layout.layout_id %} 
                          <option value="{{ layout.layout_id }} " selected="selected">{{ layout.name }} </option>
                          {% endfor %}{% endif %} {% else %}   
                          <option value="{{ layout.layout_id }} ">{{ layout.name }} </option>
                          {% endfor %} 
                           
                        </select></td>
                    </tr>
                     
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 
  <script type="text/javascript"><!--
  // Related
$('input[name=\'related\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token={{ token }} &filter_name=' +  encodeURIComponent(request),
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
		$('input[name=\'related\']').val('');

		$('#product-related' + item['value']).remove();

		$('#product-related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_related[]" value="' + item['value'] + '" /></div>');
	}
});

$('#product-related').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script>

  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
{{ footer }}  