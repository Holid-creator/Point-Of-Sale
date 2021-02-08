<section class="content-header">
  <h1 style="margin-top: 60px;"><?= $title; ?></h1>
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
      <div class="pull-right"><a href="<?= base_url('item/add') ?>" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Tambah</a></div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped table-hover" id="table1">
        <thead>
          <tr>
            <th width="20px">No</th>
            <th>Barcode</th>
            <th>Nama Produk</th>
            <th>kategori</th>
            <th>Unit</th>
            <th>Harga</th>
            <th>Stock</th>
            <th>Foto</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- <?php
                $no = 1;
                foreach ($item->result() as $key => $data) {
                ?>
            <tr>
              <td><?= $no++; ?></td>
              <td>
                <?= $data->barcode; ?><br>
                <a href="<?= base_url('item/barcode_qrcode/' . $data->id_item) ?>" class="btn btn-default btn-flat btn-sm">Generate <i class="fa fa-barcode"></i></a>
              </td>
              <td><?= $data->nama; ?></td>
              <td><?= $data->kat_nama; ?></td>
              <td><?= $data->unit_nama; ?></td>
              <td><?= $data->hrg; ?></td>
              <td><?= $data->stok; ?></td>
              <td>
                <?php if ($data->img != null) { ?>
                  <img src="<?= base_url('uploads/product/' . $data->img)  ?>" width="50px">
                <?php } ?>
              </td>
              <td width="170px">
                <a href="<?= base_url('item/edit/' . $data->id_item) ?>" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-edit"></i> Ubah</a>
                <input type="hidden" value="<?= $data->id_item ?>" name="id_item">
                <a onclick="return confirm('Apakah Anda Yakin')" href="<?= base_url('item/delete/' . $data->id_item) ?>" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Hapus</a>
              </td>
            </tr>
          <?php } ?> -->
        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $('#table1').dataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?= site_url('item/get_ajax') ?>",
        "type": "post"
      },
      "columnDefs": [{
        "targets": [5, 6],
        "className": 'text-right'
      }],
      "columnDefs": [{
        "targets": [7, 8],
        "className": 'text-center'
      }],
      "columnDefs": [{
        "targets": [0, 7, -1],
        "orderable": false
      }],
      "order": []
    });
  });
</script>