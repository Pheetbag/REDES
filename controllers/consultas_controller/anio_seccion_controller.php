<?php

class Anio_Seccion_Controller
{

    public $view;
    public $logic;
    public $service;

    public function index()
    {
        $this->view->set_view('salon');
        $this->view->set_values([
            'name' => 'Redes | Consultas',
        ]);
        $this->view->set_value('page_name', 'Consultas', 'ly');
        $this->view->render();
    }
}
