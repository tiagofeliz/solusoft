<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	private $template = 'template/index';
	private $dados = [];

	public function index()
	{
		$this->dados['clientes'] = $this->listaClientes();
		$this->dados['page'] = 'clientes/lista';
		
		$this->load->view($this->template, $this->dados);
	}

	public function listaClientes($jquery_request = false)
	{
		$this->load->model('Cliente', 'cliente', true);

		$clientes = $this->cliente->get_clientes();

		if($jquery_request){
			echo json_encode($clientes);
		}else{
			return $clientes;
		}
	}
}
