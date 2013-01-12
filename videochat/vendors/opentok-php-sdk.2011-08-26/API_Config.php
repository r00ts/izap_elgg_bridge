<?PHP

/*!
* OpenTok PHP Library
* http://www.tokbox.com/
*
* Copyright 2010, TokBox, Inc.
*
*/
		if(get_plugin_setting("tokbox_method", "videochat") == "api"){
			$partner_key = get_plugin_setting("tokbox_partner_key", "videochat");
			$partner_secret = get_plugin_setting("tokbox_partner_secret", "videochat");
			$api_server = get_plugin_setting("tokbox_api_server", "videochat");
			
			if(!empty($partner_key) && !empty($partner_secret) && !empty($api_server)){
				define("TOKBOX_API_KEY", $partner_key);
				define("TOKBOX_API_SECRET", $partner_secret);
				define("TOKBOX_API_SERVER", "https://" . $api_server . "/hl");
			}
		}

class API_Config {

	// Replace this value with your TokBox API Partner Key
	const API_KEY = TOKBOX_API_KEY;

	// Replace this value with your TokBox API Partner Secret
	const API_SECRET = TOKBOX_API_SECRET;

	const API_SERVER = TOKBOX_API_SERVER;

	const SDK_VERSION = "tbphp-v0.91.2011-08-26";

}
