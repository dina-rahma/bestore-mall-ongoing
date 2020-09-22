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
    <link rel="stylesheet" href="assets/css/account.css">
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
            <div class="container-fluid d-account">
                <div class="row justify-content-center nav-top sticky-top">
                    <div class="col-10 div-nav">
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
                                <h5>Akun Saya</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-end">
                    <div class="col-12 top-img">
                        <div class="row r-nav align-items-end">
                            <div class="col-6 top-nav active text-center"><a href="account">Akun</a></div>
                            <div class="col-6 top-nav text-center"><a href="my-web">Akun Toko</a></div>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-10 profil-status">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <div class="frame-img">
                                    <img src="assets/img/patner/dummy-profil.png" width="100%" alt="img-user">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row align-items-center">
                                    <div class="col-6 d-user">
                                        <span class="id-status"><?= $rowDiri['kode_paket'].$rowDiri['id_patner']?></span><br>
                                        <span class="ket">ID</span><br>
                                        <span class="id-status"><?= $rowDiri['nama_paket']?></span><br>
                                        <span class="ket">Class</span>
                                    </div>
                                    <div class="col-6">
                                        <img src="assets/img/status-user/<?= $rowDiri['icon-status'] ?>" width="100%" alt="icon-user">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row data-diri justify-content-center">
                    <div class="col-11">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <h5>Name</h5>
                                    </div>
                                    <div class="col-8">
                                        <h6><?= $rowDiri['nama_patner']?></h6>
                                    </div>
                                    <div class="col-4">
                                        <h5>Phone</h5>
                                    </div>
                                    <div class="col-8">
                                        <h6><?= $rowDiri['no_hp']?></h6>
                                    </div>
                                    <div class="col-4">
                                        <h5>E-Mail</h5>
                                    </div>
                                    <div class="col-8">
                                        <h6><?= $rowDiri['email_patner']?></h6>
                                    </div>
                                    <div class="col-4">
                                        <h5>Bank</h5>
                                    </div>
                                    <div class="col-8">
                                        <h6><?= $rowDiri['jns_bank'] ?></h6>
                                    </div>
                                    <div class="col-4">
                                        <h5>No. Rekening</h5>
                                    </div>
                                    <div class="col-8">
                                        <h6><?= $rowDiri['no_rek'] ?></h6>
                                    </div>
                                    <div class="col-6">
                                        <h5>Rekening Name</h5>
                                    </div>
                                    <div class="col-6">
                                        <h6><?= $rowDiri['an'] ?></h6>
                                    </div>
                                    <div class="col-4">
                                        <h5>Address</h5>
                                    </div>
                                    <div class="col-8">
                                        <h6><?= $rowDiri['alamat']?></h6>
                                    </div>
                                    <div class="col-8 mt-3">
                                        <a href="form-edit-akun" class="btn btn-edit">Edit Profil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <!-- Begin:Script Slide -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- End:Script Slide -->
    <!-- Initialize Swiper -->

    <!-- CartPlus Minus -->
    <script src="assets/js/cart-plus-minus.js"></script>
    <!-- CartPlus Minus -->

    <script type="module">
        import Swiper from 'https://unpkg.com/swiper/swiper-bundle.esm.browser.min.js'


        //Slide lainnnya
        var swiper = new Swiper('.container-product', {
            slidesPerView: 'auto',
            // centeredSlides: true,
            freeMode: true,
            spaceBetween: 5,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        // Layar Ketika Di Scroll, Untuk Search
        $(window).on("scroll", function () {
                if ($(window).scrollTop() > 30) {
                    $(".nav-top").addClass("active");
                } else {
                    $(".nav-top").removeClass("active");
                }
        });

        //Untuk Sidebar 
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });
            $('#delete-1').on('click', function () {
                $('.produk-toko1').addClass('hide');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
    <!-- Initialize Swiper -->
    <!-- Untuk Kembali Kehalaman Sebelumnya -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <!-- Untuk Kembali Kehalaman Sebelumnya -->
    <!-- CheckBox -->
    <script>
        function checkAll(bx) {
            var cbs = $(bx).closest('.list-belanja').find('input:checkbox');
            for (var i = 0; i < cbs.length; i++) {
                if (cbs[i].type == 'checkbox') {
                    cbs[i].checked = bx.checked;
                }
            }
        }
    </script>
    <!-- CheckBox -->
</body>

</html>