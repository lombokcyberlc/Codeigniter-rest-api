<?php
defined('BASEPATH') OR exit('No direct script allowed');

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class File extends REST_Controller{
	/*----------------------------------------CONSTRUCTOR----------------------------------------*/
	function __construct($config = 'rest'){							// load config rest.php dari folder application/config/rest.php
		parent::__construct($config);								// extends constructor
		$this->load->database();									// load library database untuk dapat menggunakan active record
	}

	/*
	*	URL		: http://localhost/api/file/
	*			: http://localhost/api/file/{id}
	*				contoh http://localhost/api/file/1
	*	METHOD	: GET
	*/

	function index_get(){

		$id = $this->uri->segment(3);							// ambil id file dari url segment ke 3

		if($id == ''){											// jika id kosong maka get semua file
			$query = $this->db->get('ppid')->result();
		} else {
			$this->db->where('id', $id);						// jika id diinput dari url, maka get file berdasarkan id
			$query = $this->db->get('ppid')->result();
		}

		$data = array();
		$i = 0;

		foreach ($query as $value) {
			$data [$i]["id"] 			= (int) $value->id;			//casting id dari string ke integer
			$data [$i]["url_dokumen"] 	= "upload/".$value->file;
			$data [$i]["nama_dokumen"] 	= $value->nama_dokumen;
			$data [$i]["kategori"] 		= (int) $value->kategori;	//casting kategori dari string ke integer
			$data [$i]["keterangan"] 	= $value->keterangan;
			$i++;
		}

		$this->response($data, 200);

	}

	/*
	*	URL				: http://localhost/api/file/
	*	PARAMETER BODY	: id
	*	METHOD			: POST
	*/
	function index_post(){

		$id = $this->post('id');						// ambil id dari post body

		if($id == ''){									// jika id kosong maka get semua file
			$query = $this->db->get('ppid')->result();
		} else {
			$this->db->where('id', $id);				// jika id ada, maka get file berdasarkan id
			$query = $this->db->get('ppid')->result();
		}

		$data = array();
		$i = 0;

		foreach ($query as $value) {
			$data [$i]["id"] 			= (int) $value->id;			//casting id dari string ke integer
			$data [$i]["url_dokumen"] 	= "upload/".$value->file;
			$data [$i]["nama_dokumen"] 	= $value->nama_dokumen;
			$data [$i]["kategori"] 		= (int) $value->kategori;	//casting kategori dari string ke integer
			$data [$i]["keterangan"] 	= $value->keterangan;
			$i++;
		}

		$this->response($data, 200);
	}

	/*
	*	URL		: http://localhost/api/file/byKategori/{id}
	*	METHOD	: GET
	*/

	function byKategori_get(){

		if($this->uri->segment(3)){									// jika id kategori tersedia, kategori id = angka di uri segment ke 3
			$kategori_id = $this->uri->segment(3);
		} else {
			$kategori_id = $this->get('kategori_id');
		}

		if($kategori_id == ''){
			$query = $this->db->get('ppid')->result();				// jika id kategori tidak ditemukan, maka get semua file
		} else {
			$this->db->where('kategori', $kategori_id);				// jika id kategori ditemukan, maka get file berdasarkan id kategori
			$query = $this->db->get('ppid')->result();
		}

		$data = array();
		$i = 0;

		foreach ($query as $value) {
			$data [$i]["id"] 			= (int) $value->id;			//casting id dari string ke integer
			$data [$i]["url_dokumen"] 	= "upload/".$value->file;
			$data [$i]["nama_dokumen"] 	= $value->nama_dokumen;
			$data [$i]["kategori"] 		= (int) $value->kategori;	//casting kategori dari string ke integer
			$data [$i]["keterangan"] 	= $value->keterangan;
			$i++;
		}

		$this->response($data, 200);

	}


	/*
	*	URL				: http://localhost/api/file/byKategori/
	*	PARAMETER BODY 	: kategori_id
	*	METHOD			: POST
	*/

	function byKategori_post(){

		if($this->uri->segment(4)){
			$kategori_id = $this->uri->segment(4);
		} else {
			$kategori_id = $this->post('kategori_id');
		}

		if($kategori_id == ''){
			$query = $this->db->get('ppid')->result();
		} else {
			$this->db->where('kategori', $kategori_id);
			$query = $this->db->get('ppid')->result();
		}

		$data = array();
		$i = 0;

		foreach ($query as $value) {
			$data [$i]["id"] 			= (int) $value->id;
			$data [$i]["url_dokumen"] 	= "upload/".$value->file;
			$data [$i]["nama_dokumen"] 	= $value->nama_dokumen;
			$data [$i]["kategori"] 		= (int) $value->kategori;
			$data [$i]["keterangan"] 	= $value->keterangan;
			$i++;
		}

		$this->response($data, 200);

	}

}

?>
