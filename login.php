<?php
    session_start();
    require_once 'connection.php';
    if (!isset($_COOKIE['id_patner'])) {
        if(isset($_POST['login'])){
            $username = $mysqli->real_escape_string($_POST['username']);
            $password = $mysqli->real_escape_string($_POST['password']);
    
            //cek user login 
            $cek_login = $mysqli->query("SELECT * FROM tb_patner WHERE email_patner='$username'  OR username='$username'");
            $ktm_login = $cek_login->num_rows;
            $data_login = $cek_login->fetch_assoc();
    
            if($ktm_login>=1){
                //login username tersedia
                //verify password 
                if(password_verify($password,$data_login['password'])){
                    // echo "Login Berhasil";
                    //silakan buat session dan redirect disini
                    setcookie('id_patner', $data_login['id_patner'], time() + (60 * 60 * 24 * 5), '/'); //Set Cookie untuk ID-Patner dalam 5 Hari
                    $_SESSION['id_patner']=$_COOKIE['id_patner']; //Memasukkan Nilai Cookie ke Session
                    header("Location:index");
                    $alert='';
                    $active = '';
                    //redircet 
                    //header("location:index.php");
                }else{
                    $alert='Login Gagal, Password Salah!';
                    $active = 'active';
                }
            }else{
                //login gagal, username tidak tersedia
                $alert='Login Gagal, Username Tidak Tersedia!';
                $active = 'active';
            }
    
            $mysqli->close();
        }else{
            $alert='';
            $active = '';
        }
    }else{
        $_SESSION['id_patner']=$_COOKIE['id_patner'];
        header("Location:index"); 
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
    <link rel="stylesheet" href="assets/css/login.css">
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
            <div class="container d-login">
                <div class="row justify-content-center mt-3 d-alert <?=$active?>">
                    <div class="col-11">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Perhatian !</strong> <?=$alert?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center form-login">
                    <div class="col-12 text-center">
                        <img src="assets/img/svg/icon/bestore-white.svg" alt="logo bestore">
                    </div>
                    <div class="col-10 mt-4">
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" id="user"
                                    aria-describedby="emailHelp" placeholder="Username or Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="pass"
                                    placeholder="Password">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-login" name="login" id="btn-login">Masuk</button><br><br>
                                    <span class="text-bawah">atau belum punya akun? silahkan <a
                                            href="register">Daftar</a></span>
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

    <script type="text/javascript">
            window.onload = function () {
                document.getElementById("user").onchange = validateForm;
                document.getElementById("pass").onchange = validateForm;
            }
            document.getElementById("btn-login").disabled = true;

            function validateForm() {
                var user = document.getElementById("user").value;
                var pass = document.getElementById("pass").value;
                if (user.length < 1  && pass.length < 1 ) {
                    document.getElementById("btn-login").disabled = true;
                }else if(user.length < 1){
                    document.getElementById("btn-login").disabled = true;
                }else if(pass.length < 1){
                    document.getElementById("btn-login").disabled = true;
                }
                else{
                    document.getElementById("btn-login").disabled = false;
                }

            }
        </script>
</body>

</html>