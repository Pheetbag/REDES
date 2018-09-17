<?php

class Estudiante_Service{
    
    public $sql; 

    /**
     * Verify if the user exist and have password
     * 
     * @param  int|string  $id the id to use
     * @param  string      $type the type of consult will be made.
     * 
     * @return bool
     */
    public function get_estudiantesList($id, $type)
    {            
        switch ($type) {
            case 'ci':

                $param = [ ':id' => $id ];
                return $this->sql->query("SELECT * FROM `estudiantes` WHERE `ci_escolar` = :id", $param, true);

                break;

            case 'padres':

                $param = [ ':id' => $id ];
                $parent_id = $this->sql->query("SELECT `id` FROM `familiares` WHERE `ci` = :id",$param, 'one');

                $param = [ ':id' => $parent_id['id'] ];
                return $this->sql->query("SELECT * FROM `estudiantes` WHERE `id_madre` = :id OR `id_padre` = :id", $param, true);

                break;

            case 'repre':
                $param = [ ':id' => $id ];
                $parent_id = $this->sql->query("SELECT `id` FROM `representante` WHERE `ci` = :id",$param, 'one');

                
                $param = [ ':id' => $parent_id['id'] ];
                return $this->sql->query("SELECT * FROM `estudiantes` WHERE `id_representante` = :id", $param, true);
                break;

        }
    }

    /**
     * Verify if the user exist and have password
     * 
     * @param string $username
     * @param string $password
     * 
     * @return bool
     */
    public function get_estudiante($id)
    {
        $param = [ ':id' => $id ];
        return $this->sql->query('SELECT * FROM `estudiantes` WHERE `id` = :id', $param, 'one');
    }

    public function get_representante($id, $estudiante)
    {
        $param = [ ':id' => $id ];

        if($id == 'padre' OR $id == 'madre')
        {
            $representante = $this->get_padres($estudiante['id_' . $id]);
            $representante['parentesco'] = $id;
            return $representante;
        }else{
            return $this->sql->query('SELECT * FROM `representante` WHERE `id` = :id', $param, 'one');
        }
    }

    public function get_padres($id)
    {
        $param = [ ':id' => $id ];
        return $this->sql->query('SELECT * FROM `familiares` WHERE `id` = :id', $param, 'one');
    }
    
    public function get_salud($id)
    {
        $param = [ ':id' => $id ];
        return $this->sql->query('SELECT * FROM `salud` WHERE `id` = :id', $param, 'one');
    }

    public function get_familia($id)
    {
        $param = [ ':id' => $id ];
        return $this->sql->query('SELECT * FROM `situacion_familiar` WHERE `id` = :id', $param, 'one');  
    }

    public function get_documentos($id)
    {
        $param = [ ':id' => $id ];
        return $this->sql->query('SELECT * FROM `documentos` WHERE `id` = :id', $param, 'one');  
    }

    public function get_matriculas($id)
    {
        $param = [ ':id' => $id ];
        return $this->sql->query('SELECT * FROM `matriculas` WHERE `id_estudiante` = :id ORDER BY `fecha` DESC', $param, true);  
    }

}