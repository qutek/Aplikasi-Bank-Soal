<?php  
include('inc/class.db.php');
is_can_access(array('1','3'));

include('header-siswa.php');

$kelas = (isset($_SESSION['kelas'])) ? $_SESSION['kelas'] : false;
$filter = ($kelas != false) ? ' AND soal.kelas_id='.$kelas : '';

// change it here
$data = array(
    'name' => 'Pertanyaan',
    'base_file' => 'index.php',
    'table' => 'soal',
    'table_hasil' => 'hasil',
    'perpage' => '10',
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
    foreach ($_POST as $key => $value) {
        $get_id_soal = str_replace('dipilih_', '', $key);
        $soal[$get_id_soal] = $value;
    }

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

        if(!empty($res[0]) && is_int($res[0])){
            $success = true;
            $order  = 'FIELD (id, '.$_POST['taken'].')';
        }
    }
}

if(isset($_POST['btn-next'])) { // next soal
    $taken = $insertdb->escapeString($_POST['taken']);
    // echo $taken;
    $filter .= ' AND soal.id NOT IN ('.$taken.')';
}

?>



      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content-pertanyaan">
          <section class="wrapper">
          	<?php
            $db = new Database();
            $db->connect();

            $db->select('mapel', 'soal.*', 'soal', 'soal.mapel_id='.$mapel_id.$filter.' GROUP BY soal.id');
            $mapels = $db->getResult();

            if(empty($mapels) && !isset($_POST['btn-next'])){
            	echo '<script language="javascript">alert("Anda tdak diperkenankan mengakses halaman ini!"); document.location="dashboard-siswa.php";</script>';
            }

            if(!empty($mapels[0]['mapel_id'])){ ?>
            <h3>
                <i class="fa fa-mortar-board" style="margin-right:5px;"></i> Pertanyaan <?php echo get_mapel_name($mapels[0]['mapel_id']); ?>
                <a class="pull-right btn btn-success" href="dashboard-siswa.php"><i class="fa fa-arrow-left"></i> Kembali ke Dashboard</a>
            </h3>
            <?php } ?>

            <?php if($success){ ?>
                <div class='alert alert-success text-center'>
                    <h4>Jawaban berhasil disimpan !</h4>
                    <p>Berikut ini detail jawaban anda.</p>
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

                // select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)
                $db->select($data['table'], '*', '', 'mapel_id='.$mapel_id.$filter, $order, $data['perpage']);
                $res = $db->getResult();

                $get = list_pluck($res,'id');
                foreach ($get as $key => $value) {
                    $taken[] = $value;
                }

                // echo $db->getSql();

                if(!empty($res)){
                    echo '<input type="hidden" name="taken" value="'.implode(',', $taken).'">'; // store taken soal id
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
	                <?php } 
	               	} else { ?>
	               	<div class="row mt">
		                <div class="col-lg-12">
		                    <div class="form-panel panel-submit text-center">
		                      <h1 class="text-center">Maaf, soal belum tersedia</h1>
		                    </div><!-- /form-panel -->
		                </div><!-- /col-lg-12 -->
		            </div>
	               	<?php } ?>
            </div><!-- /row pertanyaan-->
            <?php if(!$success && !empty($res) && $_SESSION['level'] == '3') { ?>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel panel-submit">
                      <button type="submit" class="btn btn-primary btn-lg" name="btn-save">Simpan Jawaban</button>
                    </div><!-- /form-panel -->
                </div><!-- /col-lg-12 -->
            </div>
            <?php } else if (!empty($res)) { // button next ?>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel panel-submit text-right">
                      <button type="submit" class="btn btn-success btn-lg" name="btn-next">Pertanyaan Selanjutnya</button>
                    </div><!-- /form-panel -->
                </div><!-- /col-lg-12 -->
            </div>
            <?php } ?>
            </form>

        </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->

<!--main content end-->
<?php  
include('footer-siswa.php');
?>