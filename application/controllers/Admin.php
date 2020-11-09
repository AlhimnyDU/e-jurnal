<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	 * @see https://codeigniter.com/admin_guide/general/urls.html
	 */
    public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','download'));
		$this->load->library('session');
        $this->load->library('upload');
         $this->load->library('email');
        $this->load->model('Login_model');
		$this->load->database();
	}

	public function index(){
		if($this->session->userdata('username')){
			if($this->session->userdata('admin')){
				$data['jml'] = $this->db->select('COUNT(*) as totalAkun')->get('tbl_akun')->row_array();
				$data['jml_user'] = $this->db->select('COUNT(*) as total')->where('role_akun', "user")->get('tbl_akun')->row_array();
				$data['percent'] = $data['jml_user']['total']/$data['jml']['totalAkun']*100;
				$data['jml_jurnal'] = $this->db->select('COUNT(*) as total')->get('tbl_jurnal')->row_array();
				$data['jml_jurnal_rev'] = $this->db->select('COUNT(*) as total')->where('tipe', "Ditolak")->get('tbl_jurnal')->row_array();
				$data['jml_jurnal_fin'] = $this->db->select('COUNT(*) as total')->where('tipe', "Selesai")->get('tbl_jurnal')->row_array();
				$data['akun'] = $this->db->select('*')->from('tbl_akun')->where('role_akun', "user")->get()->result();
				$data['jurnal'] = $this->db->select('tbl_jurnal.*, tbl_akun.nama')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','LEFT')->where('tipe', "Awal")->get()->result();
				$data['jurnal_ulas'] = $this->db->select('*')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','LEFT')->where('tipe', "Sedang diulas")->or_where('tipe', "Keputusan Akhir")->or_where('tipe', "Revisi")->or_where('tipe', "Pengajuan Akhir")->get()->result();
				$data['jurnal_fin'] = $this->db->select('*')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','LEFT')->where('tipe', "Selesai")->or_where('tipe', "Ditolak")->get()->result();
				$data['reviewer'] = $this->db->select('*')->from('tbl_akun')->where('role_akun', "reviewer")->get()->result();
				$data['file'] = $this->db->select('*')->from('tbl_file')->get()->result();
				$data['timeline'] = $this->db->select('*')->from('tbl_timeline')->get()->result();
				$this->load->view('admin/templates/header');
				$this->load->view('admin/dashboard',$data);
				$this->load->view('admin/templates/footer');
			}else{
				echo "404 - NOT FOUND";
			}

		}else{
			redirect('login');
		}
	}

	public function job($id){
		$data['reviewer'] = $this->db->select('*')->from('tbl_akun')->where('id_akun', $id)->get()->row_array();
		$data['jurnal'] = $this->db->select('*')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','LEFT')->where('id_reviewer', $id)->or_where('id_reviewer2', $id)->get()->result();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/job',$data);
		$this->load->view('admin/templates/footer');
	}
	
	public function upload_jurnal(){
        $config['upload_path']          = './assets/upload/jurnal/';
        $config['allowed_types']        = 'pdf';
        $this->upload->initialize($config);
		$this->upload->do_upload('file_jurnal');
		return $this->upload->data('file_name');
	}

	public function upload_bayar(){
        $config['upload_path']          = './assets/upload/bayar/';
        $config['allowed_types']        = 'pdf';
        $this->upload->initialize($config);
		$this->upload->do_upload('file_bayar');
		return $this->upload->data('file_name');
	}

	public function addJurnal(){
		$data = array(
			'nama_jurnal' => $this->input->post('nama_jurnal'),
			'file_jurnal' => $this->upload_jurnal(),
			'file_bayar'  => $this->upload_bayar(),
			'id_akun' => $this->session->admindata('id_akun'),
			'note'	=> $this->input->post('note'),
			'tipe'	=> "Awal",
			'created' => date('Y-m-d H:i:s'),
			'updated' => date('Y-m-d H:i:s'),
		);
		$this->db->insert('tbl_jurnal',$data);
		redirect('admin');
    }

    public function register_reviewer(){
		$this->load->view('admin/templates/header');
		$this->load->view('admin/register');
		$this->load->view('admin/templates/footer');
	}
    
    public function addReviewer(){
		$data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'bidang' => $this->input->post('bidang'),
            'asal_institusi' => $this->input->post('asal_institusi'),
			'telp' => $this->input->post('telp'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'alamat' => $this->input->post('alamat'),
			'role_akun' => "reviewer",
			'aktif' => "y",
            'created' =>  date('Y-m-d H:i:s'),
            'updated' =>  date('Y-m-d H:i:s')
		);
        $query =  $this->Login_model->insert('tbl_akun',$data);
        if($query){
			$this->session->set_flashdata('sukses_add',TRUE);
        }else{
        	$this->session->set_flashdata('gagal_add',TRUE);
        }
        redirect('admin');
	}

	public function mereview($id){
		$data = array(
			'id_reviewer' => $this->input->post('reviewer1'),
			'id_reviewer2' => $this->input->post('reviewer2'),
			'status_reviewer1' => "Pending",
			'status_reviewer2' => "Pending",
			'tipe' =>  "Sedang diulas",
			'updated' =>  date('Y-m-d H:i:s')
		);
        $query =  $this->Login_model->update('tbl_jurnal','id_jurnal',$id,$data);
        if($query){
            $toemail = $this->db->select('*')->from('tbl_akun')->where('id_akun',$this->input->post('reviewer1'))->or_where('id_akun',$this->input->post('reviewer2'))->get()->result();
            foreach($toemail as $e){
				$jurnal = $this->db->select('tbl_akun.*, tbl_jurnal.*')->from('tbl_jurnal')->where('tbl_jurnal.id_jurnal',$id)->join('tbl_jurnal','tbl_jurnal.id_akun=tbl_akun.id_akun','left')->get()->row_array();
                $config['smtp_host'] = 'seminar.ratmi.itenas.ac.id';
                $config['smtp_port'] = 465;
                $config['smtp_user'] = 'seratmi@seminar.ratmi.itenas.ac.id';
                $config['smtp_pass'] = '1t3n4$ADMIN';
                $this->email->initialize($config);
                $this->email->from('seratmi@seminar.ratmi.itenas.ac.id', 'Semnas RATMI XIX');
                $this->email->to($e->email);
                $this->email->set_mailtype("html");
                $this->email->subject('Review Paper - RATMI XIX');
        		$this->email->message('<b>Yth. '.$e->nama.'</b> <br> <br> Kami selaku Admin Seminar Nasional Rekayasa dan Aplikasi Teknik Mesin di Industri memohon bantuan kepada Bapak/Ibu untuk mengulas (review) paper/proceeding dari peserta SEMNAS RATMI atas nama '.$jurnal['nama'].' yang berjudul "'.$jurnal['nama_jurnal'].'", kami mohon agar Bapak/Ibu dapat melakukan review paper dalam jangka waktu satu minggu dimulai ketika munculnya email ini. Untuk melakukan review mengenai paper yang perlu di-review silahkan lakukan Login di website kami ( http://seminar.ratmi.itenas.ac.id ). Atas perhatiannya kami ucapkan terima kasih. <br><br><br> Hormat Kami, <br><br> Admin SEMNAS-RATMI XIX');
		
		    $this->email->send();
            }
			$this->session->set_flashdata('sukses_update',"update Berhasil");
        }else{
        	$this->session->set_flashdata('gagal_update',"update Gagal");
        }
        redirect('admin');
	}

	public function schedule($id){
		$data = array(
			'batas_waktu' => $this->input->post('batas_waktu')
		);
        $query =  $this->Login_model->update('tbl_timeline','id_timeline',$id,$data);
        if($query){
			$this->session->set_flashdata('sukses_update',"update Berhasil");
        }else{
        	$this->session->set_flashdata('gagal_update',"update Gagal");
        }
        redirect('admin');
	}

	public function publish($id){
		$data = array(
			'publish' =>  "y",
			'updated' =>  date('Y-m-d H:i:s')
		);
        $query =  $this->Login_model->update('tbl_jurnal','id_jurnal',$id,$data);
        if($query){
			$this->session->set_flashdata('sukses_update',"update Berhasil");
        }else{
        	$this->session->set_flashdata('gagal_update',"update Gagal");
        }
        redirect('admin');
	}

	public function unpublish($id){
		$data = array(
			'publish' =>  "n",
			'updated' =>  date('Y-m-d H:i:s')
		);
        $query =  $this->Login_model->update('tbl_jurnal','id_jurnal',$id,$data);
        if($query){
			$this->session->set_flashdata('sukses_update',"update Berhasil");
        }else{
        	$this->session->set_flashdata('gagal_update',"update Gagal");
        }
        redirect('admin');
	}

	public function acc_jurnal($id){
		$data = array(
			'tipe' =>  "Selesai",
			'updated' =>  date('Y-m-d H:i:s')
		);
        $query =  $this->Login_model->update('tbl_jurnal','id_jurnal',$id,$data);
        if($query){
			$this->session->set_flashdata('sukses_update',"update Berhasil");
        }else{
        	$this->session->set_flashdata('gagal_update',"update Gagal");
        }
        redirect('admin');
	}

	public function dec_jurnal($id){
		$data = array(
			'tipe' =>  "Ditolak",
			'updated' =>  date('Y-m-d H:i:s')
		);
        $query =  $this->Login_model->update('tbl_jurnal','id_jurnal',$id,$data);
        if($query){
			$this->session->set_flashdata('sukses_update',"update Berhasil");
        }else{
        	$this->session->set_flashdata('gagal_update',"update Gagal");
        }
        redirect('admin');
	}

	public function tolak_jurnal($id){
		$data = array(
			'jawaban' => $this->input->post('jawaban'),
			'tipe' =>  "Dikembalikan",
			'updated' =>  date('Y-m-d H:i:s')
		);
        $query =  $this->Login_model->update('tbl_jurnal','id_jurnal',$id,$data);
        if($query){
			$this->session->set_flashdata('sukses_update',"update Berhasil");
        }else{
        	$this->session->set_flashdata('gagal_update',"update Gagal");
        }
        redirect('admin');
	}

	public function download_jurnal($nama_file){    
        force_download('./assets/upload/jurnal/'.$nama_file, NULL);
		redirect('admin');
	}

	public function download_tf($nama_file){    
        force_download('./assets/upload/bayar/'.$nama_file, NULL);
		redirect('admin');
	}

	public function addAkun(){
		$email = $this->input->post('email');
		$data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'asal_institusi' => $this->input->post('asal_institusi'),
			'telp' => $this->input->post('telp'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'alamat' => $this->input->post('alamat'),
			'role_akun' => "user",
			'aktif' => "n",
            'created' =>  date('Y-m-d H:i:s'),
            'updated' =>  date('Y-m-d H:i:s')
		);
		$token = base64_encode(random_bytes(32));
		$user_token = [
			'email' => $email,
			'token' => $token,
			'date_created' => time()
		];
		$this->db->insert('user_token', $user_token);
        $query =  $this->Login_model->insert('tbl_akun',$data);
        if($query){
			$this->session->set_flashdata('sukses_add',TRUE);
			$this->_sendEmail($token,'verify');
        }else{
        	$this->session->set_flashdata('gagal_add',TRUE);
        }
        redirect('admin');
	}

	private function _sendEmail($token,$type){
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'anisaputrisetyaningrum@gmail.com',
			'smtp_pass' => 'Anisa_Putri230300',
			'smtp_port' =>  465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];

		$this->load->library('email',$config);
		$this->email->from('anisaputrisetyaningrum@gmail.com','E-Jurnal');
		$this->email->to($this->input->post('email'));

		if($type == 'verify'){
			$this->email->subject('Account Activation');
			$this->email->message('Click this link to verify your account : <a href="'.base_url(). 'login/verify?email='.$this->input->post('email').'&token='.urlencode($token).'">Activate</a>');
		}
		$this->email->send();
	}

	public function gantipassUser($id){
		$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$query =  $this->Login_model->update('tbl_akun','id_akun',$id,$data);
        if($query){
        	$this->session->set_flashdata('sukses_update',"Update Berhasil");
        }else{
        	$this->session->set_flashdata('error_update',"Update Gagal");
		}
		redirect('admin');
	}

	public function deleteAkun($id){
		$query =  $this->Login_model->delete('tbl_akun','id_akun',$id);
		redirect('admin');
	}

	public function editAkun($id){
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
        	$this->session->set_flashdata('sukses_update',"Update Berhasil");
        }else{
        	$this->session->set_flashdata('error_update',"Update Gagal");
		}
        redirect('admin');
	}
}