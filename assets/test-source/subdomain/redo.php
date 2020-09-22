<?php
    $con=mysqli_connect("localhost","wepinet_rob","TR6C2bbtEbkA","wepinet_prod") or die(mysqli_connect_error());
	function rrmdir($dir) { 
	   if (is_dir($dir)) { 
		 $objects = scandir($dir);
		 foreach ($objects as $object) { 
		   if ($object != "." && $object != "..") { 
			 if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
			   rrmdir($dir. DIRECTORY_SEPARATOR .$object);
			 else
			   unlink($dir. DIRECTORY_SEPARATOR .$object); 
		   } 
		 }
		 rmdir($dir); 
	   } 
	 }
	
	//step 1 remove dir & m_user,m_layout,t_layout
	if($_GET['step']>=1){
		rrmdir('../ID/'.$_GET['id_'].'_'.$_GET['id']);
		mysqli_query($con,"DELETE FROM `m_user` WHERE `id`='".$_GET['id']."' LIMIT 1");
		mysqli_query($con,"DELETE FROM `m_layout` WHERE `id`='".$_GET['id']."' LIMIT 1");
		mysqli_query($con,"DELETE FROM `t_layout` WHERE `m_user`='".$_GET['id']."'");
	}
	//step 2 remove cloudflare
	if($_GET['step']>=2){
		    $ch = curl_init("https://api.cloudflare.com/client/v4/zones/973c86cb89c34b5bc560e450075f0a17/dns_records/".$_GET['cf']);
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
    		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     
    		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    		'X-Auth-Email: webprof.id@gmail.com',
    		'X-Auth-Key: d6951e15a0542f65de8fdc3b55d51afa35c6a',
    		'Cache-Control: no-cache',
    	    // 'Content-Type: multipart/form-data; charset=utf-8',
    	    'Content-Type:application/json',
    		'purge_everything: true'
    		));
    		$sonuc = curl_exec($ch);
    		curl_close($ch);
	}
	//step 3 delete subdomain
	if($_GET['step']>=3){
		require "req/cPanel.php";
		require "req/autoload.php";

		$cPanel = new cPanel("wepinet", "1bYc0V9-*5jmPT", "103.131.50.253");
		$parameters = [
			'domain' => $_GET['s'],
		];
		$result = $cPanel->execute('api2',"SubDomain", "delsubdomain" , $parameters);
	}
?>