<?php
Class PerbandinganAnggaranClass extends ModulClass{

		function Service(){
		# service handle
		$cmd = '';
		$id = '';
		if (isset($_POST['cmd'])) $cmd = $this->scr->filter($_POST['cmd']);
		if (isset($_POST['id'])) $id = $this->scr->filter($_POST['id']);
		
		if ($cmd=='list') {
			if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR'))) die();
			
			$content = "";
			$listtahun = array();
			$sql = "SELECT DISTINCT(tahunanggaran) FROM ringkasan_apbd ORDER by tahunanggaran DESC";	
			$res =	$this->db->query($sql);
			while ($data =$this->db->fetchArray($res)) {
				 $listtahun[] = $data['tahunanggaran'];
			}

			$wpemda = $this->auth->getKodePemda();
			if ($wpemda!='') $wpemda = " AND kodepemda='".$wpemda."' ";

			$sql = "SELECT * FROM kabupaten WHERE kodepemda like '94%' ".$wpemda." ORDER by kodepemda";	
			$res =	$this->db->query($sql);
			while ($data =$this->db->fetchArray($res)) {
				$content .= "<tr><td>".$data['kodepemda']."</td><td>".$data['kabupaten']."</td>";
				foreach($listtahun as $tahun) {
					$sqldata = "SELECT * FROM (
								    SELECT 
								        ra.nilaianggaran, 
								        ra.nilaianggaran_p                     
								        FROM master_rekening AS mr
								        LEFT JOIN ringkasan_apbd AS ra ON (
								            ra.kodeakunutama = mr.kodeakunutama 
								            AND ra.kodeakunkelompok = mr.kodeakunkelompok 
								            AND ra.kodeakunjenis = mr.kodeakunjenis
								            AND ra.kodepemda = '".$data['kodepemda']."' 
								            AND ra.tahunanggaran = '".$tahun."'
								        )
								        WHERE 
								        mr.kodeakunutama = 5 AND
								        mr.kodeakunkelompok = 1 AND
								        mr.kodeakunjenis = 4 AND
								        mr.kodeakunobjek = 0
								        GROUP BY mr.kodeakunutama, mr.kodeakunkelompok, mr.kodeakunjenis
								        ORDER BY mr.kodeakunutama, mr.kodeakunkelompok, mr.kodeakunjenis
								) X, (
								    SELECT 
								        ra.nilaianggaran, 
								        ra.nilaianggaran_p                     
								        FROM master_rekening AS mr
								        LEFT JOIN ringkasan_apbd AS ra ON (
								            ra.kodeakunutama = mr.kodeakunutama 
								            AND ra.kodeakunkelompok = mr.kodeakunkelompok 
								            AND ra.kodeakunjenis = mr.kodeakunjenis
								            AND ra.kodepemda = '".$data['kodepemda']."' 
								            AND ra.tahunanggaran = '".$tahun."'
								        )
								        WHERE 
								        mr.kodeakunutama = 5 AND
								        mr.kodeakunkelompok = 1 AND
								        mr.kodeakunjenis = 5 AND
								        mr.kodeakunobjek = 0
								        GROUP BY mr.kodeakunutama, mr.kodeakunkelompok, mr.kodeakunjenis
								        ORDER BY mr.kodeakunutama, mr.kodeakunkelompok, mr.kodeakunjenis
								) Y";
					$resdata = $this->db->query($sqldata);
					if($resdata = $this->db->fetchArray($resdata)){
						if($resdata[0]>0){
							$content .= "<td class='text-right success'>
											<a href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='".number_format($resdata[0],2,',','.')."'><b>".number_format($resdata[0]/1000000000,2,',','.')."M</b></a>
										</td>"; 
						} else {
							$content .= "<td class='text-center warning' style='padding: 5px;'>
											<a class='' href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Data Kosong'><span class='fa fa-minus-circle'></span></a>
										</td>";
						}
						if($resdata[1]>0){
							$content .= "<td class='text-right success'>
											<a href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='".number_format($resdata[1],2,',','.')."'><b>".number_format($resdata[1]/1000000000,2,',','.')."M</b></a>
										</td>"; 
						} else {
							$content .= "<td class='text-center warning' style='padding: 5px;'>
											<a class='' href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Data Kosong'><span class='fa fa-minus-circle'></span></a>
										</td>";
						}
						if($resdata[2]>0){
							$content .= "<td class='text-right success'>
											<a href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='".number_format($resdata[2],2,',','.')."'><b>".number_format($resdata[2]/1000000000,2,',','.')."M</b></a>
										</td>"; 
						} else {
							$content .= "<td class='text-center warning' style='padding: 5px;'>
											<a class='' href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Data Kosong'><span class='fa fa-minus-circle'></span></a>
										</td>";
						}
						if($resdata[3]>0){
							$content .= "<td class='text-right success'>
											<a href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='".number_format($resdata[3],2,',','.')."'><b>".number_format($resdata[3]/1000000000,2,',','.')."M</b></a>
										</td>"; 
						} else {
							$content .= "<td class='text-center warning' style='padding: 5px;'>
											<a class='' href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Data Kosong'><span class='fa fa-minus-circle'></span></a>
										</td>";
						}
					}
				}
				$content .= "</tr>";
			}
			
            echo $content;
        }
        
    } 

	function Manage(){
		if (!$this->auth->isGranted(array('ADMIN', 'KABUPATEN', 'OPERATOR')))  header('location: '.ROOT_URL);
		$content = "";
		$script = "";

		$listtahun = "";
		$listtahunanggaran = "";
		$listperubahan = "";
		$sql = "SELECT DISTINCT(tahunanggaran) FROM ringkasan_apbd ORDER by tahunanggaran DESC";
		$res =	$this->db->query($sql);
		while ($data =$this->db->fetchArray($res)) {
			  	$listtahun .= "<th colspan='4' class='text-center'>".$data['tahunanggaran']."</th>";
				$listperubahan .= "<th colspan='2' class='text-center'>HIBAH</th><th colspan='2' class='text-center'>BANSOS</th>"; 
				$listtahunanggaran .= "<th class='text-center'>APBD </th><th class='text-center'>APBD P</th>
									   <th class='text-center'>APBD</th><th class='text-center'>APBD P</th>"; 
		}
  
  
		$table = new TemplateClass();
		$table->init(THEME.'/tables/perbandingan-anggaran.html');
		$define = array (
						'LIST_TAHUN'			=> $listtahun,	
						'LIST_TAHUN_ANGGARAN'	=> $listtahunanggaran,
						'LIST_PERUBAHAN'		=> $listperubahan,
						'PANELTITLE'			=> 'Laporan Perbandingan Anggaran Hibah Dan Bantuan Sosial',
                );
		$table->defineTag($define);
		$content = $table->parse();

		$script = "
			function loadData() {
				$('#loader').modal('show');
				
				$.post('#',{'do':'svc','cmd':'list'}, function(data) { 
					$('#loader').modal('hide'); 
					$('#tbodyData').html(data);	
				});
			};
																	
			loadData();
			$('.spinner_default').spinner();		
		";
		
		$define = array (
						 'PAGETITLE'	=> 'Laporan Perbandingan Anggaran',
						 'PAGECONTENT'	=> $content,
						 'PAGESCRIPT'	=> $script,						 
                );
				
		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl();
	}
}