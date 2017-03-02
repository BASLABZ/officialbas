<?php
Class APBDPenjabaran extends ModulClass{
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
			$sql = "SELECT DISTINCT(tahunanggaran) FROM komandan_rekenings ORDER by tahunanggaran DESC";	
			$res =	$this->db->query($sql);
			while ($data =$this->db->fetchArray($res)) {
				 $listtahun[] = $data['tahunanggaran'];
			}

			$wpemda = $this->auth->getKodePemda();
			if ($wpemda!='') $wpemda = " AND kodepemda='".$wpemda."' ";

			$sql = "SELECT * FROM kabupaten WHERE kodepemda like '94%' ".$wpemda." ORDER by kodepemda";	
			$res =	$this->db->query($sql);
			while ($data =$this->db->fetchArray($res)) {
				$content .= "<tr>
							<td>".$data['kodepemda']."</td>
							<td>".$data['kabupaten']."</td>
				";
				
				foreach($listtahun as $tahun) {
				
					// $sqldata = "SELECT SUM(nilaianggaran),SUM(nilaianggaran_p) FROM ringkasan_apbd WHERE tahunanggaran='".$tahun."' AND kodepemda='".$data['kodepemda']."'";	
					$sqlapbd = "SELECT SUM(nilaianggaran) as nilaianggaran FROM komandan_rekenings WHERE perubahan = 0 AND kodepemda = '".$data['kodepemda']."' and tahunanggaran ='".$tahun."'GROUP BY kodepemda";
					$resapbd =	$this->db->query($sqlapbd);				
					if ($apbd = $this->db->fetchArray($resapbd)) {
							$content .= "<td class='text-center warning'>
											<a class='btn btn-success btn-xs btn-condensed' href='".ROOT_URL."detail/apbd-penjabaran/".$tahun."-".$data['kodepemda']."-0/rincian.htm' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Detail'><span class='fa fa-file-text'></span></a>
										</td>";
					} else {
						$content .= "<td class='text-center warning' style='padding: 5px;'>
										<a href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Tidak Ada Data'><span class='fa fa-ban'></span></a>
									</td>";
					}

					$sqlapbdp = "SELECT SUM(nilaianggaran) as nilaianggaran FROM komandan_rekenings WHERE perubahan = 1 AND kodepemda = '".$data['kodepemda']."' and tahunanggaran ='".$tahun."'GROUP BY kodepemda";
					$resapbdp =	$this->db->query($sqlapbdp);				
					if ($apbdp = $this->db->fetchArray($resapbdp)) {
							$content .= "<td class='text-center warning'>
											<a class='btn btn-success btn-xs btn-condensed' href='".ROOT_URL."detail/apbd-penjabaran/".$tahun."-".$data['kodepemda']."-1/rincian.htm' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Detail'><span class='fa fa-file-text'></span></a>
										</td>";
					} else {
						$content .= "<td class='text-center warning' style='padding: 5px;'>
										<a href='#' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Tidak Ada Data'><span class='fa fa-ban'></span></a>
									</td>";
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
		$sql = "SELECT DISTINCT(tahunanggaran) FROM komandan_rekenings ORDER by tahunanggaran DESC";	
		$res =	$this->db->query($sql);
		while ($data =$this->db->fetchArray($res)) {
			 $listtahun .= "<th colspan='2' class='text-center'>".$data['tahunanggaran']."</th>";
			 $listtahunanggaran .= "<th class='text-center'>APBD</th><th class='text-center'>APBD P</th>"; 
		}
  
  
		$table = new TemplateClass();
		$table->init(THEME.'/tables/apbd-penjabaran.html');
		$define = array (
						'LIST_TAHUN'			=> $listtahun,	
						'LIST_TAHUN_ANGGARAN'	=> $listtahunanggaran,	
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
						 'PAGETITLE'	=> 'Laporan Penjabaran APBD Kabupaten / Kota',
						 'PAGECONTENT'	=> $content,
						 'PAGESCRIPT'	=> $script,						 
                );
				
		$this->template->init(THEME.'/index.html');
		$this->template->defineTag($define);
		$this->template->printTpl();
	}

	function GetDetail($id){
		$apbd = 'M';
		$do = '';
		$optskpd = '';
		$rowdata = '';
		$anchorlink = '';
		$koderek = '';
		$apbdp = 0;

		if (isset($_POST['apbd'])) $apbd = $_POST['apbd']; 
		if (isset($_POST['do'])) $do = $_POST['do'];
		if (isset($_POST['optskpd'])) $optskpd = $_POST['optskpd'];
		

		list($tahun,$kodepemda,$perubahan) = explode('-',$this->scr->filter($id));
		$kabupaten = '';
		$sql = "SELECT * FROM kabupaten WHERE kodepemda='".$kodepemda."'";	
		$res =	$this->db->query($sql);
		if ($data = $this->db->fetchArray($res)) {
			$kabupaten = $data['kabupaten'];
		}

		$title = 'Laporan Penjabaran APBD '.$kabupaten.' Tahun '.$tahun;
		$content = '';

		$option = '<option> - Silahkan Pilih SKPD Terlebih Dahulu - </option>';
		$sqlskpd = "SELECT kodeurusanpelaksana,kodeskpd,namaskpd 
					FROM komandan_kegiatans
					WHERE tahunanggaran='".$tahun."' AND kodepemda='".$kodepemda."' AND perubahan='".$perubahan."'
					GROUP BY kodeurusanpelaksana,kodeskpd,namaskpd
					ORDER BY kodeurusanpelaksana,kodeskpd,namaskpd";
		$dataskpd = $this->db->query($sqlskpd);
        while ($result = $this->db->fetchArray($dataskpd)) {
        	$selected = ($optskpd == $result['kodeurusanpelaksana']."-".$result['kodeskpd']) ? "selected" : "";
            $option .= "<option value='".$result['kodeurusanpelaksana']."-".$result['kodeskpd']."' ".$selected.">".$result['namaskpd']."</option>";
        }

        #data APBD Penjabaran
        if($_POST){
        	list($kodeurusanpelaksana,$kodeskpd,) = explode('-',$optskpd);
      	  	$sql = "SELECT * FROM (
						SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,SUM(nilaianggaran),SUM(nilaianggaran_p),isbold FROM (
								SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,namaakunrincian as urai,nilaianggaran, 0 as nilaianggaran_p, 0 as isbold
								FROM komandan_rekenings
								WHERE 
									tahunanggaran='".$tahun."' AND 
									kodepemda='".$kodepemda."' AND 
									perubahan='0' AND 
									kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
									kodeskpd='".$kodeskpd."'
							UNION
								SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,namaakunrincian as urai, 0 as nilaianggaran, nilaianggaran as nilaianggaran_p, 0 as isbold
								FROM komandan_rekenings
								WHERE 
									tahunanggaran='".$tahun."' AND 
									kodepemda='".$kodepemda."' AND 
									perubahan='1' AND 
									kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
									kodeskpd='".$kodeskpd."'
						) AS X
						GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,isbold
					UNION 
						SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,SUM(nilaianggaran),SUM(nilaianggaran_p),isbold FROM ( 
							SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,0 as kodeakunrincian,namaakunobjek as urai,sum(nilaianggaran) as nilaianggaran, 0 as nilaianggaran_p, 0 as isbold
							FROM komandan_rekenings
							WHERE 
								tahunanggaran='".$tahun."' AND 
								kodepemda='".$kodepemda."' AND 
								perubahan='0' AND 
								kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kodeskpd='".$kodeskpd."'    
							GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek
						UNION
							SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,0 as kodeakunrincian,namaakunobjek as urai,0 as nilaianggaran ,sum(nilaianggaran) as nilaianggaran_p , 0 as isbold
							FROM komandan_rekenings
							WHERE 
								tahunanggaran='".$tahun."' AND 
								kodepemda='".$kodepemda."' AND 
								perubahan='1' AND 
								kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kodeskpd='".$kodeskpd."'    
							GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek
						) AS X
						GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,isbold
					UNION
						SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,SUM(nilaianggaran),SUM(nilaianggaran_p),isbold FROM (
							SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,namaakunjenis as urai,sum(nilaianggaran) as nilaianggaran,0 as nilaianggaran_p, 0 as isbold
							FROM komandan_rekenings
							WHERE 
								tahunanggaran='".$tahun."' AND 
								kodepemda='".$kodepemda."' AND 
								perubahan='0' AND 
								kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kodeskpd='".$kodeskpd."'    
							GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis
						UNION
							SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,namaakunjenis as urai,0 as nilaianggaran,sum(nilaianggaran) as nilaianggaran_p, 0 as isbold
							FROM komandan_rekenings
							WHERE 
								tahunanggaran='".$tahun."' AND 
								kodepemda='".$kodepemda."' AND 
								perubahan='1' AND 
								kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kodeskpd='".$kodeskpd."'    
							GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis
						) AS X
						GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,isbold
					UNION
						SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,SUM(nilaianggaran),SUM(nilaianggaran_p),isbold FROM (
							SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,0 as kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,namaakunkelompok as urai,sum(nilaianggaran) as nilaianggaran, 0 as nilaianggaran_p, 1 as isbold
							FROM komandan_rekenings
							WHERE
								tahunanggaran='".$tahun."' AND 
								kodepemda='".$kodepemda."' AND 
								perubahan='0' AND 
								kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kodeskpd='".$kodeskpd."'    
							GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok
						UNION
							SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,0 as kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,namaakunkelompok as urai,0 as nilaianggaran,sum(nilaianggaran) as nilaianggaran_p, 1 as isbold
							FROM komandan_rekenings
							WHERE
								tahunanggaran='".$tahun."' AND 
								kodepemda='".$kodepemda."' AND 
								perubahan='1' AND 
								kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kodeskpd='".$kodeskpd."'    
							GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok
						) AS X 
						GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,isbold
					UNION
						SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,SUM(nilaianggaran),SUM(nilaianggaran_p),isbold FROM (
							SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,0 as kodeakunkelompok,0 as kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,namaakunutama as urai,sum(nilaianggaran) as nilaianggaran, 0 as nilaianggaran_p, 1 as isbold
							FROM komandan_rekenings
							WHERE
								tahunanggaran='".$tahun."' AND 
								kodepemda='".$kodepemda."' AND 
								perubahan='0' AND 
								kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kodeskpd='".$kodeskpd."'    
							group by tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama
						UNION
							SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,0 as kodeakunkelompok,0 as kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,namaakunutama as urai,0 as nilaianggaran,sum(nilaianggaran) as nilaianggaran_p, 1 as isbold
							FROM komandan_rekenings
							WHERE
								tahunanggaran='".$tahun."' AND 
								kodepemda='".$kodepemda."' AND 
								perubahan='1' AND 
								kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kodeskpd='".$kodeskpd."'    
							group by tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama
						) AS X 
						GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,isbold	
					UNION
						SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,SUM(nilaianggaran),SUM(nilaianggaran_p),isbold FROM (
							SELECT kr.tahunanggaran,kr.kodeurusanprogram,kr.kodeprogram,kr.kodekegiatan, 0 as kodeakunutama,0 as kodeakunkelompok,0 as kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,(SELECT namakegiatan FROM komandan_kegiatans WHERE kodepemda=kr.kodepemda AND tahunanggaran=kr.tahunanggaran AND perubahan=kr.perubahan AND  kodeurusanpelaksana=kr.kodeurusanpelaksana AND kodeskpd=kr.kodeskpd AND kodeurusanprogram=kr.kodeurusanprogram AND kodeprogram=kr.kodeprogram AND kodekegiatan=kr.kodekegiatan LIMIT 1) as urai,sum(nilaianggaran) as nilaianggaran, 0 as nilaianggaran_p, 1 as isbold
							FROM komandan_rekenings kr
							WHERE 
								kr.tahunanggaran='".$tahun."' AND 
								kr.kodepemda='".$kodepemda."' AND 
								kr.perubahan='0' AND 
								kr.kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kr.kodeskpd='".$kodeskpd."'    
							GROUP BY kr.tahunanggaran,kr.kodeurusanprogram,kr.kodeprogram,kr.kodekegiatan
						UNION
							SELECT kr.tahunanggaran,kr.kodeurusanprogram,kr.kodeprogram,kr.kodekegiatan, 0 as kodeakunutama,0 as kodeakunkelompok,0 as kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,(SELECT namakegiatan FROM komandan_kegiatans WHERE kodepemda=kr.kodepemda AND tahunanggaran=kr.tahunanggaran AND perubahan=kr.perubahan AND  kodeurusanpelaksana=kr.kodeurusanpelaksana AND kodeskpd=kr.kodeskpd AND kodeurusanprogram=kr.kodeurusanprogram AND kodeprogram=kr.kodeprogram AND kodekegiatan=kr.kodekegiatan LIMIT 1) as urai,0 as nilaianggaran,sum(nilaianggaran) as nilaianggaran_p, 1 as isbold
							FROM komandan_rekenings kr
							WHERE 
								kr.tahunanggaran='".$tahun."' AND 
								kr.kodepemda='".$kodepemda."' AND 
								kr.perubahan='1' AND 
								kr.kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kr.kodeskpd='".$kodeskpd."'    
							GROUP BY kr.tahunanggaran,kr.kodeurusanprogram,kr.kodeprogram,kr.kodekegiatan
						) AS X
						GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,isbold
					UNION
						SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,SUM(nilaianggaran),SUM(nilaianggaran_p),isbold FROM (
							SELECT kr.tahunanggaran,kr.kodeurusanprogram,kr.kodeprogram,0 as kodekegiatan, 0 as kodeakunutama,0 as kodeakunkelompok,0 as kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,(SELECT namaprogram FROM komandan_kegiatans WHERE kodepemda=kr.kodepemda AND tahunanggaran=kr.tahunanggaran AND perubahan=kr.perubahan AND  kodeurusanpelaksana=kr.kodeurusanpelaksana AND kodeskpd=kr.kodeskpd AND kodeurusanprogram=kr.kodeurusanprogram AND kodeprogram=kr.kodeprogram LIMIT 1) as urai,sum(nilaianggaran) as nilaianggaran, 0 as nilaianggaran_p, 1 as isbold
							FROM komandan_rekenings kr
							WHERE 
								kr.tahunanggaran='".$tahun."' AND 
								kr.kodepemda='".$kodepemda."' AND 
								kr.perubahan='0' AND 
								kr.kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kr.kodeskpd='".$kodeskpd."'    
							GROUP BY kr.tahunanggaran,kr.kodeurusanprogram,kr.kodeprogram	
						UNION
							SELECT kr.tahunanggaran,kr.kodeurusanprogram,kr.kodeprogram,0 as kodekegiatan, 0 as kodeakunutama,0 as kodeakunkelompok,0 as kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,(SELECT namaprogram FROM komandan_kegiatans WHERE kodepemda=kr.kodepemda AND tahunanggaran=kr.tahunanggaran AND perubahan=kr.perubahan AND  kodeurusanpelaksana=kr.kodeurusanpelaksana AND kodeskpd=kr.kodeskpd AND kodeurusanprogram=kr.kodeurusanprogram AND kodeprogram=kr.kodeprogram LIMIT 1) as urai,0 as nilaianggaran,sum(nilaianggaran) as nilaianggaran_p, 1 as isbold
							FROM komandan_rekenings kr
							WHERE 
								kr.tahunanggaran='".$tahun."' AND 
								kr.kodepemda='".$kodepemda."' AND 
								kr.perubahan='1' AND 
								kr.kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kr.kodeskpd='".$kodeskpd."'    
							GROUP BY kr.tahunanggaran,kr.kodeurusanprogram,kr.kodeprogram
						) AS X
						GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,isbold	
					UNION
						SELECT tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan,kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,SUM(nilaianggaran),SUM(nilaianggaran_p),isbold FROM (
							SELECT kr.tahunanggaran,kr.kodeurusanprogram,0 as kodeprogram,0 as kodekegiatan, 0 as kodeakunutama,0 as kodeakunkelompok,0 as kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,(SELECT namaurusanprogram FROM komandan_kegiatans WHERE kodepemda=kr.kodepemda AND tahunanggaran=kr.tahunanggaran AND perubahan=kr.perubahan AND  kodeurusanpelaksana=kr.kodeurusanpelaksana AND kodeskpd=kr.kodeskpd AND kodeurusanprogram=kr.kodeurusanprogram LIMIT 1) as urai,sum(nilaianggaran) as nilaianggaran,0 as nilaianggaran_p, 1 as isbold
							FROM komandan_rekenings kr
							WHERE 
								kr.tahunanggaran='".$tahun."' AND 
								kr.kodepemda='".$kodepemda."' AND 
								kr.perubahan='0' AND 
								kr.kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kr.kodeskpd='".$kodeskpd."'    
							GROUP BY kr.tahunanggaran,kr.kodeurusanprogram
						UNION
							SELECT kr.tahunanggaran,kr.kodeurusanprogram,0 as kodeprogram,0 as kodekegiatan, 0 as kodeakunutama,0 as kodeakunkelompok,0 as kodeakunjenis,0 as kodeakunobjek,0 as kodeakunrincian,(SELECT namaurusanprogram FROM komandan_kegiatans WHERE kodepemda=kr.kodepemda AND tahunanggaran=kr.tahunanggaran AND perubahan=kr.perubahan AND  kodeurusanpelaksana=kr.kodeurusanpelaksana AND kodeskpd=kr.kodeskpd AND kodeurusanprogram=kr.kodeurusanprogram LIMIT 1) as urai,0 as nilaianggaran,sum(nilaianggaran) as nilaianggaran_p, 1 as isbold
							FROM komandan_rekenings kr
							WHERE 
								kr.tahunanggaran='".$tahun."' AND 
								kr.kodepemda='".$kodepemda."' AND 
								kr.perubahan='1' AND 
								kr.kodeurusanpelaksana='".$kodeurusanpelaksana."' AND 
								kr.kodeskpd='".$kodeskpd."'    
							GROUP BY kr.tahunanggaran,kr.kodeurusanprogram
						) AS X
						GROUP BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian,urai,isbold
					) R
				ORDER BY tahunanggaran,kodeurusanprogram,kodeprogram,kodekegiatan, kodeakunutama,kodeakunkelompok,kodeakunjenis,kodeakunobjek,kodeakunrincian";
    		// die("<pre>".$sql);

			

    		$data = $this->db->query($sql);
    		while($res = $this->db->fetchArray($data)){

    			$bold 	= ($res[12] == 1) ? "bold" : "";
    			$input 	= ($res[12] == 1) ? "" : "caninput";
    			$space 	= ($res[12] == 0) ? "&nbsp;&nbsp;&nbsp;&nbsp;" : "";

    			$apbdp 	+= $res[11];

    			$res[2] = (strlen($res['2']) != 1) ? $res['2'] : "";
    			$res[3] = (strlen($res['3']) != 1) ? $res['3'] : "";
    			$res[4] = ($res[4]  == '0' ) ? "" : $res[4] ;
    			$res[5] = ($res[5]  == '0' ) ? "" : $res[5] ;
    			$res[6] = ($res[6]  == '0' ) ? "" : $res[6] ;
    			$res[7] = ($res[7]  == '0' ) ? "" : $res[7] ;
    			$res[8] = ($res[8]  == '0' ) ? "" : $res[8] ;

    			$koderek = $res['1'].$res['2'].$res['3'].$res['4'].$res['5'].$res['6'].$res['7'].$res['8'];

    			$rowdata .= "<tr style='font-weight:".$bold."'>
    							<td class='text-center'>".$res[1]."</td>
    							<td class='text-center'>".$res[2]."</td>
    							<td class='text-center'>".$res[3]."</td>
    							<td class='text-center'>".$res[4]."</td>
    							<td class='text-center'>".$res[5]."</td>
    							<td class='text-center'>".$res[6]."</td>
    							<td class='text-center'>".$res[7]."</td>
    							<td class='text-center'>".$res[8]."</td>
    							<td>".$res[9]."</td>
    							<td align='right' data-koderek='".$koderek."' data-val='".$res[10]."' class='apbd ".$input."'>".number_format($res[10],2,',','.')."</td>
    							<td align='right' data-koderek='".$koderek."' data-val='".$res[11]."' class='apbdp perubahan ".$input."'>".number_format($res[11],2,',','.')."</td>
    							<td align='right' data-koderek='".$koderek."' data-val='0' class='selisih perubahan'></td>
			   					<td align='center' data-koderek='".$koderek."' data-val='0' class='persen perubahan'></td>
    						</tr>
    						";
    		}

    	} else {
    		$rowdata = "<tr style='font-weight:bold;'><td colspan='14' class='text-center'> Silahkan Pilih SKPD Terlebih Dahulu !!!</td></tr>";
    	}

		#load template table
        $table = new TemplateClass();
		$table->init(THEME.'/tables/apbd-penjabaran-detail.html');
		$define = array (
					'OPTSKPD' => $option,
					'ROOT_URL' => ROOT_URL,
					'KODEPEMDA' => $kodepemda,
					'TAHUNANGGARAN' => $tahun,
					'PERUBAHAN' => $perubahan,
					'ROWDATA' => $rowdata,
					'NAMAPEMDA' => $kabupaten,
		);
		$table->defineTag($define);
		$content = $table->parse();
		$script = "
			proses = function(c,k,isEdit){
				var jumlah = 0;
				$('.caninput.'+c+'[data-koderek^=\''+k+'\']').each(function(i,e){ 
					jumlah += ($(e).attr('data-val')*1); 
				});
								
				if (!$('.'+c+'[data-koderek=\''+k+'\']').hasClass('caninput')) {
					$('.'+c+'[data-koderek=\''+k+'\']').attr('data-val',jumlah);
					$('.'+c+'[data-koderek=\''+k+'\']').html(money_format(jumlah));
				} else {
					if (!isEdit) $('.'+c+'[data-koderek=\''+k+'\']').html(money_format(jumlah));
				}
			};

			hitung = function(c,isEdit) {
				proses(c,'4');
				$('.'+c+'[data-koderek^=\'4.\']').each(function(i,e){ 
						proses(c,$(e).attr('data-koderek'),isEdit);
				});
				proses(c,'5');
				$('.'+c+'[data-koderek^=\'5.\']').each(function(i,e){ 
						proses(c,$(e).attr('data-koderek'),isEdit);
				});
				$('.'+c+'[data-koderek^=\'6.\']').each(function(i,e){ 
						proses(c,$(e).attr('data-koderek'),isEdit);
				});
				
				var surplus = $('.'+c+'[data-koderek=\'4\']').attr('data-val') - $('.'+c+'[data-koderek=\'5\']').attr('data-val');
				var pemb = $('.'+c+'[data-koderek=\'6.1\']').attr('data-val') - $('.'+c+'[data-koderek=\'6.2\']').attr('data-val');
				var silpa = surplus + pemb;
				
				$('.'+c+'[data-koderek=\'SD\']').attr('data-val',surplus);
				$('.'+c+'[data-koderek=\'SD\']').html(money_format(surplus));
				
				$('.'+c+'[data-koderek=\'6\']').attr('data-val',pemb);
				$('.'+c+'[data-koderek=\'6\']').html(money_format(pemb));
				
				$('.'+c+'[data-koderek=\'SI\']').attr('data-val',silpa);
				$('.'+c+'[data-koderek=\'SI\']').html(money_format(silpa));
				
			};
			updateJumlah = function(isEdit) {
				hitung('apbd',isEdit);	
				hitung('apbdp',isEdit);
				var selisih,k,persen;
				$('.apbd').each(function(i,e){ 
					k = $(e).data('koderek');
					selisih = $('.apbdp[data-koderek=\''+k+'\']').data('val')-$(e).data('val');
					$('.selisih[data-koderek=\''+k+'\']').html(money_format(selisih));
					persen = 0;
					if ($(e).data('val')!=0) persen = selisih / $(e).data('val')*100;
					$('.persen[data-koderek=\''+k+'\']').html(money_format(persen));	
				});				
			};
			
			updateJumlah(false);
			".((($apbdp>0) || ($apbd=='P'))?"":"$('.perubahan').toggle();")."";

		$this->pgTitle = $title;
		$this->pgContent = $content; 
		$this->pgScript = $script;
	}
}