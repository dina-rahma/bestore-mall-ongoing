<?php
    error_reporting(0);
    require '../../../kueri-mall.php';
    $kueriMall = new kueriMall();
    if (isset($_GET['d'])) {
        $dProduk = $kueriMall->dProduk($_GET['d']);
        if ($dProduk == 'Berhasil') {
            echo "<script>alert('Berhasil Hapus Produk'); window.location='product-list';</script>";
        }else{
            echo "<script>alert('Gagal Hapus Produk');</script>";
        }
    }

    $bProdukBestore = $kueriMall->bProdukBestore(); //Baca Product Bestore //File di kueri-mall.php
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
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/data-tables/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-users.css">
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
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>List Toko</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="toko-users-list">Product</a>
                            </li>
                            <li class="breadcrumb-item active">List Product Bestore
                            </li>
                        </ol>
                    </div>
                    <div class="col s2 m6 l6">
                        <a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="form-input-product">
                            <i class="material-icons hide-on-med-and-up">Add</i>
                            <span class="hide-on-small-onl">Add Product</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <!-- users list start -->
                <section class="users-list-wrapper section">
                    <div class="users-list-filter">
                        <div class="card-panel">
                            <div class="row">
                                <form>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-verified">Verified</label>
                                        <div class="input-field">
                                            <select class="form-control" id="users-list-verified">
                                                <option value="">Any</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-role">Role</label>
                                        <div class="input-field">
                                            <select class="form-control" id="users-list-role">
                                                <option value="">Any</option>
                                                <option value="User">User</option>
                                                <option value="Staff">Staff</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-status">Status</label>
                                        <div class="input-field">
                                            <select class="form-control" id="users-list-status">
                                                <option value="">Any</option>
                                                <option value="Active">Active</option>
                                                <option value="Close">Close</option>
                                                <option value="Banned">Banned</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3 display-flex align-items-center show-btn">
                                        <button type="submit"
                                            class="btn btn-block indigo waves-effect waves-light">Show</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                                <!-- datatable start -->
                                <div class="responsive-table">
                                    <table id="users-list-datatable" class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>No</th>
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Berat</th>
                                                <th>Stok</th>
                                                <th>Status Stok</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                while ($rowPB = mysqli_fetch_assoc($bProdukBestore)) {
                                                    if ($rowPB['stok'] == 0) {
                                                        $status_stok = 'Sold Out';
                                                        $color="red";
                                                    }else{
                                                        $status_stok = 'Ready';
                                                        $color="green";
                                                    }
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td><?= $no ?></td>
                                                <td><a href="form-edit-product?ip=<?= $rowPB['id_produk']?>"><?= $rowPB['nama_produk'] ?></a></td>
                                                <td><?= $rowPB['harga'] ?></td>
                                                <td><?= $rowPB['berat'] ?></td>
                                                <td><?= $rowPB['stok'] ?></td>
                                                <td><span class="chip <?= $color ?> lighten-5">
                                                        <span class="<?= $color ?>-text"><?= $status_stok ?></span>
                                                    </span>
                                                </td>
                                                <td><a href="form-edit-product?ip=<?= $rowPB['id_produk']?>"><i class="material-icons">edit</i></a></td>
                                                <td><a href="product-list?d=<?= $rowPB['id_produk']?>"><i class="material-icons">delete</i></a></td>
                                            </tr>

                                            <?php
                                                $no++;
                                                }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- datatable ends -->
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
        <div class="content-overlay"></div>
    </div>
</div>
</div>
<!-- END: Page Main-->


    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <script src="../../../app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../../../app-assets/vendors/data-tables/js/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="../../../app-assets/js/plugins.js"></script>
    <script src="../../../app-assets/js/search.js"></script>
    <script src="../../../app-assets/js/custom/custom-script.js"></script>
    <script src="../../../app-assets/js/scripts/customizer.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="../../../app-assets/js/scripts/page-users.js"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>