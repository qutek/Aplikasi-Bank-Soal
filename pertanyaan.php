<?php  
include('inc/class.db.php');
is_can_access(array('1','2', '3'));

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
include('header-siswa.php');

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

            $db->select('mapel', 'mapel', 'soal', 'soal.mapel_id='.$mapel_id.$filter);
            $mapels = is_array($db->getResult()) ? $db->getResult() : array();
            if(empty($mapels)){
            	echo '<script language="javascript">alert("Anda tdak diperkenankan mengakses halaman ini!"); document.location="dashboard-siswa.php";</script>';
            }

            $mapel = (null != $mapel_id) ? $mapels[0]['mapel'] : '';
          	?>
            <h3><i class="fa fa-mortar-board" style="margin-right:5px;"></i> Pertanyaan <?php echo $mapel; ?></h3>
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

                // select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)
                $db->select($data['table'], '*', '', 'mapel_id='.$mapel_id.$filter, 'RAND()', $data['perpage']);
                $res = is_array($db->getResult()) ? $db->getResult() : array();

                if(!empty($res)){

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
            <?php if(!$success && !empty($res)) { ?>
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
<?php  
include('footer-siswa.php');
?>