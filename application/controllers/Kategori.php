<?php
defined('BASEPATH') OR exit('No direct script allowed');

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class Kategori extends REST_Controller{
	/*----------------------------------------CONSTRUCTOR----------------------------------------*/
	function __construct($config = 'rest'){
		parent::__construct($config);
		$this->load->database();
	}

	/*----------------------------------------GET KONTAK----------------------------------------*/
	function index_get(){
		$id = $this->get('id');

		if($id == ''){
			$query = $this->db->get('cat_ppid')->result_array();
		} else {
			$this->db->where('id', $id);
			$query = $this->db->get('cat_ppid')->result_array();
		}

		$this->response($query, 200);
	}

	function index_post(){
		$id = $this->post('id');

		if($id == ''){
			$query = $this->db->get('cat_ppid')->result_array();
		} else {
			$this->db->where('id', $id);
			$query = $this->db->get('cat_ppid')->result_array();
		}

		$this->response($query, 200);
	}
}

?>
