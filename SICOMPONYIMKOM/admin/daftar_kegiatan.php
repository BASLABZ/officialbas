<?php 
	if (isset($_POST['simpan'])) {
		
		if(!empty($_FILES) && $_FILES['gambar']['size'] > 
		0 && $_FILES['gambar']['error'] == 0){
		$fileName = $_FILES['gambar']['name'];
		$move = move_uploaded_file($_FILES['gambar']['tmp_name'], 'images/'.$fileName);

		if($move){
			$query = mysql_query("INSERT INTO kegiatan (judul_kegiatan,tgl_posting,deskripsi,gambar)
								 values ('$_POST[judul_kegiatan]',NOW(),'$_POST[deskripsi]','$fileName')");
		}
		
		}else{
			$query = mysql_query("INSERT INTO kegiatan (judul_kegiatan,tgl_posting,deskripsi,gambar)
								 values ('$_POST[judul_kegiatan]',NOW(),'$_POST[deskripsi]','')");
		}

		if ($query) {
			echo "<script> alert('Data Berhasil Diinputkan'); 
			location.href='index.php?pos=daftar_kegiatan' </script>";exit;
		}else{
			echo "<script> alert('Data gagal Diinputkan'); 
			location.href='index.php?pos=daftar_kegiatan' </script>";exit;
		}


	}
 ?>
<div class="container">
<br><br>
<h3>Data Input Kegiatan</h3>
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Data Input Kegiatan</div>
				<div class="panel-body">
					<form class="role" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Judul Kegiatan</label>
					<input type="text" name="judul_kegiatan" class="form-control">
				</div>
				<div class="form-group">
					<label>Dekripsi</label>
					<textarea name="deskripsi" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label>Gambar</label>
					<input type="file" name="gambar">
				</div>
				<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-primary" >Simpan</button>
					<button type="reset" class="btn btn-danger">Batal</button>
				</div>
			</form>
				</div>
			</div>
		</div>
	</div>
	<!-- tampil tabel kegiatan -->
	<h3>Daftar Data Kegiatan Imkom</h3>
	<div class="col-sm-12">
		<div class="table">
			<table class="table">
				<thead>
					<th>No</th>
					<th>Judul Kegiatan</th>
					<th>Tanggal Posting</th>
					<th>Gambar</th>
					<th>Deskripsi</th>
					<th>Aksi</th>
				</thead>
				<tbody>
				<!-- fungsi untuk menghapus data kegiatan -->
				<?php 
					
					if (isset($_GET['hapus'])) {
						$hapusdatakegiatan = mysql_query("DELETE FROM kegiatan where idkegiatan = '$_GET[hapus]'");
						// pesan konfirmasi
						if ($hapusdatakegiatan) {
						echo "<script> alert('Data Berhasil Dihapus'); 
						location.href='index.php?pos=daftar_kegiatan' </script>";exit;	
						}
					}
				 ?>

				<?php 
				$no =1;
				$tampungdatakegiatan = mysql_query("SELECT * from kegiatan");
					while ($kolom = mysql_fetch_array($tampungdatakegiatan)) {
					$namagambar = $kolom[4];
				?>

					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $kolom[1]; ?></td>
						<td><?php echo $kolom[2]; ?></td>
						<td><?php echo "<img src='images/$namagambar' widht = '100' height='100'>"; ?></td>
						<td><?php echo $kolom[3]; ?></td>
						<td>
							<a href="index.php?pos=daftar_kegiatan&hapus= <?php echo $kolom[0]; ?> " 
								onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
							
							<a href="index.php?pos=edit_kegiatan&idkegiatan=<?php echo $kolom[0]; ?>" class="btn btn-warning">Edit</a>

						</td>
					</tr>

				<?php $no++;} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


