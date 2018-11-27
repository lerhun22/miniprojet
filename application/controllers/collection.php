<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('collection_model');
	}
	public function index(){
		$data['collection']=[];
		$data['collection']=$this->collection_model->getByLogin($this->session->userdata('loginName'));

		//$this->load->vars($data);

		$this->load->view('header');
		$this->load->view('liste_my_collection',$data);
		$this->load->view('footer');
	}

	public function add($pokemon_id, $name)
	{
		//echo $pokemon_id . "<br>";

		$data = array( 
			'pokemon_id' => $pokemon_id,  //'100', //$this->input->post('identifier'),
			'collector_login' => $name, //$this->input->post('height'),
		);
		$insert = $this->collection_model->add($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->collection_model->get_by_id($id);
		echo json_encode($data);
	}

	public function delete_by_id_by_name($id,$name)
	{
		$this->collection_model->delete_by_id_by_name($id,$name);
		echo json_encode(array("status" => TRUE));
	}
}
