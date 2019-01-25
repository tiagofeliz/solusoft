<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	private $template = 'template/index';
	private $dados = [];

	public function index()
	{
		$this->load->view($this->template);
	}
}
