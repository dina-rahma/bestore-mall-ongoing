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
    // Cek data Toko, ada atau tidak
    $bTokoID = $kueriMall->bTokoID($_SESSION['id_patner']);
    $cToko = mysqli_num_rows($bTokoID);
    if ($cToko < 1) {
        header("Location:my-web-welcome");
    }

    $rowIDToko = mysqli_fetch_assoc($bTokoID);

    $bDToko = $kueriMall->bDToko($rowIDToko['id_toko']);
    $rowToko = mysqli_fetch_assoc($bDToko);

    if ($rowToko['logo_img'] == "") {
        $rowToko['logo_img'] = "profile-bestore.png";
    }
    // =====================


    $bProdukBestore = $kueriMall->bProdukBestore(); //Baca Product Bestore //File di kueri-mall.php
    $bProdukPatner = $kueriMall->bProdukPatnerKu($_SESSION['id_patner']); //Baca Product Patner //File di kueri-mall.php
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
                                <h5>Toko Saya</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-end">
                    <div class="col-12 top-img">
                        <div class="row r-nav align-items-end">
                            <div class="col-6 top-nav text-center"><a href="account">Akun</a></div>
                            <div class="col-6 top-nav active text-center"><a href="my-web">Akun Toko</a></div>
                        </div>
                    </div>
                </div>
                <div class="row profil-toko">
                    <div class="col-12 d-profil">
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="frame-img">
                                            <img src="assets/img/patner/icon-toko/<?= $rowToko['logo_img'] ?>" width="100%"
                                                alt="Patner Image">
                                        </div>
                                    </div>
                                    <div class="col-8 data-patner">
                                        <div class="row align-items-center">
                                            <div class="col-10 nama-toko">
                                                <h5><?= $rowToko['nama_toko']?></h5>
                                            </div>
                                            <div class="col-2 d-btn-edit">
                                                <a href="form-edit-toko?it=<?=$rowIDToko['id_toko']?>" class="btn">
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
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.41" height="14.41"
                                                        viewBox="0 0 228.124 299.41">
                                                        <g transform="translate(0.125 0.125)">
                                                            <path
                                                                d="M1389.937,146.123A114.076,114.076,0,0,0,1276,260.06c0,40.562,12.344,56.817,71.628,134.977,10.291,13.577,21.952,28.94,35.3,46.733a8.746,8.746,0,0,0,14.016,0c13.272-17.7,24.895-33,35.13-46.524,59.438-78.389,71.8-94.7,71.8-135.186A114.076,114.076,0,0,0,1389.937,146.123Zm28.181,238.527c-8.431,11.109-17.757,23.414-28.181,37.276-10.5-13.938-19.882-26.32-28.353-37.485-57.67-76.015-68.058-89.726-68.058-124.381a96.41,96.41,0,0,1,192.82,0C1486.347,294.659,1475.92,308.388,1418.118,384.65Z"
                                                                transform="translate(-1276 -146.123)" fill="#426a5a"
                                                                stroke="#426a5a" stroke-miterlimit="10"
                                                                stroke-width="0.25" />
                                                            <path
                                                                d="M1340.125,148.892a61.355,61.355,0,1,0,61.354,61.355A61.438,61.438,0,0,0,1340.125,148.892Zm0,105.183a43.828,43.828,0,1,1,43.827-43.828A43.881,43.881,0,0,1,1340.125,254.075Z"
                                                                transform="translate(-1226.187 -96.31)" fill="#426a5a"
                                                                stroke="#426a5a" stroke-miterlimit="10"
                                                                stroke-width="0.25" />
                                                        </g>
                                                    </svg>
                                                    <?=$rowToko['kota']?>
                                                </span>
                                            </div>
                                            <div class="col-6">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.41" height="14.41"
                                                        viewBox="0 0 500 500">
                                                        <g transform="translate(-2612 -3275)">
                                                            <rect width="500" height="500"
                                                                transform="translate(2612 3275)" fill="none" />
                                                            <path
                                                                d="M1706.854,209.053a8.607,8.607,0,0,0-.892-1.424c-.209-.342-.361-.646-.589-.95a9.126,9.126,0,0,0-3.95-3.057l-.132-.095-151.727-56.874a9.243,9.243,0,0,0-7.046.133L1409.763,203.66c-.132.057-.188.209-.321.266a9.178,9.178,0,0,0-3.323,2.791,10.077,10.077,0,0,0-.722,1.025,7.489,7.489,0,0,0-.626.911,9.509,9.509,0,0,0-.76,3.722v170.7a9.507,9.507,0,0,0,5.752,8.735L1542.52,448.7h.02a9.449,9.449,0,0,0,7.045.152l.342-.133h.019l151.365-56.76a9.493,9.493,0,0,0,6.153-8.887V212.4c0-.171-.133-.285-.133-.437A9.7,9.7,0,0,0,1706.854,209.053Zm-160.367-43.315L1670.964,212.4l-29.68,11.128-53.208-23.832a9.336,9.336,0,0,0-8.337.323l-37.182,15.8a9.5,9.5,0,0,0,.1,17.527l34.5,14.242-30.671,11.488-108.9-46.676Zm56.7,72.065-32.434-13.369,13.425-5.716,31.865,14.261Zm9.438,16.711,18.97-7.1v46.2l-18.97,7.121ZM1422.98,226.789l113.785,48.765V425.59L1422.98,376.825Zm132.756,199.5V275.858l37.921-14.223v52.791a9.449,9.449,0,0,0,9.5,9.475,9.713,9.713,0,0,0,3.343-.608l37.923-14.223a9.486,9.486,0,0,0,6.152-8.868V240.291l37.921-14.223V376.5Z"
                                                                transform="translate(1306.989 3226.979)"
                                                                fill="#426a5a" />
                                                        </g>
                                                    </svg>
                                                    0 Terjual
                                                </span>
                                            </div>
                                            <div class="col-6">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.41" height="14.41"
                                                        viewBox="0 0 500 500">
                                                        <g transform="translate(-1883 -2089)">
                                                            <rect width="500" height="500"
                                                                transform="translate(1883 2089)" fill="none" />
                                                            <path
                                                                d="M1501.924,330.293a132.375,132.375,0,0,0-51.479-32.016,71.7,71.7,0,1,0-85.036,0A133.13,133.13,0,0,0,1275,424.272a10.458,10.458,0,0,0,10.464,10.463H1530.39a10.458,10.458,0,0,0,10.464-10.463A132.053,132.053,0,0,0,1501.924,330.293Zm-144.755-89.706a50.758,50.758,0,1,1,50.758,50.759A50.813,50.813,0,0,1,1357.169,240.586ZM1296.42,413.808a112,112,0,0,1,223.013,0Z"
                                                                transform="translate(725 2037.099)" fill="#426a5a" />
                                                        </g>
                                                    </svg>
                                                    0 K Followers
                                                </span>
                                            </div>
                                            <div class="col-6">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.41" height="14.41"
                                                        viewBox="0 0 500 500">
                                                        <g transform="translate(-2609 -2089)">
                                                            <rect width="500" height="500"
                                                                transform="translate(2609 2089)" fill="none" />
                                                            <path
                                                                d="M1712.914,280.714a9.14,9.14,0,0,0-7.329-6.19L1609.5,260.566,1566.524,173.5a9.077,9.077,0,0,0-16.29,0l-42.976,87.067-96.086,13.957a9.086,9.086,0,0,0-5.032,15.5l69.521,67.773L1459.255,453.5a9.074,9.074,0,0,0,13.178,9.571l85.947-45.176,85.946,45.176a8.935,8.935,0,0,0,4.216,1.044,9.066,9.066,0,0,0,8.942-10.615l-16.407-95.707,69.541-67.773A9.1,9.1,0,0,0,1712.914,280.714Zm-87.939,67.413a9.092,9.092,0,0,0-2.6,8.032l14.109,82.281L1562.6,399.588a9.109,9.109,0,0,0-8.452,0l-73.868,38.852,14.091-82.281a9.037,9.037,0,0,0-2.6-8.032l-59.778-58.26,82.6-12.021a9.013,9.013,0,0,0,6.835-4.956l36.955-74.856,36.934,74.856a9.05,9.05,0,0,0,6.836,4.956l82.605,12.021Z"
                                                                transform="translate(1300.6 2022.571)" fill="#426a5a" />
                                                        </g>
                                                    </svg>
                                                    0 Bintang
                                                </span>
                                            </div>
                                            <div class="col-6">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.41" height="14.41"
                                                        viewBox="0 0 500 500">
                                                        <g transform="translate(-2609 -2715)">
                                                            <rect width="500" height="500"
                                                                transform="translate(2609 2715)" fill="none" />
                                                            <g transform="translate(2703 2809)">
                                                                <path
                                                                    d="M1348.913,478.774a154.652,154.652,0,0,0,79.833,22.1c85.641,0,156.244-69.881,156.244-155.638,0-85.643-70.508-155.638-156.244-155.638-85.491,0-155.03,69.825-155.03,155.638a155.86,155.86,0,0,0,22.1,80.439L1273.6,500.991ZM1291.944,345.24c0-75.768,61.376-137.389,136.8-137.389,76.091,0,137.994,61.621,137.994,137.389s-61.9,137.408-137.994,137.408a136.358,136.358,0,0,1-73.586-21.458l-3.493-2.241-51.083,15.059,15.06-51.081-2.241-3.494a137.392,137.392,0,0,1-21.458-74.192Zm0,0"
                                                                    transform="translate(-1273.602 -189.602)"
                                                                    fill="#426a5a" />
                                                                <path
                                                                    d="M1279.62,263.182c3,15.818,11.945,46.24,37.979,72.274s56.456,34.979,72.292,38c18.116,3.456,44.7,3.969,57.689-9.02l7.235-7.254a19.321,19.321,0,0,0,0-27.364l-28.957-28.978a19.393,19.393,0,0,0-27.383,0l-7.235,7.235c-4.426,4.425-12.782,4.444-17.244.057l-28.883-30.1-.133-.133a11.381,11.381,0,0,1,0-16.065l7.235-7.254a19.334,19.334,0,0,0,0-27.382l-28.96-28.959a19.369,19.369,0,0,0-27.383,0l-7.234,7.235h0c-10.368,10.368-13.843,32.491-9.02,57.709Zm21.916-44.815c7.593-7.425,7.194-7.558,8.031-7.558a1.185,1.185,0,0,1,.8.323c30.515,30.687,29.3,28.883,29.3,29.757a1.037,1.037,0,0,1-.34.8l-7.235,7.254a29.558,29.558,0,0,0-.077,41.777l28.9,30.136.133.133c11.547,11.527,31.524,11.565,43.089,0l7.234-7.254a1.134,1.134,0,0,1,1.595,0c30.517,30.687,29.3,28.883,29.3,29.776a1.029,1.029,0,0,1-.344.779l-7.235,7.254c-4.956,4.956-20.773,7.919-41.4,3.988-13.749-2.621-40.219-10.387-62.8-32.966s-30.344-49.031-32.965-62.8c-3.932-20.622-.969-36.422,4.009-41.4Zm0,0"
                                                                    transform="translate(-1203.816 -136.218)"
                                                                    fill="#426a5a" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <a href="https://api.whatsapp.com/send?phone=62<?php echo $rowToko['no_telp']; ?>" target="_blank"><?php echo $rowToko['no_telp']; ?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 text-center">
                                                <button class="btn btn-follow">Follow</button>
                                            </div>
                                            <div class="col-6 text-center">
                                                <span style="display:none;" id="link"><?= $rowToko['sub-domain'] ?>.bestoremall.com</span>
                                            <button class="btn btn-web" onclick="copyToClipboard('#link')">My Web</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row text-center justify-content-between">
                            <div class="col-12 store-nav active">
                                <div class="btn-store">
                                    <a href="#">
                                        <svg fill="#426a5a" id="Capa_1" width="0.2400in" height="0.4200in"
                                            enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path
                                                    d="m504.5 447.435h-32.246v-243.333c9.374-1.342 16.61-9.401 16.61-19.14v-29.126c0-10.674-8.685-19.359-19.359-19.359h-82.432v-17.499h16.116c9.353 0 16.962-7.609 16.962-16.963v-35.488c0-9.353-7.609-16.962-16.962-16.962h-104.207c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h104.207c1.082 0 1.962.88 1.962 1.962v35.487c0 1.083-.88 1.963-1.962 1.963h-305.666c-1.083 0-1.963-.88-1.963-1.963v-35.487c0-1.082.88-1.962 1.963-1.962h174.252c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-174.252c-9.354 0-16.963 7.609-16.963 16.962v35.487c0 9.354 7.609 16.963 16.963 16.963h27.404v17.499h-82.432c-10.674 0-19.359 8.685-19.359 19.359v29.126c0 9.739 7.236 17.798 16.61 19.14v243.333h-32.246c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h497c4.142 0 7.5-3.358 7.5-7.5 0-4.141-3.358-7.499-7.5-7.499zm-47.246-55.361h-60.544v-128.503h60.544zm-85.181-255.597h-15.397v-17.499h15.397zm-201.748 0v-17.499h171.351v17.499zm-30.398-17.499h15.397v17.499h-15.397zm-101.791 65.984v-29.126c0-2.403 1.956-4.359 4.359-4.359h427.01c2.403 0 4.359 1.956 4.359 4.359v29.126c0 2.403-1.956 4.358-4.359 4.358h-275.367c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h263.116v44.251h-68.044c-4.142 0-7.5 3.358-7.5 7.5v113.015h-33.504v-113.015c0-4.142-3.358-7.5-7.5-7.5h-169.412c-4.142 0-7.5 3.358-7.5 7.5v113.015h-33.504v-113.015c0-4.142-3.358-7.5-7.5-7.5h-68.043v-44.251h112.184c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-124.436c-2.403 0-4.359-1.955-4.359-4.358zm16.611 78.609h60.543v128.503h-60.543zm0 143.503h68.043c4.142 0 7.5-3.358 7.5-7.5v-15.488h33.504v63.35h-109.047zm124.047-143.503h69.706v183.864h-69.706zm84.706 183.864v-183.864h69.706v183.864zm84.706 0v-63.35h33.504v15.488c0 4.142 3.358 7.5 7.5 7.5h68.044v40.361h-109.048z" />
                                                <path
                                                    d="m218.209 347.949c-4.142 0-7.5 3.358-7.5 7.5v13.278c0 4.142 3.358 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-13.278c0-4.142-3.358-7.5-7.5-7.5z" />
                                                <path
                                                    d="m293.791 347.949c-4.142 0-7.5 3.358-7.5 7.5v13.278c0 4.142 3.358 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-13.278c0-4.142-3.357-7.5-7.5-7.5z" />
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end banner-toko">
                    <div class="col-12">
                        <!-- Begin:Banner -->
                        <div class="row justify-content-center">
                            <div class="col-12 slide">
                                <div class="swiper-container container-banner-toko">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide"><img src="assets/img/banner/banner-2-round.jpg"
                                                alt="">
                                        </div>
                                        <div class="swiper-slide"><img src="assets/img/banner/banner-2-round.jpg"
                                                alt="">
                                        </div>
                                        <div class="swiper-slide"><img src="assets/img/banner/banner-2-round.jpg"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End:Banner -->
                    </div>
                </div>

                <!-- Begin::Menu -->
                <div class="row bar-menu fixed-bottom">
                    <div class="col-12">
                        <div class="row justify-content-between">
                            <div class="col-2 text-center div-menu">
                                <a href="index">
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
                                <a href="feed">
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
                                    <svg width="0.2800in" height="0.2800in" fill="#426a5a" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
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

                <!-- Begin:Bestore Product -->
                <div class="row mt-5 justify-content-end product">
                    <div class="col-11 kategori-judul">
                        <div class="row">
                            <div class="col-8">
                                <h4>Bestore Product</h4>
                            </div>
                            <div class="col-4 text-center">
                                <a href="official-produk">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-11 slide">
                        <div class="swiper-container container-product">
                            <div class="swiper-wrapper">
                                <!-- Begin::BestoreProduct -->
                                <?php
                                    while ($rowPB =mysqli_fetch_assoc($bProdukBestore)) {
                                        $imgProduk = $kueriMall->bImgProduk($rowPB['id_produk']);
                                        $rowPBM = mysqli_fetch_assoc($imgProduk);
                                ?>
                                <div class="swiper-slide">
                                    <a href="detail-produk?i=<?= $rowPB['id_produk']?>">
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
                                                <img src="assets/img/product/<?= $rowPBM['nama_folder']?>/<?= $rowPBM['nama_img']?>" width="100%"
                                                    alt="Img-Product">
                                            </div>
                                            <div class="col-12 etc-product">
                                                <p><?= $rowPB['nama_produk']?></p>
                                                <h6>Rp. <?=number_format($rowPB['harga'],0,",",".");?></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php } ?>
                                <!-- End::BestoreProduct -->
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:Bestore Product -->
                <div class="row mt-3 banner-utama-bawah">
                    <div class="col-12 slide">
                        <img src="assets/img/banner/banner home.svg" width="100%" alt="Banner 2">
                    </div>
                </div>

                <!-- Begin::My Product -->
                <div class="row mb-5 my-web-product justify-content-center">
                    <div class="col-11">
                        <div class="row product-card justify-content-around">
                            
                            <div class="col-5 bungkus-product">
                                <div class="row des-product align-items-center">
                                    <div class="col-12 img-product text-center">
                                        <a href="form-kategori-produk?it=<?= $rowIDToko['id_toko']?>">
                                            <img src="assets/img/product/patner/upload-image.svg" width="80%"
                                                alt="Img-Product">
                                        </a>
                                    </div>
                                    <div class="col-12 etc-product">
                                            <p>&nbsp;</p>
                                            <h6>&nbsp;</h6>
                                    </div>
                                </div>
                            </div>

                            <?php
                                while ($rowPP = mysqli_fetch_assoc($bProdukPatner)) {
                                    $imgProduk2 = $kueriMall->bImgProduk($rowPP['id_produk']);
                                    $rowPPM = mysqli_fetch_assoc($imgProduk2);
                            ?>
                            <div class="col-5 bungkus-product">
                                <div class="row des-product">
                                    <div class="col-12 img-product text-center">
                                        <a href="detail-produk-ku?i=<?=$rowPP['id_produk']?>">
                                            <img src="assets/img/product/<?= $rowPPM['nama_folder'] ?>/<?= $rowPPM['nama_img'] ?>" width="100%"
                                                alt="Img-Product">
                                        </a>
                                    </div>
                                    <div class="col-12 etc-product">
                                            <p><?=$rowPP['nama_produk']?></p>
                                            <h6>Rp. <?=number_format($rowPP['harga'],0,",",".");?></h6>
                                    </div>
                                </div>
                            </div>
                            <?php }?>

                            

                        </div>
                    </div>
                </div>
                <!-- End::My Product -->
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
    <script type="module">
        import Swiper from 'https://unpkg.com/swiper/swiper-bundle.esm.browser.min.js'

        // Banner
        var swiper = new Swiper('.container-banner-toko', {
            slidesPerView: 'auto',
            centeredSlides: true,
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination-banner',
                clickable: true,
            },
        });
        //Slide lainnnya
        var swiper = new Swiper('.container-kategori', {
            slidesPerView: 'auto',
            // centeredSlides: true,
            freeMode: true,
            spaceBetween: 15,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
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

    <!-- Untuk Kembali Kehalaman Sebelumnya -->
    <script>
        function goBack() {
            window.history.back();
        }

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            alert("Link Toko Berhasil Disalin");
        }
    </script>
    <!-- Untuk Kembali Kehalaman Sebelumnya -->
    <!-- Initialize Swiper -->
</body>

</html>