<?php
public static function get($name){
	return isset($_SESSION[$name]) ? true : false;
}

public static function put($name,$valie){
	return $_SESSION[$name] = $value;
}
