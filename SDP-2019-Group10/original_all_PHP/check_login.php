<?php
	session_start();
	include('dblink.php');
	$login = $_POST['txtUsername'];
	$password =  MD5($_POST["txtPassword"]);
	$sql = "SELECT * FROM customer WHERE email = '$login' and password = '$password'";
	$objQuery = mysqli_query($link,$sql);
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{		
			echo "<script>alert('Username and Password Incorrect!');
			 location.href='login.php';</script>";
			exit();
			
		}
	else
	{
			$_SESSION["UserID"] = $objResult["user_ID"];
			$_SESSION["Status"] = $objResult["status"];

			session_write_close();
			
			if($objResult["status"] == "ADMIN" or $objResult["status"] == "admin" )
			{
				header("location:admin_page.php");
			}
			
			elseif($objResult["status"] == "EMPLOYEE")
			{
				header("location:employee_page.php");
			}
			else
			{
				header("location:user_page.php");
			}
	}
	mysqli_close($link);
?>