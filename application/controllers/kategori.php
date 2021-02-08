<?php

class Kategori extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model('kat_m');
  }
  public function index()
  {
    $data['title'] = 'Kategori';
    $data['kategori'] = $this->kat_m->get();
    $this->template->load('template', 'product/kategori/kategori', $data);
  }

  public function add()
  {
    $kat = new stdClass();
    $kat->id_kat = null;
    $kat->nama = null;

    $data = array(
      'page' => 'add',
      'row' => $kat
    );

    $data['title'] = 'Form Tambah Kategori';
    $this->template->load('template', 'product/kategori/tambah', $data);
  }

  public function edit($id)
  {
    $query = $this->kat_m->get($id);
    if ($query->num_rows() > 0) {
      $kat = $query->row();
      $data = array(
        'page' => 'edit',
        'row' => $kat
      );
      $data['title'] = 'Form Ubah kategori';
      $this->template->load('template', 'product/kategori/edit', $data);
    }
  }

  public function proccess()
  {
    $post = $this->input->post(null, true);
    if (isset($_POST['add'])) {
      $this->kat_m->add($post);
    } else if (isset($_POST['edit'])) {
      $this->kat_m->edit($post);
    }
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan');
    }
    echo "<script>window.location = '" . site_url('kategori') . "'</script>";
  }

  public function delete($id)
  {
    $this->kat_m->delete($id);

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
      redirect('kategori');
    }
  }
}
