<!-- fungsi untuk menyimpan data -->
<?php if (isset($_POST['simpangaleri'])) 
	{
		if(!empty($_FILES) && $_FILES['gambar']['size'] > 
		0 && $_FILES['gambar']['error'] == 0)
		{
		$fileName = $_FILES['gambar']['name'];
		$move = move_uploaded_file($_FILES['gambar']['tmp_name'], 'images/'.$fileName);
			if ($move) {
				$query = mysql_query("INSERT INTO galeri (nama_galeri,gambar,idalbum) 
					values ('$_POST[nama_galeri]','$fileName','$_POST[idalbum]') ");
			}else{
				$query = mysql_query("INSERT INTO galeri (nama_galeri,gambar,idalbum) 
					values ('$_POST[nama_galeri]','','$_POST[idalbum]') ");
			}
		}

		if ($query) {
			echo "<script> alert('Data Berhasil Diinputkan'); 
			location.href='index.php?pos=daftar_galeri' </script>";exit;
			}else{
				echo "<script> alert('Data gagal Diinputkan'); 
			location.href='index.php?pos=daftar_galeri' </script>";exit;
			}
	} 

?>
<div class="container">
<br><br>
	<div class="row">
		<div class="col-sm-6">
			<h3>Form Input Data Galeri</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">Form Input Data Galeri</div>
				<div class="panel-body">
					<form class="role" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nama Galeri</label>
							<input type="text" name="nama_galeri" class="form-control">
						</div>
						<div class="fomr-group">
							<label>Gambar</label>
							<input type="file" name="gambar">
						</div>
						<div class="form-group">
							<label>Pilih Album</label>
							<select name="idalbum" class="form-control">
								<option value="null">--pilih nama album--</option>

								<?php $tampungdataalbum = mysql_query("SELECT * FROM album");
								while ($ambildata = mysql_fetch_array($tampungdataalbum)) 
								{
								?>
								<option value="<?php echo $ambildata[0]; ?>">
									<?php echo $ambildata[1]; ?>
								</option>
								<?php 	} ?>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" name="simpangaleri" class="btn btn-primary">
								Simpan
							</button>
							<button type="reset" class="btn btn-danger">
								Batal
							</button>
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="table">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Daftar Data Galeri
				</div>
				<div class="panel-body">
					<div class="table">
						<table class="table">
							<thead>
								<th>No</th>
								<th>Nama galeri</th>
								<th>Gambar</th>
								<th>Nama Album</th>
								<th>Aksi</th>
							</thead>
							<tbody>
							<?php $no = 1;
							$tampungdatagaleri = mysql_query("SELECT g.idgaleri,g.nama_galeri,g.gambar, a.nama_album FROM galeri g INNER JOIN album a ON g.idalbum = a.idalbum");			 
							
							while ($kolom = mysql_fetch_array($tampungdatagaleri)) {
							$gambar = $kolom['gambar'];
							
							 ?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $kolom[1]; ?></td>
									<td><?php echo "<img src='images/$gambar' width='100' height='100'>"; ?></td>
									<td><?php echo $kolom[3]; ?></td>
									<td>
										<a href="" class="btn btn-warning">Hapus</a>
										<a href="" class="btn btn-danger">Edit</a>
									</td>
								</tr>
							<?php $no++;} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
