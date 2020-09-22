<?php
    if (isset($_GET['sd'])) {
        $filename="toko-patner/".strtolower($_GET['sd'])."/";
        // Create Folder Toko Patner
        mkdir($filename);
        mkdir($filename."img");
        mkdir($filename."template");

        // Copy File
        copy("toko-patner/template/head.php", "toko-patner/".$_GET['sub_domain']."/template/head.php");
        copy("toko-patner/template/body.php", "toko-patner/".$_GET['sub_domain']."/template/body.php");
        copy("toko-patner/template/footer.php", "toko-patner/".$_GET['sub_domain']."/template/footer.php");
        // End Copy File=========
        $myfile = fopen($filename."index.php", "w");
        $txt = "<?php 
            \$id_patner = ".$_GET['id'].";
        ?>
        <base href='../../'>
        <?php
        require 'template/head.php';
        require 'template/body.php';
        require 'template/footer.php'; 
        ?>\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        // echo "Berhasil";
        header("Location:https://m.bestcommunity.info/my-web");

    }
?>