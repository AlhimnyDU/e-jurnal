<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bendahara extends CI_Controller {

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
	 * @see https://codeigniter.com/bendahara_guide/general/urls.html
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
        if($this->session->userdata('username')){
			if($this->session->userdata('bendahara')){
                $data['jurnal'] = $this->db->select('tbl_jurnal.*, tbl_akun.nama, tbl_akun.telp')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','LEFT')->get()->result();
                $this->load->view('bendahara/templates/header');
                $this->load->view('bendahara/dashboard',$data);
                $this->load->view('bendahara/templates/footer');
            }else{
				echo "404 - NOT FOUND";
			}

		}else{
			redirect('login');
		}
    }
}