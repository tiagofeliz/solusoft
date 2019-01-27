<?php

class Pedido extends CI_Model {
 
    public $id;
    public $data;
    public $observacao;
    public $forma_pagamento;
    public $cliente_id;
 
    public function __construct() {
        parent::__construct();
    }
 
    public function inserir(){
        return $this->db->insert('pedidos', $this);
    }
 
    public function insert_id(){
        return $this->db->insert_id();
    }

    public function inserirProduto($produto){
        return $this->db->set($produto)->insert('itens_pedidos');
    }
 
    public function atualizar(){
        return $this->db->update('pedidos', $this, array('id' => $this->id));
    }
 
    public function atualizarProduto($produto, $itens_produtos_id){
        $this->db->where('id', $itens_produtos_id);
        return $this->db->set($produto)->update('itens_pedidos');
    }
 
    public function remover(){
        if($this->removerProdutosPedido()) return $this->db->delete('pedidos', array('id' => $this->id));
    }
 
    public function removerProdutosPedido(){
        return $this->db->delete('itens_pedidos', array('pedido_id' => $this->id));
    }

    public function getPedidos(){
        $this->db->select('pedidos.*')
                 ->select('clientes.nome')
                 ->select('clientes.sexo')
                 ->select('clientes.cpf')
                 ->select('clientes.email')
                 ->from('clientes')
                 ->where('pedidos.cliente_id = clientes.id');
        return $this->db->get('pedidos')->result();
    }

    public function getPedido(){
        $this->db->select('pedidos.*')
                 ->select('clientes.nome')
                 ->select('clientes.sexo')
                 ->select('clientes.cpf')
                 ->select('clientes.email')
                 ->from('clientes')
                 ->where('pedidos.cliente_id = clientes.id');
        return $this->db->get_where('pedidos', array('pedidos.id' => $this->id))->row();
    }

    public function produtosPedido($pedido_id){
        $this->db->select('itens_pedidos.id')
                 ->select('itens_pedidos.pedido_id')
                 ->select('itens_pedidos.produto_id')
                 ->select('itens_pedidos.quantidade')
                 ->select('produtos.nome')
                 ->select('produtos.cor')
                 ->select('produtos.tamanho')
                 ->select('produtos.valor')
                 ->from('produtos')
                 ->where('itens_pedidos.produto_id = produtos.id');
        return $this->db->get_where('itens_pedidos', array('pedido_id' => $pedido_id))->result();
    }

    public function pedidosCliente($cliente_id){
        return $this->db->get_where('pedidos', array('cliente_id' => $cliente_id))->result();
    }

    public function pedidosProduto($produto_id){
        return $this->db->get_where('itens_pedidos', array('produto_id' => $produto_id))->result();
    }
}