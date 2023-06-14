
 
<!DOCTYPE html>
<html>
<head>

  <?php $this->load->view('template_a');?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->load->view('config/top-menu'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  
  <?php $this->load->view('config/side'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small>Control Panel</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
  <div class="col-md-12">
    <a data-toggle="modal" data-target="#modal-tambah">
      <button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Pengguna</button><br><br>
    </a>


    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Pengguna</h3>
        

      </div>
      <section class="content-header">
          <small><?php
          echo $this->session->flashdata('msg');
          ?></small>
      </section>

<div class="box-header">
	
      </div>

      <?php 
        if ($this->session->userdata('level') == 'User') {
         ?>

      <script type="text/javascript" language="javascript">
                alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
              </script>
              <?php
              redirect('index.php/dashboard');
            }
        ?>

<script type="text/javascript">
  $(document).ready( function () {
      $('#user').DataTable();
  } );
</script>

      <!-- /.box-header -->
      <div class="box-body">
        <table id="user" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th>Username</th>
            <th>Role</th>
            <th>Kategori</th>
            
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
          <?php 
          $no = $this->uri->segment('3') + 1;
          foreach ($sm_user->result() as $row) {
           ?>
          <tr>
             <td><?php echo $row->username; ?></td>
             <td><?php echo $row->level; ?></td>
             <td><?php echo $row->kategori; ?></td>
            <td>

 <a data-toggle="modal" data-target="#modal-edit<?=$row->id_user;?>" button class="btn btn-info btn-flat btn-xs" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-pencil-square-o"></i></a>


             
 <a data-toggle="modal" data-target="#modal-hapus<?=$row->id_user;?>" button class="btn btn-danger btn-flat btn-xs" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-trash"></i></a>

            </td>
          </tr>
          <?php $no++; } ?>

          </tbody>
        </table>
     
      <!-- /.box-body -->
    </div>
  </div>
</div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      
    </div>
    <strong>Copyright &copy; 2017 <a href="caramengatasimasalahmu.blogspot.com">Teknologi</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

<script src="<?php echo base_url();?>assets/admin/dist/js/app.min.js"></script>

</body>


</html>

 <!-- Modal hapus -->
<?php 
          foreach ($sm_user->result() as $row) {
           ?>

  <div class="row">
  <div id="modal-hapus<?=$row->id_user;?>" class="modal fade">
    <div class="modal-dialog">
 
<form action="<?php echo base_url();?>index.php/dashboard/proses_hapus_user/<?php echo $row->id_user; ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Data Pengguna</h4>
        </div>
        <div class="modal-body">
 
          <input type="hidden" readonly value="<?=$row->id_user;?>" name="id_berita" class="form-control" >
 
 <div class="form-group">
            <label>Apakah Anda Yakin Menghapus Pengguna...???</label>
            <br>
            <label>"<?=$row->username;?>"</label>
          </div>
          
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning"><i class="icon-pencil5"></i> Hapus</button>
          </div>
        </form>

     </div>
  </div>
</div>
        <?php } ?>

      </div>

<!--/modal ubah-->

<?php 
          foreach ($sm_user->result() as $row) {
           ?>

  <div class="row">
  <div id="modal-edit<?=$row->id_user;?>" class="modal fade">
    <div class="modal-dialog">
 
<form action="<?php echo base_url('index.php/dashboard/edit_user')?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Data Pengguna</h4>
        </div>
        <div class="modal-body">
 
          <input type="hidden" readonly value="<?=$row->id_user;?>" name="id_user" class="form-control" >
 
          <div class="form-group">
            <label>Username</label>
          <input type="text" name="username" autocomplete="off" value="<?=$row->username;?>" required placeholder="Masukkan Modal" class="form-control" cols="30" rows="3">
          </div>

          <div class="form-group">
            <label>Password</label>
          <input type="text" name="password" autocomplete="off" class="form-control" cols="30" rows="3">
          </div>
            <div class="form-group">
            <label>Level</label>
          <select name="level" autocomplete="off" required class="form-control" cols="30" rows="3">
            <option value="Admin">Admin</option>
            <option value="Pegawai">Pegawai</option>
            <option value="Korwas">Korwas</option>
            </select> 
          </div>    
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning"><i class="icon-pencil5"></i> Edit</button>
          </div>
        </form>

     </div>
  </div>
</div>
        <?php } ?>



<!--/ Modal Tambah -->
<div class="row">
  <div id="modal-tambah" class="modal fade">
    <div class="modal-dialog">
 
<form action="<?php echo base_url('index.php/dashboard/post_user')?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Data Pengguna</h4>
        </div>
        <div class="modal-body">
 
          <div class="form-group">
            <label>Username</label>
          <input type="text" name="username" autocomplete="off" required="" placeholder="Masukkan Username" class="form-control" cols="30" rows="3">
          </div>
          <input type="hidden" name="level" autocomplete="off" required="" value="User" class="form-control" cols="30" rows="3">
          <div class="form-group">
            <label>Password</label>
          <input type="password" name="password" autocomplete="off" required placeholder="Masukkan password" class="form-control" cols="30" rows="3">
          </div>

          <div class="form-group">
            <label>Level</label>
          <select name="level" autocomplete="off" required class="form-control" cols="30" rows="3">
            <option value="Admin">Admin</option>
            <option value="Pegawai">Pegawai</option>
            <option value="Korwas">Korwas</option>
            </select> 
          </div>           
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning"><i class="icon-pencil5"></i> Simpan</button>
          </div>
        </form>

     </div>
  </div>
</div>

<!--end modal tambah -->
