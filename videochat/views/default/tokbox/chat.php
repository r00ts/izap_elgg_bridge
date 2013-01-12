<?php 
        /**
         * @package OpenTok VideoChat
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
	 * @author Jeroen Dalsem, ColdTrick IT Solutions [jdalsem@coldtrick.com]
         * @link http://coldtrick.com/
	 * @remark Please see CREDITS
         */

        $display_name= '';
	if($user = get_loggedin_user()){
		 $display_name= $user->name;
	} elseif($name = get_input("name", false)){
		 $display_name= $name;
	}
	if($room = $vars["room"]){
		$popin_url = $vars["url"] . "pg/videochat/join/" . $room->getGUID();
	}
	
	if(!$vars["popout"]) {
		if($room = $vars["room"]){
			$popout_url = $vars["url"] . "pg/videochat/join/" . $room->getGUID() . "?popout=true";
		}
		$popout = elgg_view("videochat/popout", array("room_container" => "videochat_tokbox_room", "popout_url" => $popout_url));
	}
	$room = $vars["room"];
	$session_id=$room->session_id;
	$api_server = get_plugin_setting("tokbox_api_server", "videochat");
?>

		<script src="http://<?php echo $api_server; ?>/v0.91/js/TB.min.js" type="text/javascript" charset="utf-8"></script>
   		<script type="text/javascript">
		var sessionId = "<?php echo $session_id;?>";

		var popoutchild;
		var session;
		var publisher;
		var subscribers = {};
		var popedout = false;
		// Un-comment either of the following to set automatic logging and exception handling.
		// See the exceptionHandler() method below.
		// TB.setLogLevel(TB.DEBUG);
		// TB.addEventListener("exception", exceptionHandler);

		if (TB.checkSystemRequirements() != TB.HAS_REQUIREMENTS) {
			alert("You don't have the minimum requirements to run this application."
				  + "Please upgrade to the latest version of Flash.");
		} else {
			session = TB.initSession(sessionId);

			// Add event listeners to the session
			session.addEventListener("sessionConnected", sessionConnectedHandler);
			session.addEventListener("sessionDisconnected", sessionDisconnectedHandler);
			session.addEventListener("streamCreated", streamCreatedHandler);
			session.addEventListener("streamDestroyed", streamDestroyedHandler);
			session.addEventListener("connectionCreated", connectionCreatedHandler);
			session.addEventListener("connectionDestroyed", connectionDestroyedHandler);
		}

		//--------------------------------------
		//  OPENTOK EVENT HANDLERS
		//--------------------------------------

		function sessionConnectedHandler(event) {
			setStatus("");
			for (var i = 0; i < event.streams.length; i++) {
				addStream(event.streams[i]);
			}
			for (i = 0; i < event.connections.length; i++) {
				addConnection(event.connections[i]);
			}
			show('publishLink');
			hide('connectLink');

			startPublishing();
		}

		function sessionDisconnectedHandler(event) {
			if (!popedout) {
				window.location.replace("<?php echo $CONFIG->wwwroot . 'pg/videochat';?>");
			}
			hide('publishLink');
			hide('unpublishLink');
		}

		function streamCreatedHandler(event) {
			for (var i = 0; i < event.streams.length; i++) {
				addStream(event.streams[i]);
			}
		}

		function streamDestroyedHandler(event) {
			for (var i = 0; i < event.streams.length; i++) {
				removeStream(event.streams[i].streamId);
				if (event.streams[i].connection.connectionId == session.connection.connectionId) {
					publisher = null;
				} else {
					removeStream(event.streams[i].streamId);
				}
			}
		}

		function connectionCreatedHandler(event) {
			for (i = 0; i < event.connections.length; i++) {
				addConnection(event.connections[i]);
			}
		}

		function connectionDestroyedHandler(event) {
			for (i = 0; i < event.connections.length; i++) {
				removeConnection(event.connections[i]);
			}
		}

		/*
		If you un-comment the call to TB.addEventListener("exception", exceptionHandler) above, OpenTok calls the
		exceptionHandler() method when exception events occur. You can modify this method to further process exception events.
		If you un-comment the call to TB.setLogLevel(), above, OpenTok displays exception event messages to the debugging console.
		*/
		function exceptionHandler(event) {
			alert("Exception: " + event.code + "::" + event.message);
		}

		//--------------------------------------
		//  LINK CLICK HANDLERS
		//--------------------------------------

		/*
		If testing the app from the desktop, be sure to check the Flash Player Global Security setting
		to allow the page from communicating with SWF content loaded from the web. For more information,
		see http://www.tokbox.com/opentok/build/tutorials/helloworld.html#localTest
		*/
		function connect() {
			var username = "<?php echo $display_name;?>";
			if (username=="") {
				username=document.getElementById("username").value;
			} else {
			        document.getElementById("username").value= username;			  
			}
			var sessionContent = document.getElementById("sessionContent");
			if (username == "") {
				show("login");
				hide('popoutLink');

				show("warning");
				return;
			} else {
			  $.ajax({url: "<?php echo $CONFIG->wwwroot;?>mod/videochat/gentoken.php",
			  data: {guid: "<?php echo $room->getGUID();?>", name: username},
			  async: false,
			  	       success: function(token){
				       		session.connect(<?php echo API_Config::API_KEY;?>, token);
				       		hide("login");
						hide("warning");
						show("sessionContent");
						setStatus("Connecting...");
				       }
			  });
			}
		}
		function disconnect() {
			if (window.name=='videochat') {
			   window.opener.location='<?php echo $popin_url; ?>' + '&name=' + document.getElementById("username").value;
			   window.close();
			} else {
			  for (streamId in subscribers) {
				removeStream(streamId)
			  }
			  stopPublishing();
			  session.disconnect();
			  hide('publishLink');
			  hide('unpublishLink');
			}
		}

		// Called when user wants to start publishing to the session
		function startPublishing() {
			if (!publisher) {
				var parentDiv = document.getElementById("myCamera");
				var publisherDiv = document.createElement('div'); // Create a div for the publisher to replace
				publisherDiv.setAttribute('id', 'opentok_publisher');
				parentDiv.appendChild(publisherDiv);
				publisher = session.publish(publisherDiv.id); // Pass the replacement div id to the publish method
				show('unpublishLink');
				hide('publishLink');
			}
		}

		function stopPublishing() {
			if (publisher) {
				session.unpublish(publisher);
			}
			publisher = null;

			show('publishLink');
			hide('unpublishLink');
		}

		//--------------------------------------
		//  HELPER METHODS
		//--------------------------------------

		function addStream(stream) {
			if (stream.connection.connectionId == session.connection.connectionId) {
				return;
			}
			// Create the container for the subscriber
			var container = document.createElement('div');
			container.className = "subscriberContainer";
			var containerId = "container_" + stream.streamId;
			container.setAttribute("id", containerId);
			document.getElementById("subscribers").appendChild(container);

			// Create the div that will be replaced by the subscriber
			var div = document.createElement('div');
			var divId = stream.streamId;
			div.setAttribute('id', divId);
			div.style.cssFloat = "top";
			container.appendChild(div);

			// Create a div for the user data
			var subscriberData = document.createElement('div');
			subscriberData.style.cssFloat = "bottom";
			var connectionData = getConnectionData(stream.connection);
			subscriberData.style.margin = "0px 0px 2px 4px";
			subscriberData.innerHTML = connectionData.username;
			container.appendChild(subscriberData);

			subscribers[stream.streamId] = session.subscribe(stream, divId);
		}

		function addConnection(connection) {
//			if (connection.connectionId != session.connection.connectionId) {
				var connectionListing = document.createElement('p');
				connectionData = getConnectionData(connection);
				connectionListing.style.margin = "0px 0px 2px 4px";
				connectionListing.innerHTML = connection.connectionId;
				connectionListing.innerHTML = connectionData.username;
				connectionListing.setAttribute("id", connection.connectionId);
				document.getElementById("connections").appendChild(connectionListing);
//			}
		}

		function getConnectionData(connection) {
			try {
				connectionData = JSON.parse(connection.data);
			} catch(error) {
				connectionData = eval("(" + connection.data + ")" );
			}
			return connectionData;
		}

		function removeStream(streamId) {
			var subscriber = subscribers[streamId];
			if (subscriber) {
				var container = document.getElementById(subscriber.id).parentNode;

				session.unsubscribe(subscriber);
				delete subscribers[streamId];

				// Clean up the subscriber container
				document.getElementById("subscribers").removeChild(container);
			}
		}
		
		function removeConnection(connection) {
			connectionListing = document.getElementById(connection.connectionId);
			if (connectionListing) {
				document.getElementById("connections").removeChild(connectionListing);
			}
		}

		function setStatus(statusString) {
			document.getElementById("status").innerHTML = statusString;
		}

		function show(id) {
			document.getElementById(id).style.display = 'block';
		}

		function hide(id) {
			document.getElementById(id).style.display = 'none';
		}
		function closepopup() {
			 hide('popinLink');
			 $("#connections *").remove();
			 popoutchild.close();
		 	 popedout=false;
			 $("#videochat_tokbox_room").show();
			 connect();
			 $("#videochat_popout span").hide();
		}
        </script>


<div class='contentWrapper'>
<div display="float:top;">
<div id="videochat_links">
<?php if (!$vars['popout']) {
?>
        <input type="button" value="Rooms" id ="roomsLink" style="display:block;" onClick="javascript:window.location.replace('<?php echo $CONFIG->wwwroot . 'pg/videochat';?>');" />
<?php
} else {
?>
        <input type="button" value="Close popout" id ="closeLink" style="display:block;" onClick="window.close();" />
<?php
}
?>
       	<input type="button" value="Start Publishing" id ="publishLink" onClick="javascript:startPublishing()" />
       	<input type="button" value="Stop Publishing" id ="unpublishLink" onClick="javascript:stopPublishing()" />
        <input type="button" value="Pop in" id ="popinLink" onClick="javascript:closepopup()" />
	<?php 
		echo $popout;

		if(!empty($vars["callUrl"])){ ?>

  <div id="videochat_tokbox_room">

	<div id="login">
    	  <p>Enter your name:
    	    <input type="text" id="username" maxlength="32"/>
          </p>
          <p><input type="button" value="Connect" id ="connectLink" onClick="javascript:connect()" /></p>
          <p id="warning" style="display:none; color:#F00">Please enter your name.</p>
        </div>

    <div id="sessionContent" style="display:none; clear:both">
        <div id="topBar">
        	<div id="status"></div>
        </div>
        <div id="myCamera" class="publisherContainer" style="height:220px; margin-right:10px"></div>
        <div id="subscribers" style="height:240px" style="float:left"></div>
	<div class="contentWrapper">
        <div id="connectionsContainer" style="clear:both">
	        <p style="margin:4px">Connected users:</p>
        	<div id="connections"></div>
        </div>
	</div>
    </div>
	</div>
	<?php 
} else {
	echo elgg_echo("videochat:rooms:missing_call_url");
}
	?>
</div>

<script>
	$(window).unload(function () { disconnect(); });
	show('popoutLink');
</script>

<?php
   if ($display_name!="") {
?>
	<script>
	connect();
	</script>
<?php
}
?>
