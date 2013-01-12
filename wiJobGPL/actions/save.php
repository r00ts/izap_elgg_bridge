<?php
/**
 * Elgg WI Job vGPL Plugin
 * @package WI Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

// start a new sticky form session in case of failure
elgg_make_sticky_form('wijob');


// store errors to pass along
$error = FALSE;
$error_forward_url = REFERER;
$user = elgg_get_logged_in_user_entity();


// edit or create a new entity
$wijob_id = get_input('guid');


if ($wijob_id) {
	$wijob = get_entity($wijob_id);
	if (!(elgg_instanceof($wijob, 'object', 'wijob') && $wijob->canEdit()&&(wi_get_entity_status($wijob->getGUID())=="active"||wi_get_entity_status($wijob->getGUID())=="expired"))) {		
			
		register_error(elgg_echo('wijob:error:post_not_found'));
		forward(get_input('forward', REFERER));	
	} 

	// save some data for revisions once we save the new edit
	//$revision_text = $wijob->description;
	$new_post = false;
} else {
	$wijob = new ElggObject();
	$wijob->subtype = 'wijob';
	$new_post = TRUE;
}


// set defaults and required values.
$values = array(
	'title' => '',
	'description' => '',
	'access_id' => ACCESS_PUBLIC,
	'tags' => '',
	'budget' => '',
        'category' => '',
	'container_guid' => (int)get_input('container_guid'),
);


// fail if a required entity isn't set
$required = array('title', 'description', 'category', 'expiry_date');

$budget = false;

// load from POST and do sanity and access checking
foreach ($values as $name => $default) {
	$value = get_input($name, $default);

	if (in_array($name, $required) && empty($value)) {
		$error = elgg_echo("wijob:error:missing:$name");
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
					$error = elgg_echo("wijob:error:cannot_write_to_container");
				}
			} else {
				unset($values[$name]);
			}
			break;
			
		case 'category':
                        $cat_id = $value;
			unset ($values[$name]);
			break;	
                                             

		case 'budget':
			if (is_numeric($value)) {
				$values[$name] = $value;
                                $budget = true;
			}
                        elseif (strlen($value)>0){
				$error = elgg_echo("wijob:error:budget_num");
				unset ($values[$name]);
                        }
                        else {

			}
			break;	                       

		// don't try to set the guid
		case 'guid':
			unset($values['guid']);
			break;			
						
		default:
			$values[$name] = $value;
			break;
	}
}



//do the file checks here
                    //upload file if there	
            if ((!empty($_FILES['upload']['name']))) {
                
                $isfile = true;
                    
                    //check if error firled is set, means image size is bigger than upload_file_size set in cli php.ini
                    if ($_FILES['upload']['error']) {
                            if ($_FILES['upload']['error'] == 1) {
                                   $error = elgg_echo('wijob:file_too_big');
                            } else {
                                    $error = elgg_echo('wijob:file_unk_error');
                            }
                    }
                    
                    if(!$error){
                        $mime = $_FILES['upload']['type'];

                            // must be an image
                            if (!wi_upload_check_format($mime)) {
                                    $error = elgg_echo('wijob:not_correct');
                            }	
                    }



                    if(!$error && wi_file_get_simple_type($_FILES['upload']['type'])=="image"){                    
                        // make sure the in memory image size does not exceed memory available
                        $imginfo = getimagesize($_FILES['upload']['tmp_name']);

                        if (!wi_upload_memory_check($imginfo[0] * $imginfo[1])) {

                                $error = elgg_echo('skill:image_pixels');
                        }	
                    }
                    
            }


// assign values to the entity, stopping on error.
if (!$error) {
	foreach ($values as $name => $value) {
		if (FALSE === ($wijob->$name = $value)) {
			$error = elgg_echo('wijob:error:cannot_save' . "$name=$value");
			break;
		}
	}
}



// only try to save base entity if no errors
if (!$error) {
	
	$wijob_id = $wijob->save();
        
	if ($wijob_id) {
            
                //remove relationship between user and wijob
                if(!wi_remove_entities_relationship("expired_wijob", $user, $wijob)){
                        register_error(elgg_echo('wijob:save:failure'));
                        forward(REFERER);                    
                }
            
            
            //add relationship between user and wijob
                if(!wi_add_entities_relationship("active_wijob", $user, $wijob)){
                        register_error(elgg_echo('wijob:save:failure'));
                        forward(REFERER);                    
                }
                
                
             if(!wi_save_entity_category("wijob", $wijob_id, $cat_id)){
                 $error = elgg_echo('wijob:error:cannot_save');
                 register_error($error);
                 forward('wijob/all');
             }                   
		
		//save the file id
		if($isfile){
         
                            //Do the file upload stuff
                            $file = new FilePluginFile();
                            $file->subtype = "file";

                            $prefix = "file/";

                            $filestorename = elgg_strtolower(time().$_FILES['upload']['name']);

                            $file->access_id = ACCESS_PUBLIC;

                            $file->setFilename($prefix.$filestorename);
                            $file->setMimeType($_FILES['upload']['type']);   

                            $file->originalfilename = $_FILES['upload']['name'];
                            $file->simpletype = wi_file_get_simple_type($_FILES['upload']['type']);

                            // Open the file to guarantee the directory exists
                            $file->open("write");
                            $file->close();
                            move_uploaded_file($_FILES['upload']['tmp_name'], $file->getFilenameOnFilestore());

                            $file->save();
                            $file_guid = $file->getGUID();
                    // }  
                           // unlink($file->getFilenameOnFilestore());

                            //check for the previous file and delete

                            $del_guid = (int) get_input('del_guid');

                            if($del_guid){

                                    $del_file = new FilePluginFile($del_guid);
                                    if (!$del_file->getGUID()) {
                                            register_error(elgg_echo('wijob:save:failure'));
                                            forward($error_forward_url);
                                    }


                                    if (!$del_file->delete()) {
                                        $error = "error";
                                    }
                                    
                                    //remove old relationship between wijob and file
                                    if(!wi_remove_entities_relationship("wijob_file", $wijob, $del_file)){
                                            register_error(elgg_echo('wijob:save:failure'));
                                            forward($error_forward_url);                 
                                    }                                    
                            }		
                    

                            if(!$file_guid && $isfile){
                                        $error = "error";
                            }
                              

                    //create relationship between wijob and file  
                        if(!wi_add_entities_relationship("wijob_file", $wijob, $file)){
                                register_error(elgg_echo('wijob:save:failure'));
                                forward(REFERER);                    
                        }                 
			
		}		
		
		// remove sticky form entries
		elgg_clear_sticky_form('wijob');


              if(!wi_save_entity_category("wijob", $wijob_id, $cat_id)){
                 $error = elgg_echo('wijob:error:cannot_save');
                 register_error($error);
                 forward('job/all');
             }   		

			if($new_post){
				$forward = "added";
        add_to_river('river/object/wijob/create','create',elgg_get_logged_in_user_guid(),$wijob_id);
			}
			else{
				$forward = "edited";
			}
                        forward("job/confirm/".$wijob_id."/".$forward);

	} else {	
		register_error(elgg_echo('wijob:save:failure'));
		forward($error_forward_url);
	}
} else {
	register_error($error);
	forward($error_forward_url);
}












