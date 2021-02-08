<section class="content-header">
  <h1 style="margin-top: 50px;"><?= $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-user"></i></a></li>
    <li class="active"><?= $title; ?></li>
  </ol>
</section>

<section class="content">
  <div id="flash" data-flash="<?= $this->session->flashdata('success') ?>"></div>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= $title; ?></h3>
      <div class="pull-right"><a href="<?= base_url('stok/in/add') ?>" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Tambah</a></div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped table-hover" id="table1">
        <thead>
          <tr>
            <th width="20px">No</th>
            <th class="text-center">Barcode</th>
            <th class="text-center">Produk Item</th>
            <th class="text-center">Quntity</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($stokin as $key => $data) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data->barcode; ?></td>
              <td><?= $data->item_nama; ?></td>
              <td class="text-center"><?= $data->qty; ?></td>
              <td class="text-center"><?= date('d F Y', strtotime(($data->tgl))); ?></td>
              <td width="170px">
                <a class="btn btn-default btn-flat btn-sm" id="btn_detail" data-toggle="modal" data-target="#modal-detail" data-barcode="<?= $data->barcode ?>" data-itemnama="<?= $data->item_nama ?>" data-detail="<?= $data->detail ?>" data-suppnama="<?= $data->supp_nama ?>" data-qty="<?= $data->qty ?>" data-tgl="<?= date('d F Y', strtotime($data->tgl)) ?>"><i class="fa fa-eye"></i> Detail</a>

                <a id="btn_hps" href="<?= base_url('stok/in/delete/' . $data->id_stok . '/' . $data->id_item) ?>" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Hapus</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<div class="modal fade" id="modal-detail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Stok In Detail</h4>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <tbody>
            <tr>
              <th>Barcode</th>
              <td><span id="barcode"></span></td>
            </tr>
            <tr>
              <th>Nama Item</th>
              <td><span id="item_nama"></span></td>
            </tr>
            <tr>
              <th>Detail</th>
              <td><span id="detail"></span></td>
            </tr>
            <tr>
              <th>Nama Supplier</th>
              <td><span id="supp_nama"></span></td>
            </tr>
            <tr>
              <th>Quantity</th>
              <td><span id="qty"></span></td>
            </tr>
            <tr>
              <th>Tanggal</th>
              <td><span id="tgl"></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $(document).on('click', '#btn_detail', function() {
      var barcode = $(this).data('barcode');
      var item_nama = $(this).data('itemnama');
      var detail = $(this).data('detail');
      var supp_nama = $(this).data('suppnama');
      var qty = $(this).data('qty');
      var tgl = $(this).data('tgl');

      $('#barcode').text(barcode);
      $('#item_nama').text(item_nama);
      $('#detail').text(detail);
      $('#supp_nama').text(supp_nama);
      $('#qty').text(qty);
      $('#tgl').text(tgl);
    })
  })
</script>