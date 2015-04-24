<?php  
include('inc/class.db.php');
is_can_access('1','2', '3');

// change it here
$data = array(
    'name' => 'Pertanyaan',
    'base_file' => 'index.php',
    'table' => 'soal',
    'table_hasil' => 'hasil',
    'perpage' => '10',
    );

$insertdb = new Database();
$insertdb->connect();

if(isset($_POST['btn-save'])) {

    // rebuild array to get id soal from post 'dipilih_{id_soal}
    $soal = array();
    foreach ($_POST as $key => $value) {
        $get_id_soal = str_replace('dipilih_', '', $key);
        $soal[$get_id_soal] = $value;
    }

    $success = false;

    // looping for insert to table
    foreach ($soal as $id => $jaw) { 
        $id_user = $insertdb->escapeString($_POST['id_user']); // Escape any input before insert
        $id_soal = $insertdb->escapeString($id);
        $jawaban = $insertdb->escapeString($jaw);

        if($id != 'id_user' && $id != 'btn-save'){
            $insertdb->insert($data['table_hasil'], array('id_user'=>$id_user, 'id_soal'=> $id_soal, 'jawaban'=> $jawaban));
        }

        $res = $insertdb->getResult();
        // echo $res[0].'<br>';

        if(is_int($res[0])){
            $success = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <title>Aplikasi Bank Soal</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/to-do.css">

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
        <li><a class="logout" href="login.html">Logout</a></li>
    </ul>
</div>
</header>
<!--header end-->



      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content-pertanyaan">
          <section class="wrapper">
            <h3><i class="fa fa-mortar-board" style="margin-right:5px;"></i> Pertanyaan</h3>
            <?php if($success){ ?>
                <div class='alert alert-success text-center'>
                    <h4>Jawaban berhasil disimpan !</h4>
                </div>
            <?php } ?>
            <form method="post">
            <div class="row mt mb">
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                <!-- Pertanyaan -->
                <?php  
                /**************************************
                * Get data soal.
                ***************************************/
                $db = new Database();
                $db->connect();

                // select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)
                $db->select($data['table'], '*', '', null, 'RAND()', $data['perpage']);
                $res = $db->getResult();

                // echo "<pre>";
                // print_r($res); exit();

                $i = 1;
                foreach($res as $pertanyaan){
                ?>
                <div class="col-md-6"> 
                    <section class="task-panel tasks-widget"> 
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h5 class="pertanyaan">
                                  <i class="fa fa-arrow-circle-o-right" style="margin-right:5px;"></i>  <?php echo $pertanyaan['soal']; ?>
                                </h5>
                            </div>
                            <br>
                        </div>
                        <div class="panel-body">
                            <div class="task-content">
                                <ul id="sortable" class="task-list">
                                    <li class="list-primary">
                                        <i class=" fa fa-ellipsis-v"></i>
                                        <div class="task-checkbox">
                                            <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $pertanyaan['id']; ?>" value="jawaban_a">
                                        </div>
                                        <div class="task-title">
                                          <span class="task-title-sp"><?php echo $pertanyaan['jawaban_a']; ?></span>
                                          <span class="badge bg-theme badge-dipilih">Dipilih</span>
                                        </div>
                                    </li>
                                    <li class="list-primary">
                                        <i class=" fa fa-ellipsis-v"></i>
                                        <div class="task-checkbox">
                                            <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $pertanyaan['id']; ?>" value="jawaban_b">
                                        </div>
                                        <div class="task-title">
                                          <span class="task-title-sp"><?php echo $pertanyaan['jawaban_b']; ?></span>
                                          <span class="badge bg-theme badge-dipilih">Dipilih</span>
                                        </div>
                                    </li>
                                    <li class="list-primary">
                                        <i class=" fa fa-ellipsis-v"></i>
                                        <div class="task-checkbox">
                                            <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $pertanyaan['id']; ?>" value="jawaban_c">
                                        </div>
                                        <div class="task-title">
                                          <span class="task-title-sp"><?php echo $pertanyaan['jawaban_c']; ?></span>
                                          <span class="badge bg-theme badge-dipilih">Dipilih</span>
                                        </div>
                                    </li>
                                    <li class="list-primary">
                                        <i class=" fa fa-ellipsis-v"></i>
                                        <div class="task-checkbox">
                                            <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $pertanyaan['id']; ?>" value="jawaban_d">
                                        </div>
                                        <div class="task-title">
                                          <span class="task-title-sp"><?php echo $pertanyaan['jawaban_d']; ?></span>
                                          <span class="badge bg-theme badge-dipilih">Dipilih</span>
                                        </div>
                                    </li>
                              </ul>
                          </div>
                        </div>
                    </section>
                </div><!--/col-md-6  -->
                <?php } ?>
            </div><!-- /row pertanyaan-->
            <?php if(!$success) { ?>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel panel-submit">
                      <button type="submit" class="btn btn-primary btn-lg" name="btn-save">Submit</button>
                    </div><!-- /form-panel -->
                </div><!-- /col-lg-12 -->
            </div>
            <?php } ?>
            </form>

        </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->

<!--main content end-->
<!--footer start-->
<footer class="site-footer">
  <div class="text-center">
    Aplikasi Bank Soal
      <a href="#" class="go-top">
          <i class="fa fa-angle-up"></i>
      </a>
  </div>
</footer>
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
    $('.list-primary').click(function(){
        $(this).find('.jawaban').attr('checked', 'checked');
    });
    $('.jawaban').each(function( index, elem ) {
      if($(elem).attr("checked", "checked")){
        alert('ok');
      }
    });
</script>



</body>
</html>