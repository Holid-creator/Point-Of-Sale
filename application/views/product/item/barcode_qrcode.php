<section class="content-header">
  <h1 style="margin-top: 50px;"><?= $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-user"></i></a></li>
    <li class="active"><?= $title; ?></li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <div class="box-title"><?= $title; ?> <div class="fa fa-barcode"></div>
      </div>
      <div class="pull-right"><a href="<?= base_url('item') ?>" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-undo"></i> Kembali</a></div>
    </div>
    <div class="box-body">
      <?php
      $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
      echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($item->barcode, $generator::TYPE_CODE_128)) . '">';
      echo '<br>';
      echo $item->barcode;
      ?><br>
      <br>
      <a href="<?= site_url('item/barcode_print/' . $item->id_item) ?>" class="btn btn-default btn-sm" target="_blank">
        <i class="fa fa-print"></i> Print
      </a>
    </div>
  </div>

  <div class="box no-border">
    <div class="box-header">
      <div class="box-title"><?= $judul; ?> <i class="fa fa-qrcode"></i></div>
      <div class="box-body">
        <?php
        $qrCode = new Endroid\QrCode\QrCode($item->barcode);
        $qrCode->writeFile('uploads/qr-code/item-' . $item->barcode . '.png');
        ?>
        <img src="<?= base_url('uploads/qr-code/item-' . $item->barcode . '.png') ?>" width="200px"><br>
        <div style="margin-left: 60px;"><?= $item->barcode ?></div>
        <br>
        <a href="<?= site_url('item/qrcode_print/' . $item->id_item) ?>" class="btn btn-default btn-sm" target="_blank">
          <i class="fa fa-print"></i> Print
        </a>
      </div>
    </div>
</section>