<?php 

$tgl_sekarang = date("Y");
$tgl_exp ="2024";
        if ($tgl_sekarang >=$tgl_exp) {
         ?>

      <script type="text/javascript" language="javascript">
                alert("Masa Berlaku Telah Habis Silahkan Hubungi Programmer...!!!");
              </script>
       <?php }else{?>        
       
<body class="hold-transition login-page">



<div class="login-box">
  <div class="login-logo">
   <b>Aplikasi Monitoring Tugas Luar</b>
    
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo" align="center">
      <?php
          echo $this->session->flashdata('msg');
          ?>
  

    </div>

    <p class="login-box-msg">Silahkan login di bawah ini.</p>

    <form action="<?php echo base_url('login/aksi_login');?>" method="post" enctype="multipart/form-data">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" id="user" placeholder="Username" autofocus required="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="pass" class="form-control" placeholder="Password" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      <select name="kategori" class="form-control" required="">
              <option value="" >--Login Sebagai--</option>
            
              <option value="Admin">Admin</option>

              <option value="Pegawai">Pegawai</option>
            
              <option value="Korwas">Korwas</option>
            
           
            </select>
          </div>
      <div align="center" class="row">
        
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="kirim" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>


    </form>
  </div>
</div>
<?php }?>
<!-- jQuery 2.2.3 -->
