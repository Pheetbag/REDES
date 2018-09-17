<?php

class Index_Service{
    
    public $sql; 

    /**
     * Verify if the user exist and have password
     * 
     * @param string $username
     * @param string $password
     * 
     * @return bool
     */
    public function authentify($username, $password)
    {

        $param = [
            ':user' => $username,
            ':pass' => $password
        ];

        
        $result = $this->sql->query('SELECT * FROM usuarios WHERE usuario = :user AND contrasena = :pass', $param);

        return $result ? $result : false; 
    }
}