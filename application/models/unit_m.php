<?php

class Unit_m extends CI_Model
{
  public function get($id = null)
  {
    $this->db->from('tb_unit');
    if ($id != null) {
      $this->db->where('id_unit', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function add($post)
  {
    $param['nama'] = $post['nama'];

    $this->db->insert('tb_unit', $param);
  }

  public function edit($post)
  {
    $param = [
      'nama' => $post['nama'],
      'updated' => date('d-M-Y H:i:s')
    ];

    $this->db->where('id_unit', $post['id_unit']);
    $this->db->update('tb_unit', $param);
  }

  public function delete($id)
  {
    $this->db->where('id_unit', $id);
    $this->db->delete('tb_unit');
  }
}
