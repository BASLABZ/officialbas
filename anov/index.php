<?php
$route = empty($_GET['route']) ? [] : array_filter(explode('/',$_GET['route']));


function url($fragment) {
	return "http://localhost/GlobalInt/anov/".$fragment;
}
function dasar(&$route) {
	if (empty($route)) {
		$route = 'home';
	}
}


echo "<pre>";
print_r($_GET);
print_r($route);


switch ($route[0]) {
	case 'berita':
		dasar($route[1]);
		switch ($route[1]) {
			case 'hapus':
			case 'edit':
			case 'lihat':
				dasar($route[2]);
				$id = ctype_digit($route[2]);
				if ($id) {
					echo "id benar, proses bisa lanjut\n";
					echo "select from where id={$route[2]};";
				} else {
					echo "salah woy!";
				}
			break;

			default:
				echo "tampil semua berita";
			break;
		}
	break;
		case 'berita':
		dasar($route[1]);
		switch ($route[1]) {
			case 'hapus':
			case 'edit':
			case 'lihat':
				dasar($route[2]);
				$id = ctype_digit($route[2]);
				if ($id) {
					echo "id benar, proses bisa lanjut\n";
					echo "select from where id={$route[2]};";
				} else {
					echo "salah woy!";
				}
			break;

			default:
				echo "tampil semua berita";
			break;
		}
	break;	case 'berita':
		dasar($route[1]);
		switch ($route[1]) {
			case 'hapus':
			case 'edit':
			case 'lihat':
				dasar($route[2]);
				$id = ctype_digit($route[2]);
				if ($id) {
					echo "id benar, proses bisa lanjut\n";
					echo "select from where id={$route[2]};";
				} else {
					echo "salah woy!";
				}
			break;

			default:
				echo "tampil semua berita";
			break;
		}
	break;	case 'berita':
		dasar($route[1]);
		switch ($route[1]) {
			case 'hapus':
			case 'edit':
			case 'lihat':
				dasar($route[2]);
				$id = ctype_digit($route[2]);
				if ($id) {
					echo "id benar, proses bisa lanjut\n";
					echo "select from where id={$route[2]};";
				} else {
					echo "salah woy!";
				}
			break;

			default:
				echo "tampil semua berita";
			break;
		}
	break;	case 'berita':
		dasar($route[1]);
		switch ($route[1]) {
			case 'hapus':
			case 'edit':
			case 'lihat':
				dasar($route[2]);
				$id = ctype_digit($route[2]);
				if ($id) {
					echo "id benar, proses bisa lanjut\n";
					echo "select from where id={$route[2]};";
				} else {
					echo "salah woy!";
				}
			break;

			default:
				echo "tampil semua berita";
			break;
		}
	break;	case 'berita':
		dasar($route[1]);
		switch ($route[1]) {
			case 'hapus':
			case 'edit':
			case 'lihat':
				dasar($route[2]);
				$id = ctype_digit($route[2]);
				if ($id) {
					echo "id benar, proses bisa lanjut\n";
					echo "select from where id={$route[2]};";
				} else {
					echo "salah woy!";
				}
			break;

			default:
				echo "tampil semua berita";
			break;
		}
	break;
	default:
		echo "hai, met datang";
	break;
}