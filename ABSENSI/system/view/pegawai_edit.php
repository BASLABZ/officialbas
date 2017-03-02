<div class="navclue abu-abu">
	<div class="clue"><a href="#">EDIT DATA PEGAWAI</a></div>
</div>
<script type="text/javascript" src="js/jquery.draggable.js"></script>
<script>
	$(document).ready(function() {
		var kodeskpd = '<?php echo $_GET['kodeskpd'];?>'; 
		$(".search").live('click', function(){
			var iddata = $(this).attr('alt');
			var nip = $(".nip[alt='"+iddata+"']").val();
			$(".CanvasPopup").fadeIn('fast');
			$(".loading").fadeIn('fast');
			$(".ContentPopup").load("?pg=pegawai&mode=optAtasan&kodeskpd=<?php echo $_GET['kodeskpd']; ?>&nip="+nip+"&id="+iddata+"");
			$(".CenterPopup").draggable({ handle: $(".titlePopup") });
		});
		$(".close").click(function(){
			$(".CanvasPopup").fadeOut('fast');
		})
	});
</script>
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo $this->data['skpd'];?></td></tr>
        </table>
    </div>
    
    <form method="post">
    <table class="tabdata">
    	<tr>
            <th class="biru">No.</th>
            
            <th class="biru">NIP / Nama Pegawai</th>
            <th class="biru" width="600px">Detail</th>
            <th class="biru">No. Enroll</th>
        </tr>
        <?php
		echo $this->data['listpeg'];
	?>
    </table>
    <input type="submit" class="button biru" value="Simpan"/>
    <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/>
    <input type="hidden" name="mode" value="update" id="mode"/>
    <input type="hidden" name="kodeskpd" value="<?php echo $_GET['kodeskpd'];?>"/>
    </form>
</div>
<div class="CanvasPopup">
   <div class="BgPopup"></div>
   <div class="CenterPopup">
   	  <div class="titlePopup abu-abu">PILIH ATASAN<div class="close">x</div></div>
      <div class="ContentPopup">
      	<div class="loading">
			<img src="img/load.gif"/>
		</div>
      </div>  
   </div>
</div>