<?php session_start(); ?>
<html>
<head>
	<title>Login Form | tutorialweb.net</title>
</head>
<body>
 <?php  

 if(isset($_POST['btn-login'])){
 	// safety first :)
 	$user = mysql_real_escape_string(htmlentities($_POST['username']));
	$pass = mysql_real_escape_string(htmlentities(md5($_POST['password'])));

	include('inc/class.db.php');

	$db = new Database();
	$db->connect();

	$db->select('tbl_users', '*', '', 'username="'.$user.'" AND password="'.$pass.'"');
	$numRows = $db->numRows();
	$res = $db->getResult();

	if($numRows == 1){
		$level = $res[0]['level'];
		$username = $res[0]['username'];

		switch ($level) {
			case '1':
				$_SESSION['admin']=$username;
				echo '<script language="javascript">alert("Anda berhasil Login Admin!"); document.location="dashboard.php";</script>';
				break;
			
			case '2':
				$_SESSION['guru']=$username;
				echo '<script language="javascript">alert("Anda berhasil Login Guru!"); document.location="dashboard.php";</script>';
				break;
			
			case '3':
				$_SESSION['siswa']=$username;
				echo '<script language="javascript">alert("Anda berhasil Login Siswa!"); document.location="dashboard.php";</script>';
				break;
		}

	}
 }
 ?>
	<form action="" method="post">
	<center><h2>Login Form</h2></center>
	<table align="center">
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="username" placeholder="Username" required /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="password" name="password" placeholder="Password" required /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>
				<button type="submit" class="btn btn-primary" name="btn-login">
                <span class="glyphicon glyphicon-edit"></span>  Update data <?php echo $data['name']; ?>
                </button>
			</td>
		</tr>
	</table>
	</form>
 
</body>
</html>