<?php

class Supplier extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
  }

  public function index()
  {
    $data['title'] = 'Data Supplier';
    $data['supplier'] = $this->supplier_m->get();

    $this->template->load('template', 'supplier/data_supp', $data);
  }

  public function add()
  {
    $supplier = new stdClass();
    $supplier->id_supp = null;
    $supplier->nama = null;
    $supplier->phone = null;
    $supplier->alamat = null;
    $supplier->deskripsi = null;
    $data = array(
      'page' => 'add',
      'row' => $supplier
    );

    $data['title'] = 'Tambah Data Supplier';
    $this->template->load('template', 'supplier/tambah', $data);
  }


  public function edit($id)
  {
    $query = $this->supplier_m->get($id);
    if ($query->num_rows() > 0) {
      $supplier = $query->row();
      $data = array(
        'page' => 'edit',
        'row' => $supplier
      );
      $data['title'] = 'Edit Data Supplier';
      $this->template->load('template', 'supplier/edit', $data);
    } else {
      echo "<script>alert('Data Berhasil Diubah')</script>";
      echo "<script>window.location = '" . site_url('supplier') . "'</script>";
    }
  }

  public function proccess()
  {
    $post = $this->input->post(null, true);
    if (isset($_POST['add'])) {
      $this->supplier_m->add($post);
    } else if (isset($_POST['edit'])) {
      $this->supplier_m->edit($post);
    }
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan');
      redirect('supplier');
    }
  }

  public function delete($id)
  {
    $this->supplier_m->delete($id);
    $error = $this->db->error();
    if ($error['code'] != 0) {
      $this->session->set_flashdata('error', 'Data Tidak Dapat Dihapus (Sudah Berelasi)');
    } else {
      $this->session->set_flashdata('success', "Nama Supplier Berhasil Dihapus");
      redirect('supplier');
    }
  }
}
