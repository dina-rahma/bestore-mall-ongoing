<?php
    require '../../../kueri-mall.php';
    $kueriMall = new kueriMall();
    if (!isset($_GET['kt'])) {
        $_GET['kt'] = '1';
        $_GET['it'] = '0';
    }
    // ===============================
    // Masukkkan Produk
    if (isset($_POST['video'])) {
        $nama_foto_thumb = $_FILES['foto_thumb']['name'];

        $nama_foto_thumb_s = $_FILES['foto_thumb']['tmp_name'];
		
        $tempat_upload = "../../../assets/img/product/@bestore-product/";

        $temp2 = explode(".", $_FILES["foto_thumb"]["name"]);//untuk mengambil nama file gambarnya saja tanpa format gambarnya
        
        $nama_baru2 = round(microtime(true)) . '2.' . end($temp2);//fungsi untuk membuat nama acak

        $format2 = pathinfo($nama_foto_thumb, PATHINFO_EXTENSION); // Mendapatkan format file

        if ($nama_foto_thumb == '') {
          $video = 'kosong';
        }else{
          $video='ada';
        }

        if (($format2 == "jpg") or ($format2 == "png") or ($format2 == "jpeg")) {
            $a = $kueriMall->iVideo($_GET['ip'], $_POST['link_video'], $nama_baru2, $nama_foto_thumb_s,$tempat_upload, '@bestore-product', $video);
            if ($a == 'Berhasil') {
                echo '<script>alert("Berhasil Memasukkan Produk"); window.location="product-list";</script>';
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
        
    }
?>
<!DOCTYPE html>
<!--
Template Name: Materialize - Material Design Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
Renew Support: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<?php
      $product = 'active';
      $productBS = 'active';
      require 'head.php';
    ?>
<!-- BEGIN: Page Main-->
<div id="main">
  <div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
      <!-- Search for small screen-->
      <div class="container">
        <div class="row">
          <div class="col s10 m6 l6">
            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Product</span></h5>
            <ol class="breadcrumbs mb-0">
              <li class="breadcrumb-item"><a href="index">Home</a>
              </li>
              <li class="breadcrumb-item"><a href="product-list">Product-Bestore</a>
              </li>
              <li class="breadcrumb-item active">Form Video Produk
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="col s12">
      <div class="container">
        <div class="section">

          <!-- Basic Demo -->
          <div class="row">
            <div class="col s12">
              <div id="basic-demo" class="card card-tabs">
                <div class="card-content">
                  <div class="card-title">
                    <div class="row">
                      <div class="col s12 m6 l10">
                        <h4 class="card-title">Video Produk</h4>
                      </div>

                    </div>
                  </div>
                  <div id="view-basic-demo">
                    <div class="row">
                      <form class="col s12" action="" method="post" enctype="multipart/form-data">
                        
                        <div class="row">
                          <div class="input-field col m6 s12">
                            <div class="file-field input-field">
                              <div class="btn">
                                <span>Img Thumbnail</span>
                                <input type="file" name="foto_thumb" accept="image/*" required="">
                              </div>
                              <div class="file-path-wrapper">
                                <input class="file-path validate" name="foto_thumb" type="text">
                              </div>
                            </div>
                          </div>
                            <div class="input-field col m6 s12">
                                <input placeholder="R-f3z7bV7sE" name="link_video" id="" type="text" class="">
                                <label for="date-demo1">Link YT</label>
                            </div>
                          <div class="row">
                            <div class="input-field col m6 s12 text-right">
                              <button class="btn waves-effect waves-light " type="submit" name="video">Send
                                <i class="material-icons right">send</i>
                            </button>
                            </div>
                          </div>

                        </div>
                      </form>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>


        </div><!-- START RIGHT SIDEBAR NAV -->

      </div>
      <div class="content-overlay"></div>
    </div>
  </div>
</div>
<!-- END: Page Main-->


<!-- BEGIN: Footer-->

<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->
<script src="../../../app-assets/js/vendors.min.js"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="../../../app-assets/vendors/formatter/jquery.formatter.min.js"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="../../../app-assets/js/plugins.js"></script>
<script src="../../../app-assets/js/search.js"></script>
<script src="../../../app-assets/js/custom/custom-script.js"></script>
<script src="../../../app-assets/js/scripts/customizer.js"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="../../../app-assets/js/scripts/form-masks.js"></script>
<!-- END PAGE LEVEL JS-->
</body>

</html>