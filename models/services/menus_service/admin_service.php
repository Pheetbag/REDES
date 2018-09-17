<?php

class Admin_Service{
    
    public $sql; 

    public function set_usuario($name, $apll, $user, $pass, $range)
    {
        $values = [
            ':name'    => $name,
            ':apll'    => $apll,
            ':useri'    => $user,
            ':pass'    => $pass,
            ':range'   => $range
        ];

        return $this->sql->query('INSERT INTO `usuarios`(`nombre`, `apellido`, `usuario`, `contrasena`, `rango`) VALUES (:name, :apll, :useri, :pass, :range)', $values, false);

    }

    public function cerrar_inscripciones($turno)
    {
        switch ($turno) {
            case 'mañana':

                $this->sql->query("UPDATE `config` SET `active` = '0' WHERE `config`.`name` = 'inscripcion.statusM'", null, false); 
                break;
            
            case 'tarde':
                $this->sql->query("UPDATE `config` SET `active` = '0' WHERE `config`.`name` = 'inscripcion.statusT'", null, false); 
                break;
        }
    }

    public function abrir_inscripciones($turno)
    {
        switch ($turno) {
            case 'mañana':

                $this->sql->query("UPDATE `config` SET `active` = '1' WHERE `config`.`name` = 'inscripcion.statusM'", null, false); 
                break;
            
            case 'tarde':
                $this->sql->query("UPDATE `config` SET `active` = '1' WHERE `config`.`name` = 'inscripcion.statusT'", null, false); 
                break;
        }
    }

    public function get_matriculas($anio, $turno)
    {

        $params = [
            ':turno' => $turno,
            ':grado' => $anio,
            ':fecha' => date('Y')
        ];
        return $this->sql->query("SELECT m.`id` FROM `matriculas` m JOIN `estudiantes` c WHERE c.`id` = m.`id_estudiante` AND m.`fecha` = :fecha AND m.`grado` = :grado AND m.`turno` = :turno AND m.`seccion`  = null  ORDER BY c.`edad` ASC", $param, true); 
    }

    public function get_config($type)
    {
        switch ($type) {
            case 'secciones':

                $secciones = $this->sql->query("SELECT `value` FROM `config` WHERE `name` = 'inscripcion.numSecciones'", null, 'one')['value']; 

                return $secciones = explode(',', $secciones);
                break;

            case 'estudiantes':
                
                return $this->sql->query("SELECT `value` FROM `config` WHERE `name` = 'inscripcion.estudiantesPerSecc'", null, 'one')['value']; 
                break;    

            case 'estudiantesMin':
                
                return $this->sql->query("SELECT `value` FROM `config` WHERE `name` = 'inscripcion.minPerSalon'", null, 'one')['value']; 
                break;
        }
    }

    public function state_inscripciones($turno)
    {

        switch ($turno) {
            case 'mañana':
                return $this->sql->query("SELECT `active` FROM `config` WHERE `name` = 'inscripcion.statusM'", null, 'one'); 
                break;
            
            case 'tarde':
                return $this->sql->query("SELECT `active` FROM `config` WHERE `name` = 'inscripcion.statusT'", null, 'one'); 
                break;
        }
    }


    public function delete_usuario($id)
    {
        return $this->sql->query('DELETE FROM `usuarios` WHERE `usuarios`.`id` = :id', array(':id' => $id), false); 
    }

    public function get_usuarios()
    {
        return $this->sql->query('SELECT * FROM `usuarios`', null); 
    }
}