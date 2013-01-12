<?php
/**
 * Elgg wiauctions Plugin
 * @package wiauctions
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

// start a new sticky form session in case of failure
elgg_make_sticky_form('wiauction');


// store errors to pass along
$error = FALSE;
$error_forward_url = REFERER;
$user = elgg_get_logged_in_user_entity();

// edit or create a new entity
$wiauction_id = get_input('guid');


if ($wiauction_id) {
	$wiauction = get_entity($wiauction_id);
	if (!(elgg_instanceof($wiauction, 'object', 'wiauction') && $wiauction->canEdit()&&(wi_get_entity_status($wiauction->getGUID())=="active"||wi_get_entity_status($wiauction->getGUID())=="expired"))) {	
		register_error(elgg_echo('wiauctions:error:post_not_found'));
		forward(get_input('forward', REFERER));	
	} 

	// save some data for revisions once we save the new edit
	//$revision_text = $wiauction->description;
	$new_post = false;
} else {
	$wiauction = new ElggObject();
	$wiauction->subtype = 'wiauction';
	$new_post = TRUE;
}


// set defaults and required values.
$values = array(
	'title' => '',
	'description' => '',
    	'wiauctioncategory' => '',
        'guide' => '',
        'location' => '',
        'expiry_date' => '',
        'tags' => '',
	'access_id' => ACCESS_PUBLIC,	
	'container_guid' => (int)get_input('container_guid'),
);


// fail if a required entity isn't set
$required = array('title', 'description', 'wiauctioncategory', 'location', 'guide', 'expiry_date');

$budget = false;

// load from POST and do sanity and access checking
foreach ($values as $name => $default) {
	$value = get_input($name, $default);

	if (in_array($name, $required) && empty($value)) {
		$error = elgg_echo("wiauctions:error:missing:$name");
	}

	if ($error) {
		break;
	}

	switch ($name) {
		case 'tags':
			if ($value) {
				$values[$name] = string_to_tag_array($value);
			} else {
				unset ($values[$name]);
			}
			break;

		case 'container_guid':
			// this can't be empty or saving the base entity fails
			if (!empty($value)) {
				if (can_write_to_container($user->getGUID(), $value)) {
					$values[$name] = $value;
				} else {
					$error = elgg_echo("wiauctions:error:cannot_write_to_container");
				}
			} else {
				unset($values[$name]);
			}
			break;
			
		case 'wiauctioncategory':
			$wiauctioncategory_guids = $value;
			unset ($values[$name]);
			break;	                      

		case 'budget':
			if (is_numeric($value)) {
				$values[$name] = $value;
                                $budget = true;
			}
                        elseif (strlen($value)>0){
				$error = elgg_echo("wiauctions:error:budget_num");
				unset ($values[$name]);
                        }
                        else {

			}
			break;	

		case 'budget_type':
			if ($budget) {
				$values[$name] = $value;
			} 
			break;	                        
                        

		// don't try to set the guid
		case 'guid':
			unset($values['guid']);
			break;
			
		//case 'expiry_date':
		//	if (wi_check_date_not_past($value) && wi_check_date_format($value)) {
				//$values[$name] = $value;
			//} else {
				//$error = elgg_echo("wiauctions:error:expiry_date_early");
			}
			//break;				
						
		default:
			$values[$name] = $value;
			break;
	}
}


            if ((!empty($_FILES['upload']['name']))) {
                    
                    //check if error firled is set, means image size is bigger than upload_file_size set in cli php.ini
                    if ($_FILES['upload']['error']) {
                            if ($_FILES['upload']['error'] == 1) {
                                   $error = elgg_echo('wiauction:image_mem');
                            } else {
                                    $error = elgg_echo('wiauction:unk_error');
                            }
                    }
                    
                    if(!$error){
                        $mime = $_FILES['upload']['type'];

                            // must be an image
                            if (!wi_upload_check_format($mime)) {
                                    $error = elgg_echo('wiauction:not_image');
                            }	
                    }                    
            }



// assign values to the entity, stopping on error.
if (!$error) {
	foreach ($values as $name => $value) {
		if (FALSE === ($wiauction->$name = $value)) {
			$error = elgg_echo('wiauctions:error:cannot_save' . "$name=$value");
			break;
		}
	}
}



// only try to save base entity if no errors
if (!$error) {
	
	$wiauction_id = $wiauction->save();
        
	if ($wiauction_id) {
            
            	// Now see if we have a file icon
	if ((isset($_FILES['upload']['name'])) && (substr_count($_FILES['upload']['type'],'image/'))) {
		$prefix = "wiauction/".$wiauction_id;
		
		$filehandler = new ElggFile();
		$filehandler->owner_guid = elgg_get_logged_in_user_guid();
		$filehandler->setFilename($prefix . ".jpg");
		$filehandler->open("write");
		$filehandler->write(get_uploaded_file('upload'));
		$filehandler->close();
		
		$thumbtiny = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),25,25, true);
		$thumbsmall = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),70,70, true);
		$thumbmedium = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),153,153, true);
		$thumblarge = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),200,200, false);
		if ($thumbtiny) {
			
			$thumb = new ElggFile();
			$thumb->owner_guid = elgg_get_logged_in_user_guid();
			$thumb->setMimeType('image/jpeg');
			
			$thumb->setFilename($prefix."tiny.jpg");
			$thumb->open("write");
			$thumb->write($thumbtiny);
			$thumb->close();
			
			$thumb->setFilename($prefix."small.jpg");
			$thumb->open("write");
			$thumb->write($thumbsmall);
			$thumb->close();
			
			$thumb->setFilename($prefix."medium.jpg");
			$thumb->open("write");
			$thumb->write($thumbmedium);
			$thumb->close();
			
			$thumb->setFilename($prefix."large.jpg");
			$thumb->open("write");
			$thumb->write($thumblarge);
			$thumb->close();
				
		}
	}
            
                        //add relationship between user and wiauction
                if(!wi_remove_entities_relationship("expired_wiauction", $user, $wiauction)){
                        register_error(elgg_echo('wiauctions:save:failure'));
                        forward(REFERER);                    
                }
            
            
            //add relationship between user and wiauction
                if(!wi_add_entities_relationship("active_wiauction", $user, $wiauction)){
                        register_error(elgg_echo('wiauctions:save:failure'));
                        forward(REFERER);                    
                }
		
		
		
		// remove sticky form entries
		elgg_clear_sticky_form('wiauction');
                
                
                if(!wi_save_entity_category("wiauction", $wiauction->guid, $wiauctioncategory_guids, "wiauction")){
                        register_error(elgg_echo('wiauctions:save:failure'));
                        forward(REFERER);                       
                }

                // Add to river
        add_to_river('river/object/wiauction/create','create',elgg_get_logged_in_user_guid(),$wiauction_id);

			
			if($new_post){
				$forward = "added";
			}
			else{
				$forward = "edited";
			}
                        forward("auction/confirm/".$wiauction_id."/".$forward);

	} else {		
		register_error(elgg_echo('wiauctions:save:failure'));
		forward($error_forward_url);
	}
} else {
	register_error($error);
	forward($error_forward_url);
}












