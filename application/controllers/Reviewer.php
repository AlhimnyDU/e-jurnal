<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewer extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/reviewer_guide/general/urls.html
	 */
    public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','download'));
		$this->load->library('session');
        $this->load->library('upload');
        $this->load->model('Login_model');
		$this->load->database();
	}

	public function index(){
        $data['reviewer'] = $this->db->select('*')->from('tbl_akun')->where('role_akun', "reviewer")->get()->result();
        $data['jurnal'] = $this->db->select('*')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','LEFT')->where('id_reviewer', $this->session->userdata('id_akun'))->where('tipe', "Sedang diulas")->or_where('tipe', "Pengajuan akhir")->get()->result();
        $data['jurnal_fin'] = $this->db->select('*')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','LEFT')->where('id_reviewer', $this->session->userdata('id_akun'))->where('tipe', "Selesai")->get()->result();
		$this->load->view('reviewer/templates/header');
		$this->load->view('reviewer/dashboard',$data);
		$this->load->view('reviewer/templates/footer');
    }
    
    public function jawaban($id){
        $data = array(
            'tipe' => $this->input->post('tipe'),
            'jawaban' => $this->input->post('jawaban'),
            'file_jawaban' => $this->upload_jawaban(),
            'updated' =>  date('Y-m-d H:i:s')
		);
        $query =  $this->Login_model->update('tbl_jurnal','id_jurnal',$id,$data);
        if($query){
        	$this->session->set_flashdata('success_update',"Update Berhasil");
        }else{
        	$this->session->set_flashdata('error_update',"Update Gagal");
		}
        redirect('reviewer');
    }

    public function upload_jawaban(){
        $config['upload_path']          = './assets/upload/jurnal/';
        $config['allowed_types']        = 'pdf';
        $this->upload->initialize($config);
		$this->upload->do_upload('file_jawaban');
		return $this->upload->data('file_name');
	}
}