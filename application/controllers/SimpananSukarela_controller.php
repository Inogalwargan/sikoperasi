<?php defined('BASEPATH') OR exit('No direct script access allowed');


class SimpananSukarela_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Anggota_model");
        $this->load->model("SimpananSukarela_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["anggota"] = $this->Anggota_model->getAll();
        $this->load->view("simpanan_sukarela/lihat_simpanan_sukarela", $data);
    }

    public function detail($id){

        // $data['anggota'] = $this->SimpananWajib_model->detail_simpanan_pokokall();
        $data['simpanan_sukarela'] = $this->SimpananSukarela_model->detail_simpanan_sukarela($id);
        $data['tot'] = $this->SimpananSukarela_model->total_simpanan_sukarela($id);
        $this->load->view("simpanan_sukarela/detail_simpanan_sukarela", $data);
    }

    public function add($id)
    {   
        $anggota = $this->Anggota_model;
        $simpanan_sukarela = $this->SimpananSukarela_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpanan_sukarela->rules());

        if ($validation->run()) {
            $simpanan_sukarela->save();
            $this->session->set_flashdata('success', 'Tambah Simpanan Sukarela Sebesar Rp. '.$simpanan_sukarela->jumlah.' Berhasil Disimpan');
            redirect('SimpananSukarela_controller/index');
        }
        $data['anggota'] = $this->Anggota_model->getById($id);
        $this->load->view("simpanan_sukarela/tambah_simpanan_sukarela", $data);
    }

    public function edit($id){
        $anggota = $this->Anggota_model; //object model
    	$simpanan_sukarela = $this->SimpananSukarela_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($simpanan_sukarela->rules()); //terapkan rules di Anggota_model.php

        if ($validation->run()) { //lakukan validasi form
            $simpanan_sukarela->update($id); // update data
            $this->session->set_flashdata('success', 'Data Simpanan Sukarela Sebesar Rp. '.$simpanan_sukarela->getById($id)->jumlah.' Berhasil Diubah');
            redirect($_SERVER ['HTTP_REFERER']);

        }
        $data['simpanan_sukarela'] = $this->SimpananSukarela_model->getById($id);
        $this->load->view('simpanan_sukarela/edit_simpanan_sukarela', $data);
    }

    public function hide($id){
    	$this->Anggota_model->update($id);
    	$this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
    	redirect('Anggota_controller/index');
    }

    public function delete($id){
	    $this->SimpananSukarela_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Simpanan Sukarela Berhasil Dihapus');
	    redirect($_SERVER['HTTP_REFERER']);
	}
}
