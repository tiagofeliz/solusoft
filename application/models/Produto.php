<?php

class Produto extends CI_Model {
 
    public $id;
    public $nome;
    public $cor;
    public $tamanho;
    public $valor;
 
    public function __construct() {
        parent::__construct();
    }
 
    public function inserir(){
        return $this->db->insert('produtos', $this);
    }
 
    public function atualizar(){
        return $this->db->update('produtos', $this, array('id' => $this->id));
    }
 
    public function remover(){
        return $this->db->delete('produtos', array('id' => $this->id));
    }

    public function getProdutos(){
        return $this->db->get('produtos')->result();
    }

    public function getProduto(){
        return $this->db->get_where('produtos', array('id' => $this->id))->row();
    }
}