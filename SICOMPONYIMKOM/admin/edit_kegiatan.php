<?php 
	$idkegiatan = $_GET['idkegiatan'];// fungsi pengambilan data id kegiatan
	$tampildataedit =  mysql_fetch_array(mysql_query("SELECT * FROM kegiatan where idkegiatan = '$idkegiatan' "));
	//$tampildataedit digunakan untuk menampilkan array dari tabel kegiatan 
	//didatabase
	$namagambar = $tampildataedit['gambar'];
	//$namagambar digunakan untuk menampilakan data nama gambar
 ?>
 <?php 
 		// fungsi edit data kegiatan
 		if (isset($_POST['editkegiatan'])) {
 			//variabel yang digunakan untuk perpindahan gambar
 		if(!empty($_FILES) && $_FILES['gambar']['size'] > 
		0 && $_FILES['gambar']['error'] == 0){
		$fileName = $_FILES['gambar']['name'];
		$move = move_uploaded_file($_FILES['gambar']['tmp_name'], 'images/'.$fileName);
 			//jika berhasil memindahka gambar maka akan dieksekusi di bawa ini
 			if ($move) {
 				$query = mysql_query("UPDATE kegiatan SET judul_kegiatan = '$_POST[judul_kegiatan]',
 									tgl_posting = NOW(), deskripsi='$_POST[deskripsi]', gambar = '$fileName' 
 									WHERE idkegiatan = '$idkegiatan'
 									");
 				}
 			}else{//ini jika tidak mengganti gambar
 				$query = mysql_query("UPDATE kegiatan SET judul_kegiatan = '$_POST[judul_kegiatan]',
 									tgl_posting = NOW(), deskripsi='$_POST[deskripsi]' where idkegiatan='$idkegiatan' ");
 			}
 			// pesan hasil dari eksekusi
 			if ($query) {
 					echo "<script> alert('Data Berhasil Diubah'); 
					location.href='index.php?pos=daftar_kegiatan' </script>";exit;
 				}else{
 					echo "<script> alert('Data gagal di ubah'); 
					location.href='index.php?pos=edit_kegiatan' </script>";exit;
 				}	
 		}
  ?>
<div class="container">
	<br><br>
	<h3>Form Ubah Data Kegiatan</h3>
	<div class="row">
		<div class="col-sl=m-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Form Edit data Kegiatan</div>
				<div class="panel-body">
					<form class="role" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Judul Kegiatan</label>
							<input type="text" name="judul_kegiatan" value="<?php echo $tampildataedit['judul_kegiatan']; ?>" class="form-control"> 
						</div>
						<div class="form-group">
							<label>Deskripsi Kegiatan</label>
							<textarea name="deskripsi" class="form-control">
								<?php echo $tampildataedit['deskripsi']; ?>
							</textarea>
						</div>
						<div class="form-group">
							<label>Ubah Gambar</label>
							<br>
							<?php echo "<img src='images/$namagambar'>"; ?>
							
							<input type="file" name="gambar">
						</div>
						<div class="form-group">
							<button type="submit" name="editkegiatan" 
							class="btn btn-warning">Ubah</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>