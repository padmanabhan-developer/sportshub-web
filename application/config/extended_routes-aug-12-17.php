<?php
 include_once("database.php");
 
 mysql_select_db($db['default']['database'],@mysql_connect($db['default']['hostname'],$db['default']['username'],$db['default']['password']));

// for admin
$route['admin/establishments']="admin/establishments";
$route['admin/login']="admin/login";
$route['admin/user']="admin/user";
$route['admin/matches']="admin/matches";
$route['admin/rating-comment']="admin/rating_comment";

$route['android/api/matches']="androidapi/matches";
//$route['androidapi/matches']="android/api/matches";

//for app
$route['app/login']="app/login";
$route['app/profile_setting']="app_profile_setting";
$route['app/tv_provider_channel']="App_tv_provider_channel/my_tv_schedule";
$route['app/schedule']="App_schedule";
$route['app/my_tv_schedule']="App_my_tv_schedule/my_tv_schedule";
$route['app/goto_my_tv_schedule']="App_my_tv_schedule/goto_my_tv_schedule";

$route['app/gotoschedule']="App_schedule/gotoschedule";
$route['app/display_schedule']="App_schedule/display_schedule";
$route['app/display_fixture']="App_schedule/display_fixture";
$route['app/display_search_fixture']="App_schedule/display_search_fixture";
$route['app/display_search_channel']="App_schedule/display_search_channel";

$route['app/tv_provider_channel']="App_tv_provider_channel/my_tv_schedule";
$route['app/display_search_my_tv_fixture']="App_my_tv_schedule/display_search_my_tv_fixture";
$route['app/downloadpdf']="App_my_tv_schedule/downloadpdf";
$route['app/emailpdf']="App_my_tv_schedule/emailpdf";


$route['establishment/schedule']="Establishment_schedule";
$route['establishment/my_tv_schedule']="Establishment_schedule/my_tv_schedule";
$route['establishment/home']="establishment_home";
$route['establishment/offers']="establishment_offers";
$route['establishment/display_offer']="establishment_offers/display_offer";

$route['establishment/events']="establishment_events/events";
$route['establishment/display_open']="establishment_events/display_open";
$route['establishment/filter_events']="establishment_events/filter_events";
$route['establishment/profile_settings']="establishment_profile_settings";
$route['establishment/profile_image']="establishment_profile_image";
$route['establishment/remove_gallery_image']="establishment_profile_image/remove_gallery_image";
$route['establishment/upgrade']="establishment_upgrade";

$route['establishment']="establishment/home";
$route['establishment/payment']="establishment_payment/payment";
$route['establishment/redirect_to_payment']="establishment/redirect_to_payment";

$route['establishment/gotoschedule']="Establishment_schedule/gotoschedule";
$route['establishment/display_schedule']="Establishment_schedule/display_schedule";
$route['establishment/display_fixture']="Establishment_schedule/display_fixture";
$route['establishment/display_search_fixture']="Establishment_schedule/display_search_fixture";
$route['establishment/display_search_channel']="Establishment_schedule/display_search_channel";

$route['establishment/schedule/page/(:num)']="Establishment_schedule/index/$1";

$route['establishment/tv_provider_channel']="Establishment_tv_provider_channel/my_tv_schedule";
$route['establishment/goto_my_tv_schedule']="Establishment_my_tv_schedule/goto_my_tv_schedule";
$route['establishment/my_tv_schedule']="Establishment_my_tv_schedule/my_tv_schedule";
$route['establishment/display_search_my_tv_fixture']="Establishment_my_tv_schedule/display_search_my_tv_fixture";
$route['establishment/downloadpdf']="Establishment_my_tv_schedule/downloadpdf";
$route['establishment/emailpdf']="Establishment_my_tv_schedule/emailpdf";

//$route['are_you_venue']="promotion/venue";
$route['promotion']="promotion/promotion_new";
$route['promotions']="promotion/promotions";
$route['home']="promotion/home";
$route['venue']="promotion/venue";
$route['download']="promotion/download";
$route['privacy']="promotion/privacy";
$route['terms']="promotion/terms";
$route['app']="promotion/personalplanner";
$route['sportsfans']="promotion/sportslover";
$route['recommendbar']="promotion/recommendbar";


?>