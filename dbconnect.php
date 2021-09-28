<?php 
error_reporting(~E_DEPRECATED & ~E_NOTICE);

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','interndb');
/*
$conn = mysqli_connect('localhost' ,'root','');
$dbcon= mysqli_select_db('interndb');*/
$conn=mysqli_connect("localhost","root","","interndb")or die("can not connect");
$dbcon= mysqli_select_db($conn,'interndb');

if(!$conn)
{
	die("Connection failed : ". mysqli_error($conn));
}

if(!$dbcon)
{
	die("Database Connection failed : ". mysqli_error($conn));
}




?>