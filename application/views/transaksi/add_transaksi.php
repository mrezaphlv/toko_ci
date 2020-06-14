<?php $this->load->view('_head'); ?>
<h5>Tambah transaksi Baru</h5>
<form method="post" action="<?php echo base_url('transaksi/transaksi_save'); ?>">
<div class="card">
<div class="card-header text-white bg-primary">Informasi Pelanggan</div>
<div class="card-body">
 
  <div class="row">
  <input class="form-control" name="kd_tr" id="kd_tr" type="hidden" placeholder="Tanggal" value="<?php echo date('YmdHis'); ?>" readonly="">
   <div class="col">
    <label>Kode Member</label>
      <select class="form-control" name="id_m" style="height: 100%;width:100%;"id="id_m">
        <option value="">---Umum----</option>

<?php foreach ($d_mem as $v) 
{
  echo '<option value="'.$v->id_m.'">';
  echo $v->kd_m.' - '.$v->nama_m;
  echo '</option>';
} ?>
      </select>

    </div>
    <input type="hidden" name="kd_m" id="kd_m" class="form-control" placeholder="">
    <div class="col">
    <label>Nama Customer</label>
      <input type="text" name="nama_m" id="nama_m" class="form-control-sm" placeholder="">
    </div>
    <div class="col">
    <LABEL>No telp/hp</LABEL>
      <input type="text" class="form-control-sm" name="telp" id="telp" placeholder="" >
      <input type="hidden" name="email_m" id="email_m"></input>
    </div>
    <div class="col">
    <LABEL>Tanggal   </LABEL>
      <input type="text" class="form-control-sm" name="tanggal" placeholder="" value="<?php echo date('Y-m-d'); ?>" readonly="">
    </div>
     
  </div>

</div>
</div>
<br>
<div class="card">
<div class="card-header text-white bg-info">List Barang</div>
<div class="card-body">
 <table class='table table-condensed' id='TabelTransaksi'>
            <thead>
              <tr>
                <th style='width:35px;'>NO</th>
                <th style='width:210px;'>Kode Barang</th>
                <th>Nama Barang</th>
                <th style='width:120px;'>Harga</th>
                <th style='width:75px;'>Qty</th>
                <th style='width:125px;'>Sub Total</th>
                <th style='width:40px;'></th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>       
</div>
<div class='card-footer bg-info text-white TotalBayar'>
            <button id='BarisBaru' type="button" class='btn btn-info pull-left'><i class='fa fa-plus fa-fw'></i> Baris Baru (F7)</button>
            <div class="pull-right"><h5>Total : <span id='TotalBayar'>Rp. 0</span></h5></div>
            <input type="hidden" name="total_bayar" id='TotalBayarHidden'>
          </div>

<div class="row">
  <div class='col-sm-12'>
              <div class="form-horizontal">
              <div class="row">
              <div class="col">
                <div class="form-group">
                  <label class="col-sm control-label">Bayar (F8)</label>
                  <div class="col-sm-8">
                    <input type='text' name='cash' id='UangCash' class='form-control' onkeypress='return check_int(event)'>
                  </div>
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                  <label class="col-sm-6 control-label">Kembali</label>
                  <div class="col-sm-8">
                    <input type='text' name="uangkembali" id='UangKembali' class='form-control' readonly>
                  </div>
                </div>
                </div>
              </div>
                
                <div class='row'>
                  <div class='' style='padding-right: 0px;'>
                   <!-- <button type='button' class='btn btn-warning btn-block' id='CetakStruk'>
                      <i class='fa fa-print'></i> Cetak (F9)
                    </button>-->
                  </div>
                  <div class='col'>
                    <!--<button type='button' class='btn btn-primary btn-block' id='Simpann'>SIMPAN
                    </button>-->
                    <input type="submit" name="simpan1" value="SIMPAN" class="btn btn-primary btn-block"></input>
                  </div>
                </div>
              </div>
            </div>
</div>
</div>
</form>
<?php $this->load->view('_foot'); ?>
<?php $this->load->view('transaksi/add_transaksi_js'); ?>
