<?php
class System extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function addcat($name)
	{

		$search = $this->db->get_where('kategoribuku', array('NamaKategori' => $name));
		$total = $this->db->get_where('kategoribuku');

		if ($search->num_rows() > 0) {
			return 1;
		} else {
			$calcnum = $total->num_rows() + 1;
			$calcid = sprintf('%04d', $calcnum);
			$data = array(
				'KategoriID' => "KAT$calcid",
				'NamaKategori' => $name
			);
			$this->db->insert('kategoribuku', $data);
			return 0;
		}
	}

	function addrak($name)
	{
		$search = $this->db->get_where('rakbuku', array('NamaRak' => $name));
		$total = $this->db->get_where('rakbuku');

		if ($search->num_rows() > 0) {
			return 1;
		} else {
			$calcnum = $total->num_rows() + 1;
			$calcid = sprintf('%04d', $calcnum);
			$data = array(
				'RakID' => "RAK$calcid",
				'NamaRak' => "$name"
			);

			$this->db->insert('rakbuku', $data);
			return 0;
		}
	}

	function addbuku($isbn, $title, $writer, $publisher, $pubyear, $catid, $bookstok, $bookrak, $bookclass, $bookcity, $gambar)
	{

		$search = $this->db->get_where('buku', array('BukuID' => $isbn));
		$total = $this->db->get_where('buku');

		if ($search->num_rows() > 0) {
			$this->session->set_flashdata('message', 'ISBN Buku sudah ada');
			redirect("category/detail/$catid");
		} else {

			
			$Path = "images/";
			$ImagePath = $Path . $bookrak . "_$isbn" . "_sampul.png";
			move_uploaded_file($gambar, $ImagePath);

			$calcnum = $total->num_rows() + 1;
			$calcid = sprintf('%04d', $calcnum);
			$data_buku = array(
				'BukuID' => "$isbn",
				'RakID' => "$bookrak",
				'Judul' => $title,
				'Foto' => base_url() . $ImagePath,
				'Penulis' => $writer,
				'Penerbit' => $publisher,
				'TahunTerbit' => $pubyear,
				'KategoriID' => $catid,
				'Stok' => $bookstok,
				'Kota' => $bookcity,
				'Kelas' => $bookclass,
			);
			$this->db->insert('buku', $data_buku);
			return 0;
		}
	}

	function addrev($userid, $bookid, $ulasan, $rating, $catid)
	{

		$search = $this->db->get_where('ulasanbuku', array('UserID' => $userid, 'BukuID' => $bookid));
		$user = $this->db->get_where('user', array('UserID' => $userid));
		$user = $user->row();

		if ($search->num_rows() > 0) {
			$this->session->set_flashdata('messagerev', 'Kamu sudah pernah memberikan buku ini ulasan');
			redirect("book/view/$bookid");
		} else {
			$data_buku = array(
				'UserID' => $userid,
				'BukuID' => $bookid,
				'Ulasan' => $ulasan,
				'Rating' => $rating,
				'Username' => $user->NamaLengkap,
				'UserLevel' => $user->Level
			);
			$this->db->insert('ulasanbuku', $data_buku);
			return 0;
		}
	}

	function addborrow($bookid, $takeborrow)
	{

		$userid = $this->session->userdata('user_data')->UserID;
		$userdata = $this->db->get_where('user', array('UserID' => "$userid"));
		$search = $this->db->get_where('peminjaman', array('UserID' => "$userid", 'BukuID' => "$bookid"));
		$total = $this->db->get_where('peminjaman');

		$searchbook = $this->db->get_where('buku', array('BukuID' => "$bookid"));

		if ($userdata->num_rows() < 0) {
			redirect("dashboard");
		}

		if ($userdata->row()->Peminjaman >= '3') {
			$this->session->set_flashdata('message', "Kamu sudah mencapai batas peminjaman");
			redirect("dashboard/category");
		}

		if ($searchbook->num_rows() < 0) {
			$this->session->set_flashdata('message', "Tidak bisa menemukan buku ini");
			redirect("dashboard/category");
		}

		if ($search->num_rows() > 0) {

			if ($search->row()->StatusPeminjaman !== '2') {
				$status = $search->row()->StatusPeminjaman == 2 ? 'Dikembalikan' : ($search->row()->StatusPeminjaman == 1 ? 'Belum Dikembalikan' : 'Menunggu Diterima');


				$statusDate = $search->row()->TanggalPeminjaman;
				$this->session->set_flashdata('message', "Kamu sudah pernah meminjam buku ini ditanggal <strong>$statusDate</strong> dengan status <strong>$status</strong>");
				redirect("book/view/$bookid");
			} else {

				$book = $searchbook->row();
				$bookStok = $book->Stok;
				if ($takeborrow > $book->Stok) {
					$this->session->set_flashdata('message', "Stok yang kamu ambil tidak cukup");
					redirect("book/view/$bookid");
				}

				$currentDateTime = new DateTime('now');
				$currentDate = $currentDateTime->format('Y-m-d');

				$date = (new DateTime('+3 days'))->format('Y-m-d 00:00:00');

				$totalusr = $total->num_rows() + 1;
				$uid = sprintf('%04d', $totalusr);
				$data_buku = array(
					'PeminjamanID' => "PIN$uid",
					'UserID' => $userid,
					'BukuID' => $bookid,
					'TanggalPeminjaman' => $currentDate,
					'StatusPeminjaman' => '0',
					'Total' => "$takeborrow"
				);

				$stokleft = $bookStok - $takeborrow;

				$this->db->query("UPDATE buku SET 'Stok' = '$stokLeft' WHERE BukuID = $bookid");
				$this->db->where('BukuID', $bookid);
				$this->db->update('buku', array('Stok' => $stokleft));

				$totalpeminjaman = $userdata->row()->Peminjaman + 1;

				$this->db->query("UPDATE user SET Peminjaman = '$totalpeminjaman' WHERE UserID = '$userid'");

				$this->db->insert('peminjaman', $data_buku);
				$this->session->set_flashdata('message', "Kamu meminjam <strong>$book->Judul</strong> berjumlah <strong>$takeborrow</strong> dan sekarang menunggu diterima dari petugas");
				redirect("book/view/$bookid");
			}

		} else {

			$book = $searchbook->row();
			$bookStok = $book->Stok;
			if ($takeborrow > $book->Stok) {
				$this->session->set_flashdata('message', "Stok yang kamu ambil tidak cukup");
				redirect("book/view/$bookid");
			}

			$currentDateTime = new DateTime('now');
			$currentDate = $currentDateTime->format('Y-m-d');

			$date = (new DateTime('+3 days'))->format('Y-m-d 00:00:00');

			$totalusr = $total->num_rows() + 1;
			$uid = sprintf('%04d', $totalusr);
			$data_buku = array(
				'PeminjamanID' => "PIN$uid",
				'UserID' => $userid,
				'BukuID' => $bookid,
				'TanggalPeminjaman' => $currentDate,
				'StatusPeminjaman' => '0',
				'Total' => "$takeborrow"
			);

			$stokleft = $bookStok - $takeborrow;

			$this->db->query("UPDATE buku SET 'Stok' = '$stokLeft' WHERE BukuID = $bookid");
			$this->db->where('BukuID', $bookid);
			$this->db->update('buku', array('Stok' => $stokleft));

			$totalpeminjaman = $userdata->row()->Peminjaman + 1;

			$this->db->query("UPDATE user SET Peminjaman = '$totalpeminjaman' WHERE UserID = '$userid'");

			$this->db->insert('peminjaman', $data_buku);
			$this->session->set_flashdata('message', "Kamu meminjam <strong>$book->Judul</strong> berjumlah <strong>$takeborrow</strong> dan sekarang menunggu diterima dari petugas");
			redirect("book/view/$bookid");
		}
	}

	function getrev($bookid)
	{
		$query = $this->db->get_where('ulasanbuku', array('BukuID' => $bookid));
		if ($query->num_rows() > 0) {
			$data_user = $query->row();
			return $data_user;
		} else {
			redirect(base_url('dashboard/category'));
		}
	}

	function getcat($id)
	{
		$query = $this->db->get_where('kategoribuku', array('KategoriID' => $id));
		if ($query->num_rows() > 0) {
			$data_user = $query->row();
			return $data_user;
		} else {
			redirect(base_url('dashboard/category'));
		}
	}

	function getbook($id)
	{
		$query = $this->db->get_where('buku', array('BukuID' => $id));
		if ($query->num_rows() > 0) {
			$data_user = $query->row();
			return $data_user;
		} else {
			return [];
		}
	}

	function getcatrel($id)
	{
		$query = $this->db->get_where('buku', array('KategoriID' => $id));
		if ($query->num_rows() > 0) {
			$data_user = $query->row();



			return $data_user;
		} else {
			redirect(base_url('dashboard/category'));
		}
	}

	function editcat($id, $newname)
	{

		$search = $this->db->get_where('kategoribuku', array('NamaKategori' => $newname));

		if ($search->num_rows() > 0) {
			$data_buku = $search->row();

			if ($data_buku->KategoriID !== "$id") {
				$this->session->set_flashdata('message', 'Nama kategori sudah ada');
				redirect('dashboard/category');
			}

			$this->db->query("UPDATE kategoribuku SET NamaKategori = '$newname' WHERE KategoriID = $id");
			$this->db->where('KategoriID', $id);
			$this->db->update('kategoribuku', array('NamaKategori' => $newname));
			return 1;
		} else {
			$this->db->query("UPDATE kategoribuku SET NamaKategori = '$newname' WHERE KategoriID = $id");
			$this->db->where('KategoriID', $id);
			$this->db->update('kategoribuku', array('NamaKategori' => $newname));
		}

	}

	function editrak($id, $newname)
	{

		$search = $this->db->get_where('rakbuku', array('NamaRak' => $newname));

		if ($search->num_rows() > 0) {
			$data_buku = $search->row();

			if ($data_buku->RakID !== "$id") {
				$this->session->set_flashdata('message', 'Nama rak sudah ada');
				redirect('dashboard/rak');
			}

			$this->db->query("UPDATE rakbuku SET NamaRak = '$newname' WHERE RakID = $id");
			$this->db->where('RakID', $id);
			$this->db->update('rakbuku', array('NamaRak' => $newname));
			return 1;
		} else {
			$this->db->query("UPDATE rakbuku SET NamaRak = '$newname' WHERE RakID = $id");
			$this->db->where('RakID', $id);
			$this->db->update('rakbuku', array('NamaRak' => $newname));
		}

	}

	function editbook($bookid, $title, $writer, $publisher, $pubyear, $bookcat, $bookstok, $red, $bookrak)
	{

		$search = $this->db->get_where('buku', array('BukuID' => $bookid));

		if ($search->num_rows() > 0) {
			$data_buku = $search->row();

			if ($data_buku->BukuID !== "$bookid") {
				$this->session->set_flashdata('message', 'ISBN Sudah ada');
				redirect("$red");
			}


			// $this->db->query("UPDATE buku SET BukuID = '$bookid', Judul = '$title', Penulis = '$writer', Penerbit = '$publisher', TahunTerbit = '$pubyear', Stok = '$bookstok', RakID = '$bookrak' WHERE `buku`.`BukuID` = '$data_buku->BukuID'");
			$this->db->where('BukuID', $data_buku->BukuID);
			$this->db->update('buku', array('BukuID' => "$bookid", 'Judul' => "$title", 'Penulis' => "$writer", 'Penerbit' => "$publisher", 'TahunTerbit' => "$pubyear", 'Stok' => "$bookstok", 'RakID' => "$bookrak", 'KategoriID' => "$bookcat"));

			return 1;
		} else {
			$this->db->query("UPDATE buku SET BukuID = '$bookid', Judul = '$title', Penulis = '$writer', Penerbit = '$publisher', TahunTerbit = '$pubyear', Stok = '$bookstok', RakID = '$bookrak', KategoriID = '$bookcat' WHERE `buku`.`BukuID` = '$data_buku->BukuID'");
		}
		// $this->db->where('BukuID', $bookid);
		// $this->db->update('buku', array('NamaKategori' => $newname));
	}

	function deletebook($id)
	{

		$search = $this->db->get_where('peminjaman', array('BukuID' => $id, 'StatusPeminjaman' => '0'));
		$bookdata = $this->db->get_where('buku', array('BukuID' => $id))->row();

		if ($search->num_rows() > 0) {
			$this->session->set_flashdata('message', "Kamu tidak bisa menghapus <strong>$bookdata->Judul</strong> karena buku sedang dipinjam");
			redirect(base_url("book/view/$id"));
		} else {
			$Path = "images/";
			$ImagePath = $Path . $bookdata->RakID . "_$bookdata->BukuID" . "_sampul.png";

			unlink($ImagePath);
			$this->db->delete('buku', array('BukuID' => $id));
			$this->db->delete('ulasanbuku', array('BukuID' => $id));
			$this->db->delete('peminjaman', array('BukuID' => $id));
		}

	}

	function deletecat($id)
	{
		$this->db->delete('kategoribuku', array('KategoriID' => $id));
	}

	function deleterak($id)
	{
		$this->db->delete('rakbuku', array('RakID' => $id));
	}

	function returnborrow($id, $uid)
	{

		$search = $this->db->get_where('peminjaman', array('PeminjamanID' => "$id"));
		$currentDateTime = new DateTime('now');
		$currentDate = $currentDateTime->format('Y-m-d');


		if ($search->num_rows() > 0) {
			$book = $this->db->get_where('buku', array('BukuID' => $search->row()->BukuID));
			$userdata = $this->db->get_where('user', array('UserID' => $uid));

			if ($userdata->num_rows() < 0) {
				redirect("dashboard");
			}

			$userID = $userdata->row()->UserID;


			$this->db->query("UPDATE peminjaman SET StatusPeminjaman = '2', TanggalPengembalian = '$currentDate' WHERE PeminjamanID = '$id'");
			$this->db->where('peminjaman', "$id");
			$this->db->update('peminjaman', array('StatusPeminjaman' => '2', 'TanggalPengembalian' => $currentDate));

			$newstok = $book->row()->Stok + $search->row()->Total;


			$this->db->query("UPDATE buku SET 'Stok' = $newstok WHERE BukuID = $search->row()->BukuID");
			$this->db->where('BukuID', $search->row()->BukuID);
			$this->db->update('buku', array('Stok' => $newstok));

			$totalpeminjaman = $userdata->row()->Peminjaman - 1;
			// $this->session->set_flashdata('message', $totalpeminjaman);
			// redirect("category/detail/KAT0001");
			$this->db->query("UPDATE user SET Peminjaman = '$totalpeminjaman' WHERE UserID = $userID");
			$this->db->where('UserID', "$userID");
			$this->db->update('user', array('Peminjaman' => "$totalpeminjaman"));
		}

	}

	function approveborrow($id)
	{

		$search = $this->db->get_where('peminjaman', array('PeminjamanID' => "$id"));

		if ($search->num_rows() > 0) {
			$this->db->query("UPDATE peminjaman SET StatusPeminjaman = '1' WHERE PeminjamanID = '$id'");
			$this->db->where('peminjaman', $id);
			$this->db->update('peminjaman', array('StatusPeminjaman' => '1'));
		} else {
			redirect('dashboard');
		}

	}

	function deleteborrow($id)
	{

		$search = $this->db->get_where('peminjaman', array('PeminjamanID' => $id));
		if ($search->num_rows() > 0) {
			$status = $search->row()->StatusPeminjaman;
			if ($status !== '2') {
				$book = $this->db->get_where('buku', array('BukuID' => $search->row()->BukuID));

				$newstok = $book->row()->Stok + $search->row()->Total;

				$this->db->query("UPDATE buku SET 'Stok' = $newstok WHERE BukuID = $search->row()->BukuID");
				$this->db->where('BukuID', $search->row()->BukuID);
				$this->db->update('buku', array('Stok' => $newstok));
			}

		}

		$this->db->delete('peminjaman', array('PeminjamanID' => $id));
	}

	function checkborrow()
	{
		$borrows = $this->db->query('SELECT * FROM peminjaman');
		$settings = $this->db->query('SELECT * FROM pengaturan')->row();

		foreach ($borrows->result_array() as $bor) {
			$date = $bor['TanggalPeminjaman'];
			// $maxdate = date('Y-m-d', strtotime($date . ' + 4 days'));
			$maxdate = $date;
			$currentDateTime = new DateTime('now');
			// $currentDate = $currentDateTime->format('Y-m-d');
			$currentDate = '2024-04-29';

			if ($maxdate == $currentDate) {
				$search = $this->db->get_where('peminjaman', array('PeminjamanID' => $bor['PeminjamanID']));
				$pinid = $bor['PeminjamanID'];

				if ($search->num_rows() > 0) {
					$this->db->query("UPDATE peminjaman SET StatusPeminjaman = '3' WHERE PeminjamanID = '$pinid'");
					$this->db->where('peminjaman', "$pinid");
					$this->db->update('peminjaman', array('StatusPeminjaman' => '3'));
				}
			}
		}
	}
}
?>