<?php

class Kat_m extends CI_Model
{
  public function get($id = null)
  {
    $this->db->from('tb_kategori');
    if ($id != null) {
      $this->db->where('id_kat', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function add($post)
  {
    $param = [
      'nama' => $post['nama'],
    ];
    $this->db->insert('tb_kategori', $param);
  }

  public function edit($post)
  {
    $param['nama'] = $post['nama'];
    $param['updated'] = date('Y-m-d H:i:s');

    $this->db->where('id_kat', $post['id_kat']);
    $this->db->update('tb_kategori', $param);
  }

  public function delete($id)
  {
    $this->db->where('id_kat', $id);
    $this->db->delete('tb_kategori');
  }
}
