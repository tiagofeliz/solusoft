<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

	private $template = 'template/index';
	private $dados = [];

	public function index()
	{
		$this->dados['page'] = 'pedidos/lista';

		$this->load->view($this->template, $this->dados);
	}

	public function cadastro()
	{
		$this->dados['page'] = 'pedidos/cadastro';

		$this->load->view($this->template, $this->dados);
	}

	public function editar($id)
	{
		$this->load->model('Pedido', 'pedido', true);

		$this->pedido->id = $id;

		$this->dados['pedido'] = $this->pedido->getPedido();
		
		$this->dados['page'] = 'pedidos/edicao';

		$this->load->view($this->template, $this->dados);
	}

	public function listar()
	{
		$this->load->model('Pedido', 'pedido', true);

		$pedidos = $this->pedido->getPedidos();

		echo json_encode($pedidos);
	}

	public function incluir()
	{
		$this->load->model('Pedido', 'pedido', true);
		$this->pedido->nome = $this->input->post("nome");
		$this->pedido->cpf = $this->input->post("cpf");
		$this->pedido->email = $this->input->post("email");
		$this->pedido->sexo = $this->input->post("sexo");
		echo $this->pedido->inserir();
	}

	public function atualizar()
	{
		$this->load->model('Pedido', 'pedido', true);
		$this->pedido->id = $this->input->post("id");
		$this->pedido->nome = $this->input->post("nome");
		$this->pedido->cpf = $this->input->post("cpf");
		$this->pedido->email = $this->input->post("email");
		$this->pedido->sexo = $this->input->post("sexo");
		echo $this->pedido->atualizar();
	}
	
	public function remover()
	{
		$this->load->model('Pedido', 'pedido', true);
		$this->pedido->id = $this->input->post("id");
		echo $this->pedido->remover();
	}
}
