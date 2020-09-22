<?php
    require 'kueri-mall.php';
    $kueriMall = new kueriMall();

    // Cek Session
    session_start();
    if (!isset($_SESSION['id_patner'])) { //Cek Session Patner
        header('Location:login');
    }
    // =============================================================
    $bProdukBestore = $kueriMall->bProdukBestore(); //Baca Product Bestore //File di kueri-mall.php

    // Baca Data Keranjang
    // $bKeranjang = $kueriMall->bKeranjang($_SESSION['id_patner']);
    $bKeranjangToko = $kueriMall->bKeranjangToko($_SESSION['id_patner']);
    

    // Baca Harga
    $bTotalH = $kueriMall->bTotalH($_SESSION['id_patner']);
    $tHarga = mysqli_fetch_assoc($bTotalH);
    // --------------------------------------
    $totalKeranjang = mysqli_num_rows($bKeranjangToko); //Hitung Total Isi Keranjang
    if ($totalKeranjang == 0) {
        echo "<script>alert('Yah, Keranjang Kosong :(')</script>";
    } 

    if (isset($_POST['hapus_produk'])) {
        $hapusP = $kueriMall->hapusProduk($_POST['id_produk']); 
        if ($hapusP == "Berhasil") {
            echo "<script>alert('Berhasil Menghapus')</script>";
            header("location:keranjang");
        }else{
            echo "<script>alert('Gagal Menghapus')</script>";
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
    <link rel="stylesheet" href="assets/css/keranjang.css">
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
            <div class="container d-keranjang">
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
                            <div class="col-10">
                                <h5>Keranjang</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Begin::Menu -->
                <div class="row bar-menu fixed-bottom">
                    <div class="col-12 subtotal">
                        <div class="row justify-content-center">
                            <div class="col-5">
                                <span>
                                    <h5>Total Harga</h5>
                                    <h5>Rp<?=number_format($tHarga['total_harga'],0,",",".");?></h5>
                                </span>
                            </div>
                            <div class="col-5 text-right">
                                <a href="checkout" class="btn btn-beli">Beli</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row justify-content-between">
                            <div class="col-2 text-center div-menu">
                                <a href="index">
                                    <svg width="0.2800in" height="0.2800in" fill="#777" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 511.999 511.999"
                                        style="enable-background:new 0 0 511.999 511.999;" xml:space="preserve">
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
                                    <svg fill="#46715E" width="0.2800in" height="0.2800in" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 512.001 512.001"
                                        style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M503.142,79.784c-7.303-8.857-18.128-13.933-29.696-13.933H176.37c-6.085,0-11.023,4.938-11.023,11.023
                                                    c0,6.085,4.938,11.023,11.023,11.023h297.07c5.032,0,9.541,2.1,12.688,5.914c3.197,3.88,4.475,8.995,3.511,13.972l-44.054,220.282
                                                    c-1.709,7.871-8.383,13.366-16.232,13.366H184.323L83.158,36.854C77.69,21.234,62.886,10.74,45.932,10.74
                                                    c-0.005,0-0.011,0-0.017,0c-14.38,0.496-28.963,0.491-32.535,0.248c-3.555-0.772-7.397,0.22-10.152,2.976
                                                    c-4.305,4.305-4.305,11.282,0,15.587c3.412,3.412,4.564,4.564,43.068,3.23c7.22,0,13.674,4.564,15.995,11.188l103.618,311.962
                                                    c1.499,4.503,5.71,7.545,10.461,7.545h252.982c18.31,0,33.841-12.638,37.815-30.909l44.109-220.525
                                                    C513.503,100.513,510.544,88.757,503.142,79.784z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M424.392,424.11H223.77c-6.785,0-13.162-4.674-15.46-11.233l-21.495-63.935c-1.94-5.771-8.207-8.885-13.961-6.934
                                                        c-5.771,1.935-8.874,8.19-6.934,13.961l21.539,64.061c5.473,15.625,20.062,26.119,36.31,26.119h200.622
                                                        c6.085,0,11.023-4.933,11.023-11.018S430.477,424.11,424.392,424.11z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M231.486,424.104c-21.275,0-38.581,17.312-38.581,38.581s17.306,38.581,38.581,38.581s38.581-17.312,38.581-38.581
                                                        S252.761,424.104,231.486,424.104z M231.486,479.22c-9.116,0-16.535-7.419-16.535-16.535c0-9.116,7.419-16.535,16.535-16.535
                                                        c9.116,0,16.535,7.419,16.535,16.535C248.021,471.802,240.602,479.22,231.486,479.22z" />
                                                                                        </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path
                                                    d="M424.392,424.104c-21.269,0-38.581,17.312-38.581,38.581s17.312,38.581,38.581,38.581
                                                        c21.269,0,38.581-17.312,38.581-38.581S445.661,424.104,424.392,424.104z M424.392,479.22c-9.116,0-16.535-7.419-16.535-16.535
                                                        c0-9.116,7.419-16.535,16.535-16.535c9.116,0,16.535,7.419,16.535,16.535C440.927,471.802,433.508,479.22,424.392,479.22z" />
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
                                    <span>Cart</span>
                                </a>
                            </div>
                            <div class="col-2 text-center div-menu">
                                <a href="my-web">
                                    <img src="assets/img/svg/bar-control/ecommerce.svg" width="70%" alt="bar-img">
                                    <span>My Store</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End::Menu -->

                <!-- Begin::Keranjang -->
                <div class="row">
                    <div class="col-12">
                        <?php 
                            while ($rowKT = mysqli_fetch_assoc($bKeranjangToko)) { 
                                $baca_toko = $kueriMall->bTokoD($rowKT['id_toko']);
                                $rowToko = mysqli_fetch_assoc($baca_toko);
                                $baca_keranjang = $kueriMall->bKeranjang($_SESSION['id_patner'], $rowKT['id_toko']);
                        ?>
                        <div class="row list-belanja">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-12 toko">
                                        <div class="row align-items-center">
                                            <div class="col-2 text-center">
                                                <label class="c-checkout">
                                                    <input type="checkbox" onclick="checkAll(this)" checked="checked">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-10">
                                                <div class="row justify-content-center align-items-center">
                                                    <div class="col-3">
                                                        <div class="frame-img">
                                                            <img src="assets/img/patner/icon-toko/<?=$rowToko['nama_folder']?>/<?=$rowToko['logo_img']?>"
                                                                width="100%" alt="Logo-Toko">
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5><?= $rowToko['nama_toko'] ?></h5>
                                                        <p>Kota Jakarta</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        $quant = 1; 
                                        while ($rowPK = mysqli_fetch_assoc($baca_keranjang)) {
                                            $imgProduk = $kueriMall->bImgProduk($rowPK['id_produk']);
                                            $rowPBM = mysqli_fetch_assoc($imgProduk);
                                    ?>
                                    <div class="col-12 produk-toko mt-4">
                                        <div class="row align-items-center">
                                            <div class="col-2 text-center">
                                                <label class="c-checkout">
                                                    <input type="checkbox" name="check_list[]" checked="checked">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="frame-img">
                                                            <img src="assets/img/product/<?=$rowPBM['nama_folder']?>/<?=$rowPBM['nama_img']?>"
                                                                width="100%" alt="Logo-Toko">
                                                        </div>
                                                    </div>
                                                    <div class="col-8 deskripsi-produk">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <span><?= $rowPK['nama_produk'] ?></span>
                                                                <h5>Rp. <?= number_format($rowPK['harga'],0,",","."); ?></h5>
                                                                <span class="control-qty">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                            <button type="button" class="btn btn-number"
                                                                                disabled="disabled" data-type="minus"
                                                                                data-field="quant[<?=$quant?>]">
                                                                                <span>
                                                                                    <svg fill="#46715E"
                                                                                        height="0.1400in"
                                                                                        viewBox="0 -192 469.33333 469"
                                                                                        width="0.1400in"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <path
                                                                                            d="m437.332031.167969h-405.332031c-17.664062 0-32 14.335937-32 32v21.332031c0 17.664062 14.335938 32 32 32h405.332031c17.664063 0 32-14.335938 32-32v-21.332031c0-17.664063-14.335937-32-32-32zm0 0" />
                                                                                    </svg>
                                                                                </span>
                                                                            </button>
                                                                        </span>
                                                                        <input type="text" name="quant[<?=$quant?>]"
                                                                            class="form-control input-number" value="<?=$rowPK['qty']?>"
                                                                            min="1" max="1000">
                                                                        <span class="input-group-btn">
                                                                            <button type="button" class="btn btn-number"
                                                                                data-type="plus" data-field="quant[<?=$quant?>]">
                                                                                <span>
                                                                                    <svg fill="#46715E"
                                                                                        height="0.1400in"
                                                                                        viewBox="0 0 469.33333 469.33333"
                                                                                        width="0.1400in"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <path
                                                                                            d="m437.332031 192h-160v-160c0-17.664062-14.335937-32-32-32h-21.332031c-17.664062 0-32 14.335938-32 32v160h-160c-17.664062 0-32 14.335938-32 32v21.332031c0 17.664063 14.335938 32 32 32h160v160c0 17.664063 14.335938 32 32 32h21.332031c17.664063 0 32-14.335937 32-32v-160h160c17.664063 0 32-14.335937 32-32v-21.332031c0-17.664062-14.335937-32-32-32zm0 0" />
                                                                                    </svg>
                                                                                </span>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                            <div class="col-4">
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="id_produk" value="<?=$rowPK['id_produk']?>">
                                                                    <button type="submit" name="hapus_produk" class="btn btn-delete">
                                                                        <svg fill="#46715E" version="1.1" id="Capa_1"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            x="0px" y="0px" viewBox="0 0 298.667 298.667"
                                                                            style="enable-background:new 0 0 298.667 298.667;"
                                                                            xml:space="preserve">
                                                                            <g>
                                                                                <g>
                                                                                    <polygon points="298.667,30.187 268.48,0 149.333,119.147 30.187,0 0,30.187 119.147,149.333 0,268.48 30.187,298.667 
                                                                                        149.333,179.52 268.48,298.667 298.667,268.48 179.52,149.333 		" />
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
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $quant++; } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-4 banner-utama-bawah">
                            <div class="col-12 slide">
                                <img src="assets/img/banner/banner home.svg" width="100%" alt="Banner 2">
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
                <!-- Begin::Keranjang -->

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
                                <!-- Slide Product -->
                                <?php
                                    while ($rowPB=mysqli_fetch_assoc($bProdukBestore)) {
                                        $imgProduk = $kueriMall->bImgProduk($rowPB['id_produk']);
                                        $rowPBM = mysqli_fetch_assoc($imgProduk);
                                ?>
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
                                            <img src="assets/img/product/<?=$rowPBM['nama_folder']?>/<?=$rowPBM['nama_img']?>" width="100%"
                                                alt="Img-Product">
                                        </div>
                                        <div class="col-12 etc-product">
                                            <p><?=$rowPB['nama_produk']?></p>
                                            <h6>Rp<?=number_format($rowPB['harga'],0,",",".");?></h6>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- Slide Product -->
                                
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