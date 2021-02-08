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
      <div class="pull-right"><a href="<?= base_url('supplier') ?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"></i> Kembali</a></div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <form action="<?= base_url('supplier/proccess') ?>" method="post">
            <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
              <label for="">Nama Lengkap</label>
              <input type="hidden" name="id_supp" value="<?= $row->id_supp ?>">
              <input type="text" class="form-control" name="nama" value="<?= $row->nama ?>" autofocus>
              <?= form_error('nama') ?>
            </div>
            <div class="form-group <?= form_error('phone') ? 'has-error' : null ?>">
              <label for="">No. Handphone</label>
              <input type="text" class="form-control" name="phone" value="<?= $row->phone ?>">
              <?= form_error('phone') ?>
            </div>
            <div class="form-group <?= form_error('alamat') ? 'has-error' : null ?>">
              <label for="">Alamat</label>
              <input type="text" class="form-control" name="alamat" value="<?= $row->alamat ?>">
              <?= form_error('alamat') ?>
            </div>
            <div class="form-group <?= form_error('deskripsi') ? 'has-error' : null ?>">
              <label for="">Deskripsi</label>
              <input type="text" class="form-control" name="deskripsi" value="<?= $row->deskripsi ?>">
              <?= form_error('deskripsi') ?>
            </div>
            <button type="submit" class="btn btn-success btn-flat" name="<?= $page ?>"><i class="fa fa-paper-plane"></i> Simpan</button>
            <button type="reset" class="btn btn-flat">Reset</button>
          </form>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
  </div>
</section>