<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('tglindo_helper');
       $this->load->helper('cleanurl_helper');
    $this->load->model('m_login');
    $this->load->model('model_berita');
    $this->load->library('pagination','form_validation');
    $this->load->helper(array('url','html','text'));
  }

  public function index()
  {
    $this->load->view('template_a'); 
    $this->load->view('v_login');
  }

  function aksi_login(){
    $username = $this->input->post('username'); 
    $password = md5($this->input->post('password')); 
    $kategori =  $this->input->post('kategori'); 

    $user = $this->m_login->get($username); 
    if(empty($user)){
       $this->session->set_flashdata('msg',
                     '
                     <div class="alert alert-success alert-dismissible" role="alert">
                      
                        <strong>Username Tidak Ditemukan!</strong> '.$error.'.
                     </div>'
                   );
     redirect('login');
    }else{
      if($password == $user->password){ 
        if ($kategori == $user->level) {
                 $session = array(
                  'authenticated'=>true,
                  'username'=>$user->username,
                  'id_user'=>$user->id_user,
                  'kategori'=>$user->kategori,
                  'level'=>$user->level
                );

                $this->session->set_userdata($session); $this->session->set_flashdata('msg',
                             '
                             <div class="alert alert-success alert-dismissible" role="alert">
                              
                                <strong>Selamat Datang '.$user->username.'</strong>'.$error.'.
                             </div>'
                           );
                redirect('dashboard/menu_utama');
        }else{

        $this->session->set_flashdata('msg',
                     '
                     <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times; &nbsp;</span>
                        </button>
                        Username dan password tidak cocok!'.$error.'.
                     </div>'
                   );
        redirect('login'); 
        }
       
      }else{
        $this->session->set_flashdata('msg',
                     '
                     <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times; &nbsp;</span>
                        </button>
                        Password Yang Anda Masukkan Salah!'.$error.'.
                     </div>'
                   );
        redirect('login'); 
      }
    }
}

function logout(){
    $this->session->sess_destroy(); // Hapus semua session
        Redirect('login');
   }

}

/* AJ3 */
/* ColorlIb*/