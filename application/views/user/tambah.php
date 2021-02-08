<section class="content-header">
  <h1><?= $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-user"></i></a></li>
    <li class="active">Pengguna</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= $title; ?></h3>
      <div class="pull-right"><a href="<?= base_url('pengguna') ?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"></i> Kembali</a></div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
              <label for="">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" value="<?= set_value('nama') ?>" autofocus>
              <?= form_error('nama') ?>
            </div>
            <div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
              <label for="">Username</label>
              <input type="text" class="form-control" name="username" value="<?= set_value('username') ?>">
              <?= form_error('username') ?>
            </div>
            <div class="form-group <?= form_error('pass') ? 'has-error' : null ?>">
              <label for="">Password</label>
              <input type="password" class="form-control" name="pass" value="<?= set_value('pass') ?>">
              <?= form_error('pass') ?>
            </div>
            <div class="form-group <?= form_error('cpass') ? 'has-error' : null ?>">
              <label for="">Konfirmasi Password</label>
              <input type="password" class="form-control" name="cpass" value="<?= set_value('cpass') ?>">
              <?= form_error('cpass') ?>
            </div>
        </div>
        <div class="col-md-6">
          <div class="form-group <?= form_error('alamat') ? 'has-error' : null ?>">
            <label for="">Alamat</label>
            <textarea name="alamat" class="form-control"><?= set_value('alamat') ?></textarea>
            <?= form_error('alamat') ?>
          </div>
          <div class="form-group <?= form_error('level') ? 'has-error' : null ?>">
            <label for="">Level</label>
            <select name="level" class="form-control" value="<?= set_value('level') ?>">
              <option value="">-- Pilih Level --</option>
              <option value="1" <?= set_value('level') == 1 ? "selected" : null ?>>Admin</option>
              <option value="2" <?= set_value('level') == 2 ? "selected" : null ?>>Kasir</option>
            </select>
            <?= form_error('level') ?>
          </div>
          <div class="form-group">
            <label for="">Foto</label>
            <input type="file" class="form-control" name="foto">
          </div>

          <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i> Simpan</button>
          <button type="reset" class="btn btn-flat">Reset</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>