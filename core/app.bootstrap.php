<?php

/*

	Startout the application and controls it behavior.

 */

// TODO: Document this class in the future.

class Bootstrap {

	private $route;

	public function __construct()
	{
		require_once('core/app.router.php');
		$this->route = new App_Router;
	}

	public function set_controller()
	{
		$this->route->set_route();
		return $this->route->get_controller();
	}

	public function set_view($controller)
	{

		require_once('libs/easyView/easyView.php');

		$view = new EasyView( $this->route->get_view(), 'views/layouts/');

		if( is_object($controller) AND property_exists( $controller, 'view' ) )
		{ $controller->view = $view; }
	}

	public function set_model($controller)
	{
		if( is_object($controller) AND property_exists( $controller, 'logic' ) )
		{ $controller->logic   = $this->route->get_logic(); }

		if( is_object($controller) AND property_exists( $controller, 'service' ) )
		{ 
			$controller->service = $this->route->get_service(); 
		}

		if( is_object($controller->service) AND property_exists( $controller->service, 'sql' ) )
		{ 
			include_once('models/connection.model.php');
			$controller->service->sql = new conexion();
		}
	}

	/**
	 * Execute the application
	 */
	public function run()
	{
		/* TODO: Add the options of give access to no logged users
		in this case, if the permission is 0 it will give access for everyone even those users
		that are not login. This is not asume as the default behavior. Also check if the user
		is login in order to make this exception right if not, use session.fallback.
		*/
		$controller = $this->set_controller();

		if( !isset( $_SESSION[ APP_CONFIG['session.name'] ][ APP_CONFIG['session.permission'] ] ) )
		{
			$permission_value = 99999;
		}else{
			$permission_value = $_SESSION[ APP_CONFIG['session.name'] ][ APP_CONFIG['session.permission'] ]; 
		}

		$auth= $this->route->get_auth( $controller );

		if( $auth == false )
		{ header('location:' . HTTP . '/' . APP_CONFIG['exception.auth']); };

		$permission = $this->route->get_permissions( $controller, $permission_value );

		if(!$permission)
		{
			header('location:' . HTTP . '/' . APP_CONFIG['exception.access_denied']);
			$route      = $this->route->set_route( APP_CONFIG['exception.access_denied'] );
			$controller = $this->route->get_controller( $route );
		}


		$this->set_view ( $controller );
		$this->set_model( $controller );

		$this->route->call($controller);
	}
}
