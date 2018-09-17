<?php

class Index_Controller
{
    public $auth = 
    [
        'index' => false
    ];

    public $permission;
    public $view;
    public $logic;
    public $service;

    public function __construct()
    {

    }

    public function index($id)
    {

        if(isset( $_SESSION['user']))
        { header('location:' . HTTP . '/home'); }
        
        $this->view->set_view('index');
        $this->view->set_value('name', 'Redes | Registro de data estudiantil');
        $this->view->render();
    }

    public function login()
    {

        if(!isset($_POST['username']) OR !isset($_POST['password']))
        {
            header('location:' . HTTP . '/');
            return;
        }

        $user = $this->service->authentify( $_POST['username'], $_POST['password'] );

        if($user){

            $_SESSION['user']['name']        = $user[0]['nombre'];
            $_SESSION['user']['apell']       = $user[0]['apellido'];
            $_SESSION['user']['user']        = $user[0]['usuario'];
            $_SESSION['user']['permissions'] = $user[0]['rango'];

            header('location:' . HTTP . '/home');
        }else{

            header('location:' . HTTP . '/');
            return;
        }
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION[ APP_CONFIG['session.name'] ]);
        header('location:'. HTTP . '/');
    }
}