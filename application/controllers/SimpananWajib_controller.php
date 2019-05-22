<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* author inogalwargan
*/

class SimpananWajib_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Anggota_model");
        $this->load->model("SimpananWajib_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["anggota"] = $this->Anggota_model->getAll();
        $this->load->view("simpanan_wajib/lihat_simpanan_wajib", $data);
    }

    public function detail($id){
        // $data['anggota'] = $this->SimpananWajib_model->detail_simpanan_pokokall();
        $data['simpanan_wajib'] = $this->SimpananWajib_model->detail_simpanan_wajib($id);
        $data['tot'] = $this->SimpananWajib_model->total_simpanan_wajib($id);
        $this->load->view("simpanan_wajib/detail_simpanan_wajib", $data);
    }

    public function add($id)
    {   
        $anggota = $this->Anggota_model;
        $simpanan_wajib = $this->SimpananWajib_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpanan_wajib->rules());

        if ($validation->run()) {
            $simpanan_wajib->save();
            $this->session->set_flashdata('success', 'Tambah Simpanan Sebesar Rp. '.$simpanan_wajib->jumlah.' Berhasil Disimpan');
            redirect('SimpananWajib_controller/index');
        }
        $data['anggota'] = $this->Anggota_model->getById($id);
        $this->load->view("simpanan_wajib/tambah_simpanan_wajib", $data);
    }

    public function edit($id){
        $anggota = $this->Anggota_model; //object model
    	$simpanan_wajib = $this->SimpananWajib_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($simpanan_wajib->rules()); //terapkan rules di Anggota_model.php

        if ($validation->run()) { //lakukan validasi form
            $simpanan_wajib->update($id); // update data
            $this->session->set_flashdata('success', 'Data Simpanan Wajib Sebesar Rp. '.$simpanan_wajib->getById($id)->jumlah.' Berhasil Diubah');
            redirect($_SERVER ['HTTP_REFERER']);

        }
        $data['simpanan_wajib'] = $this->SimpananWajib_model->getById($id);
        $this->load->view('simpanan_wajib/edit_simpanan_wajib', $data);
    }

    public function hide($id){
    	$this->Anggota_model->update($id);
    	$this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
    	redirect('Anggota_controller/index');
    }

    public function delete($id){
	    $this->SimpananWajib_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Simpanan Wajib Berhasil Dihapus');
	    redirect($_SERVER['HTTP_REFERER']);
	}
}
