<?php

class Estudiante_Controller
{

    public $view;
    public $logic;
    public $service;
    
    public function index()
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

        $this->view->set_view('estudiantes');
        $this->view->set_values([
            'name' => 'Redes | Consultas',
        ]);
        $this->view->set_value('page_name', 'Consultas', 'ly');
        $this->view->render();
    }

    public function id($id)
    {
        if($id === null)
        { header('location:' . HTTP . '/consultas/estudiante'); }

        $estudiante = $this->service->get_estudiante($id);

        if($estudiante == null)
        { header('location:' . HTTP . '/consultas/estudiante'); }

        $representante = $this->service->get_representante ($estudiante['id_representante'], $estudiante);
        $salud         = $this->service->get_salud         ($estudiante['id_salud']);
        $familia       = $this->service->get_familia       ($estudiante['id_familia']);
        $documentos    = $this->service->get_documentos    ($estudiante['id_documentos']);
        $padre         = $this->service->get_padres        ($estudiante['id_padre']);
        $madre         = $this->service->get_padres        ($estudiante['id_madre']);
        $matriculas    = $this->service->get_matriculas    ($id);

        $this->view->set_view('estudiante');
        $this->view->set_values([
            'estudiante'    => $estudiante,
            'representante' => $representante,
            'salud'         => $salud,
            'familia'       => $familia,
            'documentos'    => $documentos,
            'padre'         => $padre,
            'madre'         => $madre,
            'matriculas'    => $matriculas
        ]);
        $this->view->set_value('page_name', 'Estudiante', 'ly');
        $this->view->render();
    }

}
