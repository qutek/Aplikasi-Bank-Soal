<?php
include('inc/class.db.php');
is_can_access(array('1','2'));

include('header.php');

// change it here
$data = array(
    'name' => 'Nilai',
    'base_file' => 'nilai.php',
    'table' => 'hasil',
    'perpage' => '10',
    );

$db = new Database();
$db->connect();
?>


      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
            <?php 
            switch ($_GET['act']) {

                case 'lihat':
                    /**************************************
                    * View detail data page view goes here, display the edit form.
                    ***************************************/

                    // $query = 'select hasil.id, hasil.id_user, soal.mapel_id, soal.kelas_id, soal.jawaban_benar, hasil.jawaban, SUM(IF(soal.jawaban_benar=hasil.jawaban,10,0)) total_nilai from hasil join soal on soal.id = hasil.id_soal
                    //           where soal.kelas_id='.$db->escapeString($_GET['cl_id']);
                    // $query = 'select h.id_user, s.mapel_id, s.kelas_id, count(id_soal) jml_jwbn, SUM(IF(s.jawaban_benar=h.jawaban,1,0)) jml_jwbn_bnr 
                    //             from hasil h inner join (select id, mapel_id,kelas_id, jawaban_benar from soal) s 
                    //             on s.id = h.id_soal
                    //             where s.kelas_id='.$db->escapeString($_GET['cl_id']).' and s.mapel_id='.$db->escapeString($_GET['mapel']).'
                    //             group by h.id_user';
                    
                    $query = 'SELECT u.nama, u.kelas_id, h.* FROM users u LEFT JOIN
                                ( SELECT  
                                  id_user, soal.mapel_id,
                                  GROUP_CONCAT(if(tryout = "1", (case when (jawaban = jawaban_benar) THEN 10 ELSE 0 END), NULL)) AS satu, 
                                  GROUP_CONCAT(if(tryout = "2", (case when (jawaban = jawaban_benar) THEN 10 ELSE 0 END), NULL)) AS dua,
                                  GROUP_CONCAT(if(tryout = "3", (case when (jawaban = jawaban_benar) THEN 10 ELSE 0 END), NULL)) AS tiga
                                FROM hasil INNER JOIN soal on soal.id = hasil.id_soal
                                GROUP BY id_user ) h
                                ON u.id = h.id_user
                                WHERE kelas_id = '.$db->escapeString($_GET['cl_id']).' AND mapel_id = '.$db->escapeString($_GET['mapel']);

                    $db->sql($query);

                    $pages = new Pagination($data['perpage'],'hal');
                    $pages->set_total($db->numRows()); // pass number of rows to use on pagination
                    $db->sql($query.' limit '.$pages->get_limit());

                    $res = $db->getResult();

                    // echo "<pre>";
                    // print_r($res);
                    // echo "</pre>";
                    ?>
                    <section class="wrapper">
                        <h3><i class="fa fa-puzzle-piece"></i>Detail <?php echo $data['name'].' '.get_mapel_name( $db->escapeString($_GET['mapel']) ); ?> Kelas <?php echo get_kelas_name($db->escapeString($_GET['cl_id'])); ?></h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content-panel content-table">
                                    <!-- <a href="?act=tambah" class="btn btn-large btn-info button-add"><i class="glyphicon glyphicon-plus"></i> &nbsp; Tambah <?php echo $data['name']; ?></a> -->
                                    <hr>
                                    <table class='table table-striped table-advance table-hover'>
                                        <tr>
                                           <th class="no">No.</th>
                                           <th>Nama</th>
                                           <th>Tryout 1</th>
                                           <th>Tryout 2</th>
                                           <th>Tryout 3</th>
                                           <th>Nilai Rata Rata</th>
                                           <th>Detail</th>
                                        </tr>
                                        <?php 
                                        if(is_array($res) && !empty($res[0]['id_user'])){
                                            $i = 1;
                                            foreach($res as $key => $nilai){
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $nilai['nama']; ?></td>
                                                <td><?php echo get_rata_rata($nilai['satu']); ?></td>
                                                <td><?php echo get_rata_rata($nilai['dua']); ?></td>
                                                <td><?php echo get_rata_rata($nilai['tiga']); ?></td>
                                                <td class="bold"><?php echo get_total(array(get_rata_rata($nilai['satu']), get_rata_rata($nilai['dua']), get_rata_rata($nilai['tiga']) ) ); ?></td>
                                                <td><a href="nilai.php?cl_id=<?php echo $_GET['cl_id']; ?>&act=detail&mapel=<?php echo $_GET['mapel']; ?>&userid=<?php echo $nilai['id_user']; ?>" title="Lihat Detail" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a></td>
                                            </tr>
                                            <?php 
                                            $i++;
                                            }
                                        }
                                        ?>
                                    </table>

                                    <?php echo $pages->page_links(); ?>
                                    
                                </div><! --/content-panel -->
                            </div><!-- /col-md-12 -->
                        </div><!-- row -->
                    </section>
                    <?php

                    break;

                case 'detail':
                    ?>
                    <section class="wrapper">
                        <div class="row">
                    <?php

                    $tryouts = get_taken_tryout($_GET['userid'], $_GET['mapel'], $_GET['cl_id']);
                            foreach ($tryouts as $key => $tryout) {

                            $query = 'SELECT soal, jawaban, jawaban_benar, 
                              (case when (jawaban = jawaban_benar) THEN 10 ELSE 0 END) nilai 
                              FROM hasil INNER JOIN soal on soal.id = hasil.id_soal
                              WHERE mapel_id = '.$db->escapeString($_GET['mapel']).' AND kelas_id = '.$db->escapeString($_GET['cl_id']).' AND id_user = '.$db->escapeString($_GET['userid']).' AND tryout = '.$tryout;

                              $db->sql($query);

                              $res = $db->getResult();

                              ?>
                              <div class="col-md-6">
                                <div class="content-table">
                                    <h3>Tryout <?php echo $tryout; ?>
                                        <a class="pull-right print" href=""><i class="fa fa-print"></i></a>
                                    </h3>
                                    <hr>
                                    <table id="tryout_<?php echo $tryout; ?>" class='table table-striped table-advance table-hover'>
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
                                            <tr class="sum">
                                                <td colspan="4" style="text-align:left;font-weight: bold;font-size: 14px; background-color:#D5D5D5;">Jumlah Nilai</td>
                                                <td style="font-weight: bold;font-size: 14px; background-color:#D5D5D5;"><?php echo round(array_sum(list_pluck($res , 'nilai')) * 10 / count($res), 2); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                    
                                </div><! --/content-panel -->
                            </div><!-- /col-md-12 -->
                            <?php
                    }
                    ?>
                     </div><!-- row -->
                    </section>
                    <?php


                    break;
                    
                default:

                    /**************************************
                    * Default page view goes here, display the data.
                    ***************************************/

                    $query = 'select kelas_id, mapel_id, count(h.id_user) jml from soal s inner join (select id_soal, id_user from hasil group by id_user) h on h.id_soal = s.id
                              where s.kelas_id ='.$db->escapeString($_GET['cl_id']);
                    if(!empty($_POST['mapel'])){
                        $query .= ' and s.mapel_id='.$db->escapeString($_POST['mapel']);
                    }

                    $query .= ' group by mapel_id';

                    $db->sql($query);

                    $pages = new Pagination($data['perpage'],'hal');
                    $pages->set_total($db->numRows()); // pass number of rows to use on pagination
                    $db->sql($query.' limit '.$pages->get_limit());

                    $res = $db->getResult();

                    // echo "<pre>";
                    // print_r($res);
                    // echo "</pre>";
                    // echo $db->getSql();
                    ?>
                    <section class="wrapper">
                        <h3><i class="fa fa-puzzle-piece"></i>Daftar <?php echo $data['name']; ?></h3>
                        <div class="row">
                              <div class="col-md-12">
                                  <div class="content-panel content-table">
                                    <div class="action-button pull-left">
                                        <form class="form-inline" role="form" method="post" action=""> 
                                            <select class="form-control" name="mapel">
                                                <option value="">Mapel</option>
                                                <?php  
                                                $mapel = get_mapel();
                                                foreach ($mapel as $key => $mapel) { ?>
                                                    <option value="<?php echo $mapel['id']; ?>"><?php echo $mapel['mapel']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <button type="submit" class="btn btn-theme04">Pilih</button>
                                        </form>
                                    </div>
                                <!-- <a href="?act=tambah" class="btn btn-large btn-info button-add"><i class="glyphicon glyphicon-plus"></i> &nbsp; Tambah <?php echo $data['name']; ?></a> -->
                                <hr>
                                <table class='table table-striped table-advance table-hover'>
                                    <tr>
                                       <th class="no">No.</th>
                                       <th>Kelas</th>
                                       <th>Mapel</th>
                                       <th>Jumlah Siswa</th>
                                       <th class="action" align="center">Actions</th>
                                    </tr>
                                    <?php 
                                    if(is_array($res) && @$res[0]['jml'] > 0){
                                        $i = 1;
                                        foreach($res as $nilai){
                                            ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo get_kelas_name($nilai['kelas_id']); ?></td>
                                            <td><?php echo get_mapel_name($nilai['mapel_id']); ?></td>
                                            <td><?php echo $nilai['jml']; ?> Siswa</td>
                                            <td>
                                                <a href="<?php echo $data['base_file']; ?>?cl_id=<?php echo $_GET['cl_id']; ?>&act=lihat&mapel=<?php echo $nilai['mapel_id']; ?>" title="Lihat Detail <?php echo $data['name']; ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                        $i++;
                                        }
                                    }
                                    ?>
                                </table>

                                <?php echo $pages->page_links(); ?>
                                    
                                  </div><! --/content-panel -->
                              </div><!-- /col-md-12 -->
                        </div><!-- row -->
                    </section>
                    <?php
                    break;
            }
            ?>
      </section>

      <script>
      $('.print').on('click', function(e){
        e.preventDefault();
        var table = $(this).closest('.content-table').find('.table-striped').attr('id');
        $("#"+table).print();
      })
      </script>

      <!--main content end-->

<?php 
$db->disconnect();
include('footer.php'); ?>