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


    $bProdukD = $kueriMall->bProdukD($_GET['i']); //Baca Detail Product //File di kueri-mall.php
    $rowDp = mysqli_fetch_assoc($bProdukD); //Array bProdukD
    
    $bProdukID = $kueriMall->bProdukID($rowDp['id_produk']); //Baca Detail Img Product //File di kueri-mall.php
    $bProdukVD = $kueriMall->bProdukVD($rowDp['id_produk']); //Baca Detail Video Product //File di kueri-mall.php
    $rowDv = mysqli_fetch_assoc($bProdukVD);

    if (isset($_POST['checkout'])) {
        //Cek Produk sudah ada di keranjang atau belum
        $bKeranjang = $kueriMall->bKProduk($rowDp['id_produk']);
        if ($bKeranjang < 1) {
            $qty=1;
            $iKeranjang = $kueriMall->iKeranjang($rowDp['id_produk'],$_SESSION['id_patner'], $qty); //Input Data Keranjang
            if ($iKeranjang == "Berhasil") {
                echo "<script>alert('Berhasil, Siap Checkout');window.location='keranjang';</script>";
            }else{
                echo "<script>alert('Gagal')</script>";
            }
        }else{
            echo "<script>alert('Barang Sudah DiKeranjang');window.location='keranjang';</script>";
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
    <link rel="stylesheet" href="assets/css/detail-product.css">
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
        <nav id="sidebar">
            <div class="logo">
                <img src="assets/img/svg/logo-bestore/Bestore-Logo-full.svg" width="40%" alt="Logo-Bestore">
            </div>
            <div id="dismiss">
                <img src="assets/img/svg/icon/next.svg" width="20px" alt="Dismis">
            </div>

            <div class="sidebar-header mt-4">
                <div class="profil-img">
                    <div class="frame-img">
                        <div class="img-user">
                            <img src="assets/img/patner/dummy-profil.png" width="100%" alt="Photo User">
                        </div>
                    </div>
                </div>
                <div class="status-user text-center">
                    <p><?= $rowDiri['nama_paket'] ?></p>
                </div>
            </div>
            <div class="data-user">
                <div class="row justify-content-between align-items-center">
                    <div class="col-7" style="padding: 0px; line-height: 1px;">
                        <h6><?= $rowDiri['nama_patner'] ?></h6>
                        <h6><?= $rowDiri['kode_paket'].$rowDiri['id_patner']?></h6>
                    </div>
                    <div class="col-5" style="padding: 0px;">
                        <img src="assets/img/status-user/<?= $rowDiri['icon-status'] ?>" width="100%" alt="Icon Class">
                    </div>
                </div>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="account">
                        Account
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.3800in" height="0.3800in"
                            viewBox="0 0 500 500">
                            <g id="Group_1698" data-name="Group 1698" transform="translate(-1883 -3920)">
                                <rect id="Rectangle_693" data-name="Rectangle 693" width="500" height="500"
                                    transform="translate(1883 3920)" fill="none" />
                                <g id="account" transform="translate(1947.856 3990.012)">
                                    <path id="Path_230" data-name="Path 230"
                                        d="M359.988,179.994A179.994,179.994,0,0,0,0,179.994c0,98.6,79.829,179.994,179.994,179.994C279.747,359.988,359.988,279.046,359.988,179.994ZM179.994,21.093c87.618,0,158.9,71.283,158.9,158.9a158.168,158.168,0,0,1-27.212,88.954c-70.992-76.363-192.257-76.5-263.378,0a158.167,158.167,0,0,1-27.212-88.954c0-87.618,71.283-158.9,158.9-158.9ZM61.461,285.811c63.12-70.8,173.963-70.783,237.063,0A158.749,158.749,0,0,1,61.461,285.811Zm0,0"
                                        transform="translate(0)" fill="#426a5a" />
                                    <path id="Path_231" data-name="Path 231"
                                        d="M245,245.34a79.093,79.093,0,0,0,79-79V140A79,79,0,1,0,166,140v26.334A79.094,79.094,0,0,0,245,245.34ZM192.334,140a52.669,52.669,0,1,1,105.337,0v26.334a52.669,52.669,0,1,1-105.337,0Zm0,0"
                                        transform="translate(-65.009 -7.454)" fill="#426a5a" />
                                </g>
                            </g>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="official-produk">
                        Official Product
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.3800in" height="0.3800in"
                            viewBox="0 0 500 500">
                            <g id="Group_1699" data-name="Group 1699" transform="translate(-2557 -3920)">
                                <rect id="Rectangle_694" data-name="Rectangle 694" width="500" height="500"
                                    transform="translate(2557 3920)" fill="none" />
                                <g id="Group_1695" data-name="Group 1695" transform="translate(2627.622 3990.012)">
                                    <g id="Send_package" data-name="Send package" transform="translate(0 0)">
                                        <path id="Path_232" data-name="Path 232"
                                            d="M354.459,54h-42V48a6,6,0,0,0-6-6h-48a6,6,0,0,0-6,6V58.313L214.929,48.93a18.071,18.071,0,0,0-9,.078L110.389,74.6a23.783,23.783,0,0,0-13.553,9.774L38.32,50.6a24.011,24.011,0,1,0-24,41.6l106.358,61.4a18,18,0,0,0,9,2.4H231.632a18.084,18.084,0,0,0,8.046-1.9l12.785-6.4V156a6,6,0,0,0,6,6h48a6,6,0,0,0,6-6v-6h42a6,6,0,0,0,6-6V60A6,6,0,0,0,354.459,54ZM234.314,143.4a6.1,6.1,0,0,1-2.682.6H129.684a6,6,0,0,1-3-.8L20.345,81.808A12.041,12.041,0,0,1,16,65.4a12.2,12.2,0,0,1,16.331-4.386L92.774,95.908a23.891,23.891,0,0,0,30.041,25.073l71.547-19.169a6,6,0,1,0-3.1-11.592l-71.553,19.2A12,12,0,1,1,113.5,86.24L209.025,60.6a6,6,0,0,1,3,0l40.438,10.086v63.6Zm66.147,6.6h-36V54h36Zm48-12h-36V66h36Z"
                                            transform="translate(-2.305 197.99)" fill="#426a5a" />
                                        <path id="Path_233" data-name="Path 233"
                                            d="M231.391,53.316l-24-48A6,6,0,0,0,201.992,2H34a6,6,0,0,0-5.37,3.318l-24,48A10.679,10.679,0,0,0,4,56V223.991a6,6,0,0,0,6,6H225.991a6,6,0,0,0,6-6V56A10.682,10.682,0,0,0,231.391,53.316ZM216.283,50H146.674l-9-36h60.6ZM100,62h36v56.29l-15.317-7.662a6,6,0,0,0-5.364,0L100,118.287Zm25.313-48,9,36H101.682l9-36Zm-87.6,0H98.3l-9,36h-69.6ZM219.991,217.991H16V62H88v66a6,6,0,0,0,8.682,5.37L118,122.7l21.317,10.692a6,6,0,0,0,8.682-5.4V62h72Z"
                                            transform="translate(6.168 -2)" fill="#426a5a" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#">
                        Insight 
                        <svg fill="#46715E" width="0.3200in" height="0.3200in" id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m495 497v-159.061h-15v159.061h-45v-342.747h45v168.686h15v-183.686h-75v357.747h-45.401l.414-233.634h-75l-.414 233.634h-44.599v-297.488h-75v201.162h15v-186.162h45v282.488h-45v-81.325h-15v81.325h-45v-158.14h-75v158.14h-45v-467h-15v482h512v-15zm-180.014-218.635h45l-.387 218.635h-45zm-239.986 75.495h45v143.14h-45z"/><path d="m0 0h15v15h-15z"/><path d="m97.5 293.842c9.603 0 19.206-3.655 26.517-10.965 14.621-14.622 14.621-38.412 0-53.033-.566-.566-1.15-1.102-1.743-1.625l64.884-89.171c1.14 1.568 2.413 3.068 3.825 4.481 7.311 7.311 16.914 10.965 26.517 10.965s19.206-3.655 26.517-10.965c2.762-2.762 5.001-5.852 6.719-9.145l49.785 40.4c-1.878 11.513 1.603 23.739 10.463 32.599 7.311 7.311 16.914 10.966 26.517 10.966s19.206-3.655 26.517-10.966c12.848-12.848 14.402-32.774 4.67-47.34l68.285-71.905c6.21 4.064 13.368 6.099 20.528 6.099 9.603 0 19.207-3.655 26.517-10.965 14.621-14.622 14.621-38.412 0-53.033-14.623-14.622-38.413-14.621-53.033 0-12.848 12.848-14.401 32.775-4.67 47.34l-68.285 71.905c-14.538-9.515-34.284-7.895-47.045 4.867-1.797 1.797-3.37 3.734-4.725 5.773l-51.311-41.638c.393-10.088-3.247-20.304-10.931-27.989-14.621-14.621-38.411-14.622-53.033 0-8.772 8.773-12.274 20.846-10.52 32.259l-71.295 97.982c-13.001-4.234-27.872-1.206-38.184 9.107-14.621 14.621-14.621 38.412 0 53.033 7.308 7.309 16.911 10.964 26.514 10.964zm344.089-252.998c4.387-4.387 10.147-6.58 15.91-6.58 5.761 0 11.524 2.194 15.91 6.58 8.772 8.773 8.772 23.047 0 31.82s-23.048 8.772-31.82 0c-8.773-8.773-8.773-23.047 0-31.82zm-120 124.111c8.771-8.772 23.047-8.773 31.82 0 8.772 8.773 8.772 23.047 0 31.82-8.773 8.773-23.048 8.772-31.82 0s-8.772-23.047 0-31.82zm-120-63.853c8.773-8.772 23.048-8.772 31.82 0 8.773 8.773 8.773 23.047 0 31.82-8.773 8.772-23.047 8.772-31.82 0-8.772-8.773-8.772-23.047 0-31.82zm-119.999 139.348c4.387-4.387 10.147-6.58 15.91-6.58 5.761 0 11.524 2.194 15.91 6.58 8.772 8.772 8.772 23.047 0 31.82-8.773 8.772-23.048 8.772-31.82 0-8.773-8.773-8.773-23.047 0-31.82z"/><path d="m89.999 467.014h15v15h-15z"/><path d="m449.999 237.229h15v15h-15z"/><path d="m449.999 177.229h15v45h-15z"/><path d="m210 236.999h15v45h-15z"/><path d="m210 296.999h15v15h-15z"/><path d="m330 429.514h15v45h-15z"/><path d="m330 399.513h15v15h-15z"/></g></svg>
                    </a>
                </li>
                <li>
                    <a href="my-web">
                        My WEB
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.3800in" height="0.3800in"
                            viewBox="0 0 500 500">
                            <g id="Group_1703" data-name="Group 1703" transform="translate(-1883 -4527)">
                                <rect id="Rectangle_697" data-name="Rectangle 697" width="500" height="500"
                                    transform="translate(1883 4527)" fill="none" />
                                <g id="ecommerce" transform="translate(1947.856 4633.112)">
                                    <g id="Group_73" data-name="Group 73" transform="translate(0 0)">
                                        <g id="Group_72" data-name="Group 72" transform="translate(0 0)">
                                            <path id="Path_249" data-name="Path 249"
                                                d="M0,57.35V307.857H131.915a41.382,41.382,0,0,0-12.085,23.879H77.606v11.939H292.441V331.735H250.216a41.382,41.382,0,0,0-12.085-23.879h131.7V57.35ZM131.842,331.735a29.887,29.887,0,0,1,29.193-23.879H208.72a29.847,29.847,0,0,1,29.266,23.879Zm226.046-35.818H11.939V260.1H357.889Zm0-47.757H11.939V69.216H357.889Z"
                                                transform="translate(0 -57.35)" fill="#426a5a" />
                                        </g>
                                    </g>
                                    <g id="Group_75" data-name="Group 75" transform="translate(178.944 214.689)">
                                        <g id="Group_74" data-name="Group 74" transform="translate(0 0)">
                                            <rect id="Rectangle_51" data-name="Rectangle 51" width="11.939"
                                                height="11.939" fill="#426a5a" />
                                        </g>
                                    </g>
                                    <g id="Group_77" data-name="Group 77" transform="translate(202.823 214.689)">
                                        <g id="Group_76" data-name="Group 76" transform="translate(0 0)">
                                            <rect id="Rectangle_52" data-name="Rectangle 52" width="11.939"
                                                height="11.939" fill="#426a5a" />
                                        </g>
                                    </g>
                                    <g id="Group_79" data-name="Group 79" transform="translate(155.066 214.689)">
                                        <g id="Group_78" data-name="Group 78" transform="translate(0 0)">
                                            <rect id="Rectangle_53" data-name="Rectangle 53" width="11.939"
                                                height="11.939" fill="#426a5a" />
                                        </g>
                                    </g>
                                    <g id="Group_81" data-name="Group 81" transform="translate(29.848 35.672)">
                                        <g id="Group_80" data-name="Group 80">
                                            <path id="Path_250" data-name="Path 250"
                                                d="M79.512,189.852h73.383L168.256,136.2H69.392L63.787,106.35H41v11.939H53.959L57.307,136.2l10.047,53.654,4.441,23.879h3.64a17.909,17.909,0,1,0,26.5,0h27.228a17.909,17.909,0,1,0,26.5,0h7.644V201.792H81.769Zm-7.863-41.715h80.736l-8.518,29.848H77.255ZM142.411,219.7a5.97,5.97,0,1,1-5.97,5.97A6,6,0,0,1,142.411,219.7Zm-53.727,0a5.97,5.97,0,1,1-5.97,5.97A6,6,0,0,1,88.685,219.7Z"
                                                transform="translate(-41 -106.35)" fill="#426a5a" />
                                        </g>
                                    </g>
                                    <g id="Group_83" data-name="Group 83" transform="translate(208.793 29.703)">
                                        <g id="Group_82" data-name="Group 82" transform="translate(0 0)">
                                            <path id="Path_251" data-name="Path 251"
                                                d="M286.8,98.15v83.5H417.987V98.15Zm119.32,71.636H298.739V133.968H406.12Zm0-47.757H298.739V110.09H406.12Z"
                                                transform="translate(-286.8 -98.15)" fill="#426a5a" />
                                        </g>
                                    </g>
                                    <g id="Group_85" data-name="Group 85" transform="translate(232.598 83.429)">
                                        <g id="Group_84" data-name="Group 84" transform="translate(0 0)">
                                            <rect id="Rectangle_54" data-name="Rectangle 54" width="11.939"
                                                height="11.939" fill="#426a5a" />
                                        </g>
                                    </g>
                                    <g id="Group_87" data-name="Group 87" transform="translate(256.477 83.429)">
                                        <g id="Group_86" data-name="Group 86" transform="translate(0 0)">
                                            <rect id="Rectangle_55" data-name="Rectangle 55" width="11.939"
                                                height="11.939" fill="#426a5a" />
                                        </g>
                                    </g>
                                    <g id="Group_89" data-name="Group 89" transform="translate(280.356 83.429)">
                                        <g id="Group_88" data-name="Group 88" transform="translate(0 0)">
                                            <rect id="Rectangle_56" data-name="Rectangle 56" width="11.939"
                                                height="11.939" fill="#426a5a" />
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>

                    </a>
                </li>
                <li>
                    <a href="#">
                        Earning Bonus
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.3800in" height="0.3800in"
                            viewBox="0 0 500 500">
                            <g id="Group_1702" data-name="Group 1702" transform="translate(-2552 -4526)">
                                <rect id="Rectangle_696" data-name="Rectangle 696" width="500" height="500"
                                    transform="translate(2552 4526)" fill="none" />
                                <g id="Group_1696" data-name="Group 1696" transform="translate(2627.622 4572.068)">
                                    <g id="money" transform="translate(0)">
                                        <g id="Group_60" data-name="Group 60" transform="translate(186.023 104.488)">
                                            <g id="Group_59" data-name="Group 59">
                                                <path id="Path_243" data-name="Path 243"
                                                    d="M388.753,280.379V134.557c0-4.529-3.705-7.657-8.233-7.657H348.653c-4.528,0-8.481,3.129-8.481,7.657V266.135a76.879,76.879,0,0,0-15.644,2.058V177.539c0-4.529-3.87-7.823-8.4-7.823H284.264c-4.528,0-8.317,3.211-8.317,7.823V300.47a80.827,80.827,0,0,0-14.985,47.262,81.639,81.639,0,1,0,127.79-67.353ZM356.641,143.368h15.644V271.651a73.374,73.374,0,0,0-15.644-4.281Zm-64.225,42.816H308.06v87.691a83.852,83.852,0,0,0-15.644,9.387Zm106.3,194.731a65.14,65.14,0,1,1-80.939-93.372,7.832,7.832,0,0,0,2.717-1.071,63.9,63.9,0,0,1,22.231-3.952c1.729,0,3.375.082,5.106.247h.082a63.612,63.612,0,0,1,28,8.892A65.118,65.118,0,0,1,398.716,380.915Z"
                                                    transform="translate(-260.962 -126.9)" fill="#426a5a" />
                                            </g>
                                        </g>
                                        <g id="Group_62" data-name="Group 62" transform="translate(241.025 268.095)">
                                            <g id="Group_61" data-name="Group 61">
                                                <path id="Path_244" data-name="Path 244"
                                                    d="M354.524,376.156A10.416,10.416,0,1,1,364.816,365.7a8.259,8.259,0,0,0,8.234,8.235,8.346,8.346,0,0,0,8.4-8.235,26.892,26.892,0,0,0-17.044-25.03v-6.834a8.234,8.234,0,1,0-16.467,0v5.928a26.855,26.855,0,0,0-19.268,32.688,26.514,26.514,0,0,0,25.772,20.091,10.333,10.333,0,1,1-10.375,10.292,8.258,8.258,0,0,0-8.234-8.234,8,8,0,0,0-8.069,8.152v.082a26.96,26.96,0,0,0,20.091,25.937v3.7a8.234,8.234,0,1,0,16.467,0v-4.529a26.811,26.811,0,0,0-9.8-51.791Z"
                                                    transform="translate(-327.761 -325.6)" fill="#426a5a" />
                                            </g>
                                        </g>
                                        <g id="Group_64" data-name="Group 64" transform="translate(71.738 213.175)">
                                            <g id="Group_63" data-name="Group 63">
                                                <path id="Path_245" data-name="Path 245"
                                                    d="M162.509,258.9H130.4a8.258,8.258,0,0,0-8.234,8.234V396.406a8.258,8.258,0,0,0,8.234,8.234h32.112a8.259,8.259,0,0,0,8.234-8.234V267.134A8.258,8.258,0,0,0,162.509,258.9ZM154.275,389H138.631V275.368h15.645Z"
                                                    transform="translate(-122.163 -258.9)" fill="#426a5a" />
                                            </g>
                                        </g>
                                        <g id="Group_66" data-name="Group 66" transform="translate(136.785 194.237)">
                                            <g id="Group_65" data-name="Group 65">
                                                <path id="Path_246" data-name="Path 246"
                                                    d="M241.509,235.9H209.4a8.258,8.258,0,0,0-8.234,8.234V393.167A8.258,8.258,0,0,0,209.4,401.4h32.112a8.258,8.258,0,0,0,8.234-8.234V244.134A8.258,8.258,0,0,0,241.509,235.9Zm-8.234,149.033H217.631V252.368h15.645Z"
                                                    transform="translate(-201.163 -235.9)" fill="#426a5a" />
                                            </g>
                                        </g>
                                        <g id="Group_68" data-name="Group 68" transform="translate(6.69 283.986)">
                                            <g id="Group_67" data-name="Group 67">
                                                <path id="Path_247" data-name="Path 247"
                                                    d="M83.509,344.9H51.4a8.258,8.258,0,0,0-8.234,8.234v58.46a8.259,8.259,0,0,0,8.234,8.234H83.509a8.259,8.259,0,0,0,8.234-8.234v-58.46A8.258,8.258,0,0,0,83.509,344.9Zm-8.234,59.284H59.631V361.368H75.275Z"
                                                    transform="translate(-43.163 -344.9)" fill="#426a5a" />
                                            </g>
                                        </g>
                                        <g id="Group_70" data-name="Group 70" transform="translate(0)">
                                            <g id="Group_69" data-name="Group 69">
                                                <path id="Path_248" data-name="Path 248"
                                                    d="M347.617,0,291.3.082a8.234,8.234,0,1,0-.165,16.468h.165l36.476-.082-89.338,89.008L207.229,74.517a9.053,9.053,0,0,0-11.692,0L37.446,232.607a8.21,8.21,0,0,0,11.692,11.527L201.465,91.808l31.206,31.453a8.243,8.243,0,0,0,5.846,2.635,8.755,8.755,0,0,0,5.846-2.635l95.019-95.1L339.3,64.8a8.237,8.237,0,1,0,16.468,0l.082-56.484A8.329,8.329,0,0,0,347.617,0Z"
                                                    transform="translate(-35.038)" fill="#426a5a" />
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#">
                        My Patner
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.3800in" height="0.3800in"
                            viewBox="0 0 500 500">
                            <g id="Group_1701" data-name="Group 1701" transform="translate(-3341 -4527)">
                                <rect id="Rectangle_698" data-name="Rectangle 698" width="500" height="500"
                                    transform="translate(3341 4527)" fill="none" />
                                <g id="trust" transform="translate(3423.942 4609.998)">
                                    <path id="Path_254" data-name="Path 254"
                                        d="M313.819,127.745a37.466,37.466,0,0,0,20.82-33.692V65.575a37.716,37.716,0,0,0-35.371-37.6L286.477,15.185A48.1,48.1,0,0,0,252.236,1h-24.8a38.091,38.091,0,0,0-23.8,67.836L212.8,76.16a248.855,248.855,0,0,0-1.926,27.084v5.381h10.763v3.751a28.538,28.538,0,0,0,28.537,28.537h1.458c.77,0,1.528-.167,2.292-.226v19.491l-10,2a10.785,10.785,0,0,0-6.054,3.552l-6.463,7.539a107.424,107.424,0,0,0-16.3,25.76l-31.141,31.136V209.874a74.353,74.353,0,0,0-74.342-74.342h-1v-5.564a32.588,32.588,0,0,0,28.042-20.46,58.969,58.969,0,0,0,4.246-22.031v-21.9a26.661,26.661,0,0,0-2.244-10.693,41.655,41.655,0,0,0,13.007-30.13A23.756,23.756,0,0,0,127.923,1H84.6A51.4,51.4,0,0,0,47.9,16.45C38.75,25.6,33.288,39.939,33.288,54.813A45.681,45.681,0,0,0,49.566,89.834a31.119,31.119,0,0,0,9.051,19.448l1.577,1.571V135.6A60.725,60.725,0,0,0,1,196.345v46.812a59.1,59.1,0,0,0,21.525,45.628v45.854H151.676V302.351h14.46a48.113,48.113,0,0,0,34.246-14.185l5.112-5.112v51.585H334.645V199.321A47.654,47.654,0,0,0,308.3,156.707l-5.952-2.976V133.476ZM210.364,60.431a27.328,27.328,0,0,1,17.075-48.668h24.8a37.433,37.433,0,0,1,26.637,11.032l15.869,15.875h2.228a26.937,26.937,0,0,1,26.906,26.906V94.053A26.755,26.755,0,0,1,309,118.118l-10.741,5.37a29.244,29.244,0,0,1-5.473-11.069,42.544,42.544,0,0,1-1.066-6.3c4.057-2.933,10.628-9.186,10.628-19.023a21.547,21.547,0,0,0-21.525-21.525h-.732a20.961,20.961,0,0,0-6.587-10.015,45.375,45.375,0,0,0-30.35-11.511c-11.893,0-23.446,5.71-23.931,5.946l-2.357,1.179-.517,2.578c-.689,3.444-1.286,6.791-1.814,10.02Zm45.612,118.151h-7.458l.016-6.35,11.8-2.357Zm-5.9,61.637-6.748-12.146,4.612-38.729h7.049l7.69,34.6A101.607,101.607,0,0,1,250.073,240.219Zm20.3-31.238-5.4-24.318L273.7,167.2l9.966-1.991-9.31,32.578A103.444,103.444,0,0,1,270.371,208.981Zm-5.688-70.113,17.2-3.439-2.115-10.553-24.657,4.935a17.928,17.928,0,0,1-3.482.339H250.17A17.779,17.779,0,0,1,232.4,112.376V97.863H221.789a284.943,284.943,0,0,1,4.59-39.267c3.455-1.415,10.219-3.783,16.779-3.783a34.737,34.737,0,0,1,23.236,8.825c2.54,2.239,3.67,4.493,3.67,7.319v5.381h10.763A10.773,10.773,0,0,1,291.589,87.1c0,7.222-7.738,11.306-7.787,11.328l-2.976,1.491v3.326a49.712,49.712,0,0,0,1.507,11.72,40.235,40.235,0,0,0,9.256,17.328v20.352l-26.906,5.381Zm-26.906,43.7v1.076L234.4,212.01l-7.27-13.087A96.417,96.417,0,0,1,237.777,182.569Zm-64.575,27.3v31.055l-2.879,2.879a16.268,16.268,0,0,1-11.424,4.73h-7.222V216.251H140.913v32.288H97.863V233.46l34.2-83.071A63.571,63.571,0,0,1,173.2,209.874Zm-21.525,66.152a15.581,15.581,0,0,1-15.46,15.563h-6.065v.005H119.388V259.3h16.176C144.433,259.317,151.66,266.587,151.676,276.026ZM99.919,146.294l-5.381,10.763H85.045l-5.381-10.763Zm6.9,37.141-3.358-20.158L111.9,146.4a63.688,63.688,0,0,1,9.729,1.066ZM67.631,146.294l8.492,16.983-2.674,16.036-15.4-32.729c1.259-.1,2.5-.291,3.767-.291Zm18.646,21.525H93.3L99.047,202.3l-6.9,16.757L81.5,196.437Zm43.874-80.342a48.251,48.251,0,0,1-3.476,18.033,22.081,22.081,0,0,1-32.75,10.176L84.7,109.535l-5.968,8.954,9.224,6.151a32.789,32.789,0,0,0,9.9,4.38v6.511H70.951V106.4l-4.73-4.73A20.488,20.488,0,0,1,60.194,87.1a5.39,5.39,0,0,1,5.381-5.381h5.381V65.575A16.164,16.164,0,0,1,87.1,49.431h26.906a16.164,16.164,0,0,1,16.144,16.144ZM52.51,77.64A34.662,34.662,0,0,1,44.05,54.813c0-12.081,4.283-23.581,11.807-31.1A40.427,40.427,0,0,1,84.6,11.763h43.319a12.99,12.99,0,0,1,12.99,12.99,30.8,30.8,0,0,1-8.6,21.224,26.724,26.724,0,0,0-18.307-7.308H87.1A26.937,26.937,0,0,0,60.194,65.575v6.3A16.2,16.2,0,0,0,52.51,77.64ZM11.763,243.157V196.345a49.932,49.932,0,0,1,35.312-47.807L87.1,233.6v14.938H54.813V216.251H44.05v32.288A10.76,10.76,0,0,0,54.781,259.3h53.845v32.293l-48.432-.005A48.487,48.487,0,0,1,11.763,243.157Zm129.151,80.719H33.288V295.818a58.741,58.741,0,0,0,26.906,6.533l75.935.005h.005c.027,0,.054-.005.081-.005h4.7Zm51.854-43.319a37.424,37.424,0,0,1-26.637,11.032h-8.911a26.89,26.89,0,0,0-.334-32.288H158.9a27.125,27.125,0,0,0,19.039-7.884l29.871-29.871a106.956,106.956,0,0,0-2.319,21.762v24.528Zm23.484-37.249a96.8,96.8,0,0,1,5.484-31.932l20.25,36.447c-.737.624-1.431,1.286-2.19,1.894l-2.018,1.62v72.54H216.251Zm87.236-76.974a36.89,36.89,0,0,1,20.39,32.987V323.876H291.589v-86.1H280.827v86.1H248.539V256.47a112.725,112.725,0,0,0,36.168-55.723l10.832-37.911.678-.135Z"
                                        transform="translate(-1 -1)" fill="#426a5a" />
                                    <ellipse id="Ellipse_16" data-name="Ellipse 16" cx="4.5" rx="4.5"
                                        transform="translate(261.058 298.003)" fill="#426a5a" />
                                    <ellipse id="Ellipse_17" data-name="Ellipse 17" cx="4.5" rx="4.5"
                                        transform="translate(261.058 276.003)" fill="#426a5a" />
                                </g>
                            </g>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="logout">
                        Logout
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.3800in" height="0.3800in"
                            viewBox="0 0 500 500">
                            <g id="Group_1704" data-name="Group 1704" transform="translate(-1883 -5181)">
                                <rect id="Rectangle_700" data-name="Rectangle 700" width="500" height="500"
                                    transform="translate(1883 5181)" fill="none" />
                                <g id="Group_1697" data-name="Group 1697" transform="translate(1959.676 5256.68)">
                                    <g id="logout">
                                        <path id="Path_252" data-name="Path 252"
                                            d="M347.208,170.815,307.9,137.121a5.617,5.617,0,0,0-9.271,4.262v11.231H236.856V23.456a5.614,5.614,0,0,0-5.616-5.616H180.7V6.609a5.6,5.6,0,0,0-2.055-4.341,5.666,5.666,0,0,0-4.661-1.162L5.515,34.8A5.606,5.606,0,0,0,1,40.3V304.236a5.616,5.616,0,0,0,4.341,5.47l168.468,39.309a5.765,5.765,0,0,0,1.275.146,5.616,5.616,0,0,0,5.616-5.616V332.314h50.54a5.614,5.614,0,0,0,5.616-5.616V197.54h61.772v11.231a5.615,5.615,0,0,0,9.271,4.262l39.309-33.694a5.615,5.615,0,0,0,0-8.524ZM169.468,336.469,12.231,299.777V44.9L169.468,13.455Zm56.156-15.387H180.7V29.072h44.925V152.615H197.547a5.614,5.614,0,0,0-5.616,5.616v33.694a5.614,5.614,0,0,0,5.616,5.616h28.078Zm84.234-124.52v-4.638a5.614,5.614,0,0,0-5.616-5.616H203.162V163.846H304.243a5.614,5.614,0,0,0,5.616-5.616v-4.638l25.063,21.485Z"
                                            transform="translate(-1 -1.001)" fill="#426a5a" />
                                        <path id="Path_253" data-name="Path 253"
                                            d="M39.847,72.925c9.445,0,16.847-9.867,16.847-22.462S49.292,28,39.847,28,23,37.867,23,50.462,30.4,72.925,39.847,72.925Zm0-33.694c2.291,0,5.616,4.374,5.616,11.231s-3.324,11.231-5.616,11.231-5.616-4.374-5.616-11.231S37.556,39.231,39.847,39.231Z"
                                            transform="translate(100.544 123.613)" fill="#426a5a" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <div class="container d-detail-product">
                <div class="row mb-4 justify-content-center nav-top sticky-top">
                    <div class="col-11 div-nav">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <button class="btn btn-back" onclick="goBack()">
                                    <svg width="0.2400in" height="0.4400in" id="Capa_1"
                                        enable-background="new 0 0 482.239 482.239" height="512"
                                        viewBox="0 0 482.239 482.239" width="512" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m206.812 34.446-206.812 206.673 206.743 206.674 24.353-24.284-165.167-165.167h416.31v-34.445h-416.31l165.236-165.236z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="col-7 search">
                                <!-- Begin:Search -->
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari Produk"
                                                aria-label="" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="input-group-text" id="basic-addon2">
                                                    <svg width="0.1400in" height="0.2200in" version="1.1" id="Capa_1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        viewBox="0 0 512.005 512.005"
                                                        style="enable-background:new 0 0 512.005 512.005;"
                                                        xml:space="preserve">
                                                        <g>
                                                            <g>
                                                                <path
                                                                    d="M505.749,475.587l-145.6-145.6c28.203-34.837,45.184-79.104,45.184-127.317c0-111.744-90.923-202.667-202.667-202.667
                                               S0,90.925,0,202.669s90.923,202.667,202.667,202.667c48.213,0,92.48-16.981,127.317-45.184l145.6,145.6
                                               c4.16,4.16,9.621,6.251,15.083,6.251s10.923-2.091,15.083-6.251C514.091,497.411,514.091,483.928,505.749,475.587z
                                                M202.667,362.669c-88.235,0-160-71.765-160-160s71.765-160,160-160s160,71.765,160,160S290.901,362.669,202.667,362.669z" />
                                                            </g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End:Search -->
                            </div>
                            <div class="col-3 text-center head-right">
                                <a href="#" class="notif">
                                    <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                        xml:space="preserve">
                                        <g>
                                            <g>
                                                <path
                                                    d="M255.998,100c-5.52,0-10,4.48-10,10s4.48,10,10,10c5.52,0,10-4.48,10-10S261.518,100,255.998,100z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M433.134,427.796l-30.629-51.049c-10.836-18.07-16.506-48.695-16.506-69.607V190c0-60.648-41.747-111.724-98.012-126.013
                                                        c5.028-6.688,8.012-14.995,8.012-23.987c0-22.056-17.944-40-40-40c-22.056,0-40,17.944-40,40c0,8.992,2.984,17.299,8.012,23.987
                                                        C167.745,78.276,125.998,129.352,125.998,190v117.14c0,20.912-5.67,51.537-16.503,69.603l-30.629,51.049
                                                        C69.824,442.843,80.648,462,98.229,462h98.619c4.777,28.339,29.475,50,59.151,50c29.676,0,54.374-21.661,59.151-50h98.619
                                                        C431.327,462,442.186,442.863,433.134,427.796z M255.998,20c11.028,0,20,8.972,20,20s-8.972,20-20,20c-11.028,0-20-8.972-20-20
                                                        S244.97,20,255.998,20z M145.998,307.14V190c0-60.654,49.346-110,110-110c60.654,0,110,49.346,110,110v117.14
                                                        c0,21.267,5.212,52.715,16.573,74.86H129.425C140.785,359.858,145.998,328.408,145.998,307.14z M255.998,492
                                                        c-18.604,0-34.282-12.867-38.734-30.1h77.468C290.281,479.133,274.602,492,255.998,492z M413.768,442H98.229
                                                        c-2.031,0-3.26-2.174-2.215-3.915L117.664,402h276.668l21.653,36.09C417.028,439.825,415.8,442,413.768,442z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M299.585,111.278c-4.825-2.685-10.915-0.942-13.599,3.885c-2.681,4.828-0.942,10.916,3.886,13.599
                                                        c22.283,12.378,36.126,35.844,36.126,61.238c0,5.522,4.478,10,10,10c5.522,0,10-4.478,10-10
                                                        C345.998,157.347,328.214,127.182,299.585,111.278z" />
                                            </g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                    </svg>
                                </a>
                                <button class="btn btn-bar" type="button" id="sidebarCollapse">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars"
                                        class="svg-inline--fa fa-bars fa-w-14" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="0.1200in"
                                        height="0.3200in">
                                        <path fill="currentColor"
                                            d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                    <a href="#" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15.285" height="16.77" viewBox="0 0 15.285 16.77">
                            <g id="Group_1760" data-name="Group 1760" transform="translate(-369.399 -115.418)">
                                <g id="pencil" transform="translate(369.399 115.418)">
                                <g id="Group_1759" data-name="Group 1759" transform="translate(0 0)">
                                    <path id="Path_2171" data-name="Path 2171" d="M14.878,2.483,12.793.4a1.421,1.421,0,0,0-1.966,0L1.49,9.827a.35.35,0,0,0-.088.149L.013,14.844a.348.348,0,0,0,.43.43l4.863-1.391a.349.349,0,0,0,.149-.088l9.423-9.346a1.391,1.391,0,0,0,0-1.967Zm-5.564.442L10.592,4.2,3.916,10.88l-.479-.959a.348.348,0,0,0-.311-.192H2.57ZM.853,14.434l.452-1.584,1.131,1.131Zm4.01-1.146L3.2,13.763,1.524,12.086,2,10.424h.913l.6,1.2a.348.348,0,0,0,.155.155l1.2.6v.913Zm.695-.571v-.556a.348.348,0,0,0-.192-.311l-.959-.479,6.676-6.676,1.279,1.279Zm8.83-8.751L12.856,5.484,9.8,2.431,11.32.9A.711.711,0,0,1,12.3.9l2.084,2.084a.695.695,0,0,1,0,.981Z" transform="translate(0 -0.002)" fill="#f9c032"/>
                                </g>
                                </g>
                                <rect id="Rectangle_758" data-name="Rectangle 758" width="14" height="1" rx="0.5" transform="translate(369.435 131.188)" fill="#f9c032"/>
                            </g>
                        </svg>
                        <span>Edit Thumbnail</span>
                    </a>
                    </div>
                    <div class="col-6">
                    <a href="#" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15.285" height="16.77" viewBox="0 0 15.285 16.77">
                            <g id="Group_1760" data-name="Group 1760" transform="translate(-369.399 -115.418)">
                                <g id="pencil" transform="translate(369.399 115.418)">
                                <g id="Group_1759" data-name="Group 1759" transform="translate(0 0)">
                                    <path id="Path_2171" data-name="Path 2171" d="M14.878,2.483,12.793.4a1.421,1.421,0,0,0-1.966,0L1.49,9.827a.35.35,0,0,0-.088.149L.013,14.844a.348.348,0,0,0,.43.43l4.863-1.391a.349.349,0,0,0,.149-.088l9.423-9.346a1.391,1.391,0,0,0,0-1.967Zm-5.564.442L10.592,4.2,3.916,10.88l-.479-.959a.348.348,0,0,0-.311-.192H2.57ZM.853,14.434l.452-1.584,1.131,1.131Zm4.01-1.146L3.2,13.763,1.524,12.086,2,10.424h.913l.6,1.2a.348.348,0,0,0,.155.155l1.2.6v.913Zm.695-.571v-.556a.348.348,0,0,0-.192-.311l-.959-.479,6.676-6.676,1.279,1.279Zm8.83-8.751L12.856,5.484,9.8,2.431,11.32.9A.711.711,0,0,1,12.3.9l2.084,2.084a.695.695,0,0,1,0,.981Z" transform="translate(0 -0.002)" fill="#f9c032"/>
                                </g>
                                </g>
                                <rect id="Rectangle_758" data-name="Rectangle 758" width="14" height="1" rx="0.5" transform="translate(369.435 131.188)" fill="#f9c032"/>
                            </g>
                        </svg>
                        <span>Edit Foto Produk</span>
                    </a>
                    </div>
                </div>
                <div class="row gallery-product">
                    <div class="swiper-container gallery-top mb-1">
                        <div class="swiper-wrapper">
                            <!-- Begin::Video Product -->
                            <div class="swiper-slide">
                                <div class="frame-img pristine" id="frame">
                                    <img src="assets/img/product/<?=$rowDv['nama_folder']?>/<?=$rowDv['nama_thumb']?>" class="thumbnail" width="100%" alt="custom-preview">
                                </div>
                                <div id="player"></div>
                            </div>
                            <!-- End::Video Product -->
                            <!-- Begin::Img Product -->
                            <?php
                                while ($rowDi = mysqli_fetch_assoc($bProdukID)) {
                            ?>
                            <div class="swiper-slide">
                                <img src="assets/img/product/<?=$rowDi['nama_folder']?>/<?=$rowDi['nama_img']?>"
                                    width="100%" alt="Gallery-Product">
                            </div>
                            <?php } ?>
                            <!-- End::Img Product -->
                        </div>
                    </div>
                    <!-- Bawah Gallery -->
                    <div class="swiper-container gallery-thumbs">
                        
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination-product"></div>
                </div>
                <div class="row mt-4 desksript-product justify-content-center">
                    <div class="col-11">
                        <!-- Deskripsi Product -->
                        <div class="row">
                            <div class="col-10 price">
                                <h4><?=$rowDp['nama_produk']?></h4>
                                <h4 class="c-k">Rp. <?=$rowDp['harga']?></h4>
                                <div class="rate">
                                    <span>
                                        <svg fill="#ffc107" height="0.1360in" viewBox="0 -10 511.98645 511"
                                            width="0.1360in" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m499.574219 188.503906c-3.199219-9.921875-11.988281-16.9375-22.398438-17.898437l-141.355469-12.84375-55.894531-130.835938c-4.117187-9.578125-13.503906-15.765625-23.933593-15.765625-10.433594 0-19.820313 6.207032-23.9375 15.808594l-55.890626 130.816406-141.378906 12.839844c-10.386718.941406-19.175781 7.957031-22.378906 17.878906-3.21875 9.921875-.234375 20.777344 7.617188 27.648438l106.859374 93.695312-31.511718 138.773438c-2.300782 10.199218 1.664062 20.734375 10.136718 26.878906 4.519532 3.328125 9.875 4.992188 15.230469 4.992188 4.628907 0 9.238281-1.234376 13.355469-3.710938l121.898438-72.894531 121.875 72.875c8.917968 5.351562 20.160156 4.882812 28.609374-1.238281 8.46875-6.144532 12.4375-16.683594 10.132813-26.882813l-31.507813-138.769531 106.859376-93.699219c7.847656-6.867187 10.835937-17.726563 7.613281-27.667969zm0 0"
                                                fill="#ffc107" />
                                            <path
                                                d="m114.617188 491.136719c-5.632813 0-11.203126-1.746094-15.957032-5.183594-8.855468-6.398437-12.992187-17.429687-10.582031-28.09375l32.9375-145.066406-111.703125-97.964844c-8.210938-7.1875-11.347656-18.515625-7.976562-28.90625 3.371093-10.367187 12.542968-17.726563 23.402343-18.730469l147.820313-13.417968 58.410156-136.746094c4.308594-10.046875 14.121094-16.535156 25.023438-16.535156 10.902343 0 20.714843 6.488281 25.023437 16.511718l58.410156 136.769532 147.796875 13.417968c10.882813.980469 20.054688 8.34375 23.425782 18.710938 3.371093 10.386718.253906 21.738281-7.980469 28.90625l-111.679688 97.941406 32.9375 145.066406c2.414063 10.667969-1.726562 21.695313-10.578125 28.09375-8.8125 6.378906-20.566406 6.914063-29.890625 1.324219l-127.464843-76.160156-127.445313 76.203125c-4.308594 2.582031-9.109375 3.859375-13.929687 3.859375zm141.375-112.871094c4.84375 0 9.640624 1.300781 13.953124 3.859375l120.277344 71.9375-31.085937-136.941406c-2.21875-9.769532 1.089843-19.925782 8.621093-26.515625l105.472657-92.523438-139.542969-12.671875c-10.003906-.894531-18.667969-7.1875-22.59375-16.46875l-55.101562-129.046875-55.148438 129.066407c-3.902344 9.238281-12.5625 15.53125-22.589844 16.429687l-139.519531 12.671875 105.46875 92.519531c7.554687 6.59375 10.839844 16.769531 8.621094 26.539063l-31.082031 136.941406 120.277343-71.9375c4.328125-2.558594 9.128907-3.859375 13.972657-3.859375zm-84.585938-221.824219v.019532zm169.152344-.066406v.023438s0 0 0-.023438zm0 0" />
                                        </svg>
                                    </span>
                                    <span>
                                        <svg fill="#ffc107" height="0.1360in" viewBox="0 -10 511.98645 511"
                                            width="0.1360in" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m499.574219 188.503906c-3.199219-9.921875-11.988281-16.9375-22.398438-17.898437l-141.355469-12.84375-55.894531-130.835938c-4.117187-9.578125-13.503906-15.765625-23.933593-15.765625-10.433594 0-19.820313 6.207032-23.9375 15.808594l-55.890626 130.816406-141.378906 12.839844c-10.386718.941406-19.175781 7.957031-22.378906 17.878906-3.21875 9.921875-.234375 20.777344 7.617188 27.648438l106.859374 93.695312-31.511718 138.773438c-2.300782 10.199218 1.664062 20.734375 10.136718 26.878906 4.519532 3.328125 9.875 4.992188 15.230469 4.992188 4.628907 0 9.238281-1.234376 13.355469-3.710938l121.898438-72.894531 121.875 72.875c8.917968 5.351562 20.160156 4.882812 28.609374-1.238281 8.46875-6.144532 12.4375-16.683594 10.132813-26.882813l-31.507813-138.769531 106.859376-93.699219c7.847656-6.867187 10.835937-17.726563 7.613281-27.667969zm0 0"
                                                fill="#ffc107" />
                                            <path
                                                d="m114.617188 491.136719c-5.632813 0-11.203126-1.746094-15.957032-5.183594-8.855468-6.398437-12.992187-17.429687-10.582031-28.09375l32.9375-145.066406-111.703125-97.964844c-8.210938-7.1875-11.347656-18.515625-7.976562-28.90625 3.371093-10.367187 12.542968-17.726563 23.402343-18.730469l147.820313-13.417968 58.410156-136.746094c4.308594-10.046875 14.121094-16.535156 25.023438-16.535156 10.902343 0 20.714843 6.488281 25.023437 16.511718l58.410156 136.769532 147.796875 13.417968c10.882813.980469 20.054688 8.34375 23.425782 18.710938 3.371093 10.386718.253906 21.738281-7.980469 28.90625l-111.679688 97.941406 32.9375 145.066406c2.414063 10.667969-1.726562 21.695313-10.578125 28.09375-8.8125 6.378906-20.566406 6.914063-29.890625 1.324219l-127.464843-76.160156-127.445313 76.203125c-4.308594 2.582031-9.109375 3.859375-13.929687 3.859375zm141.375-112.871094c4.84375 0 9.640624 1.300781 13.953124 3.859375l120.277344 71.9375-31.085937-136.941406c-2.21875-9.769532 1.089843-19.925782 8.621093-26.515625l105.472657-92.523438-139.542969-12.671875c-10.003906-.894531-18.667969-7.1875-22.59375-16.46875l-55.101562-129.046875-55.148438 129.066407c-3.902344 9.238281-12.5625 15.53125-22.589844 16.429687l-139.519531 12.671875 105.46875 92.519531c7.554687 6.59375 10.839844 16.769531 8.621094 26.539063l-31.082031 136.941406 120.277343-71.9375c4.328125-2.558594 9.128907-3.859375 13.972657-3.859375zm-84.585938-221.824219v.019532zm169.152344-.066406v.023438s0 0 0-.023438zm0 0" />
                                        </svg>
                                    </span>
                                    <span>
                                        <svg fill="#ffc107" height="0.1360in" viewBox="0 -10 511.98645 511"
                                            width="0.1360in" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m499.574219 188.503906c-3.199219-9.921875-11.988281-16.9375-22.398438-17.898437l-141.355469-12.84375-55.894531-130.835938c-4.117187-9.578125-13.503906-15.765625-23.933593-15.765625-10.433594 0-19.820313 6.207032-23.9375 15.808594l-55.890626 130.816406-141.378906 12.839844c-10.386718.941406-19.175781 7.957031-22.378906 17.878906-3.21875 9.921875-.234375 20.777344 7.617188 27.648438l106.859374 93.695312-31.511718 138.773438c-2.300782 10.199218 1.664062 20.734375 10.136718 26.878906 4.519532 3.328125 9.875 4.992188 15.230469 4.992188 4.628907 0 9.238281-1.234376 13.355469-3.710938l121.898438-72.894531 121.875 72.875c8.917968 5.351562 20.160156 4.882812 28.609374-1.238281 8.46875-6.144532 12.4375-16.683594 10.132813-26.882813l-31.507813-138.769531 106.859376-93.699219c7.847656-6.867187 10.835937-17.726563 7.613281-27.667969zm0 0"
                                                fill="#ffc107" />
                                            <path
                                                d="m114.617188 491.136719c-5.632813 0-11.203126-1.746094-15.957032-5.183594-8.855468-6.398437-12.992187-17.429687-10.582031-28.09375l32.9375-145.066406-111.703125-97.964844c-8.210938-7.1875-11.347656-18.515625-7.976562-28.90625 3.371093-10.367187 12.542968-17.726563 23.402343-18.730469l147.820313-13.417968 58.410156-136.746094c4.308594-10.046875 14.121094-16.535156 25.023438-16.535156 10.902343 0 20.714843 6.488281 25.023437 16.511718l58.410156 136.769532 147.796875 13.417968c10.882813.980469 20.054688 8.34375 23.425782 18.710938 3.371093 10.386718.253906 21.738281-7.980469 28.90625l-111.679688 97.941406 32.9375 145.066406c2.414063 10.667969-1.726562 21.695313-10.578125 28.09375-8.8125 6.378906-20.566406 6.914063-29.890625 1.324219l-127.464843-76.160156-127.445313 76.203125c-4.308594 2.582031-9.109375 3.859375-13.929687 3.859375zm141.375-112.871094c4.84375 0 9.640624 1.300781 13.953124 3.859375l120.277344 71.9375-31.085937-136.941406c-2.21875-9.769532 1.089843-19.925782 8.621093-26.515625l105.472657-92.523438-139.542969-12.671875c-10.003906-.894531-18.667969-7.1875-22.59375-16.46875l-55.101562-129.046875-55.148438 129.066407c-3.902344 9.238281-12.5625 15.53125-22.589844 16.429687l-139.519531 12.671875 105.46875 92.519531c7.554687 6.59375 10.839844 16.769531 8.621094 26.539063l-31.082031 136.941406 120.277343-71.9375c4.328125-2.558594 9.128907-3.859375 13.972657-3.859375zm-84.585938-221.824219v.019532zm169.152344-.066406v.023438s0 0 0-.023438zm0 0" />
                                        </svg>
                                    </span>
                                    <span>
                                        <svg fill="#ffc107" height="0.1360in" viewBox="0 -10 511.98645 511"
                                            width="0.1360in" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m499.574219 188.503906c-3.199219-9.921875-11.988281-16.9375-22.398438-17.898437l-141.355469-12.84375-55.894531-130.835938c-4.117187-9.578125-13.503906-15.765625-23.933593-15.765625-10.433594 0-19.820313 6.207032-23.9375 15.808594l-55.890626 130.816406-141.378906 12.839844c-10.386718.941406-19.175781 7.957031-22.378906 17.878906-3.21875 9.921875-.234375 20.777344 7.617188 27.648438l106.859374 93.695312-31.511718 138.773438c-2.300782 10.199218 1.664062 20.734375 10.136718 26.878906 4.519532 3.328125 9.875 4.992188 15.230469 4.992188 4.628907 0 9.238281-1.234376 13.355469-3.710938l121.898438-72.894531 121.875 72.875c8.917968 5.351562 20.160156 4.882812 28.609374-1.238281 8.46875-6.144532 12.4375-16.683594 10.132813-26.882813l-31.507813-138.769531 106.859376-93.699219c7.847656-6.867187 10.835937-17.726563 7.613281-27.667969zm0 0"
                                                fill="#ffc107" />
                                            <path
                                                d="m114.617188 491.136719c-5.632813 0-11.203126-1.746094-15.957032-5.183594-8.855468-6.398437-12.992187-17.429687-10.582031-28.09375l32.9375-145.066406-111.703125-97.964844c-8.210938-7.1875-11.347656-18.515625-7.976562-28.90625 3.371093-10.367187 12.542968-17.726563 23.402343-18.730469l147.820313-13.417968 58.410156-136.746094c4.308594-10.046875 14.121094-16.535156 25.023438-16.535156 10.902343 0 20.714843 6.488281 25.023437 16.511718l58.410156 136.769532 147.796875 13.417968c10.882813.980469 20.054688 8.34375 23.425782 18.710938 3.371093 10.386718.253906 21.738281-7.980469 28.90625l-111.679688 97.941406 32.9375 145.066406c2.414063 10.667969-1.726562 21.695313-10.578125 28.09375-8.8125 6.378906-20.566406 6.914063-29.890625 1.324219l-127.464843-76.160156-127.445313 76.203125c-4.308594 2.582031-9.109375 3.859375-13.929687 3.859375zm141.375-112.871094c4.84375 0 9.640624 1.300781 13.953124 3.859375l120.277344 71.9375-31.085937-136.941406c-2.21875-9.769532 1.089843-19.925782 8.621093-26.515625l105.472657-92.523438-139.542969-12.671875c-10.003906-.894531-18.667969-7.1875-22.59375-16.46875l-55.101562-129.046875-55.148438 129.066407c-3.902344 9.238281-12.5625 15.53125-22.589844 16.429687l-139.519531 12.671875 105.46875 92.519531c7.554687 6.59375 10.839844 16.769531 8.621094 26.539063l-31.082031 136.941406 120.277343-71.9375c4.328125-2.558594 9.128907-3.859375 13.972657-3.859375zm-84.585938-221.824219v.019532zm169.152344-.066406v.023438s0 0 0-.023438zm0 0" />
                                        </svg>
                                    </span>
                                    <span>
                                        <svg fill="#333" height="0.1360in" viewBox="0 -10 511.98645 511"
                                            width="0.1360in" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m499.574219 188.503906c-3.199219-9.921875-11.988281-16.9375-22.398438-17.898437l-141.355469-12.84375-55.894531-130.835938c-4.117187-9.578125-13.503906-15.765625-23.933593-15.765625-10.433594 0-19.820313 6.207032-23.9375 15.808594l-55.890626 130.816406-141.378906 12.839844c-10.386718.941406-19.175781 7.957031-22.378906 17.878906-3.21875 9.921875-.234375 20.777344 7.617188 27.648438l106.859374 93.695312-31.511718 138.773438c-2.300782 10.199218 1.664062 20.734375 10.136718 26.878906 4.519532 3.328125 9.875 4.992188 15.230469 4.992188 4.628907 0 9.238281-1.234376 13.355469-3.710938l121.898438-72.894531 121.875 72.875c8.917968 5.351562 20.160156 4.882812 28.609374-1.238281 8.46875-6.144532 12.4375-16.683594 10.132813-26.882813l-31.507813-138.769531 106.859376-93.699219c7.847656-6.867187 10.835937-17.726563 7.613281-27.667969zm0 0"
                                                fill="white" />
                                            <path
                                                d="m114.617188 491.136719c-5.632813 0-11.203126-1.746094-15.957032-5.183594-8.855468-6.398437-12.992187-17.429687-10.582031-28.09375l32.9375-145.066406-111.703125-97.964844c-8.210938-7.1875-11.347656-18.515625-7.976562-28.90625 3.371093-10.367187 12.542968-17.726563 23.402343-18.730469l147.820313-13.417968 58.410156-136.746094c4.308594-10.046875 14.121094-16.535156 25.023438-16.535156 10.902343 0 20.714843 6.488281 25.023437 16.511718l58.410156 136.769532 147.796875 13.417968c10.882813.980469 20.054688 8.34375 23.425782 18.710938 3.371093 10.386718.253906 21.738281-7.980469 28.90625l-111.679688 97.941406 32.9375 145.066406c2.414063 10.667969-1.726562 21.695313-10.578125 28.09375-8.8125 6.378906-20.566406 6.914063-29.890625 1.324219l-127.464843-76.160156-127.445313 76.203125c-4.308594 2.582031-9.109375 3.859375-13.929687 3.859375zm141.375-112.871094c4.84375 0 9.640624 1.300781 13.953124 3.859375l120.277344 71.9375-31.085937-136.941406c-2.21875-9.769532 1.089843-19.925782 8.621093-26.515625l105.472657-92.523438-139.542969-12.671875c-10.003906-.894531-18.667969-7.1875-22.59375-16.46875l-55.101562-129.046875-55.148438 129.066407c-3.902344 9.238281-12.5625 15.53125-22.589844 16.429687l-139.519531 12.671875 105.46875 92.519531c7.554687 6.59375 10.839844 16.769531 8.621094 26.539063l-31.082031 136.941406 120.277343-71.9375c4.328125-2.558594 9.128907-3.859375 13.972657-3.859375zm-84.585938-221.824219v.019532zm169.152344-.066406v.023438s0 0 0-.023438zm0 0" />
                                        </svg>
                                    </span>
                                    <span class="rate-text"><strong>4.0</strong> Good</span>
                                </div>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-wishlist" id="btn-wishlist">
                                    <svg class="wishlist" width="0.2400in" height="0.2200in" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                        xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M376,30c-27.783,0-53.255,8.804-75.707,26.168c-21.525,16.647-35.856,37.85-44.293,53.268
                                                        c-8.437-15.419-22.768-36.621-44.293-53.268C189.255,38.804,163.783,30,136,30C58.468,30,0,93.417,0,177.514
                                                        c0,90.854,72.943,153.015,183.369,247.118c18.752,15.981,40.007,34.095,62.099,53.414C248.38,480.596,252.12,482,256,482
                                                        s7.62-1.404,10.532-3.953c22.094-19.322,43.348-37.435,62.111-53.425C439.057,330.529,512,268.368,512,177.514
                                                        C512,93.417,453.532,30,376,30z" />
                                            </g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-12 deskripsi-detail">
                                <div class="row">
                                    <div class="col-6">
                                        <span>Color</span>
                                        <div class="color-product">
                                            <span>
                                                <svg fill="#f8ea23" height="0.1700in" width="0.1700in" version="1.1"
                                                    id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <path style="fill:pink;"
                                                        d="M256,7.5v497c137.243,0,248.5-111.257,248.5-248.5S393.243,7.5,256,7.5z" />
                                                    <path style="fill:pink;" d="M464.5,256C464.5,118.757,371.151,7.5,256,7.5C118.757,7.5,7.5,118.757,7.5,256
                                                        S118.757,504.5,256,504.5C371.151,504.5,464.5,393.243,464.5,256z" />
                                                                                                        <path d="M437.02,74.981C388.667,26.629,324.38,0,256,0C193.371,0,133.084,22.87,86.246,64.396
                                                        c-3.099,2.748-3.384,7.488-0.636,10.588c2.748,3.099,7.487,3.384,10.587,0.636C140.289,36.529,197.041,15,256,15
                                                        c132.888,0,241,108.112,241,241S388.888,497,256,497S15,388.888,15,256c0-58.959,21.529-115.712,60.62-159.803
                                                        c2.748-3.099,2.463-7.84-0.636-10.587c-3.1-2.749-7.84-2.463-10.587,0.636C22.87,133.084,0,193.37,0,256
                                                        c0,68.38,26.629,132.667,74.98,181.019C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.981
                                                        C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.981z" />
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </span>
                                            <span>
                                                <svg fill="#46715E" height="0.1700in" width="0.1700in" version="1.1"
                                                    id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <path style="fill:#46715E;"
                                                        d="M256,7.5v497c137.243,0,248.5-111.257,248.5-248.5S393.243,7.5,256,7.5z" />
                                                    <path style="fill:#46715E;" d="M464.5,256C464.5,118.757,371.151,7.5,256,7.5C118.757,7.5,7.5,118.757,7.5,256
                                                            S118.757,504.5,256,504.5C371.151,504.5,464.5,393.243,464.5,256z" />
                                                                                                            <path d="M437.02,74.981C388.667,26.629,324.38,0,256,0C193.371,0,133.084,22.87,86.246,64.396
                                                            c-3.099,2.748-3.384,7.488-0.636,10.588c2.748,3.099,7.487,3.384,10.587,0.636C140.289,36.529,197.041,15,256,15
                                                            c132.888,0,241,108.112,241,241S388.888,497,256,497S15,388.888,15,256c0-58.959,21.529-115.712,60.62-159.803
                                                            c2.748-3.099,2.463-7.84-0.636-10.587c-3.1-2.749-7.84-2.463-10.587,0.636C22.87,133.084,0,193.37,0,256
                                                            c0,68.38,26.629,132.667,74.98,181.019C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.981
                                                            C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.981z" />
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </span>
                                            <span>
                                                <svg fill="#54BBFF" height="0.1700in" width="0.1700in" version="1.1"
                                                    id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <path style="fill:#54BBFF;"
                                                        d="M256,7.5v497c137.243,0,248.5-111.257,248.5-248.5S393.243,7.5,256,7.5z" />
                                                    <path style="fill:#54BBFF;" d="M464.5,256C464.5,118.757,371.151,7.5,256,7.5C118.757,7.5,7.5,118.757,7.5,256
                                                            S118.757,504.5,256,504.5C371.151,504.5,464.5,393.243,464.5,256z" />
                                                                                                            <path d="M437.02,74.981C388.667,26.629,324.38,0,256,0C193.371,0,133.084,22.87,86.246,64.396
                                                            c-3.099,2.748-3.384,7.488-0.636,10.588c2.748,3.099,7.487,3.384,10.587,0.636C140.289,36.529,197.041,15,256,15
                                                            c132.888,0,241,108.112,241,241S388.888,497,256,497S15,388.888,15,256c0-58.959,21.529-115.712,60.62-159.803
                                                            c2.748-3.099,2.463-7.84-0.636-10.587c-3.1-2.749-7.84-2.463-10.587,0.636C22.87,133.084,0,193.37,0,256
                                                            c0,68.38,26.629,132.667,74.98,181.019C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.981
                                                            C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.981z" />
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </span>
                                            <span>
                                                <svg fill="#E5A72E" height="0.1700in" width="0.1700in" version="1.1"
                                                    id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <path style="fill:#E5A72E;"
                                                        d="M256,7.5v497c137.243,0,248.5-111.257,248.5-248.5S393.243,7.5,256,7.5z" />
                                                    <path style="fill:#E5A72E;" d="M464.5,256C464.5,118.757,371.151,7.5,256,7.5C118.757,7.5,7.5,118.757,7.5,256
                                                            S118.757,504.5,256,504.5C371.151,504.5,464.5,393.243,464.5,256z" />
                                                                                                            <path d="M437.02,74.981C388.667,26.629,324.38,0,256,0C193.371,0,133.084,22.87,86.246,64.396
                                                            c-3.099,2.748-3.384,7.488-0.636,10.588c2.748,3.099,7.487,3.384,10.587,0.636C140.289,36.529,197.041,15,256,15
                                                            c132.888,0,241,108.112,241,241S388.888,497,256,497S15,388.888,15,256c0-58.959,21.529-115.712,60.62-159.803
                                                            c2.748-3.099,2.463-7.84-0.636-10.587c-3.1-2.749-7.84-2.463-10.587,0.636C22.87,133.084,0,193.37,0,256
                                                            c0,68.38,26.629,132.667,74.98,181.019C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.981
                                                            C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.981z" />
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </span>
                                            <span>
                                                <svg fill="#333" height="0.1700in" width="0.1700in" version="1.1"
                                                    id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <path style="fill:white;"
                                                        d="M256,7.5v497c137.243,0,248.5-111.257,248.5-248.5S393.243,7.5,256,7.5z" />
                                                    <path style="fill:white;" d="M464.5,256C464.5,118.757,371.151,7.5,256,7.5C118.757,7.5,7.5,118.757,7.5,256
                                                            S118.757,504.5,256,504.5C371.151,504.5,464.5,393.243,464.5,256z" />
                                                                                                            <path d="M437.02,74.981C388.667,26.629,324.38,0,256,0C193.371,0,133.084,22.87,86.246,64.396
                                                            c-3.099,2.748-3.384,7.488-0.636,10.588c2.748,3.099,7.487,3.384,10.587,0.636C140.289,36.529,197.041,15,256,15
                                                            c132.888,0,241,108.112,241,241S388.888,497,256,497S15,388.888,15,256c0-58.959,21.529-115.712,60.62-159.803
                                                            c2.748-3.099,2.463-7.84-0.636-10.587c-3.1-2.749-7.84-2.463-10.587,0.636C22.87,133.084,0,193.37,0,256
                                                            c0,68.38,26.629,132.667,74.98,181.019C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.981
                                                            C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.981z" />
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6 size-option">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Size</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>S</option>
                                                <option>M</option>
                                                <option>L</option>
                                                <option>XL</option>
                                                <option>Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <span>Stok</span><br>
                                        <span><strong><?=$rowDp['stok']?></strong></span>
                                    </div>
                                    <div class="col-6">
                                        <span>Sold</span><br>
                                        <span><strong>1,1 K</strong></span>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <span class="c-h">Deskripsi</span>
                                        <p>
                                            <?=$rowDp['deskripsi']?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Deskripsi Product -->
                    </div>
                </div>
                <div class="row profil-toko">
                    <div class="col-12 d-profil">
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="frame-img">
                                            <img src="assets/img/patner/icon-toko/logo-dummy-1.png" width="100%"
                                                alt="Patner Image">
                                        </div>
                                    </div>
                                    <div class="col-8 data-patner">
                                        <div class="row">
                                            <div class="col-12 nama-toko">
                                                <h5>Mamat Furniture</h5>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="0.2400in"
                                                        height="0.2400in" viewBox="0 0 500 500">
                                                        <g transform="translate(-2612 -3275)">
                                                            <rect width="0.1700in" height="0.1700in"
                                                                transform="translate(2612 3275)" fill="none" />
                                                            <path
                                                                d="M1706.854,209.053a8.607,8.607,0,0,0-.892-1.424c-.209-.342-.361-.646-.589-.95a9.126,9.126,0,0,0-3.95-3.057l-.132-.095-151.727-56.874a9.243,9.243,0,0,0-7.046.133L1409.763,203.66c-.132.057-.188.209-.321.266a9.178,9.178,0,0,0-3.323,2.791,10.077,10.077,0,0,0-.722,1.025,7.489,7.489,0,0,0-.626.911,9.509,9.509,0,0,0-.76,3.722v170.7a9.507,9.507,0,0,0,5.752,8.735L1542.52,448.7h.02a9.449,9.449,0,0,0,7.045.152l.342-.133h.019l151.365-56.76a9.493,9.493,0,0,0,6.153-8.887V212.4c0-.171-.133-.285-.133-.437A9.7,9.7,0,0,0,1706.854,209.053Zm-160.367-43.315L1670.964,212.4l-29.68,11.128-53.208-23.832a9.336,9.336,0,0,0-8.337.323l-37.182,15.8a9.5,9.5,0,0,0,.1,17.527l34.5,14.242-30.671,11.488-108.9-46.676Zm56.7,72.065-32.434-13.369,13.425-5.716,31.865,14.261Zm9.438,16.711,18.97-7.1v46.2l-18.97,7.121ZM1422.98,226.789l113.785,48.765V425.59L1422.98,376.825Zm132.756,199.5V275.858l37.921-14.223v52.791a9.449,9.449,0,0,0,9.5,9.475,9.713,9.713,0,0,0,3.343-.608l37.923-14.223a9.486,9.486,0,0,0,6.152-8.868V240.291l37.921-14.223V376.5Z"
                                                                transform="translate(1306.989 3226.979)"
                                                                fill="#426a5a" />
                                                        </g>
                                                    </svg>205 Produk
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="row mt-3">
                                            <div class="col-6">
                                                <button type="submit" name="checkout" class="btn btn-checkout">
                                                    <svg fill="white" id="Capa_1" enable-background="new 0 0 510 510"
                                                        height="0.2100in" viewBox="0 0 510 510" width="0.2100in"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g>
                                                            <path d="m196.507 30 18.002-30h-109.016l18 30z" />
                                                            <path
                                                                d="m500 390v-270h-490v270zm-195-210h60v30h-60zm0 60h90v30h-90zm-166.673 91.213-63.639-63.64 21.213-21.213 42.426 42.426 106.066-106.066 21.213 21.213zm166.673-31.213h135v30h-135z" />
                                                            <path
                                                                d="m310 53.209c0-29.339-23.869-53.209-53.209-53.209h-7.227l-1.773 2.836-34.298 57.164h-106.986l-34.619-57.715-1.27-2.285h-7.409c-29.339 0-53.209 23.87-53.209 53.209v36.791h300z" />
                                                            <path
                                                                d="m10 420v36.791c0 29.339 23.87 53.209 53.209 53.209h193.582c29.34 0 53.209-23.87 53.209-53.209v-36.791z" />
                                                        </g>
                                                    </svg>
                                                    Checkout
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <a href="keranjang" class="btn btn-addcart">
                                                    <svg fill="white" version="1.1" id="Capa_1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        width="0.2100in" height="0.2100in" viewBox="0 0 34.157 34.158"
                                                        style="enable-background:new 0 0 34.157 34.158;" xml:space="preserve">
                                                        <g>
                                                            <path d="M17.975,25.103v4.603H1.58V3.851h16.395v4.953h1.582V2.519c0-1.252-1.023-2.273-2.273-2.273H2.273
                                                                    C1.021,0.246,0,1.267,0,2.519v29.12c0,1.252,1.021,2.273,2.273,2.273h15.01c1.25,0,2.273-1.021,2.273-2.273v-6.535H17.975z
                                                                    M7.376,1.887h4.802c0.152,0,0.275,0.121,0.275,0.273c0,0.15-0.123,0.275-0.275,0.275H7.376c-0.152,0-0.274-0.125-0.274-0.275
                                                                    C7.102,2.008,7.224,1.887,7.376,1.887z M9.777,32.777c-0.627,0-1.137-0.51-1.137-1.139c0-0.627,0.51-1.137,1.137-1.137
                                                                    c0.629,0,1.139,0.51,1.139,1.137C10.915,32.267,10.406,32.777,9.777,32.777z M25.406,23.711H9.14l-2.993-13.44h18.301l-0.496,1.926
                                                                    H8.547l2.137,9.591h13.177l3.311-14.991h6.985v1.924h-5.44L25.406,23.711z M14.531,26.267c0,0.992-0.806,1.797-1.795,1.797
                                                                    c-0.992,0-1.797-0.805-1.797-1.797c0-0.99,0.805-1.795,1.797-1.795C13.727,24.472,14.531,25.277,14.531,26.267z M23.922,26.267
                                                                    c0,0.992-0.805,1.797-1.797,1.797c-0.99,0-1.795-0.805-1.795-1.797c0-0.99,0.805-1.795,1.795-1.795
                                                                    C23.117,24.472,23.922,25.277,23.922,26.267z" />
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                    </svg>
                                                    Add To Cart
                                                </a>
                                            </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- Begin::Menu -->
                 <div class="row bar-menu fixed-bottom">
                    <div class="col-12">
                        <div class="row justify-content-between">
                            <div class="col-2 text-center div-menu">
                                <a href="../bestore-mall/">
                                    <!-- <img src="assets/img/svg/bar-control/home-run.svg" width="70%" alt="bar-img"> -->
                                    <svg width="0.2800in" height="0.2800in" fill="#777" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                            y="0px" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M511.864,221.487c-0.921-11.988-6.455-22.896-15.581-30.716l-44.286-37.96V44.944c0-8.284-6.716-14.999-14.999-14.999
                                                    h-59.998c-8.284,0-14.799,6.716-14.799,14.999v30.728l-75.911-64.695c-16.97-14.539-41.603-14.537-58.519-0.043L15.728,190.769
                                                    c-18.753,16.068-21.186,44.423-4.866,63.473c12.439,14.465,32.364,19.077,49.35,13.107v229.584
                                                    c0,8.284,6.516,14.999,14.799,14.999h361.986c8.284,0,14.999-6.716,14.999-14.999V267.352c17.534,6.2,37.039,1.004,49.167-13.13
                                                    C508.983,245.094,512.784,233.468,511.864,221.487z M391.999,59.943h30.199v67.154l-30.199-25.713V59.943z M317.202,481.934
                                                    H195.007V361.738h122.195V481.934z M422.198,481.934h-75.197V346.939c0-8.284-6.716-14.999-14.999-14.999H180.007
                                                    c-8.284,0-14.799,6.716-14.799,14.999v134.995H90.011V245.775l166.943-141.613l165.245,141.473V481.934z M478.389,234.694
                                                    c-5.318,6.198-14.772,7.107-21.158,1.631L266.765,73.061c-5.595-4.797-13.845-4.817-19.464-0.05
                                                    C243.242,76.453,55.58,235.643,54.786,236.317c-6.282,5.375-15.782,4.642-21.161-1.615c-5.385-6.285-4.657-15.774,1.569-21.11
                                                    L247.238,33.756c5.66-4.848,13.874-4.849,19.53-0.002l209.994,179.795C483.04,218.929,483.767,228.419,478.389,234.694z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path d="M302.002,179.938h-91.996c-8.284,0-14.799,6.716-14.799,14.999v89.996c0,8.284,6.516,14.999,14.799,14.999h91.996
                                                    c8.284,0,14.999-6.716,14.999-14.999v-89.996C317.002,186.653,310.286,179.938,302.002,179.938z M287.203,269.935h-62.198v-59.998
                                                    h62.198V269.935z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <circle cx="271.999" cy="406.934" r="14.999" />
                                                </g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                        </svg>
                                    <span>Home</span>
                                </a>
                            </div>
                            <div class="col-2 text-center div-menu">
                                <a href="../bestore-mall/">
                                    <img src="assets/img/svg/bar-control/photo.svg" width="70%" alt="bar-img">
                                    <span>Feed</span>
                                </a>
                            </div>
                            <div class="col-2 text-center div-menu menu-official">
                                <div class="logo-official">
                                    <a href="official-produk">
                                        <img src="assets/img/svg/bar-control/B Logo.svg" width="70%" alt="bar-img">
                                    </a>
                                </div>
                                <span>Bestore Product</span>
                            </div>
                            <div class="col-2 text-center div-menu">
                                <a href="keranjang">
                                    <img src="assets/img/svg/bar-control/shopping-cart.svg" width="70%" alt="bar-img">
                                    <span>Cart</span>
                                </a>
                            </div>
                            <div class="col-2 text-center div-menu">
                                <a href="my-web">
                                    <svg width="0.2800in" height="0.2800in" fill="#777" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 508 508"
                                        style="enable-background:new 0 0 508 508;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path
                                                    d="M0,57.35v262.2v16.4v65.5h181.2c-8.8,8.6-14.8,20-16.6,32.8h-58v16.4H164h180.3h57.4v-16.4h-58
			c-1.8-12.8-7.8-24.2-16.6-32.8H508v-65.5v-16.4V57.35H0z M181.1,434.25c3.8-18.7,20.4-32.8,40.1-32.8h65.5
			c19.9,0,36.4,14.1,40.2,32.8H181.1z M491.6,385.05H286.8h-65.5H16.4v-49.2h475.2V385.05z M491.6,319.45H16.4V73.65h475.2V319.45z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="245.8" y="352.25" width="16.4" height="16.4" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="278.6" y="352.25" width="16.4" height="16.4" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="213" y="352.25" width="16.4" height="16.4" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M93.9,221.05h100.8l21.1-73.7H80l-7.7-41H41v16.4h17.8l4.6,24.6l13.8,73.7l6.1,32.8h5c-3.9,4.4-6.4,10.1-6.4,16.4
			c0,13.6,11,24.6,24.6,24.6s24.6-11,24.6-24.6c0-6.3-2.5-12-6.4-16.4h37.4c-3.9,4.4-6.4,10.1-6.4,16.4c0,13.6,11,24.6,24.6,24.6
			c13.6,0,24.6-11,24.6-24.6c0-6.3-2.5-12-6.4-16.4H209v-16.4H97L93.9,221.05z M83.1,163.75H194l-11.7,41H90.8L83.1,163.75z
			 M180.3,262.05c4.5,0,8.2,3.7,8.2,8.2s-3.7,8.2-8.2,8.2s-8.2-3.7-8.2-8.2S175.7,262.05,180.3,262.05z M106.5,262.05
			c4.5,0,8.2,3.7,8.2,8.2s-3.7,8.2-8.2,8.2s-8.2-3.7-8.2-8.2S102,262.05,106.5,262.05z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M286.8,98.15v114.7H467V98.15H286.8z M450.7,196.55h-0.1H303.2v-49.2h147.5V196.55z M450.7,130.95h-0.1H303.2v-16.4h147.5
			V130.95z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="319.5" y="171.95" width="16.4" height="16.4" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="352.3" y="171.95" width="16.4" height="16.4" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="385.1" y="171.95" width="16.4" height="16.4" />
                                            </g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                    </svg>
                                    <span>My Web</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End::Menu -->

                <!-- Begin:Product Lainnya -->
                <div class="row mt-5 justify-content-end product">
                    <div class="col-11 kategori-judul">
                        <div class="row">
                            <div class="col-8">
                                <h4>Lihat Product Lainnya</h4>
                            </div>
                            <div class="col-4 text-center">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-11 slide">
                        <div class="swiper-container container-product">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="row des-product">
                                        <div class="col-12">
                                            <button class="btn btn-wishlist">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 477.534 477.534"
                                                    style="enable-background:new 0 0 477.534 477.534;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M438.482,58.61c-24.7-26.549-59.311-41.655-95.573-41.711c-36.291,0.042-70.938,15.14-95.676,41.694l-8.431,8.909
                    l-8.431-8.909C181.284,5.762,98.662,2.728,45.832,51.815c-2.341,2.176-4.602,4.436-6.778,6.778
                    c-52.072,56.166-52.072,142.968,0,199.134l187.358,197.581c6.482,6.843,17.284,7.136,24.127,0.654
                    c0.224-0.212,0.442-0.43,0.654-0.654l187.29-197.581C490.551,201.567,490.551,114.77,438.482,58.61z M413.787,234.226h-0.017
                    L238.802,418.768L63.818,234.226c-39.78-42.916-39.78-109.233,0-152.149c36.125-39.154,97.152-41.609,136.306-5.484
                    c1.901,1.754,3.73,3.583,5.484,5.484l20.804,21.948c6.856,6.812,17.925,6.812,24.781,0l20.804-21.931
                    c36.125-39.154,97.152-41.609,136.306-5.484c1.901,1.754,3.73,3.583,5.484,5.484C453.913,125.078,454.207,191.516,413.787,234.226
                    z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button class="btn btn-cart">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M256,0C114.84,0,0,114.84,0,256s114.84,256,256,256s256-114.84,256-256S397.16,0,256,0z M256,475.429
			c-120.997,0-219.429-98.432-219.429-219.429S135.003,36.571,256,36.571S475.429,135.003,475.429,256S376.997,475.429,256,475.429z
			" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M256,134.095c-10.1,0-18.286,8.186-18.286,18.286v207.238c0,10.1,8.186,18.286,18.286,18.286
			c10.1,0,18.286-8.186,18.286-18.286V152.381C274.286,142.281,266.1,134.095,256,134.095z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M359.619,237.714H152.381c-10.1,0-18.286,8.186-18.286,18.286c0,10.1,8.186,18.286,18.286,18.286h207.238
			c10.1,0,18.286-8.186,18.286-18.286C377.905,245.9,369.719,237.714,359.619,237.714z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="col-12 img-product">
                                            <img src="assets/img/product/official/plant-dummy.png" width="100%"
                                                alt="Img-Product">
                                        </div>
                                        <div class="col-12 etc-product">
                                            <p>Beautiful Plant</p>
                                            <h6>Rp. 112.000</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row des-product">
                                        <div class="col-12">
                                            <button class="btn btn-wishlist">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 477.534 477.534"
                                                    style="enable-background:new 0 0 477.534 477.534;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M438.482,58.61c-24.7-26.549-59.311-41.655-95.573-41.711c-36.291,0.042-70.938,15.14-95.676,41.694l-8.431,8.909
                    l-8.431-8.909C181.284,5.762,98.662,2.728,45.832,51.815c-2.341,2.176-4.602,4.436-6.778,6.778
                    c-52.072,56.166-52.072,142.968,0,199.134l187.358,197.581c6.482,6.843,17.284,7.136,24.127,0.654
                    c0.224-0.212,0.442-0.43,0.654-0.654l187.29-197.581C490.551,201.567,490.551,114.77,438.482,58.61z M413.787,234.226h-0.017
                    L238.802,418.768L63.818,234.226c-39.78-42.916-39.78-109.233,0-152.149c36.125-39.154,97.152-41.609,136.306-5.484
                    c1.901,1.754,3.73,3.583,5.484,5.484l20.804,21.948c6.856,6.812,17.925,6.812,24.781,0l20.804-21.931
                    c36.125-39.154,97.152-41.609,136.306-5.484c1.901,1.754,3.73,3.583,5.484,5.484C453.913,125.078,454.207,191.516,413.787,234.226
                    z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button class="btn btn-cart">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M256,0C114.84,0,0,114.84,0,256s114.84,256,256,256s256-114.84,256-256S397.16,0,256,0z M256,475.429
			c-120.997,0-219.429-98.432-219.429-219.429S135.003,36.571,256,36.571S475.429,135.003,475.429,256S376.997,475.429,256,475.429z
			" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M256,134.095c-10.1,0-18.286,8.186-18.286,18.286v207.238c0,10.1,8.186,18.286,18.286,18.286
			c10.1,0,18.286-8.186,18.286-18.286V152.381C274.286,142.281,266.1,134.095,256,134.095z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M359.619,237.714H152.381c-10.1,0-18.286,8.186-18.286,18.286c0,10.1,8.186,18.286,18.286,18.286h207.238
			c10.1,0,18.286-8.186,18.286-18.286C377.905,245.9,369.719,237.714,359.619,237.714z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button class="btn btn-cart">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M256,0C114.84,0,0,114.84,0,256s114.84,256,256,256s256-114.84,256-256S397.16,0,256,0z M256,475.429
			c-120.997,0-219.429-98.432-219.429-219.429S135.003,36.571,256,36.571S475.429,135.003,475.429,256S376.997,475.429,256,475.429z
			" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M256,134.095c-10.1,0-18.286,8.186-18.286,18.286v207.238c0,10.1,8.186,18.286,18.286,18.286
			c10.1,0,18.286-8.186,18.286-18.286V152.381C274.286,142.281,266.1,134.095,256,134.095z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M359.619,237.714H152.381c-10.1,0-18.286,8.186-18.286,18.286c0,10.1,8.186,18.286,18.286,18.286h207.238
			c10.1,0,18.286-8.186,18.286-18.286C377.905,245.9,369.719,237.714,359.619,237.714z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="col-12 img-product">
                                            <img src="assets/img/product/official/kursi-dummy.png" width="100%"
                                                alt="Img-Product">
                                        </div>
                                        <div class="col-12 etc-product">
                                            <p>Beautiful Plant</p>
                                            <h6>Rp. 112.000</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row des-product">
                                        <div class="col-12">
                                            <button class="btn btn-wishlist">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 477.534 477.534"
                                                    style="enable-background:new 0 0 477.534 477.534;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M438.482,58.61c-24.7-26.549-59.311-41.655-95.573-41.711c-36.291,0.042-70.938,15.14-95.676,41.694l-8.431,8.909
                    l-8.431-8.909C181.284,5.762,98.662,2.728,45.832,51.815c-2.341,2.176-4.602,4.436-6.778,6.778
                    c-52.072,56.166-52.072,142.968,0,199.134l187.358,197.581c6.482,6.843,17.284,7.136,24.127,0.654
                    c0.224-0.212,0.442-0.43,0.654-0.654l187.29-197.581C490.551,201.567,490.551,114.77,438.482,58.61z M413.787,234.226h-0.017
                    L238.802,418.768L63.818,234.226c-39.78-42.916-39.78-109.233,0-152.149c36.125-39.154,97.152-41.609,136.306-5.484
                    c1.901,1.754,3.73,3.583,5.484,5.484l20.804,21.948c6.856,6.812,17.925,6.812,24.781,0l20.804-21.931
                    c36.125-39.154,97.152-41.609,136.306-5.484c1.901,1.754,3.73,3.583,5.484,5.484C453.913,125.078,454.207,191.516,413.787,234.226
                    z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button class="btn btn-cart">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M256,0C114.84,0,0,114.84,0,256s114.84,256,256,256s256-114.84,256-256S397.16,0,256,0z M256,475.429
			c-120.997,0-219.429-98.432-219.429-219.429S135.003,36.571,256,36.571S475.429,135.003,475.429,256S376.997,475.429,256,475.429z
			" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M256,134.095c-10.1,0-18.286,8.186-18.286,18.286v207.238c0,10.1,8.186,18.286,18.286,18.286
			c10.1,0,18.286-8.186,18.286-18.286V152.381C274.286,142.281,266.1,134.095,256,134.095z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M359.619,237.714H152.381c-10.1,0-18.286,8.186-18.286,18.286c0,10.1,8.186,18.286,18.286,18.286h207.238
			c10.1,0,18.286-8.186,18.286-18.286C377.905,245.9,369.719,237.714,359.619,237.714z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="col-12 img-product">
                                            <img src="assets/img/product/official/lampu-dummy.png" width="100%"
                                                alt="Img-Product">
                                        </div>
                                        <div class="col-12 etc-product">
                                            <p>Beautiful Plant</p>
                                            <h6>Rp. 112.000</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row des-product">
                                        <div class="col-12">
                                            <button class="btn btn-wishlist">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 477.534 477.534"
                                                    style="enable-background:new 0 0 477.534 477.534;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M438.482,58.61c-24.7-26.549-59.311-41.655-95.573-41.711c-36.291,0.042-70.938,15.14-95.676,41.694l-8.431,8.909
                    l-8.431-8.909C181.284,5.762,98.662,2.728,45.832,51.815c-2.341,2.176-4.602,4.436-6.778,6.778
                    c-52.072,56.166-52.072,142.968,0,199.134l187.358,197.581c6.482,6.843,17.284,7.136,24.127,0.654
                    c0.224-0.212,0.442-0.43,0.654-0.654l187.29-197.581C490.551,201.567,490.551,114.77,438.482,58.61z M413.787,234.226h-0.017
                    L238.802,418.768L63.818,234.226c-39.78-42.916-39.78-109.233,0-152.149c36.125-39.154,97.152-41.609,136.306-5.484
                    c1.901,1.754,3.73,3.583,5.484,5.484l20.804,21.948c6.856,6.812,17.925,6.812,24.781,0l20.804-21.931
                    c36.125-39.154,97.152-41.609,136.306-5.484c1.901,1.754,3.73,3.583,5.484,5.484C453.913,125.078,454.207,191.516,413.787,234.226
                    z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button class="btn btn-cart">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M256,0C114.84,0,0,114.84,0,256s114.84,256,256,256s256-114.84,256-256S397.16,0,256,0z M256,475.429
			c-120.997,0-219.429-98.432-219.429-219.429S135.003,36.571,256,36.571S475.429,135.003,475.429,256S376.997,475.429,256,475.429z
			" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M256,134.095c-10.1,0-18.286,8.186-18.286,18.286v207.238c0,10.1,8.186,18.286,18.286,18.286
			c10.1,0,18.286-8.186,18.286-18.286V152.381C274.286,142.281,266.1,134.095,256,134.095z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M359.619,237.714H152.381c-10.1,0-18.286,8.186-18.286,18.286c0,10.1,8.186,18.286,18.286,18.286h207.238
			c10.1,0,18.286-8.186,18.286-18.286C377.905,245.9,369.719,237.714,359.619,237.714z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="col-12 img-product">
                                            <img src="assets/img/product/official/botol-dummy.png" width="100%"
                                                alt="Img-Product">
                                        </div>
                                        <div class="col-12 etc-product">
                                            <p>Beautiful Plant</p>
                                            <h6>Rp. 112.000</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row des-product">
                                        <div class="col-12">
                                            <button class="btn btn-wishlist">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 477.534 477.534"
                                                    style="enable-background:new 0 0 477.534 477.534;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M438.482,58.61c-24.7-26.549-59.311-41.655-95.573-41.711c-36.291,0.042-70.938,15.14-95.676,41.694l-8.431,8.909
                    l-8.431-8.909C181.284,5.762,98.662,2.728,45.832,51.815c-2.341,2.176-4.602,4.436-6.778,6.778
                    c-52.072,56.166-52.072,142.968,0,199.134l187.358,197.581c6.482,6.843,17.284,7.136,24.127,0.654
                    c0.224-0.212,0.442-0.43,0.654-0.654l187.29-197.581C490.551,201.567,490.551,114.77,438.482,58.61z M413.787,234.226h-0.017
                    L238.802,418.768L63.818,234.226c-39.78-42.916-39.78-109.233,0-152.149c36.125-39.154,97.152-41.609,136.306-5.484
                    c1.901,1.754,3.73,3.583,5.484,5.484l20.804,21.948c6.856,6.812,17.925,6.812,24.781,0l20.804-21.931
                    c36.125-39.154,97.152-41.609,136.306-5.484c1.901,1.754,3.73,3.583,5.484,5.484C453.913,125.078,454.207,191.516,413.787,234.226
                    z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button class="btn btn-cart">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M256,0C114.84,0,0,114.84,0,256s114.84,256,256,256s256-114.84,256-256S397.16,0,256,0z M256,475.429
			c-120.997,0-219.429-98.432-219.429-219.429S135.003,36.571,256,36.571S475.429,135.003,475.429,256S376.997,475.429,256,475.429z
			" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M256,134.095c-10.1,0-18.286,8.186-18.286,18.286v207.238c0,10.1,8.186,18.286,18.286,18.286
			c10.1,0,18.286-8.186,18.286-18.286V152.381C274.286,142.281,266.1,134.095,256,134.095z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M359.619,237.714H152.381c-10.1,0-18.286,8.186-18.286,18.286c0,10.1,8.186,18.286,18.286,18.286h207.238
			c10.1,0,18.286-8.186,18.286-18.286C377.905,245.9,369.719,237.714,359.619,237.714z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="col-12 img-product">
                                            <img src="assets/img/product/official/gelas-dummy.png" width="100%"
                                                alt="Img-Product">
                                        </div>
                                        <div class="col-12 etc-product">
                                            <p>Beautiful Plant</p>
                                            <h6>Rp. 112.000</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row des-product">
                                        <div class="col-12">
                                            <button class="btn btn-wishlist">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 477.534 477.534"
                                                    style="enable-background:new 0 0 477.534 477.534;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M438.482,58.61c-24.7-26.549-59.311-41.655-95.573-41.711c-36.291,0.042-70.938,15.14-95.676,41.694l-8.431,8.909
                    l-8.431-8.909C181.284,5.762,98.662,2.728,45.832,51.815c-2.341,2.176-4.602,4.436-6.778,6.778
                    c-52.072,56.166-52.072,142.968,0,199.134l187.358,197.581c6.482,6.843,17.284,7.136,24.127,0.654
                    c0.224-0.212,0.442-0.43,0.654-0.654l187.29-197.581C490.551,201.567,490.551,114.77,438.482,58.61z M413.787,234.226h-0.017
                    L238.802,418.768L63.818,234.226c-39.78-42.916-39.78-109.233,0-152.149c36.125-39.154,97.152-41.609,136.306-5.484
                    c1.901,1.754,3.73,3.583,5.484,5.484l20.804,21.948c6.856,6.812,17.925,6.812,24.781,0l20.804-21.931
                    c36.125-39.154,97.152-41.609,136.306-5.484c1.901,1.754,3.73,3.583,5.484,5.484C453.913,125.078,454.207,191.516,413.787,234.226
                    z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button class="btn btn-cart">
                                                <svg width="0.2400in" height="0.4400in" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M256,0C114.84,0,0,114.84,0,256s114.84,256,256,256s256-114.84,256-256S397.16,0,256,0z M256,475.429
			c-120.997,0-219.429-98.432-219.429-219.429S135.003,36.571,256,36.571S475.429,135.003,475.429,256S376.997,475.429,256,475.429z
			" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M256,134.095c-10.1,0-18.286,8.186-18.286,18.286v207.238c0,10.1,8.186,18.286,18.286,18.286
			c10.1,0,18.286-8.186,18.286-18.286V152.381C274.286,142.281,266.1,134.095,256,134.095z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path d="M359.619,237.714H152.381c-10.1,0-18.286,8.186-18.286,18.286c0,10.1,8.186,18.286,18.286,18.286h207.238
			c10.1,0,18.286-8.186,18.286-18.286C377.905,245.9,369.719,237.714,359.619,237.714z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="col-12 img-product">
                                            <img src="assets/img/product/official/tas-dummy.png" width="100%"
                                                alt="Img-Product">
                                        </div>
                                        <div class="col-12 etc-product">
                                            <p>Beautiful Plant</p>
                                            <h6>Rp. 112.000</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END:PRODUCT LAINNYA -->
                
                <!-- Begin:PRODUCT LAINNYA -->
                <div class="row mb-5 justify-content-center card-ulasan">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="row pt-4">
                                    <div class="col-6">
                                        <h5>Ulasan Pembeli</h5>
                                        <h6>5 / 5
                                            <svg fill="#ffc107" height="0.1900in" viewBox="0 -10 511.98645 511"
                                            width="0.1900in" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m499.574219 188.503906c-3.199219-9.921875-11.988281-16.9375-22.398438-17.898437l-141.355469-12.84375-55.894531-130.835938c-4.117187-9.578125-13.503906-15.765625-23.933593-15.765625-10.433594 0-19.820313 6.207032-23.9375 15.808594l-55.890626 130.816406-141.378906 12.839844c-10.386718.941406-19.175781 7.957031-22.378906 17.878906-3.21875 9.921875-.234375 20.777344 7.617188 27.648438l106.859374 93.695312-31.511718 138.773438c-2.300782 10.199218 1.664062 20.734375 10.136718 26.878906 4.519532 3.328125 9.875 4.992188 15.230469 4.992188 4.628907 0 9.238281-1.234376 13.355469-3.710938l121.898438-72.894531 121.875 72.875c8.917968 5.351562 20.160156 4.882812 28.609374-1.238281 8.46875-6.144532 12.4375-16.683594 10.132813-26.882813l-31.507813-138.769531 106.859376-93.699219c7.847656-6.867187 10.835937-17.726563 7.613281-27.667969zm0 0"
                                                fill="#ffc107" />
                                            <path
                                                d="m114.617188 491.136719c-5.632813 0-11.203126-1.746094-15.957032-5.183594-8.855468-6.398437-12.992187-17.429687-10.582031-28.09375l32.9375-145.066406-111.703125-97.964844c-8.210938-7.1875-11.347656-18.515625-7.976562-28.90625 3.371093-10.367187 12.542968-17.726563 23.402343-18.730469l147.820313-13.417968 58.410156-136.746094c4.308594-10.046875 14.121094-16.535156 25.023438-16.535156 10.902343 0 20.714843 6.488281 25.023437 16.511718l58.410156 136.769532 147.796875 13.417968c10.882813.980469 20.054688 8.34375 23.425782 18.710938 3.371093 10.386718.253906 21.738281-7.980469 28.90625l-111.679688 97.941406 32.9375 145.066406c2.414063 10.667969-1.726562 21.695313-10.578125 28.09375-8.8125 6.378906-20.566406 6.914063-29.890625 1.324219l-127.464843-76.160156-127.445313 76.203125c-4.308594 2.582031-9.109375 3.859375-13.929687 3.859375zm141.375-112.871094c4.84375 0 9.640624 1.300781 13.953124 3.859375l120.277344 71.9375-31.085937-136.941406c-2.21875-9.769532 1.089843-19.925782 8.621093-26.515625l105.472657-92.523438-139.542969-12.671875c-10.003906-.894531-18.667969-7.1875-22.59375-16.46875l-55.101562-129.046875-55.148438 129.066407c-3.902344 9.238281-12.5625 15.53125-22.589844 16.429687l-139.519531 12.671875 105.46875 92.519531c7.554687 6.59375 10.839844 16.769531 8.621094 26.539063l-31.082031 136.941406 120.277343-71.9375c4.328125-2.558594 9.128907-3.859375 13.972657-3.859375zm-84.585938-221.824219v.019532zm169.152344-.066406v.023438s0 0 0-.023438zm0 0" />
                                        </svg>
                                        <span class="text-kecil">3 Ulasan</span>
                                        </h6>
                                    </div>
                                    <div class="col-6 text-right ">
                                        <a href="ulasan">View All</a>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <p>
                                            Lorem Ipsum is simply dummy text of th... <a href="ulasan">More</a>
                                        </p>
                                        <div class="swiper-container foto-costumer">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="frame-img-ulasan">
                                                        <img src="assets/img/product/official/gelas-dummy.png" width="100%" alt="foto-costumer">
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="frame-img-ulasan">
                                                        <img src="assets/img/product/official/tas-dummy.png" width="100%" alt="foto-costumer">
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="frame-img-ulasan">
                                                        <img src="assets/img/product/official/lampu-dummy.png" width="100%" alt="foto-costumer">
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="frame-img-ulasan">
                                                        <img src="assets/img/product/official/botol-dummy.png" width="100%" alt="foto-costumer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END:PRODUCT LAINNYA -->

                <div class="row mt-5">&nbsp;</div>
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
  

    <!-- Video Youtube -->
    <script>
        var player;
          function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
              width: '100%',
              videoId: '<?=$rowDv['nama_video']?>', //ID Youtube 
              playerVars: { 'autoplay': 1, 'playsinline': 1 },
              events: {
                'onReady': onPlayerReady
              }
            });
          }

        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            event.target.mute();
            event.target.playVideo();
        }

        var myEl = document.getElementById('frame');

        myEl.addEventListener('click', function () {
            // alert('Hello world');
            var thumb = document.getElementById('frame');
            thumb.parentNode.removeChild(thumb);
            var tag = document.createElement('script');

            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        }, false);
    </script>
    <!-- Video Youtube -->
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

        // Gallery Product
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 7 ,
            slidesPerView: 3,
            // loop: true,
            // centeredSlides: true,
            // freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var galleryTop = new Swiper('.gallery-top', {
            autoHeight: true,
            spaceBetween: 0,
            // autoplay: {
            //     delay: 2500,
            //     disableOnInteraction: false,
            // },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: galleryThumbs
            },
            pagination: {
                el: '.swiper-pagination-product',
                clickable: true,
            }
        });

        var swiper = new Swiper('.foto-costumer', {
            slidesPerView: 'auto',
            freeMode: true,
            spaceBetween: 15,
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
</body>

</html>