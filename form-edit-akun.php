<?php
    require 'kueri-mall.php';
    require 'kueri-main.php';
    $kueriMall = new kueriMall();
    $kueriMain = new kueri();

    session_start();
    if (!isset($_SESSION['id_patner'])) { //Cek Session Patner
        header('Location:login');
    }
    
    // ===================
    // Data Diri
    $bDiri = $kueriMain->bDiri($_SESSION['id_patner']); 
    $rowDiri = mysqli_fetch_assoc($bDiri);
    // ===================

    if (isset($_POST['edit_akun'])) {
        $eAkun = $kueriMain->eAkun($_SESSION['id_patner'], $_POST['nama_patner'], $_POST['no_hp'], $_POST['bank'], $_POST['no_rek'], $_POST['an'],$_POST['alamat']);
        if ($eAkun == "Berhasil") {
            echo "<script>alert('Berhasil Edit Akun'); window.location='account'</script>";
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
                                <h5>Edit Akun</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center form-daftar">
                    <div class="col-11">
                        <form action="" method="post">
                            <div class="form-group">
                              <label for="formGroupExampleInput">Nama Patner</label>
                              <input type="text" name="nama_patner" class="form-control" id="formGroupExampleInput" value="<?= $rowDiri['nama_patner'] ?>" required="" placeholder="Mamat Hariyadi">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Telepon</label>
                                <input type="text" name="no_hp" class="form-control" id="formGroupExampleInput2" value="<?= $rowDiri['no_hp'] ?>" required="" placeholder="08xxx">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Email</label>
                                <input type="text" name="email_patner" class="form-control" id="formGroupExampleInput2" value="<?= $rowDiri['email_patner'] ?>" required="" placeholder="mamat@gmail.com" disabled>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Bank</label>
                                <input type="text" name="bank" class="form-control" id="formGroupExampleInput2" value="<?= $rowDiri['jns_bank'] ?>" required="" placeholder="BCA">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">No. Rekening</label>
                                <input type="text" name="no_rek" class="form-control" id="formGroupExampleInput2" value="<?= $rowDiri['no_rek'] ?>" required="" placeholder="xxxx xxxx xxxx">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Rekening Atas Nama</label>
                                <input type="text" name="an" class="form-control" id="formGroupExampleInput2" value="<?= $rowDiri['an'] ?>" required="" placeholder="Mamat Hidayat">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="formGroupExampleInput2" value="<?= $rowDiri['alamat'] ?>" required="" placeholder="Jln. Kenangan">
                            </div>
                            <button type="submit" class="btn btn-daftar mt-3 mb-5" name="edit_akun">Edit</button>
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