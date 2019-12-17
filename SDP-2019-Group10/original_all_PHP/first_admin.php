<?php 
session_start();
if(!$_SESSION['UserID'])
	{   
		header("location:login.php");
		exit("Please Login!");
	}
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;
}
.button{
	background-color: #4CAF50;
	color: white;
	padding: 12px 20px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
	float: right;
	width: 100%;
}
</style>

</head>

<body>
<div >
  <?php include('admin_menu.php'); ?>
</div>
<table width="100%" border="1">
  <tr>
    <th scope="col" width="30%" valign="top">
    	<table width="33%"  border="1" id="customers">
  <tr>
  <th colspan="6">รายชื่อลูกค้าทั้งหมด</th>
  </tr>
  <tr>
    <th width="10%" height="20 px" scope="col">User_ID</th>
    <th width="25%" scope="col">Email</th>
    <th scope="col">รายละเอียดลูกค้า</th>
    <th width="10%" scope="col">รหัสพนักงาน</th>
    
  </tr>
  
  	<?php 
include('dblink.php');
$query = "SELECT * FROM `customer` WHERE `status`='EMPLOYEE'" ;
$result = mysqli_query($link, $query); 
while($row = mysqli_fetch_array($result)){
	$userID=$row["user_ID"];
	$emailID=$row["email"];	
	$fnameID=$row["fist_name"];
	$lnameID=$row["last_name"];
	$phonID=$row["telephon"];
	$address=$row["address"];
	$subject="Name: $fnameID $lnameID </br> Phone number : $phonID </br> Address : $address";
?>	<tr>
    <td width="10%" scope="row"><?php echo($userID);?></td>
    <td width="25%"><?php echo($emailID);?></td>
    <td  align="left"><?php echo($subject);?></td>
    <td width="10%">
    <?php 
	$queryck = "SELECT * FROM `employee` WHERE `user_ID`='$userID'" ;
	
	if(mysqli_num_rows(mysqli_query($link, $queryck)) > 0) {
		$data = mysqli_fetch_array(mysqli_query($link, $queryck));
		echo($data['emp_ID']);
		}
	else{
	?>
    <button class='button' onclick="<?php echo("location.href='admin_code_employee.php?user_ID=$userID'");?> ">เพิ่ม</button><?php }?>
    </td>
  
  </tr>
<?php } ?></table></th>







    
    
    
    
    
    
    
    
    
    

    
    
    <th scope="col" width="33%" valign="top">
    	<table width="100%"  border="1" id="customers">
  <tr>
  <th colspan="5">รายชื่อลูกค้าทั้งหมด</th>
  </tr>
  <tr>
    <th width="10%" height="20 px" scope="col">User_ID</th>
    <th width="25%" scope="col">Email</th>
    <th scope="col">รายละเอียดลูกค้า</th>    
  </tr>
  
  	<?php 
include('dblink.php');
$query = "SELECT * FROM `customer` WHERE `status`='user'" ;
$result = mysqli_query($link, $query); 
while($row = mysqli_fetch_array($result)){
	$userID=$row["user_ID"];
	$emailID=$row["email"];
	$fnameID=$row["fist_name"];
	$lnameID=$row["last_name"];
	$phonID=$row["telephon"];
	$address=$row["address"];
	$subject="Name: $fnameID $lnameID </br> Phone number : $phonID </br> Address : $address";
?>	<tr>
    <td width="10%" scope="row"><?php echo($userID);?></td>
    <td width="25%"><?php echo($emailID);?></td>
    <td  align="left"><?php echo($subject);?></td>
    
  </tr>
<?php } ?>
</table> 

    </th>
  </tr>
</table>

</div>
  </tr>
</table>
</body>

</html>
