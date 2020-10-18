<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
        $this->load->library('session');
        $this->load->database();
	}

	public function index(){
        $data['jurnal'] = $this->db->select('tbl_jurnal.*, tbl_akun.*')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','left')->where('tbl_jurnal.publish','y')->get()->result();
        $this->load->view('home/templates/header');
        $this->load->view('home/home',$data);
        $this->load->view('home/templates/footer');
	}
	
	public function tentangkami(){
        $this->load->view('home/templates/header');
        $this->load->view('home/tentang_kami');
        $this->load->view('home/templates/footer');
	}
	
	public function terkini(){
        $this->load->view('home/templates/header');
        $this->load->view('home/terkini');
        $this->load->view('home/templates/footer');
	}
	
	public function informasi(){
        $this->load->view('home/templates/header');
        $this->load->view('home/informasi');
        $this->load->view('home/templates/footer');
	}
	
	public function arsip(){
        $data['jurnal'] = $this->db->select('tbl_jurnal.*, tbl_akun.nama')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','left')->where('tbl_jurnal.publish','y')->get()->result();
        $this->load->view('home/templates/header');
        $this->load->view('home/arsip',$data);
        $this->load->view('home/templates/footer');
    }
}