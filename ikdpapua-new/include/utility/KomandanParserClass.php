<?php
	class APBDMurniParser extends XmlStreamer {
		public $kegiatans = array();
		public $rekenings = array();
		public $kodepemda = "";
		public $namapemda = "";
		public $tahunanggaran = "";
		public $chunkCount = 0;
		public $initCalled = false;

		public function init() {
			$this->initCalled = true;
		}

		public function getData($tahun, $kodepemda, $perubahan){
			$this->kodepemda = $kodepemda;
			$this->tahunanggaran = $tahun;
			$this->perubahan = $perubahan;

			$this->db = new MysqliClass;

		}

		public function processNode($xmlString, $elementName, $nodeIndex) {
			$xml = simplexml_load_string($xmlString);
			$q1 = "";
			$q2 = "";
			$q3 = "";
			$q4 = "";
			
			if (strtolower($elementName)=='tahunanggaran')  {	
				$q1 .= "DELETE FROM komandan_kegiatans WHERE kodepemda='".$this->kodepemda."' AND tahunanggaran='".$this->tahunanggaran."';\n";
				$this->db->query($q1);

				$q2 = "DELETE FROM komandan_rekenings WHERE kodepemda='".$this->kodepemda."' AND tahunanggaran='".$this->tahunanggaran."';\n";
				$this->db->query($q2);

			} 
			else if (strtolower($elementName)=='kegiatans') {
				$kegiatan = Array('kodepemda'=>$this->kodepemda,'tahunanggaran'=>$this->tahunanggaran);
				$kode = Array('kodepemda'=>$this->kodepemda,'tahunanggaran'=>$this->tahunanggaran);
				foreach($xml->children() as $k => $v){
					if (strtolower($k)!='koderekenings') {
						$kegiatan[$k] = (string)$v;
						if (strpos($k,'kode')!==false) $kode[$k] = (string)$v;
					}
				}
				$sql = "";
				foreach($kegiatan as $k => $v){
					$sql .= ", ".strtolower($k)." = '".$v."'"; 
				}
				$q3 = "INSERT INTO komandan_kegiatans SET ".substr($sql,1)." , perubahan = '".$this->perubahan."';\n";
				$this->db->query($q3);

				foreach($xml->children() as $k => $v){
					if (strtolower($k)=='koderekenings') {
						$rekening = $kode;
						foreach ($v->children() as $key => $val) {
							$rekening[$key] = (string)$val;
						}
						
						$sql = "";
						foreach($rekening as $k => $v){
							$sql .= ", ".strtolower($k)." = '".$v."'"; 
						}
						$q4 = "INSERT INTO komandan_rekenings SET ".substr($sql,1)." , perubahan = '".$this->perubahan."';\n";
						$this->db->query($q4);
					}
				}
			}

			return true;
		}

		public function chunkCompleted() {
			$this->chunkCount++;
		}
	}
?>