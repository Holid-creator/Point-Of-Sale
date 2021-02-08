<?php

class Stok_out extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model(['stokout_m', 'item_m']);
  }
  public function stok_out()
  {
    $data['title'] = 'Stock Out';
    $data['stokout'] = $this->stokout_m->get_stokout()->result();
    $this->template->load('template', 'transaksi/stok_out/stok_out', $data);
  }

  public function stokout_add()
  {
    $item = $this->item_m->get()->result();
    $data = ['item' => $item];
    $data['title'] = 'Form Tambah Stock';
    $this->template->load('template', 'transaksi/stok_out/stokout_form', $data);
  }

  public function proccess()
  {
    $post = $this->input->post(null, true);
    if (isset($_POST['out_add'])) {
      if ($this->stokout_m->check_stok($post['qty'])->num_rows() > ['stok']) {
        $this->session->set_flashdata('error', "Jumlah $post[qty] melebihi Stok");
        redirect('stok/out/add');
      } else {
        $this->stokout_m->stokout_add($post);
        $this->item_m->stokout_update($post);

        if ($this->db->affected_rows() > 0) {
          $this->session->set_flashdata('success', 'Data Stock Out Berhasil Ditambahkan');
          redirect('stok/out');
        }
      }
    }
  }

  public function stokout_delete()
  {
    $id_stokout = $this->uri->segment(4);
    $id_item = $this->uri->segment(5);
    $qty = $this->stokout_m->get($id_stokout)->row()->qty;
    $data = ['qty' => $qty, 'id_item' => $id_item];
    $this->item_m->stokin_update($data);
    $this->stokout_m->delete($id_stokout);

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Stock Out Berhasil Dihapus');
      redirect('stok/out');
    }
  }
}
