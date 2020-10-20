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
		if($this->session->userdata('username')){
			if($this->session->userdata('reviewer')){
				$data['reviewer'] = $this->db->select('*')->from('tbl_akun')->where('role_akun', "reviewer")->get()->result();
				$data['jurnal'] = $this->db->select('*')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','LEFT')->where('id_reviewer', $this->session->userdata('id_akun'))->or_where('id_reviewer2', $this->session->userdata('id_akun'))->get()->result();
				$data['jurnal_fin'] = $this->db->select('*')->from('tbl_jurnal')->join('tbl_akun','tbl_akun.id_akun=tbl_jurnal.id_akun','LEFT')->where('id_reviewer', $this->session->userdata('id_akun'))->where('tipe', "Selesai")->or_where('tipe', "Keputusan Akhir")->get()->result();
				$data['file'] = $this->db->select('*')->from('tbl_file')->get()->result();
				$this->load->view('reviewer/templates/header');
				$this->load->view('reviewer/dashboard',$data);
				$this->load->view('reviewer/templates/footer');
			}else{
				echo "404 - NOT FOUND";
			}

		}else{
			redirect('login');
		}
    }

	
    public function jawaban($id){
		$reviewer = $this->db->where('id_jurnal',$id)->get('tbl_jurnal')->row_array();
		if($reviewer['id_reviewer']==$this->session->userdata('id_akun')){
			if($reviewer['tipe']!="Pengajuan akhir"){
				if((($this->input->post('statusreviewer')=="Revisi") && ($reviewer['status_reviewer2']=="Revisi")) || (($this->input->post('statusreviewer')=="Revisi") && ($reviewer['status_reviewer2']=="Terima")) || (($this->input->post('statusreviewer')=="Terima") && ($reviewer['status_reviewer2']=="Revisi")) || (($this->input->post('statusreviewer')=="Revisi") && ($reviewer['status_reviewer2']=="Tolak"))  || (($this->input->post('statusreviewer')=="Tolak") && ($reviewer['status_reviewer2']=="Revisi"))){
					$data = array(
						'status_reviewer1' => $this->input->post('statusreviewer'),
						'tipe' => "Revisi",
						'jawaban' => $this->input->post('jawaban'),
						'file_jawaban' => $this->upload_jawaban(),
						'updated' =>  date('Y-m-d H:i:s')
					);
				}else if((($this->input->post('statusreviewer')=="Revisi") && ($reviewer['status_reviewer2']=="Pending")) || (($this->input->post('statusreviewer')=="Terima") && ($reviewer['status_reviewer2']=="Pending")) || (($this->input->post('statusreviewer')=="Tolak") && ($reviewer['status_reviewer2']=="Pending"))){
					$data = array(
						'status_reviewer1' => $this->input->post('statusreviewer'),
						'tipe' => "Menunggu Reviewer",
						'jawaban' => $this->input->post('jawaban'),
						'file_jawaban' => $this->upload_jawaban(),
						'updated' =>  date('Y-m-d H:i:s')
					);
				}else if((($this->input->post('statusreviewer')=="Terima") && ($reviewer['status_reviewer2']=="Terima")) || (($this->input->post('statusreviewer')=="Terima") && ($reviewer['status_reviewer2']=="Tolak")) || (($this->input->post('statusreviewer')=="Tolak") && ($reviewer['status_reviewer2']=="Terima"))  || (($this->input->post('statusreviewer')=="Tolak") && ($reviewer['status_reviewer2']=="Tolak")) ){
					$data = array(
						'status_reviewer1' => $this->input->post('statusreviewer'),
						'tipe' => "Keputusan Akhir",
						'jawaban' => $this->input->post('jawaban'),
						'file_jawaban' => $this->upload_jawaban(),
						'updated' =>  date('Y-m-d H:i:s')
					);
				}
			}else{
				if((($this->input->post('statusreviewer')=="Terima") && ($reviewer['status_reviewer2']=="Pending")) || (($this->input->post('statusreviewer')=="Tolak") && ($reviewer['status_reviewer2']=="Pending"))){
					$data = array(
						'status_reviewer1' => $this->input->post('statusreviewer'),
						'tipe' => "Pengajuan akhir",
						'jawaban' => $this->input->post('jawaban'),
						'file_jawaban' => $this->upload_jawaban(),
						'updated' =>  date('Y-m-d H:i:s')
					);
				}else{
					$data = array(
						'status_reviewer1' => $this->input->post('statusreviewer'),
						'tipe' => "Keputusan Akhir",
						'jawaban' => $this->input->post('jawaban'),
						'file_jawaban' => $this->upload_jawaban(),
						'updated' =>  date('Y-m-d H:i:s')
					);
				}
			}
		} else if($reviewer['id_reviewer2']==$this->session->userdata('id_akun')){
			if($reviewer['tipe']!="Pengajuan akhir"){
				if((($this->input->post('statusreviewer')=="Revisi") && ($reviewer['status_reviewer1']=="Revisi")) || (($this->input->post('statusreviewer')=="Revisi") && ($reviewer['status_reviewer1']=="Terima")) || (($this->input->post('statusreviewer')=="Terima") && ($reviewer['status_reviewer1']=="Revisi")) || (($this->input->post('statusreviewer')=="Revisi") && ($reviewer['status_reviewer1']=="Tolak"))  || (($this->input->post('statusreviewer')=="Tolak") && ($reviewer['status_reviewer1']=="Revisi"))){
					$data = array(
						'status_reviewer2' => $this->input->post('statusreviewer'),
						'tipe' => "Revisi",
						'jawaban2' => $this->input->post('jawaban'),
						'file_jawaban2' => $this->upload_jawaban(),
						'updated' =>  date('Y-m-d H:i:s')
					);
				}
				else if((($this->input->post('statusreviewer')=="Revisi") && ($reviewer['status_reviewer1']=="Pending")) || (($this->input->post('statusreviewer')=="Terima") && ($reviewer['status_reviewer1']=="Pending")) || (($this->input->post('statusreviewer')=="Tolak") && ($reviewer['status_reviewer1']=="Pending"))){
					$data = array(
						'status_reviewer2' => $this->input->post('statusreviewer'),
						'tipe' => "Menunggu Reviewer",
						'jawaban2' => $this->input->post('jawaban'),
						'file_jawaban2' => $this->upload_jawaban(),
						'updated' =>  date('Y-m-d H:i:s')
					);
				}else if((($this->input->post('statusreviewer')=="Terima") && ($reviewer['status_reviewer1']=="Terima")) || (($this->input->post('statusreviewer')=="Terima") && ($reviewer['status_reviewer1']=="Tolak")) || (($this->input->post('statusreviewer')=="Tolak") && ($reviewer['status_reviewer1']=="Terima"))  || (($this->input->post('statusreviewer')=="Tolak") && ($reviewer['status_reviewer1']=="Tolak"))){
					$data = array(
						'status_reviewer2' => $this->input->post('statusreviewer'),
						'tipe' => "Keputusan Akhir",
						'jawaban2' => $this->input->post('jawaban'),
						'file_jawaban2' => $this->upload_jawaban(),
						'updated' =>  date('Y-m-d H:i:s')
					);
				}
			}else{
				if((($this->input->post('statusreviewer')=="Terima") && ($reviewer['status_reviewer1']=="Pending")) || (($this->input->post('statusreviewer')=="Tolak") && ($reviewer['status_reviewer1']=="Pending"))){
					$data = array(
						'status_reviewer2' => $this->input->post('statusreviewer'),
						'tipe' => "Pengajuan akhir",
						'jawaban2' => $this->input->post('jawaban'),
						'file_jawaban2' => $this->upload_jawaban(),
						'updated' =>  date('Y-m-d H:i:s')
					);
				}else{
					$data = array(
						'status_reviewer2' => $this->input->post('statusreviewer'),
						'tipe' => "Keputusan Akhir",
						'jawaban2' => $this->input->post('jawaban'),
						'file_jawaban2' => $this->upload_jawaban(),
						'updated' =>  date('Y-m-d H:i:s')
					);
				}
			}
		}
		$query =  $this->Login_model->update('tbl_jurnal','id_jurnal',$id,$data);
		if($query){
			$this->session->set_flashdata('sukses_update',"Update Berhasil");
		}else{
			$this->session->set_flashdata('error_update',"Update Gagal");
		}
		redirect('reviewer');
	}
		// 	if($this->input->post('tipe')=="Revisi"){
		// 		if($reviewer['status_reviewer2']=="Revisi"){
		// 			$data = array(
		// 				'status_reviewer1' => $this->input->post('tipe'),
		// 				'tipe' => "Revisi",
		// 				'jawaban' => $this->input->post('jawaban'),
		// 				'file_jawaban' => $this->upload_jawaban(),
		// 				'updated' =>  date('Y-m-d H:i:s')
		// 			);
		// 		}else{
		// 			$data = array(
		// 				'status_reviewer1' => $this->input->post('tipe'),
		// 				'tipe' => "Menunggu Reviewer",
		// 				'jawaban' => $this->input->post('jawaban'),
		// 				'file_jawaban' => $this->upload_jawaban(),
		// 				'updated' =>  date('Y-m-d H:i:s')
		// 			);
		// 		}
		// 	}else{
		// 		if($reviewer['status_reviewer2']!="Pending"){
		// 			$data = array(
		// 				'status_reviewer1' => $this->input->post('tipe'),
		// 				'tipe' => "Keputusan Akhir",
		// 				'jawaban' => $this->input->post('jawaban'),
		// 				'file_jawaban' => $this->upload_jawaban(),
		// 				'updated' =>  date('Y-m-d H:i:s')
		// 			);
		// 		}
		// 		else{
		// 			$data = array(
		// 				'status_reviewer1' => $this->input->post('tipe'),
		// 				'tipe' => "Keputusan Akhir",
		// 				'jawaban' => $this->input->post('jawaban'),
		// 				'file_jawaban' => $this->upload_jawaban(),
		// 				'updated' =>  date('Y-m-d H:i:s')
		// 			);
		// 		}
		// 	}
		// }else if($reviewer['id_reviewer2']==$this->session->userdata('id_akun')){
		// 	if($this->input->post('tipe')=="Revisi"){
		// 		if($reviewer['status_reviewer1']=="Revisi"){
		// 			$data = array(
		// 				'status_reviewer2' => $this->input->post('tipe'),
		// 				'tipe' => "Revisi",
		// 				'jawaban' => $this->input->post('jawaban'),
		// 				'file_jawaban' => $this->upload_jawaban(),
		// 				'updated' =>  date('Y-m-d H:i:s')
		// 			);
		// 		}else{
		// 			$data = array(
		// 				'status_reviewer2' => $this->input->post('tipe'),
		// 				'tipe' => "Menunggu Reviewer",
		// 				'jawaban' => $this->input->post('jawaban'),
		// 				'file_jawaban' => $this->upload_jawaban(),
		// 				'updated' =>  date('Y-m-d H:i:s')
		// 			);
		// 		}
		// 	}else{
		// 		if($reviewer['status_reviewer1']!="Pending"){
		// 			$data = array(
		// 				'status_reviewer2' => $this->input->post('tipe'),
		// 				'tipe' => "Keputusan Akhir",
		// 				'jawaban' => $this->input->post('jawaban'),
		// 				'file_jawaban' => $this->upload_jawaban(),
		// 				'updated' =>  date('Y-m-d H:i:s')
		// 			);
		// 		}else{
		// 			$data = array(
		// 				'status_reviewer2' => $this->input->post('tipe'),
		// 				'jawaban' => $this->input->post('jawaban'),
		// 				'file_jawaban' => $this->upload_jawaban(),
		// 				'updated' =>  date('Y-m-d H:i:s')
		// 			);
		// 		}
		// 	}
		//}

    public function upload_jawaban(){
        $config['upload_path']          = './assets/upload/jurnal/';
        $config['allowed_types']        = 'pdf';
        $this->upload->initialize($config);
		$this->upload->do_upload('file_jawaban');
		return $this->upload->data('file_name');
	}
}