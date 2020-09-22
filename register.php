<?php 
    session_start();
    require 'connection.php';
    require 'kueri-main.php';
    $kueri = new kueri();
    date_default_timezone_set('Asia/Jakarta');

    if(isset($_POST['daftar'])){
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = $mysqli->real_escape_string($_POST['password']);
        $passwd_hash = password_hash($password, PASSWORD_DEFAULT); // hash password
        
        $valid_email = $kueri->validEmail($email);
        $tValid_e = mysqli_num_rows($valid_email);
        if ($tValid_e == 0) {
            $idLastP = $kueri->idlastP(); //baca id last 
            $tId = mysqli_num_rows($idLastP); //hitung total id
            $status_paket = 5; //status paket
            if ($tId >= 1) { //jika lebih dari 1
                $idLast =mysqli_fetch_assoc($idLastP); //pecah jadi array
                $tgl = substr(date('Ym'),2,4); //subs tgl jadi tahun bulan(2009)
                $id = substr($idLast['id_patner'],4) + 1; //id, substr id (2009 1)
                $idPatner =  $tgl.$id;
                // echo $idPatner;
                $registerP = $kueri->iPatner1($idPatner, $email, $passwd_hash, $status_paket);
                if ($registerP == 'Berhasil') {
                    $_SESSION['id_patner'] = $idPatner;
                    header("Location:register-2");
                }else{
                    $alert = 'Gagal Mendaftar Karena Terjadi Kesalahan';
                    $active = 'active';
                }
                
            }else{
                $tgl = substr(date('Ym'),2,4);
                $id = 1;
                $idPatner =  $tgl.$id;
                // echo $idPatner;
                $registerP = $kueri->iPatner1($idPatner, $email, $passwd_hash, $status_paket);
                if ($registerP == 'Berhasil') {
                    $_SESSION['id_patner'] = $idPatner;
                    header("Location:register-2");
                }else{
                    $alert = 'Gagal Mendaftar Karena Terjadi Kesalahan';
                    $active = 'active';
                }
            }
        }else{
            $alert = 'Email Sudah Terdaftar, Silahkan Gunakan Email Baru';
            $active = 'active';
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
</head>

<body>
    <div class="wrapper">
        <!-- Page Content  -->
        <div id="content">
            <div class="container d-register">
                <div class="row justify-content-center mt-3 d-alert <?=$active?>">
                    <div class="col-11">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Perhatian!</strong>, <?=$alert?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center form-register">
                    <div class="col-12 text-center">
                        <img src="assets/img/svg/icon/bestore-white.svg" alt="logo bestore">
                    </div>
                    <div class="col-10 mt-4">
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email_input"
                                    aria-describedby="emailHelp" placeholder="Email" required="">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="pw1"
                                    placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="konfirmasi-pass" id="pw2"
                                    placeholder="Konfirmasi Password">
                                <span class="pesan-password"><label for="pw2" id="pesan"></label></span>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-register" id="btn-register" name="daftar">Daftar</button><br><br>
                                    <span class="text-bawah">atau sudah punya akun? silahkan <a
                                            href="login">Login</a></span>
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
    <!-- Konfirmasi Password -->
    <script type="text/javascript">
        window.onload = function () {
            document.getElementById("pw1").onchange = validatePassword;
            document.getElementById("pw2").onchange = validatePassword;
        }
        document.getElementById("btn-register").disabled = true;

        function validatePassword() {
            var pass2 = document.getElementById("pw2").value;
            var pass1 = document.getElementById("pw1").value;
            var emailInput = document.getElementById("email_input").value;
            if (pass1 != pass2) {
                document.getElementById("pesan").innerHTML = "<span class='text-danger'>Password Tidak Sama!</span>";
                document.getElementById("btn-register").disabled = true;
            } else {
                document.getElementById("pesan").innerHTML = "<span class='text-success'>Password Sama!</span>";
                document.getElementById("btn-register").disabled = true;
                if (pass1.length > 5) {
                    document.getElementById("pesan").innerHTML = "<span class='text-success'>Ok!</span>";
                    if (emailInput.length < 1) {
                            document.getElementById("btn-register").disabled = true;
                        }else{
                            document.getElementById("btn-register").disabled = false;
                        }
                } else {
                    document.getElementById("pesan").innerHTML = "<span class='text-danger'>Password Kurang dari 6 Digit</span>";
                    document.getElementById("btn-register").disabled = true;
                }
            }

        }
    </script>
    <!-- Konfirmasi Password -->
</body>

</html>