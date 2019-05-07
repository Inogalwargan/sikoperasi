<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_controller extends CI_Controller
{
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
}