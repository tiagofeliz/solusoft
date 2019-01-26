<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Util 
{

    function formataValor($valor = 0)
    {
        return 'R$ ' . number_format(round($valor, 2), 2, ',', '.');
    }
}