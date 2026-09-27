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
 
if ( !defined('IMG_DIR') )
	define('IMG_DIR', ABSPATH . 'img/'); // caminho no disco, usado por move_uploaded_file/unlink
 
if ( !defined('IMG_URL') )
	define('IMG_URL', BASEURL . 'img/'); // caminho de URL, usado nos <img src="...">
 
const HEADER_TEMPLATE = ABSPATH . "inc/header.php";
const FOOTER_TEMPLATE = ABSPATH . "inc/footer.php";