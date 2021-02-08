<?php

function check_already_login()
{
  $ci = &get_instance();
  $user_session = $ci->session->userdata('user_id');

  if ($user_session) {
    redirect('dashboard');
  }
}

function check_not_login()
{
  $ci = &get_instance();
  $user_session = $ci->session->userdata('user_id');

  if (!$user_session) {
    redirect('auth/login');
  }
}

function check_admin()
{
  $ci = &get_instance();
  if ($ci->fungsi->user_login()->level != 1) {
    redirect('dashboard');
  }
}

function indo_currency($id)
{
  return 'Rp. ' . number_format($id, 0, ',', '.');
}

function indo_date($date)
{
  $tgl = substr($date, 8, 2);
  $bln = substr($date, 5, 2);
  $thn = substr($date, 0, 4);
  return $tgl . '/' . $bln . '/' . $thn;
}
