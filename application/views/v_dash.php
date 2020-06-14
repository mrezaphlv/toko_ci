<?php $this->load->view('_head'); ?>
 
<ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Dashboard</li>
          </ol>
          <div class="row">
          <div class="col-lg-12">
              <div class="card mb-3">
              
              <div class="list-group list-group-flush ">
                  <div class="list-group-item list-group-item-action" href="#">
                  <div class="media">
                      <div class="media-body">
                      <strong>Sistem informasi manajemen toko</strong> 
                      </div>
                  </div>
                  </div>
                 
              </div>
             
              </div>
          </div>
          </div>
          <div class="row">
          <div class="col-lg-12">
              <div class="card mb-3">
              <div class="card-header">
                  <i class="fa fa-bell-o"></i> Last Activity</div>
              <div class="list-group list-group-flush small">
                  <a class="list-group-item list-group-item-action" href="#">
                  <div class="media">
                      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                      <div class="media-body">
                      <strong><?php echo $this->session->userdata('nama');?></strong> login to system
                      <div class="text-muted smaller">Today at <?php echo $this->session->userdata('last_login');?></div>
                      </div>
                  </div>
                  </a>
                  <a class="list-group-item list-group-item-action" href="#">View all activity...</a>
              </div>
              <div class="card-footer small text-muted">Updated now at 11:59 PM</div>
              </div>
          </div>
          </div>
      

<?php $this->load->view('_foot'); ?>