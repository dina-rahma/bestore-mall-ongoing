<?php

require "req/cPanel.php";
require "req/autoload.php";

$cPanel = new cPanel("wepinet", "1bYc0V9-*5jmPT", "103.131.50.253");


    $parameters = [
        'domain' => $_GET['s'],
        'rootdomain' => 'wepi.id',
        'dir' => '/public_html/ID/'.$_GET['id_'].'_'.$_GET['dir'],
        'disallowdot' => 1,
    ];
    $result = $cPanel->execute('api2',"SubDomain", "addsubdomain" , $parameters);
    if (isset($result->cpanelresult->error)) {
        echo $result->cpanelresult->error;
        $con=mysqli_connect("localhost","wepinet_rob","TR6C2bbtEbkA","wepinet_prod") or die(mysqli_connect_error());
        mysqli_query($con,"SET SESSION time_zone = '+7:00'");
        mysqli_query($con,"INSERT INTO `t_gagal` (`type`, `message`, `created_date`, `user`) VALUES ('subdomain', '".$result->cpanelresult->error."', NOW(), '".$_GET['id_']."');");
        die();
    }
    echo "1";
    die();
?>