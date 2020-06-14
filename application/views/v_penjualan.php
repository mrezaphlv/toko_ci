<?php $this->load->view('_head'); ?>
<ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url('Dash') ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Data Penjualan</li>
        </ol>
        <div class="card">
        <form id="form-filter">
            <div class="card-body">
                <div class="row">
      <div class="col">
    <label>Nama Barang</label>
      <select class="form-control" name="nama_barang" id="nama_barang">
          <option value="">Semua</option>
          <?php foreach ($form_barang as $k): ?>
              <option value="<?php echo $k->kd_barang; ?>"><?php echo $k->kd_barang.' - '.$k->nama_barang; ?></option>
          <?php endforeach ?>
      </select>
    </div>

    <div class="col">
    <LABEL>Tanggal   </LABEL>
      <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="" value="" >
    </div>  
</div>
            </div>
            <div class="card-footer">
            <div class="pull-center">
    <button class="btn btn-primary" id="btn-filter" name="btn-filter">Search</button>
     <button class="btn btn-info" id="btn-reset">Reset</button>
     </div>
</div>
</form>
        </div>
<br>
<div class="card mb-12">
	<div class="card-header">
                <i class="fa fa-file"></i> Penjualan
             </div>
     <div class="card-body">
     	  <div class="table-responsive">
                    <table class="table table-condensed" id="myTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                        <th>NO</th>
                        <th>Kode Transaksi</th>
                            <th>Kode Customer</th>
                            <th>Nama Customer</th>
                            <th>Kode barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah Beli</th>
                            <th>Subtotal</th>
                            <th>Tanggal</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                        <th>NO</th>
                      <th>Kode Transaksi</th>
                            <th>Kode Customer</th>
                            <th>Nama Customer</th>
                            <th>Kode barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah Beli</th>
                            <th>Subtotal</th>
                            <th>Tanggal</th>
                        </tr>
                        </tfoot>
                        <tbody>
                       
                        </tbody>
                    </table>
                </div>
     </div>
</div>
<?php $this->load->view('_foot'); ?>
<script type="text/javascript">

var table;
$(document).ready(function() {
$('#nama_barang').select2();

    //datatables
    table = $('#myTable').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('Penjualan/ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
                data.nama_barang = $('#nama_barang').val();
                data.tanggal = $('#tanggal').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });

    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table
    });

});
$('#tanggal').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                })
</script>