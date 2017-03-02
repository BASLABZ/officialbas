<?php 
		$idadmin = $_GET['idadmin'];
		$sqleditadmin = mysql_fetch_array(mysql_query("SELECT * from admin where idadmin='$idadmin' "));
 		if (isset($_POST['editadmin'])) {
 			$editadmin = mysql_query("UPDATE admin SET  namalengkap = '$_POST[namalengkap]',
 										alamat = '$_POST[alamat]',kontak = '$_POST[kontak]',
 										email = '$_POST[email]', username = '$_POST[username]',
 										password = '$_POST[password]'
 											where idadmin = '$idadmin';
 										");
 			if ($editadmin) {
 				echo "<script> alert('Data Berhasil Ubah'); 
			location.href='index.php?pos=daftar_admin' </script>";exit;

 			}else{

 				echo "<script> alert('Data Gagal Di ubah'); 
			location.href='index.php?pos=daftar_admin' </script>";exit;
 			}
 		// pesan edit
 		}

 ?>
<div class="container">
<br>
<br>
<h3>Form Edit Data Admin</h3>
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Form Edit Data Admin</div>
				<div class="panel-body">
					<form class="role" method="POST">
				<div class="form-group">
					<label>Nama Lengkap</label>
					<input type="text" name="namalengkap" value="<?php echo $sqleditadmin['namalengkap']; ?>" class="form-control" placeholder="silahkan isi nama lengkap anda">
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="alamat" class="form-control" placeholder="isi dengan alamat lengkap anda">
						
					<?php echo $sqleditadmin['alamat']; ?>			
					</textarea>
				</div>
				<div class="form-group">
					<label>Kontak</label>
					<input type="number" name=" kontak" value="<?php echo $sqleditadmin['kontak'] ?>" class="form-control" placeholder = "isi dengan No.hp anda">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" value="<?php echo $sqleditadmin['email']; ?>" name="email" class="form-control" placeholder="isi dengan email anda "> 
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" value="<?php echo $sqleditadmin['username']; ?>" placeholder="isi dengan username anda">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" placeholder="isi dengan password anda " value="<?php echo $sqleditadmin['password']; ?>">
				</div>
				<div class="form-group">
					<button type="submit" name="editadmin" class="btn btn-primary">Ubah </button>
				
				</div>


			</form>
				</div>
			</div>
		</div>
	</div>
</div>