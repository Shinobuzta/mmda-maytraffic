<?php
	set_time_limit(0);

	$db = new PDO("mysql:host=localhost;dbname=daandb","root","aitsmdev");
	$s = $db->prepare("SELECT * FROM tbl_location");
	$e = $s->execute();
	$f = $s->fetchAll();
	
	if(isset($_POST['loc'])){
		$loc = $_POST['loc'];
		$file = file_get_contents(base64_decode("aHR0cDovL21tZGF0cmFmZmljLmludGVyYWtzeW9uLmNvbS9qcy5zeXN0ZW0tdmlldy5waHA/b3B0
PTA="));
		$fpos = strpos($file,"{");
		$lpos = strpos($file,"}")-($fpos-1);
		$data = substr($file,$fpos,$lpos);
		$fpos2 = strpos($file,"{",($fpos+1));
		$end = strpos($file,";",30);
		$end2 = strpos($file,";",$end+1);
		$lpos2 = strpos($file,"}",$end2-10);
		$data2 = substr($file,$fpos2,$lpos2-$fpos2+1);
		$jd = json_decode($data);
		$arr = get_object_vars($jd);
		$arr2 = get_object_vars(json_decode($data2));
		$advisory = array();
		foreach($arr2 as $key=>$value){
			$temparr = !is_array($value[2])?get_object_vars($value[2]):$value[2];
				foreach($value[2] as $key2=>$value2){
					//echo $key.": ".$value2[0][2]."<br><br>";
					array_push($advisory,array($key => $value2[0][2]));
				}
		}
		//print_r($advisory);
		echo getName($_POST['loc'])."<br>Southbound: ".checkStatus($arr[$loc][2][0])." : Updated: ".date_format(date_create($arr[$loc][1][1]), 'Y-m-d H:i:s')."<br>NorthBound: ".checkStatus($arr[$loc][1][0])." : Updated: ".date_format(date_create($arr[$loc][1][1]), 'Y-m-d H:i:s');
	}
	
	function checkStatus($num){
		if($num == 0):
			return "NI";
		elseif($num == 1):
			return "<a style='color: #009900'>Light</a>";
		elseif($num == 2 || $num == 3):
			return "<a style='color: #f2c100'>Moderate</a>";
		elseif($num == 4 || $num == 5):
			return "<a style='color: #f40000'>Heavy</a>";
		else:
			return "Error";
		endif;
	}
	
	function getName($code){
		$db = new PDO("mysql:host=localhost;dbname=daandb","root","aitsmdev");
		$s = $db->prepare("SELECT name FROM tbl_location WHERE code = ?");
		$arr = array($code);
		$e = $s->execute($arr);
		$f = $s->fetch();
		return $f['name'];
	}
?>
<form id="trafficfrm" method="post">
	<select name="loc" onchange="document.getElementById('trafficfrm').submit()">
		<?php
			foreach($f as $key=>$value){
				echo '<option value="'.$value[1].'">'.$value[2]."</option>";
			}
		?>
	</select>
</form>