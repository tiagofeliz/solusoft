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
 
    public function atualizar($id){
        return $this->db->update('clientes', $this, array('id' => $id));
    }

    public function get_clientes(){
        return $this->db->get('clientes')->result();
    }
}