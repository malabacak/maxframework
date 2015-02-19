<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_DEPRECATED);
function autoloader($class)
{

	require './'. $class . '.php';
}
spl_autoload_register('autoloader');
/* -------------------------------------------------------------- */
use Framework\Server\Input as Input;

echo Input::get("a.1");