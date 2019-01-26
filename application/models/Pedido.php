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
 
    public function atualizar(){
        return $this->db->update('pedidos', $this, array('id' => $this->id));
    }
 
    public function remover(){
        return $this->db->delete('pedidos', array('id' => $this->id));
    }

    public function getPedidos(){
        $this->db->select('pedidos.*')
                 ->select('clientes.*')
                 ->from('clientes')
                 ->where('pedidos.cliente_id = clientes.id');
        return $this->db->get('pedidos')->result();
    }

    public function getPedido(){
        return $this->db->get_where('pedidos', array('id' => $this->id))->row();
    }
}