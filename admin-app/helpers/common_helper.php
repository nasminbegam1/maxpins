<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * This function is used for output of the array
 * @param array
 * @param print option optional
 * @return String
 */
if ( ! function_exists('pr'))
{
	function pr($arr,$e=1)
	{
		if(is_array($arr))
		{
			echo "<pre>";
			print_r($arr);
			echo "</pre>";
		}
		else
		{
			echo "<br>Not an array...<br>";
			echo "<pre>";
			var_dump($arr);
			echo "</pre>";
	
		}
		if($e==1)
		    exit();
		else
		    echo "<br>";
	}
}

/*
 * This function is used for creating proper url
 * @param strings : url='URL STRING' type='TRUE'
 * @return String
 */

 if (! function_exists('chk_url'))
 {
	function create_proper_url($url='', $type=TRUE)
	{
		if($url==''){
			$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		}
		
		if($url)
		{
			$new_url = substr($url, -2);
			if($new_url == '//')
			{
				$url1 = rtrim($url,"/");
				if($type == FALSE)
				{
					
					redirect($url1);
				}
				elseif($type == TRUE)
				{
					redirect($url1.'/');
				}
				
			}
			
			if(substr($url, -1)!='/' and $type==TRUE){
				redirect($url.'/');
			}
		}
	}
 }
 
 /*
 * This function is used for output a string with certain limit
 * @param strings : input_string, limit
 * @return String
 */
if ( ! function_exists('sub_word'))
{
    function sub_word($str, $limit)
    {
            $text = explode(' ', $str, $limit);
            if (count($text)>=$limit)
            {
                    array_pop($text);
                    $text = implode(" ",$text).'...';
            }
            else
            {
                    $text = implode(" ",$text);
            }
            $text = preg_replace('`\[[^\]]*\]`','',$text);
            return strip_tags($text);
    }
}

/*
 * This function is used for sending mail
 * @param arrays : mail_array and attachment_array
 * @param strings : cc and bcc optional
 * @return Boolean TRUE||FALSE
 */

if (!function_exists('send_email'))
{
	function send_email($mail_config, $attachment_file = array(), $cc='', $bcc='') //$to, $from, $from_name, $subject, $message,
	{
		$CI = & get_instance();
		$CI->load->library('email');
		$CI->email->clear();
		
		$to		= $mail_config['to'];
		$from		= $mail_config['from'];
		$from_name	= $mail_config['from_name'];
		$subject	= $mail_config['subject'];
		$message	= $mail_config['message'];
		
		//echo "to----".$to.'<br />from----'.$from.'<br />fromname----'.$from_name.'<br />subject----'.$subject.'<br />message----'.$message;
		
		$CI->email->to($to);
		$CI->email->from($from, $from_name);
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($cc != '') {
			$CI->email->cc($cc);
		}
		
		if($bcc != '') {
			$CI->email->bcc($bcc);
		}
		
		if(is_array($attachment_file) && !empty($attachment_file) ) {
			$attach_file_path = '';
			for($a=0;$a<count($attachment_file);$a++)
			{
				$attach_file_path = $attachment_file[$a];
				$CI->email->attach($attach_file_path);
			}
		}
		
		$i_email = $CI->email->send();
		
		//echo "<><>".$this->email->print_debugger();
		return $i_email;
	}
}

if (!function_exists('send_html_email'))
{
	function send_html_email($mail_config, $cc='', $bcc='') //$to, cc email id, bcc email id
	{
		//$config['protocol']	= 'smtp';
		//$config['smtp_host']	= 'ssl://server.liveasia.com';
		//$config['smtp_port']	= 465;
		//$config['smtp_user']	= 'response@livephuket.com';
		//$config['smtp_pass']	= 'response123@';
		$config['mailtype']	= 'html';
		$config['charset']	= 'utf-8';
		$config['newline'] 	= "\r\n";
		
		$CI = & get_instance();
		$CI->load->library('email', $config);
		$CI->email->clear();

		
		$to		= $mail_config['to'];
		$from		= $mail_config['from'];
		$from_name	= $mail_config['from_name'];
		$subject	= $mail_config['subject'];
		$message	= $mail_config['message'];
		
		$CI->email->to($to);
		$CI->email->from($from, $from_name);
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($cc != '') {
			$CI->email->cc($cc);
		}
		
		if($bcc != '') {
			$CI->email->bcc($bcc);
		}
		
		return $CI->email->send();
		
		//echo "<><>".$this->email->print_debugger();
		return mail($to,$subject,$message,$headers);

	}
}

/*
 * This function is used for file upload
 * @param array : upload_array
 * @return String 
 */
if (!function_exists('file_upload'))
{
	function file_upload(&$file_upload_config)
	{
		$CI = & get_instance();
		$CI->load->library('Upload');
		
		$field_name 		= $file_upload_config['field_name'];
		$file_upload_path 	= $file_upload_config['file_upload_path'];
		$max_size 		= $file_upload_config['max_size'];
		$allowed_types 		= $file_upload_config['allowed_types'];
		
		$config['upload_path'] 	= file_upload_absolute_path().$file_upload_path;
		
		if($allowed_types != '')
		{
			$config['allowed_types'] 	= $allowed_types;
		}
		
		if($max_size != '')
		{
			$config['max_size']		= $max_size;
		}
		
		if(isset($file_upload_config['encrypt_name']))
		{
			$config['encrypt_name']		= $file_upload_config['encrypt_name'];
		}
		else
		{
			$config['encrypt_name']		= true;
		}
		
		$uploaded_file_name = '';
		$CI->upload->set_config($config);
		$i_upload = $CI->upload->do_upload($field_name,true);
		
		$CI->session->set_userdata('upload_err',$CI->upload->display_errors());
		
		$data['upload_err'] = $CI->upload->display_errors();
		
		if($i_upload) {
			$uploaded_file_name = $CI->upload->file_name;
			
		} 
		return $uploaded_file_name;
	}
}

/*
 * This function is used for image upload
 * @param arrays : upload_array and thumb_array
 * allowed_types, encrypt_name
 * @return String 
 */
if (!function_exists('image_upload'))
{
	function image_upload(&$upload_config, &$thumb_config)
	{
		$CI = & get_instance();
		
		$CI->load->library('Upload');
		
		$field_name 		= $upload_config['field_name'];
		$file_upload_path 	= $upload_config['file_upload_path'];
		$max_size 		= $upload_config['max_size'];
		$max_width 		= $upload_config['max_width'];
		$max_height 		= $upload_config['max_height'];
		$allowed_types 		= $upload_config['allowed_types'];
		$thumb_create 		= $thumb_config['thumb_create'];
		$thumb_file_upload_path = $thumb_config['thumb_file_upload_path'];
		$thumb_width 		= $thumb_config['thumb_width'];
		$thumb_height 		= $thumb_config['thumb_height'];
		
		$config['upload_path'] 	= $file_upload_path;
		
		
		if($allowed_types != '') {
			$config['allowed_types'] 	= $allowed_types;
		}
		
		if($max_size != '') {
			$config['max_size']		= $max_size;
		} else {
			$config['max_size']		= '';
		}
		
		if($max_width != '') {
			$config['max_width']		= $max_width;
		} else {
			$config['max_width']		= '';
		}
		
		if($max_height != '') {
			$config['max_height']		= $max_height;
		} else {
			$config['max_height']		= '';
		}
		
		if(isset($upload_config['encrypt_name'])) {
			$config['encrypt_name']		= $upload_config['encrypt_name'];
		} else {
			$config['encrypt_name']		= true;
		}
                
		$uploaded_file_name = '';
		$CI->upload->set_config($config);
		$i_upload = $CI->upload->do_upload($field_name,true);
		
		$CI->nsession->set_userdata('upload_err',$CI->upload->display_errors());
		
		$data['upload_err'] = $CI->upload->display_errors();
		//pr($CI->upload->display_errors());
		
		if($i_upload) {
			$uploaded_file_name = $CI->upload->file_name;
			if($thumb_create) {
				$config['source_image']		= $file_upload_path.$uploaded_file_name;
				$config['new_image'] 		= $file_upload_path.$thumb_file_upload_path.$uploaded_file_name;
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio']	= FALSE;
				$config['width']	 	= $thumb_width;
				$config['height']		= $thumb_height;
				$config['thumb_marker']		= '';
				
				$CI->load->library('image_lib', $config); 
				$CI->image_lib->resize();
			}
			
			else {
				//return true;
			}
		} else {
			return false;
		}
		return $uploaded_file_name;
	}
}

/* This function is used for Download File
 * @param strings : file_name_path, original_file_name
 * @return NULL
*/
if (!function_exists('file_download'))
{
	function file_download($file_name_path, $original_file_name='') 
	{
		if(isset($original_file_name)) {
			$file_name = $original_file_name;
		} else {
			$file_name = $file_name_path;
		}
		$mime = 'application/force-download';
		header('Pragma: public');    
		header('Expires: 0');        
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private',false);
		header('Content-Type: '.$mime);
		header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
		header('Content-Transfer-Encoding: binary');
		header('Connection: close');
		readfile($file_name_path);
		return true;
		
	}
}

/* This function is used for removing special character
 * @param  String
 * @return String
 */
if (!function_exists('removeSpecialChar'))
{
	function removeSpecialChar($psString)
	{
            return preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%-]/s', '', $psString);
	}
}

/* This function is used for creating thumbnail
 * @param  String
 * @return String
 */
if (!function_exists('image_thumbnail'))
{
	function image_thumbnail($source_image, $new_image, $width, $height)
	{
		$config['image_library']	= 'gd2';
		$config['source_image']		= $source_image;
		$config['new_image'] 		= $new_image;
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio']	= TRUE;
		$config['width']	 	= $width;
		$config['height']		= $height;
		
		$CI = & get_instance();
		$CI->load->library('image_lib');
		
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		$CI->image_lib->clear();
    
		return true;
	}
}

/* This function is used for showing short description
 * @param  String Limit
 * @return String
 */
if (!function_exists('str_short_description'))
{
	function str_short_description($str, $limit)
	{
		$new_str = str_replace("<p>", "", $str);
		$new_str = str_replace("</p>", "", $new_str);
		return stripslashes(trim(nl2br(substr($new_str,0,$limit))));
	}
}

if (!function_exists('get_googleanalytics'))
{
	function get_googleanalytics(){
		$CI = & get_instance();
		$analytics =	$CI->model_basic->getValue_condition('lp_sitesettings', 'sitesettings_value', 'analytics', 'sitesettings_id = 17');
		if(!empty($analytics))
			return $analytics;
		else
			return false;
	}
}

if (!function_exists('format_cash'))
{
	function format_cash($cash) {
	    // strip any commas 
	    $cash = (0 + STR_REPLACE(',', '', $cash));
	 
	    // make sure it's a number...
	    IF(!IS_NUMERIC($cash)){ RETURN FALSE;}
	 
	    // filter and format it 
	    IF($cash>1000000000000){ 
			RETURN ROUND(($cash/1000000000000),2).'TR';
	    }ELSEIF($cash>1000000000){ 
			RETURN ROUND(($cash/1000000000),2).'B';
	    }ELSEIF($cash>1000000){ 
			RETURN ROUND(($cash/1000000),2).'M';
	    }
	 
	    RETURN NUMBER_FORMAT($cash,0);
	}
}

if(! function_exists('get_nicetime'))
{

    function get_nicetime($date)
    {
        if(empty($date)) {
            return "No date provided";
        }
        
        $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths         = array("60","60","24","7","4.35","12","10");
        
        $now             = time();
        $unix_date       = $date;
        //echo $unix_date; exit;
        
           // check validity of date
        if(empty($unix_date)) {    
            return "Bad date";
        }
    
        // is it future date or past date
        if($now > $unix_date) {    
            $difference     = $now - $unix_date;
            $tense         = "ago";
            
        } else {
            $difference     = $unix_date - $now;
            $tense         = "from now";
        }
        
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
        
        $difference = round($difference);
        
        if($difference != 1) {
            $periods[$j].= "s";
        }
        
        return "$difference $periods[$j] {$tense}";
    }
    
    
}


if(!function_exists('currentClass')){
	function currentClass(){
		$CI = & get_instance();
		$class = $CI->router->class;
		return  $class;
	}
}

if(!function_exists('currentMethod')){
	function currentMethod(){
		$CI = & get_instance();
		$method = $CI->router->method;
		return  $method;
	}
}

if(!function_exists('currentPrice')){
	function currentPrice($price='',$symbol='',$rate=''){
		//$CI = & get_instance();
		$convert_price ='';
		if($symbol=='' and $rate==''){
			$convert_price = $price;
		}else{
			$convert_price = $price*$rate;
			$convert_price = number_format($convert_price,2);
		}
		
		return $convert_price;
	}
}

if(!function_exists('isFileExist'))
{
	function isFileExist($file_path,$image_name = '')
	{
		$ch	= curl_init($file_path);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
		
		if($retcode == 200)
		{
		    return  $file_path;
		}
		else
		{
			if($image_name != ''){
				return  $image_name;
			}else{
				return  FRONT_IMAGE_PATH.'no_img.jpg';
			}
		    
		}
		// $retcode >= 400 -> not found, $retcode = 200, found.
		curl_close($ch);
		
	}
}

if(!function_exists('create_slug'))
{
	function create_slug($string)
	{
	   $string = strtolower($string);
	   $slug = url_title($string);
	   
	   return $slug;
	}
}

/*** Create PDF ***/
if (!function_exists('generate_pdf'))
{
	function generate_pdf($view_file_name, $output_file_name, $output_file_path='', $output_option, $landscape_portrait='', $paper_size='', $page_title)
	{
		ob_start();
		$CI = & get_instance();
		
		$CI->load->library('pdf');
		// set document information
		$CI->pdf->SetAuthor('Author');
		$CI->pdf->SetTitle($page_title);
		$CI->pdf->SetSubject('Subject');
		$CI->pdf->SetKeywords('keywords');
		
		// set font
		$CI->pdf->SetFont('helvetica', 'N', 18);
		
                //$CI->pdf->setPrintHeader(false);
		$CI->pdf->setPrintFooter(false);
                
                // add a page
                if($landscape_portrait != '' && $paper_size != '')
                {
			
			// set default monospaced font
			$CI->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			// set margins
			//$CI->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$CI->pdf->SetMargins(10, 10, 10);
			//$CI->pdf->SetHeaderMargin(0);
			//$CI->pdf->SetFooterMargin(0);
			
			// set auto page breaks
			$CI->pdf->SetAutoPageBreak(TRUE, 0);
			
			$CI->pdf->AddPage($landscape_portrait, $paper_size);
                }
                else
                {
                    $CI->pdf->AddPage();
                }
		
		// write html on PDF
		$CI->pdf->writeHTML($view_file_name, true, false, true, false, '');
		ob_clean();
		
		ob_end_clean();
		//Close and output PDF document
		$CI->pdf->Output($output_file_path, $output_option);
		
	}
}

/* End of file common_helper.php */
/* Location: ./admin-app/helpers/common_helper.php */