<?php

class Dashboard extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Dashboard';

		check_not_login();
		$this->template->load('template', 'dashboard', $data);
	}
}
