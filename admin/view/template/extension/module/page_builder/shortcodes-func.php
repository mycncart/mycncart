<?php
function add_ytshortcode($shortcode) {
	require_once 'shortcodes'.DIRECTORY_SEPARATOR.$shortcode.DIRECTORY_SEPARATOR.'shortcode.php';
}

function ytshortcode_atts($pairs, $atts) {
	$atts =(array)$atts;
	$out  = array();
	
	foreach($pairs as $name => $default) {
		if(array_key_exists($name, $atts))
			$out[$name] = $atts[$name];
		else
			$out[$name] = $default;
	}
	return $out;
}
function yt_parse_args( $args, $defaults = '' ) {
	if ( is_object( $args ) )
		$r = get_object_vars( $args );
	elseif ( is_array( $args ) )
		$r =& $args;
	if ( is_array( $defaults ) )
		return array_merge( $defaults, $r );
	return $r;
}

function get_slides($args,$database) {
	$args = yt_parse_args($args, array(
		'source'   => 'none',
		'limit'    => 20,
		'gallery'  => null,
		'type'     => '',
		'order'    => '',
		'order_by' => 'desc',
		'link'     => 'attachment'
	));
	// Prepare empty array for slides
	$slides = array();
	$results = array();
	// Loop through source types
	foreach (array('media', 'category') as $type)
		if (strpos(trim($args['source']), $type . ':') === 0) {
			$args['source'] = array(
				'type' => $type,
				'val' => (string) trim(str_replace(array($type . ':', ' '), '', $args['source']), ',')
			);
			break;
		}
	// Source is not parsed correctly, return empty array
	if (!is_array($args['source']))
		return $slides;
	// Source: media
	if ($args['source']['type'] === 'media') {
		$images = (array) explode(',', $args['source']['val']);
		foreach ($images as $post) {

			$slide = array(
				'image' => $post,
				'link' 	=> $post,
				'url' 	=> $post,
				'title' => '',
				'text' 	=> $post
			);
			if ($args['link'] === 'image') {
				$slide['link'] = $slide['image'];
			}
			$slides[] = $slide;
		}
		return $slides;
	}
	//end media
	
	// Source: category
	elseif ($args['source']['type'] === 'category') {
		$results = $database['list_image'];
	}
	// Loop through posts
	if (is_array($results))
		foreach ($results as $item) {
			$slide = array(
				'id'        	=> $item['product_id'],
				'product_id'	=> $item['product_id'],	
				'title'     	=> $item['name'],
				'introtext' 	=> $item['description'],
				'image'     	=> $item['thumb'],
				'rating'		=> $item['rating'],
				'price'       	=> $item['price'],
				'special'     	=> $item['special'],
				'tax'         	=> $item['tax'],
				'rating'      	=> $item['rating'],
				'link'      	=> $item['href'],
			); 
			$slides[] = $slide;
		}
	// Return slides

	return $slides;
}
function resize($filename, $width, $height) {
	if (!is_file(DIR_IMAGE . $filename)) {
		return;
	}

	$extension = pathinfo($filename, PATHINFO_EXTENSION);

	$old_image = $filename;
	$new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

	if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
		$path = '';

		$directories = explode('/', dirname(str_replace('../', '', $new_image)));

		foreach ($directories as $directory) {
			$path = $path . '/' . $directory;

			if (!is_dir(DIR_IMAGE . $path)) {
				@mkdir(DIR_IMAGE . $path, 0777);
			}
		}

		list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

		if ($width_orig != $width || $height_orig != $height) {
			$image = new Image(DIR_IMAGE . $old_image);
			$image->resize($width, $height);
			$image->save(DIR_IMAGE . $new_image);
		} else {
			copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
		}
	}
	return $new_image;
}
function yt_alert_box($content, $alert_type = 'info', $close_button = false) {
    $close = ($close_button) ? '<button type="button" class="close" data-dismiss="alert">&times;</button>' : '';
    $dismissible = ($close_button) ? 'alert-dismissible' : '';
    return '<div class="alert alert-' . $alert_type . ' ' . $dismissible . ' " role="alert">' . $close . $content . '</div>';
}
function yt_image_media($image) {
    if (strpos($image, 'http://') === false && strpos($image, 'https://') === false) {
        return 'image/' . $image;
    } else {
        return $image;
    }
}
function yt_lib_lighten($args) {
        list($color, $delta) = yt_colorArgs($args);

        $hsl    = toHSL($color);
        $hsl[3] = clamp($hsl[3] + $delta, 100);
        return toRGB($hsl);
    }
function yt_lighten($color, $pc = '5%'){
        $pc   = str_replace('%', '', $pc);
        $args = array('list', ',', array(_yt_hexToRgb($color), array('%', $pc)));
        $rgb  = array_slice(yt_lib_lighten($args), 1);

        return rgbaToHex(yt_lib_lighten($args));
    }
function yt_get_plugin_color( $color, $opacity = null ) {

    if ( in_array( $color, array( "warning", "error", "success", "info", "inverse", "muted", "primary", "boxed" ) ) ) {
        if ( $color == "primary" ) {
            $color = "main"; // main color is primary color
        } else if ( $color == "muted" || empty( $color ) ) {
            $color = "boxed"; // boxed color is muted color
        } else if ( $color == "danger" ) {
            $color = "error";
        }

        $color = $intense_visions_options['intense_' . $color . '_color'];
    }

    if ( isset( $opacity ) ) {
      $color = yt_get_rgb_color( $color, $opacity );
    }

    return $color;
}
function yt_get_rgb_color( $hexcolor, $opacity = null ) {
    $returnRGB = '';
    $hex = str_replace( "#", "", $hexcolor );
    $a = 0;

    if ( isset( $opacity ) && $opacity > 1 ) {
        $a = $opacity / 100;
    }

    if ( strlen( $hex ) == 3 ) {
        $r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
        $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
        $b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
    } else {
        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );
    }

    if ( isset( $opacity ) ) {
        $returnRGB = "rgba(" . $r . "," . $g . "," . $b . "," . $a . ")";
    } else {
        $returnRGB = "rgb(" . $r . "," . $g . "," . $b . ")";
    }

    return $returnRGB;
}
function yt_coalesce() {
  $args = func_get_args();
  foreach ( $args as $arg ) {
    if ( !empty( $arg ) ) {
      return $arg;
    }
  }
  return $args[0];
}

function yt_coalesce_isset() {
  $args = func_get_args();
  foreach ( $args as $arg ) {
    if ( isset( $arg ) ) {
      return $arg;
    }
  }
  return $args[0];
}
function yt_all_images($post) {

    $images = array();
    preg_match_all('/(img|src)\=(\"|\')[^\"\'\>]+/i', $post, $media);
    unset($post);
    $post=preg_replace('/(img|src)(\"|\'|\=\"|\=\')(.*)/i',"$3",$media[0]);
    foreach($post as $url)
    {
        $info = pathinfo($url);
        if (isset($info['extension']))
        {
            if (($info['extension'] == 'jpg') || ($info['extension'] == 'jpeg') || ($info['extension'] == 'gif') || ($info['extension'] == 'png'))
            array_push($images, $url);
        } else {
            return false;
        }
    }

    return $images;
}
function _yt_hexToRgb($hexStr, $returnAsString = false, $seperator = ',') {
	$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
	$rgbArray = array();
	$rgbArray[] = 'color';
	if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
		$colorVal = hexdec($hexStr);
		$rgbArray[] = 0xFF & ($colorVal >> 0x10);
		$rgbArray[] = 0xFF & ($colorVal >> 0x8);
		$rgbArray[] = 0xFF & $colorVal;
	} elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
		$rgbArray[] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
		$rgbArray[] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
		$rgbArray[] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
	} else {
		return false; //Invalid hex color code
	}

	return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}
function yt_colorArgs($args) {
	if ($args[0] != 'list' || count($args[2]) < 2) {
		return array(array('color', 0, 0, 0));
	}
	list($color, $delta) = $args[2];
	if ($color[0] != 'color')
		$color = array('color', 0, 0, 0);

	$delta = floatval($delta[1]);

	return array($color, $delta);
}
function toHSL($color) {
	if ($color[0] == 'hsl') return $color;

	$r = $color[1] / 255;
	$g = $color[2] / 255;
	$b = $color[3] / 255;

	$min = min($r, $g, $b);
	$max = max($r, $g, $b);

	$L = ($min + $max) / 2;
	if ($min == $max) {
		$S = $H = 0;
	} else {
		if ($L < 0.5)
			$S = ($max - $min)/($max + $min);
		else
			$S = ($max - $min)/(2.0 - $max - $min);

		if ($r == $max) $H = ($g - $b)/($max - $min);
		elseif ($g == $max) $H = 2.0 + ($b - $r)/($max - $min);
		elseif ($b == $max) $H = 4.0 + ($r - $g)/($max - $min);

	}

	$out = array('hsl',
		($H < 0 ? $H + 6 : $H)*60,
		$S*100,
		$L*100,
	);

	if (count($color) > 4) $out[] = $color[4]; // copy alpha
	return $out;
}
function clamp($v, $max = 1, $min = 0) {
        return min($max, max($min, $v));
    }
function toRGB_helper($comp, $temp1, $temp2) {
        if ($comp < 0) $comp += 1.0;
        elseif ($comp > 1) $comp -= 1.0;

        if (6 * $comp < 1) return $temp1 + ($temp2 - $temp1) * 6 * $comp;
        if (2 * $comp < 1) return $temp2;
        if (3 * $comp < 2) return $temp1 + ($temp2 - $temp1)*((2/3) - $comp) * 6;

        return $temp1;
    }
function toRGB($color) {
        if ($color == 'color') return $color;

        $H = $color[1] / 360;
        $S = $color[2] / 100;
        $L = $color[3] / 100;

        if ($S == 0) {
            $r = $g = $b = $L;
        } else {
            $temp2 = $L < 0.5 ?
                $L*(1.0 + $S) :
                $L + $S - $L * $S;

            $temp1 = 2.0 * $L - $temp2;

            $r = toRGB_helper($H + 1/3, $temp1, $temp2);
            $g = toRGB_helper($H, $temp1, $temp2);
            $b = toRGB_helper($H - 1/3, $temp1, $temp2);
        }

        $out = array('color', round($r*255), round($g*255), round($b*255));
        if (count($color) > 4) $out[] = $color[4]; // copy alpha
        return $out;
    }
function lib_darken($args) {
	list($color, $delta) = yt_colorArgs($args);

	$hsl = toHSL($color);
	$hsl[3] = clamp($hsl[3] - $delta, 100);
	return toRGB($hsl);
}
function rgbaToHex($color) {
        if ($color[0] != 'color')
            throw new exception("color expected for rgbahex");

        return sprintf("#%02x%02x%02x",
            $color[1],$color[2], $color[3]);
    }
function darken($color, $pc = '5%'){
        $pc = str_replace('%', '', $pc);
        $args = array('list', ',', array(_yt_hexToRgb($color), array('%', $pc)));
        $rgb = array_slice(lib_darken($args), 1);

        return rgbaToHex(lib_darken($args));
    }
function yt_acssc($classes) {
    $classes = implode($classes, ' ');
    $abs_classes = trim(preg_replace('/\s\s+/', ' ', $classes));
    return $abs_classes;
}
// Character limit
function yt_char_limit($str, $limit = 150, $end_char = '...') {
    if (trim($str) == '')
        return $str;

    // always strip tags for text
    $str = strip_tags(trim($str));

    $find = array("/\r|\n/u", "/\t/u", "/\s\s+/u");
    $replace = array(" ", " ", " ");
    $str = preg_replace($find, $replace, $str);
	
    if (strlen($str) > $limit)
    {
        $str = substr($str, 0, $limit);       
        return rtrim($str).'...';  
    }
    else
    {
        return $str;
    }

}
?>