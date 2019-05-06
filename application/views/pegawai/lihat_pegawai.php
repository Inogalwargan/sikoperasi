<!DOCTYPE html>
<html>
<?php $this->load->view("admin/_includes/head.php") ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->load->view("admin/_includes/header.php") ?>
  <?php $this->load->view("admin/_includes/sidebar.php") ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelola
        <small>Data Pegawai</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Pegawai</a></li>
        <li><a href="#">Lihat Data Pegawai</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="<?php echo base_url('Pegawai_controller/add') ?>" class="btn btn-tosca"><i class="fa fa-fw fa-plus"></i>Tambah</a>
              <button class="btn btn-carot"><i class="fa fa-fw fa-download"></i>Export Data</button>
              <button class="btn btn-ijo"><i class="fa fa-fw fa-upload"></i>Import Data</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No Handphone</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no = 1;?>
                  <?php foreach ($pegawai as $value): ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $value->nik ?></td>
                  <td><?php echo $value->nama ?></td>
                  <td><?php echo $value->alamat ?></td>
                  <td><?php echo $value->nohp ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No Handphone</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view("admin/_includes/footer.php") ?>
  <?php $this->load->view("admin/_includes/control_sidebar.php") ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
<!-- page script -->
</body>
</html>
