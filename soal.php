<?php
include('inc/class.db.php');
is_can_access('1','2');

include('header.php');

// change it here
$data = array(
    'name' => 'Soal',
    'base_file' => 'soal.php',
    'table' => 'soal',
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
                case 'tambah':
                    /**************************************
                    * Add data page view goes here, display the add form.
                    ***************************************/
                    ?>

                    <section class="wrapper">
                    <h3><i class="fa fa-user"></i> Tambah <?php echo $data['name']; ?></h3>
                        <div class="row">

                              <div class="col-md-12">

                              <?php

                                if(isset($_POST['btn-save'])) {

                                    $soal = $db->escapeString($_POST['soal']); // Escape any input before insert
                                    $jawaban_a = $db->escapeString($_POST['jawaban_a']);
                                    $jawaban_b = $db->escapeString($_POST['jawaban_b']);
                                    $jawaban_c = $db->escapeString($_POST['jawaban_c']);
                                    $jawaban_d = $db->escapeString($_POST['jawaban_d']);
                                    $jawaban_benar = $db->escapeString($_POST['jawaban_benar']);

                                    // simple validation
                                    if(empty($soal) || empty($jawaban_a) || empty($jawaban_b) || empty($jawaban_c) || empty($jawaban_d) ){ ?>
                                        <div class="alert alert-warning">
                                            Mohon lengkapi form !
                                        </div>
                                    <?php } else {

                                        $db->insert($data['table'], array('soal'=>$soal, 'jawaban_a'=> $jawaban_a, 'jawaban_b'=> $jawaban_b, 'jawaban_c'=> $jawaban_c, 'jawaban_d'=> $jawaban_d,'jawaban_benar' => $jawaban_benar));  // Table name, column names and respective values
                                        $res = $db->getResult();  

                                        // display notification if success
                                        if (isset($res[0]) && is_integer($res[0])) {
                                            ?>
                                            <div class="alert alert-info">
                                                <?php echo $data['name']; ?> berhasil ditambahkan. | <a href='<?php echo $data['base_file']; ?>'>Kembali ke daftar <?php echo $data['name']; ?></a>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="alert alert-warning">
                                                <?php echo $data['name']; ?> gagal ditambahkan !
                                            </div>
                                            <?php
                                        }
                                    }

                                }
                                ?>

                                <!-- Form goes here, change it here -->
                                  <div class="content-panel">
                                      
                                    <form class="form-add" method='post'>
         
                                        <table class='table table-bordered'>
                                     
                                            <tr>
                                                <td>Soal</td>
                                                <td><input type='text' name='soal' class='form-control' required></td>
                                            </tr>
                                     
                                            <tr>
                                                <td>Jawaban A</td>
                                                <td><input type='text' name='jawaban_a' class='form-control' required></td>
                                            </tr>
                                     
                                            <tr>
                                                <td>Jawaban B</td>
                                                <td><input type='text' name='jawaban_b' class='form-control' required></td>
                                            </tr>
                                     
                                            <tr>
                                                <td>Jawaban C</td>
                                                <td><input type='text' name='jawaban_c' class='form-control' required></td>
                                            </tr>
                                     
                                            <tr>
                                                <td>Jawaban D</td>
                                                <td><input type='text' name='jawaban_d' class='form-control' required></td>
                                            </tr>
                                     
                                            <tr>
                                                <td>Level</td>
                                                <td>
                                                    <select class="form-control" name="level" required>
                                                        <option>Silahkan Pilih Level</option>
                                                        <option value="a">Jawaban A</option>
                                                        <option value="b">Jawaban B</option>
                                                        <option value="c">Jawaban C</option>
                                                        <option value="d">Jawaban D</option>
                                                    </select>
                                                </td>
                                            </tr>
                                     
                                            <tr>
                                                <td colspan="2">
                                                <button type="submit" class="btn btn-primary" name="btn-save">
                                                <span class="glyphicon glyphicon-plus"></span> Tambah <?php echo $data['name']; ?>
                                                </button>  
                                                <a href="<?php echo $data['base_file']; ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Kembali ke daftar <?php echo $data['name']; ?></a>
                                                </td>
                                            </tr>
                                     
                                        </table>
                                    </form>

                                  </div><! --/content-panel -->
                              </div><!-- /col-md-12 -->
                        </div><!-- row -->
                  </section>
                    <?php
                    break;

                case 'edit':
                    /**************************************
                    * Edit data page view goes here, display the edit form.
                    ***************************************/

                    ?>
                    <section class="wrapper">
                    <h3><i class="fa fa-user"></i> Edit <?php echo $data['name']; ?></h3>
                        <div class="row">
                              <div class="col-md-12">

                                <?php

                                if(isset($_POST['btn-update'])) {
                                    $id = $_GET['id'];
                                    $soal = $db->escapeString($_POST['soal']); // Escape any input before insert
                                    $jawaban_a = $db->escapeString($_POST['jawaban_a']);
                                    $jawaban_b = $db->escapeString($_POST['jawaban_b']);
                                    $jawaban_c = $db->escapeString($_POST['jawaban_c']);
                                    $jawaban_d = $db->escapeString($_POST['jawaban_d']);
                                    $jawaban_benar = $db->escapeString($_POST['jawaban_benar']);

                                    if(empty($soal) || empty($jawaban_a) || empty($jawaban_b) || empty($jawaban_c) || empty($jawaban_d) ){ ?>
                                        <div class="alert alert-warning">
                                            Mohon lengkapi form !
                                        </div>
                                     <?php } else {   

                                        $params = array('soal'=>$soal, 'jawaban_a'=> $jawaban_a, 'jawaban_b'=> $jawaban_b, 'jawaban_c'=> $jawaban_c, 'jawaban_d'=> $jawaban_d,'jawaban_benar' => $jawaban_benar);
                                        $db->update($data['table'], $params, "id='".$id."'");
                                        $success = $db->getResult();

                                        // print_r($success); exit();

                                        if($success) {
                                            $msg = "<div class='alert alert-info'>
                                                    ".$data['name']." berhasil diupdate! | <a href='".$data['base_file']."'>Kembali ke daftar ".$data['name']."</a>
                                                    </div>";
                                        } else {
                                            $msg = "<div class='alert alert-warning'>
                                                    ".$data['name']." gagal diupdate !
                                                    </div>";
                                        }

                                        if(isset($msg)) {
                                            echo $msg;
                                        }
                                    } // if not empty input
                                }

                                $db->select($data['table'], '*','','id="'.$_GET['id'].'"');
                                $res = $db->getResult();
                                ?>
                                <!-- Form goes here, change it here -->
                                  <div class="content-panel">
                                      
                                    <form class="form-add" method='post'>
         
                                        <table class='table table-bordered'>
         
                                            <tr>
                                                <td>Soal</td>
                                                <td><input type='text' name='soal' class='form-control' value="<?php echo $res[0]['soal']; ?>" required></td>
                                            </tr>
                                     
                                            <tr>
                                                <td>Jawaban A</td>
                                                <td><input type='text' name='jawaban_a' class='form-control' value="<?php echo $res[0]['jawaban_a']; ?>" required></td>
                                            </tr>
                                     
                                            <tr>
                                                <td>Jawaban B</td>
                                                <td><input type='text' name='jawaban_b' class='form-control' value="<?php echo $res[0]['jawaban_b']; ?>" required></td>
                                            </tr>
                                     
                                            <tr>
                                                <td>Jawaban C</td>
                                                <td><input type='text' name='jawaban_c' class='form-control' value="<?php echo $res[0]['jawaban_c']; ?>" required></td>
                                            </tr>
                                     
                                            <tr>
                                                <td>Jawaban D</td>
                                                <td><input type='text' name='jawaban_d' class='form-control' value="<?php echo $res[0]['jawaban_d']; ?>" required></td>
                                            </tr>
                                     
                                            <tr>
                                                <td>Level</td>
                                                <td>
                                                    <select class="form-control" name="jawaban_benar" required>
                                                        <option>Pilih Jawaban Benar</option>
                                                        <option value="a" <?php check_selected($res[0]['jawaban_benar'], 'jawaban_a'); ?>>Jawaban A</option>
                                                        <option value="b" <?php check_selected($res[0]['jawaban_benar'], 'jawaban_b'); ?>>Jawaban B</option>
                                                        <option value="c" <?php check_selected($res[0]['jawaban_benar'], 'jawaban_c'); ?>>Jawaban C</option>
                                                        <option value="d" <?php check_selected($res[0]['jawaban_benar'], 'jawaban_d'); ?>>Jawaban D</option>
                                                    </select>
                                                </td>
                                            </tr>
                                     
                                            <tr>
                                                <td colspan="2">
                                                    <button type="submit" class="btn btn-primary" name="btn-update">
                                                    <span class="glyphicon glyphicon-edit"></span>  Update data <?php echo $data['name']; ?>
                                                    </button>
                                                    <a href="<?php echo $data['base_file']; ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Batal</a>
                                                </td>
                                            </tr>
                                     
                                        </table>
                                    </form>

                                  </div><! --/content-panel -->
                              </div><!-- /col-md-12 -->
                        </div><!-- row -->
                    </section>
                    <?php



                    break;


                case 'hapus':
                    /**************************************
                    * Delete data page view goes here, display confirmation.
                    ***************************************/
                    
                    ?>
                    <section class="wrapper">
                    <h3><i class="fa fa-user"></i> Edit <?php echo $data['name']; ?></h3>
                        <div class="row">
                            <div class="col-md-12">

                            <?php
                            // default status
                            $deleted = false;

                            if(isset($_POST['btn-del'])) {
                                $id = $_GET['id'];
                                $db->delete($data['table'], "id='".$id."'");
                                $res = $db->getResult();

                                // if deleted set status to true for display alert
                                if($res)
                                    $deleted = true;
                            }


                            if($deleted) {
                                ?>
                                <div class="alert alert-success">
                                <strong>Berhasil!</strong> <?php echo $data['name']; ?> berhasil dihapus.
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-danger">
                                <strong>Anda yakin!</strong> akan menghapus <?php echo $data['name']; ?> berikut ? 
                                </div>
                                <?php
                            }
                            ?>  
                            <!-- Form goes here, change it here -->
                              <div class="content-panel content-table">
                                  
                                <?php
                                 if(isset($_GET['id']) && !$deleted) {
                                     ?>
                                     <table class='table table-bordered'>
                                         <tr>
                                             <th>Soal</th>
                                         </tr>
                                         <tr>
                                             <?php
                                                $db->select($data['table'], '*','','id="'.$_GET['id'].'"');
                                                $res = $db->getResult();
                                             ?>
                                             <td><?php echo $res[0]['soal']; ?></td>
                                         </tr>
                                     </table>
                                     <?php
                                 }
                                 ?>


                                <?php
                                if(isset($_GET['id']) && !$deleted) {
                                    ?>
                                    <form class="form-add" method="post">
                                    <input type="hidden" name="id" value="<?php echo $res[0]['id']; ?>" />
                                    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; Ya, hapus</button>
                                    <a href="<?php echo $data['base_file']; ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Tidak, kembali</a>
                                    </form>  
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <a href="<?php echo $data['base_file']; ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Kembali ke daftar <?php echo $data['name']; ?></a>
                                    <?php
                                }
                                ?>

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
                    $db->sql("SELECT id FROM ".$data['table']);

                    $pages = new Pagination($data['perpage'],'hal');
                    $pages->set_total($db->numRows()); // pass number of rows to use on pagination

                    $db->sql("SELECT * FROM ".$data['table']." ".$pages->get_limit() );
                    $res = $db->getResult();
                    ?>
                    <section class="wrapper">
                        <h3><i class="fa fa-user"></i> Daftar <?php echo $data['name']; ?></h3>
                        <div class="row">
                              <div class="col-md-12">
                                  <div class="content-panel content-table">
                                <a href="?act=tambah" class="btn btn-large btn-info button-add"><i class="glyphicon glyphicon-plus"></i> &nbsp; Tambah <?php echo $data['name']; ?></a>
                                <hr>
                                <table class='table table-striped table-advance table-hover'>
                                    <tr>
                                       <th class="no">No.</th>
                                       <th>Soal</th>
                                       <th class="action" align="center">Actions</th>
                                    </tr>
                                    <?php 
                                    $i = 1;
                                    foreach($res as $user){ ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $user['soal']; ?></td>
                                        <td>
                                            <a href="<?php echo $data['base_file']; ?>?act=edit&id=<?php echo $user['id']; ?>" title="Edit <?php echo $data['name']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo $data['base_file']; ?>?act=hapus&id=<?php echo $user['id']; ?>" title="Hapus <?php echo $data['name']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                    $i++;
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
$db->connect();
include('footer.php'); ?>