<?php 
	if (isset($_POST['simpan'])) {
		$simpandataprofil = mysql_query("INSERT INTO profil (judul_profil,tgl_posting,deskripsi)
										values('$_POST[judul_profil]',NOW(),'$_POST[deskripsi]') 
			");	
		// pesan
		if ($simpandataprofil) {
				echo "<script> alert('Data Berhasil Diinputkan'); 
			location.href='index.php?pos=daftar_profil' </script>";exit;
		}else{
				echo "<script> alert('Data Berhasil Diinputkan'); 
			location.href='index.php?pos=daftar_profil' </script>";exit;
		}
	}
 ?>
<div class="container">
	
	<div class="row">
		<div class="col-sm-6">
			<h3>Input Data Profil Imkom</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					Form Input Data Profil
				</div>
				<div class="panel-body">
					<form class="role" method="POST">
						<div class="form-group">
							<label>Judul Profil</label>
							<input type="text" name="judul_profil" class="form-control" placeholder = "isi dengan judul profil">
						</div>
						<div class="form-group">
							<label>Deskripsi Profil</label>
							<textarea name="deskripsi" class="form-control" placeholder="isi dengan deskripsi"></textarea>
						</div>
						<div class="form-group">
								<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
								<button type="reset" class="btn btn-warning">Batal</button>
						 </div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="table">
			<table class="table">
				<thead>
					<th>No</th>
					<th>Judul Profil</th>
					<th>Tanggal Posting</th>
					<th>Deskripsi</th>
					<th>Aksi</th>
				</thead>
				<tbody>
				<?php 
				$no=1;
					$tampungdataprofil= mysql_query("SELECT * FROM profil order by idprofil desc");
					while ($kolom = mysql_fetch_array($tampungdataprofil)) {
						
				
				 ?>
				
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $kolom[1]; ?></td>
						<td><?php echo $kolom[2]; ?></td>
						<td><?php echo $kolom[3]; ?></td>
						<td><a href="" class="btn btn-primary">Edit</a>
							<a href="" class="btn btn-warning">Hapus</a></td>
					</tr>
				<?php 	$no++;} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>