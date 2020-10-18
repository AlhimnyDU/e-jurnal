<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->library('upload');
		$this->load->model('Login_model');
		$this->load->database();
	}

	public function index(){
		if($this->session->userdata('username')){
			if($this->session->userdata('user')){
				$data['akun'] = $this->db->select('*')->from('tbl_akun')->where('id_akun', $this->session->userdata('id_akun'))->get()->row_array();
				$data['jurnal'] = $this->db->select('*')->from('tbl_jurnal')->where('id_akun', $this->session->userdata('id_akun'))->get()->result();
				$data['upload_awal'] = $this->db->select('*')->from('tbl_timeline')->where('id_timeline',1)->get()->row();
				$data['upload_revisi'] = $this->db->select('*')->from('tbl_timeline')->where('id_timeline',2)->get()->row();
				$this->load->view('user/templates/header',$data);
				$this->load->view('user/dasboard');
				$this->load->view('user/templates/footer');
			}else{
				echo "404 - NOT FOUND";
			}

		}else{
			redirect('login');
		}

	}

	public function editProfile($id){
		$email = $this->input->post('email');
		$data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'asal_institusi' => $this->input->post('asal_institusi'),
			'telp' => $this->input->post('telp'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'alamat' => $this->input->post('alamat'),
            'updated' =>  date('Y-m-d H:i:s')
		);
        $query =  $this->Login_model->update('tbl_akun','id_akun',$id,$data);
        if($query){
			$this->session->set_flashdata('sukses_registrasi',"Tambah Berhasil");
        }else{
        	$this->session->set_flashdata('gagal_registrasi',"Tambah Gagal");
        }
        redirect('user');
	}

	public function gantipassUser($id){
		$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$query =  $this->Login_model->update('tbl_akun','id_akun',$id,$data);
        if($query){
        	$this->session->set_flashdata('sukses_update',"Update Berhasil");
        }else{
        	$this->session->set_flashdata('error_update',"Update Gagal");
		}
		redirect('user');
	}
	
	public function upload_revisi(){
        $config['upload_path']          = './assets/upload/jurnal/';
        $config['allowed_types']        = 'pdf';
        $this->upload->initialize($config);
		$this->upload->do_upload('file_revisi');
		return $this->upload->data('file_name');
	}

	public function upload_bayar($id){
        $config['upload_path']          = './assets/upload/bayar/';
        $config['allowed_types']        = 'pdf';
        $this->upload->initialize($config);
		$this->upload->do_upload('file_bayar');
		$data = array(
			'file_bayar' => $this->upload->data('file_name'),
			'created' => date('Y-m-d H:i:s'),
			'updated' => date('Y-m-d H:i:s'),
		);
		$query = $this->db->where('id_jurnal',$id)->update('tbl_jurnal',$data);
		if($query){
			$this->session->set_flashdata('add_bayar',TRUE);
		}else{
			$this->session->set_flashdata('error_add',TRUE);
		}
		redirect('user');
	}

	public function addJurnal(){
		$nama_akun = $this->db->select('nama')->from('tbl_akun')->where('id_akun', $this->session->userdata('id_akun'))->get()->row_array();
		$filename = $nama_akun['nama']."_".$this->input->post('nama_jurnal');
		$config['upload_path']          = './assets/upload/jurnal/';
		$config['allowed_types']        = 'pdf';
		$config['file_name']			= $filename;
        $this->upload->initialize($config);
		$this->upload->do_upload('file_jurnal');
		$data = array(
			'nama_jurnal' => $this->input->post('nama_jurnal'),
			'bidang'  => $this->input->post('bidang'),
			'id_akun' => $this->session->userdata('id_akun'),
			'note'	=> $this->input->post('note'),
			'tipe'	=> "Awal",
			'created' => date('Y-m-d H:i:s'),
			'updated' => date('Y-m-d H:i:s')
		);
		$query = $this->db->insert('tbl_jurnal',$data);
		if($query){
			$id_jurnal = $this->db->select('id_jurnal')->from('tbl_jurnal')->where('nama_jurnal', $this->input->post('nama_jurnal'))->get()->row_array();
			$jurnal = array(
				'file_jurnal' => $this->upload->data('file_name'),
				'tipe' => "awal",
				'id_jurnal' => $id_jurnal['id_jurnal'],
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);
			$insert = $this->db->insert('tbl_file',$jurnal);
			$this->session->set_flashdata('sukses_add',TRUE);
		}else{
			$this->session->set_flashdata('error_add',TRUE);
		}
		redirect('user');
	}

	public function revisi($id){
			$nama_akun = $this->db->select('nama')->from('tbl_akun')->where('id_akun', $this->session->userdata('id_akun'))->get()->row_array();
			$filename = $nama_akun['nama']."_".$this->input->post('nama_jurnal')."_Revisi";
			$config['upload_path']          = './assets/upload/jurnal/';
			$config['allowed_types']        = 'pdf';
			$config['file_name']			= $filename;
			$this->upload->initialize($config);
			$this->upload->do_upload('file_revisi');
			$data = array(
				'tipe' => "Pengajuan akhir",
				'status_reviewer1' => "Pending",
				'status_reviewer2' => "Pending",
				'note' => $this->input->post('note'),
				'updated' =>  date('Y-m-d H:i:s')
			);
			$query =  $this->Login_model->update('tbl_jurnal','id_jurnal',$id,$data);
			if($query){
				$jurnal = array(
					'file_jurnal' => $this->upload->data('file_name'),
					'tipe' => "revisi",
					'id_jurnal' => $id,
					'created' => date('Y-m-d H:i:s'),
					'updated' => date('Y-m-d H:i:s')
				);
				$insert = $this->db->insert('tbl_file',$jurnal);
				$this->session->set_flashdata('sukses_update',"Update Berhasil");
			}else{
				$this->session->set_flashdata('error_update',"Update Gagal");
			}
			redirect('user');
	}

	public function pengajuan_ulang($id){
		$data = array(
			'tipe' => "Awal",
			'file_jurnal' => $this->upload_revisi(),
			'updated' =>  date('Y-m-d H:i:s')
		);
		$query =  $this->Login_model->update('tbl_jurnal','id_jurnal',$id,$data);
		if($query){
			$this->session->set_flashdata('sukses_update',"Update Berhasil");
		}else{
			$this->session->set_flashdata('error_update',"Update Gagal");
		}
		redirect('user');
}
}