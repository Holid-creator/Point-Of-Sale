<?php

class Cust_m extends CI_Model
{
  public function get($id = null)
  {
    $this->db->from('tb_customer');
    if ($id != null) {
      $this->db->where('id_cust', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function add($post)
  {
    $param = [
      'nama' => $post['nama'],
      'jk' => $post['jk'],
      'phone' => $post['phone'],
      'alamat' => $post['alamat'],
    ];
    $this->db->insert('tb_customer', $param);
  }

  public function edit($post)
  {
    $param['nama'] = $post['nama'];
    $param['jk'] = $post['jk'];
    $param['phone'] = $post['phone'];
    $param['alamat'] = $post['alamat'];
    $param['updated'] = date('Y-m-d H:i:s');

    $this->db->where('id_cust', $post['id_cust']);
    $this->db->update('tb_customer', $param);
  }

  public function delete($id)
  {
    $this->db->where('id_cust', $id);
    $this->db->delete('tb_customer');
  }
}
