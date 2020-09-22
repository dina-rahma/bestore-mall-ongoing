<?php
    $host_db="localhost";
    $user_db="root";
    $pass_db="";
    $nama_db="test_nest";    
    $mysqli = new mysqli($host_db,$user_db,$pass_db,$nama_db);

    $cek_id = $mysqli->query("SELECT id_patner FROM tb_patner WHERE id_patner='20100999'");
    $total_id = $cek_id->num_rows;
    $data_patner = $cek_id->fetch_assoc();

    $idNew = substr($data_patner['id_patner'],4) + 1; //id, substr id (2009 1)
    $tgl =  substr($data_patner['id_patner'],0,4); //Dari Terdaftar
    $tglNow = substr(date('Ym'),2,4); // TGl Sekarang

    if ($tgl == $tglNow ) {
        if ($idNew > 9999) {
            $idFinal = $tgl.$idNew ; //id, substr id (2009 1)
        }else{
            $idNew = $data_patner['id_patner']; //id, substr id (2009 1)
            $idFinal = $idNew + 0001;
        }
    }else{
        if ($idNew > 9999) {
            $idFinal = $tglNow.$idNew ; //id, substr id (2009 1)
        }else{
            $idNew = $data_patner['id_patner']; //id, substr id (2009 1)
            $idFinal = $idNew + 0001;
        }
    }

    
    // echo $idFinal;
    echo $tgl;
?>