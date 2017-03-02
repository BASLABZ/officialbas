<div class="navclue abu-abu">
	<div class="clue"><a href="#">TAMBAH DATA PEGAWAI</a></div>
</div>
<script type="text/javascript" src="js/jquery.draggable.js"></script>
<script>
    function validate(){
        re = true;
        $(".nip").each(function(){
            if($(this).val() == ''){
                re = false;
                $(this).focus();
            }
        });
        if(!re){
            alert('NIP masih kosong!');
        }
        return re;
    }
	$(document).ready(function() { 
		$("#formpegawai").submit(function(){
			if(!validate()){
                return false;
            }
		})
		var i = 2;
		$("#tambah").click(function(){
			
			row = '<tr>'+
						'<td class="td1">'+i+'</td>'+				
						'<td><table class="tabket">'+
            			'<tr><td>NIP</td><td><input type="text" name="nip['+i+']"  maxlength="30" size="22" class="nip" alt="'+i+'"/></td></tr>'+
                		'<tr><td>Nama</td><td><input type="text" name="nama['+i+']"  maxlength="100" size="22" class="nama" alt="'+i+'"/></td></tr>'+
						'</table></td>'+
						'<td><table class="tabket">'+
						'<tr><td>Pendidikan</td><td><select name="pendidikan['+i+']"><?php echo $this->optPendidikan('');?></select></td><td>Status Pegawai</td><td><input type="radio" name="status['+i+']" value="pns" checked>PNS <input type="radio" name="status['+i+']" value="honor">Honorer </tr>'+
						'<tr><td>Golongan</td><td><select style="width:160px;" name="golongan['+i+']"><?php echo $this->optGolongan('');?></select></td><td>Max TPB</td><td>Rp. <input size="15" type="text" name="tpb['+i+']" class="numberonly"/></td></tr>'+
						'<tr><td>Jabatan</td><td><input type="text" name="jabatan['+i+']" maxlength="100"/></td><td>Nama Atasan</td><td><input type="text" name="namaa['+i+']"  maxlength="100" class="nama_a" alt="'+i+'"/><img src="img/search.png" width="15px" class="search" alt="'+i+'"/></td></tr>'+
						'<tr><td>Eselon</td><td><select name="eselon['+i+']"><?php echo $this->optEselon('');?></select></td><td>NIP Atasan</td><td><input type="text" name="nipa['+i+']"  maxlength="30" class="nip_a" alt="'+i+'"/></td></tr>'+
						'<tr><td>Bidang</td><td><select name="unit['+i+']"><?php echo $this->optBidang('');?></select></td><td>Golongan Atasan</td><td><select style="width:160px;" name="golongana['+i+']" class="golongan_a" alt="'+i+'"><?php echo $this->optGolongan('');?></select></td></tr>'+
						'<tr><td>Sub Unit</td><td><input type="text" name="subunit['+i+']" maxlength="150"/></td><td>Jabatan Atasan</td><td><input type="text" name="jabatana['+i+']" maxlength="100" class="jabatan_a" alt="'+i+'"/></td></tr>'+
						'</table></td>'+
						'<td><table class="tabket">'+
            			'<tr><td>No. Alat</td><td><select name="no_alat['+i+']"><?php echo $this->optAlat('');?></select></td></tr>'+
            			'<tr><td>No. Enroll</td><td><input type="text" name="no_enroll['+i+']" class="numberonly" size="3"/></td></tr>'+
            			'</table></td>'+			
				  '</tr>';
			$(row).insertBefore("#lastsub");
			i++
			
		});
		$(".search").live().css('cursor','pointer');
		$(".search").live('click', function(){
			var iddata = $(this).attr('alt');
			var nip = $(".nip[alt='"+iddata+"']").val();
			
			$(".CanvasPopup").fadeIn('fast');
			
			$(".ContentPopup").load("?pg=pegawai&mode=optAtasan&kodeskpd=<?php echo $_GET['kodeskpd']; ?>&nip="+nip+"&id="+iddata+"");
			$(".CenterPopup").draggable({ handle: $(".titlePopup") });
		});
		$(".close").click(function(){
			$(".CanvasPopup").fadeOut('fast');
			$(".ContentPopup").html('<div class="loading"><img src="img/ajax-loader.gif"/></div>');
		})
	});
</script>
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">SKPD</td><td>: <?php echo $this->data['skpd'];?></td></tr>
        </table>
    </div>
    
    <form method="post" id="formpegawai">
    <table class="tabdata">
    	<tr>
            <th class="biru">No.</th>
            <th class="biru">NIP / Nama Pegawai</th>
            <th class="biru" width="600px">Detail</th>
            <th class="biru">No. Enroll</th>
        </tr>
        <tr>
            <td class="td1" valign="top">1</td>
            <td><table class="tabket">
            	<tr><td>NIP</td><td><input type="text" name="nip[1]"  maxlength="30" size="22" class="nip" alt="1"/></td></tr>
                <tr><td>Nama</td><td><input type="text" name="nama[1]"  maxlength="100" size="22" class="nama" alt="1"/></td></tr>
            </table>
            </td>
            <td>
            <table class="tabket">
                <tr><td>Pendidikan</td><td><select name="pendidikan[1]"><?php echo $this->optPendidikan('');?></select></td><td>Status Pegawai</td><td><input type="radio" name="status[1]" value="pns" checked>PNS <input type="radio" name="status[1]" value="honor">Honorer</tr>
                <tr><td>Golongan</td><td><select style="width:160px;" name="golongan[1]"><?php echo $this->optGolongan('');?></select></td><td>Max TPB</td><td>Rp. <input type="text" size="15" name="tpb[1]" class="numberonly"/></td></tr>
                <tr><td>Jabatan</td><td><input type="text" name="jabatan[1]" maxlength="100"/></td><td>Nama Atasan</td><td><input type="text" name="namaa[1]"  maxlength="100" class="nama_a" alt="1"/><img src="img/search.png" width="15px" class="search" alt="1"/></td></tr>
                <tr><td>Eselon</td><td><select name="eselon[1]"><?php echo $this->optEselon('');?></select></td><td>NIP Atasan</td><td><input type="text" name="nipa[1]"  maxlength="30" class="nip_a" alt="1"/></td></tr>
                <tr><td>Bidang</td><td><select name="unit[1]"><?php echo $this->optBidang('');?></select></td><td>Golongan Atasan</td><td><select style="width:160px;" name="golongana[1]" class="golongan_a" alt="1"><?php echo $this->optGolongan('');?></select></td></tr>
                <tr><td>Sub Unit</td><td><input type="text" name="subunit[1]" maxlength="150"/></td><td>Jabatan Atasan</td><td><input type="text" name="jabatana[1]" maxlength="100" class="jabatan_a" alt="1"/></td></tr>
            </table></td>
            <td>
            <table class="tabket">
                <tr><td>No. Alat</td><td><select name="no_alat[1]"><?php echo $this->optAlat('');?></select></td></tr>
                <tr><td>No. Enroll</td><td><input type="text" name="no_enroll[1]" class="numberonly" size="3"/></td></tr>
            </table>
            </td>
        </tr>
        <tr id="lastsub"></tr>
    </table>
    <input type="submit" class="button biru" value="Simpan"/>
    <input type="button" class="button biru" value="Tambah" id="tambah"/>
    <input type="button" value="Batal" class="button biru" onclick="window.history.go(-1)"/>
    <input type="hidden" name="mode" value="insert" id="mode"/>
    <input type="hidden" name="kodeskpd" value="<?php echo $_GET['kodeskpd'];?>"/>
    </form>
</div>
<div class="CanvasPopup">
   <div class="BgPopup"></div>
   <div class="CenterPopup">
   	  <div class="titlePopup abu-abu">PILIH ATASAN<div class="close">x</div></div>
      <div class="ContentPopup">
      	<div class="loading">
			<img src="img/ajax-loader.gif"/>
		</div>
      </div>  
   </div>
</div>