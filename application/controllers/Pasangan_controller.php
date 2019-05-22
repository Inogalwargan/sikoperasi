<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pasangan_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Pasangan_model");
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
            $this->load->view('pasangan/tambah_pasangan', $data); // Load view form.php
        }

    public function add($id){
    $anak = $this->Anak_model;
    $id_anggota = $_POST['id_anggota']; // Ambil data nama dan masukkan ke variabel nama
    $nama_pasangan = $_POST['nama_pasangan']; // Ambil data telp dan masukkan ke variabel telp
    $pekerjaan = $_POST['pekerjaan']; // Ambil data alamat dan masukkan ke variabel alamat
    $alamat = $_POST['alamat'];
    $data = array();
    
    $index = 0; // Set index array awal dengan 0
    foreach($id_anggota as $data_anak){ // Kita buat perulangan berdasarkan nis sampai data terakhir
      array_push($data, array(
          // Ambil dan set data telepon sesuai index array dari $index
        // Ambil dan set data nama sesuai index array dari $index
        'id_anggota'=>$data_anak,
        'nama_pasangan'=>$nama_pasangan[$index],
        'pekerjaan'=>$pekerjaan[$index], 
        'alamat'=>$alamat[$index],  // Ambil dan set data alamat sesuai index array dari $index
    ));
      
      $index++;
  }

        $sql = $this->Pasangan_model->save_batch($data);
    
        if($sql){ // Jika sukses
            $this->session->set_flashdata('success', 'Tambah Pasangan '.$data['nama_anak'].' Berhasil Disimpan'); 
            redirect('Anggota_controller/index');
        }else{ // Jika gagal
          echo "<script>alert('Data gagal disimpan');window.location = '".base_url('Anggota_controller/index')."';</script>";
        }
}

public function edit($id){

        $pasangan = $this->Pasangan_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($pasangan->rules()); //terapkan rules di Anggota_model.php

        if ($validation->run()) { //lakukan validasi form
            $pasangan->update($id); // update data
            $this->session->set_flashdata('success', 'Data Pasangan '.$pasangan->getById($id)->nama.' Berhasil Diubah');
            redirect($_SERVER ['HTTP_REFERER']);

        }
        $data['pasangan'] = $this->Pasangan_model->getById($id);
        $this->load->view('pasangan/edit_pasangan', $data);
    }

    public function hide($id){
        $this->Anggota_model->update($id);
        $this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
        redirect('Anggota_controller/index');
    }

    public function delete($id){
        $this->Pasangan_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Pasangan Berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
