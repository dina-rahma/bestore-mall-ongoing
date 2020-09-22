<?php
    session_start();
    require 'connection.php';
    require 'kueri-main.php';
    $kueri = new kueri();

    if(isset($_POST['konfirmasi'])){
        $idPatner = $_SESSION['id_patner'];
        $namaL = $mysqli->real_escape_string($_POST['namaL']);
        $username = $mysqli->real_escape_string($_POST['username']);
        $alamat = $mysqli->real_escape_string($_POST['alamat']);
        $kode_ref = 0;
        
        $updateAkun = $kueri->iPatner2($idPatner, $namaL, $username, $alamat, $kode_ref);
        if ($updateAkun == "Berhasil") {
            header("Location:login");
        }else{
            echo "Gagal";
        }
    }else{
        $alert = '';
        $active = '';
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
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
    <!-- Css This Page -->
    <link rel="stylesheet" href="assets/css/register.css">
    <!-- Css Font -->
    <link rel="stylesheet" href="assets/css/font.css">


    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Font Awesome -->
</head>

<body>
    <div class="wrapper">
        <!-- Page Content  -->
        <div id="content">
            <div class="container d-register">
                <div class="row justify-content-center form-register">
                    <div class="col-12 text-center">
                        <img src="assets/img/svg/icon/bestore-white.svg" alt="logo bestore">
                    </div>
                    <div class="col-10 mt-4">
                        <form action="" method="POST">
                            <div class="form-group">
                              <input type="text" class="form-control" name="namaL" id="iconified" aria-describedby="emailHelp" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="username" id="iconified" placeholder="Username">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="alamat" id="iconified" placeholder="Alamat">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-register" name="konfirmasi">Konfirmasi</button><br><br>
                                </div>
                            </div>
                          </form>
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

</body>

</html>