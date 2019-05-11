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

      <section class="content-header">
        <h1>
          Kelola
          <small>Data Pegawai</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Anggota</a></li>
          <li><a href="<?php echo base_url('Anggota_controller/index') ?>">Lihat Data Anggota</a></li>
          <li><a href="<?php echo base_url('Anak_controller/form/'.$anggota->id_anggota) ?>">Tambah Data Anak</a></li>
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
              <div class="box-header with-border">
                  <button type="button" class="btn btn-success" id="btn-tambah-form">Tambah Data Form</button>
                  <button type="button" class="btn btn-danger" id="btn-reset-form">Reset Form</button><br><br>
                </div>
              <div class="box-header with-border">
                <b class="label label-success">Input Data Pasangan Ke 1</b>
              </div>

              <form role="form" action="<?php echo base_url('Pasangan_controller/add/'.$anggota->id_anggota) ?>" method="post">

                <div class="box-body">

                  <div class="form-group">
                    <label>Nama Anggota</label>
                    <select class="form-control  <?php echo form_error('id_anggota[]') ? 'is-invalid':'' ?>" name="id_anggota[]">
                      <option value="<?php echo $anggota->id_anggota ?>"><?php echo $anggota->nama ?></option>
                    </select>
                    <div class="invalid-feedback">
                      <?php echo form_error('id_anggota[]') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Nama Pasangan </label>
                    <input name="nama_pasangan[]" required="" class="form-control <?php echo form_error('nama_pasangan[]') ? 'is-invalid':'' ?>" placeholder="Masukan Nama" type="text">
                    <div class="invalid-feedback">
                      <?php echo form_error('nama_pasangan[]') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Pekerjaan Pasangan </label>
                    <input name="pekerjaan[]" required="" class="form-control <?php echo form_error('pekerjaan[]') ? 'is-invalid':'' ?>" placeholder="Masukan Nama" type="text">
                    <div class="invalid-feedback">
                      <?php echo form_error('pekerjaan[]') ?>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <label>Alamat Pasangan</label>
                    <textarea required="" class="form-control" name="alamat[]" placeholder="Masukan Alamat Pasangan"></textarea>
                    <div class="invalid-feedback">
                      <?php echo form_error('alamat[]')?>
                    </div>
                  </div>
                  <div class="box-body" id="insert-form"></div>
                </div>


                <!-- /.box-body -->
                

                <div class="box-footer">
                  <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                  <button class="btn btn-danger" type="reset"><i style="margin-left: -3px;" class="fa fa-fw fa-times"></i>Batal</button>
                </div>
              </form>
              <input type="hidden" id="jumlah-form" value="1">
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

 <!-- page script -->
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
<script>
  $(document).ready(function(){ // Ketika halaman sudah diload dan siap
    $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
      var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
      var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya
      
      // Kita akan menambahkan form dengan menggunakan append
      // pada sebuah tag div yg kita beri id insert-form
      $("#insert-form").append("<b class='label label-success'>Input Data Pasangan Ke " + nextform + " :</b><br><br>" +
        // "<table>" +
        // "<tr>" +
        // "<td>NIS</td>" +
        // "<td><input class=" + "form-control" +" type='text' name='nis[]' required></td>" +
        // "</tr>" +
        // "<tr>" +
        // "<td>Nama</td>" +
        // "<td><input type='text' name='nama[]' required></td>" +
        // "</tr>" +
        // "<tr>" +
        // "<td>Telepon</td>" +
        // "<td><input type='text' name='telp[]' required></td>" +
        // "</tr>" +
        // "<tr>" +
        // "<td>Alamat</td>" +
        // "<td><textarea name='alamat[]' required></textarea></td>" +
        // "</tr>" +
        // "</table>" +
        // "<br><br>");

        "<div class='form-group'><label>Nama Anggota</label><select class='form-control'"+  "<?php echo form_error('id_anggota[]') ? 'is-invalid':'' ?>" + "name='id_anggota[]'>" + "<option value="+ '<?php echo $anggota->id_anggota ?>' + ">" + "<?php echo $anggota->nama ?>" + "</option> </select>" + "<div class='invalid-feedback'>" + "<?php echo form_error('id_anggota[]') ?>" + "</div></div>"+ 

         "<div class='form-group'><label>Nama Pasangan</label><input name='nama_pasangan[]' required=''  class='form-control'"+ "<?php echo form_error('nama_pasangan[]') ? 'is-invalid':'' ?>" +"placeholder=Masukan Nama Sekolah' type='text'/>" + "</div>" + "<div class='invalid-feedback>" + "<?php echo form_error('nama_pasangan[]')?>" + "</div>"+

        "<div class='form-group'><label>Pekerjaan Pasangan</label><input name='pekerjaan[]' required=''  class='form-control'"+ "<?php echo form_error('pekerjaan[]') ? 'is-invalid':'' ?>" +"placeholder=Masukan Nama Sekolah' type='text'/>" + "</div>" + "<div class='invalid-feedback>" + "<?php echo form_error('pekerjaan[]')?>" + "</div>"+

       "<div class='form-group'><br><label>Alamat </label><textarea class='form-control' placeholder='Masukan Alamat' name='alamat[]'></textarea><div class='invalid-feedback'>" +"<?php echo form_error('alamat[]') ?>" + "</div></div><br>");  
      
      $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
    });
    
    // Buat fungsi untuk mereset form ke semula
    $("#btn-reset-form").click(function(){
      $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
      $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
    });
  });
  </script>
</body>
</html>
