<?php

class Stokout_m extends CI_Model
{
  public function get($id = null)
  {
    $this->db->from('tb_stokout');
    if ($id != null) {
      $this->db->where('id_stokout', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function delete($id)
  {
    $this->db->where('id_stokout', $id);
    $this->db->delete('tb_stokout');
  }

  public function get_stokout()
  {
    $this->db->select('tb_stokout.id_stokout, tb_item.barcode, tb_item.nama as item_nama, qty, tgl, info, tb_item.id_item');
    $this->db->from('tb_stokout');
    $this->db->join('tb_item', 'tb_stokout.id_item = tb_item.id_item');
    $this->db->where('tipe', 'out');
    $this->db->order_by('id_stokout', 'desc');
    $query = $this->db->get();
    return $query;
  }

  public function stokout_add($post)
  {
    $param = [
      'id_item' => $post['id_item'],
      'tipe' => 'out',
      'info' => $post['info'],
      'qty' => $post['qty'],
      'tgl' => $post['tgl'],
      'user_id' => $this->session->userdata('user_id')
    ];
    $this->db->insert('tb_stokout', $param);
  }

  function check_stok($stok)
  {
    $this->db->from('tb_item');
    $this->db->where('stok', $stok);
    $query = $this->db->get();
    return $query;
  }
}
