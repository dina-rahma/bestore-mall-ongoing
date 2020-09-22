<?php
    if(isset($_GET['create'])){
		
        $con=mysqli_connect("localhost","wepinet_rob","TR6C2bbtEbkA","wepinet_prod") or die(mysqli_connect_error());
		$qry=mysqli_query($con,"INSERT INTO `m_user` (`id_`,`nama`, `email`, `pass`,`status`, `created_date`) 
		VALUES ('".$_GET['create']."', '".$_GET['s']."', '".$_GET['u']."', '".password_hash($_GET['p'],PASSWORD_BCRYPT)."', '0', NOW());");
		if($qry){
			$result=mysqli_query($con,"SELECT `id` FROM `m_user` WHERE `email`='".$_GET['u']."' LIMIT 1;");
			$sql_ = mysqli_fetch_array($result,MYSQLI_ASSOC);
			mysqli_query($con,"INSERT INTO `m_layout` (`id`,`menu`, `banner`, `footer`) VALUES ('".$sql_['id']."', '0', '0', '0')");
			mysqli_query($con,"INSERT INTO `t_layout` (`m_user`, `page`, `fitur`, `urut`) 
			VALUES ('".$sql_['id']."', '1', '1', '1'),('".$sql_['id']."', '1', '2', '2'),
					('".$sql_['id']."', '1', '3', '3'),('".$sql_['id']."', '1', '4', '4')");
			
			$filename="../ID/".$_GET['create']."_".$sql_['id']."/";
			mkdir($filename);mkdir($filename."img");
			$myfile = fopen($filename."index.php", "w");
			$txt = "<?php 
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
			\$id='".$sql_['id']."';
			\$id_='".$_GET['create']."';
			require '../../builder/frontend/index.php';
			?> \n";
			fwrite($myfile, $txt);
			fclose($myfile);
			$myhtaccess = fopen($filename.".htaccess", "w");
			$txt_ = "
			\nRewriteEngine on
			\nRewriteRule ^([a-zA-Z0-9_-]+)/?$ index.php?l=$1 [QSA]
			\nRewriteCond %{HTTPS} off
			\nRewriteCond %{HTTP_HOST} ^".$_GET['s'].".wepi.id$
			\nRewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI}";
			fwrite($myhtaccess, $txt_);
			fclose($myhtaccess);
			echo $sql_['id'];
		}else{echo mysqli_error($con);mysqli_query($con,"UPDATE `m_user` SET `email`='".$_GET['u']."x', `status`='1' WHERE `id`='".$sql_['id']."' AND `email`='".$_GET['u']."' AND `id_`='".$_GET['create']."' LIMIT 1;");}
    }
?>