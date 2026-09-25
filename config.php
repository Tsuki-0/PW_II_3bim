<?php
const DB_NAME = "wda_crud";

define('DB_USER', 'root');

define('DB_PASSWORD', '');

define('DB_HOST', 'localhost');

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

if ( !defined('BASEURL') )
	define('BASEURL', '/PW_II_3bim/');
	
if ( !defined('DBAPI') )
	define("DBAPI", ABSPATH . 'inc/database.php');

const HEADER_TEMPLATE = ABSPATH . "inc/header.php";
const FOOTER_TEMPLATE = ABSPATH . "inc/footer.php";