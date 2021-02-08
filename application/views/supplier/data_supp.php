<section class="content-header">
  <h1><?= $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-user"></i></a></li>
    <li class="active"><?= $title; ?></li>
  </ol>
</section>

<section class="content">
  <!-- <?php $this->view('messages'); ?> -->
  <div id="flash" data-flash="<?= $this->session->flashdata('success') ?>"></div>
  <div id="error" data-error="<?= $this->session->flashdata('error') ?>"></div>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= $title; ?></h3>
      <div class="pull-right"><a href="<?= base_url('supplier/add') ?>" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Create</a></div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped table-hover" id="table1">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No. Handphone</th>
            <th>Alamat</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($supplier->result() as $key => $data) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data->nama; ?></td>
              <td><?= $data->phone; ?></td>
              <td><?= $data->alamat; ?></td>
              <td><?= $data->deskripsi ?></td>
              <td width="170px">
                <a href="<?= base_url('supplier/edit/' . $data->id_supp) ?>" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-edit"></i> Ubah</a>
                <input type="hidden" value="<?= $data->id_supp ?>" name="user_id">
                <!-- <a onclick="return confirm('Apakah Anda Yakin')" href="<?= base_url('supplier/delete/' . $data->id_supp) ?>" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Hapus</a> -->
                <a id="btn_hps" href="<?= base_url('supplier/delete/' . $data->id_supp) ?>" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Hapus</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- Modal Fade Alert Bootstrap -->
<div class="modal fade" id="modalDelete">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Closse"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Yakin Akan Menghapus Data Ini ?</h4>
      </div>
      <div class="modal-footer">
        <form id="formDelete" action="" method="post">
          <button class="btn btn-default" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>