<div class="navclue abu-abu">
	<div class="clue"><a href="#">LOG USER PRESENSI</a></div>
</div>
<div class="canvas-content">
	<table class="tabdata zebra">
            <tr>
                <th class="biru th1">No.</th>
                <th class="biru" >Waktu</th>
                <th class="biru th2">Nama Pengguna</th>
                <th class="biru th2">IP Pengguna</th>
                <th class="biru th4" width="50px">Aktifitas</th>
            </tr>
            <?php
			$no = $this->page->low + 1;
            while($data = $this->db->fetchArray($this->res)){
							
            echo '<tr class="hov transbg">
            		<td class="td1">
	                   '.$no.'
	                </td>
	                <td class="td2">
	                   '.$this->dt->indonesian_date($data['log_waktu']).'
	                </td>
	                <td class="td2">
	                   '.$data['nama'].'
	                </td>
	                <td class="td2">
	                   '.$data['log_ip'].'
	                </td>
	                <td>
	                   '.$data['jenis'].'
	                </td>
	                
	            </tr>';
				$no++;
			}
			?>         
			
    </table>
    <div class="b">
            <div class="l">
                <?php echo $this->page->display_result();?>
            </div><!--[l]-->
            <div class="r">
            	<?php
					echo $this->page->display_pages(); 
				?>
            </div><!--[r]-->       
    </div><!--[b]-->
</div>