<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	private $template = 'template/index';
	private $dados = [];

	public function index()
	{
		$this->dados['page'] = 'clientes/lista';

		$this->load->view($this->template, $this->dados);
	}

	public function cadastro()
	{
		$this->dados['page'] = 'clientes/cadastro';

		$this->load->view($this->template, $this->dados);
	}

	public function listar()
	{
		$this->load->model('Cliente', 'cliente', true);

		$clientes = $this->cliente->get_clientes();

		echo json_encode($clientes);
	}

	public function incluir()
	{
		$this->load->model('Cliente', 'cliente', true);
		$this->cliente->nome = $this->input->post("nome");
		$this->cliente->cpf = $this->input->post("cpf");
		$this->cliente->email = $this->input->post("email");
		$this->cliente->sexo = $this->input->post("sexo");
		echo $this->cliente->inserir();
	}
	
	public function remover()
	{
		$this->load->model('Cliente', 'cliente', true);
		$this->cliente->id = $this->input->post("id");
		echo $this->cliente->remover();
	}
}
