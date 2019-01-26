<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

	private $template = 'template/index';
	private $dados = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('Util'));
	}

	public function index()
	{
		$this->dados['page'] = 'produtos/lista';

		$this->load->view($this->template, $this->dados);
	}

	public function cadastro()
	{
		$this->dados['page'] = 'produtos/cadastro';

		$this->load->view($this->template, $this->dados);
	}

	public function editar($id)
	{
		$this->load->model('Produto', 'produto', true);

		$this->produto->id = $id;

		$this->dados['produto'] = $this->produto->getProduto();
		
		$this->dados['page'] = 'produtos/edicao';

		$this->load->view($this->template, $this->dados);
	}

	public function listar()
	{
		$this->load->model('Produto', 'produto', true);

		$produtos = $this->produto->getProdutos();

		echo json_encode($produtos);
	}

	public function incluir()
	{
		$this->load->model('Produto', 'produto', true);
		$this->produto->nome = $this->input->post("nome");
		$this->produto->cor = $this->input->post("cor");
		$this->produto->tamanho = $this->input->post("tamanho");
		$this->produto->valor = $this->input->post("valor");
		echo $this->produto->inserir();
	}

	public function atualizar()
	{
		$this->load->model('Produto', 'produto', true);
		$this->produto->id = $this->input->post("id");
		$this->produto->nome = $this->input->post("nome");
		$this->produto->cor = $this->input->post("cor");
		$this->produto->tamanho = $this->input->post("tamanho");
		$this->produto->valor = $this->input->post("valor");
		echo $this->produto->atualizar();
	}
	
	public function remover()
	{
		$this->load->model('Produto', 'produto', true);
		$this->produto->id = $this->input->post("id");
		echo $this->produto->remover();
	}
}
