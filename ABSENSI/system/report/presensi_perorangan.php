
<htmlpageheader name="pageHeader">
<table width="100%">
    <tr>
        <td class="header">
            <table width="100%">
                <tr>
                <td style="text-align:right;">
                <img src="img/image003.png" height="70px"/>
                </td>
                <td class="td1" style="padding-left:80px;">
                    <h1>PEMERINTAH PROVINSI PAPUA</h1> <h2>LAPORAN PRESENSI PEGAWAI</h2>
                </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table  width="100%">
        
        <tr>
            <td width="150px">Nama / NIP</td><td>: <?php echo $this->dtpeg['nama'].' / '.$this->dtpeg['nip'];?></td>
            
        </tr>
        <tr>
            <td>Pangkat / Golongan</td><td>: <?php echo $this->dtpeg['golongan'];?></td>
        </tr>
        <tr>
            <td>SKPD</td><td>: <?php echo $this->dtpeg['nama_skpd'];?></td>
        </tr>
        <tr>
            <td>Jabatan</td><td>: <?php echo $this->dtpeg['jabatan'];?></td>
        </tr>
        <tr>
            <td>Unit Kerja</td><td>: <?php echo $this->dtpeg['unit'];?></td>
        </tr>
        <tr>
            <td>Subunit Kerja</td><td>: <?php echo $this->dtpeg['subunit'];?></td>
        </tr>
        <tr>
                        
            <td >Waktu Presensi</td><td>: <?php echo $this->util->longMonth[$_GET['bulan']]." ".$_GET['tahun'];?></td>
        </tr>
</table>
</htmlpageheader>
<sethtmlpageheader name="pageHeader" page="O" value="on" show-this-page="1" />
    
<?php
	echo $this->data['table'];
?>
	<br />
    <table width="100%">
        <tr>
            <td style="text-align:left;">
                <table border="1">
                    
                    <tr>
                        
                        <td width="150px">Jumlah Hari Kerja</td><td width="100px"> <?php echo $this->dtpres['jml_harikerja'];?> Hari</td></tr>
                    <tr>
                        
                        <td>Jumlah Hari Hadir</td><td> <?php echo $this->dtpres['jml_masuk'];?> Hari</td>
                    </tr>
                    <tr>
                        
                        <td>Jumlah Tidak Hadir</td><td> <?php echo $this->dtket['th'];?> Hari</td>
                    </tr>
                    <tr>
                        
                        <td>Jumlah Ijin</td><td> <?php echo $this->dtket['i'];?> Hari</td>
                    </tr>
                    <tr>
                        
                        <td>Jumlah Dinas Luar</td><td> <?php echo $this->dtket['dl'];?> Hari</td>
                    </tr>
                    <tr>
                        
                        <td>Jumlah Sakit</td><td> <?php echo $this->dtket['s'];?> Hari</td>
                    </tr>
                    <tr>
                        
                        <td>Jumlah Tugas Belajar</td><td> <?php echo $this->dtket['tb'];?> Hari</td>
                    </tr>
                   
                </table>
            </td>
            <td style="text-align:right;">
                <table border="1">
                    
                    
                    <tr>
                        
                        <td>Jumlah Jam Hadir</td><td> <?php echo $this->jum_jam;?> Jam</td>
                    </tr>
                    <tr>
                        
                        <td>Jumlah Jam Terlambat</td><td> <?php echo $this->dtket['tl'];?> Jam</td>
                    </tr>
                    <tr>
                        
                        <td>Jumlah Jam Cepat Pulang</td><td> <?php echo $this->dtket['bl'];?> Jam</td>
                    </tr>
                </table>
            </td>
        </tr></table>
    
    
	