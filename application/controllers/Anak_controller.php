<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* author inogalwargan
*/

class Anak_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Anak_model");
        $this->load->model("Anggota_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["anak"] = $this->Anak_model->getAll();
        $this->load->view("anggota/lihat_anggota", $data);
    }

    // public function add($id)
    // {
    //     $anak = $this->Anak_model;
    //     $validation = $this->form_validation;
    //     $validation->set_rules($anak->rules());

    //     if ($validation->run()) {
    //         $anak->save($id);
    //         $this->session->set_flashdata('success', 'Tambah Anak '.$anak->nama_anak.' Berhasil Disimpan');
    //         redirect('Anggota_controller/index');
    //     }
    //     $data['anggota'] = $this->Anggota_model->getById($id);
    //     $this->load->view("anak/tambah_anak", $data);
    // }

    public function form_add($id){
        $data['anggota'] = $this->Anggota_model->getById($id);
            $this->load->view('anak/tambah_anak', $data); // Load view form.php
        }

    public function add($id){
    $anak = $this->Anak_model;
    $id_anggota = $_POST['id_anggota']; // Ambil data nama dan masukkan ke variabel nama
    $nama_anak = $_POST['nama_anak']; // Ambil data telp dan masukkan ke variabel telp
    $jenjang_sekolah = $_POST['jenjang_sekolah']; // Ambil data alamat dan masukkan ke variabel alamat
    $nama_sekolah = $_POST['nama_sekolah'];
    $data = array();

    $index = 0; // Set index array awal dengan 0
    foreach($id_anggota as $data_anak){ // Kita buat perulangan berdasarkan nis sampai data terakhir
      array_push($data, array(
          // Ambil dan set data telepon sesuai index array dari $index
        'id_anggota'=>$data_anak,
        'nama_anak'=>$nama_anak[$index],// Ambil dan set data nama sesuai index array dari $index
        'jenjang_sekolah'=>$jenjang_sekolah[$index],
        'nama_sekolah'=>$nama_sekolah[$index],  // Ambil dan set data alamat sesuai index array dari $index
    ));

      $index++;
  }

        $sql = $this->Anak_model->save_batch($data);

        if($sql){ // Jika sukses
            $this->session->set_flashdata('success', 'Tambah Anak '.$data['nama_anak'].' Berhasil Disimpan');
            redirect('Anggota_controller/index');
        }else{ // Jika gagal
          echo "<script>alert('Data gagal disimpan');window.location = '".base_url('Anggota_controller/index')."';</script>";
        }
}

public function edit($id){

        $anak = $this->Anak_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($anak->rules()); //terapkan rules di Anggota_model.php

        if ($validation->run()) { //lakukan validasi form
            $anak->update($id); // update data
            $this->session->set_flashdata('success', 'Data Anggota '.$anak->getById($id)->nama_anak.' Berhasil Diubah');
            redirect($_SERVER['HTTP_REFERER']); //fungsinya sama kaya return redirect->back

        }
        $data['anak'] = $this->Anak_model->getById($id);
        $this->load->view('anak/edit_anak', $data);
    }

    public function hide($id){
        $this->Anggota_model->update($id);
        $this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
        redirect('Anggota_controller/index');
    }

    public function delete($id){
        $this->Anak_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Anak Berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']); //fungsinya sama kaya return redirect->back
    }
}
