<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* author inogalwargan
*/

class SimpananPokok_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Anggota_model");
        $this->load->model("SimpananPokok_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["anggota"] = $this->Anggota_model->getAll();
        $this->load->view("simpanan_pokok/lihat_simpanan_pokok", $data);
    }

    public function detail($id){
        // $data['anggota'] = $this->SimpananPokok_model->detail_simpanan_pokokall();
        $data['tot'] = $this->SimpananPokok_model->total_simpanan_pokok($id);
        $data['simpanan_pokok'] = $this->SimpananPokok_model->detail_simpanan_pokok($id);
        $this->load->view("simpanan_pokok/detail_simpanan_pokok", $data);
    }

    public function add($id)
    {   
        $anggota = $this->Anggota_model;
        $simpanan_pokok = $this->SimpananPokok_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpanan_pokok->rules());

        if ($validation->run()) {
            $simpanan_pokok->save();
            $this->session->set_flashdata('success', 'Tambah Simpanan Sebesar Rp. '.$simpanan_pokok->jumlah.' Berhasil Disimpan');
            redirect('SimpananPokok_controller/index');
        }
        $data['anggota'] = $this->Anggota_model->getById($id);
        $this->load->view("simpanan_pokok/tambah_simpanan_pokok", $data);
    }

    public function edit($id){
        $anggota = $this->Anggota_model; //object model
    	$simpanan_pokok = $this->SimpananPokok_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($simpanan_pokok->rules()); //terapkan rules di Anggota_model.php

        if ($validation->run()) { //lakukan validasi form
            $simpanan_pokok->update($id); // update data
            $this->session->set_flashdata('success', 'Data Simpanan Pokok Sebesar Rp. '.$simpanan_pokok->getById($id)->jumlah.' Berhasil Diubah');
            redirect($_SERVER ['HTTP_REFERER']);

        }
        $data['simpanan_pokok'] = $this->SimpananPokok_model->getById($id);
        $this->load->view('simpanan_pokok/edit_simpanan_pokok', $data);
    }

    public function hide($id){
    	$this->Anggota_model->update($id);
    	$this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
    	redirect('Anggota_controller/index');
    }

    public function delete($id){
	    $this->SimpananPokok_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Simpanan Pokok Berhasil Dihapus');
	    redirect($_SERVER['HTTP_REFERER']);
	}
}
