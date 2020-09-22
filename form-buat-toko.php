<?php
    require 'kueri-mall.php';
    $kueriMall = new kueriMall();

    session_start();
    if (!isset($_SESSION['id_patner'])) { //Cek Session Patner
        header('Location:login');
    }

    // ===============================
    // Daftar Toko
    if (isset($_POST['daftar_toko'])) {
        // Cek data Toko, ada atau tidak
        $bTokoCek = $kueriMall->bTokoCek($_SESSION['id_patner'], $_POST['nama_toko'], $_POST['sub_domain']);
        if ($bTokoCek == "Aman") {
            $iToko = $kueriMall->iToko($_SESSION['id_patner'], $_POST['nama_toko'], $_POST['sub_domain']);
            if ($iToko == "Berhasil") {
                $filename="toko-patner/".strtolower($_POST['sub_domain'])."/";
                // Create Folder Toko Patner
                mkdir($filename);
                mkdir($filename."img");
                mkdir($filename."template");

                // Copy File
                copy("toko-patner/template/head.php", "toko-patner/".$_POST['sub_domain']."/template/head.php");
                copy("toko-patner/template/body.php", "toko-patner/".$_POST['sub_domain']."/template/body.php");
                copy("toko-patner/template/footer.php", "toko-patner/".$_POST['sub_domain']."/template/footer.php");
                // End Copy File=========
                $myfile = fopen($filename."index.php", "w");
                $txt = "<?php 
                    \$id_patner = ".$_SESSION['id_patner'].";
                ?>
                <base href='../../'>
                <?php
                require 'template/head.php';
                require 'template/body.php';
                require 'template/footer.php'; 
                ?>\n";
                fwrite($myfile, $txt);
                fclose($myfile);
                // End=========
                echo "<script>alert('Toko Berhasil Di Daftarkan');window.location='https://bestoremall.com/create-folder.php?sd=".$_POST['sub_domain']."&id=".$_SESSION['id_patner']."';</script>";
            }else{
                echo "<script>alert('Toko Gagal Di Daftarkan')</script>";
            }
        }elseif ($bTokoCek == "Patner Terdaftar") {
            echo "<script>alert('Anda Sudah Terdaftar!');window.location='my-web';</script>";
        }elseif ($bTokoCek == "Nama Terdaftar") {
            echo "<script>alert('Nama Toko Sudah Terdaftar!')</script>";
        }elseif ($bTokoCek == "Sub Domain Terdaftar") {
            echo "<script>alert('Sub Domain Sudah Terdaftar!')</script>";
        }else{
            echo "<script>alert('Terjadi Kesalahan')</script>";
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
                                <h5>Buat Toko</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center form-daftar">
                    <div class="col-11">
                        <form action="" method="post">
                            <div class="form-group">
                              <label for="formGroupExampleInput">Nama Toko Online</label>
                              <input type="text" name="nama_toko" class="form-control" id="formGroupExampleInput" placeholder="Mamat Furniture">
                              <small>*Pilihlah nama yang menarik dan mudah diingat pembeli</small>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Nama Sub Domain</label>
                                <input type="text" name="sub_domain" class="form-control" id="sub-domain" placeholder="mamat-furniture">
                                <small>*ini akan menjadi link toko online anda</small>
                            </div>
                            <button type="submit" class="btn btn-daftar" name="daftar_toko">Lanjut</button>
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

    <!-- script Support -->
    <script>
        $("#sub-domain").on({
            keydown: function(e) {
            if (e.which === 32)
                return false;
        },
        keyup: function(){
            this.value = this.value.toLowerCase();
        },
        change: function() {
            this.value = this.value.replace(/\s/g, "");
            
        }
        });
    </script>
    <!-- script Support -->

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