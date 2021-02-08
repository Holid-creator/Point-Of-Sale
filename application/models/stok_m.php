<?php

class Stok_m extends CI_Model
{
  public function get($id = null)
  {
    $this->db->from('tb_stok');
    if ($id != null) {
      $this->db->where('id_stok', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function delete($id)
  {
    $this->db->where('id_stok', $id);
    $this->db->delete('tb_stok');
  }

  public function get_stokin()
  {
    $this->db->select('tb_stok.id_stok, tb_item.barcode, tb_item.nama as item_nama, qty, tgl, detail, tb_supplier.nama as supp_nama, tb_item.id_item');
    $this->db->from('tb_stok');
    $this->db->join('tb_item', 'tb_stok.id_item = tb_item.id_item');
    $this->db->join('tb_supplier', 'tb_stok.id_supp = tb_supplier.id_supp', 'left');
    $this->db->where('tipe', 'in');
    $this->db->order_by('id_stok', 'desc');
    $query = $this->db->get();
    return $query;
  }

  public function stokin_add($post)
  {
    $param = [
      'id_item' => $post['id_item'],
      'tipe' => 'in',
      'detail' => $post['detail'],
      'id_supp' => $post['supplier'] == '' ? null : $post['supplier'],
      'qty' => $post['qty'],
      'tgl' => $post['tgl'],
      'user_id' => $this->session->userdata('user_id')
    ];
    $this->db->insert('tb_stok', $param);
  }
}
