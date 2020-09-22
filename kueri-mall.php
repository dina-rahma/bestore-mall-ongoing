<?php
class kueriMall{
    // Untuk Koneksi
    public function __construct()
    { //nama server, username, password, nama_database
        $this->koneksi = mysqli_connect("127.0.0.1", "root", "", "bestore-mall");
        // $this->koneksi = mysqli_connect("localhost", "bestorem_mall", "P6E?y*7pi+]N", "bestorem_mall");
        if (!$this->koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // Baca Product Official
    public function bProdukBestore()
    {
        $sql = "SELECT * FROM `tb_produk` INNER JOIN tb_toko ON tb_toko.id_toko = tb_produk.id_toko WHERE tb_toko.status_toko = '1'";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca Product Official
    public function bProdukPatner()
    {
        $sql = "SELECT * FROM `tb_produk` INNER JOIN tb_toko ON tb_toko.id_toko = tb_produk.id_toko WHERE tb_toko.status_toko = '2'";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca Product Official
    public function bProdukPatnerKu($id_penjual)
    {
        $sql = "SELECT * FROM `tb_produk` INNER JOIN tb_toko ON tb_toko.id_toko = tb_produk.id_toko WHERE tb_toko.id_penjual = '$id_penjual'";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca Foto Produk Limit 1
    public function bImgProduk($id_produk)
    {
        $sql = "SELECT * FROM `tb_produk_img` WHERE id_produk = '$id_produk' ORDER BY id_produk_img ASC LIMIT 1";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }

    // Baca Detail Product 
    public function bProdukD($idp)
    {
        $sql = "SELECT * FROM `tb_produk` INNER JOIN tb_toko ON tb_toko.id_toko = tb_produk.id_toko WHERE tb_produk.id_produk = $idp";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca img Detailproduk
    public function bProdukID($id_produk)
    {
        $sql = "SELECT * FROM `tb_produk_img` WHERE id_produk = '$id_produk' ORDER BY id_produk_img ASC";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca img Detailproduk
    public function bProdukVD($id_produk)
    {
        $sql = "SELECT * FROM `tb_produk_video` WHERE id_produk = '$id_produk' ORDER BY id_produk_video ASC";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    
    //==========================================================================================================
    // Baca Toko Detail
    public function bTokoD($id_toko)
    {
        $sql = "SELECT * FROM `tb_toko`WHERE id_toko = $id_toko";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca Keranjang Patner
    public function bKeranjang($id_patner, $id_toko)
    {
        $sql = "SELECT * FROM `tb_keranjang` INNER JOIN tb_produk ON tb_keranjang.id_produk = tb_produk.id_produk INNER JOIN tb_toko ON tb_produk.id_toko = tb_toko.id_toko WHERE tb_keranjang.id_patner = $id_patner AND tb_produk.id_toko = $id_toko";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca Keranjang Patner Versi Toko
    public function bKeranjangToko($id_patner)
    {
        // $sql = "SELECT id_toko FROM tb_toko UNION SELECT id_toko FROM tb_produk INNER JOIN tb_keranjang ON tb_produk.id_produk = tb_keranjang.id_produk WHERE tb_keranjang.id_patner = '$id_patner'";
        $sql = "SELECT tb_toko.id_toko FROM tb_toko INNER JOIN tb_produk ON tb_toko.id_toko = tb_produk.id_toko INNER JOIN tb_keranjang ON tb_keranjang.id_produk = tb_produk.id_produk WHERE tb_keranjang.id_patner = '$id_patner' UNION SELECT id_toko FROM tb_produk INNER JOIN tb_keranjang ON tb_produk.id_produk = tb_keranjang.id_produk WHERE tb_keranjang.id_patner = $id_patner";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca Keranjang dengan ID produk
    public function bKProduk($id_produk)
    {
        $sql = "SELECT id_produk FROM `tb_keranjang` WHERE id_produk = $id_produk";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            $result = mysqli_num_rows($query);
            return $result;
        }
        else{
            return "Gagal";
        }
    }
    // Baca Keranjang Dengan Semua produk
    public function bKeranjangP($id_patner)
    {
        $sql = "SELECT id_produk, qty FROM `tb_keranjang` WHERE id_patner = $id_patner";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Input Keranjang
    public function iKeranjang($id_produk, $id_patner, $qty)
    {
        $sql = "INSERT INTO `tb_keranjang`(`id_produk`, `id_patner`, `qty`) VALUES ($id_produk,$id_patner,$qty)";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return 'Berhasil';
        }
        else{
            return "Gagal";
        }
    }
    // Delete Produk
    public function hapusProduk($id_produk)
    {
        $sql = "DELETE FROM `tb_keranjang` WHERE id_produk = $id_produk";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return 'Berhasil';
        }
        else{
            return "Gagal";
        }
    }

    // Delete Produk versi patner
    public function hapusProdukPatner($id_patner)
    {
        $sql = "DELETE FROM `tb_keranjang` WHERE id_patner = $id_patner";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            return 'Berhasil';
        }
        else{
            return "Gagal";
        }
    }

    //==========================================================================
    //Bagian Keranjang
     // Baca Total Harga Keranjang 
     public function bTotalH($id_patner)
     {
         $sql = "SELECT SUM(tb_produk.harga) AS total_harga FROM `tb_keranjang` INNER JOIN tb_produk ON tb_keranjang.id_produk = tb_produk.id_produk WHERE tb_keranjang.id_patner = $id_patner";
         $query = mysqli_query($this -> koneksi, $sql);
         if ($query) {
             return $query;
         }
         else{
             return "Gagal";
         }
     }
     
     // Baca Total Harga Via Transaksi 
     public function bTotalTransaksi($id_invoice)
     {
         $sql = "SELECT SUM(tb_produk.harga) AS total_harga FROM `tb_transaksi` INNER JOIN tb_produk ON tb_transaksi.id_produk = tb_produk.id_produk WHERE tb_transaksi.id_invoice = $id_invoice";
         $query = mysqli_query($this -> koneksi, $sql);
         if ($query) {
             return $query;
         }
         else{
             return "Gagal";
         }
     }

     // Baca Invoice 1
     public function bInvoiceID()
     {
         $sql = "SELECT id_invoice FROM `tb_invoice` ORDER BY id_invoice DESC";
         $query = mysqli_query($this -> koneksi, $sql);
         if ($query) {
            // $result = mysqli_num_rows($query);
            return $query;
         }
         else{
             return "Gagal";
         }
     }
     // Baca Invoice Detail
     public function bInvoiceD($id_invoice)
     {
         $sql = "SELECT ongkos_kirim, digit_terakhir, tgl_batas FROM `tb_invoice` WHERE id_invoice = $id_invoice";
         $query = mysqli_query($this -> koneksi, $sql);
         if ($query) {
            return $query;
         }
         else{
             return "Gagal";
         }
     }
     // Baca Transaksi 1 
     public function bTransaksiID()
     {
         $sql = "SELECT id_transaksi FROM `tb_transaksi` ORDER BY id_transaksi DESC";
         $query = mysqli_query($this -> koneksi, $sql);
         if ($query) {
            // $result = mysqli_num_rows($query);
            return $query;
         }
         else{
             return "Gagal";
         }
     }
     
     // Delete Invoice
     public function dInvoice($id_patner, $statusInvoice)
     {
         $sql = "DELETE FROM `tb_invoice` WHERE id_patner = $id_patner AND status_invoice = '$statusInvoice'";
         $query = mysqli_query($this -> koneksi, $sql);
         if ($query) {
            $result = mysqli_num_rows($query);
            return $result;
         }
         else{
             return "Gagal";
         }
     }

     // Input Invoice 
     public function iInvoice($id_invoice, $id_patner, $ongkir, $tHarga, $generate_angka, $kurir, $metode_bayar, $tgl_batas)
     {
         $sql = "INSERT INTO `tb_invoice`(`id_invoice`, `id_patner`, `ongkos_kirim`, `total_dibayar`, `digit_terakhir`, `metode_kurir`, `metode_bayar`, `tgl_batas`) VALUES ('$id_invoice', '$id_patner','$ongkir','$tHarga','$generate_angka','$kurir','$metode_bayar','$tgl_batas')";
         $query = mysqli_query($this -> koneksi, $sql);
         if ($query) {
             return "Berhasil";
         }
         else{
             return "Gagal";
         }
     }
     
     // Input Transaksi 
     public function iTransaksi($id_transaksi, $id_produk, $id_patner, $id_invoice, $statusTransaksi, $qty)
     {
         $sql = "INSERT INTO `tb_transaksi`(`id_transaksi`, `id_produk`, `id_patner`, `id_invoice`, `qty`, `status_transaksi`) VALUES ('$id_transaksi','$id_produk','$id_patner','$id_invoice', '$qty', '$statusTransaksi')";
         $query = mysqli_query($this -> koneksi, $sql);
         if ($query) {
             return "Berhasil";
         }
         else{
             return "Gagal";
         }
     }

    //  ================================================
    //Upload Bukti_pembayaran
    // Upload Bukti Pembayaran Cash
    public function upload_b($iv, $nama_baru, $nama_foto_s, $tempat_upload)
    {
        $upload = move_uploaded_file($nama_foto_s, $tempat_upload.$nama_baru);
        if ($upload) {
            $sql = "UPDATE `tb_invoice` SET `bukti_bayar`='$nama_baru',`status_invoice`= '2' WHERE id_invoice = $iv";
            $query = mysqli_query($this -> koneksi, $sql);
            if ($query) {
                $sql = "UPDATE `tb_transaksi` SET `status_transaksi`='2' WHERE id_invoice = '$iv'";
                $query = mysqli_query($this -> koneksi, $sql);
                if ($query) {
                    return "Berhasil";
                }else{
                    return "Gagal";
                }
                return "Berhasil";
            }
            else{
                return "Gagal";
            }
        }else{
            return "gagal";
        }
    } 


    //=============================================================
    // Toko Saya / My Web
    // Input Toko 
    public function iToko($id_patner, $nama_toko, $sub_domain)
    {
        $sql = "INSERT INTO `tb_toko`(`id_penjual`, `nama_toko`, `nama_folder`, `sub-domain`, `status_toko`) VALUES ('$id_patner','$nama_toko','$sub_domain','$sub_domain','2')";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
           return "Berhasil";
        }
        else{
            return "Gagal";
        }
    }
    // Baca ID Toko by id Patner 1 
    public function bTokoID($id_patner)
    {
        $sql = "SELECT id_toko FROM `tb_toko` WHERE id_penjual = $id_patner ORDER BY id_toko DESC";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
           return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca ID Toko by id Patner 1 
    public function bDToko($id_toko)
    {
        $sql = "SELECT * FROM `tb_toko` WHERE id_toko = $id_toko";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
           return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Cek Toko untuk Validasi Daftar 
    public function bTokoCek($id_patner, $nama_toko, $sub_domain)
    {
        $sql = "SELECT id_toko FROM `tb_toko` WHERE id_penjual = $id_patner ORDER BY id_toko DESC";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            $total = mysqli_num_rows($query);
            if ($total > 0) {
                return "Patner Terdaftar"; //ID sudahr Terdaftar
            }else{
                $sql = "SELECT nama_toko FROM `tb_toko` WHERE nama_toko = '$nama_toko' ORDER BY id_toko DESC";
                $query = mysqli_query($this -> koneksi, $sql);
                if ($query) {
                    $total = mysqli_num_rows($query);
                    if ($total > 0) {
                        return "Nama Terdaftar"; // Nama TOko Sudah Terdaftar
                    }else{
                        $sql = "SELECT sub_domain FROM `tb_toko` WHERE sub_domain = '$sub_domain' ORDER BY id_toko DESC";
                        $query = mysqli_query($this -> koneksi, $sql);
                        if ($total > 0) {
                            return "Sub Domain Terdaftar"; //Sub domain sudah terdaftar
                        }else{
                            return "Aman"; //aman
                        }
                    }
                }
            }
        }
        else{
            return "Gagal";
        }
    }

    // Edit Toko
    public function eToko($it,$nama_toko,$no_telp,$kota,$alamat, $nama_baru, $nama_foto_s, $tempat_upload, $alert)
    {
        if ($alert == 'nofoto') {
            $sql = "UPDATE `tb_toko` SET `nama_toko`='$nama_toko',`logo_img`='$nama_baru',`no_telp`='$no_telp',`alamat`='$alamat',`kota`='$kota' WHERE id_toko = $it";
            $query = mysqli_query($this -> koneksi, $sql);
            if ($query) {
                return "Berhasil";
            }
            else{
                return "Gagal";
            }
        }else{
            $upload = move_uploaded_file($nama_foto_s, $tempat_upload.$nama_baru);
            if ($upload) {
                $sql = "UPDATE `tb_toko` SET `nama_toko`='$nama_toko',`logo_img`='$nama_baru',`no_telp`='$no_telp',`alamat`='$alamat',`kota`='$kota' WHERE id_toko = $it";
                $query = mysqli_query($this -> koneksi, $sql);
                if ($query) {
                    return "Berhasil";
                }
                else{
                    return "Gagal";
                }
            }else{
                return "gagal";
            }
        }
    }


    // =====================================================
    // Produk
    // Baca Jns Produk 
    public function jnsProduk($id_sub)
    {
        $sql = "SELECT * FROM `tb_jenis_produk` WHERE id_kategori_sub = $id_sub";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
           return $query;
        }
        else{
            return "Gagal";
        }
    }
    
    // Baca ID Toko by id Patner 1 
    public function iProduk($it,$nama_produk,$harga,$deskripsi,$berat,$stok,$jns_produk, $link_video, $nama_baru1,$nama_baru2, $nama_foto_produk_s,$nama_foto_thumb_s, $tempat_upload, $folder, $video)
    {
        $upload1 = move_uploaded_file($nama_foto_produk_s, $tempat_upload.$nama_baru1); //Upload Image Produk
        if ($video == 'ada') {
            $upload2 = move_uploaded_file($nama_foto_thumb_s, $tempat_upload.$nama_baru2); //Upload Thumbnail Produk
        }
        $sql = "INSERT INTO `tb_produk`(`id_toko`, `nama_produk`, `harga`, `deskripsi`, `berat`, `jns_produk`, `stok`, `status_stok`) VALUES ('$it','$nama_produk','$harga','$deskripsi','$berat','$jns_produk','$stok','1')";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            $id_p = mysqli_insert_id($this-> koneksi); //Id Produk
            $sql = "INSERT INTO `tb_produk_img`(`id_produk`, `nama_img`, `nama_folder`) VALUES ('$id_p','$nama_baru1','$folder')";
            $query = mysqli_query($this -> koneksi, $sql);
            if ($query) {
                if ($video == 'ada') {
                    $sql = "INSERT INTO `tb_produk_video`(`id_produk`, `nama_video`, `nama_folder`, `nama_thumb`) VALUES ('$id_p','$link_video','$folder','$nama_baru2')";
                    $query = mysqli_query($this -> koneksi, $sql);
                }else{
                    $query == 'Kosong';
                }
                if ($query) {
                    return "Berhasil";
                }else{
                    return "Gagal Input Video";
                }
            }else{
                return "Gagal Input Img";
            }
        }else{
            return "Gagal Input Produk";
        }
        if ($upload1 && $upload2) {
        }else{
            return "Gagal Upload Gambar";
        }
    }
    // Edit  Produk
    public function iVideo($ip,$link,$nama_thumb,$nama_foto_thumb_s, $tempat_upload, $folder, $video)
    {
        $sql = "SELECT id_produk FROM `tb_produk_video` WHERE id_produk = '$ip'";
        $query = mysqli_query($this ->koneksi, $sql);
        if ($query) {
            $video_p = mysqli_num_rows($query);
            if ($video_p < 1) {
                $upload2 = move_uploaded_file($nama_foto_thumb_s, $tempat_upload.$nama_thumb); //Upload Thumbnail Produk
                $sql = "INSERT INTO `tb_produk_video`(`id_produk`, `nama_video`, `nama_folder`, `nama_thumb`) VALUES ('$ip','$link','$folder','$nama_thumb')";
                $query = mysqli_query($this -> koneksi, $sql);
                if ($query) {
                   return 'Berhasil';
                }
                else{
                    return "Gagal";
                }
            }else{
                $upload2 = move_uploaded_file($nama_foto_thumb_s, $tempat_upload.$nama_thumb); //Upload Thumbnail Produk
                $sql = "UPDATE `tb_produk_video` SET `nama_video`='$link',`nama_thumb`='$nama_thumb' WHERE id_produk = '$ip'";
                $query = mysqli_query($this -> koneksi, $sql);
                if ($query) {
                   return 'Berhasil';
                }
                else{
                    return "Gagal";
                }
            }
        }
    }
    // Edit  Produk
    public function eProduk($ip,$nama_produk,$harga,$deskripsi,$berat,$stok,$jns_produk)
    {
        $sql = "UPDATE `tb_produk` SET `nama_produk`='$nama_produk',`harga`='$harga',`deskripsi`='$deskripsi',`berat`='$berat',`jns_produk`='$jns_produk',`stok`='$stok' WHERE id_produk = '$ip'";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
           return 'Berhasil';
        }
        else{
            return "Gagal";
        }
    }

    // Hapus Produk
    public function dProduk($ip)
    {
        $sql = "DELETE FROM `tb_produk` WHERE id_produk = '$ip'";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
            $sql = "DELETE FROM `tb_produk_img` WHERE id_produk = '$ip'";
            $query = mysqli_query($this -> koneksi, $sql);
            if ($query) {
                $sql = "DELETE FROM `tb_produk_video` WHERE id_produk = '$ip'";
                $query = mysqli_query($this -> koneksi, $sql);
                if ($query) {
                    return 'Berhasil';
                }
            }
        }
        else{
            return "Gagal";
        }
    }

    // ========================================
    // Baca Kategori
    public function bKategori()
    {
        $sql = "SELECT * FROM `tb_kategori`";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
           return $query;
        }
        else{
            return "Gagal";
        }
    }
    
    // Baca Kategori
    public function bKategoriSub($id_kategori)
    {
        $sql = "SELECT * FROM `tb_kategori_sub` WHERE id_kategori = $id_kategori";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
        return $query;
        }
        else{
            return "Gagal";
        }
    }
    // Baca Kategori SUb tanpa Kategori ID
    public function bKategoriSub2()
    {
        $sql = "SELECT * FROM `tb_kategori_sub`";
        $query = mysqli_query($this -> koneksi, $sql);
        if ($query) {
        return $query;
        }
        else{
            return "Gagal";
        }
    }


    // Edit Img Produk
    public function eImg($iImg,$nama_foto,$nama_foto_produk_s, $tempat_upload)
    {
        $upload = move_uploaded_file($nama_foto_produk_s, $tempat_upload.$nama_foto); //Upload Thumbnail Produk
        if ($upload) {
            $sql = "UPDATE `tb_produk_img` SET `nama_img`='$nama_foto' WHERE id_produk_img = '$iImg'";
            $query = mysqli_query($this -> koneksi, $sql);
            if ($query) {
                return 'Berhasil';
            }
            else{
                return "Gagal";
            }
        }
    }
    
    


}
?>