<section class="content-header">
  <h1><?= $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-user"></i></a></li>
    <li class="active">Pengguna</li>
  </ol>
</section>

<section class="content">
  <div id="flash" data-flash="<?= $this->session->flashdata('success') ?>"></div>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= $title; ?></h3>
      <div class="pull-right"><a href="<?= base_url('pengguna/add') ?>" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Create</a></div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Level</th>
            <th>Foto</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($user->result() as $key => $data) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data->username; ?></td>
              <td><?= $data->nama; ?></td>
              <td><?= $data->alamat; ?></td>
              <td><?= $data->level == 1 ? 'Admin' : 'Kasir'; ?></td>
              <td class="text-center">
                <img src="<?= base_url('uploads/img/') . $data->foto ?>" width="70px">
              </td>
              <td width="170px">
                <form action="" method="post">
                  <a href="<?= base_url('pengguna/edit/' . $data->user_id) ?>" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-edit"></i> Ubah</a>
                  <input type="hidden" value="<?= $data->user_id ?>" name="user_id">
                  <a id="btn_hps" href="<?= base_url('pengguna/delete/' . $data->user_id) ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>