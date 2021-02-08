<section class="content-header">
  <h1 style="margin-top: 50px;"><?= $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-user"></i></a></li>
    <li class="active"><?= $title; ?></li>
  </ol>
</section>

<section class="content">
  <!-- <?php $this->view('messages') ?> -->
  <div id="error" data-error="<?= $this->session->flashdata('error') ?>"></div>
  <div class="box">
    <div class="box-header">
      <div class="pull-right"><a href="<?= base_url('item') ?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"></i> Kembali</a></div>
    </div>
    <div class="box-body">
      <div class="row">
        <?= form_open_multipart('item/proccess') ?>
        <div class="col-md-6">
          <div class="form-group <?= form_error('barcode') ? 'has-error' : null ?>">
            <label for="">Kode Barcode</label>
            <input type="hidden" name="id_item" value="<?= $row->id_item ?>">
            <input type="text" class="form-control" name="barcode" value="<?= $row->barcode ?>" autofocus required>
            <?= form_error('barcode') ?>
          </div>
          <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
            <label for="">Nama Produk</label>
            <input type="text" class="form-control" name="nama" value="<?= $row->nama ?>" required>
            <?= form_error('nama') ?>
          </div>
          <div class="form-group <?= form_error('id_kat') ? 'has-error' : null ?>">
            <label for="">Kategori</label>
            <select name="id_kat" class="form-control" required>
              <option value="">-- Pilih Kategori --</option>
              <?php foreach ($id_kat->result() as $key => $data) { ?>
                <option value="<?= $data->id_kat ?>" <?= $data->id_kat == $row->id_kat ? 'selected' : null ?>><?= $data->nama; ?></option>
              <?php } ?>
            </select>
            <?= form_error('id_kat') ?>
          </div>
          <div class="form-group <?= form_error('id_unit') ? 'has-error' : null ?>">
            <label for="">Nama Unit</label>
            <?= form_dropdown('id_unit', $id_unit, $selected_unit, ['class' => 'form-control', 'required' => 'required']) ?>
            <?= form_error('id_unit') ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group <?= form_error('hrg') ? 'has-error' : null ?>">
            <label for="">Harga Barang</label>
            <input type="text" class="form-control" name="hrg" value="<?= $row->hrg ?>" required>
            <?= form_error('hrg') ?>
          </div>
          <div class="form-group <?= form_error('img') ? 'has-error' : null ?>">
            <label for="">Foto</label>
            <?php if ($page == 'edit') {
              if ($row->img != null) { ?>
                <div style="margin-bottom: 5px">
                  <img src="<?= base_url('uploads/product/' . $row->img) ?>" width="70px">
                </div>
            <?php }
            } ?>
            <input type="file" class="form-control" name="img">
            <small>( Biarkan Kosong Jika Tidak <?= $page == 'edit' ? 'diganti' : 'Ada' ?> )</small>
            <?= form_error('img') ?>
          </div>
          <button type="submit" class="btn btn-success btn-flat" name="<?= $page ?>"><i class="fa fa-paper-plane"></i> Simpan</button>
          <button type="reset" class="btn btn-flat">Reset</button>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</section>