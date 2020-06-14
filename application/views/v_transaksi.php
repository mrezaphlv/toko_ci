<?php $this->load->view('_head'); ?>
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Data Transaksi</li>
        </ol>
        <?php if ($this->session->flashdata('berhasil') == TRUE): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><?php echo $this->session->flashdata('berhasil');?></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif ?>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <p><?php echo validation_errors();?></p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif ?>
        <!-- Example DataTables Card-->
        <div class="card mb-12">
            <div class="card-header">
                <i class="fa fa-file"></i> Data Transaksi
                <div class="pull-right"><button id="add_new" class="btn btn-success btn-sm">Mulai Transaksi Baru</button></div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed" id="myTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                        <th>NO</th>
                        <th>Kode transaksi</th>
                        <th>Nama Customer</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Bayar</th>
                        <th>Kembali</th>
               <th>#</th>
                        </tr>
                        </thead>

                        <tbody id="data_list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<!-- modal detail try-->

    <div class="modal fade" id="edt" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <div class="">
    <p><strong>Kode Transaksi : </strong><span id="kd_trr"></span></p>
    <p><strong>nama Customer : </strong> <span id="nama_custo_d"></span> </p>
    </div>
      <table class="table table-condensed" id="detTable">
          <thead>
              <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Sub Total</th>
                  <th>Tanggal</th>
              </tr>
          </thead>
          <tbody>

          </tbody>
      </table>
      </div>
    </div>
  </div>
</div>

<!--end modal detail try-->
  <!--MODAL HAPUS-->
        <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                     <div class="modal-header">
        <h5 class="modal-title">Hapus Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                    <form class="form-horizontal">
                    <div class="modal-body">

                            <input type="hidden" name="kode" id="textkode" value="">
                            <div class=""><strong><p>Apakah Anda yakin mau menghapus barang ini?</p></strong></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--END MODAL HAPUS-->

<div class="modal fade " id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                    <div class="alert alert-warning" id="error-msg" style="display:none;">
                    </div>
                    <div class="alert alert-success" id="success-msg" style="display:none;">
                    </div>
                    <form class="" action="<?php echo base_url('Barang/add'); ?>" id="addUserForm" method="post">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">

                                    <div class="form-group row">
                                    <label for="exampleInputName" class="col-md-2 col-form-label">Nama Barang</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="nama_barang" id="nama_barang" type="text" placeholder="Nama Barang"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Deskripsi</label>
                                       <div class="col-md-9">
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi"></textarea></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Harga Beli</label>
                                        <div class="col-md-10">
                                        <input class="form-control" name="harga_beli" id="harga_beli" type="text" placeholder="Harga Beli"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Harga Jual</label>
                                        <div class="col-md-10">
                                        <input class="form-control" name="harga_jual" id="harga_jual" type="text" placeholder=""></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Jumlah Barang</label><div class="col-md-10">
                                        <input class="form-control" name="jumlah_barang" id="jumlah_barang" type="text" placeholder="Jumlah Barang"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Tangal Pembelian</label><div class="col-md-9">
                                        <input class="form-control" name="tanggal_pembelian" id="tanggal_pembelian" type="date" placeholder="DD/MM/YYYY"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Send message</button>-->
        <input type="submit" class="btn btn-primary" value="Simpan" name="submit"></input>
      </div>
                    </form>


      </div>

    </div>
  </div>
</div>
<?php $this->load->view('_foot'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#myTable').DataTable({
 "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('Transaksi/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    });
        $('#harga_beli').autoNumeric('init',{
        aSep: '.', aDec: ',', vMax: '999999999999',  mDec: '0' });
         $('#ed_harga_beli').autoNumeric('init',{
        aSep: '.', aDec: ',', vMax: '999999999999',  mDec: '0' });
        $('#harga_jual').autoNumeric('init',{
        aSep: '.', aDec: ',', vMax: '999999999999',  mDec: '0' });
        $('#data_list').on('click','#item_hapus',function(){
            var id=$(this).attr('data');
            $('#ModalHapus').modal('show');
            $('[name="kode"]').val(id);
        });
$('#add_new').on('click',function(){
window.location.href="<?php echo base_url('transaksi/add_transaksi'); ?>";
});
$('#data_list').on('click','.item_edit',function(){

            var id=$(this).attr('data');
               $('#edt').modal('show');
               $('[name="ed_id"]').val(id);
            // $.ajax({
            //     type : "GET",
            //     url  : "<?php echo base_url('transaksi/get_trBarang')?>",
            //     dataType : "JSON",
            //     data : {id:id},
            //     success: function(data){
            //         $.each(data,function(kd_trans){
            //             //$('#edt').modal('show');
            //             //$(kd_trr).val(data.kd_transs);
            //             // kd_trr.innerHTML = data.kd_transs;
            //             // namaCustoD.innerHTML = data.nama_cust
            //             kd_bar.innerHTML = data.kd_bar;
            //         });
            //     }
            // });
            // return false;
          
        });

         $('#btn_hapus').on('click',function(){
            var kode=$('#textkode').val();
            window.location.href="<?php echo base_url(); ?>Barang/delete/"+kode;
            // $.ajax({
            // type : "POST",
            // url  : "<?php echo base_url('Barang/delete')?>",
            // dataType : "JSON",
            //         data : {kode: kode},
            //         success: function(data){
            //                 $('#ModalHapus').modal('hide');
            //                 //tampil_data_barang();
            //                 document.location.href="<?php echo base_url('Barang'); ?>";
            //         }
            //     });
                return false;
            });
    });
</script>
