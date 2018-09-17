<?php

class Index_Controller
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
            'name' => 'Redes | Pagina Principal',
            'user' => $_SESSION['user']['name'],
            'inscripcion' => $this->service->openinsc()

        ]);
        $this->view->set_value('page_name', "¡Bienvenido, {$_SESSION['user']['name']}!", 'ly');
        $this->view->render();
    }
}
