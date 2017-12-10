<?php
ob_start();
session_start();
$GLOBALS['config'] = [
	'mysql' => [

		'host' => '127.0.0.1',
		'user' => 'root',
		'pass' => '',
		'db' => 'evaluation'
	]
];
spl_autoload_register(function($class){
	require_once '../classes/'.$class.'.php';
});

require_once '../functions/sanitize.php';