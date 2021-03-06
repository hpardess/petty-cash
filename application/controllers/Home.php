<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
*
*/
class Home extends CI_Controller {

	public function __construct(){

		parent::__construct();
		if(!$this->session->userdata('isLoggedIn')) {
			redirect('/login');
		}

	}

	public function index()
	{
		$data['css'] = '';
		$data['js'] = '';
		$data['breadcrumbs'] = $this->load->view('home/home_breadcrumb', '', true);
		$data['content'] = $this->load->view('home/home_view', '', true);
		$this->load->view('default_layout', $data);
	}
}
