<?php

class Stok extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model(['item_m', 'supplier_m', 'stok_m']);
  }

  public function stok_in()
  {
    $data['title'] = 'Stock In';
    $data['stokin'] = $this->stok_m->get_stokin()->result();
    $this->template->load('template', 'transaksi/stok_in/stok_in', $data);
  }

  public function stokin_add()
  {
    $item = $this->item_m->get()->result();
    $supplier = $this->supplier_m->get()->result();
    $data = ['item' => $item, 'supplier' => $supplier];
    $data['title'] = 'Form Tambah Stock';
    $this->template->load('template', 'transaksi/stok_in/stokin_form', $data);
  }

  public function stokin_delete()
  {
    $id_stok = $this->uri->segment(4);
    $id_item = $this->uri->segment(5);
    $qty = $this->stok_m->get($id_stok)->row()->qty;
    $data = ['qty' => $qty, 'id_item' => $id_item];
    $this->item_m->stokout_update($data);
    $this->stok_m->delete($id_stok);

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Stock Berhasil Dihapus');
      redirect('stok/in');
    }
  }

  public function proccess()
  {
    $post = $this->input->post(null, true);
    if (isset($_POST['in_add'])) {
      $this->stok_m->stokin_add($post);
      $this->item_m->stokin_update($post);

      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', 'Data Stock Berhasil Disimpan');
        redirect('stok/in');
      }
    }
  }
}
