<?php
    require '../../../kueri-mall.php';
    $kueriMall = new kueriMall();
    if (!isset($_GET['kt'])) {
        $_GET['kt'] = '1';
        $_GET['it'] = '0';
    }
    // Img Product
    $imgProduk = $kueriMall->bImgProduk($_GET['ip']);
    $rowPBM = mysqli_fetch_assoc($imgProduk);
    // ========================================
    $bKategoriSub = $kueriMall->bKategoriSub2();
    // ===============================
    // Masukkkan Produk
    if (isset($_POST['edit_img'])) {
        $nama_foto_produk = $_FILES['foto_produk']['name'];

        $nama_foto_produk_s = $_FILES['foto_produk']['tmp_name'];
		
        $tempat_upload = "../../../assets/img/product/@bestore-product/";
        
        $temp1 = explode(".", $_FILES["foto_produk"]["name"]);//untuk mengambil nama file gambarnya saja tanpa format gambarnya

        $nama_baru1 = round(microtime(true)) . '1.' . end($temp1);//fungsi untuk membuat nama acak

        $format1 = pathinfo($nama_foto_produk, PATHINFO_EXTENSION); // Mendapatkan format file

        if( ($format1 == "jpg") or ($format1 == "png") or ($format1 == "jpeg") ){
          $a = $kueriMall->eImg($rowPBM['id_produk_img'], $nama_baru1, $nama_foto_produk_s, $tempat_upload);
            if ($a == 'Berhasil') {
                echo '<script>alert("Berhasil Edit Product"); window.location="product-list";</script>';
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
        }else{ // else validasi format
            echo '<script>alert("Format Gambar Harus JPG atau PNG"); </script>';
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
              <li class="breadcrumb-item active">Edit Image
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
                        <h4 class="card-title">Edit Img Product</h4>
                      </div>

                    </div>
                  </div>
                  <div id="view-basic-demo">
                    <div class="row">
                      <form class="col s12" action="" method="post" enctype="multipart/form-data">

                        <div class="row">
                          <div class="input-field col m6 s12 text-right">
                            <img src="../../../assets/img/product/<?=$rowPBM['nama_folder']?>/<?=$rowPBM['nama_img']?>" width="30%" id="gambar_cek" alt="img-product">
                          </button>
                          </div>
                        </div>

                        <div class="row">
                          <div class="input-field col m6 s12">
                            <div class="file-field input-field">
                              <div class="btn">
                                <span>Img Product</span>
                                <input type="file" name="foto_produk" id="preview_gambar" accept="image/*">
                              </div>
                              <div class="file-path-wrapper">
                                <input class="file-path validate" name="foto_produk" id="preview_gambar" type="text" required="">
                              </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="input-field col m6 s12 text-right">
                              <button class="btn waves-effect waves-light " type="submit" name="edit_img">
                              <i class="material-icons right">edit</i>Edit
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
<script>
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
</body>

</html>