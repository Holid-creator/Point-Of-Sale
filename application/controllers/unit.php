<?php

class Unit extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model('unit_m');
  }
  public function index()
  {
    $data['title'] = 'Unit';
    $data['unit'] = $this->unit_m->get();
    $this->template->load('template', 'product/unit/unit', $data);
  }

  public function add()
  {
    $unit = new stdClass();
    $unit->id_unit = null;
    $unit->nama = null;

    $data = array(
      'page' => 'add',
      'row' => $unit
    );

    $data['title'] = 'Form Tambah Unit';
    $this->template->load('template', 'product/unit/tambah', $data);
  }

  public function edit($id)
  {
    $query = $this->unit_m->get($id);
    if ($query->num_rows() > 0) {
      $unit = $query->row();
      $data = array(
        'page' => 'edit',
        'row' => $unit
      );
      $data['title'] = 'Form Ubah Unit';
      $this->template->load('template', 'product/unit/edit', $data);
    } else {
      $this->session->set_flashdata('success', 'Data Berhasil Diubah');
      redirect('unit');
    }
  }

  public function proccess()
  {
    $post = $this->input->post(null, true);
    if (isset($_POST['add'])) {
      $this->unit_m->add($post);
    } else if (isset($_POST['edit'])) {
      $this->unit_m->edit($post);
    }
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan');
    }
    redirect('unit');
  }

  public function delete($id)
  {
    $this->unit_m->delete($id);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
      redirect('unit');
    }
  }
}
