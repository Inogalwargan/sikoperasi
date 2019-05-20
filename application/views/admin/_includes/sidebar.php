<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url('assetAdmin/dist/img/user2-160x160.jpg')?> " class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Admin Koperasi</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigation</li>

        <li><a href="<?php echo base_url('') ?>"><i class="fa fa-book"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo base_url('Pegawai_controller') ?>"><i class="fa fa-fw fa-user-plus"></i> <span>Pegawai</span></a>
        <li><a href="<?php echo base_url('Anggota_controller') ?>"><i class="fa fa-fw fa-child"></i> <span>Anggota</span></a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-dollar"></i> <span>Simpanan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('SimpananPokok_controller') ?>"><i class="fa fa-circle-o"></i>Simpanan Pokok</a></li>
            <li><a href="<?php echo base_url('SimpananWajib_controller') ?>"><i class="fa fa-circle-o"></i>Simpanan Wajib</a></li>
            <li><a href="<?php echo base_url('SimpananSukarela_controller') ?>"><i class="fa fa-circle-o"></i>Simpanan Sukarela</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('Pinjaman_controller') ?>"><i class="fa fa-fw fa-money"></i> <span>Pinjaman</span></a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-dollar"></i> <span>Angsuran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Angsuran_controller') ?>"><i class="fa fa-circle-o"></i>Kelola Angsuran</a></li>
            <li><a href="<?php echo base_url('Angsuran_controller/list_anggota') ?>"><i class="fa fa-circle-o"></i>Detail Angsuran</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
