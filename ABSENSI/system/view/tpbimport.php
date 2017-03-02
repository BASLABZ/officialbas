<div class="navclue abu-abu">
	<div class="clue"><a href="#">Import <?php if ($_POST['bulan']) echo 'Triwulan ke '.$this->util->triwulan($_POST['bulan']).' Tahun '.$_POST["tahun"]; ?></a></div>
</div>
<script>
	
	function eksport() {	
		$("#periode").submit();
			
	}
</script>

<div class="canvas-content">
	<div class="ket">		
		<form id="periode" method="post" action="?pg=datatpb&mode=do_import" enctype="multipart/form-data">
	    	<table class="tabket">
	        	<tr>
	        		<td class="td1">File</td>
	        		<td>: <input type="file" name="file"> </td>
	        	</tr>
	        </table>
	    </form>	    
	    <font color="<?php echo $this->color; ?>" size="-1">
			<?php echo $this->ermsg; ?>
		</font>	
    </div>
    
    <a href="#" class="aksi" alt="Export" onClick="eksport();"><div class="button biru">Import</div></a>
