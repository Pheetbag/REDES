<?php

class Admin_Controller
{
    public $permissions = [
        'Admin' => '1',
        'index' => '1',
        'usuarios' => '1',
        'inscripciones' => '1'
    ];
    public $view;
    public $logic;
    public $service;

    public function index($id)
    {

        $this->view->set_view('index');
        $this->view->set_values([
            'name' => 'Redes | Administración'
        ]);
        $this->view->set_value('page_name', 'Administración', 'ly');
        $this->view->render();
    }

    public function inscripciones()
    {
        $this->view->set_view('inscripciones');
        $this->view->set_values([
            'name' => 'Redes | Administración'
        ]);
        $this->view->set_value('page_name', 'Administración', 'ly');
        $this->view->render();
    }

    public function switch_inscripciones()
    {
        $turno = $_GET['turno']; 


        $state = $this->service->state_inscripciones($turno)['active'];

        if( $state == true )
        { $this->service->cerrar_inscripciones($turno); }
        else{
            $this->service->abrir_inscripciones($turno);
        }
        
        if($state == false){
            header('location:' . HTTP . '/admin/inscripciones');
            return;
        }

        $turno_config = 0;

        if($turno == 'tarde')
        { $turno_config = 1; }

        $secciones             = $this->service->get_config('secciones')      [$turno_config];
        $estudiantesPerSecc    = $this->service->get_config('estudiantes');
        $estudiantesMinPerSecc = $this->service->get_config('estudiantesMin');

        for ($i=0; $i < 6; $i++) { 
            
            $this->asignSessions ($i + 1, $turno, $secciones, $estudiantesPerSecc, $estudiantesMinPerSecc); 
        }

    }

    public function asignSessions($grado, $turno, $secciones, $estudiantesPerSecc, $estudiantesMinPerSecc)
    {
        $matriculas       = $this->service->get_matriculas($turno, $grado);
        $numEstudiantes   = count($matriculas);
        $salonesAsignados = $secciones;

        $estudiantesSalon = ceil($numEstudiantes / $salonesAsignados);

        if($estudiantesSalon < $estudiantesMinPerSecc)
        {
            $salonesAsignados = ceil($numEstudiantes / $estudiantesMinPerSecc);
            $estudiantesSalon = ceil($numEstudiantes / $salonesAsignados);
        }

        $alumnosPointer = 0;
        
        for ($i=0; $i < $salonesAsignados; $i++) { 
            
            $salon = $i + 1; 

            for ($i=0; $i < $estudiantesSalon; $i++) { 
                
                $this->service->set_secc($matricula[$alumnosPointer], $salon);
                $alumnosPointer++;
            }

        }
    }

    public function usuarios()
    {
        $this->view->set_view('usuarios');
        $this->view->set_values([
            'name' => 'Redes | Administración',
            'userList' => $this->service->get_usuarios()
        ]);
        $this->view->set_value('page_name', 'Administración', 'ly');
        $this->view->render();
    }

    public function eliminar_usuario()
    {
        $id = $_GET['id'];
        $this->service->delete_usuario($id);
        echo 'Hola'; 
        
        header('location:' . HTTP . "/admin/usuarios");
    }

    public function nuevo_usuario()
    {
        $this->service->set_usuario($_POST['nombre'], $_POST['apellido'], $_POST['usuario'], $_POST['contra'], $_POST['rango']);

        header('location:' . HTTP . "/admin/usuarios");
    }
}
