<section class="content-header">
  <h1 style="margin-top: 50px;"><?= $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-user"></i></a></li>
    <li class="active"><?= $title; ?></li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-4">
      <div class="box box-widget">
        <div class="box-body">
          <table width="100%">
            <tr>
              <td style="vertical-align: top;">
                <label for="">Tanggal</label>
              </td>
              <td>
                <div class="form-group">
                  <input type="date" class="form-control" id="tgl" value="<?= date('Y-m-d') ?>">
                </div>
              </td>
            </tr>
            <tr>
              <td style="vertical-align: top;">
                <label for="user">Kasir</label>
              </td>
              <td>
                <div class="form-group">
                  <input type="text" class="form-control" id="user" value="<?= $this->fungsi->user_login()->nama ?>" readonly>
                </div>
              </td>
            </tr>
            <tr>
              <td style="vertical-align: top;">
                <label for="">Konsumen</label>
              </td>
              <td>
                <select name="customer" class="form-control">
                  <option value="">Umum</option>
                  <?php foreach ($cust as $cs => $value) {
                    echo '<option value="' . $value->id_cust . '">' . $value->nama . '</option>';
                  } ?>
                </select>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="box box-widget">
        <div class="box-body">
          <table width="100%">
            <tr>
              <td style="vertical-align: top; width: 23%">
                <label for="barcode">Barcode</label>
              </td>
              <td>
                <div class="form-group input-group">
                  <input type="hidden" id="id_item">
                  <input type="hidden" id="hrg">
                  <input type="hidden" id="stok">
                  <input type="text" id="barcode" class="form-control" autofocus>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </td>
            </tr>
            <tr>
              <td style="vertical-align: top;">
                <label for="">Quantity</label>
              </td>
              <td>
                <div class="form-group">
                  <input type="number" id="qty" value="1" min="1" class="form-control">
                </div>
              </td>
            </tr>
            <tr>
              <td></td>
              <td><button type="button" id="add_cart" class="btn btn-primary btn-flat"><i class="fa fa-cart-plus"></i> Tambah</button></td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="box box-widget">
        <div class="box-body">
          <div align="right">
            <h4>Invoice <b><span id="invoice"><?= $inv; ?></span></b></h4>
            <h1><b><span id="grand_total2" style="font-size: 50pt;">0</span></b></h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-widget">
        <div class="box-body table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>barcode</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th width="10%">Discount Item</th>
                <th width="15%">Total</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="cart_table">
              <tr>
                <td colspan="9" class="text-center">Tidak Ada Item</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="box box-widget">
        <div class="box-body">
          <table width="100%">
            <tr>
              <td style="vertical-align: top; width: 30%;">
                <label for="sub_total">Sub Total</label>
              </td>
              <td>
                <div class="form-group">
                  <input type="number" class="form-control" id="sub_total" value="">
                </div>
              </td>
            </tr>
            <tr>
              <td style="vertical-align: top; width: 30%;">
                <label for="discount">Diskon</label>
              </td>
              <td>
                <div class="form-group">
                  <input type="number" class="form-control" id="discount" value="0" min="0">
                </div>
              </td>
            </tr>
            <tr>
              <td style="vertical-align: top; width: 40%;">
                <label for="grand_total">Grand Total</label>
              </td>
              <td>
                <input type="number" class="form-control" id="grand_total" readonly>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="box box-widget">
        <div class="box-body">
          <table width="100%">
            <tr>
              <td style="vertical-align: top; width: 30%;">
                <label for="cash">Cash</label>
              </td>
              <td>
                <div class="form-group">
                  <input type="number" class="form-control" id="cash" value="0" min="0">
                </div>
              </td>
            </tr>
            <tr>
              <td style="vertical-align: top; width: 30%;">
                <label for="change">Kembalian</label>
              </td>
              <td>
                <input type="number" class="form-control" id="change">
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="box box-widget">
        <div class="box-body">
          <table width="100%">
            <tr>
              <td style="vertical-align: top; width: 30%;">
                <label for="note">Note</label>
              </td>
              <td>
                <textarea name="note" id="note" rows="6" class="form-control"></textarea>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div>
        <tr>
          <td style="vertical-align: top; width: 30%;">
            <button id="c_payment" class="btn btn-flat btn-warning"><i class="fa fa-refresh"></i> Cancel</button>
            <button id="p_payment" class="btn btn-flat btn-success"><i class="fa fa-paper-plane"></i> Prosess Pembayaran</button>
          </td>
        </tr>
      </div>
    </div>
  </div>
</section>