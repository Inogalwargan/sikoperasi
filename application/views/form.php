<html>
<head>
	<title>Form Import</title>

	<!-- Load File jquery.min.js yang ada difolder js -->
	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>

	<script>
		$(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
	</script>
</head>
<body>
<h3>Form Import</h3>
<hr>

<a href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a>
<br>
<br>

<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
<form method="post" action="<?php echo base_url("Pegawai_controller/form"); ?>" enctype="multipart/form-data">
	<!--
    -- Buat sebuah input type file
    -- class pull-left berfungsi agar file input berada di sebelah kiri
    -->
	<input type="file" name="file">

	<!--
    -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
    -->
	<input type="submit" name="preview" value="Preview">
</form>

<?php
if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
	if(isset($upload_error)){ // Jika proses upload gagal
		echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
		die; // stop skrip
	}

	// Buat sebuah tag form untuk proses import data ke database
	echo "<form method='post' action='".base_url("Pegawai_controller/import")."'>";

	// Buat sebuah div untuk alert validasi kosong
	echo "<div style='color: red;' id='kosong'>
		Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
		</div>";




	echo "<table border='1' cellpadding='8'>
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
	foreach($sheet as $row){
		// Ambil data pada excel sesuai Kolom
		$nik = $row['A']; // Ambil data NIS
		$nama = $row['B']; // Ambil data nama
		$alamat = $row['C']; // Ambil data jenis kelamin
		$nohp = $row['D']; // Ambil data alamat

		// Cek jika semua data tidak diisi
		if(empty($nik) && empty($nama) && empty($jenis_kelamin) && empty($alamat))
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
			// Validasi apakah semua data telah diisi
			$nis_td = ( ! empty($nik))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
			$nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
			$alamat_td = ( ! empty($alamat))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
			$nohp_td = ( ! empty($nohp))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah

			// Jika salah satu data ada yang kosong
			if(empty($nik) or empty($nama) or empty($alamat) or empty($nohp)){
				$kosong++; // Tambah 1 variabel $kosong
			}

			echo "<tr>";
			echo "<td".$nis_td.">".$nik."</td>";
			echo "<td".$nama_td.">".$nama."</td>";
			echo "<td".$alamat_td.">".$alamat."</td>";
			echo "<td".$nohp_td.">".$nohp."</td>";
			echo "</tr>";
		}

		$numrow++; // Tambah 1 setiap kali looping
	}

	echo "</table>";

	// Cek apakah variabel kosong lebih dari 0
	// Jika lebih dari 0, berarti ada data yang masih kosong
	if($kosong > 0){
		?>
		<script>
			$(document).ready(function(){
				// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
				$("#jumlah_kosong").html('<?php echo $kosong; ?>');

				$("#kosong").show(); // Munculkan alert validasi kosong
			});
		</script>
		<?php
	}else{ // Jika semua data sudah diisi
		echo "<hr>";
		// Buat sebuah tombol untuk mengimport data ke database
		echo "<button type='submit' name='import'>Import</button>";
		echo "<button><a href='".base_url("Pegawai_controller")."'>Cancel</a></button>";
	}

	echo "</form>";
}
?>
</body>
</html>
