<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* author inogalwargan
*/

class Anggota_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Anggota_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["anggota"] = $this->Anggota_model->getAll();
        $this->load->view("anggota/lihat_anggota", $data);
    }

    public function detail($id){

        $anggota = $this->Anggota_model; 
        $data['anak'] = $this->Anggota_model->detail_anak($id);
        $data['pasangan'] = $this->Anggota_model->detail_pasangan($id);
        $data['anggota'] = $this->Anggota_model->getById($id);

        $this->load->view("anggota/detail_anggota", $data);
    }

    public function add()
    {
        $anggota = $this->Anggota_model;
        $validation = $this->form_validation;
        $validation->set_rules($anggota->rules());

        if ($validation->run()) {
            $anggota->save();
            $this->session->set_flashdata('success', 'Tambah Anggota '.$anggota->nama.' Berhasil Disimpan');
            redirect('Anggota_controller/index');
        }

        $this->load->view("anggota/tambah_anggota");
    }

    public function edit($id){

    	$anggota = $this->Anggota_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($anggota->rules()); //terapkan rules di Anggota_model.php

        if ($validation->run()) { //lakukan validasi form
            $anggota->update($id); // update data
            $this->session->set_flashdata('success', 'Data Anggota '.$anggota->getById($id)->nama.' Berhasil Diubah');
            redirect('Anggota_controller/index');

        }
        $data['anggota'] = $this->Anggota_model->getById($id);
        $this->load->view('anggota/edit_anggota', $data);
    }

    public function hide($id){
    	$this->Anggota_model->update($id);
    	$this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
    	redirect('Anggota_controller/index');
    }

    public function delete($id){
	    $this->Anggota_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
	    redirect('Anggota_controller/index');
	}
}