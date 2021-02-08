<?php

class Pelanggan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model('cust_m');
  }

  public function index()
  {
    $data['title'] = 'Data Konsumen';
    $data['customer'] = $this->cust_m->get();
    $this->template->load('template', 'customer/customer', $data);
  }

  public function add()
  {
    $cust = new stdClass();
    $cust->id_cust = null;
    $cust->nama = null;
    $cust->jk = null;
    $cust->phone = null;
    $cust->alamat = null;

    $data = array(
      'page' => 'add',
      'row' => $cust
    );

    $data['title'] = 'Form Tambah Konsumen';
    $this->template->load('template', 'customer/tambah', $data);
  }

  public function edit($id)
  {
    $query = $this->cust_m->get($id);
    if ($query->num_rows() > 0) {
      $cust = $query->row();
      $data = array(
        'page' => 'edit',
        'row' => $cust
      );
      $data['title'] = 'Form Edit Konsumen';
      $this->template->load('template', 'customer/edit', $data);
    }
  }

  public function proccess()
  {
    $post = $this->input->post(null, true);
    if (isset($_POST['add'])) {
      $this->cust_m->add($post);
    } else if (isset($_POST['edit'])) {
      $this->cust_m->edit($post);
    }

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
      redirect('customer');
    }
  }

  public function delete($id)
  {
    $this->cust_m->delete($id);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
      redirect('customer');
    }
  }
}
