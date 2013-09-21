<?php
	$db = new PDO("mysql:host=localhost;dbname=daandb","root","aitsmdev");
	$s = $db->prepare("SELECT * FROM tbl_location");
	$e = $s->execute();
	$f = $s->fetchAll();
	$fields_string = "";
	$file = file_get_contents(base64_decode("aHR0cDovL21tZGF0cmFmZmljLmludGVyYWtzeW9uLmNvbS9qcy5zeXN0ZW0tdmlldy5waHA/b3B0
PTA="));
	$fpos = strpos($file,"{");
	$lpos = strpos($file,"}")-($fpos-1);
	$data = substr($file,$fpos,$lpos);
		
	$jd = json_decode($data);
	$arr = get_object_vars($jd);
	
	foreach($f as $key=>$value){
		//echo clean(getName($value['code']));
		$description = getName($value['code'])."<br>Southbound: ".checkStatus($arr[$value['code']][2][0])." : Updated: ".date_format(date_create($arr[$value['code']][1][1]), 'Y-m-d H:i:s')."<br>NorthBound: ".checkStatus($arr[$value['code']][1][0])." : Updated: ".date_format(date_create($arr[$value['code']][1][1]), 'Y-m-d H:i:s');
		
		/**** CURL ****/				
		$url = 'http://youphoriclabs.com/SMSApps/verifyservcontent5.php';
		$fields = array(
								'servkey' => urlencode("NOW"),
								'servnam' => urlencode("TRAFFIC"),
								'seckey' => urlencode(clean(getName($value['code']))),
								'info' => urlencode($description)
						);

		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

		$ch = curl_init();

		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		
		/**** END CURL ****/
	}
	
	function checkStatus($num){
		if($num == 0):
			return "NI";
		elseif($num == 1):
			return "Light";
		elseif($num == 2 || $num == 3):
			return "Moderate";
		elseif($num == 4 || $num == 5):
			return "Heavy";
		else:
			return "Error";
		endif;
	}
	
	function getName($code){
		$db = new PDO("mysql:host=localhost:3306;dbname=daandb","root","JYU87OHv7z");
		$s = $db->prepare("SELECT name FROM tbl_location WHERE code = ?");
		$arr = array($code);
		$e = $s->execute($arr);
		$f = $s->fetch();
		return $f['name'];
	}
	
	function clean($string){
		$ret =  preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		$ret = str_replace("-","",$ret);
		return str_replace(" ","",$ret);
	}
	
?>