<?php
    error_reporting(0);
    require 'kueri-main.php';
    require 'kueri-mall.php';
    $kueriMain = new kueri();
    $kueriMall = new kueriMall();

    // Cek Session
    session_start();
    if (!isset($_SESSION['id_patner'])) { //Cek Session Patner
        header('Location:login');
    }
    $statusInvoice = 1; //belum dikonfirmasi
    $bInvoice = $kueriMall->bInvoiceID();
    $total_invoice = mysqli_num_rows($bInvoice); //total id
    $rowInvoice = mysqli_fetch_assoc($bInvoice); //array iD
    // if ($bInvoice > 1) {
    //     // $dInvoice = $kueriMall->dInvoice($_SESSION['id_patner'], $statusInvoice);
        
    // }
    // =============================================================
    // Baca Diri
    $bDiri = $kueriMain->bDiri($_SESSION['id_patner']);
    $bTotalH = $kueriMall->bTotalH($_SESSION['id_patner']);
    $rowDiri = mysqli_fetch_assoc($bDiri);
    $tHarga = mysqli_fetch_assoc($bTotalH);

    if (!isset($_GET['kurir'])) {
        $ongkir = 0;
    }elseif ($_GET['kurir'] == 'jne') {
        $ongkir = 30000;
    }elseif ($_GET['kurir'] == 'pos') {
        $ongkir = 28000;
    }elseif ($_GET['kurir'] == 'tiki') {
        $ongkir = 32000;
    }

    
    if (isset($_POST['bayar'])) {
        if ($ongkir == 0) {
            echo "<script>alert('Kurir Belum Dipilih!')</script>";
        }elseif ($rowDiri['no_hp'] == 0) {
            echo "<script>alert('Nomor Telepon Masih Kosong!')</script>";
        }else{
            // ==================
            // Input Invoice
            $idV = $rowInvoice['id_invoice'];
            if ($idV == 0) {
                $idV = 1;
            }else{
                $idV = substr($idV,6) + 1;
            } 
            $tgl = substr(date('Ymd'),2,6); //subs tgl jadi tahun bulan(2009)
            $id_invoice = $tgl.$idV;
            $generate_angka = mt_rand(758, 900);
            $metode_bayar = "BCA";
            $tgl_batas = date('Y-m-d H:i:s', strtotime("+1 day", strtotime(date("Y-m-d H:i:s"))));
            $iInvoice = $kueriMall->iInvoice($id_invoice, $_SESSION['id_patner'], $ongkir, $tHarga['total_harga'], $generate_angka, $_GET['kurir'], $metode_bayar, $tgl_batas); //Memasukkan tb_invoice
            if ($iInvoice == "Berhasil") { //Berhasil Memasukkan ke Invoice lanjut tb Transaksi
                
                // Baca Produk dikeranjang
                $bKeranjangP = $kueriMall->bKeranjangP($_SESSION['id_patner']);
                $tProduk = mysqli_num_rows($bKeranjangP);

                $statusTransaksi = 1;
                $bTransaksi = $kueriMall->bTransaksiID();
                $rowTransaksi = mysqli_fetch_assoc($bTransaksi);
                if ($rowTransaksi['id_transaksi'] == 0) {
                    $idT = 1;
                }else{
                    $idT = substr($rowTransaksi['id_transaksi'],6) + 1;
                }
                
                while ($rowProduk = mysqli_fetch_assoc($bKeranjangP)) {
                    // ==================
                    // Input Transaksi
                    
                    
                    $tgl = substr(date('Ymd'),2,6); //subs tgl jadi tahun bulan(2009)
                    $id_transaksi = $tgl.$idT;
                    //=================================================================
                    $id_produk = $rowProduk['id_produk'];
                    for ($i=0; $i < $tProduk ; $i++) {
                        $iTransaksi = $kueriMall->iTransaksi($id_transaksi, $id_produk, $_SESSION['id_patner'], $id_invoice, 1, $rowProduk['qty']);
                    }

                    if ($iTransaksi == "Berhasil") {
                        echo "<script>alert('Lakukkan Pembayaran Sekarang!'); window.location='pembayaran?iv=".$id_invoice."';</script>";
                    }else{
                        echo "<script>alert('Lakukkan Pembayaran Sekarang!'); window.location='pembayaran?iv=".$id_invoice."';</script>";
                    }
                    $idT++;
                }
            }else{
                echo "<script>alert('Gagal Memasukkan Invoice!');window.location='checkout';</script>";
            }
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
    <link rel="stylesheet" href="assets/css/checkout.css">
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
            <div class="container d-checkout">
                <div class="row mb-4 justify-content-center nav-top">
                    <div class="col-11 div-nav">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <!-- <button class="btn btn-back" onclick="goBack()">
                                    <svg width="0.2400in" height="0.4400in" id="Capa_1"
                                        enable-background="new 0 0 482.239 482.239" height="512"
                                        viewBox="0 0 482.239 482.239" width="512" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m206.812 34.446-206.812 206.673 206.743 206.674 24.353-24.284-165.167-165.167h416.31v-34.445h-416.31l165.236-165.236z" />
                                    </svg>
                                </button> -->
                                <a href="keranjang" class="btn btn-back">
                                    <svg width="0.2400in" height="0.4400in" id="Capa_1"
                                        enable-background="new 0 0 482.239 482.239" height="512"
                                        viewBox="0 0 482.239 482.239" width="512" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m206.812 34.446-206.812 206.673 206.743 206.674 24.353-24.284-165.167-165.167h416.31v-34.445h-416.31l165.236-165.236z" />
                                    </svg>
                                </a>
                            </div>
                            <div class="col-10">
                                <h5>
                                    Pengiriman
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout -->
                <div class="row card-all">
                    <!-- div alamat -->
                    <div class="col-12 data-card">
                        <div class="row justify-content-center">
                            <div class="col-11 head">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <h6>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="0.2300in" height="0.2300in" viewBox="0 0 500 500">
                                                <g id="Group_1700" data-name="Group 1700" transform="translate(-3315 -3920)">
                                                  <rect id="Rectangle_695" data-name="Rectangle 695" width="500" height="500" transform="translate(3315 3920)" fill="none"/>
                                                  <g id="product" transform="translate(3371.953 3990.012)">
                                                    <g id="Group_58" data-name="Group 58" transform="translate(0 0)">
                                                      <path id="Path_234" data-name="Path 234" d="M371.149,180.485H351.7a19.152,19.152,0,0,0-18.28-14.051H312.667v-50.76a5.355,5.355,0,0,0-2.612-4.732L163.626,26.366a5.407,5.407,0,0,0-5.435,0L11.717,110.942A5.449,5.449,0,0,0,9,115.674V284.825a5.464,5.464,0,0,0,2.732,4.732l146.489,84.575a5.465,5.465,0,0,0,2.732.732,5.748,5.748,0,0,0,2.81-.732l77.085-44.463v32.142a23.139,23.139,0,0,0,23.334,23.2H371.149a23.268,23.268,0,0,0,23.485-23.2V204.046A23.575,23.575,0,0,0,371.149,180.485Zm-37.53-3.122a7.932,7.932,0,0,1,7.932,7.932v.529a7.932,7.932,0,0,1-7.932,7.932H301.864a7.932,7.932,0,0,1-7.932-7.932v-.529a7.932,7.932,0,0,1,7.932-7.932ZM160.954,37.408l60.869,35.143L86.272,150.811,25.4,115.668Zm-5.194,322.527L19.929,281.67V125.126l135.83,78.266Zm5.194-166.008L97.2,157.12,232.752,78.861l63.756,36.808Zm79.895,10.119V317.052l-74.16,42.884V203.392l135.05-78.266v41.307h.169a19.151,19.151,0,0,0-18.28,14.051H264.182A23.448,23.448,0,0,0,240.848,204.046ZM383.7,361.812a12.328,12.328,0,0,1-12.556,12.27H264.182a12.2,12.2,0,0,1-12.405-12.27V204.046a12.507,12.507,0,0,1,12.405-12.632H283.84a18.692,18.692,0,0,0,18.067,13.271h31.517a18.69,18.69,0,0,0,18.066-13.271h19.659A12.635,12.635,0,0,1,383.7,204.046Z" transform="translate(-9 -25.634)" fill="#426a5a"/>
                                                      <path id="Path_235" data-name="Path 235" d="M342.424,314.689h5.719a5.464,5.464,0,1,0,0-10.929h-.215V288.928H363a5.26,5.26,0,0,0,5.195,3.691,5.479,5.479,0,0,0,5.494-5.453V283.49a5.536,5.536,0,0,0-5.523-5.49H342.424A5.454,5.454,0,0,0,337,283.49v25.741a5.426,5.426,0,0,0,5.424,5.458Z" transform="translate(-80.952 -80.995)" fill="#426a5a"/>
                                                      <path id="Path_236" data-name="Path 236" d="M342.465,378.69h25.761a5.464,5.464,0,0,0,5.465-5.464V347.465A5.464,5.464,0,0,0,368.226,342H342.465A5.464,5.464,0,0,0,337,347.465v25.761A5.464,5.464,0,0,0,342.465,378.69Zm5.465-25.761h14.832v14.832H347.929Z" transform="translate(-80.951 -95.035)" fill="#426a5a"/>
                                                      <path id="Path_237" data-name="Path 237" d="M348.145,431.761h-.217V416.929h14.777a5.493,5.493,0,1,0,10.985.011l0-5.265A5.7,5.7,0,0,0,368.167,406H342.425A5.614,5.614,0,0,0,337,411.675v25.74a5.273,5.273,0,0,0,5.425,5.275h5.721a5.464,5.464,0,0,0,0-10.929Z" transform="translate(-80.95 -109.074)" fill="#426a5a"/>
                                                      <path id="Path_238" data-name="Path 238" d="M384.555,286.141l-16,16-4.868-4.868A5.464,5.464,0,0,0,355.955,305l8.733,8.733a5.464,5.464,0,0,0,7.728,0l19.869-19.869a5.465,5.465,0,1,0-7.729-7.728Z" transform="translate(-84.759 -82.427)" fill="#426a5a"/>
                                                      <path id="Path_239" data-name="Path 239" d="M384.555,415.391l-16,16-4.868-4.868a5.465,5.465,0,0,0-7.728,7.729l8.733,8.732a5.464,5.464,0,0,0,7.728,0l19.869-19.87a5.465,5.465,0,0,0-7.729-7.728Z" transform="translate(-84.759 -110.782)" fill="#426a5a"/>
                                                      <path id="Path_240" data-name="Path 240" d="M453.677,295H419.356a5.464,5.464,0,1,0,0,10.929h34.322a5.464,5.464,0,0,0,0-10.929Z" transform="translate(-97.817 -84.724)" fill="#426a5a"/>
                                                      <path id="Path_241" data-name="Path 241" d="M453.677,359H419.356a5.465,5.465,0,1,0,0,10.929h34.322a5.465,5.465,0,0,0,0-10.929Z" transform="translate(-97.817 -98.764)" fill="#426a5a"/>
                                                      <path id="Path_242" data-name="Path 242" d="M453.677,423H419.356a5.464,5.464,0,1,0,0,10.929h34.322a5.464,5.464,0,0,0,0-10.929Z" transform="translate(-97.817 -112.804)" fill="#426a5a"/>
                                                    </g>
                                                  </g>
                                                </g>
                                              </svg>
                                            Informasi Pengiriman
                                        </h6>
                                    </div>
                                    <div class="col-2">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg fill="#777" height="0.1800in" viewBox="-192 0 512 512" width="0.1800in" xmlns="http://www.w3.org/2000/svg"><path d="m128 256c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/><path d="m128 64c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/><path d="m128 448c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/></svg>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="account">Edit</a>
                                            </div>
                                        </div>
                                        <!-- <button class="btn"><svg fill="#777" height="0.1800in" viewBox="-192 0 512 512" width="0.1800in" xmlns="http://www.w3.org/2000/svg"><path d="m128 256c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/><path d="m128 64c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/><path d="m128 448c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/></svg></button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-11">
                                <div class="row mt-3">
                                    <div class="col-4 judul"><span>Nama : </span></div>
                                    <div class="col-8 data-u"><span><?=$rowDiri['nama_patner']?></span></div>
                                    <div class="col-4 judul"><span>Email :</span></div>
                                    <div class="col-8 data-u"><span><?=$rowDiri['email_patner']?></span></div>
                                    <div class="col-4 judul"><span>No. Telp :</span></div>
                                    <div class="col-8 data-u"><span><?=$rowDiri['no_hp']?></span></div>
                                    <div class="col-4 judul"><span>Alamat Pengiriman :</span></div>
                                    <div class="col-8 data-u"><span><?=$rowDiri['alamat']?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- div alamat -->
                    <!-- div Kurir -->
                    <div class="col-12 data-card mt-4">
                        <div class="row justify-content-center">
                            <div class="col-11 head">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <h6>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="0.2300in" height="0.2300in" viewBox="0 0 500 500">
                                                <g id="Group_1699" data-name="Group 1699" transform="translate(-2557 -3920)">
                                                  <rect id="Rectangle_694" data-name="Rectangle 694" width="500" height="500" transform="translate(2557 3920)" fill="none"/>
                                                  <g id="Group_1695" data-name="Group 1695" transform="translate(2627.622 3990.012)">
                                                    <g id="Send_package" data-name="Send package" transform="translate(0 0)">
                                                      <path id="Path_232" data-name="Path 232" d="M354.459,54h-42V48a6,6,0,0,0-6-6h-48a6,6,0,0,0-6,6V58.313L214.929,48.93a18.071,18.071,0,0,0-9,.078L110.389,74.6a23.783,23.783,0,0,0-13.553,9.774L38.32,50.6a24.011,24.011,0,1,0-24,41.6l106.358,61.4a18,18,0,0,0,9,2.4H231.632a18.084,18.084,0,0,0,8.046-1.9l12.785-6.4V156a6,6,0,0,0,6,6h48a6,6,0,0,0,6-6v-6h42a6,6,0,0,0,6-6V60A6,6,0,0,0,354.459,54ZM234.314,143.4a6.1,6.1,0,0,1-2.682.6H129.684a6,6,0,0,1-3-.8L20.345,81.808A12.041,12.041,0,0,1,16,65.4a12.2,12.2,0,0,1,16.331-4.386L92.774,95.908a23.891,23.891,0,0,0,30.041,25.073l71.547-19.169a6,6,0,1,0-3.1-11.592l-71.553,19.2A12,12,0,1,1,113.5,86.24L209.025,60.6a6,6,0,0,1,3,0l40.438,10.086v63.6Zm66.147,6.6h-36V54h36Zm48-12h-36V66h36Z" transform="translate(-2.305 197.99)" fill="#426a5a"/>
                                                      <path id="Path_233" data-name="Path 233" d="M231.391,53.316l-24-48A6,6,0,0,0,201.992,2H34a6,6,0,0,0-5.37,3.318l-24,48A10.679,10.679,0,0,0,4,56V223.991a6,6,0,0,0,6,6H225.991a6,6,0,0,0,6-6V56A10.682,10.682,0,0,0,231.391,53.316ZM216.283,50H146.674l-9-36h60.6ZM100,62h36v56.29l-15.317-7.662a6,6,0,0,0-5.364,0L100,118.287Zm25.313-48,9,36H101.682l9-36Zm-87.6,0H98.3l-9,36h-69.6ZM219.991,217.991H16V62H88v66a6,6,0,0,0,8.682,5.37L118,122.7l21.317,10.692a6,6,0,0,0,8.682-5.4V62h72Z" transform="translate(6.168 -2)" fill="#426a5a"/>
                                                    </g>
                                                  </g>
                                                </g>
                                              </svg>
                                            Pemilihan Pengiriman
                                        </h6>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn"><svg fill="#777" height="0.1800in" viewBox="-192 0 512 512" width="0.1800in" xmlns="http://www.w3.org/2000/svg"><path d="m128 256c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/><path d="m128 64c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/><path d="m128 448c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/></svg></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-11 mt-2">
                                <div class="row align-items-center text-center">
                                    <div class="col-4"><a href="checkout?kurir=jne"><img src="assets/img/kurir/JNE.png" width="100%" alt="Logo Kurir"></a></div>
                                    <div class="col-4"><a href="checkout?kurir=pos"><img src="assets/img/kurir/POS.png" width="100%" alt="Logo Kurir"></a></div>
                                    <div class="col-4"><a href="checkout?kurir=tiki"><img src="assets/img/kurir/TIKI.png" width="100%" alt="Logo Kurir"></a></div>
                                </div>
                                <div class="row mt-2 justify-content-around">
                                    <div class="col-7">
                                        <span class="judul">Jenis Paket Pengiriman</span>
                                    </div>
                                    <div class="col-4 dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Kurir
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="checkout?kurir=jne">JNE</a>
                                            <a class="dropdown-item" href="checkout?kurir=pos">POS</a>
                                            <a class="dropdown-item" href="checkout?kurir=tiki">TIKI</a>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- div Kurir -->
                    <!-- div Informasi Tagihan -->
                    <div class="col-12 data-card mt-4">
                        <div class="row justify-content-center">
                            <div class="col-11 head">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <h6>
                                            <svg fill="#426a5a" height="0.2300in" width="0.2300in" id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m301 241h90v30h-90z"/><path d="m166 211.001c-8.271 0-15-6.729-15-15h-30c0 19.554 12.541 36.227 30 42.419v32.58h30v-32.579c17.459-6.192 30-22.865 30-42.42 0-24.813-20.187-45-45-45-8.271 0-15-6.729-15-15s6.729-15 15-15 15 6.729 15 14.999h30c0-19.554-12.542-36.227-30-42.418v-32.582h-30v32.582c-17.458 6.192-30 22.865-30 42.419 0 24.813 20.187 45 45 45 8.271 0 15 6.729 15 15s-6.729 15-15 15z"/><path d="m451 129.823-128.75-129.823h-261.25v512h390zm-120-78.396 68.998 69.573h-68.998zm-240 430.573v-452h210v121h120v331z"/><path d="m121 301h270v30h-270z"/><path d="m121 361h270v30h-270z"/><path d="m121 421h270v30h-270z"/><path d="m241 241h30v30h-30z"/></g></svg>
                                            Informasi Tagihan
                                        </h6>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn"><svg fill="#777" height="0.1800in" viewBox="-192 0 512 512" width="0.1800in" xmlns="http://www.w3.org/2000/svg"><path d="m128 256c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/><path d="m128 64c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/><path d="m128 448c0 35.347656-28.652344 64-64 64s-64-28.652344-64-64 28.652344-64 64-64 64 28.652344 64 64zm0 0"/></svg></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-11 mt-3">
                                <div class="row">
                                    <div class="col-8 judul"><span>Total Harga Produk</span></div>
                                    <div class="col-4 data-u"><span>Rp. <?=number_format($tHarga['total_harga'],0,",",".");?></span></div>
                                    <div class="col-8 judul"><span>Biaya Pengiriman</span></div>
                                    <div class="col-4 data-u"><span>Rp. <?=number_format($ongkir,0,",",".");?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- div Informasi Tagihan -->
                    <!-- Button -->
                    <div class="col-12 mt-3 mb-5">
                        <div class="row justify-content-end">
                            <div class="col-6">
                                <form action="" method="post">
                                    <button type="submit" name="bayar" class="btn btn-bayar">Bayar Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Button -->
                </div>
                <!-- Checkout -->


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