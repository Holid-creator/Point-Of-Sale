<?php

class Auth extends CI_Controller
{
  public function login()
  {
    check_already_login();
    $this->load->view('form_login');
  }

  public function prosess()
  {
    $post = $this->input->post(null, true);
    if (isset($post['login'])) {
      $this->load->model('user');
      $query = $this->user->login($post);

      if ($query->num_rows() > 0) {
        $row = $query->row();
        $params = array(
          'user_id' => $row->user_id,
          'level' => $row->level
        );

        $this->session->set_userdata($params);
        $this->session->set_flashdata('success', 'Selamat Datang DiAplikasi Admin Toko Holid');
        redirect('dashboard');
      } else {
        $this->session->set_flashdata('error', 'Silahkan Ulangi Lagi.');
        redirect('auth/login');
      }
    }
  }

  public function logout()
  {
    $param = array('user_id', 'level');
    $this->session->unset_userdata($param);
    redirect('auth/login');
  }
}
