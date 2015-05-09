<?php
include('inc/class.db.php');
is_can_access('3');

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
                        $db->select('mapel');
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
                        <!-- <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                            <div class="box1">
                                <span class="li_heart"></span>
                                <h3>933</h3>
                            </div>
                                <p>933 People liked your page the last 24hs. Whoohoo!</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="li_cloud"></span>
                                <h3>+48</h3>
                            </div>
                                <p>48 New files were added in your cloud storage.</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="li_stack"></span>
                                <h3>23</h3>
                            </div>
                                <p>You have 23 unread messages in your inbox.</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="li_news"></span>
                                <h3>+10</h3>
                            </div>
                                <p>More than 10 news were added in your reader.</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="li_data"></span>
                                <h3>OK!</h3>
                            </div>
                                <p>Your server is working perfectly. Relax & enjoy.</p>
                        </div> -->
                    
                    </div><!-- /row mt -->  
                  
                      
                      
          </section>
      </section>

      <!--main content end-->
      <?php $notif = true; ?>
<?php
include('footer-siswa.php'); ?>