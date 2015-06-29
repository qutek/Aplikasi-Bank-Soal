<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">

    <title>Aplikasi Bank Soal</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>

    <script src="assets/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="dashboard.php" class="logo"><b>Aplikasi Bank Soal</b></a>
            <!--logo end-->
            
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="profile.php"><span class="fa fa-user"></span> My Profile</a></li>
                    <li><a class="logout" href="logout.php">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <p class="centered"><a href="dashboard.php"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
             <h5 class="centered">Bank Soal</h5>
              <!-- sidebar menu start-->
              <?php 

                  $menu = array(
                    'dashboard' => array(
                        'icon'  =>  'fa-dashboard',
                        'title' =>  'Dashboard',
                        'link'  =>  'dashboard.php'
                        ),
                    
                    'kelas' => array(
                        'icon'  =>  'fa-institution',
                        'title' =>  'Kelas',
                        'link'  =>  '#'
                        ),

                    'daftar_kelas' => array(
                        'icon'  =>  'fa-user',
                        'title' =>  'Daftar Kelas',
                        'link'  =>  'kelas.php',
                        'parent' => 'kelas'
                        ),

                    'tambah_kelas' => array(
                        'icon'  =>  'fa-plus',
                        'title' =>  'Tambah Kelas',
                        'link'  =>  'kelas.php?act=tambah',
                        'parent' => 'kelas'
                        ),
                    
                    'user' => array(
                        'icon'  =>  'fa-users',
                        'title' =>  'User',
                        'link'  =>  '#'
                        ),

                    'daftar_user' => array(
                        'icon'  =>  'fa-user',
                        'title' =>  'Daftar User',
                        'link'  =>  'user.php',
                        'parent' => 'user'
                        ),

                    'tambah_user' => array(
                        'icon'  =>  'fa-plus',
                        'title' =>  'Tambah User',
                        'link'  =>  'user.php?act=tambah',
                        'parent' => 'user'
                        ),
                    
                    'siswa' => array(
                        'icon'  =>  'fa-users',
                        'title' =>  'Siswa',
                        'link'  =>  '#'
                        ),

                    'daftar_siswa' => array(
                        'icon'  =>  'fa-user',
                        'title' =>  'Daftar Siswa',
                        'link'  =>  'siswa.php',
                        'parent' => 'siswa'
                        ),

                    'tambah_siswa' => array(
                        'icon'  =>  'fa-plus',
                        'title' =>  'Tambah Siswa',
                        'link'  =>  'siswa.php?act=tambah',
                        'parent' => 'siswa'
                        ),

                    // 'pertanyaan' => array(
                    //     'icon'  =>  'fa-mortar-board',
                    //     'title' =>  'Pertanyaan',
                    //     'link'  =>  'dashboard-siswa.php'
                    //     ),
                    
                    'soal' => array(
                        'icon'  =>  'fa-puzzle-piece',
                        'title' =>  'Soal',
                        'link'  =>  '#'
                        ),

                    'daftar_soal' => array(
                        'icon'  =>  'fa-puzzle-piece',
                        'title' =>  'Daftar Soal',
                        'link'  =>  'soal.php',
                        'parent' => 'soal'
                        ),

                    // 'tambah_soal' => array(
                    //     'icon'  =>  'fa-plus',
                    //     'title' =>  'Tambah Soal',
                    //     'link'  =>  'soal.php?act=tambah',
                    //     'parent' => 'soal'
                    //     ),
                    
                    'nilai' => array(
                        'icon'  =>  'fa-database',
                        'title' =>  'Nilai',
                        'link'  =>  '#'
                        ),
                    
                    'mapel' => array(
                        'icon'  =>  'fa-puzzle-piece',
                        'title' =>  'Mata Pelajaran',
                        'link'  =>  '#'
                        ),

                    'daftar_mapel' => array(
                        'icon'  =>  'fa-puzzle-piece',
                        'title' =>  'Daftar Pelajaran',
                        'link'  =>  'mapel.php',
                        'parent' => 'mapel'
                        ),

                    'tambah_mapel' => array(
                        'icon'  =>  'fa-plus',
                        'title' =>  'Tambah Pelajaran',
                        'link'  =>  'mapel.php?act=tambah',
                        'parent' => 'mapel'
                        ),
                    );

                  // pass mapel to menu
                  // $mapel = get_mapel();

                  // foreach ($mapel as $key => $mapel) {
                  //     $menu['tambah'.$mapel['id']] = array(
                  //       'icon'  =>  'fa-plus',
                  //       'title' =>  $mapel['mapel'],
                  //       'link'  =>  'soal.php?act=tambah&id='.$mapel['id'],
                  //       'parent' => 'soal'
                  //     );
                  // }

                  // pass kelas to menu
                  $kelas = get_kelas();

                  foreach ($kelas as $key => $kelas) {
                      $menu['tambah'.$kelas['id']] = array(
                        'icon'  =>  'fa-plus',
                        'title' =>  'Kelas '.$kelas['kelas'],
                        'link'  =>  'soal.php?act=tambah&cl_id='.$kelas['id'],
                        'parent' => 'soal'
                      );
                  }

                  $nilai_kelas = get_kelas();
                  foreach ($nilai_kelas as $key => $kelas) {
                      $menu['nilai'.$kelas['id']] = array(
                        'icon'  =>  'fa-paperclip',
                        'title' =>  'Kelas '.$kelas['kelas'],
                        'link'  =>  'nilai.php?cl_id='.$kelas['id'],
                        'parent' => 'nilai'
                      );
                  }

                  createMenu($menu, array('menu_class' => 'sidebar-menu', 'menu_id' => 'nav-accordion') );

                  // exit();

                  ?>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->