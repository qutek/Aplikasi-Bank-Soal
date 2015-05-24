<?php
include('inc/class.db.php');
is_can_access(array('1','2','3'));

include('header.php');

// change it here
$data = array(
    'name' => 'Profile',
    'base_file' => 'profile.php',
    'table' => 'users',
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
            <section class="wrapper">
            <h3><i class="fa fa-user"></i> Edit <?php echo $data['name']; ?></h3>
                <div class="row">
                      <div class="col-md-12">

                        <?php

                        if(isset($_POST['btn-update'])) {
                            $id = $db->escapeString($_SESSION['id_user']);
                            $username = $db->escapeString($_POST['username']); // Escape any input before insert
                            $nama = $db->escapeString($_POST['nama']);
                            $password = $db->escapeString($_POST['password']);
                            $level = ( (!empty($_POST['kelas']) ) && $_SESSION['level'] == '3' ) ? '3' : $db->escapeString($_POST['level']);
                            $kelas = ( (!empty($_POST['kelas']) ) && $_SESSION['level'] == '3' ) ? $db->escapeString($_POST['kelas']) : 0;

                            if(empty($username) || empty($nama) || empty($level) ){ ?>
                                <div class="alert alert-warning">
                                    Mohon lengkapi form !
                                </div>
                             <?php } else {   

                                if(!empty($password)){
                                    // update password too
                                    $params = array('username' => $username, 'nama' => $nama, 'password' => md5($password), 'level' => $level, 'kelas_id' => $kelas);
                                } else {
                                    $params = array('username' => $username, 'nama' => $nama, 'level' => $level, 'kelas_id' => $kelas);
                                }
                                $db->update($data['table'], $params, "id='".$id."'");
                                $success = $db->getResult();
                                // echo $db->getSql();

                                // print_r($success); exit();

                                if($success) {
                                    $msg = "<div class='alert alert-info'>
                                            ".$data['name']." berhasil diupdate!
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

                        $db->select($data['table'], '*','','id="'.$db->escapeString($_SESSION['id_user']).'"');
                        $res = $db->getResult();
                        ?>
                        <!-- Form goes here, change it here -->
                          <div class="content-panel">
                              
                            <form class="form-add" method='post'>
 
                                <table class='table table-bordered'>
 
                                    <tr>
                                        <td>ID Pengguna / NIK</td>
                                        <td><input type='text' name='username' class='form-control' value="<?php echo $res[0]['username']; ?>" required></td>
                                    </tr>
                             
                                    <tr>
                                        <td>Nama</td>
                                        <td><input type='text' name='nama' class='form-control' value="<?php echo $res[0]['nama']; ?>" required></td>
                                    </tr>
                             
                                    <tr>
                                        <td>Password</td>
                                        <td><input type='password' name='password' class='form-control' value="" placeholder="Kosongkan jika tidak ingin merubah password"></td>
                                    </tr>

                                    <?php if ( $_SESSION['level'] != '3' ) { // if not siswa ?>
                                    <tr>
                                        <td>Level</td>
                                        <td>
                                            <select id="level" class="form-control" name="level" required>
                                                <option value="">Silahkan Pilih Level</option>
                                                <option value="1" <?php check_selected($res[0]['level'], 1); ?> >Administator</option>
                                                <option value="2" <?php check_selected($res[0]['level'], 2); ?>>Guru</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <?php } else { ?>
                                    <tr id="kelas">
                                        <td>Kelas</td>
                                        <td>
                                            <select class="form-control" name="kelas" required>
                                                <option value="">Silahkan Pilih Kelas</option>
                                                <?php  
                                                $db->select('kelas');
                                                $kelas = $db->getResult();
                                                foreach ($kelas as $key => $kelas) { ?>
                                                    <option value="<?php echo $kelas['id']; ?>" <?php check_selected($res[0]['kelas_id'], $kelas['id']); ?>><?php echo $kelas['kelas']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-primary" name="btn-update">
                                            <span class="glyphicon glyphicon-edit"></span>  Update <?php echo $data['name']; ?>
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
      </section>

      <!--main content end-->

<?php 
$db->disconnect();
include('footer.php'); ?>