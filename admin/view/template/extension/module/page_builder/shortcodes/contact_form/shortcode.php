<?php 
function contact_formYTShortcode ($atts,$contentC,$module_id,$id,$database){
	$str = '';
	$css = '';
	if($module_id != "0" && $atts->css_internal != ''){
		$css .= "/* Style Contact Form */ \n";
		$css .= $atts->css_internal;
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
		$addstr = '';
		$idman ='';
		$validation_mandatory ='';
	/*------Check isset Value Before Call value---------*/	
		$add_field_ 			= 'add_field_'.$database['language_id'];
		$text_add_field 		= '';
		if(isset($atts->$add_field_) && ($atts->$add_field_ != '')){
			$text_add_field = $atts->$add_field_;
		}
		
		$name_shortcode_		= 'name_shortcode_'.$database['language_id'];
		$text_name_shortcode		= '';
		if(isset($atts->$name_shortcode_) && ($atts->$name_shortcode_ != '')){
			$text_name_shortcode = $atts->$name_shortcode_;
		}
		
		$submit_button_text_		= 'submit_button_text_'.$database['language_id'];
		$text_submit_button		= '';
		if(isset($atts->$submit_button_text_) && ($atts->$submit_button_text_ != '')){
			$text_submit_button = $atts->$submit_button_text_;
		}
	/*--------------------------------------------------*/		
		if($atts->icon_name != ''){
			if (strpos($atts->icon_name, 'icon:') !== false) {
				$atts->icon_name = "<span class='add-on' style='background:".$atts->background_name."; color:".$atts->color_name."'><i class='fa fa-" . trim(str_replace('icon:', '', $atts->icon_name)) . "'></i></span> ";
				}else
				{
					$atts->icon_name = '<span class="add-on" style="background:'.$atts->background_name.'; color:'.$atts->color_name.'"><img src="'.yt_image_media($atts->icon_name).'" style="width:18px" alt="" /></span> ';
				}
		}
		if($atts->icon_email != ''){
			if (strpos($atts->icon_email, 'icon:') !== false) {
				$atts->icon_email = "<span class='add-on' style='background:".$atts->background_name."; color:".$atts->color_name."'><i class='fa fa-" . trim(str_replace('icon:', '', $atts->icon_email)) . "'></i></span> ";
			}else
			{
				$atts->icon_email = '<span class="add-on" style="background:'.$atts->background_name.'; color:'.$atts->color_name.'"><img src="'.yt_image_media($atts->icon_email).'" style="width:18px" alt="" /></span> ';
			}
		}
		if($atts->icon_subject != ''){
			if (strpos($atts->icon_subject, 'icon:') !== false) {
				$atts->icon_subject = "<span class='add-on' style='background:".$atts->background_name."; color:".$atts->color_name."'><i class='fa fa-" . trim(str_replace('icon:', '', $atts->icon_subject)) . "'></i></span> ";
			}else
			{
				$atts->icon_subject = '<span class="add-on" style="background:'.$atts->background_name.'; color:'.$atts->color_name.'"><img src="'.yt_image_media($atts->icon_subject).'" style="width:18px" alt="" /></span> ';
			}
		}
		
		if($text_add_field != ''){
			$field_array = explode(',',$text_add_field);
			if(count($field_array) >0){
				$addstr .= '<div class="yt-form-common-field">';
				for ($i=0; $i<count($field_array);$i++)	{
					$str1 = $field_array[$i];
					$str1_array = explode('|',$str1);
					if(count($str1_array) >4){
						if(count($str1_array) >5){
							if($str1_array[5] == 'yes')
							$idman = 'mandatory'.$id;
							$validation_mandatory =$str1_array[0];
						}
						$icon_add ='';
						if(count($str1_array) >6){
							$icon_add = '<span class="add-on" style="background:'.$str1_array[4].';color:'.$str1_array[3].'"><i class="fa fa-'.$str1_array[6].'"></i></span>';
						}
						$addstr.='
							<div class="form-group">
								';
								if (strtolower($atts->label_show)=='yes'){
									$addstr.='<label for="'.$str1_array[0].'" class="yt-form-label" style="color:'.$str1_array[3].'">'.$str1_array[0].':</label>';
								}
								$addstr.='
								<div class="yt-input-box '.($icon_add !="" ? "yt-input-prepend" : "").'">';
								if($str1_array[1] == 'textarea'){
									$addstr .='<textarea id="'.$str1_array[0].' "  placeholder="'.$str1_array[2].'"  class="form-control-1 '.$idman.'" name="'.$str1_array[0].'" style="height: '.$textarea_height.'px; margin-bottom:10px; background:'.$str1_array[4].';color:'.$str1_array[3].' !important" ></textarea>';
								}else{
									$addstr.= $icon_add;
									$addstr.='<input type="'.$str1_array[1].'" placeholder="'.$str1_array[2].'" id="'.$str1_array[0].'" class="form-control-1 '.$idman.'" name="'.$str1_array[0].'" style="background:'.$str1_array[4].';margin-bottom:10px;color:'.$str1_array[3].'" />';
								}
					$addstr.='</div>
						</div>';
					}
				}
				$addstr .='</div>';
			}
		}
		$atts->margin = ($atts->margin != '') ? 'margin: '. $atts->margin : ' margin: 0 0 25px 0';
		$fields = "";
		if ($atts->name=='yes' && $atts->subject=='yes') {
			$fields .= 'name-email-subject';
		} elseif ($atts->name=='yes') {
		   $fields .= 'name-email';
		}  elseif ($atts->subject=='yes') {
		   $fields .= 'email-subject';
		} else {
			$fields .= 'email';
		}
		if (isset($_POST['email'])) {
			$name='';
			$email='';
			$message ='';
			$subject ='';
			if(isset($_POST['name'])){
				$name = $_POST['name'];
			}
			if(isset($_POST['email'])){
				$email = $_POST['email'];
			}
			if(isset($_POST['subject'])){
				$subject = $_POST['subject'];
			}
			if(isset($_POST['message'])){
				$message = $_POST['message'];
			}
			if(!empty($subject)){
				$subject = $subject;
			} else {
				$subject =  $database['config_name'];
			}
			if(!empty($name)){
				$name = $name;
			} else {
				$name = $database['config_name'];
			}
			$addmess = '';
			if($text_add_field != ''){
				$field_a = explode(',',$text_add_field);
				for ($i=0; $i<count($field_a);$i++){
					$str2 = $field_a[$i];
					$str2_array = explode('|',$str2);
					$addmess .= '<tr>
								<td>'.$str2_array[0].'</td>
								<td>'.$_POST["".$str2_array[0].""].'</td>
								</tr>';
				}
			}
			$message = '<table>
						<tr>
							<td>'.$database['language']->get("shortcode_name").'</td>
							<td>'.$name.'</td>
						</tr>
						<tr>
							<td>'.$database['language']->get("shortcode_email").'</td>
							<td>'.$email.'</td>
						</tr>
						'. $addmess.'
						<tr>
							<td>'.$database['language']->get("shortcode_message").'</td>
							<td>'.$message.'</td>
						</tr>
						</table>';

			if (!$email) {
				$erre = "Email";
			} elseif (!$message) {
				$errm = "Message";
			} else {
				$email = trim($email);
				$_ename = "/^[-!#$%&\'*+\\.\/0-9=?A-Z^_'{|}~]+";
				$_host = "([0-9A-Z]+\.)+";
				$_tlds = "([0-9A-Z]){2,4}$/i";
				$mail_validate = FALSE;

				if (!preg_match($_ename . "@" . $_host . $_tlds, $email)) {
					$mail_validate = TRUE;
					$errev = $database['language']->get("shortcode_email_validation_");
				} else {
					$result = new stdClass();
					ob_start();
					try{
						$message_send  = '<html dir="ltr" lang="en">' . "\n";
						$message_send .= '  <head>' . "\n";
						$message_send .= '    <title>' . $subject . '</title>' . "\n";
						$message_send .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
						$message_send .= '  </head>' . "\n";
						$message_send .= '  <body>' . html_entity_decode($message, ENT_QUOTES, 'UTF-8') . '</body>' . "\n";
						$message_send .= '</html>' . "\n";
						$mail = new Mail();
						$mail->protocol = $database['config_mail_protocol'];
						$mail->parameter = $database['config_mail_parameter'];
						$mail->smtp_hostname = $database['config_mail_smtp_hostname'];
						$mail->smtp_username = $database['config_mail_smtp_username'];
						$mail->smtp_password = html_entity_decode($database['config_mail_smtp_password'], ENT_QUOTES, 'UTF-8');
						$mail->smtp_port = $database['config_mail_smtp_port'];
						$mail->smtp_timeout = $database['config_mail_smtp_timeout'];

						$mail->setTo($email);
						$mail->setFrom($database['config_email']);
						$mail->setSender(html_entity_decode($database['config_name'], ENT_QUOTES, 'UTF-8'));
						$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
						$mail->setHtml($message);
						$mail->send();
						echo '1';
					} catch(Exception $exception) {
						echo '0';
					}
				
					$buffer = ob_get_contents();
					$result->response = preg_replace(
							array(
									'/ {2,}/',
									'/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'
							),
							array(
									' ',
									''
							),
							$buffer
					);
					ob_end_clean();
					die (json_encode($result));
				}
			}
		}
		
		if($atts->name_shortcode_status == "yes" && $text_name_shortcode != ''){
			$str .= '<h3 class="shortcodeTitle">'.$text_name_shortcode.'</h3>';
		}
		$str .= '<div class="yt-clearfix yt-contact_form '.$atts->type.' '.$fields .' '.$atts->yt_class.'" style="'.$atts->margin.'">
			<script type="text/javascript">
			jQuery(document).ready(function() {

				jQuery(document).off(\'click\', \'input[name="contact_us_submit'.$id.'"]\');
				jQuery(document).on(\'click\', \'input[name="contact_us_reset'.$id.'"]\', function(e) {
					resetForm("contact_us_form'.$id.'");
				});
				jQuery(document).on(\'click\', \'input[name="contact_us_submit'.$id.'"]\', function(e) {
					$ = jQuery;
					var form = jQuery(\'form[name="contact_us_form'.$id.'"]\');
					var formData = form.serialize();
					var formAction = form.attr(\'action\');
					var name = escape(jQuery(\'#name'.$id.'\').val());
					var email = escape(jQuery(\'#email'.$id.'\').val());
					var message = escape(jQuery(\'#message'.$id.'\').val());
					var subject = escape(jQuery(\'#subject'.$id.'\').val());
					var mandatory = escape(jQuery(\'.mandatory'.$id.'\').val());
					var validation_mandatory = escape(jQuery(\'.mandatory'.$id.'\').attr(\'name\'));
					isVal = false;
					vEmail = isValidEmail(email);
					if (name == "") {
						onErrorMessage(\'danger\', validation_name);
					} else if (email == "") {
						onErrorMessage(\'danger\', validation_email);
					} else if (!isNaN(email) || vEmail == false) {
						onErrorMessage(\'danger\', validation_vemail);
					} else if (subject == "") {
						onErrorMessage(\'danger\', validation_subject);
					} else if (mandatory == "") {
						onErrorMessage(\'danger\', validation_mandatory);
					}else if (message == "") {
						onErrorMessage(\'danger\', validation_message);
					}else {
						isVal = true;
					}
					if (isVal != false) {
						onContactSubmit(formAction, formData);
					}
				});
				function onErrorMessage(msgType, msgText) {
					jQuery(\'.error-message.'.$id.'\').removeClass(\'message-info\');
					jQuery(\'.error-message.'.$id.'\').removeClass(\'message-warning\');
					jQuery(\'.error-message.'.$id.'\').removeClass(\'message-success\');
					jQuery(\'.error-message.'.$id.'\').removeClass(\'message-danger\');

					if (msgType == \'info\') {
						jQuery(\'.error-message.'.$id.'\').addClass(\'message-info\');
					} else if (msgType == \'warning\') {
						jQuery(\'.error-message.'.$id.'\').addClass(\'message-warning\');
					} else if (msgType == \'success\') {
						jQuery(\'.error-message.'.$id.'\').addClass(\'message-success\');
					} else if (msgType == \'danger\') {
						jQuery(\'.error-message.'.$id.'\').addClass(\'message-danger\');
					}
					if (jQuery(\'.error-message.'.$id.'\').is(\':visible\')) {
						jQuery(\'.error-message.'.$id.' .text\').html(msgText);
					} else {
						jQuery(\'.error-message.'.$id.' .text\').html(msgText);
						jQuery(\'.error-message.'.$id.'\').slideDown(800);
					}
					jQuery(\'.error-message.'.$id.' .close\').click(function(){
						jQuery(\'.error-message.'.$id.'\').slideUp(800);
					});
				}
				function onContactSubmit(formAction, formData) {
					jQuery.ajax({
						\'type\' : \'POST\',
						\'url\' : formAction,
						\'data\' : formData,
						\'dataType\': \'json\',
						\'success\' : function(data) {
							if (data.response == 1)
							{
								jQuery(\'#contact_us_form'.$id.'\').each(function() {
									this.reset();
								});
								onErrorMessage(\'success\', \''.$database['language']->get("shortcode_send_success").'\');
								jQuery(\'body\').animate
								({
									opacity : 1
									}, 1600, function()
									{
									if (jQuery(\'.error-message.'.$id.'\').is(\':visible\')) {
										jQuery(\'.error-message.'.$id.'\').slideUp(800);
									}
								});
							} else {
								onErrorMessage(\'warning\', \''.$database['language']->get("shortcode_send_error").'\');
							}
						}
					});
				};
			});
				validation_name="'.$database["language"]->get("shortcode_name_validation").'";
				validation_email="'.$database["language"]->get("shortcode_email_validation").'";
				validation_vemail="'.$database["language"]->get("shortcode_email_validation_").'";
				validation_subject="'.$database["language"]->get("shortcode_subject_validation").'";
				validation_message="'.$database["language"]->get("shortcode_message_validation").'";
			</script>
			<div class="yt-form-wrapper">
				<div class="yt-form">
					<div class="error-message '.$id.'">
						<span class="text"></span>
						<button data-dismiss="alert" class="close" type="button">×</button>
				</div>
				<form name="contact_us_form'.$id.'" id="contact_us_form'.$id.'" class="yt-clearfix contact_us_form " action="' . $database['url'] . '" method="POST">
					<div class="yt-form-fields">
						';
						if(strtolower($atts->name)=='yes'){
						$str.='
							<div class="form-group">
								';

								if (strtolower($atts->label_show)=='yes') {$str.='<label for="name'.$id.'" class="yt-form-label" style="color:'.$atts->color_name.'">'.$database["language"]->get("shortcode_name").':</label>';}
								$str.='
								<div class="yt-input-box '.($atts->icon_name !="" ? "yt-input-prepend" : "").'">
									'.$atts->icon_name.'
									<input type="text" placeholder="'.$database["language"]->get("shortcode_name").'" id="name'.$id.'" class="form-control-1" name="name" style="background:'.$atts->background_name.';color:'.$atts->color_name.' !important ; " />
								</div>
							</div>';
						}
						$str.='
						<div class="form-group">
							';
							if (strtolower($atts->label_show)=='yes') {$str.='<label for="email'.$id.'" class="yt-form-label" style="color:'.$atts->color_email.'">'.$database["language"]->get("shortcode_email").':</label>';}
							$str.='
							<div class="yt-input-box '.($atts->icon_email !="" ? "yt-input-prepend" : "").'">
								 '.$atts->icon_email.'
								<input type="text" placeholder="'.$database["language"]->get("shortcode_email").'"  id="email'.$id.'" class="form-control-1" name="email" style="background:'.$atts->background_email.';color:'.$atts->color_email.'"  />
							</div>
						</div>';

						if(strtolower($atts->subject)=='yes'){
						$str.='
							<div class="form-group">
								';
								if (strtolower($atts->label_show)=='yes') {$str.='<label for="subject'.$id.'" class="yt-form-label" style="color:'.$atts->color_subject.'">'.$database["language"]->get("shortcode_subject").':</label>';}
								$str.='<div class="yt-input-box '.($atts->icon_subject !="" ? "yt-input-prepend" : "").'">
								  '.$atts->icon_subject.'
									<input type="text" placeholder="'.$database["language"]->get("shortcode_subject").'"  id="subject'.$id.'" class="form-control-1" name="subject" style="background:'.$atts->background_subject.';color:'.$atts->color_subject.'" >

								</div>
							</div>
					';
					}
					$str.='
					</div>';
					$str.=$addstr;
					$str.='
					<div class="yt-form-common-field">
						<div class="form-group ">
							';
							if (strtolower($atts->label_show)=='yes') {$str.='<label for="message'.$id.'" class="yt-form-label" style="color:'.$atts->color_message.'">'.$database["language"]->get("shortcode_message").':</label>';}
							$str.='
							<div class="yt-input-box">
								<textarea id="message'.$id.'"  placeholder="'.$database["language"]->get("shortcode_message").'"  class="form-control-1 message" name="message" style="height: '.$atts->textarea_height.'px; background:'.$atts->background_message.';color:'.$atts->color_message.'" ></textarea>
							</div>
						</div>

						<div style="display: none;"></div>
							<div class="form-group">
								<div class=" submit-button">
									';
					
									if ($text_submit_button) {$str.='<input name="contact_us_submit'.$id.'" class="btn btn-'.$atts->btn_submit.'" type="button" value="'. $text_submit_button .'" />';}
									else{ $str.='<input name="contact_us_submit'.$id.'" class="btn btn-'.$atts->btn_submit.'" type="button" value="Submit" />';}

									if(strtolower($atts->reset)=='yes'){
										$str.='<input name="contact_us_reset'.$id.'" class="btn btn-'.$atts->btn_reset.'" type="reset" value="Reset" />';
									}
									$str.='
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>';
	}
	return $str;
}
?>