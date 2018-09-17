<?php

class Index_Logic{
    
    private $connection; 

    /**
     * Verify if the username match
     * 
     * @param string $username
     * @param string $password
     * 
     * @return bool
     */
    public function authentify($password)
    {

        $this->connection->query('login');
        $this->connection->getPassword($username);
    }
}