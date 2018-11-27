<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Home extends CI_Controller {
 
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('liste_model');
	}
	
	public function index()
	{   
		$data['pokemons']=$this->liste_model->getall();
	
		$this->load->view('header');
		$this->load->view('liste',$data);
		$this->load->view('footer');
	}
}
