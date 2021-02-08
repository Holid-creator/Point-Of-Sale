<?php

class Sales_m extends CI_Model
{

  public function no_inv()
  {
    $sql = "SELECT MAX(MID(inv,9,4)) AS no_inv FROM tb_sale WHERE MID(inv,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d%')";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $row = $query->row();
      $n = ((int)$row->no_inv) + 1;
      $no = sprintf("%'.04d", $n);
    } else {
      $no = "0001";
    }
    $inv = "H&Y" . date('ymd') . $no;
    return $inv;
  }
}
