<?php

//Creamos una serie de constantes con los datos de la conexion para que no puedan ser editados

    define ("DB_HOST", "mysql:dbhost=localhost;dbname=redes");
	define ("DB_HOSTNAME", "localhost");
    define ("DB_USUARIO", "root");
    define ("DB_CONTRA", "");
    define ("DB_CHARSET", "utf8");

class conexion{

    private $conexion;

    function __construct(){

        try{

        $this->conexion = new PDO(DB_HOST, DB_USUARIO, DB_CONTRA);

        $this->conexion ->exec("SET CHARACTER SET ". DB_CHARSET);

        $this->conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(Exception $e){

			$codigo = $e->getCode();

			switch ($codigo) {

				case '1049': //No existe la base de datos.

					//Creamos la base de datos, con todos sus elementos internos.Gracias a la función crear_db y crear_tablas de la libreria control_db.
					crear_db();
					crear_tablas();

					header('location:' . HTTP);

					break;

				default: //Comportamiento para cualquier error desconocido.

                echo 'error db conexion'; 
			}

            exit();
        	$this->conexion = 'failed';

        }finally{
        return $this->conexion;
        }
    }

    private function consulta($sql, $param_array, $fetch){

        try{

            $this -> consulta = $this->conexion->prepare($sql);

            if($param_array != null){

                foreach ($param_array as $clave => $valor){
                    $this->consulta->bindValue($clave, $valor);
                }

            }

            $this-> consulta -> execute();

            if($fetch === true)
            { $this->consulta = $this->consulta->fetchAll(PDO::FETCH_ASSOC); }

            if($fetch === 'one')
            { $this->consulta = $this->consulta->fetch(PDO::FETCH_ASSOC); }

        }catch (Exception $e){

			$codigo = $e->getMessage();

			switch ($codigo) {

				default:

					echo '78: ' . $codigo; 
			}

            exit();

            $this->consulta = false;
        }

        return $this->consulta;

    }

    public function query( $sql, $param_array = null, $fetch = true){

        $consulta = $this->consulta($sql, $param_array, $fetch);
        return $consulta;
    }

    public function desconectar(){
        $this->conexion = null;
        $this->consulta->closeCursor();
        $this->consulta = null;
    }
}
