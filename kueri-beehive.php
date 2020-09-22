<?php
class kueriBeehive{
    // Untuk Koneksi
    public function __construct()
    { //nama server, username, password, nama_database
        $this->koneksi = mysqli_connect("127.0.0.1", "root", "", "bestore_beehive");
        // $this->koneksi = mysqli_connect("localhost", "u1066805_bestoremall", "bestoreMainplm", "u1066805_bestoremall");
        if (!$this->koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    //Kueri CekID
    public function cekID()
    {
        $sql = "SELECT id_partner AS lastIDP FROM tb_partner ORDER BY id_partner DESC LIMIT 1";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }

    // Kueri Posting / Input Partner
    public function iPartner($idPartner, $namaPartner, $emailPartner, $passPartner, $telpPartner, $statusPartner,$alamat, $provinsi, $kota, $bank, $norek, $mou, $mou_s, $tempatUpload, $fotoPartner)
    {
        $upload = move_uploaded_file($mou_s, $tempatUpload.$mou);
        if ($upload) {
            $sql = "INSERT INTO `tb_partner`(`id_partner`, `nama_partner`, `email_partner`, `password_partner`, `foto_partner`, `telp_partner`, `alamat`, `provinsi`, `kota`, `tipe_bank`, `no_rek`, `file_mou`, `status_partner`) VALUES ('$idPartner','$namaPartner','$emailPartner','$passPartner','$fotoPartner','$telpPartner', '$alamat', '$provinsi', '$kota','$bank','$norek','$mou','$statusPartner')";
            $query = mysqli_query($this -> koneksi, $sql);
            if ($query) {
                return "Berhasil";
            }
            else{
                return "Gagal";
            }
        }else{
            return "Gagal";
        }
    }
    
}
?>