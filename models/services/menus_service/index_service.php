<?php

class Index_Service{
    
    public $sql; 

    public function openinsc()
    {

        $mañana = $this->sql->query("SELECT `active` FROM `config` WHERE `name` = 'inscripcion.statusM'", null, 'one')['active'];
        $tarde  = $this->sql->query("SELECT `active` FROM `config` WHERE `name` = 'inscripcion.statusT'", null, 'one')['active'];

        if($mañana == '0' AND $tarde == '0')
        { return false; }
        
        return true; 
    }

}