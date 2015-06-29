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
                                ( SELECT hasil.id_user, soal.mapel_id,
                                GROUP_CONCAT(if(tryout = "1", (case when (jawaban = jawaban_benar) THEN 10 ELSE 0 END), NULL)) AS satu, 
                                GROUP_CONCAT(if(tryout = "2", (case when (jawaban = jawaban_benar) THEN 10 ELSE 0 END), NULL)) AS dua,
                                GROUP_CONCAT(if(tryout = "3", (case when (jawaban = jawaban_benar) THEN 10 ELSE 0 END), NULL)) AS tiga
                                FROM hasil INNER JOIN soal on soal.id = hasil.id_soal) h
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
                    
                default:

                    /**************************************
                    * Default page view goes here, display the data.
                    ***************************************/

                    $query = 'select kelas_id, mapel_id, count(h.id_user) jml from soal s inner join (select id_soal, id_user from hasil group by id_user) h on h.id_soal = s.id
                              where s.kelas_id ='.$db->escapeString($_GET['cl_id']);
                    if(!empty($_POST['mapel'])){
                        $query .= ' and s.mapel_id='.$db->escapeString($_POST['mapel']);
                    }

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
                                    if(is_array($res) && $res[0]['jml'] > 0){
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

      <!--main content end-->

<?php 
$db->disconnect();
include('footer.php'); ?>