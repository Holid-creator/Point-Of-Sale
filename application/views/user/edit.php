<section class="content-header">
  <h1><?= $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-user"></i></a></li>
    <li class="active"><?= $title; ?></li>
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
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <form action="" method="post">
            <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
              <label for="">Nama Lengkap</label>
              <input type="hidden" value="<?= $row->user_id ?>" name="user_id">
              <input type="text" class="form-control" name="nama" value="<?= $this->input->post('nama') ?? $row->nama ?>" autofocus>
              <?= form_error('nama') ?>
            </div>
            <div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
              <label for="">Username</label>
              <input type="text" class="form-control" name="username" value="<?= $this->input->post('username') ?? $row->username ?>">
              <?= form_error('username') ?>
            </div>
            <div class="form-group <?= form_error('pass') ? 'has-error' : null ?>">
              <label for="">Password</label> <small>( Biarkan Kosong Jika Tidak Diganti )</small>
              <input type="password" class="form-control" name="pass" value="<?= set_value('pass') ?>">
              <?= form_error('pass') ?>
            </div>
            <div class="form-group <?= form_error('cpass') ? 'has-error' : null ?>">
              <label for="">Konfirmasi Password</label>
              <input type="password" class="form-control" name="cpass" value="<?= set_value('cpass') ?>">
              <?= form_error('cpass') ?>
            </div>
            <div class="form-group <?= form_error('alamat') ? 'has-error' : null ?>">
              <label for="">Alamat</label>
              <textarea name="alamat" class="form-control"><?= $this->input->post('alamat') ?? $row->alamat ?></textarea>
              <?= form_error('alamat') ?>
            </div>
            <div class="form-group <?= form_error('level') ? 'has-error' : null ?>">
              <label for="">Level</label>
              <select name="level" class="form-control" value="<?= set_value('level') ?>">
                <?php $level = $this->input->post('level') ? $this->input->post('level') : $row->level ?>
                <option value="1">Admin</option>
                <option value="2" <?= $level == 2 ? 'selected' : null ?>>Kasir</option>
              </select>
              <!-- <?= form_error('level') ?> -->
            </div>
            <div class="form-group">
              <img src="<?= base_url('uploads/img/' . $row->foto) ?>" alt="" class="img-thumbnail"><br>
              <label for="" style="margin-left: 50px; margin-top: 5px;">Foto</label>
              <input type="file" class="form-control" name="foto">
            </div>

            <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i> Simpan</button>
            <button type="reset" class="btn btn-flat">Reset</button>
          </form>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
  </div>
</section>