<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Util 
{
    function parametrosEmail()
    {        
        return array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'tiagofeliz.solusoft@gmail.com',
            'smtp_pass' => '@solusoft$@',
            'mailtype'  => 'html', 
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        );
    }
}