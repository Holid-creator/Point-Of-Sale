<?php

class Item extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    $this->load->model(['item_m', 'unit_m', 'kat_m']);
  }

  //  Sumber Halaman https://pastebin.com/Ffg71hBd
  function get_ajax()
  {
    $list = $this->item_m->get_datatables();
    $data = array();
    $no = @$_POST['start'];
    foreach ($list as $item) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $item->barcode . '<br><a href="' . site_url('item/barcode_qrcode/' . $item->id_item) . '" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';
      $row[] = $item->nama;
      $row[] = $item->kat_nama;
      $row[] = $item->unit_nama;
      $row[] = '<div style="text-align: right;">' . indo_currency($item->hrg) . '</div>';
      $row[] = '<center>' . $item->stok . '</center>';
      $row[] = $item->img != null ? '<img src="' . base_url('uploads/product/' . $item->img) . '" class="img" style="width:50px">' : null;
      // add html for action
      $row[] = '<a href="' . site_url('item/edit/' . $item->id_item) . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                <a id="btn_hps" href="' . site_url('item/delete/' . $item->id_item) . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->item_m->count_all(),
      "recordsFiltered" => $this->item_m->count_filtered(),
      "data" => $data,
    );
    // output to json format
    echo json_encode($output);
  }


  public function index()
  {
    $data['title'] = 'Item';
    $data['item'] = $this->item_m->get();
    $this->template->load('template', 'product/item/item', $data);
  }

  public function add()
  {
    $item = new stdClass();
    $item->id_item = null;
    $item->barcode = null;
    $item->nama = null;
    $item->id_kat = null;
    $q_kat = $this->kat_m->get();
    $q_unit = $this->unit_m->get();
    $unit[null] = '-- Pilih Unit --';
    foreach ($q_unit->result() as $unt) {
      $unit[$unt->id_unit] = $unt->nama;
    }
    $item->hrg = null;
    $item->stok = null;

    $data = array(
      'page' => 'add',
      'row' => $item,
      'id_kat' => $q_kat,
      'id_unit' => $unit, 'selected_unit' => $q_kat
    );

    $data['title'] = 'Form Tambah Item';
    $this->template->load('template', 'product/item/tambah', $data);
  }

  public function edit($id)
  {
    $query = $this->item_m->get($id);
    if ($query->num_rows() > 0) {
      $item = $query->row();
      $q_kat = $this->kat_m->get();
      $q_unit = $this->unit_m->get();
      $unit[null] = '-- Pilih Unit --';
      foreach ($q_unit->result() as $unt) {
        $unit[$unt->id_unit] = $unt->nama;
      }

      $data = array(
        'page' => 'edit',
        'row' => $item,
        'id_kat' => $q_kat,
        'id_unit' => $unit, 'selected_unit' => $item->id_unit
      );

      $data['title'] = 'Form Edit Item';
      $this->template->load('template', 'product/item/tambah', $data);
    }
  }

  public function proccess()
  {
    $config['upload_path'] = './uploads/product/';
    $config['allowed_types'] = 'jpg|jpeg|pdf|png';
    $config['max_size'] = 2048;
    $config['file_name'] = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

    $this->load->library('upload', $config);

    $post = $this->input->post(null, true);
    if (isset($_POST['add'])) {
      if ($this->item_m->check_barcode($post['barcode'])->num_rows() > 0) {
        $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai barang lain");
        redirect('item/add');
      } else {

        if (@$_FILES['img']['name'] != null) {
          if ($this->upload->do_upload('img')) {
            $post['img'] = $this->upload->data('file_name');
            $this->item_m->add($post);

            if ($this->db->affected_rows() > 0) {
              $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
            }
            redirect('item');
          } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'Maaf Gambar Yang Anda Masukkan Melibihi 2Mb');
            redirect('item/add');
          }
        } else {
          $post['img'] = null;
          $this->item_m->add($post);

          if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
          }
          redirect('item');
        }
      }
    } else if (isset($_POST['edit'])) {
      if ($this->item_m->check_barcode($post['barcode'], $post['id_item'])->num_rows() > 0) {
        $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai barang lain");
        redirect('item/edit/' . $post['id_item']);
      } else {
        if (@$_FILES['img']['name'] != null) {
          if ($this->upload->do_upload('img')) {
            $item = $this->item_m->get($post['id_item'])->row();
            if ($item->img != null) {
              $target_file = './uploads/product/' . $item->img;
              unlink($target_file);
            }
            $post['img'] = $this->upload->data('file_name');
            $this->item_m->edit($post);

            if ($this->db->affected_rows() > 0) {
              $this->session->set_flashdata('success', 'Data Berhasil DiUbah');
            }
            redirect('item');
          } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('item/edit/' . $post['id_item']);
          }
        } else {
          $post['img'] = null;
          $this->item_m->edit($post);

          if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil DiUbah');
          }
          redirect('item');
        }
      }
    }
  }

  public function delete($id)
  {
    $item = $this->item_m->get($id)->row();
    if ($item->img != null) {
      $target_file = './uploads/product/' . $item->img;
      unlink($target_file);
    }

    $this->item_m->delete($id);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
      redirect('item');
    }
  }

  function barcode_qrcode($id)
  {
    $data['title'] = 'Barcode Generator';
    $data['judul'] = 'Qr Barcode Generator';
    $data['item'] = $this->item_m->get($id)->row();
    $this->template->load('template', 'product/item/barcode_qrcode', $data);
  }

  function barcode_print($id)
  {
    $data['item'] = $this->item_m->get($id)->row();
    $html = $this->load->view('product/item/bar_print', $data, true);
    $this->fungsi->pdfGenerator($html, 'barcode-' . $data['item']->barcode, 'A4', 'landscape');
  }
  function qrcode_print($id)
  {
    $data['item'] = $this->item_m->get($id)->row();
    $html = $this->load->view('product/item/qrcode_print', $data, true);
    $this->fungsi->pdfGenerator($html, 'qrcode-' . $data['item']->barcode, 'A4', 'landscape');
  }
}
