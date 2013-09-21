<?php
	$db = new PDO("mysql:host=localhost:3306;dbname=daandb","root","JYU87OHv7z");
	$s = $db->prepare("SELECT * FROM tbl_location");
	$e = $s->execute();
	$f = $s->fetchAll();
	
	if(isset($_POST['loc'])){
		$loc = $_POST['loc'];
		$file = file_get_contents('http://mmdatraffic.interaksyon.com/js.system-view.php?opt=0');
		$fpos = strpos($file,"{");
		$lpos = strpos($file,"}")-($fpos-1);
		$data = substr($file,$fpos,$lpos);
		
		$jd = json_decode($data);
		$arr = get_object_vars($jd);
		echo getName($_POST['loc'])."<br>Southbound: ".checkStatus($arr[$loc][2][0])." : Updated: ".date_format(date_create($arr[$loc][1][1]), 'Y-m-d H:i:s')."<br>NorthBound: ".checkStatus($arr[$loc][1][0])." : Updated: ".date_format(date_create($arr[$loc][1][1]), 'Y-m-d H:i:s');
	}
	
	function checkStatus($num){
		if($num == 0):
			return "NI";
		elseif($num == 1):
			return "Light";
		elseif($num == 2):
			return "Moderate";
		elseif($num == 3):
			return "Heavy";
		else:
			return "Error";
		endif;
	}
	
	function getName($code){
		$db = new PDO("mysql:host=localhost;dbname=daandb","root","");
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