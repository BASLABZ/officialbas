<?php
$db = $this->db;
$util = $this->util;
$image = $this->cnf->ROOTDIR."img/image003.png";

if(!empty($_POST['nip'])) {
	$res = $db->query("SELECT nip,nama,pendidikan, golongan, pangkat, eselon,gol1, gol2, jabatan, unit,subunit, id, skpd.skpd, status,namaa,nipa,golongana,jabatana, tpb FROM pegawai LEFT JOIN skpd on id = pegawai.skpd WHERE nip = '".$db->esc($_POST['nip'])."'");
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
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<title>FORM TPB 02 - <?php echo $nama; ?></title>
<style>
body{font:76% "Arial",arial,sans-serif;color: #333;text-align:center;padding: 10px}
</style>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 12">
<meta name=Originator content="Microsoft Word 12">
<link rel=File-List
href="TPB%2002_Penilaian%20Kinerja%20Jabatan%20Struktural_files/filelist.xml">
<link rel=Edit-Time-Data
href="TPB%2002_Penilaian%20Kinerja%20Jabatan%20Struktural_files/editdata.mso">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
w\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<link rel=themeData
href="TPB%2002_Penilaian%20Kinerja%20Jabatan%20Struktural_files/themedata.thmx">
<link rel=colorSchemeMapping
href="TPB%2002_Penilaian%20Kinerja%20Jabatan%20Struktural_files/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>EN-US</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
   <w:SplitPgBreakAndParaMark/>
   <w:DontVertAlignCellWithSp/>
   <w:DontBreakConstrainedForcedTables/>
   <w:DontVertAlignInTxbx/>
   <w:Word11KerningPairs/>
   <w:CachedColBalance/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"/>
   <m:brkBin m:val="before"/>
   <m:brkBinSub m:val="--"/>
   <m:smallFrac m:val="off"/>
   <m:dispDef/>
   <m:lMargin m:val="0"/>
   <m:rMargin m:val="0"/>
   <m:defJc m:val="centerGroup"/>
   <m:wrapIndent m:val="1440"/>
   <m:intLim m:val="subSup"/>
   <m:naryLim m:val="undOvr"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="true"
  DefSemiHidden="true" DefQFormat="false" DefPriority="99"
  LatentStyleCount="267">
  <w:LsdException Locked="false" Priority="0" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Normal"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="heading 1"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 2"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 3"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 4"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 5"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 6"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 7"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 8"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 9"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 1"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 2"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 3"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 4"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 5"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 6"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 7"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 8"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 9"/>
  <w:LsdException Locked="false" Priority="35" QFormat="true" Name="caption"/>
  <w:LsdException Locked="false" Priority="10" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Title"/>
  <w:LsdException Locked="false" Priority="1" Name="Default Paragraph Font"/>
  <w:LsdException Locked="false" Priority="11" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" Priority="22" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" Priority="20" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" Priority="59" SemiHidden="false"
   UnhideWhenUsed="false" Name="Table Grid"/>
  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Placeholder Text"/>
  <w:LsdException Locked="false" Priority="1" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="No Spacing"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 1"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 1"/>
  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Revision"/>
  <w:LsdException Locked="false" Priority="34" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="List Paragraph"/>
  <w:LsdException Locked="false" Priority="29" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Quote"/>
  <w:LsdException Locked="false" Priority="30" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Quote"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 1"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 1"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 2"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 2"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 2"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 3"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 3"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 3"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 4"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 4"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 4"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 5"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 5"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 5"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 6"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 6"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 6"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="19" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtle Emphasis"/>
  <w:LsdException Locked="false" Priority="21" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Emphasis"/>
  <w:LsdException Locked="false" Priority="31" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtle Reference"/>
  <w:LsdException Locked="false" Priority="32" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Reference"/>
  <w:LsdException Locked="false" Priority="33" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Book Title"/>
  <w:LsdException Locked="false" Priority="37" Name="Bibliography"/>
  <w:LsdException Locked="false" Priority="39" QFormat="true" Name="TOC Heading"/>
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-1610611985 1107304683 0 0 415 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520092929 1073786111 9 0 415 0;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520081665 -1073717157 41 0 66047 0;}
@font-face
	{font-family:"Arial Narrow";
	panose-1:2 11 6 6 2 2 2 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:647 2048 0 0 159 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:0in;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Header Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Footer Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Balloon Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.MsoNoSpacing, li.MsoNoSpacing, div.MsoNoSpacing
	{mso-style-priority:1;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
span.HeaderChar
	{mso-style-name:"Header Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:Header;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:Calibri;}
span.FooterChar
	{mso-style-name:"Footer Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:Footer;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:Calibri;}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Balloon Text";
	font-family:"Tahoma","sans-serif";
	mso-ascii-font-family:Tahoma;
	mso-hansi-font-family:Tahoma;
	mso-bidi-font-family:Tahoma;}
p.msolistparagraphcxspfirst, li.msolistparagraphcxspfirst, div.msolistparagraphcxspfirst
	{mso-style-name:msolistparagraphcxspfirst;
	mso-style-unhide:no;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.msolistparagraphcxspmiddle, li.msolistparagraphcxspmiddle, div.msolistparagraphcxspmiddle
	{mso-style-name:msolistparagraphcxspmiddle;
	mso-style-unhide:no;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.msolistparagraphcxsplast, li.msolistparagraphcxsplast, div.msolistparagraphcxsplast
	{mso-style-name:msolistparagraphcxsplast;
	mso-style-unhide:no;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	font-size:10.0pt;
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;}
@page Section1
	{size:595.35pt 841.95pt;
	margin:70.9pt 70.9pt 70.9pt 70.9pt;
	mso-header-margin:.5in;
	mso-footer-margin:.5in;
	mso-paper-source:0;}
div.Section1
	{page:Section1;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-qformat:yes;
	mso-style-parent:"";
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-para-margin:0in;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2050"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=EN-US style='tab-interval:.5in'>

<div class=Section1>

<p class=MsoNormal align=center style='margin-bottom:6.0pt;text-align:center;
line-height:normal'><span style='mso-no-proof:yes'><img width=77 height=81
id="_x0000_i1025"
src="<?php echo $image; ?>"></span></p>

<div style='border:none;border-bottom:double windowtext 2.25pt;padding:0in 0in 1.0pt 0in'>

<p class=MsoNormal align=center style='margin-bottom:6.0pt;text-align:center;
line-height:normal'><b><span lang=ES style='font-size:16.0pt;font-family:"Arial Narrow","sans-serif";
mso-ansi-language:ES'>PEMERINTAH PROVINSI PAPUA</span></b></p>

</div>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span lang=FI style='font-size:16.0pt;
font-family:"Arial Narrow","sans-serif";mso-ansi-language:FI'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span lang=FI style='font-size:14.0pt;
font-family:"Arial Narrow","sans-serif";mso-ansi-language:FI'>FORMULIR TPB 02</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span lang=FI style='font-size:14.0pt;
font-family:"Arial Narrow","sans-serif";mso-ansi-language:FI'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span lang=FI style='font-size:14.0pt;
font-family:"Arial Narrow","sans-serif";mso-ansi-language:FI'>PENILAIAN KINERJA
BAGI JABATAN STRUKTURAL</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:150%'><b><span lang=FI style='font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>&nbsp;</span></b><b><span style='font-family:"Arial Narrow","sans-serif"'>(Diisi
oleh Atasan Langsung/Penilai)</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:150%'><b><span style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
150%'><b><span style='font-size:12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif"'>Bulan</span></b><span
style='font-size:12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif"'>
</span><span style='font-size:12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif"'><?php echo $util->longMonth[$wulan];?></span><span
style='font-size:12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif"'>&nbsp;
<b>Tahun </b><?php echo $taun;?> </span></p>

<div align=center>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="57%"
 style='width:57.88%;border-collapse:collapse;mso-yfti-tbllook:1184;mso-padding-alt:
 0in 0in 0in 0in'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width="100%" colspan=2 style='width:100.0%;border:solid black 1.0pt;
  background:black;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b><span style='font-size:14.0pt;
  font-family:"Arial Narrow","sans-serif";color:white'>BAGIAN&nbsp; A:&nbsp;
  IDENTITAS&nbsp; PEGAWAI</span></b></p>
  </td>
 </tr>
 <form method="post">
 <tr style='mso-yfti-irow:1'>
  <td width="100%" style='width:52.16%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:22.0pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>1.</span><span
  style='font-size:7.0pt;font-family:"Times New Roman","serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='font-family:"Arial Narrow","sans-serif"'>Nama</span></p>
  </td>
  <input type="hidden" name="bulan" value="<?php echo $_POST['bulan']; ?>">
   <input type="hidden" name="tahun" value="<?php echo $_POST['tahun']; ?>">
   <input type="hidden" name="skpd" value="<?php echo $_POST['skpd']; ?>">
  <td width="47%" style='width:47.84%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  2.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'>
  <?php echo $nama; ?>
                 
         </span></p>
         </form> 
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width="100%" style='width:52.16%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:22.0pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>2.</span><span
  style='font-size:7.0pt;font-family:"Times New Roman","serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='font-family:"Arial Narrow","sans-serif"'>NIP</span></p>
  </td>
  <td width="47%" style='width:47.84%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $util->formatNIP($nip); ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width="100%" style='width:52.16%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:22.0pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>2.</span><span
  style='font-size:7.0pt;font-family:"Times New Roman","serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='font-family:"Arial Narrow","sans-serif"'>Pangkat/Golongan</span></p>
  </td>
  <td width="47%" style='width:47.84%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $golongan; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width="100%" style='width:52.16%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:22.0pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>3.</span><span
  style='font-size:7.0pt;font-family:"Times New Roman","serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='font-family:"Arial Narrow","sans-serif"'>Jabatan
  Struktural</span></p>
  </td>
  <td width="47%" style='width:47.84%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoListParagraph style='margin-top:4.0pt;margin-right:0in;
  margin-bottom:4.0pt;margin-left:.35pt;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'><?php echo $jabatan; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width="100%" style='width:52.16%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:22.0pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>4.</span><span
  style='font-size:7.0pt;font-family:"Times New Roman","serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='font-family:"Arial Narrow","sans-serif"'>Unit Kerja/SKPD</span></p>
  </td>
  <td width="47%" style='width:47.84%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $unit."/".$nama_skpd; ?></span></p>
  </td>
  </tr>
   <form method="post">
		<input type="hidden" name="bulan" value="<?php echo $_POST['bulan']; ?>">
		<input type="hidden" name="tahun" value="<?php echo $_POST['tahun']; ?>">
		<input type="hidden" name="skpd" value="<?php echo $_POST['skpd']; ?>">
		<input type="hidden" name="nip" value="<?php echo $_POST['nip']; ?>">
 
 <tr style='mso-yfti-irow:6'>
  <td width="100%" colspan=2 style='width:100.0%;border:solid black 1.0pt;
  border-top:none;background:black;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b><span style='font-size:14.0pt;
  font-family:"Arial Narrow","sans-serif";color:white'>BAGIAN &nbsp;B:&nbsp;
  ATASAN&nbsp; LANGSUNG/PENILAI</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width="100%" style='width:52.16%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:22.0pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>1.</span><span
  style='font-size:7.0pt;font-family:"Times New Roman","serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='font-family:"Arial Narrow","sans-serif"'>Nama</span></p>
  </td>
  <td width="47%" style='width:47.84%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $namaa;?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width="100%" style='width:52.16%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:22.0pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>2.</span><span
  style='font-size:7.0pt;font-family:"Times New Roman","serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='font-family:"Arial Narrow","sans-serif"'>Nomor Induk
  Pegawai</span></p>
  </td>
  <td width="47%" style='width:47.84%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $util->formatNIP($nipa);?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width="100%" style='width:52.16%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:22.0pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>3.</span><span
  style='font-size:7.0pt;font-family:"Times New Roman","serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='font-family:"Arial Narrow","sans-serif"'>Pangkat/Golongan</span></p>
  </td>
  <td width="47%" style='width:47.84%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $golongana;?></span></p>
  </td>
 </tr>
 
 
  
 <tr style='mso-yfti-irow:10;mso-yfti-lastrow:yes'>
  <td width="100%" style='width:52.16%;border:solid black 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:22.0pt;text-indent:-.25in;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>4.</span><span
  style='font-size:7.0pt;font-family:"Times New Roman","serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span><span style='font-family:"Arial Narrow","sans-serif"'>Jabatan
  Struktural</span></p>
  </td>
  <td width="47%" style='width:47.84%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><?php echo $jabatana;?></span></p>
  </td>
 </tr>
 </form>
</table>
<iframe id="frame" src="" height="1" width="1" frameborder="0"></iframe>
<script>
		
	function cetak() {
		document.getElementById('frame').src = "cetak02.php";
	}
	
	function word() {
		document.getElementById('frame').src = "word02.php";
	}
</script>
<?php
	if($_POST['aksi'] == "Cetak") {
?>
<script>
	cetak();
</script>
<?php
	}
?>

<?php
	if($_POST['aksi'] == "Word") {
?>
<script>
	word();
</script>
<?php
	}
?>
</div>

<p class=MsoNormal><span style='font-size:12.0pt;line-height:115%;font-family:
"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:150%'><b><span style='font-size:14.0pt;
line-height:150%;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="99%"
 style='width:99.66%;border-collapse:collapse;mso-yfti-tbllook:1184;mso-padding-alt:
 0in 0in 0in 0in'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:16.5pt'>
  <td width=982 colspan=8 valign=bottom style='width:736.8pt;border:solid windowtext 1.0pt;
  background:black;padding:0in 5.4pt 0in 5.4pt;height:16.5pt'><span
  style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-bidi-font-family:"Times New Roman";mso-ansi-language:
  EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA'><br clear=all
  style='page-break-before:always'>
  </span>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b><span style='font-size:14.0pt;
  font-family:"Arial Narrow","sans-serif";color:white'>BAGIAN &nbsp;C:
  &nbsp;PENILAIAN &nbsp;DISIPLIN </span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:15.75pt'>
  <td width=47 rowspan=2 style='width:35.2pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>No</span></b></p>
  </td>
  <td width=108 rowspan=2 style='width:81.35pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>Indikator Disiplin</span></b></p>
  </td>
  <td width=398 nowrap rowspan=2 style='width:298.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>Deskripsi Penilaian</span></b></p>
  </td>
  <td width=429 nowrap colspan=5 valign=top style='width:321.9pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>Kriteria Penilaian (&#8730;)</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:16.5pt'>
  <td width=96 nowrap valign=top style='width:1.0in;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:white;padding:0in 5.4pt 0in 5.4pt;height:16.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>STB</span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>(Sangat Tidak Baik)</span></b></p>
  </td>
  <td width=83 nowrap valign=top style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:white;padding:0in 5.4pt 0in 5.4pt;height:16.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>KB</span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>(Kurang Baik )</span></b></p>
  </td>
  <td width=83 nowrap valign=top style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:white;padding:0in 5.4pt 0in 5.4pt;height:16.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>C</span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>(Cukup)</span></b></p>
  </td>
  <td width=83 nowrap valign=top style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:white;padding:0in 5.4pt 0in 5.4pt;height:16.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>B</span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>(Baik)</span></b></p>
  </td>
  <td width=83 nowrap valign=top style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:white;padding:0in 5.4pt 0in 5.4pt;height:16.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>SB</span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>(Sangat Baik)</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:55.45pt'>
  <td width=47 nowrap style='width:35.2pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:55.45pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>1</span></p>
  </td>
  <td width=108 nowrap style='width:81.35pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:55.45pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>Kehadiran</span></p>
  </td>
  <td width=398 nowrap valign=top style='width:298.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:55.45pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=96 nowrap valign=bottom style='width:1.0in;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:55.45pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:55.45pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:55.45pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:55.45pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:55.45pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:57.15pt'>
  <td width=47 nowrap style='width:35.2pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:57.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>2</span></p>
  </td>
  <td width=108 nowrap style='width:81.35pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:57.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>Kepatuhan</span></p>
  </td>
  <td width=398 nowrap valign=top style='width:298.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:57.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=96 nowrap valign=bottom style='width:1.0in;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:57.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:57.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:57.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:57.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:57.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:4.25pt'>
  <td width=982 nowrap colspan=8 valign=top style='width:736.8pt;border:solid windowtext 1.0pt;
  border-top:none;background:black;padding:0in 5.4pt 0in 5.4pt;height:4.25pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b><span style='font-size:14.0pt;
  font-family:"Arial Narrow","sans-serif";color:white'>BAGIAN &nbsp;D:
  &nbsp;PENCAPAIAN &nbsp;KINERJA</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:46.9pt'>
  <td width=47 nowrap style='width:35.2pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:46.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>1</span></p>
  </td>
  <td width=108 nowrap style='width:81.35pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:46.9pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>Prestasi</span></p>
  </td>
  <td width=398 nowrap valign=top style='width:298.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:46.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=96 nowrap valign=bottom style='width:1.0in;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:46.9pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:46.9pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:46.9pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:46.9pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:46.9pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:49.2pt'>
  <td width=47 nowrap style='width:35.2pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:49.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>2</span></p>
  </td>
  <td width=108 nowrap style='width:81.35pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.2pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>Inovasi dan Kreativitas</span></p>
  </td>
  <td width=398 nowrap valign=top style='width:298.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=96 nowrap valign=bottom style='width:1.0in;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.2pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.2pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.2pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.2pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.2pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:49.15pt'>
  <td width=47 nowrap style='width:35.2pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:49.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>3</span></p>
  </td>
  <td width=108 nowrap style='width:81.35pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>Kemampuan Managerial</span></p>
  </td>
  <td width=398 nowrap valign=top style='width:298.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.15pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=96 nowrap valign=bottom style='width:1.0in;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:49.15pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;mso-yfti-lastrow:yes;height:50.0pt'>
  <td width=47 nowrap style='width:35.2pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:50.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'>4</span></p>
  </td>
  <td width=108 nowrap style='width:81.35pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:50.0pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>Kemampuan Interpersonal</span></p>
  </td>
  <td width=398 nowrap valign=top style='width:298.35pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:50.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
  </td>
  <td width=96 nowrap valign=bottom style='width:1.0in;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:50.0pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:50.0pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:50.0pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:50.0pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
  <td width=83 nowrap valign=bottom style='width:62.5pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:50.0pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='text-align:justify'><span style='font-size:10.0pt;
line-height:115%;font-family:"Arial Narrow","sans-serif";color:black'>&nbsp;</span></p>
<p class=MsoNormal style='text-align:justify'>&nbsp;</p>
<p class=MsoNormal style='text-align:justify'>&nbsp;</p>
<p class=MsoNormal style='text-align:justify'>&nbsp;</p>
<p class=MsoNormal style='text-align:justify'>&nbsp;</p>
<p class=MsoNormal style='text-align:justify'>&nbsp;</p>
<p class=MsoNormal style='text-align:justify'>&nbsp;</p>
<p class=MsoNormal style='text-align:justify'>&nbsp;</p>
<p class=MsoNormal style='text-align:justify'>&nbsp;</p>

<div align=center>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=618
 style='width:463.5pt;border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 0in 0in 0in'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=618 valign=top style='width:463.5pt;border:solid black 1.0pt;
  background:black;padding:0in 5.4pt 0in 5.4pt'><span style='font-size:10.0pt;
  font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-bidi-font-family:"Times New Roman";color:black;mso-ansi-language:EN-US;
  mso-fareast-language:EN-US;mso-bidi-language:AR-SA'><br clear=all
  style='page-break-before:always'>
  </span><b><span style='font-size:14.0pt;font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
  color:white;mso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:
  AR-SA'><br clear=all style='page-break-before:always'>
  </span></b>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b><span style='font-size:14.0pt;
  font-family:"Arial Narrow","sans-serif";color:white'>BAGIAN &nbsp;E:&nbsp;
  PERNYATAAN ATASAN LANGSUNG/ PENILAI</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes;height:74.2pt'>
  <td width=618 valign=top style='width:463.5pt;border:solid black 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:74.2pt'>
  <p class=MsoListParagraph style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:0in;text-align:justify;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Saya
  menyatakan Penilaian Disiplin dan Kinerja ini dibuat berdasarkan kondisi yang
  sebenarnya dengan prinsip objektivitas dan keadilan.</span></p>
  <p class=MsoListParagraph style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:.25in;text-align:justify;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>
  <p class=MsoListParagraph style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:.25in;text-align:justify;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>
  <p class=MsoListParagraph style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:.25in;text-align:justify;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.45pt;
  margin-bottom:0in;margin-left:9.35pt;margin-bottom:.0001pt;text-align:center'><b><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></b></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.45pt;
  margin-bottom:0in;margin-left:9.35pt;margin-bottom:.0001pt;text-align:center'><b><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jayapura, </span></b><span style='font-size:12.0pt;line-height:115%;
  font-family:"Arial Narrow","sans-serif"'>………………………………</span></p>
  <p class=MsoNormal align=center style='margin-left:52.65pt;text-indent:-52.65pt;
  line-height:normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atasan Langsung/Penilai</span></b></p>
  <p class=MsoNoSpacing><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>
  <p class=MsoNoSpacing><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:9.0pt;text-align:center'><i><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></i></p>
  <p class=MsoNoSpacing align=center><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span><b><span
  style='font-size:12.0pt;line-height:200%;font-family:"Arial Narrow","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (<u><?php echo $jenenga;?>)</u></span></b></p>
<p class=MsoNormal align=center><b><span style='font-size:12.0pt;line-height:115%;
  font-family:"Arial Narrow","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP.
</span></b><span style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'><?php echo $util->formatNIP($nipaa);?></span></p>
  <p class=MsoListParagraph style='margin-top:6.0pt;margin-right:0in;
  margin-bottom:12.0pt;margin-left:20.9pt;text-align:justify;line-height:normal'><b><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>
  </td>
 </tr>
</table>

</div>

<p class=MsoNormal><span style='font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-right:19.35pt;text-align:justify;line-height:
normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:12.0pt;line-height:115%;font-family:
"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:12.0pt;line-height:115%;font-family:
"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<b><span style='font-size:14.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
mso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA'><br
clear=all style='page-break-before:always'>
</span></b>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
font-family:"Arial Narrow","sans-serif"'>PETUNJUK TEKNIS PENGISIAN FORMULIR TPB
02</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:12.0pt;
font-family:"Arial Narrow","sans-serif"'>KONTRAK TARGET KERJA PEGAWAI NEGERI
SIPIL&nbsp; (PNS)</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b><span style='font-size:10.0pt;
font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>PETUNJUK
UMUM:</span></b></p>

<p class=MsoListParagraph style='margin-top:0in;margin-right:0in;margin-bottom:
0in;margin-left:.25in;margin-bottom:.0001pt;text-align:justify;text-indent:
-.25in;line-height:normal'><span lang=FI style='font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>1.</span><span lang=FI style='font-size:7.0pt;font-family:
"Times New Roman","serif";mso-ansi-language:FI'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang=FI style='font-family:"Arial Narrow","sans-serif";mso-ansi-language:
FI'>Pejabat Penilai/Atasan Langsung melakukan penilaian terhadap pejabat
struktural bawahannya berdasarkan penilaian disiplin dan pencapaian kinerja</span></p>

<p class=MsoListParagraph style='margin-top:0in;margin-right:0in;margin-bottom:
0in;margin-left:.25in;margin-bottom:.0001pt;text-align:justify;text-indent:
-.25in;line-height:normal'><span lang=FI style='font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>2.</span><span lang=FI style='font-size:7.0pt;font-family:
"Times New Roman","serif";mso-ansi-language:FI'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang=FI style='font-family:"Arial Narrow","sans-serif";mso-ansi-language:
FI'>Penilaian terhadap Pejabat Struktural yang menggunakan Formulir TPB 02
ditetapkan sebagai berikut:</span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
line-height:normal'><span lang=FI style='font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>a.</span><span lang=FI style='font-size:7.0pt;font-family:
"Times New Roman","serif";mso-ansi-language:FI'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang=FI style='font-family:"Arial Narrow","sans-serif";mso-ansi-language:
FI'>SEKDA dinilai secara tertulis oleh Gubernur.</span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
line-height:normal'><span lang=FI style='font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>b.</span><span lang=FI style='font-size:7.0pt;font-family:
"Times New Roman","serif";mso-ansi-language:FI'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang=FI style='font-family:"Arial Narrow","sans-serif";mso-ansi-language:
FI'>Staf Ahli Gubernur; Asisten Sekretaris Daerah; Sekretaris Majelis Rakyat
Papua, Sekretaris Dewan Perwakilan Rakyat Papua; Kepala SKPD pada Dinas, Badan,
Kantor, Inspektorat dan Satuan Polisi Pamong Praja; dan Direktur Rumah Sakit
dinilai secara tertulis oleh SEKDA;</span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
line-height:normal'><span lang=FI style='font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>c.</span><span lang=FI style='font-size:7.0pt;font-family:
"Times New Roman","serif";mso-ansi-language:FI'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang=FI style='font-family:"Arial Narrow","sans-serif";mso-ansi-language:
FI'>Kepala Biro dinilai secara tertulis oleh Asisten Sekretaris Daerah yang
membidangi;</span></p>

<p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;margin-bottom:.0001pt;text-align:justify;text-indent:-.25in;
line-height:normal'><span lang=FI style='font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>d.</span><span lang=FI style='font-size:7.0pt;font-family:
"Times New Roman","serif";mso-ansi-language:FI'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang=FI style='font-family:"Arial Narrow","sans-serif";mso-ansi-language:
FI'>Kepala Unit Pelaksana Teknis Daerah dinilai secara tertulis oleh Kepala
SKPD;</span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span lang=FI style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>&nbsp;</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>PETUNJUK
KHUSUS:</span></b></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
A: Identitas Pegawai</span></b></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris
1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diisi nama
Pegawai yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris
2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diisi Nomor Induk
Pegawai (NIP) yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris
3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diisi
Pangkat/Golongan Pegawai yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris
4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diisi Jabatan Pegawai
yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris
5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diisi Unit
Kerja/Satuan Kerja Perangkat Daerah Pegawai yang bersangkuta</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
B:&nbsp; Atasan&nbsp; Langsung/Penilai</span></b></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris
1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diisi nama atasan
langsung/penilai dari Pegawai yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris
2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diisi Nomor Induk
Pegawai (NIP) yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris
3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diisi
Pangkat/Golongan Pegawai yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Baris
4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diisi Jabatan
Pegawai yang bersangkutan</span></p>

<p class=MsoNormal align=left style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:70.9pt;margin-bottom:.0001pt;line-height:normal'><b><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
C:&nbsp; Penilaian Disiplin</span></b></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Baris
1:&nbsp;&nbsp;&nbsp;&nbsp; Kehadiran</span></b></p>

<p class=MsoNormal align=left style='margin-left:49.5pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Kehadiran dinilai oleh Atasan
Langsung (Penilai) melalui tiga sub indikator, yaitu: (1) seringnya Pegawai
tidak hadir, (2) seringnya Pegawai datang terlambat, dan (3) seringnya Pegawai
cepat pulang (pulang sebelum jam kantor). </span></p>

<p class=MsoNormal align=left style='margin-left:49.5pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Berdasarkan ketiga sub
indikator penilaian tersebut, Penilai selanjutnya menuliskan <b>Deskripsi
KEHADIRAN</b> Pegawai yang dinilai pada kolom <b>DESKRIPSI PENILAIAN</b>
kemudian memberikan penilaian terhadap Pegawai bersangkutan dengan mencentang (&#8730;)
kolom <b>KRITERIA PENILAIAN</b> (<b>STB, KB, C, B, </b>atau <b>SB</b>).</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Baris
2: &nbsp;&nbsp;&nbsp; Kepatuhan</span></b></p>

<p class=MsoNormal align=left style='margin-left:49.5pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Kepatuhan dinilai oleh Atasan
Langsung (Penilai) dengan menggunakan tiga sub indikator penilaian, yaitu: (1)
Pegawai tidak pernah meninggalkan tugas tanpa izin selama jam kerja; (2)
Pegawai selalu mengikuti kegiatan kenegaraan/rapat/senam/lain-lain; dan (3)
Pegawai selalu menggunakan pakaian seragam/tanda pengenal/badge sesuai hari
kerja. </span></p>

<p class=MsoNormal align=left style='margin-left:49.5pt;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Berdasarkan ketiga sub
indikator penilaian tersebut, Penilai selanjutnya menuliskan <b>Deskripsi
Tingkat KEPATUHAN</b> Pegawai yang dinilai pada kolom <b>DESKRIPSI PENILAIAN</b>
kemudian memberikan penilaian terhadap Pegawai bersangkutan dengan mencentang (&#8730;)
kolom <b>KRITERIA PENILAIAN</b> (<b>STB, KB, C, B, </b>atau <b>SB</b>).</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>&nbsp;</span></b></p>

<b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
mso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA'><br
clear=all style='page-break-before:always'>
</span></b>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
D:&nbsp; Pencapaian Kinerja</span></b></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Baris
1:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Prestasi</span></b></p>

<p class=MsoNormal align=left style='margin-left:.75in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Prestasi seorang Pegawai dapat
dinilai dari beberapa sub indikator, di antaranya: (1) ketepatan waktu
penyelesaian tugas, (2) manfaat dari pekerjaan yang diselesaiakan (misalnya
dapat mendukung pekerjaan bawahan, rekan kerja, atasan, dan memenuhi kebutuhan
masyarakat), (3) kuantitas atau jumlah pekerjaan yang diselesaikan, (4)
kualitas hasil pekerjaan (misalnya apakah sudah sesuai dengan Standar Operasi
dan Prosedur (SOP), Standar Pelayanan Minimum (SPM), atau standar lain yang
ditentukan oleh SKPD atau Atasan Langsungnya), dan (5) apakah pekerjaan yang diselesaikan
tersebut telah sesuai dengan petunjuk/instruksi/pedoman yang diberikan
kepadanya. </span></p>

<p class=MsoNormal align=left style='margin-left:.75in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Berdasarkan beberapa sub
indikator penilaian tersebut, Penilai selanjutnya menuliskan <b>Deskripsi
PRESTASI</b> Pegawai yang dinilai pada kolom <b>DESKRIPSI PENILAIAN</b> kemudian
memberikan penilaian terhadap Pegawai bersangkutan dengan mencentang (&#8730;)
kolom <b>KRITERIA PENILAIAN</b> (<b>STB, KB, C, B, </b>atau <b>SB</b>).</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Baris
2:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Inovasi dan Kreativitas</span></b></p>

<p class=MsoNormal align=left style='margin-left:.75in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Inovasi dan Kreativitas seorang
Pegawai dapat dinilai melalui beberapa sub indikator, di antaranya: (1) Pegawai
memiliki pemikiran, gagasan, dan ide-ide baru yang bersifat membangun sesuai
dengan TUPOKSI, (2) Pegawai menunjukkan keterbukaan dalam menerima ide/gagasan
baru yang diberikan oleh rekan kerja, pimpinan, atau para pemangku kepentingan,
dan (3) Pegawai tanggap dalam mengantisipasi perubahan organisasi/lingkungan.</span></p>

<p class=MsoNormal align=left style='margin-left:.75in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif"'>Berdasarkan beberapa sub
indikator penilaian tersebut, Penilai selanjutnya menuliskan Deskripsi <b>INOVASI
dan KREATIVITAS</b> Pegawai yang dinilai pada kolom <b>DESKRIPSI PENILAIAN</b>
kemudian memberikan penilaian terhadap Pegawai bersangkutan dengan mencentang (&#8730;)
kolom <b>KRITERIA PENILAIAN</b> (<b>STB, KB, C, B, </b>atau <b>SB</b>).</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Baris
3:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kemampuan Managerial</span></b></p>

<p class=MsoNormal align=left style='margin-left:.75in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif";color:black'>Kemampuan
Managerial Pegawai dapat dinilai </span><span style='font-family:"Arial Narrow","sans-serif"'>melalui<span
style='color:black'> keterampilan dan kemampuan dalam mengelola unit/instansi
yang dipimpinnya. </span>Berdasarkan aspek penilaian tersebut, Atasan Langsung
selanjutnya menuliskan <b>Deskripsi KEMAMPUAN MANAGERIAL</b> Pegawai yang
dinilai pada kolom <b>DESKRIPSI PENILAIAN</b> kemudian memberikan penilaian
terhadap Pegawai bersangkutan dengan mencentang (&#8730;) kolom <b>KRITERIA
PENILAIAN</b> (<b>STB, KB, C, B, </b>atau <b>SB</b>).</span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Baris
4:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kemampuan Interpersonal</span></b></p>

<p class=MsoNormal align=left style='margin-left:.75in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif";color:black'>Kemampuan
Interpersonal Pegawai dapat dinilai melalui beberapa sub indikator, di
antaranya: (1) Pegawai dapat bekerjasama dengan bawahan/rekan kerja/pimpinan
dalam lingkup unit/</span><span style='font-family:"Arial Narrow","sans-serif"'>instansi<span
style='color:black'> yang dikelolanya, dan (2) Pegawai mampu berkomunikasi
dengan baik kepada bawahan/rekan kerja/pimpinan dan/atau para pemangku
kepentingan (misalnya: masyarakat dan instansi terkait lainnya).</span></span></p>

<p class=MsoNormal align=left style='margin-left:.75in;line-height:normal'><span
style='font-family:"Arial Narrow","sans-serif";color:black'>Berdasarkan
beberapa sub indikator penilaian tersebut, Penilai </span><span
style='font-family:"Arial Narrow","sans-serif"'>selanjutnya<span
style='color:black'> menuliskan Deskripsi <b>KEMAMPUAN INTERPERSONAL</b>
Pegawai yang dinilai pada kolom <b>DESKRIPSI PENILAIAN</b> kemudian memberikan
penilaian terhadap Pegawai bersangkutan dengan mencentang (&#8730;) kolom <b>KRITERIA
PENILAIAN</b> </span>(<b>STB, KB, C, B, atau SB).</b></span></p>

<p class=MsoNormal align=left style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>BAGIAN
E:&nbsp; PERNYATAAN ATASAN LANGSUNG/ PENILAI</span></b></p>

<p class=MsoListParagraph align=left style='margin:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-family:"Arial Narrow","sans-serif"'>Formulir TPB 02 </span><span
lang=FI style='font-family:"Arial Narrow","sans-serif";mso-ansi-language:FI'>yang
telah diisi dan ditandatangani oleh Pejabat Penilai/Atasan Langsung diserahkan
kepada Pejabat Penatausahaan Keuangan atau petugas yang ditunjuk di
masing-masing SKPD paling lambat tanggal 5 (lima) pada bulan berikutnya untuk
direkapitulasi.</span></p>

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