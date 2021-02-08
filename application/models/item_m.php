<?php

class Item_m extends CI_Model
{

  // Sumber Halaman https://pastebin.com/zARPHSDa
  // start datatables
  var $column_order = array(null, 'barcode', 'tb_item.nama', 'kat_nama', 'unit_nama', 'hrg', 'stok'); //set column field database for datatable orderable
  var $column_search = array('barcode', 'tb_item.nama', 'hrg'); //set column field database for datatable searchable
  var $order = array('id_item' => 'asc'); // default order 

  private function _get_datatables_query()
  {
    $this->db->select('tb_item.*, tb_kategori.nama as kat_nama, tb_unit.nama as unit_nama');
    $this->db->from('tb_item');
    $this->db->join('tb_kategori', 'tb_item.id_kat = tb_kategori.id_kat');
    $this->db->join('tb_unit', 'tb_item.id_unit = tb_unit.id_unit');
    $i = 0;
    foreach ($this->column_search as $item) { // loop column 
      if (@$_POST['search']['value']) { // if datatable send POST for search
        if ($i === 0) { // first loop
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }
        if (count($this->column_search) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if (isset($_POST['order'])) { // here order processing
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }
  function get_datatables()
  {
    $this->_get_datatables_query();
    if (@$_POST['length'] != -1)
      $this->db->limit(@$_POST['length'], @$_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }
  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }
  function count_all()
  {
    $this->db->from('tb_item');
    return $this->db->count_all_results();
  }
  // end datatables


  public function get($id = null)
  {
    $this->db->select('tb_item.*, tb_kategori.nama as kat_nama, tb_unit.nama as unit_nama');
    $this->db->from('tb_item');
    $this->db->join('tb_kategori', 'tb_kategori.id_kat = tb_item.id_kat');
    $this->db->join('tb_unit', 'tb_unit.id_unit = tb_item.id_unit');
    if ($id != null) {
      $this->db->where('id_item', $id);
    }
    $this->db->order_by('barcode', 'asc');
    $query = $this->db->get();
    return $query;
  }

  public function add($post)
  {
    $param = [
      'barcode' => $post['barcode'],
      'nama' => $post['nama'],
      'id_kat' => $post['id_kat'],
      'id_unit' => $post['id_unit'],
      'hrg' => $post['hrg'],
      'img' => $post['img']
    ];

    $this->db->insert('tb_item', $param);
  }

  public function edit($post)
  {
    $param = [
      'barcode' => $post['barcode'],
      'nama' => $post['nama'],
      'id_kat' => $post['id_kat'],
      'id_unit' => $post['id_unit'],
      'hrg' => $post['hrg'],
      'updated' => date('Y-m-d H:i:s')
    ];
    if ($post['img'] != null) {
      $param['img'] = $post['img'];
    }
    $this->db->where('id_item', $post['id_item']);
    $this->db->update('tb_item', $param);
  }

  function check_barcode($code, $id = null)
  {
    $this->db->from('tb_item');
    $this->db->where('barcode', $code);
    if ($id != null) {
      $this->db->where('id_item !=', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function delete($id)
  {
    $this->db->where('id_item', $id);
    $this->db->delete('tb_item');
  }

  function stokin_update($data)
  {
    $qty = $data['qty'];
    $id = $data['id_item'];
    $sql = "UPDATE tb_item SET stok = stok + '$qty' WHERE id_item = '$id'";
    $this->db->query($sql);
  }

  function stokout_update($data)
  {
    $qty = $data['qty'];
    $id = $data['id_item'];
    $sql = "UPDATE tb_item SET stok = stok - '$qty' WHERE id_item = '$id'";
    $this->db->query($sql);
  }
}
