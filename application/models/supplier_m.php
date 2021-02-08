<?php

class Supplier_m extends CI_Model
{
  public function get($id = null)
  {
    $this->db->from('tb_supplier');
    if ($id != null) {
      $this->db->where('id_supp', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function add($post)
  {
    $params = [
      'nama' => $post['nama'],
      'phone' => $post['phone'],
      'alamat' => $post['alamat'],
      'deskripsi' => empty($post['deskripsi']) ? null : $post['deskripsi']
    ];

    $this->db->insert('tb_supplier', $params);
  }

  public function edit($post)
  {
    $params = [
      'nama' => $post['nama'],
      'phone' => $post['phone'],
      'alamat' => $post['alamat'],
      'deskripsi' => empty($post['deskripsi']) ? null : $post['deskripsi'],
      'updated' => date('Y-m-d H:i:s')
    ];
    $this->db->where('id_supp', $post['id_supp']);
    $this->db->update('tb_supplier', $params);
  }


  public function delete($id)
  {
    $this->db->where('id_supp', $id);
    $this->db->delete('tb_supplier');
  }
}
