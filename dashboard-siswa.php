<?php
include('inc/class.db.php');
is_can_access(array('1','3'));

$kelas = (isset($_SESSION['kelas'])) ? $_SESSION['kelas'] : false;

include('header-siswa.php');
$db = new Database();
$db->connect();

$id_user = $db->escapeString($_SESSION['id_user']);
$nama = $db->escapeString($_SESSION['nama']);
$kelas = $db->escapeString($_SESSION['kelas']);
$max_tryout = 3;
?>
        <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content-siswa">
          <section class="wrapper wrapper-siswa">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 mb">
              <div class="content-panel pn panel-tryout">
                <div id="profile-01" class="tryout-lists">
                  <h3><?php echo $nama; ?></h3>
                  <h6>Kelas : <?php echo $kelas; ?></h6>
                </div>
                <?php  
                $query = 'select mapel_id FROM hasil LEFT JOIN soal ON soal.id = hasil.id_soal
                          WHERE hasil.id_user='.$id_user.'
                          GROUP BY mapel_id';
                $db->sql($query);
                $mapels = $db->getResult();

                // echo "<pre>";
                // print_r($mapels);
                // echo "</pre>";
                if(is_array($mapels) && !empty($mapels[0])){
                  foreach ($mapels as $key => $mapel) { ?>
                    <a href="nilai-siswa.php?mapel=<?php echo $mapel['mapel_id']; ?>">
                      <div class="profile-01 centered">
                        <p><?php echo get_mapel_name($mapel['mapel_id']); ?></p>
                      </div>
                    </a>
                <?php
                  }
                }
                ?>
              </div><! --/content-panel -->
            </div><! --/col-md-4 -->

              <div class="col-lg-8 mb">
              <!-- WHITE PANEL - TOP USER -->
              <div class="white-panel pn pn-siswa">
                <div class="white-header">
                  <h5>Tryout Tersedia</h5>
                </div>
                <div class="row mtbox">

                    <?php  
                    $filter = ($kelas != false) ? ' AND soal.kelas_id='.$kelas.' GROUP BY mapel.id' : '';
                    $db->select('mapel', 'mapel.id, mapel.mapel', 'soal', 'soal.mapel_id = mapel.id'.$filter);
                    $mapel = $db->getResult();
                    // echo $db->getSql();

                    $i = 0;
                    foreach ($mapel as $key => $mapel) { 
                    $offs = ( ($i == 0) || (0 == $i % 5)) ? 'col-md-offset-1' : '';
                    $latestTryout = get_latest_tryout($id_user, $mapel['id'], $kelas, $max_tryout);
                    $link = ($latestTryout >= $max_tryout) ? '#' : 'pertanyaan.php?id='.$mapel['id'];
                    ?>
                    <a href="<?php echo $link; ?>">
                        <div class="box-tryout col-md-4 <?php echo $offs; ?>">
                            <div class="box1">
                                <span class="li_cloud"></span>
                                <h3><?php echo $mapel['mapel']; ?></h3>
                            </div>
                                <p><?php echo ($latestTryout >= $max_tryout) ? 'Completed' : 'Soal tersedia'; ?></p>
                        </div>
                    </a>

                    <?php
                    $i++;
                    }
                    ?>
                </div><!-- /row mt -->  
                  <div class="clear-both"></div>
                  
              </div>
            </div>
                 
            </div>    
          </section>
      </section>

      <!--main content end-->
      <?php $notif = true; ?>
<?php
include('footer-siswa.php'); ?>