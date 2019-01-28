<?php

class Cliente extends CI_Model {
 
    public $id;
    public $nome;
    public $cpf;
    public $sexo;
    public $email;
 
    public function __construct() {
        parent::__construct();
    }
 
    public function inserir(){
        return $this->db->insert('clientes', $this);
    }
 
    public function atualizar(){
        return $this->db->update('clientes', $this, array('id' => $this->id));
    }
 
    public function remover(){
        return $this->db->delete('clientes', array('id' => $this->id));
    }

    public function getClientes(){
        return $this->db->get('clientes')->result();
    }

    public function getCliente(){
        return $this->db->get_where('clientes', array('id' => $this->id))->row();
    }
}