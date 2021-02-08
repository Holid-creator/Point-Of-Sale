<section class="content-header">
  <h1 style="margin-top: 60px;"><?= $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-user"></i></a></li>
    <li class="active"><?= $title; ?></li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <div class="pull-right"><a href="<?= base_url('stok/out') ?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"></i> Kembali</a></div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <form action="<?= base_url('stok_out/proccess') ?>" method="post">
            <div class="form-group <?= form_error('tgl') ? 'has-error' : null ?>">
              <label for="">Tanggal</label>
              <input type="date" class="form-control" name="tgl" value="<?= date('Y-m-d') ?>" autofocus required>
              <?= form_error('tgl') ?>
            </div>
            <div>
              <label for="barcode">Barcode</label>
            </div>
            <div class="form-group input-group">
              <input type="hidden" name="id_item" id="id_item">
              <input type="text" name="barcode" id="barcode" class="form-control" equired autofocus>
              <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item"><i class="fa fa-search"></i></button>
              </span>
            </div>
            <div class="form-group">
              <label for="">Nama Item</label>
              <input type="text" name="nama" id="nama" class="form-control" readonly>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-8">
                  <label for="unit_nama">Unit Item</label>
                  <input type="text" name="unit_nama" id="unit_nama" value="-" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                  <label for="stok">Inisial Stok</label>
                  <input type="text" name="stok" id="stok" value="-" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="info">info</label>
              <input type="text" name="info" class="form-control" placeholder="Rusak / Hilang / Kadaluarsa Etc" required>
            </div>
            <div class="form-group">
              <label for="qty">Quantity</label>
              <input type="number" name="qty" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success btn-flat" name="out_add"><i class="fa fa-paper-plane"></i> Simpan</button>
            <button type="reset" class="btn btn-flat">Reset</button>
          </form>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="modal-item">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Pilih Produk Item</h4>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered table-striped table-hover" id="table1">
          <thead>
            <tr>
              <th>Barcode</th>
              <th>Nama</th>
              <th>Unit</th>
              <th>Harga</th>
              <th>Stock</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($item as $i => $data) { ?>
              <tr>
                <td><?= $data->barcode; ?></td>
                <td><?= $data->nama; ?></td>
                <td><?= $data->unit_nama; ?></td>
                <td><?= indo_currency($data->hrg); ?></td>
                <td><?= $data->stok; ?></td>
                <td>
                  <button class="btn btnxs btn-info" id="select" data-id="<?= $data->id_item ?>" data-barcode=" <?= $data->barcode ?>" data-nama="<?= $data->nama ?>" data-unit="<?= $data->unit_nama ?>" data-stok=" <?= $data->stok ?>">
                    <i class=" fa fa-check"></i> Select
                  </button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $(document).on('click', '#select', function() {
      var id_item = $(this).data('id');
      var barcode = $(this).data('barcode');
      var nama = $(this).data('nama');
      var unit_nama = $(this).data('unit');
      var stok = $(this).data('stok');

      $('#id_item').val(id_item);
      $('#barcode').val(barcode);
      $('#nama').val(nama);
      $('#unit_nama').val(unit_nama);
      $('#stok').val(stok);
      $('#modal-item').modal('hide');
    })
  })
</script>