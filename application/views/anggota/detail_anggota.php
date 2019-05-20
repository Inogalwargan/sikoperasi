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
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        </div>
      <?php endif; ?>
      <!-- Alert -->

      <section class="content-header">
        <h1>
          Kelola
          <small>Data Anggota Koperasi</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-child"></i> Anggota</a></li>
          <li><a href="<?php echo base_url('Anggota_controller') ?>">Lihat Data Anggota</a></li>
        </ol>
      </section>


      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive">
               <div class="box-header">
                <h3 class="label label-primary" style="">--- Data Anggota ---</h3>
              </div>
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="background-color: #7f8c8d">NIK</th>
                      <th style="background-color: #7f8c8d">Nama</th>
                      <th style="background-color: #7f8c8d">Jenis Kelamin</th>
                      <th style="background-color: #7f8c8d">Alamat</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                      <tr>
                        <td style="background-color: #bdc3c7;"><?php cetak ($anggota->nia)  ?></td>
                        <td style="background-color: #bdc3c7;"><?php cetak($anggota->nama ) ?></td>
                        <td style="background-color: #bdc3c7;"><?php cetak($anggota->jenis_kelamin)  ?></td>
                        <td style="background-color: #bdc3c7;"><?php cetak($anggota->alamat)  ?></td>
                      </tr>
                   
                  </tbody>
                </table>
              </div>
            <div class="box-body table-responsive">
              <div class="box-header">
                <h3 class="label label-primary" style="font-size: 12px, margin-right: -20px !important;">--- Detail Anak ---</h3>
              </div>
                 <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Anak</th>
                      <th>Jenjang Sekolah</th>
                      <th>Nama Sekolah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;?>
                    <?php foreach ($anak as $nilai): ?>
                      <tr>
                        <td><?php cetak($no++) ?></td>
                        <td><?php cetak($nilai->nama_anak ) ?></td>
                        <td><?php cetak($nilai->jenjang_sekolah)  ?></td>
                        <td><?php cetak($nilai->nama_sekolah)  ?></td>
                        <td>
                          <a class="btn btn-ref" href="<?php echo site_url('Anak_controller/edit/'.$nilai->id_anak) ?>"><i class="fa fa-fw fa-edit"></i>Edit</a>
                          <a href="#!" onclick="deleteConfirm('<?php echo site_url('Anak_controller/delete/'.$nilai->id_anak) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-trash"></i>Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  
                </table>
              </div>


              <div class="box-body table-responsive">
              <div class="box-header">
                <h3 class="label label-primary" style="font-size: 12px, margin-right: -20px !important;">--- Detail Pasangan ---</h3>
              </div>
                 <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Anak</th>
                      <th>Jenjang Sekolah</th>
                      <th>Nama Sekolah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;?>
                    <?php foreach ($pasangan as $nilai): ?>
                      <tr>
                        <td><?php cetak($no++) ?></td>
                        <td><?php cetak($nilai->nama_pasangan) ?></td>
                        <td><?php cetak($nilai->pekerjaan)  ?></td>
                        <td><?php cetak($nilai->alamat)  ?></td>
                        <td>
                          <a class="btn btn-ref" href="<?php echo site_url('Pasangan_controller/edit/'.$nilai->id_pasangan) ?>"><i class="fa fa-fw fa-edit"></i>Edit</a>
                          <a href="#!" onclick="deleteConfirm('<?php echo site_url('Pasangan_controller/delete/'.$nilai->id_pasangan) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-trash"></i>Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  
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

 <!-- Logout Delete Confirmation-->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>
<!-- ./wrapper -->
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
<!-- page script -->
<script>
  function deleteConfirm(url){
    $('#btn-delete').attr('href', url);
    $('#deleteModal').modal();
  }
</script>
</body>
</html>
