<div class="wraper">

<table width="560px" class="tabdata">
	<tr><th class="biru">No.</th><th class="biru">Nama</th><th class="biru">NIP</th><th class="biru"></th></tr>
<?php
	$no = 1;
	while($data = $this->db->fetchArray($this->res)){
?>
	<tr>
    	<td class="td1"><?php echo $no;?></td>
    	<td width="200px"><?php echo $data['nama'];?></td>
        <td><?php echo $data['nip'];?></td>
        <td width="50px" class="td1">
        	<a href="#" class="pilih" alt="<?php echo $no;?>">Pilih</a>
        	<input type="hidden" class="optnama_a" alt="<?php echo $no;?>" value="<?php echo $data['nama'];?>"/>
            <input type="hidden" class="optnip_a" alt="<?php echo $no;?>" value="<?php echo $data['nip'];?>"/>
            <input type="hidden" class="optgol_a" alt="<?php echo $no;?>" value="<?php echo $data['golongan'];?>"/>
            <input type="hidden" class="optjab_a" alt="<?php echo $no;?>" value="<?php echo $data['jabatan'];?>"/>
        </td>
    </tr>
<?php
		$no++;
	}
?>
</table>
</div>
<script type="application/javascript">
	$(document).ready(function() {
		$(".pilih").click(function(){
			var id = $(this).attr('alt');
			var y = <?php echo $_GET['id'];?>;
			nama = $(".optnama_a[alt='"+id+"']").val();
			nip = $(".optnip_a[alt='"+id+"']").val();
			golongan = $(".optgol_a[alt='"+id+"']").val();
			jabatan = $(".optjab_a[alt='"+id+"']").val();
			
			$(".nama_a[alt='"+y+"']").val(nama);
			$(".nip_a[alt='"+y+"']").val(nip);
			$(".golongan_a[alt='"+y+"']").val(golongan);
			$(".jabatan_a[alt='"+y+"']").val(jabatan);
			$(".CanvasPopup").fadeOut('fast');
		})
		$(".loading").fadeOut('fast');
	});
</script>