<?php
    require 'kueri-mall.php';
    $kueriMall = new kueriMall();

    session_start();
    if (!isset($_SESSION['id_patner'])) { //Cek Session Patner
        header('Location:login');
    }

    // ===============================
    // Masukkkan Produk
    if (isset($_POST['masukkan_produk'])) {
        $nama_foto_produk = $_FILES['foto_produk']['name'];
        $nama_foto_thumb = $_FILES['foto_thumb']['name'];
        
		$nama_foto_produk_s = $_FILES['foto_produk']['tmp_name'];
		$nama_foto_thumb_s = $_FILES['foto_thumb']['tmp_name'];
        $tempat_upload = "assets/img/product/patner/";
        
        $temp1 = explode(".", $_FILES["foto_produk"]["name"]);//untuk mengambil nama file gambarnya saja tanpa format gambarnya
        $temp2 = explode(".", $_FILES["foto_thumb"]["name"]);//untuk mengambil nama file gambarnya saja tanpa format gambarnya
		$nama_baru1 = round(microtime(true)) . '1.' . end($temp1);//fungsi untuk membuat nama acak
		$nama_baru2 = round(microtime(true)) . '2.' . end($temp2);//fungsi untuk membuat nama acak

        $format1 = pathinfo($nama_foto_produk, PATHINFO_EXTENSION); // Mendapatkan format file
        $format2 = pathinfo($nama_foto_thumb, PATHINFO_EXTENSION); // Mendapatkan format file
        if( ($format1 == "jpg") or ($format1 == "png") ){
            if (($format2 == "jpg") or ($format2 == "png")) {
                $a = $kueriMall->iProduk($_GET['it'], $_POST['nama_produk'], $_POST['harga'], $_POST['deskripsi'], $_POST['berat'], $_POST['stok'],$_GET['kt'], $_POST['link_video'], $nama_baru1, $nama_baru2,$nama_foto_produk_s, $nama_foto_thumb_s,$tempat_upload,'patner');
                if ($a == 'Berhasil') {
                    echo '<script>alert("Berhasil Memasukkan Produk"); window.location="my-web";</script>';
                }elseif ($a == "Gagal Upload Gambar") {
                    echo '<script>alert("Gagal Upload Gambar"); </script>';
                }elseif ($a == "Gagal Input Produk") {
                    echo '<script>alert("Gagal Input Produk"); </script>';
                }elseif ($a == "Gagal Input Img") {
                    echo '<script>alert("Gagal Input Img"); </script>';
                }elseif ($a == "Gagal Input Video") {
                    echo '<script>alert("Gagal Input Video"); </script>';
                }else{
                    echo '<script>alert("Terjadi Kesalahan, Ukuran File Terlalu Besar!!");</script>';
                }
            }
        }else{ // else validasi format
            echo '<script>alert("Format Gambar Harus JPG atau PNG"); </script>';
        }
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Bestore Mall</title>
    <link rel="shortcut icon" href="assets/img/svg/icon/BESTORE LOGO NO BACKGROUND.svg" type="image/x-icon">
    <!-- css Utama -->
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Css This Page -->
    <link rel="stylesheet" href="assets/css/my-web.css">
    <!-- Css Font -->
    <link rel="stylesheet" href="assets/css/font.css">

    <!-- Begin:Slide -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- End:Slide -->

    <!-- Sidebar -->
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Sidebar -->
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->

        <!-- Page Content  -->
        <div id="content">
            <div class="container d-toko-patner">
                <div class="row justify-content-center nav-top sticky-top">
                    <div class="col-11 div-nav">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <button class="btn btn-back" onclick="goBack()">
                                    <svg fill="#111" width="0.2400in" height="0.4400in" id="Capa_1"
                                        enable-background="new 0 0 482.239 482.239"
                                        viewBox="0 0 482.239 482.239" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m206.812 34.446-206.812 206.673 206.743 206.674 24.353-24.284-165.167-165.167h416.31v-34.445h-416.31l165.236-165.236z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="col-10">
                                <h5>Masukkan Produk</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center form-daftar">
                    <div class="col-11">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="formGroupExampleInput">Nama Produk</label>
                              <input type="text" name="nama_produk" class="form-control" required="" id="formGroupExampleInput" placeholder="Kursi Lipat Anak">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Harga</label>
                                <input type="text" name="harga" class="form-control" required="" id="formGroupExampleInput2" placeholder="30000">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Deskripsi</label>
                                <input type="text" name="deskripsi" class="form-control" required="" id="formGroupExampleInput2" placeholder="Produk Ini adalah...">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Berat</label>
                                <input type="text" name="berat" class="form-control" required="" id="formGroupExampleInput2" placeholder="Gram">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Stok</label>
                                <input type="text" name="stok" class="form-control" required="" id="formGroupExampleInput2" placeholder="12">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Foto Produk</label>
                                <input type="file" name="foto_produk" class="form-control" required="" id="formGroupExampleInput2" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Thumbnail Vide</label>
                                <input type="file" name="foto_thumb" class="form-control" required="" id="formGroupExampleInput2" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Link Video YT</label>
                                <input type="text" name="link_video" class="form-control" required="" id="formGroupExampleInput2" placeholder="0ApFxXC2V20">
                            </div>
                            <button type="submit" class="btn btn-daftar mb-5" name="masukkan_produk">Lanjut</button>
                          </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="overlay"></div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <!-- Sidebar -->
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>
    <!-- Sidebar -->

    </script>

    <!-- Untuk Kembali Kehalaman Sebelumnya -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <!-- Untuk Kembali Kehalaman Sebelumnya -->
    <!-- Initialize Swiper -->
</body>

</html>