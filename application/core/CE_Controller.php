<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CE_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// do whatever here - i often use this method for authentication controller

		/*
		  Load model class from class name...
		*/
		$this->load->helper('form');
		$this->load->helper('url');

		$this->viewData = array();
	}

	protected function initView($view, $page, $desc, $param) {
		$this->viewData['session'] = $this->session;

		$this->viewData['view'] = $view;
		$this->viewData['page'] = $page;
		$this->viewData['page_desc'] = $desc;
		$this->viewData['param'] = $param;
	}

	protected function loadView() {
		$this->load->view('vw_campus', $this->viewData);
	}
}

?>