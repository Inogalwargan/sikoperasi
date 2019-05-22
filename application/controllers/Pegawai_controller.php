<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_controller extends MY_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Pegawai_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["pegawai"] = $this->Pegawai_model->getAll();
        $this->load->view("pegawai/lihat_pegawai", $data);
    }

    public function add()
    {
        $pegawai = $this->Pegawai_model;
        $validation = $this->form_validation;
        $validation->set_rules($pegawai->rules());

        if ($validation->run()) {
            $pegawai->save();
            $this->session->set_flashdata('success', 'Tambah Pegawai '.$pegawai->nama.' Berhasil Disimpan');
            redirect('Pegawai_controller/index');
        }

        $this->load->view("pegawai/tambah_pegawai");
    }

    public function edit($id){

    	$pegawai = $this->Pegawai_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($pegawai->rules()); //terapkan rules di Pegawai_model.php

        if ($validation->run()) { //lakukan validasi form
            $pegawai->update($id); // update data
            $this->session->set_flashdata('success', 'Data Pegawai '.$pegawai->getById($id)->nama.' Berhasil Diubah');
            redirect('Pegawai_controller/index');
        }

        $data['pegawai'] = $this->Pegawai_model->getById($id);
        $this->load->view('pegawai/edit_pegawai', $data);
    }

    public function delete($id){
	    $this->Pegawai_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
	    redirect('Pegawai_controller/index');
	}

	public function form(){
		$data = array(); // Buat variabel $data sebagai array

		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->Pegawai_model->upload_file($this->filename);

			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';

				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet;
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}

		$this->load->view('pegawai/validasi_import', $data);
	}

	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';

		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();

		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					'id_pegawai'=> uniqid(),
					'nik'=>$row['A'], // Insert data nis dari kolom A di excel
					'nama'=>$row['B'], // Insert data nama dari kolom B di excel
					'alamat'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
					'nohp'=>$row['D'], // Insert data alamat dari kolom D di excel
				));
			}

			$numrow++; // Tambah 1 setiap kali looping
		}
		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->Pegawai_model->insert_multiple($data);

		redirect("Pegawai_controller"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

	public function validasi_import(){
		$this->load->view('pegawai/validasi_import');
	}
}
