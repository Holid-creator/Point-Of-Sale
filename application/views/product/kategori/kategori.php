<section class="content-header">
  <h1><?= $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-user"></i></a></li>
    <li class="active"><?= $title; ?></li>
  </ol>
</section>

<section class="content">
  <!-- <?php $this->view('messages') ?> -->
  <div id="flash" data-flash="<?= $this->session->flashdata('success') ?>"></div>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= $title; ?></h3>
      <div class="pull-right"><a href="<?= base_url('kategori/add') ?>" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Tambah</a></div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped table-hover" id="table1">
        <thead>
          <tr>
            <th width="20px">No</th>
            <th>Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($kategori->result() as $key => $data) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data->nama; ?></td>
              <td width="170px">
                <a href="<?= base_url('kategori/edit/' . $data->id_kat) ?>" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-edit"></i> Ubah</a>
                <input type="hidden" value="<?= $data->id_kat ?>" name="id_kat">
                <a id="btn_hps" href="<?= base_url('kategori/delete/' . $data->id_kat) ?>" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Hapus</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>