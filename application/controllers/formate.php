<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formate extends CI_Controller {

	function  __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('yd_m');

	}
	function index()
	{
		//$this->load->view('Admin/pages/grab_list/header.html');
		$this->load->view('Admin/pages/grab_list/format.html');
		$this->load->view('Admin/pages/grab_list/footer.html');
		
	}
}
?>