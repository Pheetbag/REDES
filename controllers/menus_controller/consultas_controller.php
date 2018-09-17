<?php

class Consultas_Controller
{

    public $view;
    public $logic;
    public $service;

    public function index($id)
    {

        $this->view->set_view('index');
        $this->view->set_values([
            'name' => 'Redes | Consultas',
        ]);
        $this->view->set_value('page_name', 'Consultas', 'ly');
        $this->view->render();
    }
    
    public function estudiante()
    {
        $this->view->set_view('estudiante');
        $this->view->set_values([
            'name' => 'Redes | Consultas',
        ]);
        $this->view->set_value('page_name', 'Consultas', 'ly');
        $this->view->render();
    }
    
    public function anio_seccion()
    {
        $this->view->set_view('salon');
        $this->view->set_values([
            'name' => 'Redes | Consultas',
        ]);
        $this->view->set_value('page_name', 'Consultas', 'ly');
        $this->view->render();
    }
}
