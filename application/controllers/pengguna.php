<?php

class Pengguna extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    check_admin();
  }

  public function index()
  {
    $data['title'] = 'Data User';

    $data['user'] = $this->user->get();
    $this->template->load('template', 'user/user_data', $data);
  }

  public function add()
  {
    $data['title'] = 'Tambah Data User';

    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|is_unique[tb_user.username]');
    $this->form_validation->set_rules('pass', 'Password', 'required|min_length[4]|matches[cpass]');
    $this->form_validation->set_rules('cpass', 'Confirm Password', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('level', 'level', 'required');

    $this->form_validation->set_message('is_unique', '%s Tersebut Sudah Terdaftar');
    $this->form_validation->set_message('required', '%s Wajib Diisi');
    $this->form_validation->set_message('min_length', '{field} Minimal 4 karakter');
    $this->form_validation->set_message('matches', '{field} Tidak Sama! Silahkan Ulangi Lagi');
    // %s dan {field} sama saja Mengisi Alias

    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

    if ($this->form_validation->run() == FALSE) {
      $this->template->load('template', 'user/tambah', $data);
    } else {
      $post = $this->input->post(null, true);
      $this->user->add($post);
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', "Nama $post[nama] Berhasil Ditambahkan");
        redirect('pengguna');
      }
    }
  }

  public function edit($id)
  {
    $data['title'] = 'Ubah Data User';

    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|callback_username_check');

    if ($this->input->post('pass')) {
      $this->form_validation->set_rules('pass', 'Password', 'min_length[4]');
      $this->form_validation->set_rules('cpass', 'Confirm Password', 'matches[pass]');
    }

    if ($this->input->post('cpass')) {
      $this->form_validation->set_rules('cpass', 'Confirm Password', 'matches[pass]');
    }

    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('level', 'level', 'required');

    $this->form_validation->set_message('required', '%s Wajib Diisi');
    $this->form_validation->set_message('min_length', '{field} Minimal 4 karakter');
    $this->form_validation->set_message('matches', '{field} Tidak Sama! Silahkan Ulangi Lagi');
    // %s dan {field} sama saja Mengisi Alias

    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

    if ($this->form_validation->run() == FALSE) {
      $query = $this->user->get($id);
      if ($query->num_rows() > 0) {
        $data['row'] = $query->row();
        $this->template->load('template', 'user/edit', $data);
      } else {
        echo "<script>alert('Data Tidak Ditemukan')";
        echo "window.location = '" . site_url('pengguna') . "'</script>";
      }
    } else {
      $post = $this->input->post(null, true);
      $this->user->edit($post);
      if ($this->db->affected_rows() > 0) {
        echo "<script>alert('Data Berhasil DiUbah')</script>";
      }
      echo "<script>window.location = '" . site_url('pengguna') . "'</script>";
    }
  }

  public function username_check()
  {
    $post = $this->input->post(null, true);
    $query = $this->db->query("SELECT * FROM tb_user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
    if ($query->num_rows() > 0) {
      $this->form_validation->set_message('username_check', '{field} Ini Sudah Dipake, Silahkan Ganti');
      return false;
    } else {
      return true;
    }
  }

  public function delete($id)
  {
    $this->db->where('user_id', $id);
    $this->db->delete('tb_user');

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Pengguna Berhasil Dihapus');
      redirect('pengguna');
    }
  }
}
