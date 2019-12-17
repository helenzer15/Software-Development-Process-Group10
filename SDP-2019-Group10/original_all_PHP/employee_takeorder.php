<?php 
session_start();
$_SESSION['strorder_ID']= $_GET["tkorder_ID"];
include('dblink.php');  
$emp=$_SESSION['empID'];
include('dblink.php');  
$sql="UPDATE `order` SET `emp_ID` = '$emp' WHERE `order`.`order_ID` = ".$_GET['tkorder_ID']."";
		$err='';
		if(!mysqli_query($link, $sql)) {
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
		
		if($err != "") {
			echo"<script language=\"JavaScript\">";
			echo "alert('$err')";
			echo"</script>";
			mysqli_close($link);
			exit;
		}
$query = "SELECT * FROM `order` WHERE `order_ID`= ".$_SESSION['strorder_ID'].""; 
$result = mysqli_query($link, $query); 
$row = mysqli_fetch_array($result);
$user=$row['user_ID'];
$tkorder=$row['order_ID'];
	$sqlcheck="SELECT order_ID FROM order_details WHERE `order_ID`= $tkorder"; 
	$result = mysqli_query($link, $sqlcheck);
	if(mysqli_num_rows($result) > 0) {
		header('location:employee_takeorder2.php');
}
if($_POST) {
	$size = $_POST['size'];
	$weight = $_POST['weight'];
	$qly =  $_POST['qly'];
	$err="";
	if(strlen($_POST['size'])<1){
		$err="กรุณากรอก size ด้วยตัวเลขตั้งแต่ 1 ขึ้นไป";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['size'])){
		$err="กรุณากรอก size ด้วยตัวเลขตั้งแต่ 1 ขึ้นไป";
		}
	elseif(strlen($_POST['weight'])<1){
		$err="กรุณากรอก weight ด้วยตัวเลขตั้งแต่ 1 ขึ้นไป";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['weight'])){
		$err="กรุณากรอก weight ด้วยตัวเลขตั้งแต่ 1 ขึ้นไป";
		}
	elseif(strlen($_POST['qly'])<1){
		$err="กรุณากรอก unit ด้วยตัวเลขตั้งแต่ 1 ขึ้นไป";
		}
	elseif(!preg_match("/[0-9]$/",$_POST['qly'])){
		$err="กรุณากรอก unit ด้วยตัวเลขตั้งแต่ 1 ขึ้นไป";
		}
	else{
		$err="";
		
	if ( $size > 150 or $weight > 20 ){
		$picesize=350*$qly ;
		//xl
		}
	elseif ( $size < 150 or $weight < 20 ){
		$picesize=260*$qly ;
		//xl
		}
	else if ($size < 120 or $weight < 15 ){
		$picesize=155*$qly ;
		//l
		}
	else if ($size < 105 or  $weight < 10 ){
		$picesize=70*$qly ;
		//m
		}
	else if ( $size < 60 or $weight < 5 ){
		$picesize=35*$qly ;
		//s
		}
	else{
		$picesize=0;
		//mini free
		}
	}	
$sql = "INSERT INTO order_details VALUES(
		'', '$user', '$tkorder', '$size', '$weight', '$qly','$picesize','','','')";
	if(!mysqli_query($link, $sql)) {
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
	}
	if($err != "") {
		echo"<script language=\"JavaScript\">";
		echo "alert('$err')";
		echo"</script>";
		mysqli_close($link);
		
	}
else{
		header('location:employee_takeorder2.php');
		mysqli_close($link);
		
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<?php include('css_form.php'); ?>
<style>
a:link, a:visited {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: left;
}

a:hover, a:active {
  background-color: #45a049;
}
</style>
</head>
<body>

<div id="head">
<h1><img src="img/KMITL_Logo.png"></h1>	
</div>
<div id="content" style="width:50%; margin: 0 auto;">
<h3>รายชื่อลูกค้า</h3>
	<?php 
		$sqluser="SELECT * FROM `customer` WHERE `user_ID` = '".$row['user_ID']."'";
		$objQueryuser = mysqli_query($link,$sqluser);
		$objResultuser = mysqli_fetch_array($objQueryuser);  
		echo "คุณ " .$objResultuser["fist_name"] . " ".$objResultuser["last_name"]." ";
		echo "เบอร์โทรติดต่อ " .$row["phone"] ;
		mysqli_close($link);
    ?>
<br>

</div>

<div class="container" style="height:auto;width:50%; margin: 0 auto;">
<div align="center"><img src='img/box.png' width='250 px'></div>	
  <form method='post'>
  <h3>ข้อมูลพัสดุ<h3>
  <div class="row" >
    <div class="col-25">
      <label for="size">ขนาด</label>
    </div>
    <div class="col-75">
      <input type="number" id="size" name="size" placeholder="Cm." > 
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="wight">น้ำหนัก</label>
    </div>
    <div class="col-75">
      <input type="number" id="wight" name="weight" placeholder="Kg."> 
    </div>

  </div>
  <div class="row">
    <div class="col-25">
      <label for="qly">จำนวน</label>
    </div>
    <div class="col-75">
      <input type="number" id="qly" name="qly" placeholder="Unit">
    </div>
  </div>
   

   <div class="row">
    <div class="col-25">
      <a href="employee_booking.php">Back</a>
   </div>
   	<div class="col-75">
      <input type="submit" value="Next">
    </div>
  </div>
 </form>
</div>
</body>
</html>