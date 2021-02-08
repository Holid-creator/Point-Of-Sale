<?php

class Fungsi
{

  protected $ci;
  function __construct()
  {
    $this->ci = &get_instance();
  }

  function user_login()
  {
    $this->ci->load->model('user');
    $user_id = $this->ci->session->userdata('user_id');
    $user_data = $this->ci->user->get($user_id)->row();
    return $user_data;
  }

  function pdfGenerator($html, $file_name, $paper, $orientation)
  {
    $dompdf = new Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper($paper, $orientation);

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream($file_name, array('Attachment' => 0));
  }

  public function count_item()
  {
    $this->ci->load->model('item_m');
    return $this->ci->item_m->get()->num_rows();
  }

  public function count_supplier()
  {
    $this->ci->load->model('supplier_m');
    return $this->ci->supplier_m->get()->num_rows();
  }
  public function count_customer()
  {
    $this->ci->load->model('cust_m');
    return $this->ci->cust_m->get()->num_rows();
  }
  public function count_user()
  {
    $this->ci->load->model('user');
    return $this->ci->user->get()->num_rows();
  }
}
