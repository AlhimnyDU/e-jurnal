<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->model('Login_model');
		$this->load->helper(array('form','url'));
		$this->load->library('session');
	}

	public function index(){
		$this->load->view('login/templates/header');
		$this->load->view('login/login');
		$this->load->view('login/templates/footer');
    }
    
    public function register(){
		$this->load->view('login/templates/header');
		$this->load->view('login/register');
		$this->load->view('login/templates/footer');
    }
    
    public function addAkun(){
		$data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'asal_institusi' => $this->input->post('asal_institusi'),
			'telp' => $this->input->post('telp'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'alamat' => $this->input->post('alamat'),
            'role_akun' => "user",
            'created' =>  date('Y-m-d H:i:s'),
            'updated' =>  date('Y-m-d H:i:s')
        );
        $query =  $this->Login_model->insert('tbl_akun',$data);
        if($query){
        	$this->session->set_flashdata('insert_akun',"Tambah Berhasil");
        }else{
        	$this->session->set_flashdata('insert_akun',"Tambah Gagal");
        }
        redirect('login');
	}
}
