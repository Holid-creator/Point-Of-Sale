<?php

class User extends CI_Model
{
  public function login($post)
  {
    $this->db->select('*');
    $this->db->from('tb_user');
    $this->db->where('username', $post['username']);
    $this->db->where('pass', sha1($post['pass']));
    $query = $this->db->get();
    return $query;
  }

  public function get($id = null)
  {
    $this->db->from('tb_user');
    if ($id != null) {
      $this->db->where('user_id', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function add($post)
  {
    $params['nama'] = $post['nama'];
    $params['username'] = $post['username'];
    $params['pass'] = sha1($post['pass']);
    $params['alamat'] = $post['alamat'];
    $params['level'] = $post['level'];
    $params['foto'] = $post['foto'];

    $this->db->insert('tb_user', $params);
  }

  public function edit($post)
  {
    $params['nama'] = $post['nama'];
    $params['username'] = $post['username'];

    if (!empty($post['pass'])) {
      $params['pass'] = sha1($post['pass']);
    }

    $params['alamat'] = $post['alamat'] != '' ? $post['alamat'] : null;
    $params['level'] = $post['level'];

    if ($post['foto'] != null) {
      $param['foto'] = $post['foto'];
    }

    $this->db->where('user_id', $post['user_id']);
    $this->db->update('tb_user', $params);
  }

  public function delete($id)
  {
    $this->db->where('user_id', $id);
    $this->db->delete('tb_user');
  }
}
