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
		$data['registrasi'] = $this->db->select('*')->from('tbl_timeline')->where('id_timeline',3)->get()->row();
		$this->load->view('login/templates/header');
		$this->load->view('login/login',$data);
		$this->load->view('login/templates/footer');
    }
    
    public function register(){
		$this->load->view('login/templates/header');
		$this->load->view('login/register');
		$this->load->view('login/templates/footer');
    }

    public function login_akun(){
		$email =  $this->input->post('email');
        $password = $this->input->post('password');
        $select = $this->Login_model->validasi_akun('tbl_akun','email',$email,$password);
        if($select){
			if($select->role_akun == "user"){
				$this->session->set_flashdata('sukses_login',TRUE);
				$this->session->set_userdata('username',$select->nama);
				$this->session->set_userdata('user',"user");
                $this->session->set_userdata('id_akun',$select->id_akun);
        		redirect('user');
			}else if($select->role_akun == "reviewer"){
				$this->session->set_flashdata('sukses_login',TRUE);
				$this->session->set_userdata('username',$select->nama_admin);
				$this->session->set_userdata('reviewer',"reviewer");
                $this->session->set_userdata('id_akun',$select->id_akun);
        		redirect('reviewer');
			}else if($select->role_akun == "admin"){
				$this->session->set_flashdata('sukses_login',TRUE);
				$this->session->set_userdata('username',$select->nama);
				$this->session->set_userdata('admin',"admin");
				$this->session->set_userdata('id_akun',$select->id_akun);
        		redirect('admin');
            }else if($select->role_akun == "bendahara"){
				$this->session->set_flashdata('sukses_login',TRUE);
				$this->session->set_userdata('username',$select->nama);
				$this->session->set_userdata('bendahara',"bendahara");
				$this->session->set_userdata('id_akun',$select->id_akun);
				redirect('bendahara');
			}
        }else{
			$this->session->set_flashdata('gagal_login',TRUE);
            redirect('login');
        }
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
			$this->session->set_flashdata('sukses_registrasi',"Tambah Berhasil");
			$this->_sendEmail($token,'verify');
        }else{
        	$this->session->set_flashdata('gagal_registrasi',"Tambah Gagal");
        }
        redirect('login');
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

	public function logout(){
        $this->session->sess_destroy();
        redirect('login');
	}

	public function verify(){
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('tbl_akun', ['email' => $email])->row_array();
		if($user)
		{
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if($user_token){
				if(time() - $user_token['date_created'] < 60*60*24)
				{
					$this->db->set('aktif','y');
					$this->db->where('email', $email);
					$this->db->update('tbl_akun');

					$this->db->delete('user_token', ['email' => $email]);
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);
					redirect('login');
				}
			}
		} else{
			redirect('login');
		}
		redirect('login');
	}
}
