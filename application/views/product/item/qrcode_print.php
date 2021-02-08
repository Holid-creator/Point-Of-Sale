<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barcode Product <?= $item->barcode ?></title>
</head>

<body>

  <img src="<?= base_url('uploads/qr-code/item-' . $item->barcode . '.png') ?>" width="250px"><br>
  <div style="margin-left: 75px;"><?= $item->barcode; ?></div>


</body>

</html>