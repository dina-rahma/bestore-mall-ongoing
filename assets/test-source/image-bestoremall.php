<?php
    $host_db="localhost";
    $user_db="root";
    $pass_db="";
    $nama_db="bestore-mall";    
    $mysqli = new mysqli($host_db,$user_db,$pass_db,$nama_db);

    $imgP = $mysqli->query("SELECT tb_produk_img.nama_img, tb_produk.nama_produk FROM `tb_produk_img` INNER JOIN tb_produk ON tb_produk_img.id_produk = tb_produk.id_produk WHERE tb_produk.id_toko = '0'");
    

    
?>

<center>
<?php
    while ($img = mysqli_fetch_assoc($imgP)) {
?>
<img src="../img/product/@bestore-product/<?= $img['nama_img'] ?>" width="500px" alt="img-product">
<?php
    }
    ?>
</center>