<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends CI_Controller {

	private $template = 'template/index';
	private $dados = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('Util', 'email'));
		$this->load->helper('util');
	}

	public function pedidos()
	{
		$this->dados['page'] = 'relatorios/pedidos';

		$this->load->view($this->template, $this->dados);
	}

	public function totalizadorCliente()
	{
		$this->dados['page'] = 'relatorios/totalizador_cliente';

		$this->load->view($this->template, $this->dados);
	}
}
