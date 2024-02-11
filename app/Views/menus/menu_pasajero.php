  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?=base_url('/');?>" target='_blank' class="brand-link">
          <img src="<?=base_url('/public/dist/img/agility.ico');?>" alt="Lidertur Logo" class="brand-image  ">
          <span class="brand-text font-weight-light">Agility v0.1</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="<?php echo base_url('/public/dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2"
                      alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block"><?php echo session('user');?></a>
                  <a href="#" class="d-block"><?php echo session('type');?></a>
              </div>
          </div>



          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Viajes Tripulación
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="<?=site_url('admin/SolicitudesTripulacion/'.session('id_user'));?>" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Solicitud Tripulación</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?= site_url('admin/HistoricoTripulacion')?>" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Historico Tripulación</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Viajes Voucher
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="<?=site_url('admin/SolicitudesVoucher/'.session('id_user'));?>" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Solicitud Voucher</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?= site_url('admin/HistoricoVoucher')?>" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Historico Voucher</p>
                              </a>
                          </li>
                          <!--li class="nav-item">
                              <a href="<?= site_url(session('group_name').'/HistoricoAsignado')?>" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Historico Asignado</p>
                              </a>
                          </li-->
                      </ul>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>