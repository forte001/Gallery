<?php 
/*
The autoload function is used to point to classes or methods
that are mistakenly omitted in the init.php file. However, autoload has been deprecated and been replaced by spl_autoload_register.

spl_autoload_register allows multiple autoloaders, hence making it more robust than autoload.

*/
function _classAutoLoader($class){

	$class = strtolower($class);

	$path = "includes/'{$class}'.php";

	//This detects the missing class and adds it 

	// if (file_exists($path)){

	// 	require_once($path);
	// } else {
	// 	die("This file name {$class}.php was not found.");
	// }

	if (is_file($path) && !class_exists($class)){

		include $path;
	}
}

// The special method - redirect for redirecting users from one page to another.

function redirect($location){

header("Location: {$location}");
}

spl_autoload_register('_classAutoLoader');

?>