<?php

class Sales extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model('sales_m');
  }

  public function index()
  {
    $cust = $this->load->model('cust_m');
    $cust = $this->cust_m->get()->result();
    $data = array(
      'cust' => $cust,
      'inv' => $this->sales_m->no_inv()
    );
    $data['title'] = 'Penjualan';
    $this->template->load('template', 'transaksi/sales/sale_form', $data);
  }
}
