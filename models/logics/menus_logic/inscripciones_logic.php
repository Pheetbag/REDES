<?php

class Inscripciones_Logic{
    
    /**
     * Verify if the username match
     * 
     * @param string $username
     * @param string $password
     * 
     * @return bool
     */
    public function ci_escolar($date, $ci_p, $ci_m)
    {

        $timestamp = strtotime( $date );
        $time = date('dmY', $timestamp);

        $ci = "{$time}-{$ci_p}-{$ci_m}";

        return $ci; 
    }
}