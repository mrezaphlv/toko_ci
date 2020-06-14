<?php $this->load->view('_head') ?>
<div class="card">
  <div class="card-header">
    <i class="fa fa-file"></i> Detail Transaksi
    <div class="pull-right"><button id="cetak_pdff" class="cetak_pdff btn btn-success btn-sm">Cetak Struk</button></div>
  </div>
  <div class="card-body">
    <strong>Kode transaksi : </strong> <?php echo $kd_trans; ?><br>
    <strong>Nama Customer : </strong> <?php echo $nama_cust; ?><br>
    <strong>Tanggal : </strong> <?php echo $tanggal; ?><br>
    <strong>Total Harga : </strong> <?php echo $total_harga; ?><br>
    <strong>Bayar : </strong> <?php echo $bayar; ?><br>
    <strong>Kembali : </strong> <?php echo $kembali; ?><br>
  </div>
</div>
<br>
<table class="table table-condensed" id="myTable">
  <thead>
    <tr>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Harga Satuan</th>
      <th>Jumlah</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($barang as $ke): ?>
<tr>
  <td><?php echo $ke->kd_barang; ?></td>
  <td><?php echo $ke->nama_barang; ?></td>
  <td><?php echo $ke->harga; ?></td>
  <td><?php echo $ke->jumlah; ?></td>
  <td><?php echo $ke->sub_total; ?></td>
</tr>
<?php endforeach; ?>
  </tbody>
</table>


<?php $this->load->view('_foot') ?>
<script>
  $(document).ready(function(){
  //  var kode = <?php echo base_url('Transaksi/cetak_pdf/').$kd_trans; ?>
    $('#myTable').DataTable();
    $('.cetak_pdff').on('click',function(){
document.location.href = "<?php echo base_url('Transaksi/cetak_pdf/').$kd_trans; ?>";

    });
  });
</script>
