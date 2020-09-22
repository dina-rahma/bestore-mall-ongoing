<?php
class kueri{
    // Untuk Koneksi
    public function __construct()
    { //nama server, username, password, nama_database
        $this->koneksi = mysqli_connect("127.0.0.1", "root", "", "bestore-main");
        // $this->koneksi = mysqli_connect("localhost", "u1066805_bestoremall", "bestoreMainplm", "u1066805_bestoremall");
        if (!$this->koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // Register tb_patner tahap 1 
    public function iPatner1($idPatner, $email, $password, $status_paket)
    {
        $sql = "INSERT INTO `tb_patner`(`id_patner`, `email_patner`, `password`, `status_paket`) VALUES ($idPatner, '$email', '$password', $status_paket)";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return "Berhasil";
        }
        else{
            return "Gagal";
        }
    }
    // Register tb_patner tahap 2
    public function iPatner2($idPatner, $namaL, $username, $alamat, $kode_ref)
    {
        $sql = "UPDATE `tb_patner` SET `nama_patner`='$namaL',`username`='$username',`alamat` = '$alamat',`kode_ref`='$kode_ref' WHERE `id_patner` = $idPatner";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return "Berhasil";
        }
        else{
            return "Gagal";
        }
    }
    
    // Update  tb_patner
    public function eAkun($idPatner, $nama_patner, $no_hp, $bank, $no_rek, $an, $alamat)
    {
        $sql = "UPDATE `tb_patner` SET `nama_patner`='$nama_patner',`no_hp`='$no_hp',`jns_bank`='$bank',`no_rek`='$no_rek',`an`='$an',`alamat`='$alamat' WHERE id_patner = '$idPatner'";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return "Berhasil";
        }
        else{
            return "Gagal";
        }
    }

    // Baca id Last Patner
    public function idlastP()
    {
        $sql = "SELECT * FROM `tb_patner` WHERE id_patner IN (SELECT MAX(id_patner) FROM `tb_patner`)";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca Per Email Patner 
    public function validEmail($email)
    {
        $sql = "SELECT * FROM `tb_patner` WHERE email_patner = '$email'";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca Per Id Patner 
    public function bDiri($id_patner)
    {
        $sql = "SELECT * FROM `tb_patner` INNER JOIN tb_paket ON tb_paket.id_paket = tb_patner.status_paket WHERE id_patner = '$id_patner'";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    
    // ==============================================================
    // Admin 
    public function loginAdm($user, $pass)
    {
        $sql = "SELECT * FROM `tb_admin` WHERE username='$user' AND `password` = '$pass'";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return 'Berhasil';
        }
        else{
            return "Gagal";
        }
    }
    
}
?>