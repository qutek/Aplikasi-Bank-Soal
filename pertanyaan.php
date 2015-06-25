<?php  
include('inc/class.db.php');
is_can_access(array('1','3'));

include('header-siswa.php');

// change it here
$data = array(
    'name' => 'Pertanyaan',
    'base_file' => 'index.php',
    'table' => 'soal',
    'table_hasil' => 'hasil',
    'perpage' => '10',
    'questions_per_tryout' => 20,
    'max_tryout' => 3,
    );

$mapel_id = $_GET['id'];

$insertdb = new Database();
$insertdb->connect();

$success = false;
$soal = array();
$taken = array();
$order  = 'RAND()'; // default

if(isset($_POST['btn-save'])) {

    // rebuild array to get id soal from post 'dipilih_{id_soal}
    // foreach ($_POST as $key => $value) {
    //     $get_id_soal = str_replace('dipilih_', '', $key);
    //     $soal[$get_id_soal] = $value;
    // }
    // check empty jawaban
    $idsoals = explode(',', $_POST['taken']);
    foreach ($idsoals as $key => $idsoal) {
        $soal[$idsoal] = (isset($_POST['dipilih_'.$idsoal])) ? $_POST['dipilih_'.$idsoal] : 'x';
    }

    // echo "<pre>";
    // print_r($soal);
    // echo "</pre>";
    // exit();

    // looping for insert to table
    foreach ($soal as $id => $jaw) { 
        $id_user = $insertdb->escapeString($_POST['id_user']); // Escape any input before insert
        $tryout = $insertdb->escapeString($_POST['tryout']); // Escape any input before insert
        $id_soal = $insertdb->escapeString($id);
        $jawaban = $insertdb->escapeString($jaw);

        if($id != 'id_user' && $id != 'btn-save'){
            $insertdb->insert($data['table_hasil'], array('id_user'=>$id_user, 'tryout'=> $tryout, 'id_soal'=> $id_soal, 'jawaban'=> $jawaban));
        }

        $res = $insertdb->getResult();
        // echo $res[0].'<br>';

        if(!empty($res[0]) && is_int($res[0])){
            $success = true;
            $order  = 'FIELD (id, '.$_POST['taken'].')';
        }
    }
}

if(isset($_POST['btn-next'])) { // next soal
    $taken = $insertdb->escapeString($_POST['taken']);
    // echo $taken;
    // $filter .= ' AND soal.id NOT IN ('.$taken.')';
}

$db = new Database();
$db->connect();

// find max of tryout taken by user
$db->sql('SELECT MAX(tryout) AS tryout FROM '.$data['table_hasil'].' WHERE id_user = '.$_SESSION['id_user']);
$latest = list_pluck($db->getResult(), 'tryout');
$tryout = (isset($latest[0])) ? $latest[0]+1 : 1;
// echo $tryout;
// print_r($_POST); exit();
if( ($tryout > 1) && !isset($_POST['btn-save']) || ($tryout > 1) && isset($_POST['btn-next']) ){

    $db->sql('SELECT hasil.id_soal, soal.mapel_id FROM hasil LEFT JOIN soal ON soal.id = hasil.id_soal WHERE hasil.id_user = '.$_SESSION['id_user'].' AND soal.mapel_id = '.$mapel_id);

    $taken = list_pluck($db->getResult(),'id_soal');
    // $i=0;
    // foreach ($get_ids as $key => $value) {
    //     $taken[] = $value;
    // // $i++;
    // }

    // print_r($taken); exit();

    // $filter .= ' AND soal.id NOT IN ('.implode(',', $taken).')';
}
            
// select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)

$kelas = (isset($_SESSION['kelas'])) ? $_SESSION['kelas'] : false;
$filter = ($kelas != false) ? ' AND soal.kelas_id='.$kelas : '';

$not_in = (!empty($taken) && is_array($taken)) ? ' WHERE hasil.id_user = '.$_SESSION['id_user'].' AND hasil.id_soal NOT IN ('.implode(',', $taken).') ' : ' WHERE soal.mapel_id = '.$mapel_id;              
$db->sql('SELECT hasil.id_soal, hasil.id_user, soal.* FROM soal LEFT JOIN hasil ON hasil.id_soal = soal.id '.$not_in.$filter. ' ORDER BY ' . $order . ' LIMIT ' . $data['perpage']);
// $db->select($data['table'], '*', '', 'mapel_id='.$mapel_id.$filter.$not_in, $order, $data['perpage']);
$res = $db->getResult();
// print_r($db->getSql()); exit();
$get = list_pluck($res,'id');
$i=0;
foreach ($get as $key => $value) {
    $taken[$i] = $value;
$i++;
}

$next_questions = (count($taken) >= $data['questions_per_tryout']) ? false : true;
// echo $_SESSION['kelas'];

?>



      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content-pertanyaan">
          <section class="wrapper">
          	<?php
            if(!empty($res) && $tryout <= $data['max_tryout']){

                $db->sql('SELECT hasil.id_soal, hasil.id_user, soal.mapel_id FROM soal LEFT JOIN hasil ON hasil.id_soal = soal.id '.$not_in);
                $mapels = $db->getResult();
                // echo $db->getSql(); exit();

                // if(empty($mapels) && !isset($_POST['btn-next'])){
                // 	echo '<script language="javascript">alert("Anda tdak diperkenankan mengakses halaman ini!"); document.location="dashboard-siswa.php";</script>';
                // }

                if(!empty($mapels[0]['mapel_id'])){ 

                    // if questions page
                    if(!isset($_POST['btn-save']) ){ ?>
                        <h3>
                            <i class="fa fa-mortar-board" style="margin-right:5px;"></i> Pertanyaan <?php echo get_mapel_name($mapels[0]['mapel_id']) .' ( Tryout : '.$tryout.' )'; ?>
                            <a class="pull-right btn btn-success" href="dashboard-siswa.php"><i class="fa fa-arrow-left"></i> Kembali ke Dashboard</a>
                        </h3>
                    <?php }

                } ?>

                <?php if($success){ ?>
                    <div class="alert alert-success text-center" style="margin-top: 10px;">
                        <h4>Jawaban berhasil disimpan !</h4>
                        <p>Berikut ini detail jawaban anda.</p>
                    </div>
                <?php } ?>
                <form method="post">
                <div class="row mt mb">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                    <input type="hidden" name="tryout" value="<?php echo $tryout; ?>">
                    <!-- Pertanyaan -->
                    <?php  
                    /**************************************
                    * Get data soal.
                    ***************************************/
                    $taken = (is_array($taken)) ? implode(',', $taken) : $taken;
                    echo '<input type="hidden" name="taken" value="'.$taken.'">'; // store taken soal id
	                $i = 1;
	                foreach($res as $pertanyaan){
                    $id = $pertanyaan['id'];
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
	                                    <li class="list-primary <?php is_benar($pertanyaan['jawaban_benar'], 'a', $success); ?>">
	                                        <i class=" fa fa-ellipsis-v"></i>
	                                        <div class="task-checkbox">
	                                            <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $id; ?>" value="a">
	                                        </div>
	                                        <div class="task-title">
	                                          <span class="task-title-sp"><?php echo $pertanyaan['jawaban_a']; ?></span>
	                                          <span class="badge bg-theme badge-dipilih <?php echo is_dipilih($soal[$id], 'a'); ?>">Dipilih</span>
	                                        </div>
	                                    </li>
	                                    <li class="list-primary <?php is_benar($pertanyaan['jawaban_benar'], 'b', $success); ?>">
	                                        <i class=" fa fa-ellipsis-v"></i>
	                                        <div class="task-checkbox">
	                                            <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $id; ?>" value="b">
	                                        </div>
	                                        <div class="task-title">
	                                          <span class="task-title-sp"><?php echo $pertanyaan['jawaban_b']; ?></span>
	                                          <span class="badge bg-theme badge-dipilih <?php echo is_dipilih($soal[$id], 'b'); ?>">Dipilih</span>
	                                        </div>
	                                    </li>
	                                    <li class="list-primary <?php is_benar($pertanyaan['jawaban_benar'], 'c', $success); ?>">
	                                        <i class=" fa fa-ellipsis-v"></i>
	                                        <div class="task-checkbox">
	                                            <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $id; ?>" value="c">
	                                        </div>
	                                        <div class="task-title">
	                                          <span class="task-title-sp"><?php echo $pertanyaan['jawaban_c']; ?></span>
	                                          <span class="badge bg-theme badge-dipilih <?php echo is_dipilih($soal[$id], 'c'); ?>">Dipilih</span>
	                                        </div>
	                                    </li>
	                                    <li class="list-primary <?php is_benar($pertanyaan['jawaban_benar'], 'd', $success); ?>">
	                                        <i class=" fa fa-ellipsis-v"></i>
	                                        <div class="task-checkbox">
	                                            <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $id; ?>" value="d">
	                                        </div>
	                                        <div class="task-title">
	                                          <span class="task-title-sp"><?php echo $pertanyaan['jawaban_d']; ?></span>
	                                          <span class="badge bg-theme badge-dipilih <?php echo is_dipilih($soal[$id], 'd'); ?>">Dipilih</span>
	                                        </div>
	                                    </li>
	                              </ul>
	                          </div>
	                        </div>
	                    </section>
	                </div><!--/col-md-6  -->
	                <?php } ?>
            </div><!-- /row pertanyaan-->
            <?php 
            } else { ?>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel panel-submit text-center">
                      <h1 class="text-center">Maaf, soal belum tersedia</h1>
                    </div><!-- /form-panel -->
                </div><!-- /col-lg-12 -->
            </div>
            <?php } 
            if($tryout <= $data['max_tryout']){
                if(!$success && !empty($res) && $_SESSION['level'] == '3') { ?>
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel panel-submit">
                          <button type="submit" class="btn btn-primary btn-lg" name="btn-save">Simpan Jawaban</button>
                        </div><!-- /form-panel -->
                    </div><!-- /col-lg-12 -->
                </div>
                <?php } else if (!empty($res) && $next_questions) { // button next ?>
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel panel-submit text-right">
                          <button type="submit" class="btn btn-success btn-lg" name="btn-next">Pertanyaan Selanjutnya</button>
                        </div><!-- /form-panel -->
                    </div><!-- /col-lg-12 -->
                </div>
                <?php } 
            }
            ?>
            </form>

        </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->

<!--main content end-->
<?php  
include('footer-siswa.php');
?>