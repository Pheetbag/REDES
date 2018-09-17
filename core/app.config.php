<?php

/*

Global configs

*/

 const APP_CONFIG =
 [
    'system.date_timezone'      => 'America/Caracas',

    'route.main_page'           => 'main',
    'route.default_divider'     => '/',

    'session.name'              => 'user',
    'session.fallback'          => 'entrar',
	'session.permission'       => 'permissions',

    /*TODO: agregar la manipulación de excepciones, en caso
    en caso de error buscar la exception especifica, sino, usar la
    exception global.
    */
    'exception.global'          => 'exceptions/index',
    'exception.controller'      => 'exceptions/controller',
    'exception.access_denied'   => '',
    'exception.auth'            => ''
 ];
