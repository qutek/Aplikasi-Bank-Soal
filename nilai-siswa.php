<?php
include('inc/class.db.php');
is_can_access(array('1','3'));

$kelas = (isset($_SESSION['kelas'])) ? $_SESSION['kelas'] : false;

include('header-siswa.php');
$db = new Database();
$db->connect();

$mapel_id = $db->escapeString($_GET['mapel']);
$id_user = $db->escapeString($_SESSION['id_user']);
$nama = $db->escapeString($_SESSION['nama']);
$kelas = $db->escapeString($_SESSION['kelas']);
?>
        <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content-siswa">
          <section class="wrapper wrapper-siswa">
            <div class="row">
              <div class="col-lg-12 mb">
                <!-- WHITE PANEL - TOP USER -->
                <div class="white-panel pn pn-siswa">
                  <div class="white-header">
                    <h2>Laporan Hasil Tryout</h2>
                  </div>
                  <div class="row">
                    <?php
                    /**************************************
                    * View detail data page view goes here, display the edit form.
                    ***************************************/

                    // $query = 'select hasil.id, hasil.id_user, soal.mapel_id, soal.kelas_id, soal.jawaban_benar, hasil.jawaban, SUM(IF(soal.jawaban_benar=hasil.jawaban,10,0)) total_nilai from hasil join soal on soal.id = hasil.id_soal
                    //           where soal.kelas_id='.$db->escapeString($_GET['cl_id']);
                    

                    // echo "<pre>";
                    // print_r(get_taken_tryout($id_user, $mapel_id, $kelas));
                    // echo "</pre>";

                    ?>
                    <section class="wrapper wrapper-nilai">
                        <div class="row">
                            <?php  
                            $tryouts = get_taken_tryout($id_user, $mapel_id, $kelas);
                            foreach ($tryouts as $key => $tryout) {

                              $query = 'SELECT soal, jawaban, jawaban_benar, 
                              (case when (jawaban = jawaban_benar) THEN 10 ELSE 0 END) nilai 
                              FROM hasil INNER JOIN soal on soal.id = hasil.id_soal
                              WHERE mapel_id = '.$mapel_id.' AND kelas_id = '.$kelas.' AND id_user = '.$id_user.' AND tryout = '.$tryout;

                              $db->sql($query);

                              $res = $db->getResult();

                              // echo "<pre>";
                              // print_r($query);
                              // echo "</pre>";
                            ?>
                            <div class="col-md-6">
                                <div class="content-table">
                                    <h3>Tryout <?php echo $tryout; ?></h3>
                                    <hr>
                                    <table class='table table-striped table-advance table-hover'>
                                        <tr>
                                           <th class="no">No.</th>
                                           <th>Soal</th>
                                           <th>Jawaban</th>
                                           <th>Jawaban Benar</th>
                                           <th>Nilai</th>
                                        </tr>
                                        <?php 
                                        if(is_array($res) && !empty($res[0]['soal'])){
                                            $i = 1;
                                            foreach($res as $key => $data){
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $data['soal']; ?></td>
                                                <td><?php echo $data['jawaban']; ?></td>
                                                <td><?php echo $data['jawaban_benar']; ?></td>
                                                <td><?php echo $data['nilai']; ?></td>
                                            </tr>
                                            <?php 
                                            $i++;
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="4" style="text-align:left;font-weight: bold;font-size: 14px;">Jumlah Nilai</td>
                                                <td style="font-weight: bold;font-size: 14px;"><?php echo array_sum(list_pluck($res , 'nilai')); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                    
                                </div><! --/content-panel -->
                            </div><!-- /col-md-12 -->
                            <?php } ?>
                        </div><!-- row -->
                    </section>
                  </div><!-- /row mt -->  
                  <div class="clear-both"></div>
                    
                </div>
              </div>
                 
            </div>    
                 
            </div>    
          </section>
      </section>

      <!--main content end-->
      <?php $notif = true; ?>
<?php
include('footer-siswa.php'); ?>