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
		$this->load->view('header.html');
		$this->load->view('formate.html');
		$this->load->view('footer.html');
	}
?>