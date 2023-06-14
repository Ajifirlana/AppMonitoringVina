<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_berita extends CI_Model {
var $gallerypath;
var $gallery_path_url;

	public function __construct() {
 $this->load->database();
 $this->load->helper('tglindo_helper');

 $this->gallerypath = realpath(APPPATH . '../uploads/');
 $this->gallery_path_url = base_url().'uploads/';
 }

 public function get_data_by_pk($tbl, $where, $id)
	{
				$this->db->from($tbl);
				$this->db->where($where,$id);
				$query = $this->db->get();

				return $query;
	}

	public function delete_data_by_pk($tbl, $where, $id)
	{
		$this->db->where($where, $id);
		$this->db->delete($tbl);
	}

 
 public function hitungdata()
{   
    
    $query = $this->db->query('SELECT databidang.nama_lengkap, kategori, COUNT( * ) as total FROM databidang
                JOIN kegiatan_user ON databidang.nama_lengkap = kegiatan_user.kategori
                 GROUP BY kategori
                ');
 
    
            return $query->result();
}

	function kirimkomentar($data,$table){
		$this->db->insert($table,$data);
	}

	function post_berita($data,$table){
		$this->db->insert($table,$data);
	}

	function simpan_berita(){
	    $config = array('allowed_types' =>'png|jpg|pdf|doc|docx','encrypt_name' =>'TRUE','upload_path' => './uploads');

		$this->load->library('upload', $config);
		$this->upload->do_upload('image');
		$datafile = $this->upload->data();
		
		$config = array('source_image' => $datafile['full_path'],
	                         'new_image' => $this->gallerypath . '/uploads',
				             'maintain_ration' => false,
				             'width' => 130,
			                 'height' =>100);

	    $this->load->library('image_lib', $config);
	    $this->upload->initialize($config);
		$this->image_lib->resize();
		
		$create_by = $this->input->post('create_by');

		$username = $this->input->post('username');
		$kategori = $this->input->post('kategori');
		$capaian = $this->input->post('capaian');

		$keterangan = $this->input->post('keterangan');
		$tgl = date('Y-m-d');
		
		date_default_timezone_set('Asia/Jakarta');
		$create_by = $this->input->post('create_by');
		$image = $_FILES['image']['name'];
		
		$data = array('kategori' => $kategori,
					'capaian' => $capaian,
					'keterangan' => $keterangan,
	                  'created_at' => $tgl,
	                  'create_by' => $create_by,

	                  'username' => $username,
				      'image' => $image);
		$this->db->insert('kegiatan', $data);
	}


	function hapus_user($id_user){
	    $this->db->where('id_user', $id_user);
	    $this->db->delete('user');
	}

	function hapus_komentar($id_komentar){
	    $this->db->where('id_komentar', $id_komentar);
	    $this->db->delete('databidang');
	}

	function hapus_berita($id_berita){
	    $this->db->where('id_berita', $id_berita);
	    $this->db->delete('kegiatan');
	}

	function post_user($data,$table){
		$this->db->insert($table,$data);
	}


	function data($limit, $start){
		return $query = $this->db->get('berita', $limit, $start);
		return $query;		
	}

	public function all(){
 $query = $this->db->query("SELECT * FROM kegiatan ORDER BY id_berita DESC LIMIT 5 ");
		return $query;
	}

	public function internasional1(){
 $query = $this->db->get('berita');
 $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'internasional' ORDER BY id_berita DESC LIMIT 1 ");
 return $query->result();
    
	}

public function teknologi1(){
 $query = $this->db->get('berita');
 $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'teknologi' ORDER BY id_berita DESC LIMIT 1 ");
 return $query->result();
    
	}
	public function nasional1(){
 $query = $this->db->get('berita');
 $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'nasional' ORDER BY id_berita DESC LIMIT 1 ");
 return $query->result();


    
	}

	public function beritaterbaruinter(){

 $query = $this->db->query("SELECT * FROM berita  ORDER BY id_berita DESC LIMIT 5 ");
 return $query->result();


    
	}



	public function semuaberinter(){
 $query = $this->db->get('berita');
 $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'internasional'  ORDER BY id_berita DESC LIMIT 10 ");
 return $query->result();


    
	}

	public function allbernasional(){
 $query = $this->db->get('berita');
 $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'nasional'  ORDER BY id_berita DESC LIMIT 10 ");
 return $query->result();


    
	}

public function allberteknologi(){
 $query = $this->db->get('berita');
 $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'teknologi'  ORDER BY id_berita DESC LIMIT 10 ");
 return $query->result();


    
	}

public function politik1(){
 $query = $this->db->get('berita');
 $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'politik' ORDER BY id_berita DESC LIMIT 1 ");
 return $query->result();


    
	}

public function smpolitik(){
 $query = $this->db->get('berita');
 $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'politik'  ORDER BY id_berita DESC LIMIT 10 ");
 return $query->result();


    
	}
	public function kesehatanbrs1(){
 $query = $this->db->get('berita');
 $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'kesehatan'  ORDER BY id_berita DESC LIMIT 1 ");
 return $query->result();

	}

public function smukes(){
 $query = $this->db->get('berita');
 $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'kesehatan' ORDER BY id_berita DESC LIMIT 10 ");
 return $query->result();


    
	}	


	




public function nasional(){
  
  $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'nasional' ORDER BY id_berita DESC LIMIT 2 ");
		return $query;
	}

public function politik(){
  
  $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'politik' ORDER BY id_berita DESC LIMIT 2 ");
		return $query;
	}

	public function teknologi(){
  
  return $query = $this->db->query("SELECT * FROM berita WHERE kategori = 'teknologi' ORDER BY id_berita DESC LIMIT 5 ");
		return $query;
	}

	public function get_product_keyword($keyword){
			$this->db->select('*');
			$this->db->from('kegiatan_user');
			$this->db->like('created_at',$keyword);
			$this->db->or_like('kategori',$keyword);
			return $this->db->get()->result();
		}



	function datapolitik($number,$offset){
		return $query = $this->db->get('berita',$number,$offset)->result();		
	}

public function admin_sm_berita(){
	if ($this->session->userdata('level') == 'Admin' || $this->session->userdata('level') == 'Korwas') {
	
   		return $query = $this->db->query("SELECT * FROM kegiatan");
	}else
	
    return $query = $this->db->query("SELECT * FROM kegiatan WHERE create_by='".$this->session->id_user."'");
    
	}

public function laporan(){
    return $query = $this->db->query("SELECT * FROM kegiatan_user")->result();
    
	}

public function admin_dtbidang(){
    return $query = $this->db->query("SELECT * FROM databidang");
    
	}


public function admin_sm_user(){
    $query = $this->db->query("SELECT * FROM user");
    return $query;
	}



	
public function admin_sm_komentar(){
    return $query = $this->db->get('databidang');
		return $query;	
	}

public function laporan_sm_user(){
    $query = $this->db->query("SELECT * FROM user WHERE level='User'");
    return $query;
	}

public function laporan_user(){
    return $query = $this->db->query("SELECT * FROM kegiatan WHERE kategori='".$this->session->kategori."'");
    
	}
public function laporan_ku(){
    return $query = $this->db->query("SELECT * FROM kegiatan_user WHERE create_by='".$this->session->id_user."'");
    
	}

	public function get_berita_keyword($keyword){
			$this->db->select('*');
			$this->db->from('berita');
			$this->db->like('judul',$keyword);
			return $this->db->get()->result();
			
			
		}

	function edit_berita($where,$table){		

	return $this->db->get_where($table,$where);
}
}