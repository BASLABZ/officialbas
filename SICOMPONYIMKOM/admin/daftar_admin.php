<?php 
	if (isset($_POST['simpan'])) {
		$sqlinputadmin = mysql_query("INSERT INTO admin (namalengkap,alamat,kontak,email,username,password) 
										values ('$_POST[namalengkap]','$_POST[alamat]','$_POST[kontak]',
											'$_POST[email]','$_POST[username]','$_POST[password]' ) ");
		if ($sqlinputadmin) {
			echo "<script> alert('Data Berhasil Diinputkan'); 
			location.href='index.php?pos=daftar_admin' </script>";exit;
		}
		else{
			echo "<script> alert('Data Gagal Input'); 
			location.href='index.php?pos=daftar_admin' </script>";exit;
		}
	}


 ?>
<div class="container">
	<h3>Form Input Data Admin</h3>
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-primary">
		<div class="panel-heading">Input Data Admin</div>
		<div class="panel-body">
			<form class="role" method="POST">
				<div class="form-group">
					<label>Nama Lengkap</label>
					<input type="text" name="namalengkap" class="form-control" placeholder="silahkan isi nama lengkap anda">
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="alamat" class="form-control" placeholder="isi dengan alamat lengkap anda"></textarea>
				</div>
				<div class="form-group">
					<label>Kontak</label>
					<input type="number" name=" kontak" class="form-control" placeholder = "isi dengan No.hp anda">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" class="form-control" placeholder="isi dengan email anda "> 
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" placeholder="isi dengan username anda">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" placeholder="isi dengan password anda">
				</div>
				<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-primary">Simpan </button>
					<button type="reset" class="btn btn-warning">Batal</button>
				</div>


			</form>
		</div>
	</div>

		</div>
	</div>
	



	<h3>Daftar Data Admin</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">Daftar Data Admin</div>
		<div class="panel-body">
			<table class="table">
				<thead>
					<th>No</th>
					<th>Nama Lengkap</th>
					<th>Alamat</th>
					<th>Kontak</th>
					<th>Email</th>
					<th>Username</th>
					<th>Password</th>
					<th>Aksi</th>
				</thead>
				<tbody>
				<!-- fungsi untuk menghaspus data -->
				<?php 
					if (isset($_GET['hapus'])) {
						$sqlhapusadmin = mysql_query("DELETE FROM admin where idadmin = '$_GET[hapus]'");
						if ($sqlhapusadmin) {
						echo "<script> alert('Data Berhasil Hapus'); 
						location.href='index.php?pos=daftar_admin' </script>";exit;
						}
					}

				 ?>
				<?php $no = 1;
					  $dataadmin = mysql_query("SELECT * FROM admin order by idadmin DESC");
					  while ($kolom = mysql_fetch_array($dataadmin)) {

				 ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $kolom[1]; ?></td>
						<td><?php echo $kolom[2]; ?></td>
						<td><?php echo $kolom[3]; ?></td>
						<td><?php echo $kolom[4]; ?></td>
						<td><?php echo $kolom[5]; ?></td>
						<td><?php echo $kolom[6]; ?></td>
						<td>
							<a href="index.php?pos=edit_admin&idadmin=<?php echo $kolom[0]; ?>" class="btn btn-warning">EDIT</a>
							<a href="index.php?pos=daftar_admin&hapus=<?php echo $kolom[0]; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')"   class="btn btn-danger">HAPUS</a>
						</td>
					</tr>

					<?php $no++;} ?>
				</tbody>
			</table>

		</div>
	</div>

</div>