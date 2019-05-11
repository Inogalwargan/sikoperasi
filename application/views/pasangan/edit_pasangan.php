<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
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


    <!-- Alert -->
      <?php if ($this->session->flashdata('success')): ?>
        <div class="box-body">
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i>Alert!</h4>
            <?php echo $this->session->flashdata('success'); ?><br>
            <a href="<?php echo base_url('Anggota_controller/detail/'.$pasangan->id_anggota) ?>">Saya Mengerti</a>
          </div>
        </div>
      <?php endif; ?>
      <!-- Alert -->

    <section class="content-header">
      <h1>
        Kelola
        <small>Data Anak</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-fw fa-child"></i> Anggota</a></li>
        <li><a href="<?php echo base_url('Anggota_controller/index') ?>">Lihat Data Anggota</a></li>
        <li><a href="<?php echo base_url('Anggota_controller/detail/'.$pasangan->id_anggota) ?>">Lihat Data Detail</a></li>
        <li><a href="">Edit Data Anggota</a></li>
      </ol>
    </section>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pengisian Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url('Pasangan_controller/edit/'.$pasangan->id_pasangan) ?>" method="post">
              <input type="hidden" name="id_anggota" value="<?php echo $pasangan->id_anggota?>" />

              <div class="box-body">
                <div class="form-group">
                  <label>Nama Pasangan</label>
                  <input name="nama_pasangan" class="form-control <?php echo form_error('nama_pasangan') ? 'is-invalid':'' ?>" placeholder="Masukan Nama Pasangan" value="<?php echo $pasangan->nama_pasangan?>" type="text"/>
                  <div class="invalid-feedback">
                    <?php echo form_error('nama_pasangan') ?>
                  </div>
                </div>

                <div class="form-group">
                  <label>Pekerjaan</label>
                  <input name="pekerjaan" class="form-control <?php echo form_error('pekerjaan') ? 'is-invalid':'' ?>" placeholder="Masukan Pekerjaan" value="<?php echo $pasangan->pekerjaan?>" type="text"/>
                  <div class="invalid-feedback">
                    <?php echo form_error('pekerjaan')?>
                  </div>
                </div>

                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control <?php echo form_error('pekerjaan') ? 'is-invalid':'' ?>" placeholder="Masukan Alamat" type="text"><?php echo $pasangan->alamat?></textarea>
                  <div class="invalid-feedback">
                    <?php echo form_error('pekerjaan')?>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                <button class="btn btn-danger" type="reset"><i style="margin-left: -3px;" class="fa fa-fw fa-times"></i>Batal</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
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
