<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



function wi_check_date_not_past($new_date){

	$today = getdate('Y-m-d');	
	
	if($new_date >= $today){
		return true;
	}
	else{
		return false;
	}
}


function wi_check_if_today($new_date){
	
	$today = getdate('Y-m-d');	
	echo $today;
	if($new_date == $today){
		return true;
	}
	else{
		return false;
	}
}

function wi_check_date_format($str){

	if(substr_count($str, "-")==2){
		
		list ($y, $m, $d) = explode('-', $str);
		
		if(!is_numeric($y) || !is_numeric($m) || !is_numeric($d)){
			return false;
		}
		return checkdate($m, $d, $y);
	}
	else{
		return false;
	}
}



function wi_upload_check_format($mime) {
    

	$accepted_formats = array(
		'image/jpeg',
		'image/png',
		'image/gif',
		'image/pjpeg',
		'image/x-png',
                'application/msword',
                'application/octet-stream',
                'application/pdf',
                'application/vnd.ms-powerpoint'             
	);

	if (!in_array($mime, $accepted_formats)) {
		return false;
	}
	return true;
}




     function wi_get_days_from_seconds($difference){
     	
     	$expired = 0;
		//Calculate how many days are within $difference
		$return['days'] = intval($difference / 86400);
		if($return['days'] < 0){
			$expired = 1;
		}
		
		//Keep the remainder
		$difference = $difference % 86400;
		
		//Calculate how many hours are within $difference
		$return['hours'] = intval($difference / 3600);
     	if($return['hours'] < 0){
			$expired = 1;
		}
		
		//Keep the remainder
		$difference = $difference % 3600;
		
		//Calculate how many minutes are within $difference
		$return['minutes'] = intval($difference / 60);
        if($return['minutes'] < 0){
			$expired = 1;
		}
				
		//Keep the remainder
		$difference = $difference % 60;
		
		//Calculate how many seconds are within $difference
		$return['seconds'] = intval($difference); 
        if($return['seconds'] < 0){
			$expired = 1;
		}
		
		$return['expired'] = $expired;
		
		return $return;
     }
     
     
 function wi_get_expiry_diff($expiry_date){
    $today = strtotime(date('Y-m-d H:i:s'));
    $future = strtotime($expiry_date) + (24*60*60);   
    return wi_get_days_from_seconds($future-$today);
}



function wi_get_entity_link($entity, $by_title){
    
    	if($by_title=="title"){
		return elgg_view('output/url', array(
			'href' => $entity->getURL(),
			'text' => $entity->title,
		));	
	}
	else{
		return elgg_view('output/url', array(
			'href' => $entity->getURL(),
			'text' => $entity->getURL(),
		));			
	}
}


function wi_get_days_in_seconds($days){
        return $days * 24 * 60 * 60;
}	
     



function wi_get_user_entities_link($subtype, $username, $status){
		return elgg_view('output/url', array(
			'href' => "{$subtype}/owner/".$username."/".$status,
			'text' => ucfirst($status) . ' wiauctions',
		));	
}



function wi_get_all_entities_link($subtype){
    $subtype = substr($subtype, 2);
	return elgg_view('output/url', array(
	'href' => "$subtype/all/active",
	'text' => "All {$subtype}s",
	));
}



function wi_get_my_entities_link($subtype, $status){
                $subtype = substr($subtype, 2);
		return elgg_view('output/url', array(
			'href' => "{$subtype}/owner/".elgg_get_logged_in_user_entity()->username."/".$status,
			'text' => ucfirst($status) . " {$subtype}s",
		));	
}




function wi_get_my_wibids_link($status){
		return elgg_view('output/url', array(
			'href' => 'bid/owner/'.elgg_get_logged_in_user_entity()->username.'/'.$status,
			'text' => ucfirst($status) . ' bids',
		));	
}






/**
 * Check if this is an image
 * 
 * @param string $mime
 * @return bool false = not image
 */

function tp_upload_check_format($mime) {
    

	$accepted_formats = array(
		'image/jpeg',
		'image/png',
		'image/gif',
		'image/pjpeg',
		'image/x-png',
	);

	if (!in_array($mime, $accepted_formats)) {
		return false;
	}
	return true;
}


/**
 * Check if image is within limits
 *
 * @param int $image_size
 * @return bool false = too large
 */


function wi_upload_check_max_size($image_size) {
	//$max_file_size = (float) get_plugin_setting('maxfilesize','tidypics');
	//if (!$max_file_size) {
		// default to 5 MB if not set
        global $CONFIG;
        
	$max_file_size = $CONFIG->max_image_size;
       
	//}
	// convert to bytes from MBs
	$max_file_size = 1024 * 1024 * $max_file_size;
	return $image_size <= $max_file_size;
}


/**
 * Check if there is enough memory to process this image
 * 
 * @param string $image_lib
 * @param int $num_pixels
 * @return bool false = not enough memory
 */

function wi_upload_memory_check($num_pixels) {


	$mem_avail = ini_get('memory_limit');
	$mem_avail = rtrim($mem_avail, 'M');
	$mem_avail = $mem_avail * 1024 * 1024;
	$mem_used = memory_get_usage();
	$mem_required = ceil(5.35 * $num_pixels);

	$mem_avail = $mem_avail - $mem_used - 2097152; // 2 MB buffer
        
	if ($mem_required > $mem_avail) {
		return false;
	}

	return true;
}


function wi_getjpegsize($img_loc) {
    $handle = fopen($img_loc, "rb") or die("Invalid file stream.");
    $new_block = NULL;
    if(!feof($handle)) {
        $new_block = fread($handle, 32);
        $i = 0;
        if($new_block[$i]=="\xFF" && $new_block[$i+1]=="\xD8" && $new_block[$i+2]=="\xFF" && $new_block[$i+3]=="\xE0") {
            $i += 4;
            if($new_block[$i+2]=="\x4A" && $new_block[$i+3]=="\x46" && $new_block[$i+4]=="\x49" && $new_block[$i+5]=="\x46" && $new_block[$i+6]=="\x00") {
                // Read block size and skip ahead to begin cycling through blocks in search of SOF marker
                $block_size = unpack("H*", $new_block[$i] . $new_block[$i+1]);
                $block_size = hexdec($block_size[1]);
                while(!feof($handle)) {
                    $i += $block_size;
                    $new_block .= fread($handle, $block_size);
                    if($new_block[$i]=="\xFF") {
                        // New block detected, check for SOF marker
                        $sof_marker = array("\xC0", "\xC1", "\xC2", "\xC3", "\xC5", "\xC6", "\xC7", "\xC8", "\xC9", "\xCA", "\xCB", "\xCD", "\xCE", "\xCF");
                        if(in_array($new_block[$i+1], $sof_marker)) {
                            // SOF marker detected. Width and height information is contained in bytes 4-7 after this byte.
                            $size_data = $new_block[$i+2] . $new_block[$i+3] . $new_block[$i+4] . $new_block[$i+5] . $new_block[$i+6] . $new_block[$i+7] . $new_block[$i+8];
                            $unpacked = unpack("H*", $size_data);
                            $unpacked = $unpacked[1];
                            $height = hexdec($unpacked[6] . $unpacked[7] . $unpacked[8] . $unpacked[9]);
                            $width = hexdec($unpacked[10] . $unpacked[11] . $unpacked[12] . $unpacked[13]);
                            return array($width, $height);
                        } else {
                            // Skip block marker and read block size
                            $i += 2;
                            $block_size = unpack("H*", $new_block[$i] . $new_block[$i+1]);
                            $block_size = hexdec($block_size[1]);
                        }
                    } else {
                        return FALSE;
                    }
                }
            }
        }
    }
    return FALSE;
}
 

function wi_get_category_option_vals($cat_prefix){
    
    $cats = elgg_get_entities(array(
                'type' => 'object',
                'subtype' => "{$cat_prefix}category",
            ));
    
    $option_vals = array();
    
    foreach($cats as $cat){
        $option_vals[$cat->title] = $cat->guid;
    }
    
    return $option_vals;
    
}

/**
 * Returns an overall file type from the mimetype
 *
 * @param string $mimetype The MIME type
 * @return string The overall type
 */
function wi_file_get_simple_type($mimetype) {

	switch ($mimetype) {
		case "application/msword":
		case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
			return "document";
			break;
		case "application/pdf":
			return "document";
			break;
		case "application/ogg":
			return "audio";
			break;
	}

	if (substr_count($mimetype, 'text/')) {
		return "document";
	}

	if (substr_count($mimetype, 'audio/')) {
		return "audio";
	}

	if (substr_count($mimetype, 'image/')) {
		return "image";
	}

	if (substr_count($mimetype, 'video/')) {
		return "video";
	}

	if (substr_count($mimetype, 'opendocument')) {
		return "document";
	}

	return "general";
}





 

