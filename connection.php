<?php
session_start();
if(!isset($_SESSION["login_status"]) || !isset($_SESSION["login_admin_id"]))
{
	header("location:/login.php");
	exit();
}
	$con=mysqli_connect("localhost","root","","resource");
	$admin_id = $_SESSION["login_admin_id"];
	$query = "SELECT * FROM employee WHERE email='$admin_id'";
	$res = mysqli_query( $con, $query );
	$ADMIN = mysqli_fetch_object( $res );
?>