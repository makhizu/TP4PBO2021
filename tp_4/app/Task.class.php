<?php 

/******************************************
PRAKTIKUM RPL
******************************************/
class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM identitas";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function insert($data){
		$judul = $data['judul'];
		$penulis = $data['penulis'];
		$penerbit = $data['penerbit'];
		$tahun = $data['tahun'];
		$genre = $data['genre'];
		$status = "Tidak";
		

		$query = "INSERT INTO identitas (judul, penulis, penerbit, tahun, genre, status) VALUES ('$judul', '$penulis', '$penerbit', '$tahun', '$genre', '$status')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function delete($no){
		$query = "DELETE FROM identitas WHERE no=$no";

		return $this->execute($query);
	}

	function update($id){
		$query = "UPDATE identitas SET status = 'Iya' WHERE no = $id";

		return $this->execute($query);
	}
}
?>