<section class="portfolio" id="galery">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1 text-center">
					<h2>Galeri Foto</h2>
					<hr class="small">
					<div class="row">
					<?php $ambilgaleri = mysql_query("SELECT g.idgaleri,g.nama_galeri,g.gambar, a.nama_album FROM galeri g INNER JOIN album a ON g.idalbum = a.idalbum");
						while ($kolom = mysql_fetch_array($ambilgaleri)) {
						 $gambar = $kolom['gambar'];	
						  ?>
						<div class="col-md-6">
							<div class="portfolio-item">
							<p><?php echo $kolom[1]; ?><br>
								Nama Album : <?php echo $kolom[3]; ?></p>
							<a href="#">
							<?php echo "<img  widht='300' height='300' src='admin/images/$gambar'>"; ?>
								
							</a>
							</div>
						</div>
						<?php } ?>
				</div>
			</div>
		</div>
	</section>