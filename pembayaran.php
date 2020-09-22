<?php
    // error_reporting(0);
    require 'kueri-main.php';
    require 'kueri-mall.php';
    $kueriMain = new kueri();
    $kueriMall = new kueriMall();

    // Cek Session
    session_start();
    if (!isset($_SESSION['id_patner'])) { //Cek Session Patner
        header('Location:login');
    }
    $hapusKeranjang = $kueriMall->hapusProdukPatner($_SESSION['id_patner']);
    $bTotalH = $kueriMall->bTotalTransaksi($_GET['iv']);
    $bInvoiceDetail = $kueriMall->bInvoiceD($_GET['iv']);
    $tHarga = mysqli_fetch_assoc($bTotalH);
    $rowInvoice = mysqli_fetch_assoc($bInvoiceDetail);

    $total_produk = $tHarga['total_harga']; //total produk
    $ongkos = $rowInvoice['ongkos_kirim']; // ongkos kirim
    $digit = $rowInvoice['digit_terakhir']; // digit terakhir

    $total_pembayaran = $total_produk + $ongkos + $digit; //total pembayaran

    if (isset($_POST['upload'])) {
        $nama_foto = $_FILES['gambar']['name'];
        if ($nama_foto == "upload-imge-1.png") {
            echo '<script>alert("Anda Belum Memasukkan Bukti Pembayaran"); window.location="transaksi" </script>';
        }
		$nama_foto_s = $_FILES['gambar']['tmp_name'];
        $tempat_upload = "assets/img/bukti-bayar/";
        
        $temp = explode(".", $_FILES["gambar"]["name"]);//untuk mengambil nama file gambarnya saja tanpa format gambarnya
		$nama_baru = round(microtime(true)) . '.' . end($temp);//fungsi untuk membuat nama acak

        $format = pathinfo($nama_foto, PATHINFO_EXTENSION); // Mendapatkan format file
        if( ($format == "jpg") or ($format == "png") ){
            $a = $kueriMall->upload_b($_GET['iv'], $nama_baru, $nama_foto_s, $tempat_upload);
            if ($a == 'Berhasil') {
                echo '<script>alert("Berhasil Mengirim Bukti Pembayaran"); window.location="index"</script>';
            }elseif ($a == "Gagal") {
                echo '<script>alert("Gagal Mengirim Bukti Pembayaran"); </script>';
            }
            else{
                echo '<script>alert("Terjadi Kesalahan, Ukuran File Terlalu Besar!!");</script>';
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
    <link rel="stylesheet" href="assets/css/pembayaran.css">
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

        <!-- Page Content  -->
        <div id="content">
            <div class="container d-checkout">
                <div class="row mb-4 justify-content-center nav-top">
                    <div class="col-11 div-nav">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <a href="index" class="btn btn-back" onclick="goBack()">
                                    <svg height="0.1800in" viewBox="0 0 329.26933 329" width="0.1800in" xmlns="http://www.w3.org/2000/svg"><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/></svg>
                                </a>
                            </div>
                            <div class="col-10">
                                <h5>Pembayaran</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout -->
                <div class="row card-all">
                    <div class="col-12 alert-waktu">
                        <div class="alert alert-tegang" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36.372" height="28.096"
                                viewBox="0 0 36.372 28.096">
                                <g id="fast" transform="translate(0 0)">
                                    <g id="Group_1677" data-name="Group 1677" transform="translate(1.967 8.72)">
                                        <g id="Group_1676" data-name="Group 1676" transform="translate(0 0)">
                                            <rect id="Rectangle_686" data-name="Rectangle 686" width="4.177"
                                                height="2.131" fill="#fff" />
                                        </g>
                                    </g>
                                    <g id="Group_1679" data-name="Group 1679" transform="translate(1.967 17.245)">
                                        <g id="Group_1678" data-name="Group 1678" transform="translate(0 0)">
                                            <rect id="Rectangle_687" data-name="Rectangle 687" width="4.177"
                                                height="2.131" fill="#fff" />
                                        </g>
                                    </g>
                                    <g id="Group_1681" data-name="Group 1681" transform="translate(0 12.983)">
                                        <g id="Group_1680" data-name="Group 1680">
                                            <rect id="Rectangle_688" data-name="Rectangle 688" width="6.144"
                                                height="2.131" fill="#fff" />
                                        </g>
                                    </g>
                                    <g id="Group_1683" data-name="Group 1683" transform="translate(8.275 0)">
                                        <g id="Group_1682" data-name="Group 1682" transform="translate(0 0)">
                                            <path id="Path_2124" data-name="Path 2124"
                                                d="M130.537,58.245a14.048,14.048,0,1,0,14.048,14.048A14.064,14.064,0,0,0,130.537,58.245Zm0,25.965a11.917,11.917,0,1,1,11.917-11.917A11.931,11.931,0,0,1,130.537,84.21Z"
                                                transform="translate(-116.489 -58.245)" fill="#fff" />
                                        </g>
                                    </g>
                                    <g id="Group_1685" data-name="Group 1685" transform="translate(20.88 7.694)">
                                        <g id="Group_1684" data-name="Group 1684">
                                            <path id="Path_2125" data-name="Path 2125"
                                                d="M296.061,173.44v-6.883H293.93v8.01l5.492,3.743,1.2-1.761Z"
                                                transform="translate(-293.93 -166.557)" fill="#fff" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <span class="text-waktu">Lakukkan Pembayaran Sebelum 2020-08-23 13:32:04</span>
                        </div>
                    </div>
                    <div class="col-12 card-pembayaran">
                        <div class="row">
                            <div class="col-8">
                                <h5>
                                    <svg id="calendar_1_" data-name="calendar (1)" xmlns="http://www.w3.org/2000/svg"
                                        width="23.294" height="23.294" viewBox="0 0 23.294 23.294">
                                        <g id="Group_1659" data-name="Group 1659" transform="translate(2.73 11.01)">
                                            <g id="Group_1658" data-name="Group 1658">
                                                <path id="Path_2116" data-name="Path 2116"
                                                    d="M68.963,242h-8.28a.682.682,0,0,0,0,1.365h8.28a.682.682,0,0,0,0-1.365Z"
                                                    transform="translate(-60 -242)" fill="#46715e" />
                                            </g>
                                        </g>
                                        <g id="Group_1661" data-name="Group 1661" transform="translate(2.73 16.47)">
                                            <g id="Group_1660" data-name="Group 1660">
                                                <path id="Path_2117" data-name="Path 2117"
                                                    d="M66.142,362h-5.46a.682.682,0,0,0,0,1.365h5.46a.682.682,0,0,0,0-1.365Z"
                                                    transform="translate(-60 -362)" fill="#46715e" />
                                            </g>
                                        </g>
                                        <g id="Group_1663" data-name="Group 1663" transform="translate(2.73 19.2)">
                                            <g id="Group_1662" data-name="Group 1662">
                                                <path id="Path_2118" data-name="Path 2118"
                                                    d="M66.142,422h-5.46a.682.682,0,1,0,0,1.365h5.46a.682.682,0,1,0,0-1.365Z"
                                                    transform="translate(-60 -422)" fill="#46715e" />
                                            </g>
                                        </g>
                                        <g id="Group_1665" data-name="Group 1665" transform="translate(2.73 13.74)">
                                            <g id="Group_1664" data-name="Group 1664">
                                                <path id="Path_2119" data-name="Path 2119"
                                                    d="M66.142,302h-5.46a.682.682,0,1,0,0,1.365h5.46a.682.682,0,1,0,0-1.365Z"
                                                    transform="translate(-60 -302)" fill="#46715e" />
                                            </g>
                                        </g>
                                        <g id="Group_1667" data-name="Group 1667" transform="translate(11.01 6.825)">
                                            <g id="Group_1666" data-name="Group 1666">
                                                <path id="Path_2120" data-name="Path 2120"
                                                    d="M245.412,150h-2.73a.682.682,0,0,0,0,1.365h2.73a.682.682,0,0,0,0-1.365Z"
                                                    transform="translate(-242 -150)" fill="#46715e" />
                                            </g>
                                        </g>
                                        <g id="Group_1669" data-name="Group 1669" transform="translate(0 0)">
                                            <g id="Group_1668" data-name="Group 1668">
                                                <path id="Path_2121" data-name="Path 2121"
                                                    d="M17.835,11.048V3.978a2.034,2.034,0,0,0-.6-1.448L15.3.6A2.034,2.034,0,0,0,13.857,0H2.047A2.05,2.05,0,0,0,0,2.047v19.2a2.05,2.05,0,0,0,2.047,2.047h15.1a6.142,6.142,0,0,0,.682-12.246ZM13.74,1.365a.745.745,0,0,1,.6.2L16.27,3.5a.745.745,0,0,1,.2.6H13.74ZM2.047,21.929a.683.683,0,0,1-.682-.682V2.047a.683.683,0,0,1,.682-.682H12.375V4.777a.682.682,0,0,0,.682.682H16.47v5.589A6.139,6.139,0,0,0,13.3,21.929Zm15.1,0a4.777,4.777,0,1,1,4.777-4.777A4.783,4.783,0,0,1,17.152,21.929Z"
                                                    transform="translate(0 0)" fill="#46715e" />
                                            </g>
                                        </g>
                                        <g id="Group_1671" data-name="Group 1671" transform="translate(16.47 13.74)">
                                            <g id="Group_1670" data-name="Group 1670">
                                                <path id="Path_2122" data-name="Path 2122"
                                                    d="M365.412,304.73h-2.047v-2.047a.682.682,0,1,0-1.365,0v2.73a.683.683,0,0,0,.682.682h2.73a.682.682,0,0,0,0-1.365Z"
                                                    transform="translate(-362 -302)" fill="#46715e" />
                                            </g>
                                        </g>
                                        <g id="Group_1673" data-name="Group 1673" transform="translate(2.73 2.73)">
                                            <g id="Group_1672" data-name="Group 1672">
                                                <path id="Path_2123" data-name="Path 2123"
                                                    d="M66.142,60h-5.46a.682.682,0,0,0-.682.682v5.46a.682.682,0,0,0,.682.682h5.46a.682.682,0,0,0,.682-.682v-5.46A.682.682,0,0,0,66.142,60Zm-.682,5.46H61.365V61.365H65.46Z"
                                                    transform="translate(-60 -60)" fill="#46715e" />
                                            </g>
                                        </g>
                                    </svg>
                                    Metode Pembayaran
                                </h5>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-11 card-rekening">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <h6><strong>BCA</strong></h6>
                                    </div>
                                    <div class="col-10 text-right no-rek">
                                        <div class="row justify-content-end align-items-center">
                                            <div class="col-6">
                                                <h6 id="rek">0510950208</h6>
                                            </div>
                                            <div class="col-4"><button class="btn btn-salin" onclick="copyToClipboard('#rek')">Salin</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 pb-3">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Total Harga Produk</h6>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h6>Rp. <?=number_format($total_produk,0,",",".");?></h6>
                                    </div>
                                    <div class="col-6">
                                        <h6>Ongkos Pengiriman</h6>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h6>Rp. <?=number_format($ongkos,0,",",".");?></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5>Subtotal</h5>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h5>Rp. <?=number_format($total_pembayaran,0,",",".");?></h5>
                                    </div>
                                    <div class="col-12">
                                        <small style="color:red; font-size:10px;">*Pastikan anda melakukkan pembayaran sampai 3 digit terakhir.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <form action="" method="post">
                                    <button class="btn btn-bayar" type="button" data-toggle="modal" data-target="#uploadPembayaran">Upload
                                        Pembayaran</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Checkout -->


            </div>
        </div>
    </div>

    <div class="overlay"></div>

    <!-- Modal -->

    <!-- Modal -->
    <div class="modal fade" id="uploadPembayaran" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="uploadPembayaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadPembayaranLabel">Upload Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" name="bukti_pembayaran" enctype="multipart/form-data">
                        <div class="row justify-content-center pt-4 mb-5">
                            <div class="col-8 mt-4">
                                <div class="form-group">
                                    <button class="btn btn-pricing"> <i class="fas fa-cloud-upload-alt"></i>
                                        Cari Gambar</button>
                                    <input type="file" class="form-control-file" id="preview_gambar" name="gambar"
                                        required>
                                </div>
                            </div>
                            <div class="col-10 preview-b-p text-center">
                                <img src="assets/img/b-tf/upload-imge-1.png" id="gambar_cek"
                                    alt="Preview Gambar" width="100%">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="upload" class="btn btn-bayar">kirim</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
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

    
    <!-- Initialize Swiper -->
    <!-- Modal Gambar Preview -->
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            alert("Nomor Rekening Berhasil Disalin");
        }
        function bacaGambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#gambar_cek').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#preview_gambar").change(function () {
            bacaGambar(this);
        });
    </script>
    <!-- Modal Gambar Preview -->
</body>

</html>