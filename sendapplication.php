<?php 
session_start();
require_once 'dbconnect.php';

$requ=$_REQUEST['id'];
// echo "SendApplication.php requ=".$requ;

if($requ!=""){
	// select loggedin users detail
	$res=mysqli_query($conn,"SELECT * FROM internships WHERE internshipId= '$_REQUEST[id]'");
	$iRow=mysqli_fetch_array($res);

 	 $res=mysqli_query($conn,"SELECT * FROM company WHERE companyId= ".$iRow['companyId'].";");
	$cRow=mysqli_fetch_array($res);
 	 }
 	// echo "<br/>_REQUEST= ".$_REQUEST[id];
 	// echo "<br/>user= ".$_SESSION['user'];
	
	if(isset($_SESSION['user'])!="")
	{
		$qres=mysqli_query($conn,"SELECT * FROM users WHERE userId= ".$_SESSION['user']);
		$userRow=mysqli_fetch_array($qres);
	}
	 	
	


// echo "iRow = ".$iRow['companyId'];




if(isset($_POST['send-btn']))
{
	//-----varaibles-------------
	$companyId=$_POST['companyId'];
	$internshipId=$_POST['internshipId'];
	$userId=$_SESSION['user'];


	// echo "<br/>---------";
	// exit();
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	$attach_cv=$_POST['attach_cv'];
	$email=$cRow['companyemail'];

/*
	//SET SENDER HEADER
	$senderheader="From: ".$userRow['userfname']." ".$userRow['userlname']." <".$userRow['useremail']."> ";


	//SEND EMAIL
	mail($email, $subject, $message,$senderheader);
*/

	$query="INSERT INTO `applications` (`applicationId`, 
		`userId`,
		`companyId`,
		`internshipId`, 
		`message`, 
		`subject`, 
		`attach_cv`) 
		VALUES (NULL, 
		'$userId',
		 '$companyId',
		 '$internshipId', 
		 '$message', 
		 '$subject',
		 '$attach_cv');";
		$result=mysqli_query($conn,$query);
		
		
		// echo "query = ".$query;
		// exit();


	if($result)
	{
		// echo "Success";
		$_SESSION['title']="Good job";
		$_SESSION['message'] ='Your application has been successfully sent';
	}
	else
	{
		echo "Error:: ".mysqli_error($conn);
	}

	//SEND CHAT MESSAGE
	$query="INSERT INTO `messages` (`messageId`, 
		`senderId`,
		`recepientId`,
		`message`) 
		VALUES (NULL, 
		'$userId',
		 '$companyId', 
		 '$message');";
		$result=mysqli_query($conn,$query);



	if($result)
	{
		// echo "Success";
		$_SESSION['message'] = $_SESSION['message']. ". You will be notified when the company responds.";
	}
	else
	{
		echo "Error:: ".mysqli_error($conn);
	}
	$path="viewinternship.php?internshipId=".$internshipId;
	
	//	mail to company
	//mail("dr.scrolls@gmail.com", $subject, $message);
	//echo '<script>alert("Success - your application has been successful sent");</script>';
	header("Refresh: 1; URL =".$path);



}

?>