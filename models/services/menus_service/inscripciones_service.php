<?php

class Inscripciones_Service{
    
    public $sql; 

    /**
     * Set and student in the database
     */
    public function set_estudiante($name, $apll, $age, $born, $born_site, $sex, $ci, $dir, $ciescolar, $salud, $repre, $madre, $padre, $familia, $doc)
    {
        
        $values = [
            ':ciescolar' => $ciescolar,
            ':ci'        => $ci,
            ':name'      => $name,
            ':apll'      => $apll,
            ':age'       => $age,
            ':born'      => $born,
            ':born_site' => $born_site,
            ':sex'       => $sex,
            ':dir'       => $dir,
            ':salud'     => $salud,
            ':repre'     => $repre,
            ':madre'     => $madre,
            ':padre'     => $padre,
            ':familia'   => $familia,
            ':doc'       => $doc
        ];
        $this->sql->query('INSERT INTO `estudiantes`(`ci_escolar`, `ci`, `nombre`, `apellido`, `edad`, `nacimiento`, `lugar_nacimiento`, `genero`, `direccion`, `id_salud`, `id_representante`, `id_madre`, `id_padre`, `id_familia`, `id_documentos`) VALUES (:ciescolar, :ci, :name, :apll, :age, :born, :born_site, :sex, :dir, :salud, :repre, :madre, :padre, :familia, :doc)', $values, false);

        return $this->sql->query('SELECT LAST_INSERT_ID()');
    }


    public function set_salud($tarjeta, $padece, $operaciones, $fisica, $visual, $auditiva, $alergias, $padecio, $parto, $vacunas, $lentes, $protesis, $fiebre, $salud)
    {

        $values = [
            ':tarjeta' => $tarjeta,
            ':padece' => $padece,
            ':operaciones' => $operaciones,
            ':fisica' => $fisica,
            ':visual' => $visual,
            ':auditiva' => $auditiva,
            ':alergias' => $alergias,
            ':padecio' => $padecio,
            ':parto' => $parto,
            ':vacunas' => $vacunas,
            ':lentes' => $lentes,
            ':protesis' => $protesis,
            ':fiebre' => $fiebre,
            ':salud' => $salud
        ];

        $this->sql->query('INSERT INTO `salud`(`tarjeta_vacuna`, `enfermades_padece`, `operaciones`, `limitaciones_fisicas`, `deficiencia_visual`, `deficiencia_auditiva`, `alergias`, `enfermedades_padecidas`, `parto_fue`, `vacunas_recibidas`, `usa_lentes`, `usa_protesis`, `medicamentos_fiebre`, `estado_salud`) VALUES (:tarjeta,:padece,:operaciones,:fisica,:visual,:auditiva,:alergias,:padecio,:parto,:vacunas,:lentes,:protesis,:fiebre,:salud)', $values, false);

        return $this->sql->query('SELECT LAST_INSERT_ID()');
    }

    public function set_representante($name, $apll, $age, $sex, $ci, $tlf, $dir, $nacsite, $parentesco, $ocupacion)
    {

        $values = [
            ':name' => $name,
            ':apll' => $apll,
            ':age' => $age,
            ':sex' => $sex,
            ':ci' => $ci,
            ':tlf' => $tlf,
            ':dir' => $dir,
            ':nacsite' => $nacsite,
            ':parentesco' => $parentesco,
            ':ocupacion' => $ocupacion
        ];

        $this->sql->query('INSERT INTO `representante` (`nombre`, `apellido`, `edad`, `sexo`, `ci`, `telefono`, `direccion`, `lugar_nacimiento`, `parentesco`, `ocupacion`) VALUES (:name, :apll, :age, :sex, :ci, :tlf, :dir, :nacsite, :parentesco, :ocupacion)', $values, false);

        return $this->sql->query('SELECT LAST_INSERT_ID()');
    }

    public function set_padres($name, $apll, $age, $sex, $ci, $nac, $intro, $ocup, $trab, $dir, $tlf, $vive, $parent)
	{

        $values = [
            ':name' => $name,
            ':apll' => $apll,
            ':age' => $age,
            ':sex' => $sex,
            ':ci' => $ci,
            ':nac' => $nac,
            ':intro' => $intro,
            ':ocup' => $ocup,
            ':trab' => $trab,
            ':dir' => $dir,
            ':tlf' => $tlf,
            ':vive' => $vive,
            ':parent' => $parent
        ];

        $this->sql->query('INSERT INTO `familiares`(`nombre`, `apellido`, `edad`, `sexo`, `ci`, `nacimiento`, `introduccion`, `ocupacion`, `trabajo`, `direccion`, `telefono`, `vive_estudiante`, `parentesco`) VALUES (:name, :apll, :age, :sex, :ci, :nac, :intro, :ocup, :trab, :dir, :tlf, :vive, :parent)', $values, false);

        return $this->sql->query('SELECT LAST_INSERT_ID()');
    }

    public function set_familia($hab, $herm, $lugherm, $plantel, $tpovv, $dist, $cond, $vive)
    {
        $values = [
            ':hab' => $hab,
            ':herm' => $herm,
            ':lugherm' => $lugherm,
            ':plantel' => $plantel,
            ':tpovv' => $tpovv,
            ':dist' => $dist,
            ':cond' => $cond,
            ':vive' => $vive
        ];

        $this->sql->query('INSERT INTO `situacion_familiar`( `n_habitantes`, `n_hermanos`, `lugar_hermanos`, `hermanos_plantel`, `tipo_vivienda`, `distribucion_vivienda`, `condiciones`, `vive_con`) VALUES (:hab, :herm, :lugherm, :plantel, :tpovv, :dist, :cond, :vive)', $values, false);

        return $this->sql->query('SELECT LAST_INSERT_ID()');

    }

    public function set_doc($ifreval, $crtbc, $partnac, $fa, $fr, $sano, $fm, $fp, $ci)
    {
        $values = [
            ':ifreval' => $ifreval,
            ':crtbc'   => $crtbc,
            ':partnac' => $partnac,
            ':fa'      => $fa,
            ':fr'      => $fr,
            ':sano'    => $sano,
            ':fm'      => $fm,
            ':fp'      => $fp,
            ':ci'      => $ci
        ];

        $this->sql->query('INSERT INTO `documentos`(`informe_evaluativo`, `carta_buena_conducta`, `cedula`, `partida_nacimiento`, `foto_alumno`, `foto_representante`, `niño_sano`, `foto_madre`, `foto_padre`) VALUES (:ifreval, :crtbc, :ci, :partnac, :fa, :fr, :sano, :fm, :fp)', $values, false);
        
        return $this->sql->query('SELECT LAST_INSERT_ID()');
    }

    public function set_matricula($fecha, $nota, $turno, $grado, $estudiante)
    {
        $values = [
            ':fecha' => $fecha, 
            ':nota'  => $nota,
            ':turno' => $turno,
            ':grado' => $grado,
            ':id'    => $estudiante
        ];

        $this->sql->query('INSERT INTO `matriculas`(`fecha`, `nota`, `turno`, `grado`, `id_estudiante`) VALUES (:fecha, :nota, :turno, :grado, :id)', $values, false);
    }

    public function matricula_exist($id)
    {
        $values = [
            ':id'    => $id,
            ':fecha' => date('Y')
        ];

        $value = $this->sql->query('SELECT * FROM `matriculas` WHERE `id_estudiante` = :id AND `fecha` = :fecha', $values, 'one');

        if(is_null($value) OR $value == '' OR $value === false)
        { return false; }
        else{ return true; }
    }

    public function get_matricula($id)
    {
        $values = [
            ':id'    => $id,
            ':fecha' => date('Y')
        ];

        return $this->sql->query('SELECT * FROM `matriculas` WHERE `id_estudiante` = :id AND `fecha` < :fecha ORDER BY `fecha` DESC', $values, 'one');
    }

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

    public function get_estudiante($id)
    {
        $values = [
            ':id'    => $id
        ];

        return $this->sql->query('SELECT * FROM `estudiantes` WHERE `id` = :id', $values, 'one');

    }
}