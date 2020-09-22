<?php
    require 'kueri-mall.php';
    $kueriMall = new kueriMall();

    session_start();
    if (!isset($_SESSION['id_patner'])) { //Cek Session Patner
        header('Location:login');
    }

    // ===============================
    // Masukkkan Produk
    if (isset($_POST['masukkan_kategori'])) {
        header("Location:form-input-produk?it=".$_GET['it']."&kt=1");
    }

    $bKategori = $kueriMall->bKategori();
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
                                        enable-background="new 0 0 482.239 482.239" viewBox="0 0 482.239 482.239"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m206.812 34.446-206.812 206.673 206.743 206.674 24.353-24.284-165.167-165.167h416.31v-34.445h-416.31l165.236-165.236z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="col-10">
                                <h5>Pilih Kategori</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center form-daftar">
                    <div class="col-11">
                        <form action="" method="post" enctype="multipart/form-data">


                            <div class="panel-group" id="accordion1">
                                <!-- =================================== -->

                                <?php
                                    $katI = 1;
                                    $katII = $katI +1;
                                    while ($rowKategori = mysqli_fetch_assoc($bKategori)) {

                                        $bKategoriSub = $kueriMall->bKategoriSub($rowKategori['id_kategori']);
                                ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse<?=$katI?>">
                                            <h4 class="panel-title">
                                                <?= $rowKategori['nama_kategori'] ?>
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="collapse<?=$katI?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="panel-group" id="accordion<?=$katII?>">

                                                <!-- ========== -->
                                                <?php
                                                    $subI = 1;
                                                    while ($rowSub=mysqli_fetch_assoc($bKategoriSub)) {
                                                        $jnsProduk = $kueriMall->jnsProduk($rowSub['id_kategori_sub']);
                                                ?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <a data-toggle="collapse" data-parent="#accordion<?=$katII?>"
                                                            href="#collapse<?= $katI.$subI?>">
                                                            <h4 class="panel-title">
                                                                <?= $rowSub['nama_kategori_sub'] ?>
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div id="collapse<?= $katI.$subI?>" class="panel-collapse collapse in">
                                                        <div class="panel-body">
                                                            <!-- =============== -->
                                                            <?php
                                                                while ($rowJnsP = mysqli_fetch_assoc($jnsProduk)) {
                                                            ?>
                                                            <a class="jenis-produk" href="form-input-produk?it=<?= $_GET['it']?>&kt=<?= $rowJnsP['id_jenis_produk']?>"><?= $rowJnsP['nama_jenis_produk'] ?></a><br>
                                                            <?php
                                                                }
                                                            ?>
                                                            <!-- ================== -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                        $subI++;
                                                    }
                                                ?>
                                                <!-- ================ -->
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- =================================== -->
                                <?php
                                    $katI++;
                                    }
                                ?>

                            </div>


                            <!-- <button type="submit" class="btn btn-daftar mb-5" name="masukkan_kategori">Lanjut</button> -->
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