<?php

/*

setup application and bootstrap it.
*/

date_default_timezone_set(APP_CONFIG['system.date_timezone']);


if(dirname($_SERVER['PHP_SELF']) == '/' OR dirname($_SERVER['PHP_SELF']) == '\\')
{
	$dir = '';
}else{
	$dir = dirname($_SERVER['PHP_SELF']);
}


define ("HOST"     , $_SERVER['HTTP_HOST'] );
define ("DIR"      , $dir );
define ("HTTP"     , 'http://' . HOST . DIR);


require 'core/app.bootstrap.php';

$bootstrap = new Bootstrap;
$bootstrap->run();
