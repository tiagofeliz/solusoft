<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('formataValor')){
    function formataValor($valor = 0)
    {
        return 'R$ ' . number_format(round($valor, 2), 2, ',', '.');
    }
}