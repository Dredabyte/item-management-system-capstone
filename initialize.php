<?php
$dev_data = array('id'=>'-1','firstname'=>'Aeldred','lastname'=>'Tañahura','username'=>'dred','password'=>'59771479da5a928009179e37f3482e45','last_login'=>'','date_updated'=>'','date_added'=>'');
if(!defined('base_url')) define('base_url','http://localhost/item-management-system-capstone/'); // you can change the localhost into an IP address to access it in different devices.
if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );
if(!defined('dev_data')) define('dev_data',$dev_data);
if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
if(!defined('DB_USERNAME')) define('DB_USERNAME',"root");
if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"");
if(!defined('DB_NAME')) define('DB_NAME',"imsc_db");
?>