<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pegawai_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["pegawai"] = $this->pegawai_model->getAll();
        $this->load->view("pegawai/lihat_pegawai", $data);
    }

    public function add()
    {
        $pegawai = $this->pegawai_model;
        $validation = $this->form_validation;
        $validation->set_rules($pegawai->rules());

        if ($validation->run()) {
            $pegawai->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("pegawai/tambah_pegawai");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/products');
       
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("admin/product/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->product_model->delete($id)) {
            redirect(site_url('admin/products'));
        }
    }
}