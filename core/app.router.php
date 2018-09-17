<?php

class App_Router{

    private $route;
    private $path;

    private static $router_exceptions = [
		''      => APP_CONFIG['route.main_page'],
		'login' => 'main/index/login',
		'logout'=> 'main/index/logout',
		'home'  => 'menus',
		'inscripciones' => 'menus/inscripciones',
		'inscripciones/nuevo-ingreso' => 'menus/inscripciones/nuevo-ingreso',
		'inscripciones/nuevo-ingreso/registrar' => 'menus/inscripciones/nuevo-ingreso-registrar',
		'inscripciones/alumno-regular' => 'menus/inscripciones/alumno-regular',
		'inscripciones/alumno-regular/detalles' => 'menus/inscripciones/alumno-regular-detalles',
		'inscripciones/alumno-regular/matricular' => 'menus/inscripciones/alumno-regular-matricular',
		'admin' => 'menus/admin',
		'admin/usuarios' => 'menus/admin/usuarios',
		'admin/nuevo-usuario' => 'menus/admin/nuevo-usuario',
		'admin/eliminar-usuario' => 'menus/admin/eliminar-usuario',
		'admin/inscripciones' => 'menus/admin/inscripciones',
		'admin/cerrar-inscripciones' => 'menus/admin/cerrar-inscripciones'
		
    ];

	public function __construct()
	{
		$this->path = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
    }


	/**
 	 * Returns user input path
	 *
	 * @return string Controller/Class/Method/Id
	 */
	public function get_path()
	{
		return $this->path;
	}

	public function set_path($path)
	{
		$this->path = $path;
	}


	/**
	 * set the system route.
	 *
	 * @param  string $path A user input path or the default one.
	 *
	 * @return array  route
	 */
	public function set_route($path = null)
	{
		if(!$path)
		{ $path = $this->path; }

		return $this->route = $this->get_route($path);
	}


	/**
	 * get the system route.
	 *
	 * @param  string $path A user input path or the default one.
	 *
	 * @return array A system route array.
	 */
	public function get_route($path = null){

		if(!$path)
		{ $path = $this->path; }

		//If there is an exception we use redirection path to create the route.
		if(array_key_exists($path, self::$router_exceptions))
		{ $path = self::$router_exceptions[$path]; }

		$route = str_replace('-', '_', $path);
		$route = explode( APP_CONFIG['route.default_divider'], $route);

		//If no class or method we use index.
		if( !isset( $route[1] ) OR $route[1] == '' )
		{ $route[1] = 'index'; }

		if( !isset( $route[2] ) OR $route[2] == '' )
		{ $route[2] = 'index'; }

		if( !isset( $route[3] ) OR $route[3] == '' )
		{ $route[3] = null; }

		return $route;
	}


	/**
	 * Returns controller class
	 *
	 * @param  array $route A system route array
	 *
	 * @return object|false The controller object or false if fails.
	 */
	public function get_controller($route = null)
	{
		if(!$route)
		{ $route = $this->route; }
		
		//Route must be an array.
		if( !is_array( $route ) )
		{ return false; }

		$controller_name  = "{$route[0]}_controller";
		$controller_dir   = "controllers/{$controller_name}";

		$controller_class_name = "{$route[1]}_controller";
		$controller_class_file = "{$controller_dir}/{$controller_class_name}.php";

		//Ignore for exceptions controllers.
		if( $route[0] != 'exceptions' )
		{
			//False if directory {controller}_controller don't exist.
			if( !file_exists( $controller_dir ) OR !is_dir( $controller_dir ))
			{ return $this->get_exception('controller'); }

			//False if file {class}_controller.php don't exist in {controller}_controller directory.
			else if( !file_exists( $controller_class_file ) )
			{ return $this->get_exception('class_file'); }

		}
		/*
			TODO: check if is_dir and file_exist find the directory without an / at the end.CHECK THE CLASS NAME WE ARE GIVING HERE PROBLEMS WITH MAYUS
		*/

		require_once( $controller_class_file );

		return class_exists( $controller_class_name ) ? new $controller_class_name : false;
	}


	/**
	 * Return exception controller.
	 *
	 * @param  string $type Exception type that will be return.
	 *
	 * @return object|false return the exception object or false if dont exist.
	 */
	public function get_exception($type)
	{
		switch ($type)
		{
			case 'controller':

				$this->route = $this->get_route( 'exceptions/controller' );
				$controller  = $this->get_controller();

				if($controller)
				{ return $controller; }

				break;

			case 'class_file':

				$this->route = $this->get_route( 'exceptions/class_file' );	
				$controller  = $this->get_controller();

				if($controller)
				{ return $controller; }
				break;

			default:
				return false;
				break;
		}

		$this->route = $this->get_route( 'exceptions' );
		$controller  = $this->get_controller();

		if($controller)
		{ return $controller; }

		else
		{ return false; }
	}


	/**
	 * Gets view directory 
	 * 
	 * @param array $route System route array
	 * 
	 * @return string 
	 */
	public function get_view( $route = null )
	{
		if(!$route)
		{ $route = $this->route; }

		$view_name  = "{$route[0]}_views";
		$view_dir   = "views/templates/{$view_name}";

		$view_class_name = "{$route[1]}_views";
		$view_class_file = "{$view_dir}/{$view_class_name}/";

		/*
			TODO: check if is_dir and file_exist find the directory without an / at the end. CHECK THE CLASS NAME WE ARE GIVING HERE PROBLEMS WITH MAYUS
		*/

		return $view_class_file; 
	}

	/**
	 * Gets logic class for provided route.
	 *
	 * @param  array $route System route array.
	 *
	 * @return object|null
	 */
	public function get_logic( $route = null )
	{
		if(!$route)
		{ $route = $this->route; }

		$logic_name  = "{$route[0]}_logic";
		$logic_dir   = "models/logics/{$logic_name}";

		$logic_class_name = "{$route[1]}_logic";
		$logic_class_file = "{$logic_dir}/{$logic_class_name}.php";

		//False if directory {controller}_logic don't exist.
		if( !file_exists( $logic_dir ) OR !is_dir( $logic_dir ) )
		{ return null; }
		//False if file {class}_logic.php don't exist in {controller}_logic directory.
		else if( !file_exists( $logic_class_file ) )
		{ return null; }

		/*
			TODO: check if is_dir and file_exist find the directory without an / at the end. CHECK THE CLASS NAME WE ARE GIVING HERE PROBLEMS WITH MAYUS
		*/

		require_once( $logic_class_file );
		return class_exists( $logic_class_name ) ? new $logic_class_name : null;
	}


	/**
	 * Gets service class for provided route.
	 *
	 * @param  array $route System route array.
	 *
	 * @return object|null
	 */
	public function get_service( $route = null )
	{
		if(!$route)
		{ $route = $this->route; }

		$service_name  = "{$route[0]}_service";
		$service_dir   = "models/services/{$service_name}";

		$service_class_name = "{$route[1]}_service";
		$service_class_file = "{$service_dir}/{$service_class_name}.php";

		//False if directory {controller}_service don't exist.
		if( !file_exists( $service_dir ) OR !is_dir( $service_dir ) )
		{ return null; }
		//False if file {class}_service.php don't exist in {controller}_service directory.
		else if( !file_exists( $service_class_file ) )
		{ return null; }

		/*
			TODO: check if is_dir and file_exist find the directory without an / at the end. CHECK THE CLASS NAME WE ARE GIVING HERE PROBLEMS WITH MAYUS
		*/

		require_once( $service_class_file );
		return class_exists( $service_class_name ) ? new $service_class_name : null;
	}


	/**
	 * Check users permissions.
	 *
	 * @param  object $controller
	 * @param  int    $permission The permission level to evaluate
	 * @param  array  $route      System route array
	 *
	 * @return bool
	 */
	public function get_permissions($controller, $permission, $route = null)
	{
		if(!$route)
		{ $route = $this->route; }

		if( !is_object($controller) OR !property_exists( $controller, 'permissions' ) OR !is_array( $controller->permissions ) )
		{ return true; }

		/*
		Use permission for the method, if don't exist use the permission for
		controller, otherwise permission is asumed
		*/
		$permissions = $controller->permissions;

		if( isset( $permissions[$route[2]] ) )
		{ return $permission <= $permissions[$route[2]]; }

		else if( isset( $permissions[$route[1]] ) )
		{ return $permission <= $permissions[$route[1]]; }

		else{ return true; }
	}


	public function get_auth($controller, $route = null)
	{
		if(!$route)
		{ $route = $this->route; }

		if( !is_object($controller) )
		{ return true; }

		if(!property_exists( $controller, 'auth' ) OR !is_array( $controller->auth ) )
		{ $controller->auth = []; }

		$auth = $controller->auth;
		
		if( !isset($auth[ $route[2] ] ) OR $auth[ $route[2] ] == true )
		{ return isset( $_SESSION[ APP_CONFIG['session.name'] ] ); }

		else{ return true; }
	}

	/**
	 * Executes the method with the selected id.
	 *
	 * @param  object $controller	Controller class
	 * @param  array  $route        A system route array
	 * @param  bool   $use_id       If true use id in the route.
	 *
	 * @return bool   true if it success.
	 */
	public function call($controller, $use_id = true, $route = null)
	{
		if(!$route)
		{ $route = $this->route; }

		if( !is_array( $route ) )
		{ return false; }

		if( !method_exists( $controller, $route[2] ) )
		{ return false; }

		$controller->{ $route[2] }( $use_id ? $route[3] : null );

		return true;
	}

}
