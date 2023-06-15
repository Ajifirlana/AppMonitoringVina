<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>dashboard/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Monitoring Kegiatan Tugas Luar</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
           
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php echo substr($this->session->userdata('username',5)); ?></p>
              </li>
              
              </li>
              <!-- Menu Footer-->

            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>