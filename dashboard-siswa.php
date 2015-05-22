<?php
include('inc/class.db.php');
is_can_access(array('1','2','3'));

$kelas = (isset($_SESSION['kelas'])) ? $_SESSION['kelas'] : false;

include('header-siswa.php');
$db = new Database();
$db->connect();
?>
        <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content-siswa">
          <section class="wrapper">

            <div class="row">

                <div class="col-lg-12 main-chart">
                    <div class=" text-center title-page">
                        <h1>Silahkan Pilih Mata Pelajaran</h1>
                    </div>
                  
                    <div class="row mtbox">

                        <?php  
                        $filter = ($kelas != false) ? ' AND soal.kelas_id='.$kelas.' GROUP BY mapel.id' : '';
                        $db->select('mapel', 'mapel.id, mapel.mapel', 'soal', 'soal.mapel_id = mapel.id'.$filter);
                        $mapel = $db->getResult();

                        $i = 0;
                        foreach ($mapel as $key => $mapel) { 
                        $offs = ( ($i == 0) || (0 == $i % 5)) ? 'col-md-offset-1' : '';
                        ?>
                        <a href="pertanyaan.php?id=<?php echo $mapel['id']; ?>">
                            <div class="col-md-2 col-sm-2 box0 <?php echo $offs; ?>">
                                <div class="box1">
                                    <span class="li_cloud"></span>
                                    <h3><?php echo $mapel['mapel']; ?></h3>
                                </div>
                                    <p>48 New files were added in your cloud storage.</p>
                            </div>
                        </a>

                        <?php
                        $i++;
                        }
                        ?>
                    
                    </div><!-- /row mt -->  
                  
                </div>    
            </div>    
                      
          </section>
      </section>

      <!--main content end-->
      <?php $notif = true; ?>
<?php
include('footer-siswa.php'); ?>