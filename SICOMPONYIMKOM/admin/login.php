<?php 
		if (isset($_POST['login'])) 
		{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$no = 0;
		$sql = "SELECT * from admin where username = '$username' and password = '$password'";
		$result = mysql_query($sql);
		while ($log=mysql_fetch_array($result))
			{
				$iduser = $log['idadmin'];
				$username = $log['username'];
				$password = $log['password'];
				$no++;
		} 
		if ($no>0)
		{
			$_SESSION['idadmin'] = $iduser;
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			echo "<script> alert('Terimakasih Anda Telah Sukses Login');
			 location.href='index.php'</script>";exit;
		}	
		else
		{
			echo "<script> alert('Maaf Anda Gagal Login'); 
			location.href='index.php?pos=login' </script>";exit;
		}	
		}

 ?>
<div class="container">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<h3 align="center">Silahkan Login Dibawah ini</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">Form Login</div>
				<div class="panel-body">
					<form class="role" method="POST">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" placeholder="isi dengan username">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" placeholder="isi dengan password">
						</div>
						<div class="form-group">
							<button type="submit" name="login" class="btn btn-warning"> Login </button>
							<button type="reset" class="btn btn-danger">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>