<?php
defined('BASEPATH')OR exit('Nodirectscriptaccessallowed');
class admin extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('admin_model','admin');
        $this->load->model('isiloker_model', 'loker');
        $this->load->model('daftarmitra_model','form');

    }
    
    public function index(){
        $this->load->view('layouts/header');
        $this->load->view('admin/index');
        $this->load->view('layouts/footer');
    }

    public function kelola_loker(){
        $data['data_loker']=$this->admin->getlokerAll();

        $this->load->view('layouts/header');
        $this->load->view('admin/kelola_loker',$data);
        $this->load->view('layouts/footer');
    }

        public function edit_loker($id){
            $obj_loker = $this->admin->getById($id);
            $data['objloker']=$obj_loker;
            $data['data_mitra'] = $this->loker->getmitraAll();

            $this->load->view('layouts/header');
            $this->load->view('admin/edit_loker',$data);
            $this->load->view('layouts/footer');
        }
        public function update_loker(){
            $_deskripsi_pekerjaan   =   $this->input->post('deskripsi_pekerjaan');
            $_tanggal_akhir         =   $this->input->post('tanggal_akhir');
            $_mitra_id              =   $this->input->post('mitra_id');
            $_email                 =   $this->input->post('email');
            $_idedit                =   $this->input->post('idedit');
    
            $data = array(  'deskripsi_pekerjaan'   =>  $_deskripsi_pekerjaan,
                            'tanggal_akhir'         =>  $_tanggal_akhir,
                            'mitra_id'              =>  $_mitra_id,
                            'email'                 =>  $_email,
            );
    
            if (!empty($_idedit)){
                $data['id']=$_idedit;
                $this->loker->update($data);
            }else{
                $this->loker->save($data);
            }
    
            redirect(base_url('index.php/admin/kelola_loker'),'refresh');
        }
    
        public function delete_loker($id){
            $data['id']=$id;
            $this->loker->delete($data);
    
            redirect(base_url('index.php/admin/kelola_loker'),'refresh');
        }

    public function kelola_mitra(){
        $data['data_mitra']=$this->form->getmitraAll();

        $this->load->view('layouts/header');
        $this->load->view('admin/kelola_mitra',$data);
        $this->load->view('layouts/footer');
    }

        public function edit_mitra($id){
            $obj_mitra = $this->form->getmitraById($id);
            $data['objmitra']=$obj_mitra;
            $data['data_bdusaha'] = $this->form->getbdusahaAll();
            $data['data_shusaha'] = $this->form->getshusahaAll();

            $this->load->view('layouts/header');
            $this->load->view('admin/edit_mitra',$data);
            $this->load->view('layouts/footer');
        }

        public function update_mitra(){
            $_nama              =   $this->input->post('nama');
            $_alamat            =   $this->input->post('alamat');
            $_kontak            =   $this->input->post('kontak');
            $_telpon            =   $this->input->post('telpon');
            $_email             =   $this->input->post('email');
            $_web               =   $this->input->post('web');
            $_bidang_usaha_id   =   $this->input->post('bidang_usaha_id');
            $_sektor_usaha_id   =   $this->input->post('sektor_usaha_id');

            $data = array(  'nama'              =>  $_nama,
                            'alamat'            =>  $_alamat,
                            'kontak'            =>  $_kontak,
                            'telpon'            =>  $_telpon,
                            'email'             =>  $_email,
                            'web'               =>  $_web,
                            'bidang_usaha_id'   =>  $_bidang_usaha_id,
                            'sektor_usaha_id'   =>  $_sektor_usaha_id,
            );

            if (!empty($_idedit)){
                $data['id']=$_idedit;
                $this->form->update($data);
            }else{
                $this->form->save($data);
            }

            redirect(base_url('index.php/admin/kelola_mitra'),'refresh');
        }

        public function delete_mitra($id){
            $data['id']=$id;
            $this->form->delete($data);

            redirect(base_url('index.php/admin/kelola_mitra'),'refresh');
        }
    
    public function kelola_peminat(){
        $data['data_peminat']=$this->admin->getPeminatAll();

        $this->load->view('layouts/header');
        $this->load->view('admin/kelola_peminat',$data);
        $this->load->view('layouts/footer');
    }

    public function isi_berita(){
        $this->load->view('layouts/header');
        $this->load->view('admin/isi_berita');
        $this->load->view('layouts/footer');
    }

    public function daftar_berita(){
        $this->load->view('layouts/header');
        $this->load->view('admin/daftar_berita');
        $this->load->view('layouts/footer');
    }
}

?>