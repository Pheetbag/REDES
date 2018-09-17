<?php

class Inscripciones_Controller
{
    public $permissions = [
        'index' => 99999
    ];
    public $view;
    public $logic;
    public $service;

    public function index($id)
    {

        $this->view->set_view('index');
        $this->view->set_values([
            'name' => 'Redes | Inscripciones'
        ]);
        $this->view->set_value('page_name', 'Inscripciones', 'ly');
        $this->view->render();
    }

    public function nuevo_ingreso(){

        $this->view->set_view('nuevo_ingreso');
        $this->view->set_values([
            'name' => 'Redes | Inscripciones'
        ]);
        $this->view->set_value('page_name', 'Nuevo ingreso', 'ly');
        $this->view->render();
    }

    public function nuevo_ingreso_registrar(){

        //We set the madre
        $m_name  = $_POST['nombre_madre'];
        $m_apll  = $_POST['apellido_madre'];
        $m_age   = $_POST['edad_madre'];
        $m_ocup  = $_POST['ocupacion_madre'];
        $m_sex   = $_POST['sexo_madre'];
        $m_ci    = $_POST['cedula_madre'];
        $m_tlf   = $_POST['telefono_madre'];
        $m_intro = $_POST['introduccion_madre'];
        $m_trab  = $_POST['trabajo_madre'];
        $m_nac   = $_POST['nacimiento_madre'];
        $m_dir   = $_POST['dir_madre'];
        $m_vive  = $_POST['vive_con_madre'] ? 'Si' : 'No';

        $m_id = $this->service->set_padres($m_name, $m_apll, $m_age, $m_sex, $m_ci, $m_nac, $m_intro, $m_ocup, $m_trab, $m_dir, $m_tlf, $m_vive, 'MADRE')[0]['LAST_INSERT_ID()'];

        //We set the padre
        $p_name  = $_POST['nombre_padre'];
        $p_apll  = $_POST['apellido_padre'];
        $p_age   = $_POST['edad_padre'];
        $p_ocup  = $_POST['ocupacion_padre'];
        $p_sex   = $_POST['sexo_padre'];
        $p_ci    = $_POST['cedula_padre'];
        $p_tlf   = $_POST['telefono_padre'];
        $p_intro = $_POST['introduccion_padre'];
        $p_trab  = $_POST['trabajo_padre'];
        $p_nac   = $_POST['nacimiento_padre'];
        $p_dir   = $_POST['dir_padre'];
        $p_vive  = $_POST['vive_con_padre'] ? 'Si' : 'No';

        $p_id = $this->service->set_padres($p_name, $p_apll, $p_age, $p_sex, $p_ci, $p_nac, $p_intro, $p_ocup, $p_trab, $p_dir, $p_tlf, $p_vive, 'PADRE')[0]['LAST_INSERT_ID()'];

        //We set the representante
        if( !isset($_POST['representante_padres']) )
        { 

            $representante = $_POST['representante'];

            $rep_name     = $_POST["nombre_{$representante}"];
            $rep_apll     = $_POST["apellido_{$representante}"];
            $rep_edad     = $_POST["edad_{$representante}"];
            $rep_sexo     = $_POST["sexo_{$representante}"];
            $rep_ci       = $_POST["cedula_{$representante}"];
            $rep_tlf      = $_POST["telefono_{$representante}"];
            $rep_dir      = $_POST["dir_{$representante}"];
            $rep_nacsite  = $_POST["nacimiento_{$representante}"];
            $rep_parentes = $representante;
            $rep_ocup     = $_POST["ocupacion_{$representante}"];

        }else{

            $rep_name     = isset($_POST['nombre_representante']) ? $_POST['nombre_representante'] : null;
            $rep_apll     = isset($_POST['apellido_representante']) ? $_POST['apellido_representante'] : null;
            $rep_edad     = isset($_POST['edad_representante']) ? $_POST['edad_representante'] : null;
            $rep_sexo     = isset($_POST['sexo_representante']) ? $_POST['sexo_representante'] : null;
            $rep_ci       = isset($_POST['ci_representante']) ? $_POST['ci_representante'] : null;
            $rep_tlf      = isset($_POST['telefono_representante']) ? $_POST['telefono_representante'] : null;
            $rep_dir      = isset($_POST['direccion_representante']) ? $_POST['direccion_representante'] : null;
            $rep_nacsite  = isset($_POST['lugar_nacimiento_representante']) ? $_POST['lugar_nacimiento_representante'] : null;
            $rep_parentes = isset($_POST['parentesco_representante']) ? $_POST['parentesco_representante'] : null;
            $rep_ocup     = isset($_POST['ocupacion_representante']) ? $_POST['ocupacion_representante'] : null;

        }
        $rep_id = $this->service->set_representante($rep_name, $rep_apll, $rep_edad, $rep_sexo, $rep_ci, $rep_tlf, $rep_dir, $rep_nacsite, $rep_parentes, $rep_ocup)[0]['LAST_INSERT_ID()'];

        //We set family situation
        $fam_hab   = $_POST['habitantes_familiar'];
        $fam_vive  = $_POST['familiares_familiar']; 
        $fam_herm  = $_POST['hermanos_familiar'];
        $fam_lugr  = $_POST['lugar_hermanos_familiar'];
        $fam_pltl  = $_POST['hermanos_plantel_familiar'] ? 1 : 0;
        $fam_tpovv = $_POST['tipo_vivienda_familiar'];
        $fam_distr = isset($_POST['distribucion_vivienda_familiar']) ? join(', ', $_POST['distribucion_vivienda_familiar']) : null;
        $fam_cond  = $_POST['condiciones_familiar'];

        $fam_id = $this->service->set_familia($fam_hab, $fam_herm, $fam_lugr, $fam_pltl, $fam_tpovv, $fam_distr, $fam_cond, $fam_vive)[0]['LAST_INSERT_ID()'];


        //We set the health data
        $est_vacunas = isset($_POST['vacunas']) ? join(', ', $_POST['vacunas']) : null;
        $est_tarjeta = $_POST['vacunas_tarjeta'] ? 'Si' : 'No';
        $est_parto   = $_POST['tipo_parto'];
        $est_enferme = $_POST['enfermedades_padece'];
        $est_padeci  = $_POST['enfermedades_padecidas'];
        $est_operac  = $_POST['operaciones'];
        $est_limita  = $_POST['limitaciones_fisicas'];
        $est_lentes  = $_POST['lentes'] ? 'Si' : 'No';
        $est_visual  = $_POST['deficiencias_visuales'];
        $est_audio   = $_POST['deficiencias_auditivas'];
        $est_salud   = $_POST['estado_salud'];
        $est_fiebre  = $_POST['medicamentos_fiebre'];
        $est_alergia = $_POST['alergias'];
        $est_prote   = $_POST['protesis'] ? 'Si' : 'No';
        
        $salud_id    = $this->service->set_salud($est_tarjeta, $est_enferme, $est_operac, $est_limita, $est_visual, $est_audio, $est_alergia, $est_padeci, $est_parto, $est_vacunas, $est_lentes, $est_prote, $est_fiebre, $est_salud)[0]['LAST_INSERT_ID()'];

        //We set the documentation
        $doc_infoeval    = isset($_POST['informe_evaluativo'])   ? 'Si' : 'No';
        $doc_cartaconduc = isset($_POST['carta_buena_conducta']) ? 'Si' : 'No';
        $doc_ci          = isset($_POST['cedula'])               ? 'Si' : 'No';
        $doc_partnac     = isset($_POST['partida_nacimiento'])   ? 'Si' : 'No';
        $doc_fotoalumn   = isset($_POST['foto_alumno'])          ? 'Si' : 'No';
        $doc_fotop       = isset($_POST['foto_padre'])           ? 'Si' : 'No';
        $doc_fotom       = isset($_POST['foto_madre'])           ? 'Si' : 'No';
        $doc_fotor       = isset($_POST['foto_representante'])   ? 'Si' : 'No';
        $doc_nsano       = isset($_POST['nino_sano'])            ? 'Si' : 'No';

        $doc_id = $this->service->set_doc($doc_infoeval, $doc_cartaconduc, $doc_partnac, $doc_fotoalumn, $doc_fotor, $doc_nsano, $doc_fotom, $doc_fotop, $doc_ci)[0]['LAST_INSERT_ID()'];
  
        //We set the user
        $est_name      = $_POST['nombre_estudiante'];
        $est_apll      = $_POST['apellido_estudiante'];
        $est_edad      = $_POST['edad_estudiante'];
        $est_nac       = $_POST['nacimiento_estudiante'];
        $est_lugar_nac = $_POST['nacimiento_lugar_estudiante'];
        $est_sex       = $_POST['sexo_estudiante'];
        $est_ci        = isset($_POST['cedula_estudiante']) ? $_POST['cedula_estudiante'] : null; 
        $est_dir       = $_POST['direccion_estudiante'];

        $ci_escolar    = $this->logic->ci_escolar($est_nac, $m_ci, $p_ci);

        $est_id        = $this->service->set_estudiante($est_name, $est_apll, $est_edad, $est_nac, $est_lugar_nac, $est_sex, $est_ci, $est_dir, $ci_escolar, $salud_id, $rep_id, $m_id, $p_id, $fam_id, $doc_id)[0]['LAST_INSERT_ID()'];

        $ma_grado = $_POST['matricula_grado'];
        $ma_turno = $_POST['matricula_turno'];
        $ma_calif = $_POST['matricula_calif'];

        $this->service->set_matricula(date('Y'), $ma_calif, $ma_turno, $ma_grado, $est_id);

        header('location:' . HTTP . '/consultas/estudiante/id/' . $est_id);
    }

    public function alumno_regular()
    {

        $id_padres = isset($_POST['ci_padres'])  ? $_POST['ci_padres']  : null;
        $id_repres = isset($_POST['ci_repre'])   ? $_POST['ci_repre']   : null;

        if( isset($_POST['request']) )
        {
            if( isset($_POST['ci_escolar']) AND $_POST['ci_escolar'] != null )
            { $userList = $this->service->get_estudiantesList($_POST['ci_escolar'], 'ci'); }

            else if ( isset($_POST['ci_padres']) AND  $_POST['ci_padres'] != null )
            { $userList = $this->service->get_estudiantesList($_POST['ci_padres'], 'padres'); }

            else if ( isset($_POST['ci_repre']) AND $_POST['ci_repre'] != null )
            { $userList = $this->service->get_estudiantesList($_POST['ci_repre'], 'repre'); }

            //FIXME: Change this in order to make it return back to the front page without do nothing.
            $this->view->set_value('results_found', true);

            if( isset($userList) )
            { $this->view->set_value('userList', $userList); }

        }

        $this->view->set_view('alumno_regular');
        $this->view->set_values([
            'name' => 'Redes | Inscripciones'
        ]);
        $this->view->set_value('page_name', 'Alumno regular', 'ly');
        $this->view->render();
    }

    public function alumno_regular_detalles()
    {
        $id = $_GET['id'];
        $exist = $this->service->matricula_exist($id);

        $estudiante = $this->service->get_estudiante($id);
        $this->view->set_value('std', $estudiante);

        if($exist)
        {
            $this->view->set_view('alumno_regular_detalles_error');
        }else{

            $matricula = $this->service->get_matricula($id);

            if(!$matricula)
            { $matricula['grado'] = 1; }

            $this->view->set_value('mat', $matricula);
            $this->view->set_value('mat_text', ['Primer', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto']);
            $this->view->set_view('alumno_regular_detalles');
        }


        $this->view->set_values([
            'name' => 'Redes | Inscripciones'
        ]);
        $this->view->set_value('page_name', 'Alumno regular', 'ly');
        $this->view->render();
    }

    public function alumno_regular_matricular()
    {
        $current_year = $_POST['grado_anterior'];
        $est_id = $_POST['estudiante'];
        $grado = $_POST['grado'];
        $notas = $_POST['notas'];
        $turno = $_POST['turno'];

        if($grado > $current_year AND $notas == 'D')
        { 
            header('location:' . HTTP . "/inscripciones/alumno-regular/detalles?id={$est_id}&err=true"); return; 
        }

        $this->service->set_matricula(date('Y'), $notas, $turno, $grado, $est_id);
        header('location:' . HTTP . "/consultas/estudiante/id/{$est_id}");
    }
}
