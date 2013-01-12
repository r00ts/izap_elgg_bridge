We've spent many hours creating free plugins for Elgg. Please take a minute to give something back by liking 
us on facebook http://www.facebook.com/webintelligence.ie and following us on twitter https://twitter.com/webint_ie

Installation:

1/ Go to http://www.elggstore.webintelligence.ie and download latest version of Web Intelligence Framework and install in mod folder

2/ Unzip plugins and copy auction and bids to mod folder

3/ If you have the existing Auctions bundle plugin, then run the following SQL commands on your sql server so your older auctions entities will work with the new plugin (N.B. if you have a different database prefix to "elgg_" then change to that in the statements below):


update elgg_entity_subtypes set subtype = "wiauction" where subtype = "auction";

update elgg_entity_subtypes set subtype = "wibid" where subtype = "bid";

update elgg_entity_subtypes set subtype = "wiauctioncategory" where subtype = "auctioncategory";


update elgg_entity_relationships set relationship = "active_wiauction" where relationship = "active_auction";

update elgg_entity_relationships set relationship = "expired_wiauction" where relationship = "expired_auction";

update elgg_entity_relationships set relationship = "cancelled_wiauction" where relationship = "cancelled_auction";

update elgg_entity_relationships set relationship = "closed_wiauction" where relationship = "closed_auction";

update elgg_entity_relationships set relationship = "wiauction_wibid_lose" where relationship = "auction_bid_lose";

update elgg_entity_relationships set relationship = "wiauction_wibid_win" where relationship = "auction_bid_win";

update elgg_entity_relationships set relationship = "wiauction_wiauctioncategory" where relationship = "auction_auctioncategory";

update elgg_entity_relationships set relationship = "wiauction_wibid" where relationship = "auction_bid";



4/ Add categories under admin > settings > wicategories

5/ Set the currency in Auction settings


Note: If you are comfortable with crons and run the hourly cron, then comment out wi_check_entity_expiry(); on line 137 in auction/lib/auction.php and uncomment elgg_register_plugin_hook_handler('cron', 'hourly', 'auctions_status_cron');in auction/start.php. This will improve performance as expiry dates of auctions will only be checked when the hourly cron is run and not every time you load all auctions page.