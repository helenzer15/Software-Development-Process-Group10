<?php 
session_start();


if($_POST){
	$name=$_POST['name'];
	$user=$_SESSION['UserID'];
	$order=$_GET['order'];

	$rating=$_POST['rate'];

	include('dblink.php');
	$sql="UPDATE `order` SET `status_send` = 'True' WHERE `order`.`order_ID` = '$order'";
		if(!mysqli_query($link, $sql)) {
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
	$sqlinsert = "INSERT INTO vote VALUES('', '$order','$user','$rating')";
	
	
	if(!mysqli_query($link, $sqlinsert)) {
		
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่ ";
	
		}
	$sqlname="UPDATE `order_details` SET `name` = '$name' WHERE `order_details`.`order_ID` = '$order'";
		if(!mysqli_query($link, $sqlname)) {
		$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
		
	if($err != "") {
		echo"<script language=\"JavaScript\">";
		echo "alert('$err')";
		echo"</script>";
		mysqli_close($link);
		exit;
	}
	
		header("location:employee_history.php");
		exit();
	}
	
	

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  position: absolute;
  top: 50%;
  left: 20px;
  right: 20px;
  transform: translateY(-50%);
  resize: vertical;
  overflow: auto;
}
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  margin: 0 auto;
  
}

input[type=submit]:hover {
  background-color: #45a049;
}
input[type=text], select, textarea {
  width: 93%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}
.col-75 {
  float: left;
  width: 80%;
  margin-top: 6px;
}
.col-90 {
  float: left;
  width: 90%;
  margin-top: 6px;
}
.col-10 {
  float: left;
  width: 10%;
  margin-top: 6px;
}
.col-25 {
  float: left;
  width: 20%;
  margin-top: 6px;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
.img-checker {
	display: none;
}

.img-checker + img {
	opacity: 0.5;
	cursor: pointer;
}

.img-checker:checked + img {
	opacity: 1.0;
}

</style>

</head>
<body>
<?php include('menu_staff.php'); ?>

<div class="container" style="height:auto;width:50%; margin: 0 auto;">

<form method='post'>

<div class="row">
<h1>กรอกข้อมูลชื่อผู้รับพัสดุปลายทาง</h1>
    <div class="col-25">
      <label for="email">ชื่อผู้รับพัสดุ</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" placeholder="กรุณากรอกชื่อผู้รับพัสดุ" >
    </div>
    </div>
    <div class="row">
        <div class="col-90">
            <label for="textvote" style="font-size: 12px; ">ขอบคุณลูกค้าที่ให้ความไว้วางใจในการใช้บริการของเรา กรุณาให้คะแนนพนักงาน (1-5)&nbsp; &nbsp; 
            <label>
            <input type="radio" name="rate" id='votepoint1' value="1" class="img-checker">
            <img src="img/star.png"  width="25 px" height="25 px">
            </label>
            <label>
            <input type="radio" name="rate" id='votepoint2' value="2" class="img-checker">
            <img src="img/star.png" width="25 px" height="25 px">
            </label>
            <label>
            <input type="radio" name="rate" id='votepoint3' value="3" class="img-checker">
            <img src="img/star.png" width="25 px" height="25 px">
            </label>
            <label>
            <input type="radio" name="rate" id='votepoint4' value="4" class="img-checker">
            <img src="img/star.png" width="25 px" height="25 px">
            </label>
            <label>
            <input type="radio" name="rate" id='votepoint5' value="5" class="img-checker">
            <img src="img/star.png" width="25 px" height="25 px">
            </label>
            </label>
        </div>
        <div class="col-10">
        	<input type="submit" value="Submit">
        </div>
    </div>
    </form>
</div>

</body>
</html>