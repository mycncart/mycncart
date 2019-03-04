<?php 
Class YT_Field_Shortcodes{	
public static function formField($id,$field=array(),$database)
	{
		$html = '';
		$type = $field['type'];
		switch ($type)
		{	
/*  /////////////////////////////// #media /////////////////////////////////// */
			case 'media':
				if($field['default'] == ""){
					$field['default'] = "no_image.png";
				}
				$html .= '<a href="" id="thumb-image'.$database['dem'].'" data-toggle="image" class="img-thumbnail thumb-image"><img src="'.$database['url'].'image/'.resize($field['default'], 100, 100).'" alt="" title="" data-placeholder="'.$database['url'].'image/'.resize('no_image.png', 100, 100).'" width="100" height="100" /></a><input class="form-control imageuploaded yt-generator-attr uploadimage" type="hidden" data-base="'.$database['url'].'"  name="'.$id.'" id="uploadimage'.$database['dem'].'" value="'.$field['default'].'"/>';
			break;	
/*  /////////////////////////////// #text /////////////////////////////////// */
			case 'text':
				$html .= '<input type="text" name="' . $id . '" value="' . $field['default'] . '" id="yt-generator-attr-' . $id . '" class="yt-generator-attr" />';
			break;			
/*  /////////////////////////////// #text /////////////////////////////////// */
			case 'textLanguage':
				$html .= '<ul class="nav nav-tabs language">';
				$liFirst = 1;
					foreach ($database['languages'] as $language) { 
				if($liFirst == 1){
					$html .= '<li class="active">';
				}else{
					$html .= '<li>';
				}
				$html .= '<a href=".language'.$language['language_id'].'_'.$id.'" data-toggle="tab">';
							$html .= '<img src="language/'.$language['code'].'/'.$language['code'].'.png" title="'.$language['name'].'" />';
							$html .= ' '.$language['name'];
						$html .= '</a>';
				$html .= '</li>';
				$liFirst++;
					}
				$html .= '</ul>';
				$html .= '<div class="tab-content">';
				$tabContent = 1;
				foreach ($database['languages'] as $language) {
					$valueText = isset($field['values'][$id.'_'.$language['language_id']]) ? $field['values'][$id.'_'.$language['language_id']] : '';
					if($tabContent == 1){
						$html .= '<div class="tab-pane language'.$language['language_id'].'_'.$id.' active">';
					}else{
						$html .= '<div class="tab-pane language'.$language['language_id'].'_'.$id.'">';
					}
					$html .= '<input type="text" name="'.$id.'_'.$language['language_id'].'" value="'.$valueText.'" class="yt-generator-attr-'.$id.'_'.$language['language_id'].' yt-generator-attr" />';
					$html .= '</div>';
					$tabContent++;
				}
				$html .= '</div>';
			break;
			
/*  /////////////////////////////// #textarea /////////////////////////////// */
			case 'textarea':
				$html = '<textarea name="' . $id . '" rows="3" class="yt-generator-attr-'.$id.' yt-generator-attr">' .  $field['default']  . '</textarea>';
			break;
/*  /////////////////////////////// #textarea Editor/////////////////////////////// */
			case 'textareaEditor':
				$html = '<textarea name="' . $id . '" rows="3" class="yt-generator-attr-'.$id.' yt-generator-attr summernote">' .  $field['default']  . '</textarea>';
			break;
/*  /////////////////////////////// #textarea Editor Language /////////////////////////////// */
			case 'textareaEditorLanguage':
				$html .= '<ul class="nav nav-tabs language">';
				$liFirst = 1;
				foreach ($database['languages'] as $language) { 
					if($liFirst == 1){
						$html .= '<li class="active">';
					}else{
						$html .= '<li>';
					}
					$html .= '<a href=".language'.$language['language_id'].'_'.$id.'" data-toggle="tab">';
						$html .= '<img src="language/'.$language['code'].'/'.$language['code'].'.png" title="'.$language['name'].'" />';
						$html .= ' '.$language['name'];
					$html .= '</a>';
					$html .= '</li>';
					$liFirst++;
				}
				$html .= '</ul>';
				$html .= '<div class="tab-content">';
				$tabContent = 1;
				foreach ($database['languages'] as $language) {
					$valueText = isset($field['values'][$id.'_'.$language['language_id']]) ? $field['values'][$id.'_'.$language['language_id']] : '';
					if($tabContent == 1){
						$html .= '<div class="tab-pane language'.$language['language_id'].'_'.$id.' active">';
					}else{
						$html .= '<div class="tab-pane language'.$language['language_id'].'_'.$id.'">';
					}	
					$html .= '<textarea name="'.$id.'_'.$language['language_id'].'" rows="3" class="yt-generator-attr-'.$id.'_'.$language['language_id'].' yt-generator-attr summernote">' . $valueText . '</textarea>';
					$html .= '</div>';
					$tabContent++;
				}
				$html .= '</div>';
			break;		
/*  /////////////////////////////// #color ////////////////////////////////// */
			case 'color':
				$html .= '<span class="yt-generator-select-color"><span class="yt-generator-select-color-wheel"></span><input type="text" name="' . $id . '" value="' . $field['default'] . '" id="yt-generator-attr-' . $id . '" class="yt-generator-attr yt-generator-select-color-value" /> </span>';
			break;
			
/*  /////////////////////////////// #select //////////////////////////////// */
			case 'select':
				$multiple = ( isset( $field['multiple'] ) ) ? ' multiple' : '';
				$class = (isset($field['class'])) ? $field['class'] : '';
				$html .= "<select name='" . $id . "' id='yt-generator-attr-" . $id . "' class='yt-generator-attr ".$class."'" . $multiple . " >";
				foreach($field['values'] as $option_value => $option_title){
					$selected = ($option_value == $field['default'] ? 'selected="selected"' : '' );
						$html .= '<option value="'.$option_value.'" ' . $selected . '>'.$option_title.'</option>';
					}
				$html .= "</select>";
			break;
			
/*  /////////////////////////////// #bool ///////////////////////////////// */
			case 'bool':
				$html .= '<span class="yt-generator-switch yt-generator-switch-' . $field['default'] . '"><span class="yt-generator-yes">'.$database['language']->get('shortcode_yes').'</span><span class="yt-generator-no">'.$database['language']->get('shortcode_no').'</span></span><input type="hidden" name="' . $id . '" value="' . $field['default'] . '" id="yt-generator-attr-' . $id . '" class="yt-generator-attr yt-generator-switch-value" />';
			break;
			
/*  /////////////////////////////// #slider ///////////////////////////////// */
			case 'slider':
				$html .= '<div class="yt-generator-range-picker yt-generator-clearfix"><input type="number" name="' . $id . '" value="' . $field['default'] . '" id="yt-generator-attr-' . $id . '" min="' . $field['min'] . '" max="' . $field['max'] . '" step="' . $field['step'] . '" class="yt-generator-attr" /></div>';
			break;
			
/*  /////////////////////////////// #border ///////////////////////////////// */
			case 'border':
				$defaults = ($field['default'] === 'none' ) ? array ('0', 'solid', '#000000') : explode(' ', str_replace( 'px', '', $field['default']));
				$border = YT_Data::borders_style($database['language']);
				$borders ='';
					$borders .= '<select class="yt-generator-bp-style">';
					foreach ($border as $option_value => $option_title)
					{
						$selected = ($defaults[1] == $option_value) ? 'selected' : '';
						$borders .= '<option value="'.$option_value.'" '.$selected.'>'.$option_title.'</option>';
					}
					$borders .='</select>';
					$html .= '<div class="yt-generator-border-picker"><span class="yt-generator-border-picker-field"><input type="number" min="-1000" max="1000" step="1" value="'.$defaults[0].'" class="yt-generator-bp-width" /><small>'.$database['language']->get('shortcode_border_width').'</small></span><span class="yt-generator-border-picker-field">' . $borders . '<small> '.$database['language']->get('shortcode_border_style').'</small></span><span class="yt-generator-border-picker-field yt-generator-border-picker-color"><span class="yt-generator-border-picker-color-wheel"></span><input type="text" value="'.$defaults[2].'" class="yt-generator-border-picker-color-value" /><small>'.$database['language']->get('shortcode_border_color').'</small></span><input type="hidden" name="' . $id . '" value="' .  $field['default'] . '" id="yt-generator-attr-' . $id . '" class="yt-generator-attr" /></div>';
			break;
			
/*  /////////////////////////////// #shadow /////////////////////////////// */
			case 'shadow':
				$defaults = ( $field['default'] === 'none' ) ? array ('0', '0', '0', '#000000') : explode(' ', str_replace( 'px', '', $field['default']));
				$html .= '<div class="yt-generator-shadow-picker"><span class="yt-generator-shadow-picker-field"><input type="number" min="-1000" max="1000" step="1" value="' . $defaults[0] . '" class="yt-generator-sp-hoff" /><small>'.$database['language']->get('shortcode_shadow_horizontal').'</small></span><span class="yt-generator-shadow-picker-field"><input type="number" min="-1000" max="1000" step="1" value="' . $defaults[1] . '" class="yt-generator-sp-voff" /><small>'.$database['language']->get('shortcode_shadow_vertical').'</small></span><span class="yt-generator-shadow-picker-field"><input type="number" min="-1000" max="1000" step="1" value="' . $defaults[2] . '" class="yt-generator-sp-blur" /><small>'.$database['language']->get('shortcode_shadow_blur').'</small></span><span class="yt-generator-shadow-picker-field yt-generator-shadow-picker-color"><span class="yt-generator-shadow-picker-color-wheel"></span><input type="text" value="' . $defaults[3] . '" class="yt-generator-shadow-picker-color-value" /><small>'.$database['language']->get('shortcode_shadow_color').'</small></span><input type="hidden" name="' . $id . '" value="' .  $field['default']  . '" id="yt-generator-attr-' . $id . '" class="yt-generator-attr" /></div>';
			break;
			
/* 	/////////////////////////////// #number ///////////////////////////////// */
			case 'number':
				$html .= '<input type="number" name="' . $id . '" value="' . $field['default'] . '" id="yt-generator-attr-' . $id . '" min="' . $field['min'] . '" max="' . $field['max'] . '" step="' . $field['step'] . '" class="yt-generator-attr" />';
			break;
			
/*  /////////////////////////////// #note /////////////////////////////////// */
			case 'note':
				$html .= '<span>' . $field['default']  . '</span><input style="display: none;" type="text" name="' . $id . '" value="' .  $field['default']  . '" id="yt-generator-attr-' . $id . '" class="yt-generator-attr" />';	
			break;
			
/*  /////////////////////////////// #icon /////////////////////////////// */
			case 'icon':
				$icons = YT_Data::icons();
				$rand=time();
				$html .= '<div class="yt-generator-icon-picker-wrapper">
							<input type="text" name="' . $id . '" value="' .  $field['default']  . '" id="yt-generator-attr-' . $id . '" class="yt-generator-attr yt-generator-icon-picker-value" />
							<div class="yt-generator-field-actions">
								<a href="javascript:;" class="yt_btn yt_btn-warning yt-generator-icon-picker-button yt-generator-field-action">
									<i class="fa fa-magic"></i>'.$database['language']->get('shortcode_icon_picker').'
								</a>
							</div>
						</div>
						<div class="yt-generator-icon-picker yt-generator-clearfix ">
							<input type="text" class="yt-icon-picker-search" placeholder="'.$database['language']->get('shortcode_icon_filter').'" />';
							foreach($icons as $icon)
							{
								$html .='<i style="display: block;" class="fa fa-'.$icon.'" title="'.$icon.'"></i>';
							}
			$html .='</div>';
			break;
			
/*  /////////////////////////////// #livicon /////////////////////////////// */
			case 'livicon':
				$livicons = YT_Data::livicons();
				$html .= '<select name="icon" id="yt-generator-attr-icon" class="yt-generator-attr">';
				foreach ($livicons as $livicon)
				{
					$selected = ($livicon == $field['default'] ) ? ' selected="selected"' : '';
					$html .= '<option value="'.$livicon.'" ' . $selected . '>'.$livicon.'</option>';	
				}
				$html .= '</select>';
			break;
			
/*  /////////////////////////////// #source /////////////////////////////// */
			case 'source':
				$valSource = "none";
				$slides = array();
				$catid = array();
				$valInput = $field['default'];
				$classOpenMedia = "";
				$classOpenCategory = "";
				// Loop through source types
				foreach (array('media', 'category') as $type)
				if (strpos(trim($field['default']), $type . ':') === 0) {
					$field['default'] = array(
						'type' => $type,
						'val' => (string) trim(str_replace(array($type . ':', ' '), '', $field['default']), ',')
					);
					break;
				}
				// Source: media
				if (isset($field['default']['type']) && $field['default']['type'] == 'media') {
					$images = (array) explode(',', $field['default']['val']);
					foreach ($images as $post) {

						$slide = array(
							'image' => $post,
							'link' 	=> $post,
							'url' 	=> $post,
							'title' => '',
							'text' 	=> $post
						);
						$slides[] = $slide;
					}
					$classOpenMedia = "yt-generator-isp-source-open";
				}
				
				// Source: category
				elseif (isset($field['default']['type']) && $field['default']['type'] == 'category') {
					$catid = (array) explode(',', $field['default']['val']);
					$classOpenCategory = "yt-generator-isp-source-open";
				}
				if($classOpenMedia == '' && $classOpenCategory == '')
				{
					$classOpenMedia = "yt-generator-isp-source-open";
				}
				$sources = "<select class='yt-generator-isp-sources' style='min-height:150px'>";
					if(isset($field['default']['type']) && $field['default']['type'] == "category")
					{
						$sources .= '<option selected="selected" value="category" >'.$database['language']->get('shortcode_source_category').'</option>';
						$sources .= '<option value="media" >'.$database['language']->get('shortcode_source_media').'</option>';
					}else
					{
						$sources .= '<option value="category" >'.$database['language']->get('shortcode_source_category').'</option>';
						$sources .= '<option selected="selected" value="media" >'.$database['language']->get('shortcode_source_media').'</option>';
					}
				$sources .= "</select>";
				$categories_arr = $database['category'];
				$categories = '<select class="yt-generator-isp-categories" multiple>';
					foreach ($categories_arr as $option_value)
					{
						$selected = ($catid != '' && in_array($option_value['category_id'], $catid) ? "selected='selected'" : "");
						$categories .= '<option '.$selected.' value="'.$option_value['category_id'].'">'.$option_value['name'].'</option>';
					}
				$categories .= '</select>';
				$html  .= '<div class="yt-generator-isp">' . $sources;
					$html .= '<div class="yt-generator-isp-source yt-generator-isp-source-media '.$classOpenMedia.'">';
		        		$html .= '<div class="yt-generator-clearfix">';
		        			$html .= '<a class="yt_btn button button-primary yt-generator-isp-add-media" title="Select image">';
		        				$html .= '<i class="fa fa-plus"></i>&nbsp;&nbsp;'.$database['language']->get('shortcode_source_add_image').'';
		    				$html .= '</a>';
		        		$html .= '</div>';
						$html .= '<div id="yt-generator-attr-image" class="yt-generator-isp-images yt-generator-clearfix">';
						if($slides != '')
						{
							$key = "";
							foreach($slides as $slide)
							{
								$key = rand().time();
								$image = resize($slide['image'], 100, 100);
								$placeholder = resize('no_image.png', 100, 100);
								$html .= '<span><a class="img-thumbnail" data-toggle="image" id="thumb-image'.$key.'" href=""><img width="100" height="100" data-placeholder="'.HTTP_CATALOG.'image/'.$placeholder.'" title="" alt="" src="'.HTTP_CATALOG.'image/'.$image.'"></a><input type="hidden" id="uploadimage'.$key.'" name="media_image{}" data-base="'.HTTP_CATALOG.'image/" value="'.$slide['image'].'" class="form-control"><i class="fa fa-times"></i></span>';
							}
						}
						$html .= '</div>';
						$html .= '<em class="description">'.$database['language']->get('shortcode_source_add_image_desc').'</em>';
					$html .= '</div>';
					$html .= '<div class="yt-generator-isp-source yt-generator-isp-source-category '.$classOpenCategory.'">';
						$html .= '<em class="description">'.$database['language']->get('shortcode_source_category_desc').'</em>';
						$html .= $categories;
					$html .= '</div>';
					$html .= '<input type="hidden" name="' . $id . '" value="' . $valInput . '" id="yt-generator-attr-' . $id . '" class="yt-generator-attr" />';
				$html .= '</div>';
			break;
/*  /////////////////////////////// #source image /////////////////////////////// */
			case 'source_image':
				$slides = array();
				$catid = array();
				$valInput = $field['default'];
				// Loop through source types
				foreach (array('media', 'category') as $type)
				if (strpos(trim($field['default']), $type . ':') === 0) {
					$field['default'] = array(
						'type' => $type,
						'val' => (string) trim(str_replace(array($type . ':', ' '), '', $field['default']), ',')
					);
					break;
				}
				// Source: media
				if (isset($field['default']['type']) && $field['default']['type'] == 'media') {
					$images = (array) explode(',', $field['default']['val']);
					foreach ($images as $post) {

						$slide = array(
							'image' => $post,
							'link' 	=> $post,
							'url' 	=> $post,
							'title' => '',
							'text' 	=> $post
						);
						$slides[] = $slide;
					}
				}
				$inputHidden = '<input name="source" type="hidden" class="yt-generator-isp-sources" value="media">';
				$html  .= '<div class="yt-generator-isp">'.$inputHidden;
					$html .= '<div class="yt-generator-isp-source yt-generator-isp-source-media yt-generator-isp-source-open">';
		        		$html .= '<div class="yt-generator-clearfix">';
		        			$html .= '<a class="yt_btn button button-primary yt-generator-isp-add-media" title="Select image">';
		        				$html .= '<i class="fa fa-plus"></i>&nbsp;&nbsp;'.$database['language']->get('shortcode_source_add_image').'';
		    				$html .= '</a>';
		        		$html .= '</div>';
						$html .= '<div id="yt-generator-attr-image" class="yt-generator-isp-images yt-generator-clearfix">';
						if($slides != '')
						{
							$key = "";
							foreach($slides as $slide)
							{
								$key = rand().time();
								$image = resize($slide['image'], 100, 100);
								$placeholder = resize('no_image.png', 100, 100);
								$html .= '<span><a class="img-thumbnail" data-toggle="image" id="thumb-image'.$key.'" href=""><img width="100" height="100" data-placeholder="'.HTTP_CATALOG.'image/'.$placeholder.'" title="" alt="" src="'.HTTP_CATALOG.'image/'.$image.'"></a><input type="hidden" id="uploadimage'.$key.'" name="media_image{}" data-base="'.HTTP_CATALOG.'image/" value="'.$slide['image'].'" class="form-control"><i class="fa fa-times"></i></span>';
							}
						}
						$html .= '</div>';
						$html .= '<em class="description">'.$database['language']->get('shortcode_source_add_image_desc').'</em>';
					$html .= '</div>';
					$html .= '<input type="hidden" name="' . $id . '" value="' . $valInput . '" id="yt-generator-attr-' . $id . '" class="yt-generator-attr" />';
				$html .= '</div>';
			break;
/*  /////////////////////////////// #source product/////////////////////////////// */
			case 'source_product':
				$slides = array();
				$catid = array();
				$valInput = $field['default'];
				// Loop through source types
				foreach (array('media', 'category') as $type)
				if (strpos(trim($field['default']), $type . ':') === 0) {
					$field['default'] = array(
						'type' => $type,
						'val' => (string) trim(str_replace(array($type . ':', ' '), '', $field['default']), ',')
					);
					break;
				}
				// Source: category
				if (isset($field['default']['type']) && $field['default']['type'] == 'category') {
					$catid = (array) explode(',', $field['default']['val']);
				}
				$categories_arr = $database['category'];
				$categories = '<select class="yt-generator-isp-categories" style="min-height:150px" multiple>';
					foreach ($categories_arr as $option_value)
					{
						$selected = ($catid != '' && in_array($option_value['category_id'], $catid) ? "selected='selected'" : "");
						$categories .= '<option '.$selected.' value="'.$option_value['category_id'].'">'.$option_value['name'].'</option>';
					}
				$categories .= '</select>';
				$inputHidden = '<input name="source" type="hidden" class="yt-generator-isp-sources" value="category">';
				$html  .= '<div class="yt-generator-isp">'.$inputHidden;
					$html .= '<div class="yt-generator-isp-source yt-generator-isp-source-category yt-generator-isp-source-open">';
						$html .= '<em class="description">'.$database['language']->get('shortcode_source_category_desc').'</em>';
						$html .= $categories;
					$html .= '</div>';
					$html .= '<input type="hidden" name="' . $id . '" value="' . $valInput . '" id="yt-generator-attr-' . $id . '" class="yt-generator-attr" />';
				$html .= '</div>';
			break;
		}
		return $html;
	}
}
?>