<?php
$db = $this->db;
$util = $this->util;
$image = $this->cnf->ROOTDIR."img/image003.png";

if(!empty($_POST['nip'])) {
	$res = $db->query("SELECT nip,nama,pendidikan, golongan, pangkat, eselon,gol1, gol2, jabatan, unit,subunit, id, skpd.skpd, status, namaa,nipa,golongana,jabatana,tpb FROM pegawai LEFT JOIN skpd on id = pegawai.skpd WHERE nip = '".$db->esc($_POST['nip'])."'");
	list($nip,$nama, $pendidikan, $golongan, $pangkat,  $eselon, $gol1, $gol2, $jabatan, $unit, $subunit, $skpd, $nama_skpd, $status,$namaa,$nipa,$golongana,$jabatana,$tpb) = $db->fetchArray($res);
}

$jeneng=$nama;
$nipp=$nip;
$nipaa=(trim($nipa)!=''?$nipa:'____________________');
$jenenga=(trim($namaa)!=''?$namaa:'________________________');
$wulan=$_POST['bulan'];
$taun= $_POST['tahun'];

if(!empty($_POST['bulan'])){

	$nm="formtpb01_".$nip.".doc";
	header("Content-Type: application/vnd.ms-word; name='word'"); 
	header("Content-type: application/octet-stream"); 
	header("Content-Disposition: attachment; filename=".$nm); 
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("Pragma: no-cache"); 
	header("Expires: 0"); 
?>	
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<title>FORM TPB 01 - <?php echo $nm; ?></title>
<style>
body{font:76% "Arial",arial,sans-serif;color: #333;text-align:center;padding: 10px}
</style>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 12">
<meta name=Originator content="Microsoft Word 12">
<link rel=File-List href="tpb/filelist.xml">
<link rel=Edit-Time-Data href="tpb/editdata.mso">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
w\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Wendy</o:Author>
  <o:Template>Normal</o:Template>
  <o:LastAuthor>bianglala</o:LastAuthor>
  <o:Revision>5</o:Revision>
  <o:TotalTime>1920</o:TotalTime>
  <o:Created>2010-09-17T07:31:00Z</o:Created>
  <o:LastSaved>2010-09-18T04:20:00Z</o:LastSaved>
  <o:Pages>2</o:Pages>
  <o:Words>841</o:Words>
  <o:Characters>4798</o:Characters>
  <o:Company>Gadjah Mada Univ</o:Company>
  <o:Lines>39</o:Lines>
  <o:Paragraphs>11</o:Paragraphs>
  <o:CharactersWithSpaces>5628</o:CharactersWithSpaces>
  <o:Version>12.00</o:Version>
 </o:DocumentProperties>
</xml><![endif]-->
<link rel=themeData href="tpb/themedata.thmx">
<link rel=colorSchemeMapping href="tpb/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:PunctuationKerning/>
  <w:DrawingGridHorizontalSpacing>0 pt</w:DrawingGridHorizontalSpacing>
  <w:DisplayHorizontalDrawingGridEvery>2</w:DisplayHorizontalDrawingGridEvery>
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
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
p.MsoFootnoteText, li.MsoFootnoteText, div.MsoFootnoteText
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Footnote Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Header Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 3.25in right 6.5in;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Footer Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 3.25in right 6.5in;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
span.MsoFootnoteReference
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"";
	vertical-align:super;}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Balloon Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
p.MsoNoSpacing, li.MsoNoSpacing, div.MsoNoSpacing
	{mso-style-priority:1;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
span.FootnoteTextChar
	{mso-style-name:"Footnote Text Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"";
	mso-style-link:"Footnote Text";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
span.HeaderChar
	{mso-style-name:"Header Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"";
	mso-style-link:Header;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
span.FooterChar
	{mso-style-name:"Footer Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"";
	mso-style-link:Footer;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"";
	mso-style-link:"Balloon Text";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:8.0pt;
	font-family:"Tahoma","sans-serif";
	mso-ascii-font-family:Tahoma;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Tahoma;
	mso-bidi-font-family:Tahoma;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	font-size:10.0pt;
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Calibri;}
 /* Page Definitions */
/*@page
	{mso-footnote-separator:url("tpb/header.html") fs;
	mso-footnote-continuation-separator:url("tpb/header.html") fcs;
	mso-endnote-separator:url("tpb/header.html") es;
	mso-endnote-continuation-separator:url("tpb/header.html") ecs;}*/
@page Section1
	{size:595.35pt 841.95pt;
	margin:70.9pt 70.9pt 70.9pt 70.9pt;
	mso-header-margin:.5in;
	mso-footer-margin:.5in;
	/*mso-footer:url("tpb/header.html") f1;*/
	mso-paper-source:0;}
div.Section1
	{page:Section1;}
@page Section2
	{size:841.95pt 595.35pt;
	mso-page-orientation:landscape;
	margin:56.7pt 56.7pt 56.7pt 56.7pt;
	mso-header-margin:.5in;
	mso-footer-margin:.5in;
	/*mso-footer:url("tpb/header.html") f1;*/
	mso-paper-source:0;}
div.Section2
	{page:Section2;}
@page Section3
	{size:595.35pt 841.95pt;
	margin:56.7pt 56.7pt 56.7pt 56.7pt;
	mso-header-margin:.5in;
	mso-footer-margin:.5in;
	/*mso-footer:url("tpb/header.html") f1;*/
	mso-paper-source:0;}
div.Section3
	{page:Section3;}
 /* List Definitions */
 @list l0
	{mso-list-id:101732338;
	mso-list-type:hybrid;
	mso-list-template-ids:1410210850 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l0:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level2
	{mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level3
	{mso-level-tab-stop:1.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level4
	{mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level5
	{mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level6
	{mso-level-tab-stop:3.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level7
	{mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level8
	{mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l0:level9
	{mso-level-tab-stop:4.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1
	{mso-list-id:679625697;
	mso-list-type:hybrid;
	mso-list-template-ids:1466721124 1403024036 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l1:level1
	{mso-level-number-format:alpha-lower;
	mso-level-text:"Kolom \(%1\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.25in;
	text-indent:-.5in;}
@list l1:level2
	{mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level3
	{mso-level-tab-stop:1.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level4
	{mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level5
	{mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level6
	{mso-level-tab-stop:3.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level7
	{mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level8
	{mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l1:level9
	{mso-level-tab-stop:4.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l2
	{mso-list-id:918758888;
	mso-list-type:hybrid;
	mso-list-template-ids:-1133320978 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l2:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l2:level2
	{mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l2:level3
	{mso-level-tab-stop:1.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l2:level4
	{mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l2:level5
	{mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l2:level6
	{mso-level-tab-stop:3.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l2:level7
	{mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l2:level8
	{mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l2:level9
	{mso-level-tab-stop:4.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3
	{mso-list-id:1113986692;
	mso-list-type:hybrid;
	mso-list-template-ids:-1678485312 429029526 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l3:level1
	{mso-level-number-format:alpha-lower;
	mso-level-text:"\(%1\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level2
	{mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level3
	{mso-level-tab-stop:1.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level4
	{mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level5
	{mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level6
	{mso-level-tab-stop:3.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level7
	{mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level8
	{mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level9
	{mso-level-tab-stop:4.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4
	{mso-list-id:1601836891;
	mso-list-type:hybrid;
	mso-list-template-ids:-274312214 815937344 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l4:level1
	{mso-level-text:"Baris \(%1\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:31.5pt;
	text-indent:-.25in;}
@list l4:level2
	{mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level3
	{mso-level-tab-stop:1.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level4
	{mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level5
	{mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level6
	{mso-level-tab-stop:3.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level7
	{mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level8
	{mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level9
	{mso-level-tab-stop:4.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5
	{mso-list-id:1703819707;
	mso-list-type:hybrid;
	mso-list-template-ids:-274312214 815937344 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l5:level1
	{mso-level-text:"Baris \(%1\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:31.5pt;
	text-indent:-.25in;}
@list l5:level2
	{mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level3
	{mso-level-tab-stop:1.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level4
	{mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level5
	{mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level6
	{mso-level-tab-stop:3.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level7
	{mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level8
	{mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level9
	{mso-level-tab-stop:4.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l6
	{mso-list-id:2066491742;
	mso-list-type:hybrid;
	mso-list-template-ids:1172312870 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l6:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l6:level2
	{mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l6:level3
	{mso-level-tab-stop:1.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l6:level4
	{mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l6:level5
	{mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l6:level6
	{mso-level-tab-stop:3.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l6:level7
	{mso-level-tab-stop:3.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l6:level8
	{mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l6:level9
	{mso-level-tab-stop:4.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
ol
	{margin-bottom:0in;}
ul
	{margin-bottom:0in;}
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
	font-family:"Calibri","sans-serif";
	mso-bidi-font-family:"Times New Roman";}
table.MsoTableGrid
	{mso-style-name:"Table Grid";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:59;
	mso-style-unhide:no;
	border:solid black 1.0pt;
	mso-border-alt:solid black .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid black;
	mso-border-insidev:.5pt solid black;
	mso-para-margin:0in;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="16386"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=EN-US style='tab-interval:.5in'>

<div class=Section1>

<p class=MsoHeader><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='margin-bottom:6.0pt;text-align:center;
line-height:normal'><span style='mso-no-proof:yes'><!--[if gte vml 1]><v:shapetype
 id="_x0000_t75" coordsize="21600,21600" o:spt="75" o:preferrelative="t"
 path="m@4@5l@4@11@9@11@9@5xe" filled="f" stroked="f">
 <v:stroke joinstyle="miter"/>
 <v:formulas>
  <v:f eqn="if lineDrawn pixelLineWidth 0"/>
  <v:f eqn="sum @0 1 0"/>
  <v:f eqn="sum 0 0 @1"/>
  <v:f eqn="prod @2 1 2"/>
  <v:f eqn="prod @3 21600 pixelWidth"/>
  <v:f eqn="prod @3 21600 pixelHeight"/>
  <v:f eqn="sum @0 0 1"/>
  <v:f eqn="prod @6 1 2"/>
  <v:f eqn="prod @7 21600 pixelWidth"/>
  <v:f eqn="sum @8 21600 0"/>
  <v:f eqn="prod @7 21600 pixelHeight"/>
  <v:f eqn="sum @10 21600 0"/>
 </v:formulas>
 <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
 <o:lock v:ext="edit" aspectratio="t"/>
</v:shapetype><v:shape id="Picture_x0020_2" o:spid="_x0000_i1025" type="#_x0000_t75"
 style='width:57.75pt;height:60.75pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="<?php echo $image; ?>" o:title=""/>
</v:shape><![endif]--><![if !vml]>
  <span class="MsoNormal" style="margin-bottom:6.0pt;text-align:center;
line-height:normal"><img width=77 height=81
src="<?php echo $image; ?>" v:shapes="Picture_x0020_2"></span>
  <![endif]></span></p>

<div style='mso-element:para-border-div;border:none;border-bottom:double windowtext 2.25pt;
padding:0in 0in 1.0pt 0in'>

<p class=MsoNormal align=center style='margin-bottom:6.0pt;text-align:center;
line-height:normal;border:none;mso-border-bottom-alt:double windowtext 2.25pt;
padding:0in;mso-padding-alt:0in 0in 1.0pt 0in'><b style='mso-bidi-font-weight:
normal'><span lang=ES style='font-size:16.0pt;mso-bidi-font-size:12.0pt;
font-family:"Arial Narrow","sans-serif";mso-ansi-language:ES'>PEMERINTAH
PROVINSI PAPUA<o:p></o:p></span></b></p>

</div>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
lang=FI style='font-size:9.0pt;mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
lang=FI style='font-size:14.0pt;font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>FORMULIR</span></b><b style='mso-bidi-font-weight:normal'><span
lang=ES style='font-size:14.0pt;font-family:"Arial Narrow","sans-serif";
mso-ansi-language:ES'> TPB 01<o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
lang=ES style='font-size:14.0pt;font-family:"Arial Narrow","sans-serif";
mso-ansi-language:ES'>KONTRAK TARGET KERJA </span></b><b style='mso-bidi-font-weight:
normal'><span lang=FI style='font-size:14.0pt;font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>PEGAWAI NEGERI SIPIL<span style='mso-spacerun:yes'> 
</span>(PNS)<o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='margin-bottom:6.0pt;text-align:center;
line-height:150%'><b style='mso-bidi-font-weight:normal'><span lang=FI
style='mso-bidi-font-size:12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'>(Diisi oleh PNS bersangkutan)<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
150%'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;
line-height:150%;font-family:"Arial Narrow","sans-serif"'>Triwulan</span></b><span
style='font-size:12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif"'>
<b style='mso-bidi-font-weight:normal'>ke </span><span style='font-size:
12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif"'><?php echo $util->triwulan($wulan);?></b></span><span
style='font-size:12.0pt;line-height:150%;font-family:"Arial Narrow","sans-serif"'><span
style='mso-spacerun:yes'>  </span><b style='mso-bidi-font-weight:normal'>Tahun <?php echo $taun;?></b><o:p></o:p></span></p>
<center>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="55%"
 style='width:55.34%;border-collapse:collapse;border:none;mso-border-alt:solid black .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:
 .5pt solid black;mso-border-insidev:.5pt solid black'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes' align="left">
  <td width="100%" colspan=2 style='width:100.0%;border:solid black 1.0pt;
  mso-border-alt:solid black .5pt;background:black;padding:0in 5.4pt 0in 5.4pt;color:#FFFFFF'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b style='mso-bidi-font-weight:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt;font-family:
  "Arial Narrow","sans-serif"'>BAGIAN<span style='mso-spacerun:yes'> 
  </span>A:<span style='mso-spacerun:yes'>  </span>IDENTITAS<span
  style='mso-spacerun:yes'>  </span>PEGAWAI<o:p></o:p></span></b></p>
  </td>
 </tr>
 
 <tr style='mso-yfti-irow:3' align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:13.5pt;text-indent:-13.5pt;line-height:normal;mso-list:
  l2 level1 lfo2'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Nama<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><o:p><?php echo $nama; ?></o:p></span></p>
  </td>
 </tr>
  <tr style='mso-yfti-irow:3' align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:13.5pt;text-indent:-13.5pt;line-height:normal;mso-list:
  l2 level1 lfo2'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>NIP<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><o:p><?php echo $util->formatNIP($nip); ?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3' align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:13.5pt;text-indent:-13.5pt;line-height:normal;mso-list:
  l2 level1 lfo2'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Pangkat/Golongan<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><o:p><?php echo $golongan; ?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4' align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:13.5pt;text-indent:-13.5pt;line-height:normal;mso-list:
  l2 level1 lfo2'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Jabatan
  <o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoListParagraph style='margin-top:4.0pt;margin-right:0in;
  margin-bottom:4.0pt;margin-left:.35pt;mso-add-space:auto;line-height:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'><o:p><?php echo $jabatan; ?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:13.5pt;text-indent:-13.5pt;line-height:normal;mso-list:
  l2 level1 lfo2'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>5.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Pendidikan
  Terakhir<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><o:p><?php echo $pendidikan; ?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6' align="left">
  <td width="32%" rowspan=6 valign=top style='width:32.14%;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:13.5pt;text-indent:-13.5pt;line-height:normal;mso-list:
  l2 level1 lfo2'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>6.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Uraian
  Tugas<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:.5in;text-indent:-.5in;line-height:normal;mso-list:l3 level1 lfo4'><![if !supportLists]><span
  style='font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:"Arial Narrow";
  mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>(a)<span
  style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7' align="left">
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:.5in;text-indent:-.5in;line-height:normal;mso-list:l3 level1 lfo4'><![if !supportLists]><span
  style='font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:"Arial Narrow";
  mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>(b)<span
  style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8' align="left">
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:.5in;text-indent:-.5in;line-height:normal;mso-list:l3 level1 lfo4'><![if !supportLists]><span
  style='font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:"Arial Narrow";
  mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>(c)<span
  style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9' align="left">
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:.5in;text-indent:-.5in;line-height:normal;mso-list:l3 level1 lfo4'><![if !supportLists]><span
  style='font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:"Arial Narrow";
  mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>(d)<span
  style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10' align="left">
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'>(e)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11' align="left">
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'>(f)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12' align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:13.5pt;text-indent:-13.5pt;line-height:normal;mso-list:
  l2 level1 lfo2'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>7.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Unit
  Kerja/SKPD<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><o:p><?php echo $unit."/".$nama_skpd; ?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13' align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:13.5pt;text-indent:-13.5pt;line-height:normal;mso-list:
  l2 level1 lfo2'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>8.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Sub
  unit Kerja<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif"'><o:p><?php echo $subunit ?></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14' align="left">
  <td width="100%" colspan=2 style='width:100.0%;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:black;padding:0in 5.4pt 0in 5.4pt;color:#FFFFFF'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><b style='mso-bidi-font-weight:
  normal'><span style='font-size:14.0pt;mso-bidi-font-size:11.0pt;font-family:
  "Arial Narrow","sans-serif"'>BAGIAN<span style='mso-spacerun:yes'> 
  </span>B:<span style='mso-spacerun:yes'>  </span>ATASAN<span
  style='mso-spacerun:yes'>  </span>LANGSUNG/PENILAI<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15' align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:12.95pt;text-indent:-12.95pt;line-height:normal;mso-list:
  l0 level1 lfo6'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Nama<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'><?php echo $namaa;?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16' align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:12.95pt;text-indent:-12.95pt;line-height:normal;mso-list:
  l0 level1 lfo6'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Nomor
  Induk Pegawai<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'><?php echo $util->formatNIP($nipa); ?></span><span style='font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:17' align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:12.95pt;text-indent:-12.95pt;line-height:normal;mso-list:
  l0 level1 lfo6'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Pangkat/Golongan<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'><?php echo $golongana ?></span><span style='font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18;mso-yfti-lastrow:yes' align="left">
  <td width="32%" style='width:32.14%;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:12.95pt;text-indent:-12.95pt;line-height:normal;mso-list:
  l0 level1 lfo6'><![if !supportLists]><span style='font-family:"Arial Narrow","sans-serif";
  mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
  style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
  </span></span></span><![endif]><span style='font-family:"Arial Narrow","sans-serif"'>Jabatan
  Struktural<o:p></o:p></span></p>
  </td>
  <td width="67%" style='width:67.86%;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:4.0pt;margin-right:0in;margin-bottom:
  4.0pt;margin-left:0in;line-height:normal'><span style='font-family:"Arial Narrow","sans-serif";
  color:black'><?php echo $jabatana; ?></span><span style='font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>
  </td>
 </tr>
</table>
</center>
<p class=MsoNormal><span style='font-size:12.0pt;line-height:115%;font-family:
"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>

</div>

<span style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:Calibri;mso-bidi-font-family:"Times New Roman";
mso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA'><br
clear=all style='page-break-before:always;mso-break-type:section-break'>
</span>

<div class=Section2>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=997
 style='width:743.15pt;border-collapse:collapse;border:none;mso-border-alt:
 solid black .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;
 mso-border-insideh:.5pt solid black;mso-border-insidev:.5pt solid black'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:9.75pt'>
  <td colspan=2 valign=top style='width:62.0pt;border-top:black;
  border-left:black;border-bottom:windowtext;border-right:windowtext;
  border-style:solid;border-width:1.0pt;mso-border-top-alt:black;mso-border-left-alt:
  black;mso-border-bottom-alt:windowtext;mso-border-right-alt:windowtext;
  mso-border-style-alt:solid;mso-border-width-alt:.5pt;background:black;
  padding:0in 5.4pt 0in 5.4pt;height:9.75pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
  12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td colspan=8 style='width:681.15pt;border-top:solid black 1.0pt;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid black .5pt;mso-border-top-alt:black;mso-border-left-alt:
  black;mso-border-bottom-alt:windowtext;mso-border-right-alt:windowtext;
  mso-border-style-alt:solid;mso-border-width-alt:.5pt;background:black;
  padding:0in 5.4pt 0in 5.4pt;height:9.75pt;color:#FFFFFF'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:14.0pt;mso-bidi-font-size:
  12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>BAGIAN
  C:<span style='mso-spacerun:yes'>  </span>KONTRAK TARGET KERJA PEGAWAI<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:6.0pt'>
  <td width=32 rowspan=3 style='width:24.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid black .5pt;
  mso-border-top-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
  height:6.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><b style='mso-bidi-font-weight:normal'><span
  style='font-family:"Arial Narrow","sans-serif"'>No</span></b><span
  style='font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>
  </td>
  <td colspan=2 rowspan=3 style='width:221.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;mso-border-top-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:6.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Aktivitas <o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>(Rencana
  Kerja)<o:p></o:p></span></b></p>
  </td>
  <td width=37 rowspan=3 style='width:29.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:
  solid black .5pt;mso-border-top-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
  height:6.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>I
  / E<o:p></o:p></span></b></p>
  </td>
  <td width=256 rowspan=3 style='width:193.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;mso-border-top-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:6.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>Bentuk<o:p></o:p></span></b></p>
  </td>
  <td colspan=5 valign=top style='width:274.5pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-top-alt:windowtext;mso-border-left-alt:black;mso-border-bottom-alt:
  black;mso-border-right-alt:windowtext;mso-border-style-alt:solid;mso-border-width-alt:
  .5pt;padding:0in 5.4pt 0in 5.4pt;height:6.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>Triwulan
  ke: <?php echo $util->triwulan($wulan);?><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:.2in'>
  <td colspan=5 valign=top style='width:274.5pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Target <o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>(diisi oleh
  Pegawai)<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:.2in'>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:10.0pt;
  font-family:"Arial Narrow","sans-serif"'>Bulan ke - <?php echo $wulan; ?><o:p></o:p></span></p>
  </td>
  <td width=70 style='width:.75in;border-top:none;border-left:none;border-bottom:
  solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:10.0pt;
  font-family:"Arial Narrow","sans-serif"'>Waktu<o:p></o:p></span></p>
  </td>
  <td width=70 style='width:.75in;border-top:none;border-left:none;border-bottom:
  solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:10.0pt;
  font-family:"Arial Narrow","sans-serif"'>Manfaat<o:p></o:p></span></p>
  </td>
  <td width=76 style='width:58.5pt;border-top:none;border-left:none;border-bottom:
  solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:10.0pt;
  font-family:"Arial Narrow","sans-serif"'>Kuantitas<o:p></o:p></span></p>
  </td>
  <td width=70 style='width:.75in;border-top:none;border-left:none;border-bottom:
  solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:10.0pt;
  font-family:"Arial Narrow","sans-serif"'>Kualitas<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:.2in'>
  <td width=32 style='width:24.75pt;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><span style='font-family:"Arial Narrow","sans-serif"'>(a)<o:p></o:p></span></p>
  </td>
  <td colspan=2 style='width:221.65pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><span style='font-family:"Arial Narrow","sans-serif"'>(b)<o:p></o:p></span></p>
  </td>
  <td width=37 style='width:29.0pt;border-top:none;border-left:none;border-bottom:
  solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><span style='font-family:"Arial Narrow","sans-serif"'>(c)<o:p></o:p></span></p>
  </td>
  <td width=256 style='width:193.25pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><span style='font-family:"Arial Narrow","sans-serif"'>(d)<o:p></o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><span style='font-family:"Arial Narrow","sans-serif"'>(e)<o:p></o:p></span></p>
  </td>
  <td width=70 style='width:.75in;border-top:none;border-left:none;border-bottom:
  solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><span style='font-family:"Arial Narrow","sans-serif"'>(f)<o:p></o:p></span></p>
  </td>
  <td width=70 style='width:.75in;border-top:none;border-left:none;border-bottom:
  solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><span style='font-family:"Arial Narrow","sans-serif"'>(g)<o:p></o:p></span></p>
  </td>
  <td width=76 style='width:58.5pt;border-top:none;border-left:none;border-bottom:
  solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><span style='font-family:"Arial Narrow","sans-serif"'>(h)<o:p></o:p></span></p>
  </td>
  <td width=70 style='width:.75in;border-top:none;border-left:none;border-bottom:
  solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center'><span style='font-family:"Arial Narrow","sans-serif"'>(i)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:.2in'>
  <td width=32 valign=top style='width:24.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>1<o:p></o:p></span></p>
  </td>
  <td colspan=2 valign=top style='width:221.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=37 valign=top style='width:29.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=256 valign=top style='width:193.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=76 valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:.2in'>
  <td width=32 valign=top style='width:24.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>2<o:p></o:p></span></p>
  </td>
  <td colspan=2 valign=top style='width:221.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=37 valign=top style='width:29.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=256 valign=top style='width:193.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=76 valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:.2in'>
  <td width=32 valign=top style='width:24.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>3<o:p></o:p></span></p>
  </td>
  <td colspan=2 valign=top style='width:221.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=37 valign=top style='width:29.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=256 valign=top style='width:193.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=76 valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:.2in'>
  <td width=32 valign=top style='width:24.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>4<o:p></o:p></span></p>
  </td>
  <td colspan=2 valign=top style='width:221.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=37 valign=top style='width:29.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=256 valign=top style='width:193.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=76 valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:.2in'>
  <td width=32 valign=top style='width:24.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>5<o:p></o:p></span></p>
  </td>
  <td colspan=2 valign=top style='width:221.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=37 valign=top style='width:29.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=256 valign=top style='width:193.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=76 valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:.2in'>
  <td width=32 valign=top style='width:24.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'>…<o:p></o:p></span></p>
  </td>
  <td colspan=2 valign=top style='width:221.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=37 valign=top style='width:29.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=256 valign=top style='width:193.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=76 valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;mso-yfti-lastrow:yes;height:.2in'>
  <td width=32 valign=top style='width:24.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:10.0pt;
  font-family:"Arial Narrow","sans-serif"'>dst<o:p></o:p></span></p>
  </td>
  <td colspan=2 valign=top style='width:221.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=37 valign=top style='width:29.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=256 valign=top style='width:193.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=76 valign=top style='width:58.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=70 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:.2in'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
  justify;line-height:normal'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=32 style='border:none'></td>
  <td width=47 style='border:none'></td>
  <td width=247 style='border:none'></td>
  <td width=37 style='border:none'></td>
  <td width=256 style='border:none'></td>
  <td width=70 style='border:none'></td>
  <td width=70 style='border:none'></td>
  <td width=70 style='border:none'></td>
  <td width=76 style='border:none'></td>
  <td width=70 style='border:none'></td>
 </tr>
 <![endif]>
</table>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:6.0pt;line-height:normal'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:
"Arial Narrow","sans-serif"'>(D)<span style='mso-spacerun:yes'> 
</span>PERNYATAAN PEGAWAI</span></b><span style='font-size:12.0pt;font-family:
"Arial Narrow","sans-serif"'><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style='margin-top:0in;margin-right:-2.25pt;
margin-bottom:10.0pt;margin-left:24.75pt;mso-add-space:auto;text-align:justify;
line-height:normal;tab-stops:6.3in'><span style='font-size:12.0pt;font-family:
"Arial Narrow","sans-serif"'>Saya menyatakan akan melaksanakan Kontrak Target
Kerja ini dengan sebaik-baiknya. Apabila hasil penilaian kinerja saya di akhir
perioda tidak sesuai dengan rencana target kerja tersebut maka saya bersedia
menerima sanksi berupa pemotongan <b style='mso-bidi-font-weight:normal'>Tambahan
Penghasilan Bersyarat</b> <b style='mso-bidi-font-weight:normal'>(TPB)</b>
sesuai dengan Peraturan yang berlaku di lingkungan Pemerintah Provinsi Papua.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style='margin-top:0in;margin-right:19.35pt;
margin-bottom:10.0pt;margin-left:.25in;mso-add-space:auto;line-height:normal;
tab-stops:6.0in'><span style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=981
 style='width:735.45pt;border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 5.4pt 0in 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=327 valign=top style='width:245.15pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:25.65pt;text-align:center'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
  115%;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.3pt;
  margin-bottom:0in;margin-left:25.5pt;margin-bottom:.0001pt;text-align:center;
  line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Mengetahui<o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.3pt;
  margin-bottom:0in;margin-left:25.5pt;margin-bottom:.0001pt;text-align:center;
  line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Kepala SKPD</span></b><span
  style='font-size:8.0pt;font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:0in;margin-left:25.65pt;margin-bottom:.0001pt;text-align:center;
  line-height:200%'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;line-height:200%;font-family:"Arial Narrow","sans-serif"'>(<span
  style='mso-spacerun:yes'>                                                         )</span>
    <o:p></o:p></span></u></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>NIP. </span></b><span
  style='font-size:8.0pt;font-family:"Arial Narrow","sans-serif"'>……………………………..…………….</span><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>
  </td>
  <td width=327 valign=top style='width:245.15pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:25.65pt;text-align:center'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
  115%;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.3pt;
  margin-bottom:0in;margin-left:25.5pt;margin-bottom:.0001pt;text-align:center;
  line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Dibimbing
  dan Disetujui<o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.3pt;
  margin-bottom:0in;margin-left:25.5pt;margin-bottom:.0001pt;text-align:center;
  line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Atasan
  Langsung/Penilai</span></b><span style='font-size:8.0pt;font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:0in;margin-left:25.65pt;margin-bottom:.0001pt;text-align:center;
  line-height:200%'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;line-height:200%;font-family:"Arial Narrow","sans-serif"'>(<span
  style='mso-spacerun:yes'> <?php echo $jenenga; ?>) </span>
    <o:p></o:p></span></u></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>NIP. </span></b><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><?php echo $util->formatNIP($nipa); ?></span><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>
  </td>
  <td width=327 valign=top style='width:245.15pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.45pt;
  margin-bottom:0in;margin-left:25.65pt;margin-bottom:.0001pt;text-align:center'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
  115%;font-family:"Arial Narrow","sans-serif"'>Jayapura</span></b><span
  style='font-size:12.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>,
  </span><span style='font-size:8.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'>………………………………………<o:p></o:p></span></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:25.65pt;text-align:center'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
  115%;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:10.0pt;margin-left:25.65pt;text-align:center'><b
  style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
  115%;font-family:"Arial Narrow","sans-serif"'>Pegawai</span></b><span
  style='font-size:8.0pt;line-height:115%;font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNoSpacing align=center style='margin-left:25.65pt;text-align:
  center'><span style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:0in;margin-left:25.65pt;margin-bottom:.0001pt;text-align:center'><b
  style='mso-bidi-font-weight:normal'><u><span style='font-size:12.0pt;
  line-height:115%;font-family:"Arial Narrow","sans-serif"'><o:p><span
   style='text-decoration:none'>&nbsp;</span></o:p></span></u></b></p>
  <p class=MsoNormal align=center style='margin-top:0in;margin-right:19.35pt;
  margin-bottom:0in;margin-left:25.65pt;margin-bottom:.0001pt;text-align:center;
  line-height:200%'><b style='mso-bidi-font-weight:normal'><u><span
  style='font-size:12.0pt;line-height:200%;font-family:"Arial Narrow","sans-serif"'>(<span
  style='mso-spacerun:yes'><?php echo $jeneng; ?></span>)
    <o:p></o:p></span></u></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>NIP. </span></b><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><?php echo $util->formatNIP($nipp); ?></span><span
  style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes'>
  <td width=327 valign=top style='width:245.15pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=327 valign=top style='width:245.15pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=327 valign=top style='width:245.15pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:12.0pt;
  font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:6.0pt;line-height:normal;tab-stops:
-4.5pt'><b style='mso-bidi-font-weight:normal'><span style='font-family:"Arial Narrow","sans-serif"'>Catatan:<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><span style='font-family:"Arial Narrow","sans-serif"'>Apabila
<b style='mso-bidi-font-weight:normal'>Atasan Langsung</b> atau <b
style='mso-bidi-font-weight:normal'>Penilai</b> dari <b style='mso-bidi-font-weight:
normal'>Pegawai yang membuat Kontrak Target Kerja</b><span
style='mso-spacerun:yes'>  </span>adalah <b style='mso-bidi-font-weight:normal'>Pejabat
Eselon IV</b>, maka selain diketahui oleh <b style='mso-bidi-font-weight:normal'>Kepala
SKPD</b>, <b style='mso-bidi-font-weight:normal'>Formulir TPB 01</b><span
style='mso-spacerun:yes'>  </span>ini juga perlu diketahui oleh <b
style='mso-bidi-font-weight:normal'>Pejabat Eselon III</b> yang merupakan <b
style='mso-bidi-font-weight:normal'>Atasan Langsung</b> dari <b
style='mso-bidi-font-weight:normal'>Pejabat Eselon IV </b>tersebut.<o:p></o:p></span></p>

</div>

<span style='font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:Calibri;mso-bidi-font-family:"Times New Roman";
mso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA'><br
clear=all style='page-break-before:always;mso-break-type:section-break'>
</span>

<div class=Section3>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:
normal'><span style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>PETUNJUK
TEKNIS PENGISIAN FORMULIR TPB 01<o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
text-align:center;line-height:normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:
normal'><span style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>KONTRAK
TARGET KERJA PEGAWAI NEGERI SIPIL (PNS)<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p align="left" class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>PETUNJUK
UMUM:<o:p></o:p></span></b></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;text-align:justify;text-indent:-17.85pt;
line-height:normal;mso-list:l6 level1 lfo8'><![if !supportLists]><span lang=FI
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow";
mso-ansi-language:FI'><span style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=FI style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-ansi-language:
FI'>Setiap PNS Jabatan Struktural Eselon IV dan Fungsional diwajibkan menyusun
Formulir TPB 01 yang merupakan Kontrak Target Kerja Triwulanan; <o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;text-align:justify;text-indent:-17.85pt;
line-height:normal;mso-list:l6 level1 lfo8'><![if !supportLists]><span lang=FI
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow";
mso-ansi-language:FI'><span style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=FI style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-ansi-language:
FI'>Formulir TPB 01 diisi oleh PNS bersangkutan;<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;text-align:justify;text-indent:-17.85pt;
line-height:normal;mso-list:l6 level1 lfo8'><![if !supportLists]><span lang=FI
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow";
mso-ansi-language:FI'><span style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=FI style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-ansi-language:
FI'>Proses penyusunan Formulir TPB 01 dibimbing dan disetujui oleh Atasan
Langsung serta mengetahui Kepala SKPD yang bersangkutan;<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.25in;margin-bottom:.0001pt;text-align:justify;text-indent:-17.85pt;
line-height:normal;mso-list:l6 level1 lfo8'><![if !supportLists]><span lang=FI
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow";
mso-ansi-language:FI'><span style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=FI style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-ansi-language:
FI'>Formulir TPB 01 yang telah disusun diserahkan ke Kepala SKPD yang
bersangkutan paling lambat 2 (dua) hari sebelum triwulan berjalan.
<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:35.7pt;margin-bottom:.0001pt;line-height:normal'><span lang=FI
style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'><o:p>&nbsp;</o:p></span></p>

<p align="left" class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>PETUNJUK
KHUSUS:<o:p></o:p></span></b></p>

<p align="left" class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
A: Identitas Pegawai<o:p></o:p></span></b></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l5 level1 lfo10'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(1)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi nama Pegawai yang
bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l5 level1 lfo10'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(2)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi Nomor Induk Pegawai (NIP)
yang bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l5 level1 lfo10'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(3)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi Pangkat/Golongan Pegawai
yang bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l5 level1 lfo10'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(4)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi Jabatan Pegawai yang
bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l5 level1 lfo10'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(5)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi Pendidikan Terakhir
Pegawai yang bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l5 level1 lfo10'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(6)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi dengan Uraian Tugas
Pegawai yang bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l5 level1 lfo10'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(7)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi Unit Kerja/Satuan Kerja
Perangkat Daerah Pegawai yang bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l5 level1 lfo10'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(8)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi Sub unit kerja Pegawai yang
bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p align="left" class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
B:<span style='mso-spacerun:yes'>  </span>Atasan<span
style='mso-spacerun:yes'>  </span>Langsung/Penilai<o:p></o:p></span></b></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l4 level1 lfo12'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(1)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi nama atasan
langsung/penilai dari Pegawai yang bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l4 level1 lfo12'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(2)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi Nomor Induk Pegawai (NIP)
yang bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l4 level1 lfo12'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(3)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi Pangkat/Golongan Pegawai
yang bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.75in;margin-bottom:.0001pt;text-indent:-51.3pt;line-height:normal;
mso-list:l4 level1 lfo12'><![if !supportLists]><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";mso-fareast-font-family:
"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span style='mso-list:Ignore'>Baris
(4)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Diisi Jabatan Pegawai yang
bersangkutan<o:p></o:p></span></p>

<p align="left" class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p align="left" class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
C:<span style='mso-spacerun:yes'>  </span>Kontrak Target Kerja Pegawai<o:p></o:p></span></b></p>

<p align="left" class=MsoListParagraphCxSpFirst style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-52.0pt;line-height:normal;mso-list:l1 level1 lfo14'><![if !supportLists]><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
style='mso-list:Ignore'>Kolom (a)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Nomor urut jenis
aktivitas/rencana kerja<o:p></o:p></span></p>

<p align="left" class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-52.0pt;line-height:normal;mso-list:l1 level1 lfo14'><![if !supportLists]><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
style='mso-list:Ignore'>Kolom (b)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Rincian jenis aktivitas
(rencana kerja selama tiga bulan). Misalnya: menyusun rencana kerja
kesekretariatan <o:p></o:p></span></p>

<p align="left" class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-52.0pt;line-height:normal;mso-list:l1 level1 lfo14'><![if !supportLists]><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
style='mso-list:Ignore'>Kolom (c)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Menunjukkan aktivitas tersebut
ditujukan untuk kepentingan internal lingkungan Pemerintah Provinsi Papua (I),
atau kepentingan pihak Eksternal/publik/masyarakat di luar lingkungan
Pemerintah Provinsi Papua (E). Kolom ini cukup ditulis dengan (I) atau (E)
saja.<o:p></o:p></span></p>

<p align="left" class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-52.0pt;line-height:normal;mso-list:l1 level1 lfo14'><![if !supportLists]><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
style='mso-list:Ignore'>Kolom (d)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Dapat berbentuk barang
(dokumen, laporan, software/hardware) atau jasa (jasa layanan internal Pemprov
atau jasa layanan eksternal/publik/masyarakat)<o:p></o:p></span></p>

<p align="left" class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-52.0pt;line-height:normal;mso-list:l1 level1 lfo14'><![if !supportLists]><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
style='mso-list:Ignore'>Kolom (e)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Target “Bulan ke –“ merupakan
keterangan pada bulan ke berapa aktivitas/rencana kerja tersebut akan
diselesaikan. Pegawai cukup mengisi kode “1, 2, atau 3” untuk bulan pertama,
kedua, atau ketiga pada triwulan bersangkutan. Contoh: pekerjaan menerima surat
masuk diselesaikan pada setiap bulan pada triwulan bersangkutan, maka kolom ini
diisi dengan kode 1, 2, dan 3. Contoh lain: pekerjaan membuat laporan keuangan
triwulanan akan diselesaikan pada bulan ke tiga pada triwulan bersangkutan,
maka pegawai cukup menulis kode “3” pada kolom bulan ke-.<o:p></o:p></span></p>

<p align="left" class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-52.0pt;line-height:normal;mso-list:l1 level1 lfo14'><![if !supportLists]><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
style='mso-list:Ignore'>Kolom (f)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Target Waktu diisi secara
bulanan yang diturunkan dari aktivitas tiga bulanan (isikan jumlah satuan
aktivitasnya, misalnya: 3 menit,<span style='mso-spacerun:yes'>  </span>2 jam,
5 hari, 1 minggu, atau 1 bulan)<o:p></o:p></span></p>

<p align="left" class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-52.0pt;line-height:normal;mso-list:l1 level1 lfo14'><![if !supportLists]><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
style='mso-list:Ignore'>Kolom (g)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Target Manfaat bisa berupa: (1)
mendukung kegiatan rekan kerja di lingkungan Pemerintah Provinsi Papua; (2)
mendukung kegiatan Pimpinan di lingkungan Pemerintah Provinsi Papua; dan (3)
memenuhi kebutuhan masyarakat/publik. Pegawai boleh mengisi lebih dari satu
pilihan dengan mencantumkan angkanya saja (misalnya: 1; atau 2 dan 3).<o:p></o:p></span></p>

<p align="left" class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-52.0pt;line-height:normal;mso-list:l1 level1 lfo14'><![if !supportLists]><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
style='mso-list:Ignore'>Kolom (h)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Target Kuantitas diisi dengan
mencantumkan jumlah satuan produk (barang/jasa layanan) yang akan
dihasilkan/diberikan (misalnya: 10 unit, 2 kali, 100 persen, atau 50 persen).<o:p></o:p></span></p>

<p align="left" class=MsoListParagraphCxSpMiddle style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:.75in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-52.0pt;line-height:normal;mso-list:l1 level1 lfo14'><![if !supportLists]><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-fareast-font-family:"Arial Narrow";mso-bidi-font-family:"Arial Narrow"'><span
style='mso-list:Ignore'>Kolom (i)<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:"Arial Narrow","sans-serif"'>Target Kualitas diisi dengan
mencantumkan standar mutu yang hendak dicapai, misalnya sesuai dengan standar
operasi dan prosedur (SOP), sesuai dengan standar pelayanan minimal (SPM), atau
sesuai dengan standar lain yang ditentukan sendiri oleh SKPD atau peraturan
tertentu.<o:p></o:p></span></p>

<p align="left" class=MsoListParagraphCxSpLast style='margin-top:0in;margin-right:0in;
margin-bottom:0in;margin-left:70.9pt;margin-bottom:.0001pt;mso-add-space:auto;
line-height:normal'><span style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p align="left" class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;tab-stops:-4.5pt'><b style='mso-bidi-font-weight:normal'><span
style='mso-bidi-font-size:12.0pt;font-family:"Arial Narrow","sans-serif"'>Bagian
D:<span style='mso-spacerun:yes'>  </span>Pernyataan Pegawai<o:p></o:p></span></b></p>

<p align="left" class=MsoListParagraph style='margin:0in;margin-bottom:.0001pt;mso-add-space:
auto;text-align:justify;line-height:normal'><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif"'>Formulir TPB
01 yang telah diisi kemudian ditandatangani oleh Pegawai yang bersangkutan,</span><span
lang=FI style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:"Arial Narrow","sans-serif";
mso-ansi-language:FI'> Atasan Langsung/Pejabat Penilai serta mengetahui Kepala
SKPD yang bersangkutan. Khusus untuk staf yang dinilai oleh Pejabat Eselon IV,
Formulir TPB 01 juga perlu diketahui oleh Pejabat Eselon III yang merupakan
Atasan Langsung dari Pejabat Eselon IV tersebut.</span><span style='mso-bidi-font-size:
12.0pt;font-family:"Arial Narrow","sans-serif"'><o:p></o:p></span></p>

</div>

</body>

</html>
<?php
}
?>
