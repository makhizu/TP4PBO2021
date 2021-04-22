<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("koneksi.php");
include("app/Template.class.php");
include("app/DB.class.php");
include("app/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$otask->getTask();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

if(isset($_POST['add'])){
	$otask->insert($_POST);
// 	//memanggil method insert data ke db
	header("Location:index.php");
}


while (list($id, $judul, $penulis, $penerbit, $tahun, $genre, $status) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($status == "Iya"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $judul . "</td>
		<td>" . $penulis . "</td>
		<td>" . $penerbit . "</td>
		<td>" . $tahun . "</td>
		<td>" . $genre . "</td>
		<td>" . $status . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}else{

		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $judul . "</td>
		<td>" . $penulis . "</td>
		<td>" . $penerbit . "</td>
		<td>" . $tahun . "</td>
		<td>" . $genre . "</td>
		<td>" . $status . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-primary'><a href='index.php?id_update=" . $id . "' style='color: white; font-weight: bold;'>Rekomended</a></button>
		</td>
		</tr>";
		$no++;
	
	}
}

if(isset($_GET['id_hapus'])){
	$id = $_GET['id_hapus'];

	$otask->delete($id);

	unset($_GET['id_hapus']);

	header("Location: index.php");
}

if(isset($_GET['id_update'])){
	$id_update = $_GET['id_update'];

	$otask->update($id_update);

	unset($_GET['id_update']);
	
	header("Location: index.php");
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html

$tpl = new Template("skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();