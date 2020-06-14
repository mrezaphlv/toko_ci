<?php $this->load->view('_head'); ?>
 <!-- Breadcrumbs-->
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Data Member</li>
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
                <i class="fa fa-user"></i>Member
                <div class="pull-right"><button data-toggle="modal" data-target="#modaladd" class="btn btn-success btn-sm">Add New</button></div>
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed" id="myTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                        <th>NO</th>
                        <th>Kode Member</th>
                        <th>Nama Member</th>
                        <th>Email</th>
                           <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                        <th>NO</th>
                             <th>Kode Member</th>
                        <th>Nama Member</th>
                        <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody id="data_list">
                        <?php
                            //foreach ($result as $key => $res) {
                        ?>
                     
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

        <form class="" action="<?php echo base_url('Users/edit_exe'); ?>" id="addUserForm" method="post">
        <input id="ed_id" name="ed_id" type="hidden"></input>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                
                                    <div class="form-group row">
                                    <label for="exampleInputName" class="col-md-2 col-form-label">Nama</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="<?php echo set_value('ed_name'); ?>" name="ed_name" id="ed_name" type="text" placeholder=" "></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Email</label>
                                       <div class="col-md-9"> 
                                        <input class="form-control" name="ed_email" id="ed_email" placeholder="" value="<?php echo set_value('ed_email'); ?>"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Username</label>
                                        <div class="col-md-10">
                                        <input class="form-control" name="ed_username" id="ed_username" type="text" placeholder="" value="<?php echo set_value('ed_username'); ?>"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Password</label>
                                        <div class="col-md-10">
                                        <input class="form-control" name="ed_password" id="ed_password" type="password" placeholder=""></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Password Confirm</label>
                                        <div class="col-md-10">
                                        <input class="form-control" name="ed_passconf" id="ed_passconf" type="password" placeholder=""></div>
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
  
<!--end modal edit try-->
  <!--MODAL HAPUS-->
        <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                     <div class="modal-header">
        <h5 class="modal-title">Hapus Data Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                          
                            <input type="hidden" name="kode" id="textkode" value="">
                            <div class=""><strong><p>Apakah Anda yakin mau menghapus data ini?</p></strong></div>
                                        
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           
                    <div class="alert alert-warning" id="error-msg" style="display:none;">
                    </div>
                    <div class="alert alert-success" id="success-msg" style="display:none;">
                    </div>
                    <form class="" action="<?php echo base_url('Member/add'); ?>" id="addUserForm" method="post">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="exampleInputName" class="col-md-2 col-form-label">Kode Member</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="<?php echo set_value('kode_m'); ?>" name="kode_m" id="kode_m" type="text" placeholder=" "></div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="exampleInputName" class="col-md-2 col-form-label">Nama</label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="<?php echo set_value('nama_m'); ?>" name="nama_m" id="nama_m" type="text" placeholder=" "></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputLastName" class="col-md-2 col-form-label">Email</label>
                                       <div class="col-md-9"> 
                                        <input class="form-control" name="email_m" id="email_m" value="<?php echo set_value('email_m'); ?>" placeholder=""></div>
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
            "url": "<?php echo base_url('Member/ajax_list')?>",
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
                url  : "<?php echo base_url('Member/get_users')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(){
                        //$('#edt').modal('show');
                        $('[name="ed_name"]').val(data.name);
                        $('[name="ed_email"]').val(data.email);
                        $('[name="ed_username"]').val(data.username);

                    });
                }
            });
            return false;
        });

         $('#btn_hapus').on('click',function(){
            var kode=$('#textkode').val();
            window.location.href="<?php echo base_url(); ?>Member/delete/"+kode;
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