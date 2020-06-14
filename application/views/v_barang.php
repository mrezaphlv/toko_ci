<?php $this->load->view('_head'); ?>
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item active">Data Barang</li>
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
                <i class="fa fa-file"></i> Barang
                <div class="pull-right"><button data-toggle="modal" data-target="#modaladd" class="btn btn-success btn-sm">Add New</button></div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed" id="myTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                        <th>NO</th>
                        <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Jumlah Barang</th>
                            <th>Tanggal Pembelian</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                        <th>NO</th>
                        <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Jumlah Barang</th>
                            <th>Jumlah Pembelian</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody id="data_list">
                        <?php
                            //foreach ($result as $key => $res) {
                        ?>
                     <!--   <tr>
                            <td><?php echo $res->nama_barang;?></td>
                            <td><?php echo $res->deskripsi;?></td>
                            <td><?php echo $res->harga_beli;?></td>
                            <td><?php echo $res->harga_jual;?></td>
                            <td><?php echo $res->jumlah_barang;?></td>
                            <td><?php echo $res->tanggal_pembelian;?></td>
                            <td><div class="btn-group"><a href="<?php echo $res->id_barang;?>" class="btn btn-primary btn-sm">Edit</a> <a href="controllers/deleteBarang.php?id=<?php echo $res->id_barang;?>" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete?')">Delete</a></div></td>
                        </tr>-->
                        <?php //} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<!-- modal edit try-->

    <div class="modal fade" id="edt" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form class="" method="post" action="<?php echo base_url('Barang/edit_exe'); ?>" enctype="multipart/form-data">
      <input name="ed_id" value="" type="hidden"></input>

           <div class="form-group row">
    <label for="exampleInputEmail1" class="col-md-2 col-form-label">Nama Barang</label>
    <div class="col-md-9">
    <input type="text" name="ed_nama_barang" class="form-control" id="ed_nama_barang" value="" placeholder=""></div>
  </div>
  <div class="form-group row">
      <label for="exampleInputLastName" class="col-md-2 col-form-label">Deskripsi</label>
       <div class="col-md-9">
     <textarea class="form-control" name="ed_deskripsi" id="ed_deskripsi" placeholder="Deskripsi"></textarea></div>
         </div>
  <div class="form-group row">
    <label for="exampleInputPassword1" class="col-md-2 col-form-label">Harga Beli</label>
    <div class="col-md-9">
    <input type="text" name="ed_harga_beli" class="form-control" value="" id="ed_harga_beli" ></div>
  </div>
   <div class="form-group row">
    <label for="exampleInputPassword1" class="col-md-2 col-form-label">Harga Jual</label><div class="col-md-9">
    <input type="text" name="ed_harga_jual" class="form-control" id="ed_harga_jual" value="" placeholder="">
    </div>
  </div>
   <div class="form-group row">
    <label for="exampleInputPassword1" class="col-md-2 col-form-label">Jumlah barang</label>
    <div class="col-md-9">
    <input type="number" name="ed_jumlah_barang" class="form-control" value="" id="ed_jumlah_barang" placeholder=""></div>
  </div>
  <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Tangal Pembelian</label><div class="col-md-9">
                                        <input class="form-control" name="ed_tanggal_pembelian" id="ed_tanggal_pembelian" type="date" placeholder="DD/MM/YYYY"></div>
                                    </div>
  <button type="submit" class="btn btn-default">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--end modal edit try-->
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
                                  <label for="exampleInputName" class="col-md-2 col-form-label">Kode Barang</label>
                                  <div class="col-md-9">
                                      <input class="form-control" name="kd_barang" id="kd_barang" type="text" placeholder="Nama Barang"></div>
                                  </div>
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
            "url": "<?php echo base_url('Barang/ajax_list')?>",
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

$('#data_list').on('click','.item_edit',function(){
            var id=$(this).attr('data');
               $('#edt').modal('show');
               $('[name="ed_id"]').val(id);
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('Barang/get_barang')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(nama_barang,deskripsi,harga_beli){
                        //$('#edt').modal('show');
                        $('[name="ed_nama_barang"]').val(data.nama_barang);
                        $('[name="ed_deskripsi"]').val(data.deskripsi);
                         $('#ed_harga_beli').autoNumeric('init',{
        aSep: '.', aDec: ',', vMax: '999999999999',  mDec: '0' });
                        $('[name="ed_harga_beli"]').val(data.harga_beli);
                        $('[name="ed_harga_jual"]').val(data.harga_jual).autoNumeric('init',{
        aSep: '.', aDec: ',', vMax: '999999999999',  mDec: '0' });
                        $('[name="ed_jumlah_barang"]').val(data.jumlah_barang);
                         $('[name="ed_tanggal_pembelian"]').val(data.tanggal_pembelian);

                    });
                }
            });
            return false;
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
