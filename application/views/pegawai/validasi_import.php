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
				Import
				<small>Data Pegawai</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Pegawai</a></li>
				<li><a href="<?php echo base_url('Pegawai_controller')?>">Lihat Data Pegawai</a></li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<form method="post" action="<?php echo base_url("Pegawai_controller/form"); ?>"
								  enctype="multipart/form-data">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="file" name="file">
									</div>
								</div>
								<div class="form-group">
									<input class="btn btn-success" type="submit" name="preview" value="Preview">
									<a class="btn btn-carot" href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a>
								</div>
							</form>
						</div>
						<!-- /.box-header -->
						<div class="box-body table-responsive">
							<?php
							if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
								if (isset($upload_error)) { // Jika proses upload gagal
									echo "<div style='color: red;'>" . $upload_error . "</div>"; // Muncul pesan error upload
									die; // stop skrip
								}

								// Buat sebuah tag form untuk proses import data ke database
								echo "<form method='post' action='" . base_url("Pegawai_controller/import") . "'>";
								echo "<div class=\"box-body table-responsive\">";
								echo "<table id='example1' class='table table-bordered table-hover'>
									<tr>
									  <th colspan='5'>Preview Data</th>
									</tr>
									<tr>
									  <th>NIK</th>
									  <th>Nama</th>
									  <th>Alamat</th>
									  <th>No HP</th>
									</tr>";

								$numrow = 1;
								$kosong = 0;
								// Lakukan perulangan dari data yang ada di excel
								// $sheet adalah variabel yang dikirim dari controller
								foreach ($sheet as $row) {
									// Ambil data pada excel sesuai Kolom
									$nik = $row['A']; // Ambil data NIS
									$nama = $row['B']; // Ambil data nama
									$alamat = $row['C']; // Ambil data jenis kelamin
									$nohp = $row['D']; // Ambil data alamat

									// Cek jika semua data tidak diisi
									if (empty($no) && empty($nik) && empty($nama) && empty($jenis_kelamin) && empty($alamat))
										continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

									// Cek $numrow apakah lebih dari 1
									// Artinya karena baris pertama adalah nama-nama kolom
									// Jadi dilewat saja, tidak usah diimport
									if ($numrow > 1) {
										// Validasi apakah semua data telah diisi
										$nis_td = (!empty($nik)) ? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
										$nama_td = (!empty($nama)) ? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
										$alamat_td = (!empty($alamat)) ? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
										$nohp_td = (!empty($nohp)) ? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah

										// Jika salah satu data ada yang kosong
										if (empty($nik) or empty($nama) or empty($alamat) or empty($nohp)) {
											$kosong++; // Tambah 1 variabel $kosong
										}

										echo "<tr>";
										echo "<td" . $nis_td . ">" . $nik . "</td>";
										echo "<td" . $nama_td . ">" . $nama . "</td>";
										echo "<td" . $alamat_td . ">" . $alamat . "</td>";
										echo "<td" . $nohp_td . ">" . $nohp . "</td>";
										echo "</tr>";
									}

									$numrow++; // Tambah 1 setiap kali looping
								}

								echo "</table>";
								echo "</div>";

								// Cek apakah variabel kosong lebih dari 0
								// Jika lebih dari 0, berarti ada data yang masih kosong
								if ($kosong > 0) {
								} else { // Jika semua data sudah diisi
									// Buat sebuah tombol untuk mengimport data ke database
									echo
									" <div class=\"box-footer\">
                					<button class=\"btn btn-success\" name=\"submit\" type=\"submit\"><i class=\"fa fa-fw fa-plus\"></i>Simpan</button>
                					<a href='" . base_url("Pegawai_controller") . "' class=\"btn btn-danger\" type=\"reset\"><i style=\"margin-left: -3px;\" class=\"fa fa-fw fa-times\"></i>Batal</a>
              						</div>";
								}

								echo "</form>";
							}
							?>
							<div class="box-body">
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
									NB : Pastikan semua coloumn yang ada di file .xlsx terisi. Apabila masih terdapat kolom
									yang kosong maka tombol Import Tidak akan muncul.  kolom yang masih kosong ditunjukan
									dengan kolom berwarna merah.
								</div>
							</div>
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
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
	function deleteConfirm(url) {
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}
</script>
</body>
</html>
