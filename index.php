<?php
set_time_limit(0);

   $db = new PDO("mysql:host=localhost:3306;dbname=daandb","root","JYU87OHv7z");
   $s = $db->prepare("SELECT * FROM tbl_location");
   $e = $s->execute();
      $advisory = array();
   $f = $s->fetchAll();
   
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
      foreach($arr2 as $key=>$value){
         $temparr = !is_array($value[2])?get_object_vars($value[2]):$value[2];
            foreach($value[2] as $key2=>$value2){
               //echo $key.": ".$value2[0][2]."<br><br>";
               array_push($advisory,array($key => $value2[0][2]));
            }
      }
      //print_r($advisory);
      /*echo getName($_POST['loc'])."<br>Southbound: ".checkStatus($arr[$loc][2][0])." : Updated: ".date_format(date_create($arr[$loc][1][1]), 'Y-m-d H:i:s')."<br>NorthBound: ".checkStatus($arr[$loc][1][0])." : Updated: ".date_format(date_create($arr[$loc][1][1]), 'Y-m-d H:i:s');*/
   
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
      $db = new PDO("mysql:host=localhost:3306;dbname=daandb","root","JYU87OHv7z");
      $s = $db->prepare("SELECT name FROM tbl_location WHERE code = ?");
      $arr = array($code);
      $e = $s->execute($arr);
      $f = $s->fetch();
      return $f['name'];
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Welcome to MayTraffic</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap -->
      <link href="css/united.css" rel="stylesheet" media="screen">
      <link href="css/template.css" rel="stylesheet" media="screen">
      <link href="css/index.css" rel="stylesheet" media="screen">
      <script type="text/javascript">
         
         function showTrafficStatus(){
         var xmlhttp;
         if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
         }
         else {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         }

         xmlhttp.onreadystatechange=function()
         {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
               document.getElementById("responseModalBody").innerHTML=xmlhttp.responseText;
            }
         }
         var mainRoadvar = document.getElementById("mainRoad").value;
         var subRoadvar = document.getElementById("subRoad").value;

         xmlhttp.open("GET","trafficAjax.php?mainRoadvar="+mainRoadvar+"&subRoadvar="+subRoadvar,true);
         xmlhttp.send();
      }
      </script>
   </head>
<body>

   <!-- Navigation Bar -->
   <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">May <span class="glyphicon glyphicon-road"></span> Traffic</a>
         </div>

         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
               <li><a href="#">About</a></li>
               <li><a href="#">Contact Us</a></li>
               <li><a href="#">FAQs</a></li>
            </ul>
         </div><!-- /.navbar-collapse -->
      </div><!-- /.Container -->
   </nav><!-- /.navbar -->

   <div class="banner text-center">
      <a href="demo.html" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-eye-open"></span> View Demo</a>
   </div>

   <div class="container contents">
      <hr>
      <div class="col-md-7">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <h3 class="panel-title">Advisories</h3>
            </div>
            <div class="panel-body">
               <div id="advisories">
                  <?php                 
                     foreach($advisory as $key=>$value){
                        foreach($value as $key2=>$value2){
                           echo '<blockquote>
                              <h4>'.getName($key2).'</h4>
                              '.$value2.'
                              <small>Since <em>September 21, 2013</em></small>
                              </blockquote>
                              <hr>';
                        }                        
                     }
                     
                  ?>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-5">
         <div class="panel panel-success">
            <div class="panel-heading">
               <h3 class="panel-title">Traffic Status</h3>
            </div>
            <div class="panel-body">
               <form role="form">
                  <div class="form-group">
                     <label class="control-label text-muted">Main road</label>
                     <select class="form-control" id="mainRoad">
                        <option value="1" selected>Edsa</option>
                        <option value="2">Commonwealth</option>
                        <option value="3">Quezon Ave</option>
                        <option value="4">Espana</option>
                        <option value="5">C5</option>
                        <option value="6">Ortigas</option>
                        <option value="7">Marcos Highway</option>
                        <option value="8">Roxas</option>
                        <option value="9">SLEX</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label class="control-label text-muted">Sub - Road</label>
                     <select class="form-control"  id="subRoad">
                        <option value="1_1">Balintawak</option>
                        <option value="1_2">Kaingin Road</option>
                        <option value="1_3">Munoz</option>
                        <option value="1_4">Bansalangin</option>
                        <option value="1_5">North Ave.</option>
                        <option value="1_6">Trinoma</option>
                        <option value="1_7">NIA Road</option>
                        <option value="1_8">Quezon Ave.</option>
                        <option value="1_9">Timog</option>
                        <option value="1_10">Kamuning</option>
                        <option value="1_11">New York - Nepa Q-Mart</option>
                        <option value="1_12">Monte De Piedad</option>
                        <option value="1_13">Aurora Blvd. </option>
                        <option value="1_14">Mc Arthur - Farmers</option>
                        <option value="1_15">P. Tuazon</option>
                        <option value="1_16">Main Ave.</option>
                        <option value="1_17">Santolan</option>
                        <option value="1_18">White Plains</option>
                        <option value="1_19">Ortigas Ave.</option>
                        <option value="1_20">SM Megamall</option>
                        <option value="1_21">Shaw Blvd.</option>
                        <option value="1_22">Reliance</option>
                        <option value="1_23">Pioneer - Boni</option>
                        <option value="1_24">Guadalupe</option>
                        <option value="1_25">Orense</option>
                        <option value="1_26">Kalayaan - Estrella</option>
                        <option value="1_27">Buendia</option>
                        <option value="1_28">Ayala Ave.</option>
                        <option value="1_29">Arnaiz - Pasay Road</option>
                        <option value="1_30">Magallanes</option>
                        <option value="1_31">Malibay</option>
                        <option value="1_32">Tramo</option>
                        <option value="1_33">Taft Ave.</option>
                        <option value="1_34">F.B. Harrison</option>
                        <option value="1_35">Roxas Boulevard</option>
                        <option value="1_36">Macapagal Ave.</option>
                        <option value="1_37">Mall of Asia</option>
                     </select>
                  </div>
                  <button class="btn btn-success btn-block" data-toggle="modal" href="#trafficStatusModal" onClick="showTrafficStatus();"><span class="glyphicon glyphicon-ok"></span> Go </button>
               </form>
            </div>
         </div>
         <div class="panel panel-info">
            <div class="panel-heading">
               <h3 class="panel-title">News feeds</h3>
            </div>
            <div class="panel-body">
               <div id="newsfeed">
                  <blockquote>
                     HUSSLE!!!! Banggaan pa d2 S Edsa Camuning :(
                     <small>by +63921****230</small>
                  </blockquote>
                  <hr>
                  <blockquote>
                     Grabe traffic s Boni
                     <small>by +63921****243</small>
                  </blockquote>
                  <hr>
                  <blockquote>
                     Lakas ng ulan s guadalupe pila pah
                     <small>by +63921****440</small>
                  </blockquote>
                  <hr>
                  <blockquote>
                     EDSA KAMUNING!!!!!
                     <small>by +63921****231</small>
                  </blockquote>
                  <hr>
               </div>
            </div>
            <div class="panel-footer text-muted"><small> - Send MAYTRAFFIC FEEDS {message} to 6800</small></div>
         </div>
      </div>
   </div> <!-- /container -->

   <div class="footerBanner">
      <div class="container" style="height:230px;">
         <div class="col-md-3 col-sm-4 col-xs-6">
            <h4><span class="glyphicon glyphicon-thumbs-up"></span> Social</h4>
            <hr class="style-two">
            <a href="#">Facebook</a>
            <br>
            <a href="#">Twitter</a>
         </div>
         <div class="col-md-3 col-sm-4 col-xs-6">
            <h4><span class="glyphicon glyphicon-briefcase"></span> Contact Us</h4>
            <hr class="style-two">
         </div>
         <div class="col-md-3 col-sm-4 col-xs-6">
            <h4><span class="glyphicon glyphicon-user"></span> Developers</h4>
            <hr class="style-two">
         </div>
         <div class="col-md-3 col-sm-4 col-xs-6">
            <h4><span class="glyphicon glyphicon-envelope"></span> Subscribe</h4>
            <div class="input-group">
               <input type="text" class="form-control" placeholder="Email Address">
               <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">Go!</button>
               </span>
            </div>
         </div>
      </div>
      <div class="copyright">
         <div class="container text-center">
            <small><span class="glyphicon glyphicon-copyright-mark"></span> Copyright 2012. Team Evil Genius. All rights reserved.</small>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" style="color:#000;" id="trafficStatusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog" style="width:350px;">
            <div id="responseModalBody" class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title ">- - -</h4>
               </div>
               <div class="modal-body">
                  Northbound : <span class="label label-info">Processing...</span>
                  <br>
                  <br>
                  Southbound : <span class="label label-info">Processing...</span>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
               </div>
            </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
   </div>
   <script src="js/jquery.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>
</html>