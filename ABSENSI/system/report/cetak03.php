<?php
$db = $this->db;
$util = $this->util;
$image = $this->cnf->ROOTDIR."img/image003.png";

if(!empty($_POST['nip'])) {
	$res = $db->query("SELECT nip,nama,pendidikan, golongan, pangkat, eselon,gol1, gol2, jabatan, unit,subunit, id, skpd.skpd, status,namaa,nipa,golongana,jabatana,tpb FROM pegawai LEFT JOIN skpd on id = pegawai.skpd WHERE nip = '".$db->esc($_POST['nip'])."'");
	list($nip,$nama, $pendidikan, $golongan, $pangkat,  $eselon, $gol1, $gol2, $jabatan, $unit, $subunit, $skpd, $nama_skpd, $status,$namaa,$nipa,$golongana,$jabatana,$tpb) = $db->fetchArray($res);
}
$jeneng=$nama;
$nipp=$nip;
$nipaa=(trim($nipa)!=''?$nipa:'____________________');
$jenenga=(trim($namaa)!=''?$namaa:'________________________');
$wulan=$_POST['bulan'];
$taun= $_POST['tahun'];

if(!empty($_POST['bulan'])){

?>

<html>
<head>
<title>FORM TPB 03 - <?php echo $nama; ?></title>
<style>
body{font:76% "Arial",arial,sans-serif;color: #333;text-align:center;padding: 10px}
</style>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 12 (filtered)">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Cambria;
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
@font-face
	{font-family:"Arial Narrow";
	panose-1:2 11 6 6 2 2 2 3 2 4;}
@font-face
	{font-family:"DejaVu Sans Condensed";}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:0in;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-link:"Header Char";
	margin:0in;
	margin-bottom:.0001pt;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-link:"Footer Char";
	margin:0in;
	margin-bottom:.0001pt;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoBodyTextIndent, li.MsoBodyTextIndent, div.MsoBodyTextIndent
	{mso-style-link:"Body Text Indent Char";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:.25in;
	font-size:12.0pt;
	font-family:"DejaVu Sans Condensed","serif";}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-link:"Balloon Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";}
p.MsoNoSpacing, li.MsoNoSpacing, div.MsoNoSpacing
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
span.FooterChar
	{mso-style-name:"Footer Char";
	mso-style-link:Footer;
	font-family:"Calibri","sans-serif";}
span.HeaderChar
	{mso-style-name:"Header Char";
	mso-style-link:Header;
	font-family:"Calibri","sans-serif";}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-link:"Balloon Text";
	font-family:"Tahoma","sans-serif";}
span.BodyTextIndentChar
	{mso-style-name:"Body Text Indent Char";
	mso-style-link:"Body Text Indent";
	font-family:"DejaVu Sans Condensed","serif";}
 /* Page Definitions */
 @page Section1
	{size:595.35pt 841.95pt;
	margin:70.9pt 70.9pt 70.9pt 70.9pt;}
div.Section1
	{page:Section1;}
@page Section2
	{size:595.35pt 841.95pt;
	margin:70.9pt 70.9pt 70.9pt 70.9pt;}
div.Section2
	{page:Section2;}
 /* List Definitions */
 ol
	{margin-bottom:0in;}
ul
	{margin-bottom:0in;}
-->
</style>

</head>

<body lang=EN-US>

<div class=Section1>

<p class=MsoNormal align=center style='margin-bottom:6.0pt;text-align:center;
line-height:normal'><img width=77 height=81 id="Picture 2"
src="<?php echo $image; ?>"></p>

<div style='border:none;border-bottom:double windowtext 2.25pt;padding:0in 0in 1.0pt 0in'>

<p class=MsoNormal align=center style='margin-bottom:6.0pt;text-align:center;
line-height:normal;border:none;padding:0in'><b><span lang=ES style='font-size:
16.0pt;font-family:"Arial Narrow","sans-serif"'>PEMERINTAH PROVINSI PAPUA</span></b></p>

</div>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span lang=FI style='font-size:16.0pt;
font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span lang=FI style='font-size:14.0pt;
font-family:"Arial Narrow","sans-serif"'>FORMULIR TPB 03</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span lang=FI style='font-size:14.0pt;
font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span lang=FI style='font-size:14.0pt;
font-family:"Arial Narrow","sans-serif"'>PENILAIAN KINERJA BAGI JABATAN
STRUKTURAL DAN FUNGSIONAL</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:150%'><b><span lang=FI style='line-height:150%;
font-family:"Arial Narrow","sans-serif"'> </span></b><b><span style='line-height:
150%;font-family:"Arial Narrow","sans-serif"'>(Diisi oleh Atasan
Langsung/Penilai)</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:150%'><b><span style='line-height:150%;
font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:150%'><b><span style='line-height:150%;
font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:150%'><b><span style='line-height:150%;
font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:150%'><b><span style='font-size:12.0pt;
line-height:150%;font-family:"Arial Narrow","sans-serif"'>Bulan</span></b><span
style='font-size:12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif"'>
</span><span style='font-size:12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif"'><?php echo $util->longMonth[$wulan];?></span><span
style='font-size:12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif"'> 
<b>Tahun </b><?php echo $taun;?></span></p>

<div align=center>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="97%"
 style='width:97.82%;border-collapse:collapse;border:none'>
  <tr>
  <td width="100%" colspan=2 style='width:100.0%;border:solid black 1.0pt;
  background:black;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b><span style='font-size:14.0pt;
  font-family:"Arial Narrow","sans-serif";color:white'>BAGIAN  A:  IDENTITAS 
  PEGAWAI</span></b></p>
  </td>
 </tr>
 <form method="post">
 <tr>
  <td width="30%" style='width:30.86%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:21.95pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-family:"Arial Narrow","sans-serif"'>Nama</span></p>
  </td>
   <input type="hidden" name="bulan" value="<?php echo $_POST['bulan']; ?>">
   <input type="hidden" name="tahun" value="<?php echo $_POST['tahun']; ?>">
   <input type="hidden" name="skpd" value="<?php echo $_POST['skpd']; ?>">
  <td width="69%" style='width:69.14%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $nama;?></span></p>
         </form>
  </td>
 </tr>
 <tr>
  <td width="30%" style='width:30.86%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:21.95pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-family:"Arial Narrow","sans-serif"'>NIP</span></p>
  </td>
  <td width="69%" style='width:69.14%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $util->formatNIP($nip); ?></span></p>
  </td>
 </tr>
 <tr>
  <td width="30%" style='width:30.86%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:21.95pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-family:"Arial Narrow","sans-serif"'>Pangkat/Golongan</span></p>
  </td>
  <td width="69%" style='width:69.14%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $golongan; ?></span></p>
  </td>
 </tr>
 <tr>
  <td width="30%" style='width:30.86%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:21.95pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-family:"Arial Narrow","sans-serif"'>Jabatan </span></p>
  </td>
  <td width="69%" style='width:69.14%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoListParagraph style='margin-top:4.0pt;margin-right:0in;
  margin-bottom:4.0pt;margin-left:.35pt;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'><?php echo $jabatan; ?></span></p>
  </td>
 </tr>
 <tr>
  <td width="30%" style='width:30.86%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:21.95pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>5.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-family:"Arial Narrow","sans-serif"'>Unit
  Kerja/SKPD</span></p>
  </td>
  <td width="69%" style='width:69.14%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $unit."/".$nama_skpd; ?></span></p>
  </td>
 </tr>
 <tr>
  <td width="100%" colspan=2 style='width:100.0%;border:solid black 1.0pt;
  border-top:none;background:black;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b><span style='font-size:14.0pt;
  font-family:"Arial Narrow","sans-serif";color:white'>BAGIAN  B:  ATASAN 
  LANGSUNG/PENILAI</span></b></p>
  </td>
 </tr>
 <tr>
  <td width="30%" style='width:30.86%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:21.95pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-family:"Arial Narrow","sans-serif"'>Nama</span></p>
  </td>
  <td width="69%" style='width:69.14%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $namaa;?></span></p>
  </td>
 </tr>
 <tr>
  <td width="30%" style='width:30.86%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:21.95pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-family:"Arial Narrow","sans-serif"'>Nomor Induk
  Pegawai</span></p>
  </td>
  <td width="69%" style='width:69.14%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $util->formatNIP($nipa);?></span></p>
  </td>
 </tr>
 <tr>
  <td width="30%" style='width:30.86%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:21.95pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-family:"Arial Narrow","sans-serif"'>Pangkat/Golongan</span></p>
  </td>
  <td width="69%" style='width:69.14%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $golongana;?></span></p>
  </td>
 </tr>
 <tr>
  <td width="30%" style='width:30.86%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:21.95pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-family:"Arial Narrow","sans-serif"'>Jabatan Struktural</span></p>
  </td>
  <td width="69%" style='width:69.14%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $jabatana;?></span></p>
  </td>
 </tr>
</table>


<p class=MsoNormal style='margin-left:35.45pt;text-align:justify;text-indent:
-35.45pt;line-height:normal'><span style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="99%"
 style='width:99.32%;border-collapse:collapse;border:none'>
 <tr style='height:16.5pt'>
  <td width=615 valign=bottom style='width:461.2pt;border:solid windowtext 1.0pt;
  background:black;padding:0in 5.4pt 0in 5.4pt;height:16.5pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b><span style='font-size:14.0pt;
  font-family:"Arial Narrow","sans-serif";color:white'>BAGIAN  C:  DISIPLIN </span></b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-left:35.45pt;text-align:justify;text-indent:
-35.45pt;line-height:normal'><span style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:6.0pt;
margin-left:17.85pt;text-align:justify;text-indent:-17.85pt;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>1.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></b><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>KEHADIRAN</span></b></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="93%"
 style='width:93.54%;margin-left:26.7pt;border-collapse:collapse;border:none'>
 <tr style='height:20.65pt'>
  <td width=180 nowrap style='width:134.65pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>Indikator Penilaian</span></b></p>
  </td>
  <td width=397 nowrap style='width:297.65pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>Keterangan</span></b></p>
  </td>
 </tr>
 <tr style='height:20.65pt'>
  <td width=180 nowrap style='width:134.65pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
  margin-left:.25in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";color:black'>a.<span
  style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";color:black'>Tidak
  Hadir (TH)</span></p>
  </td>
  <td width=397 nowrap rowspan=3 style='width:297.65pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>Atasan Langsung/Penilai
  tidak perlu mengisi kolom ini karena akan diisi oleh Operator berdasarkan hasil
  rekapitulasi dari Petugas Presensi di masing-masing SKPD atau yang ditunjuk
  secara khusus</span></b></p>
  </td>
 </tr>
 <tr style='height:20.65pt'>
  <td width=180 nowrap style='width:134.65pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
  margin-left:.25in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";color:black'>b.<span
  style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";color:black'>Terlambat
  Datang (TD)</span></p>
  </td>
 </tr>
 <tr style='height:20.65pt'>
  <td width=180 nowrap style='width:134.65pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
  margin-left:.25in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";color:black'>c.<span
  style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";color:black'>Cepat
  Pulang (CP)</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='text-align:justify;line-height:normal'><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:6.0pt;
margin-left:17.85pt;text-align:justify;text-indent:-17.85pt;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>2.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></b><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>KEPATUHAN</span></b></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:17.85pt;margin-bottom:.0001pt;text-align:justify;line-height:normal'><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Berdasarkan
penilaian saya selama bulan ini, maka dari aspek <b>Kepatuhan</b>, yang
bersangkutan Saya kategorikan ke dalam kelompok pegawai yang:</span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:17.85pt;margin-bottom:.0001pt;text-align:justify;line-height:normal'><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="94%"
 style='width:94.06%;margin-left:24.3pt;border-collapse:collapse;border:none'>
 <tr style='height:20.65pt'>
  <td width=183 nowrap style='width:137.05pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>Indikator Penilaian*</span></b></p>
  </td>
  <td width=397 nowrap style='width:297.65pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>Keterangan </span></b></p>
  </td>
 </tr>
 <tr style='height:20.65pt'>
  <td width=183 nowrap style='width:137.05pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
  margin-left:16.2pt;margin-bottom:.0001pt;text-indent:-16.2pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>a.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>Patuh (P)</span></p>
  </td>
  <td width=397 nowrap style='width:297.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Tidak
  Pernah meninggalkan tugas Tanpa Izin Selama Jam Kerja; Selalu mengikuti
  kegiatan Kenegaraan/Rapat/Senam/Lain-Lain; dan Selalu menggunakan pakaian
  seragam/tanda pengenal/badge sesuai hari kerja.</span></p>
  </td>
 </tr>
 <tr style='height:20.65pt'>
  <td width=183 nowrap style='width:137.05pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
  margin-left:16.2pt;margin-bottom:.0001pt;text-indent:-16.2pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>b.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>Kurang Patuh (KP)</span></p>
  </td>
  <td width=397 nowrap style='width:297.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>Jarang Pernah meninggalkan tugas Selama Jam Kerja Tanpa Izin;
  Jarang mengikuti kegiatan Kenegaraan/Rapat/Senam/Lain-Lain; dan Jarang menggunakan
  pakaian seragam/tanda pengenal/badge sesuai hari kerja</span></p>
  </td>
 </tr>
 <tr style='height:20.65pt'>
  <td width=183 nowrap style='width:137.05pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
  margin-left:16.2pt;margin-bottom:.0001pt;text-indent:-16.2pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>c.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>Tidak Patuh (TP)</span></p>
  </td>
  <td width=397 nowrap style='width:297.65pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.65pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Sering
  meninggalkan tugas Selama Jam Kerja Tanpa Izin; Sering tidak mengikuti
  kegiatan Kenegaraan/Rapat/Senam/Lain-Lain; dan Sering tidak menggunakan
  pakaian seragam/tanda pengenal/badge sesuai hari kerja.</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-left:35.45pt;text-align:justify;line-height:
normal'><span style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'>*)
Keterangan:beri tanda silang (X) pada huruf pada salah satu bari indikator
penilaian</span></p>

<span style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'><br
clear=all style='page-break-before:always'>
</span>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:35.45pt;margin-bottom:.0001pt;text-align:justify;line-height:normal'><span
style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="99%"
 style='width:99.32%;border-collapse:collapse;border:none'>
 <tr style='height:16.5pt'>
  <td width=612 valign=bottom style='width:459.0pt;border:solid windowtext 1.0pt;
  background:black;padding:0in 5.4pt 0in 5.4pt;height:16.5pt'><span
  style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'><br
  clear=all style='page-break-before:always'>
  </span>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b><span style='font-size:14.0pt;
  font-family:"Arial Narrow","sans-serif";color:white'>BAGIAN  D:  PENCAPAIAN
  KINERJA </span></b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:35.45pt;margin-bottom:.0001pt;text-align:justify;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Berdasarkan
Formulir TPB 01 tentang Target Kontrak Kerja Triwulanan yang yang diisi oleh Pegawai
yang bersangkutan pada setiap awal Triwulan, maka penilaian saya untuk bulan
ini pada komponen <b>Pencapaian Kinerja </b>adalah sebagai berikut:</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=615
 style='width:460.9pt;margin-left:4.65pt;border-collapse:collapse;border:none'>
 <thead>
 <tr style='height:13.25pt'>
  <td width=42 rowspan=2 style='width:31.8pt;border:solid windowtext 1.0pt;border-top:solid windowtext 2.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.25pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>No. urut</span></b></p>
  </td>
  <td width=270 rowspan=2 style='width:202.85pt;border:solid windowtext 1.0pt;
  border-left:none;border-top:solid windowtext 2.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:14.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>Indikator Penilaian</span></b></p>
  </td>
  <td width=302 colspan=5 style='width:226.25pt;border:solid windowtext 1.0pt;
  border-left:none;border-top:solid windowtext 2.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>Poin Penilaian*</span></b></p>
  </td>
 </tr>
 <tr style='height:41.65pt'>
  <td width=66 valign=top style='width:49.6pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:41.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>1 = Sangat Tidak Setuju</span></b></p>
  </td>
  <td width=59 valign=top style='width:44.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:41.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>2 = </span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>Tidak Setuju</span></b></p>
  </td>
  <td width=59 valign=top style='width:44.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:41.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>3 = </span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>Cukup Setuju</span></b></p>
  </td>
  <td width=59 valign=top style='width:44.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:41.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>4 = </span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>Setuju</span></b></p>
  </td>
  <td width=59 valign=top style='width:44.2pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:41.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>5 = </span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>Sangat setuju</span></b></p>
  </td>  
 </tr>
 </thead>
 <tbody>
 <tr style='height:3.75pt; color:#FFFFFF'>
  <td width=42 valign=bottom style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:3.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:white'>1.</span></b></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:3.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:white'>PRESTASI (PS)</span></b></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:black;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:3.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>1</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:3.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>2</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:3.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>3</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:3.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>4</span></b></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:black;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:3.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>5</span></b></p>
  </td>
 </tr>
 <tr style='height:6.65pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:6.65pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>a.</span></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:6.65pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Tugas
  selesai tepat waktu</span></p>
  </td>
  <td width=66 valign=top style='width:49.6pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:6.65pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=59 valign=top style='width:44.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:6.65pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=59 valign=top style='width:44.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:6.65pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=59 valign=top style='width:44.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:6.65pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=59 valign=top style='width:44.2pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:6.65pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:1.4pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:1.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>b.</span></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:1.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Kemanfaatan
  produk sesuai dengan rencana kerja/standar</span></p>
  </td>
  <td width=66 valign=top style='width:49.6pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:1.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=59 valign=top style='width:44.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:1.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=59 valign=top style='width:44.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:1.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=59 valign=top style='width:44.15pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:1.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=59 valign=top style='width:44.2pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:1.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:13.75pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>c.</span></p>
  </td>
  <td width=270 style='width:202.85pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Kuantitas
  produk sesuai dengan yang direncanakan/target</span></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:13.75pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>d.</span></p>
  </td>
  <td width=270 style='width:202.85pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Kualitas
  Produk Sesuai Rencana Kerja/Standar</span></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:13.75pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>e.</span></p>
  </td>
  <td width=270 style='width:202.85pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Tugas
  Sesuai dengan Petunjuk atau Instruksi</span></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'> </span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:13.75pt; color:#FFFFFF'>
  <td width=42 style='width:31.8pt;border:solid windowtext 1.0pt;border-top:
  none;background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:white'>2.</span></b></p>
  </td>
  <td width=270 style='width:202.85pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:white'>INOVASI DAN KREATIVITAS</span></b></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:black;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>1</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>2</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>3</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>4</span></b></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:black;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>5</span></b></p>
  </td>
 </tr>
 <tr style='height:13.75pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>a.</span></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Pegawai
  memiliki <b>pemikiran, gagasan, dan ide-ide baru </b>yang bersifat <b>membangun
  </b>sesuai dengan TUPOKSI.</span></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:13.75pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>b.</span></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Pegawai
  menunjukkan <b>keterbukaan</b> dalam menerima ide/gagasan baru yang diberikan
  oleh rekan kerja, pimpinan, atau para pemangku kepentingan. </span></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:13.75pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>c.</span></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Pegawai
  <b>tanggap</b> dalam mengantisipasi perubahan organisasi/lingkungan.</span></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:13.75pt; color:#FFFFFF'>
  <td width=42 style='width:31.8pt;border:solid windowtext 1.0pt;border-top:
  none;background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:white'>3. </span></b></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:white'>KOMPONEN TEKNIS</span></b></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:black;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>1</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>2</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>3</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>4</span></b></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:black;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>5</span></b></p>
  </td>
 </tr>
 <tr style='height:13.75pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>a.</span></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Pegawai
  <b>mahir </b>dalam mengoperasikan alat kerja yang menunjang kelancaran
  pekerjaan.</span></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:13.75pt; color:#FFFFFF'>
  <td width=42 style='width:31.8pt;border:solid windowtext 1.0pt;border-top:
  none;background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:white'>4.</span></b></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:white'>KEMAMPUAN INTERPERSONAL</span></b></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:black;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>1</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>2</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>3</span></b></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:black;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>4</span></b></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:black;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>5</span></b></p>
  </td>
 </tr>
 <tr style='height:13.75pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>a.</span></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Pegawai
  <b>bekerjasama</b> dengan bawahan/rekan kerja/pimpinan dalam lingkup
  unit/bidang kerjanya.</span></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:13.75pt'>
  <td width=42 valign=top style='width:31.8pt;border:solid windowtext 1.0pt;
  border-top:none;padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>b.</span></p>
  </td>
  <td width=270 valign=top style='width:202.85pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>Pegawai
  <b>berkomunikasi dengan baik</b> kepada bawahan/rekan kerja/pimpinan dan/atau
  para pemangku kepentingan (misalnya: masyarakat dan instansi terkait
  lainnya).</span></p>
  </td>
  <td width=66 style='width:49.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:2.85pt 5.4pt 2.85pt 5.4pt;height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=59 style='width:44.2pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:2.85pt 5.4pt 2.85pt 5.4pt;
  height:13.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
 </tr>
 </tbody>
</table>

<p class=MsoNormal style='margin-bottom:6.0pt;text-align:justify;line-height:
normal'><b><span style='font-family:"Arial Narrow","sans-serif"'>*) Keterangan:
beri tanda contreng </span></b><b><span style='font-family:"Arial Narrow","sans-serif";
color:black'>(&#8730;) pada salah satu kolom untuk masing-masing baris</span></b></p>

<p class=MsoNormal style='margin-left:35.45pt;text-align:justify;line-height:
normal'><span style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='margin-left:5.4pt;border-collapse:collapse;border:none'>
 <tr>
  <td width=606 valign=top style='width:454.5pt;border:solid black 1.0pt;
  background:black;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:6.0pt;margin-right:0in;margin-bottom:
  6.0pt;margin-left:0in'><b><span style='font-size:12.0pt;line-height:115%;
  font-family:"Arial Narrow","sans-serif";color:white'>BAGIAN  E:  PERNYATAAN
  ATASAN LANGSUNG/ PENILAI</span></b></p>
  </td>
 </tr>
 <tr>
  <td width=606 valign=top style='width:454.5pt;border:solid black 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoListParagraphCxSpFirst style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:0in;text-align:justify;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Saya menyatakan
  Penilaian Kinerja dan Kepatuhan ini dibuat berdasarkan kondisi yang
  sebenarnya dengan prinsip objektivitas dan keadilan.</span></p>
  <p class=MsoNormal align=right style='margin-top:0in;margin-right:19.45pt;
  margin-bottom:0in;margin-left:9.35pt;margin-bottom:.0001pt;text-align:right'><b><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>Jayapura</span></b><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>,
  ……………………………..</span></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:9.0pt;text-align:center'><b><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atasan Langsung/Penilai</span></b></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:9.0pt;text-align:center'><i><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>                                  
                        </span></i></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:9.0pt;text-align:center'><i><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>       
  </span></i></p>
  <p class=MsoNoSpacing><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>
  <p class=MsoNormal style='margin-top:0in;margin-right:19.35pt;margin-bottom:
  0in;margin-left:9.0pt;margin-bottom:.0001pt;line-height:200%'><b><span
  style='font-size:12.0pt;line-height:200%;font-family:"Arial Narrow","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<u><?php echo $jenenga;?>
  )</u></span></b></p>
  <p class=MsoListParagraph style='margin-top:6.0pt;margin-right:0in;
  margin-bottom:12.0pt;margin-left:20.9pt;text-align:justify;line-height:normal'><b><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP. </span></b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'><?php echo $util->formatNIP($nipaa);?></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-left:35.45pt;text-align:justify;line-height:
normal'><span style='font-size:10.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>


</div>

<span style='font-size:9.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'><br
clear=all style='page-break-before:always'>
</span>

<div class=Section2>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
font-family:"Arial Narrow","sans-serif"'>PETUNJUK TEKNIS PENGISIAN FORMULIR TPB
03</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
font-family:"Arial Narrow","sans-serif"'>PENILAIAN KINERJA BAGI JABATAN
STRUKTURAL DAN FUNGSIONAL</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:10.0pt;
font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>PETUNJUK
UMUM:</span></b></p>

<p class=MsoListParagraphCxSpFirst style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.25in;margin-bottom:.0001pt;text-align:justify;
text-indent:-.25in;line-height:normal'><span lang=FI style='font-family:"Arial Narrow","sans-serif"'>1.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>Pejabat Penilai/Atasan
Langsung melakukan penilaian terhadap pejabat struktural bawahannya berdasarkan
penilaian disiplin dan pencapaian kinerja</span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.25in;margin-bottom:.0001pt;text-align:justify;
text-indent:-.25in;line-height:normal'><span lang=FI style='font-family:"Arial Narrow","sans-serif"'>2.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>Penilaian terhadap
Pejabat Struktural yang menggunakan Formulir TPB 03 ditetapkan sebagai berikut:</span></p>

<p class=MsoListParagraphCxSpMiddle style='margin-bottom:0in;margin-bottom:
.0001pt;text-align:justify;text-indent:-.25in;line-height:normal'><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>a.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>Sekretaris, Kepala
Bidang, Kepala Bagian, Inspektur Pembantu pada Sekretariat Daerah, Sekretariat
MRP, Sekretariat DPRP, Dinas, Lembaga Teknis Daerah dan Inspektorat ditentukan
berdasarkan disiplin dan pencapaian kinerja oleh atasan langsungnya;</span></p>

<p class=MsoListParagraphCxSpLast style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:justify;text-indent:-.25in;line-height:normal'><span lang=FI
style='font-family:"Arial Narrow","sans-serif"'>b.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span lang=FI style='font-family:"Arial Narrow","sans-serif"'>Kepala
Sub Bidang; Sub Bagian dan Kepala Seksi pada Sekretariat Daerah, Sekretariat
MRP, Sekretariat DPRP, Dinas dan Lembaga Teknis Daerah serta Unit Pelaksana
Teknis Daerah ditentukan berdasarkan disiplin dan pencapaian kinerja oleh
atasan langsungnya.</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:35.7pt;margin-bottom:.0001pt;line-height:normal'><span lang=FI
style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>PETUNJUK
KHUSUS:</span></b></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
A: Identitas Pegawai</span></b></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris 1: Diisi nama Pegawai
yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris 2: Diisi Nomor Induk
Pegawai (NIP) yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris 3: Diisi Pangkat/Golongan
Pegawai yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris 4: Diisi Jabatan Pegawai
yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris 5: Diisi Unit
Kerja/Satuan Kerja Perangkat Daerah Pegawai yang bersangkuta</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
B:  Atasan  Langsung/Penilai</span></b></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris 1: Diisi nama atasan
langsung/penilai dari Pegawai yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris 2: Diisi Nomor Induk
Pegawai (NIP) yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris 3: Diisi Pangkat/Golongan
Pegawai yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris 4: Diisi Jabatan Pegawai
yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:70.9pt;margin-bottom:.0001pt;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
C:  Penilaian Disiplin</span></b></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>a.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></b><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Kehadiran</span></b></p>

<p class=MsoNormal align=left style='margin-left:.25in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif";color:black'>Tidak perlu diisi
karena akan diisi oleh Operator dalam Form TPB 05 berdasarkan data dari Petugas
Presensi.</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>b.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></b><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Kepatuhan</span></b></p>

<p class=MsoListParagraph align=left style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:justify;text-indent:-.25in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>(a)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-family:"Arial Narrow","sans-serif"'>Pemberian
nilai Patuh (P) bila memenuhi kriteria:</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>a.1. Tidak Pernah meninggalkan
tugas Tanpa Izin Selama Jam Kerja; </span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>a.2. Selalu mengikuti kegiatan
Kenegaraan/Rapat/Senam/Lain-Lain; dan </span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>a.3. Selalu menggunakan pakaian
seragam/tanda pengenal/badge sesuai hari kerja.</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:1.0in;margin-bottom:.0001pt;line-height:normal'><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoListParagraph align=left style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:justify;text-indent:-.25in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>(b)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-family:"Arial Narrow","sans-serif"'>Pemberian
nilai Kurang Patuh (KP) bila memenuhi kriteria:</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>b.1. Jarang Pernah meninggalkan
tugas Selama Jam Kerja Tanpa Izin; </span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>b.2. Jarang mengikuti<span
style='color:black'> kegiatan </span>Kenegaraan<span style='color:black'>/Rapat/Senam/Lain-Lain;
dan </span></span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif";color:black'>b.3. Jarang
menggunakan pakaian seragam/tanda pengenal/badge sesuai hari kerja</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:1.0in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoListParagraph align=left style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:justify;text-indent:-.25in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>(c)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-family:"Arial Narrow","sans-serif"'>Pemberian
nilai Tidak Patuh (TP) bila memenuhi kriteria:</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>c.1. Sering meninggalkan tugas
Selama Jam Kerja Tanpa Izin; </span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>c.2. Sering tidak mengikuti
kegiatan Kenegaraan/Rapat/Senam/Lain-Lain; dan </span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>c.3. Sering tidak menggunakan
pakaian seragam/tanda pengenal/badge sesuai hari kerja.</span></p>

<p class=MsoNormal align=left style='margin-left:1.0in'><span style='font-size:12.0pt;
line-height:115%;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:1.0in'><span style='font-size:12.0pt;
line-height:115%;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><br
clear=all style='page-break-before:always'>
</span></b>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
D:  Pencapaian Kinerja</span></b></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:22.5pt;margin-bottom:.0001pt;text-indent:-22.5pt;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Baris (1)<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></b><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Prestasi</span></b></p>

<p class=MsoNormal align=left style='margin-left:45.0pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Prestasi seorang Pegawai dapat
dinilai dari beberapa sub indikator, di antaranya: (1) ketepatan waktu
penyelesaian tugas, (2) manfaat dari pekerjaan yang diselesaiakan (misalnya
dapat mendukung pekerjaan bawahan, rekan kerja, atasan, dan memenuhi kebutuhan
masyarakat), (3) kuantitas atau jumlah pekerjaan yang diselesaikan, (4) kualitas
hasil pekerjaan (misalnya apakah sudah sesuai dengan Standar Operasi dan
Prosedur (SOP), Standar Pelayanan Minimum (SPM), atau standar lain yang
ditentukan oleh SKPD atau Atasan Langsungnya), dan (5) apakah pekerjaan yang
diselesaikan tersebut telah sesuai dengan petunjuk atau instruksi yang
diberikan kepadanya. </span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:45.0pt;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Berdasarkan beberapa sub
indikator penilaian tersebut, Penilai selanjutnya <b>memberi</b> <b>tanda
contreng (&#8730;)</b> pada salah satu kolom untuk masing-masing baris dengan
poin penilaian sebagai berikut:</span></p>

<p class=MsoNormal align=left style='margin-left:45.0pt;line-height:normal'><b><span
style='font-family:"Arial Narrow","sans-serif"'>1</span></b><span
style='font-family:"Arial Narrow","sans-serif"'>=Sangat Tidak Setuju; <b>2</b>=Tidak
Setuju; <b>  3</b>=Cukup Setuju; <b>4</b>=Setuju; dan  <b>5</b>= Sangat setuju</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:22.5pt;margin-bottom:.0001pt;text-indent:-22.5pt;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Baris (2)<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></b><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Inovasi dan
Kreativitas</span></b></p>

<p class=MsoNormal align=left style='margin-left:45.0pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Inovasi dan Kreativitas seorang
Pegawai dapat dinilai melalui beberapa sub indikator, di antaranya: (1) Pegawai
memiliki pemikiran, gagasan, dan ide-ide baru yang bersifat membangun sesuai
dengan TUPOKSI, (2) Pegawai menunjukkan keterbukaan dalam menerima ide/gagasan
baru yang diberikan oleh rekan kerja, pimpinan, atau para pemangku kepentingan,
dan (3) Pegawai tanggap dalam mengantisipasi perubahan organisasi/lingkungan.</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:45.0pt;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Berdasarkan beberapa sub
indikator penilaian tersebut, Penilai selanjutnya <b>memberi</b> <b>tanda
contreng (&#8730;)</b> pada salah satu kolom untuk masing-masing baris dengan
poin penilaian sebagai berikut:</span></p>

<p class=MsoNormal align=left style='margin-left:45.0pt;line-height:normal'><b><span
style='font-family:"Arial Narrow","sans-serif"'>1</span></b><span
style='font-family:"Arial Narrow","sans-serif"'>=Sangat Tidak Setuju; <b>2</b>=Tidak
Setuju; <b>  3</b>=Cukup Setuju; <b>4</b>=Setuju; dan  <b>5</b>= Sangat setuju</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:22.5pt;margin-bottom:.0001pt;text-indent:-22.5pt;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Baris (3)<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></b><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Kemampuan
Managerial</span></b></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:45.0pt;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif";color:black'>Kemampuan
Managerial Pegawai dapat dinilai </span><span style='font-family:"Arial Narrow","sans-serif"'>melalui</span><span
style='font-family:"Arial Narrow","sans-serif";color:black'> keterampilan dan
kemampuan dalam mengelola unit/instansi yang dipimpinnya. </span><span
style='font-family:"Arial Narrow","sans-serif"'>Berdasarkan aspek penilaian
tersebut, Penilai selanjutnya <b>memberi</b> <b>tanda contreng (&#8730;)</b>
pada salah satu kolom untuk masing-masing baris dengan poin penilaian sebagai
berikut:</span></p>

<p class=MsoNormal align=left style='margin-left:45.0pt;line-height:normal'><b><span
style='font-family:"Arial Narrow","sans-serif"'>1</span></b><span
style='font-family:"Arial Narrow","sans-serif"'>=Sangat Tidak Setuju; <b>2</b>=Tidak
Setuju; <b>  3</b>= Cukup Setuju;  <b>4</b>=Setuju; dan <b>5</b>= Sangat setuju</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:22.5pt;margin-bottom:.0001pt;text-indent:-22.5pt;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Baris (4)<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp; </span></span></b><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Kemampuan
Interpersonal</span></b></p>

<p class=MsoNormal align=left style='margin-left:45.0pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif";color:black'>Kemampuan
Interpersonal Pegagawai dapat dinilai melalui beberapa sub indikator, di
antaranya: (1) Pegawai dapat bekerjasama dengan bawahan/rekan kerja/pimpinan
dalam lingkup unit/</span><span style='font-family:"Arial Narrow","sans-serif"'>instansi</span><span
style='font-family:"Arial Narrow","sans-serif";color:black'> yang dikelolanya,
dan (2) Pegawai mampu berkomunikasi dengan baik kepada bawahan/rekan
kerja/pimpinan dan/atau para pemangku kepentingan (misalnya: masyarakat dan
instansi terkait lainnya).</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:45.0pt;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Berdasarkan beberapa sub
indikator penilaian tersebut, Penilai selanjutnya <b>memberi</b> <b>tanda
contreng (&#8730;)</b> pada salah satu kolom untuk masing-masing baris dengan
poin penilaian sebagai berikut:</span></p>

<p class=MsoNormal align=left style='margin-left:45.0pt;line-height:normal'><b><span
style='font-family:"Arial Narrow","sans-serif"'>1</span></b><span
style='font-family:"Arial Narrow","sans-serif"'>=Sangat Tidak Setuju; <b>2</b>=Tidak
Setuju;  <b>3</b>= Cukup Setuju;  <b>4</b>=Setuju; dan  <b>5</b>= Sangat setuju</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>BAGIAN
E:  PERNYATAAN ATASAN LANGSUNG/ PENILAI</span></b></p>

<p class=MsoListParagraph align=left style='margin:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-family:"Arial Narrow","sans-serif"'>Formulir TPB 03 </span><span
lang=FI style='font-family:"Arial Narrow","sans-serif"'>yang telah diisi dan
ditandatangani oleh Pejabat Penilai/Atasan Langsung diserahkan kepada Pejabat
Penatausahaan Keuangan atau petugas yang ditunjuk di masing-masing SKPD paling
lambat tanggal 5 (lima) pada bulan berikutnya untuk direkapitulasi.</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>	
</div>
</body>
</html>

<script>
	window.print();
</script>
<?php
}
?>