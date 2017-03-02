
<htmlpageheader name="pageHeader">
<table width="100%">
    <tr>
        <td class="header">
            <table width="100%">
                <tr>
                <td style="text-align:right;">
                <img src="img/image003.png" height="70px"/>
                </td>
                <td class="td1" style="padding-left:230px;">
                    <h1>PEMERINTAH PROVINSI PAPUA</h1> <h2>LAPORAN PRESENSI PEGAWAI</h2>
                </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table width="100%">
        <tr>
            <td>
                <table  >
                    <tr>
                        <td width="150px">SKPD</td><td>: <?php echo $this->dtpres['skpd'];?></td>
                        
                    </tr>
                    <tr>
                        <td>Waktu Presensi</td><td>: <?php echo $this->util->longMonth[$_GET['bulan']]." ".$_GET['tahun'];?></td>
                    </tr>
                    
                    
                </table>
            </td>
            </tr>
</table>
</htmlpageheader>
<htmlpagefooter name="pageFooter" style="display:none">
    <table>
            <tr><td colspan="2"><b>Keterangan :</b></td></tr>
            <tr><td>HD</td><td>= Hadir</td><td>TH</td><td>= Tidak Hadir</td></tr>
            <tr><td>L</td><td>= Libur</td><td>AS</td><td>= Absen Sekali</td></tr>
            <tr><td>I</td><td>= Ijin</td><td>TL</td><td>= Terlambat</td></tr>
            <tr><td>S</td><td>= Sakit</td><td>PL</td><td>= Pulang Lebih Awal</td></tr>
            <tr><td>C</td><td>= Cuti</td><td>TP</td><td>= Terlambat - Pulang Lebih Awal</td></tr>
            <tr><td>DL</td><td>= Dinas Luar</td><td>TB</td><td>= Tugas Belajar</td></tr>
    </table>
    <div style="text-align: right; padding-bottom: 10px; color: #666; font-size: 9px;">
        Halaman {PAGENO} dari {nbpg}
    </div>
</htmlpagefooter>   
<sethtmlpageheader name="pageHeader" page="O" value="on" show-this-page="1" />
<sethtmlpagefooter name="pageFooter" value="ON" page="ALL" />
<!-- <sethtmlpageheader name="pageHeader" value="ON" page="ALL"  /> -->

    
    
    <br />
<?php
    echo $this->data['table'];
?>
<br/>
