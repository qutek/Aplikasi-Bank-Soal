<?php error_reporting(E_ALL); ?>
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
            <a href="index.php" class="logo"><b>Aplikasi Bank Soal</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <div class="task-info">
                                        <div class="desc">DashGum Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hi mate, how is everything?
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-divya.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Divya Manian</span>
                                    <span class="time">40 mins.</span>
                                    </span>
                                    <span class="message">
                                     Hi, I need your help with this.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-danro.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dan Rogers</span>
                                    <span class="time">2 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Love your new Dashboard.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-sherman.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dj Sherman</span>
                                    <span class="time">4 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Please, answer asap.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
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
              <p class="centered"><a href="index.php"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
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

                    'pertanyaan' => array(
                        'icon'  =>  'fa-mortar-board',
                        'title' =>  'Pertanyaan',
                        'link'  =>  'dashboard-siswa.php'
                        ),
                    
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

              <!-- <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">Marcel Newman</h5>

                  
              	  	
                  <li class="mt">
                      <a class="active" href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>UI Elements</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="general.html">General</a></li>
                          <li><a  href="buttons.html">Buttons</a></li>
                          <li><a  href="panels.html">Panels</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Components</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="calendar.html">Calendar</a></li>
                          <li><a  href="gallery.html">Gallery</a></li>
                          <li><a  href="todo_list.html">Todo List</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Extra Pages</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="blank.html">Blank Page</a></li>
                          <li><a  href="login.html">Login</a></li>
                          <li><a  href="lock_screen.html">Lock Screen</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Forms</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="form_component.html">Form Components</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>Data Tables</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="basic_table.html">Basic Table</a></li>
                          <li><a  href="responsive_table.html">Responsive Table</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Charts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="morris.html">Morris</a></li>
                          <li><a  href="chartjs.html">Chartjs</a></li>
                      </ul>
                  </li>

              </ul> -->
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->