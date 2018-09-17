<?php

class Index_Controller
{
    public $permission;
    public $view;
    public $logic;
    public $service;

    public function __construct()
    {

    }

    public function index($id)
    {
        $this->view->set_view('index');
        $this->view->set_value('name', 'Flex-App');
        $this->view->render();
    }
}