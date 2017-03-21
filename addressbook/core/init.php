<?php
//Include Config
require_once('config/config.php');

//Helper Files
require_once('helpers/system_helper.php');




//AutoLoad
function __autoload($class_name) {
	require_once('libraries/'.$class_name.'.php');
}

