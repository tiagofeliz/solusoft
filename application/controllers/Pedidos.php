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
		$pedido = json_decode($this->input->post('pedido'));
		$this->pedido->data = $pedido->data;
		$this->pedido->observacao = $pedido->observacao;
		$this->pedido->forma_pagamento = $pedido->forma_pagamento;
		$this->pedido->cliente_id = $pedido->cliente->id;
		$this->pedido->inserir();
		$this->pedido->id = $this->pedido->insert_id();
		foreach($pedido->produtos as $produto){
			$this->pedido->inserirProduto(array(
				'pedido_id' => $this->pedido->id,
				'produto_id' => $produto->id,
				'quantidade' => $produto->quantidade
			));
		}
	}

	public function buscarPedido($id)
	{
		$this->load->model('Pedido', 'pedido', true);

		$this->pedido->id = $id;
		$pedido = $this->pedido->getPedido();

		$pedido->produtos = $this->pedido->produtosPedido($id);

		echo json_encode($pedido);
	}

	public function atualizar()
	{
		$this->load->model('Pedido', 'pedido', true);
		$pedido = json_decode($this->input->post('pedido'));
		$this->pedido->id = $pedido->id;
		$this->pedido->data = $pedido->data;
		$this->pedido->observacao = $pedido->observacao;
		$this->pedido->forma_pagamento = $pedido->forma_pagamento;
		$this->pedido->cliente_id = $pedido->cliente->id;
		$this->pedido->atualizar();
		foreach($pedido->produtos as $produto){
			$item_pedido = array(
				'pedido_id' => $this->pedido->id,
				'produto_id' => $produto->id,
				'quantidade' => $produto->quantidade
			);

			if($produto->itens_pedidos_id == null){
				$this->pedido->inserirProduto($item_pedido);
			}else{
				$this->pedido->atualizarProduto($item_pedido, $produto->itens_pedidos_id);
			}
		}
		if(count($pedido->produtos_remover) > 0) $this->removerProdutoPedido($pedido->produtos_remover);
	}
	
	public function removerProdutoPedido($produtos_remover)
	{
		$this->load->model('Pedido', 'pedido', true);
		foreach($produtos_remover as $produto){
			$this->pedido->removerProdutoPedido($produto);
		}
	}
	
	public function remover()
	{
		$this->load->model('Pedido', 'pedido', true);
		$this->pedido->id = $this->input->post("id");
		if(!$this->pedido->remover()){
			echo 'false';
		}
	}
}
