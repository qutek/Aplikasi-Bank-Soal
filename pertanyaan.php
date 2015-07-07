<?php  
error_reporting(0);
$start = $_SESSION['time_start'];
include('inc/class.db.php');
is_can_access(array('3'));

include('header-siswa.php');

// change it here
$data = array(
    'name' => 'Pertanyaan',
    'base_file' => 'index.php',
    'table' => 'soal',
    'table_hasil' => 'hasil',
    'perpage' => '20',
    'questions_per_tryout' => 20,
    'max_tryout' => 3,
    );

$mapel_id = $_GET['id'];
$id_user = $_SESSION['id_user'];
$id_kelas = (isset($_SESSION['kelas'])) ? $_SESSION['kelas'] : 0;

$review = false;

$db = new Database();
$db->connect();

if(!isset($mapel_id))
    die();

if(isset($_POST['btn-save'])) {
    // $review = true;

    // check empty jawaban
    $idsoals = explode(',', $_POST['taken']);
    $jawabans = array();
    if(!empty($idsoals) && is_array($idsoals)){
        foreach ($idsoals as $key => $idsoal) {
            $jawabans[$idsoal] = (isset($_POST['dipilih_'.$idsoal])) ? $_POST['dipilih_'.$idsoal] : 'x';
        }
    }

    // echo "<pre>";
    // print_r($jawabans);
    // echo "</pre>";

    // looping for insert to table
    foreach ($jawabans as $id => $jaw) { 
        $tryout = $db->escapeString($_POST['tryout']); // Escape any input before insert
        $id_soal = $db->escapeString($id);
        $jawaban = $db->escapeString($jaw);

        if($id != 'id_user' && $id != 'btn-save'){
            // $db->update($data['table_hasil'], array('tryout'=> $tryout, 'jawaban'=> $jawaban), 'id_soal='.$id_soal);
            $db->sql("UPDATE hasil SET tryout='".$tryout."',jawaban='".$jawaban."' WHERE id_soal=".$id_soal);
        }
        // $inserted = $db->getResult();
        // // echo $db->getSql();
        // // var_dump($inserted);

        // if(!empty($inserted[0]) && is_int($inserted[0])){
        //     $review = true;
        //     $order  = 'FIELD (id, '.$_POST['taken'].')';
        // }
    }
    // header ('Location: ' . $_SERVER['REQUEST_URI'].'&simpan');

    // echo "<pre>";
    // print_r($jawaban);
    // echo "</pre>";
    // exit();
}

$not_complete = is_not_complete($id_user, $id_kelas, $mapel_id);
if($not_complete){

    $query = 'SELECT * FROM '.$data['table'].' soal
        WHERE id IN (SELECT id_soal FROM '.$data['table_hasil'].' WHERE id_user = '.$id_user.'  AND tryout = 0 )
        AND mapel_id = '.$mapel_id.' AND kelas_id = '.$id_kelas.'
        LIMIT '.$data['perpage'];

} else {
    if($review || isset($_POST['btn-save'])){
        $review = true;
        // get soal 
        $query = 'SELECT * FROM '.$data['table'].' soal
                WHERE id IN (SELECT id_soal FROM '.$data['table_hasil'].' WHERE id_user = '.$id_user.'  AND id_soal IN ('.$_POST['taken'].') )
                AND mapel_id = '.$mapel_id.' AND kelas_id = '.$id_kelas.'
                ORDER BY FIELD (id, '.$_POST['taken'].') LIMIT '.$data['perpage'];
    } else {
        
            // get soal that have not taken
            $query = 'SELECT * FROM '.$data['table'].' soal
                WHERE id NOT IN (SELECT id_soal FROM '.$data['table_hasil'].' WHERE id_user = '.$id_user.')
                AND mapel_id = '.$mapel_id.' AND kelas_id = '.$id_kelas.'
                ORDER BY RAND() LIMIT '.$data['perpage'];
    }
}

$is_post = (!empty($_POST['tryout'])) ? true : false;
$tryout = get_latest_tryout($id_user, $mapel_id, $id_kelas, $data['questions_per_tryout'], $is_post);
// echo "<pre>";
// print_r($query);
// echo "</pre>";
$db->sql($query);
$soals = $db->getResult();
$taken = list_pluck($soals,'id');
$is_disabled = ($review) ? 'disabled="disabled"' : '';
// $jawaban = array('id' => 'a');
// echo "<pre>";
// print_r($soals);
// echo "</pre>";



?>
<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
    <section id="main-content-pertanyaan">
        <section class="wrapper">
            <?php  
            if($tryout == -1){ 
                unset($_SESSION['time_start']);
                ?>
                <div class="not-found" style="margin-top:50px;">
                    <h1>Terima kasih</h1>
                    <p>Kembali ke <a href="dashboard-siswa.php">dashboard</a></p>
                </div>
            <?php } else if($tryout >= $data['max_tryout']){ 
                unset($_SESSION['time_start']);
                ?>
                <div class="not-found" style="margin-top:50px;">
                    <h1>Tryout anda telah selesai</h1>
                </div>
            <?php } else {
                if(!$review && !empty($soals)){
            ?>  
                <h3>
                    <i class="fa fa-mortar-board" style="margin-right:5px;"></i> Pertanyaan <?php echo get_mapel_name($soals[0]['mapel_id']) .' ( Tryout : '.$tryout.' )'; ?>
                    <!-- <a class="pull-right btn btn-success" href="dashboard-siswa.php"><i class="fa fa-arrow-left"></i> Kembali ke Dashboard</a> -->
                    <?php
                    date_default_timezone_set('Asia/Jakarta');

                    if(!$not_complete && !isset($_POST['btn-save'])){
                        $_SESSION['time_start'] = date('Y-m-d h:i:s');
                    }

                    $start = (isset($_SESSION['time_start'])) ? $_SESSION['time_start'] : date('Y-m-d h:i:s');

                    $currentDate = strtotime($start);
                    $futureDate = $currentDate+(60*30);
                    $formatDate = date(DATE_ISO8601, $futureDate);

                    ?>
                    <div class="pull-right timer" datetime="<?php echo $formatDate; ?>"></div>
                </h3>
            <?php } ?>

                <form method="post">
                   <div class="row mt mb">
                        <input type="hidden" name="tryout" value="<?php echo $tryout; ?>">
                        <input type="hidden" name="taken" value="<?php echo implode(',', $taken); ?>">
                        <!-- Pertanyaan -->
                        <?php  
                        if(is_array($soals)){
                        $i=1;
                        echo '<div class="row">';
                        foreach ($soals as $key => $pertanyaan) { 
                        $id = $pertanyaan['id'];
                        // langsung insert default jawaban
                        if(!$not_complete && !isset($_POST['btn-save'])){
                            $db->insert($data['table_hasil'], array('id_user'=>$id_user, 'tryout'=> '0', 'id_soal'=> $pertanyaan['id'], 'jawaban'=> 'x'));
                        }
                        // if($i % 2 === 0){
                        //     echo '<div class="row">';
                        // }
                        ?>                 
                        <div class="col-md-6">
                            <section class="task-panel tasks-widget">
                                <div class="panel-heading">
                                   <div class="pull-left">
                                      <h5 class="pertanyaan">
                                         <?php echo $i.'. '; ?>
                                         <?php echo $pertanyaan['soal']; ?>
                                      </h5>
                                   </div>
                                   <br>
                                </div>
                                <div class="panel-body">
                                   <div class="task-content">
                                        <ul id="sortable" class="task-list">
                                            <li class="list-primary <?php is_benar($pertanyaan['jawaban_benar'], 'a', $review); ?>">
                                                <i class=" fa fa-ellipsis-v"></i>
                                                <div class="task-checkbox">
                                                    <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $id; ?>" value="a" <?php echo $is_disabled; ?>>
                                                </div>
                                                <div class="task-title">
                                                  <span class="task-title-sp"><?php echo $pertanyaan['jawaban_a']; ?></span>
                                                  <span class="badge bg-theme badge-dipilih <?php echo is_dipilih($jawabans[$id], 'a'); ?>">Dipilih</span>
                                                </div>
                                            </li>
                                            <li class="list-primary <?php is_benar($pertanyaan['jawaban_benar'], 'b', $review); ?>">
                                                <i class=" fa fa-ellipsis-v"></i>
                                                <div class="task-checkbox">
                                                    <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $id; ?>" value="b" <?php echo $is_disabled; ?>>
                                                </div>
                                                <div class="task-title">
                                                  <span class="task-title-sp"><?php echo $pertanyaan['jawaban_b']; ?></span>
                                                  <span class="badge bg-theme badge-dipilih <?php echo is_dipilih($jawabans[$id], 'b'); ?>">Dipilih</span>
                                                </div>
                                            </li>
                                            <li class="list-primary <?php is_benar($pertanyaan['jawaban_benar'], 'c', $review); ?>">
                                                <i class=" fa fa-ellipsis-v"></i>
                                                <div class="task-checkbox">
                                                    <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $id; ?>" value="c" <?php echo $is_disabled; ?>>
                                                </div>
                                                <div class="task-title">
                                                  <span class="task-title-sp"><?php echo $pertanyaan['jawaban_c']; ?></span>
                                                  <span class="badge bg-theme badge-dipilih <?php echo is_dipilih($jawabans[$id], 'c'); ?>">Dipilih</span>
                                                </div>
                                            </li>
                                            <li class="list-primary <?php is_benar($pertanyaan['jawaban_benar'], 'd', $review); ?>">
                                                <i class=" fa fa-ellipsis-v"></i>
                                                <div class="task-checkbox">
                                                    <input type="radio" class="list-child jawaban" name="dipilih_<?php echo $id; ?>" value="d" <?php echo $is_disabled; ?>>
                                                </div>
                                                <div class="task-title">
                                                  <span class="task-title-sp"><?php echo $pertanyaan['jawaban_d']; ?></span>
                                                  <span class="badge bg-theme badge-dipilih <?php echo is_dipilih($jawabans[$id], 'd'); ?>">Dipilih</span>
                                                </div>
                                            </li>
                                      </ul>
                                   </div>
                                </div>
                            </section>
                        </div>
                        <?php
                            if($i % 2 === 0){
                                echo '</div><div class="row">';
                            }
                            $i++;
                            }
                        }
                        ?>
                        <!--/col-md-6  -->
                    </div>

                    <?php if(!$review && !empty($soals)){ ?>
                    <!-- /row pertanyaan-->
                    <div class="row mt">
                      <div class="col-lg-12">
                         <div class="form-panel panel-submit">
                            <button id="submit" type="submit" class="btn btn-primary btn-lg" name="btn-save">Simpan Jawaban</button>
                         </div>
                         <!-- /form-panel -->
                      </div>
                      <!-- /col-lg-12 -->
                    </div>

                    <?php } else if($review) { ?>

                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel panel-submit text-right">
                              <a href="javascript:window.location.href=window.location.href" class="btn btn-success btn-lg">Pertanyaan Selanjutnya</a>
                            </div><!-- /form-panel -->
                        </div><!-- /col-lg-12 -->
                    </div>

                    <?php } else { 
                    unset($_SESSION['time_start']);
                        ?>
                        
                        <div class="not-found">
                            <h1>Maaf, Soal belum tersedia</h1>
                        </div>

                    <?php } ?>

                </form>
        <?php } ?>

        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->
<!--main content end-->
<script>
window.jQuery(function ($) {
    "use strict";

    $('.timer').countDown({
        // with_labels: false,
        with_separators: false,
        label_dd: 'hari',
        label_hh: 'jam',
        label_mm: 'menit',
        label_ss: 'detik',
    }).on('time.elapsed', function () {
        // do something...
        alert('Waktu anda telah habis');
        $('#submit').click();
    });
});
</script>

<?php  
include('footer-siswa.php');
?>