<?php 

class Dashboard extends CI_Controller{


    var $gallerypath;

	function __construct(){
		parent::__construct();	

$this->load->helper('cleanurl_helper');
$this->load->model('m_login');
$this->load->model('model_berita');
$this->load->library('pagination');
$this->load->helper(array('url','html','file','form','download'));

 if( ! $this->session->userdata('id_user')) 
            redirect('login'); 

	}

public function index(){

$data['sm_berita'] = $this->model_berita->admin_sm_berita();

$data['dtbidang'] = $this->model_berita->admin_dtbidang();
$this->load->view('dashboard', $data);
        }

public function menu_utama(){

$data['total_data'] = $this->model_berita->hitungdata();

$data['dtbidang'] = $this->model_berita->admin_dtbidang();
$this->load->view('menu_utama', $data);
        }

public function kirimlaporan(){

$data['kirimlaporan'] = $this->model_berita->laporan_ku();

$data['dtbidang'] = $this->model_berita->admin_dtbidang();
$this->load->view('kirimlaporan', $data);
        }

public function kegiatan_user(){

$data['kirimlaporan'] = $this->model_berita->laporan_user();

$data['dtbidang'] = $this->model_berita->admin_dtbidang();
$this->load->view('kegiatan_user', $data);
        }

function download($id_berita= NULL)
  {
    $row = $this->db->get_where('kegiatan',['id_berita'=>$id_berita])->row();
    force_download('uploads/'.$row->image,NULL,$set_mime = FALSE);
    redirect('index.php/dashboard');
  } 
function downloadAnggota($id_berita= NULL)
  {
    $row = $this->db->get_where('kegiatan',['id_berita'=>$id_berita])->row();
    force_download('uploads/'.$row->anggota,NULL,$set_mime = FALSE);
    redirect('index.php/dashboard/');
  } 
function downloadTim($id_berita= NULL)
  {
    $row = $this->db->get_where('kegiatan',['id_berita'=>$id_berita])->row();
    force_download('uploads/'.$row->anggota,NULL,$set_mime = FALSE);
    redirect('index.php/dashboard/kegiatan_user');
  } 

function downloadkegiatanuser($id_berita= NULL)
  {
    $row = $this->db->get_where('kegiatan_user',['id_berita'=>$id_berita])->row();
    force_download('uploads/'.$row->image,NULL,$set_mime = FALSE);
    redirect('index.php/dashboard/laporan');
  }  
    



public function bidangprogram(){

$this->load->database();
$data['sm_komentar'] = $this->model_berita->admin_sm_komentar();
$this->load->view('template_a');
$this->load->view('config/komentar', $data);
		}


public function profile(){

$this->load->view('template_a');
$this->load->view('config/profil');
    }

public function update_profil(){
$this->form_validation->set_rules('id_user', 'id_user', 'required');
$this->form_validation->set_rules('username', 'username', 'required');
    $this->form_validation->set_rules('password', 'password','required');

if($this->form_validation->run()==FALSE){
            $this->session->set_flashdata('msg',"Data Gagal Di Edit");
            redirect('index.php/dashboard/profile');
        }else{
$data = array(
       "username"=>$_POST['username'],
                "password"=>md5($_POST['password']),
    );
$this->db->where('id_user', $_POST['id_user']);
            $this->db->update('user',$data);
            $this->session->set_flashdata('msg', 'Profil Berhasil Di Edit');
    
            redirect('index.php/dashboard/profile');
    }
  }

public function laporan(){

$data['dtbidang'] = $this->model_berita->admin_dtbidang();
$this->load->model('model_berita');
$data['sm_berita'] = $this->model_berita->laporan();
$this->load->view('config/laporan', $data);
		}

public function laporan_pengguna(){



$data['sm_user'] = $this->model_berita->laporan_sm_user();

$data['dtbidang'] = $this->model_berita->admin_dtbidang();
$this->load->view('config/laporanpengguna', $data);
    }

public function filter($id)
 {
  if ($id == 0) {
   $data = $this->db->get('kegiatan')->result();
  }
  else
  {
   $data = $this->db->get_where('kegiatan', ['id_berita'=>$id])->result();
  }
  $dt['kegiatan'] = $data;
  $dt['id_berita'] = $id;
  $this->load->view('laporan/result', $dt);
 }

 public function cetak($id)
 {
  if ($id == 0) {
   $data = $this->db->get('kegiatan')->result();
  }
  else
  {
   $data = $this->db->get_where('kegiatan', ['id_berita'=>$id])->result();
  }
  $dt['kegiatan'] = $data;
  $this->load->library('mypdf');
  $this->mypdf->generate('Laporan/cetak', $dt, 'laporan-mahasiswa', 'A4', 'portrait');
 }

public function search(){

            $keyword = $this->input->post('kategori','tglmulai','tglakhir');
    
            $data['sm_berita']=$this->model_berita->get_product_keyword($keyword);

$data['dtbidang'] = $this->model_berita->admin_dtbidang();
            $this->load->view('config/laporan',$data);
        }

public function user(){


$data['sm_user'] = $this->model_berita->admin_sm_user();
$data['dtbidang'] = $this->model_berita->admin_dtbidang();
$this->load->view('config/user', $data);

		}

function proses_hapus_user($id_user=null){

if( ! $this->session->userdata('id_user')){ 
            redirect('login'); 

  }

$this->model_berita->hapus_user($id_user);
$data['sm_user'] = $this->model_berita->admin_sm_user();
$this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> User berhasil Di Hapus.
             </div>'
           );
  redirect('index.php/dashboard/user');
        }

function proses_hapus_komentar($id_komentar=null){

$this->model_berita->hapus_komentar($id_komentar);
$data['sm_komentar'] = $this->model_berita->admin_sm_komentar();

          $this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> Kategori berhasil dihapus.
             </div>'
           );
  redirect('index.php/dashboard/bidangprogram');
        }

function proses_hapus_berita($id=''){


if($this->session->userdata('level') == 'User'){ 
            redirect('login'); 

  }else{

$cek_data = $this->model_berita->get_data_by_pk('kegiatan', 'id_berita', $id)->row();

$this->load->helper('file');
delete_files($cek_data);
          unlink("./uploads/$cek_data->image");
                
$this->model_berita->delete_data_by_pk('kegiatan', 'id_berita', $id);

$this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> Kegiatan berhasil dihapus.
             </div>'
           );
  redirect('index.php/dashboard');
        }
      }

function proses_hapus_kgiatanuser($id=''){


if($this->session->userdata('level') == 'User'){ 
            redirect('login'); 

  }else{

$cek_data = $this->model_berita->get_data_by_pk('kegiatan_user', 'id_berita', $id)->row();

$this->load->helper('file');
delete_files($cek_data);
          unlink("./uploads/$cek_data->image");
                
$this->model_berita->delete_data_by_pk('kegiatan_user', 'id_berita', $id);

$this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> Kegiatan berhasil dihapus.
             </div>'
           );
  redirect('index.php/dashboard/laporan');
        }
      }

function get_subkategori(){
        $id=$this->input->post('id');
        $data=$this->model_berita->get_subkategori($id);
        echo json_encode($data);
    }
				

public function tambah_kegiatan(){


$data['dtbidang'] = $this->model_berita->admin_dtbidang();
$data['berita'] = $this->model_berita->all();
$this->load->view('tambah_kegiatan', $data);


if (isset($_POST['btnsimpan'])) {
              $capaian          = htmlentities(strip_tags($_POST['capaian']));
              $keterangan          = htmlentities(strip_tags($_POST['keterangan']));
              $username            = htmlentities(strip_tags($_POST['username']));
              $create_by            = htmlentities(strip_tags($_POST['create_by']));
             $kategori            = htmlentities(strip_tags($_POST['kategori']));
             

              $file_size = 5500; //5 MB
              $this->upload->initialize(array(
                "upload_path" => "./uploads/",
                "allowed_types" => "pdf|jpg|jpeg|zip|png|gif",
                "max_size" => "$file_size"
              ));

              if ( ! $this->upload->do_upload('image'))
              {
                  $error = $this->upload->display_errors('<p>', '</p>');
                  $this->session->set_flashdata('msg',
                     '
                     <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times; &nbsp;</span>
                        </button>
                        <strong>Gagal!</strong> '.$error.'.
                     </div>'
                   );
              }
               else
              {

                    $gbr = $this->upload->data();

                    $filename = $gbr['file_name'];
                    $image     = preg_replace('/ /', '_', $filename);

                    date_default_timezone_set('Asia/Jakarta');
                    $tgl = date('Y-m-d');

                    $data = array('kategori' => $kategori,
          'capaian' => $capaian,
          'keterangan' => $keterangan,
                    'created_at' => $tgl,
                    'create_by' => $create_by,
                    'image' => $image,
                    'username' => $username);
                    $this->db->insert('kegiatan', $data);
                    $this->session->set_flashdata('msg',
                       '
                       <div class="alert alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times; &nbsp;</span>
                          </button>
                          <strong>Sukses!</strong> Kegiatan berhasil ditambahkan.
                       </div>'
                     );
              }
redirect('index.php/dashboard/tambah_kegiatan');
          }
		}

public function tmbhkirimlaporan(){


$data['dtbidang'] = $this->model_berita->admin_dtbidang();
$data['berita'] = $this->model_berita->all();
$this->load->view('inputkirimlaporan', $data);


if (isset($_POST['btnsimpan'])) {
              $capaian          = htmlentities(strip_tags($_POST['capaian']));
              $keterangan          = htmlentities(strip_tags($_POST['keterangan']));
              $username            = htmlentities(strip_tags($_POST['username']));
              $create_by            = htmlentities(strip_tags($_POST['create_by']));
              $kategori            = htmlentities(strip_tags($_POST['kategori']));
             

              $file_size = 5500; //5 MB
              $this->upload->initialize(array(
                "upload_path" => "./uploads/",
                "allowed_types" => "pdf|jpg|jpeg|zip|png|gif",
                "max_size" => "$file_size"
              ));

              if ( ! $this->upload->do_upload('image'))
              {
                  
                  $this->session->set_flashdata('error',
                     '
                     <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times; &nbsp;</span>
                        </button>
                        <strong>Format File Tidak Didukung!</strong>
                     </div>'
                   );
              }
               else
              {

                    $gbr = $this->upload->data();

                    $filename = $gbr['file_name'];
                    $image     = preg_replace('/ /', '_', $filename);

                    date_default_timezone_set('Asia/Jakarta');
                    $tgl = date('Y-m-d');

                    $data = array('kategori' => $kategori,
          'capaian' => $capaian,
          'keterangan' => $keterangan,
                    'created_at' => $tgl,
                    'create_by' => $create_by,
                    'image' => $image,
                    'username' => $username);
                    $this->db->insert('kegiatan_user', $data);
                    $this->session->set_flashdata('msg',
                       '
                       <div class="alert alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times; &nbsp;</span>
                          </button>
                          <strong>Sukses!</strong>Laporan berhasil dikirim.
                       </div>'
                     );
              }
 redirect('index.php/dashboard/tmbhkirimlaporan');
          }
        }

public function edit_berita()
    {
        $this->form_validation->set_rules('id_berita', 'id_berita', 'required');
        $this->form_validation->set_rules('kategori', 'kategori', 'required');
         $this->form_validation->set_rules('created_at', 'created_at', 'required');
       
        $this->form_validation->set_rules('capaian', 'capaian', 'required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');


        if($this->form_validation->run()==FALSE){
            $this->session->set_flashdata('error',"Data Gagal Di Edit");
            redirect('index.php/dashboard');
        }else{
            $data=array(
                "kategori"=>$_POST['kategori'],
                "created_at"=>$_POST['created_at'],
                "capaian"=>$_POST['capaian'],
                "keterangan"=>$_POST['keterangan'],
            );
            $this->db->where('id_berita', $_POST['id_berita']);
            $this->db->update('kegiatan',$data);
            $this->session->set_flashdata('message', 'Data Berhasil Di Edit');
		
            redirect('index.php/dashboard');
        }
    }

public function tambah_anggota(){
              $file_size = 5500;
              $this->upload->initialize(array(
                "upload_path" => "./uploads/",
                "allowed_types" => "pdf|jpg|jpeg|zip|png|gif",
                "max_size" => "$file_size"
              ));

              if ( ! $this->upload->do_upload('image'))
              {
                  $error = $this->upload->display_errors('<p>', '</p>');
                  $this->session->set_flashdata('msg',
                     '<div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times; &nbsp;</span>
                        </button>
                        <strong>Gagal!</strong> '.$error.'.
                     </div>'
                   );
              }
               else
              {
                    $gbr = $this->upload->data();
                    $filename = $gbr['file_name'];
                    $anggota     = preg_replace('/ /', '_', $filename);
                    $data=array(
                      "anggota"=>$anggota,
                    );

                  $this->db->where('id_berita', $_POST['id_berita']);
                  $this->db->update('kegiatan',$data);
                  $this->session->set_flashdata('message', 'Data Berhasil Di Edit');
                  
                  $this->session->set_flashdata('msg',
                     '<div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times; &nbsp;</span>
                        </button>
                        <strong>Sukses Menambahkan Tim Anggota!</strong>
                     </div>'
                   );
                }
                redirect('index.php/dashboard/');
              }
public function edit_laporanku()
    {
        $this->form_validation->set_rules('id_berita', 'id_berita', 'required');
       $this->form_validation->set_rules('created_at', 'created_at', 'required');
        $this->form_validation->set_rules('capaian', 'capaian', 'required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');


        if($this->form_validation->run()==FALSE){
            
            $this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> Data Gagal diedit.
             </div>'
           );

redirect('index.php/dashboard/kirimlaporan');
        }else{
            $data=array(
                "created_at"=>$_POST['created_at'],
                "capaian"=>$_POST['capaian'],
                "keterangan"=>$_POST['keterangan'],
            );
            $this->db->where('id_berita', $_POST['id_berita']);
            $this->db->update('kegiatan_user',$data);
            
            $this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> Data Berhasil diedit.
             </div>'
           );

            redirect('index.php/dashboard/kirimlaporan');
        }
    }

public function edit_komentar()
    {
        $this->form_validation->set_rules('id_komentar', 'id_komentar', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required');
        
     
        if($this->form_validation->run()==FALSE){
             $this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> Data Gagal diedit.
             </div>'
           );
            redirect('index.php/dashboard/komentar');
        }else{
            $data=array(
                "id_komentar"=>$_POST['id_komentar'],
                "nama_lengkap"=>$_POST['nama_lengkap'],
            
            );
            $this->db->where('id_komentar', $_POST['id_komentar']);
            $this->db->update('databidang',$data);
             $this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> Kategori berhasil diedit.
             </div>'
           );
            redirect('index.php/dashboard/bidangprogram');
        }
    }



public function edit_user()
    {
        $this->form_validation->set_rules('id_user', 'id_user', 'required');
         $this->form_validation->set_rules('username', 'username', 'required');

         $this->form_validation->set_rules('kategori', 'kategori', 'required');
      
     
        if($this->form_validation->run()==FALSE){
            $this->session->set_flashdata('error',"Data Gagal Di Edit");
            redirect('index.php/dashboard');
        }else{
            $data=array(
                "username"=>$_POST['username'],
                "kategori"=>$_POST['kategori'],
            );
            $this->db->where('id_user', $_POST['id_user']);
            $this->db->update('user',$data);
            $this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> Data berhasil Di Edit.
             </div>'
           );
            redirect('index.php/dashboard/user');
        }
    }


function terimaLaporan($id){
  $data = array(
    'Validasi' => 'Sudah Valid'
  );
  $this->db->where('id_berita', $id);
  $this->db->update('kegiatan_user',$data);
  $this->session->set_flashdata('message', 'Laporan Berhasil Di Validasi');

  redirect('index.php/dashboard/laporan');
}

function tolakLaporan($id){
  $data = array(
    'Validasi' => 'Tidak Valid'
  );
  $this->db->where('id_berita', $id);
  $this->db->update('kegiatan_user',$data);
  $this->session->set_flashdata('message', 'Laporan Berhasil Di Validasi');

  redirect('index.php/dashboard/laporan');
}




function post_user(){

        $username = $this->input->post('username');
        $level = $this->input->post('level');
        $password = md5($this->input->post('password'));
        $kategori = $this->input->post('kategori');
        
        
        $data = array(

            'level' => $level,
            'username' => $username,
            'password' => $password,
            'kategori' => $kategori,
        
            );
        $this->session->set_flashdata('message', 'Berhasil Di Tambah');
        $this->model_berita->post_user($data,'user');
        $this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> User berhasil Di Tambah.
             </div>'
           );
        redirect('index.php/dashboard/user');
    }

function post_bidang(){

        $nama_lengkap = $this->input->post('nama_lengkap');
        
        
        $data = array(
            'nama_lengkap' => $nama_lengkap,
        
            );
        $this->session->set_flashdata('msg',
             '
             <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; &nbsp;</span>
                </button>
                <strong>Sukses!</strong> Kategori berhasil Di Tambah.
             </div>'
           );
        $this->model_berita->post_user($data,'databidang');
        redirect('index.php/dashboard/bidangprogram');
    }


    }

