<?php
    /* Cloudflare.com | APİv4 | Api Ayarları */
    //$apikey = 'd6951e15a0542f65de8fdc3b55d51afa35c6a'; // Cloudflare Global API
    //$email = 'webprof.id@gmail.com'; // Cloudflare Email Adress
    //$domain = 'wepi.id';  // zone_name // Cloudflare Domain Name
    //$zoneid = '973c86cb89c34b5bc560e450075f0a17'; // zone_id // Cloudflare Domain Zone ID

    // A-record oluşturur DNS sistemi için.
    		$ch = curl_init("https://api.cloudflare.com/client/v4/zones/973c86cb89c34b5bc560e450075f0a17/dns_records");
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
    		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    		'X-Auth-Email: webprof.id@gmail.com',
    		'X-Auth-Key: d6951e15a0542f65de8fdc3b55d51afa35c6a',
    		'Cache-Control: no-cache',
    	    // 'Content-Type: multipart/form-data; charset=utf-8',
    	    'Content-Type:application/json',
    		'purge_everything: true'
    		
    		));
    	
    		// -d curl parametresi.
    		$data = array(
    		
    			'type' => 'A',
    			'name' => $_GET['s'],
    			'content' => '103.131.50.253',
    			'zone_name' => 'wepi.id',
    			'zone_id' => '973c86cb89c34b5bc560e450075f0a17',
    			'proxiable' => true,
    			'proxied' => true,
    			'ttl' => 120
    		);
    		
    		$data_string = json_encode($data);

    		curl_setopt($ch, CURLOPT_POST, true);
    		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);	
    		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_string));

    		$sonuc = curl_exec($ch);
    		$sonuc_=json_decode($sonuc,true);
    		
            if($sonuc_['success']){
                echo $sonuc_['result']['id'];
            }else{
                echo $sonuc_['errors'][0]['message'];
                $con=mysqli_connect("localhost","wepinet_rob","TR6C2bbtEbkA","wepinet_prod") or die(mysqli_connect_error());
                mysqli_query($con,"SET SESSION time_zone = '+7:00'");
                mysqli_query($con,"INSERT INTO `t_gagal` (`type`, `message`, `created_date`, `user`) VALUES ('cloudflare', '".$sonuc_['errors'][0]['message']."', NOW(), '".$_GET['s']."');");
				
				//cek id cloudflare
		    	$ch = curl_init("https://api.cloudflare.com/client/v4/zones/973c86cb89c34b5bc560e450075f0a17/dns_records?type=A&name=".$_GET['s']."&content=103.131.50.253&page=1&per_page=20&order=type&direction=desc&match=all");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                     
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'X-Auth-Email: webprof.id@gmail.com',
				'X-Auth-Key: d6951e15a0542f65de8fdc3b55d51afa35c6a',
				'Content-Type:application/json'

				));
				$sonuc = curl_exec($ch);
				$sonuc_=json_decode($sonuc,true);
				
				//remove cloudflare
				$ch_=curl_init("https://api.cloudflare.com/client/v4/zones/973c86cb89c34b5bc560e450075f0a17/dns_records/".$sonuc_['result'][0]['id']);
				curl_setopt($ch_, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch_, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch_, CURLOPT_SSL_VERIFYPEER,false);
				curl_setopt($ch_, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     
				curl_setopt($ch_, CURLOPT_HTTPHEADER, array(
				'X-Auth-Email: webprof.id@gmail.com',
				'X-Auth-Key: d6951e15a0542f65de8fdc3b55d51afa35c6a',
				'Cache-Control: no-cache',
				// 'Content-Type: multipart/form-data; charset=utf-8',
				'Content-Type:application/json',
				'purge_everything: true'
				));
				
                die();
            }
    		curl_close($ch);