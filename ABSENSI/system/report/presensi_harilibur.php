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
                    <h1>PEMERINTAH PROVINSI PAPUA</h1> <h2>DAFTAR HARI LIBUR </h2>
                </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</htmlpageheader>
<htmlpagefooter name="pageFooter" style="display:none">
    <div style="text-align: right; padding-bottom: 10px; color: #666; font-size: 9px;">
        Halaman {PAGENO} dari {nbpg}</td>
    </div>
</htmlpagefooter>   
<sethtmlpageheader name="pageHeader" page="O" value="on" show-this-page="1" />
<sethtmlpagefooter name="pageFooter" value="ON" page="ALL" />
<?php
	echo $this->data['table'];
?>