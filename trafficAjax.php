<?php
$mainRoadvar = $_GET['mainRoadvar'];
$subRoadvar = $_GET['subRoadvar'];

$db = new PDO("mysql:host=localhost:3306;dbname=daandb","root","JYU87OHv7z");
$s = $db->prepare("SELECT name FROM tbl_location WHERE code = ?");

$arr = array($subRoadvar);
$e = $s->execute($arr);
$f = $s->fetch();

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
		$arr2 = get_object_vars(json_decode($data2."]}"));
		$advisory = array();
		foreach($arr2 as $key=>$value){
			$temparr = !is_array($value[2])?get_object_vars($value[2]):$value[2];
				foreach($value[2] as $key2=>$value2){
					//echo $key.": ".$value2[0][2]."<br><br>";
					array_push($advisory,array($key => $value2[0][2]));
				}
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
		//print_r($advisory);

echo '<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title ">Edsa -  '.$f["name"].'</h4>
       </div>
       <div class="modal-body">
          Northbound : <h3>'.checkStatus($arr[$subRoadvar][2][0]).'</h3>
          <br>
          <br>
          Southbound : <h3>'.checkStatus($arr[$subRoadvar][1][0]).'</h3>
       </div>
       <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
       </div>';
?>