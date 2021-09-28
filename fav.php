<?php 
session_start();
require_once 'dbconnect.php';

$userId=$_REQUEST[userId];
$internshipId=$_REQUEST[internshipId];
// echo "UserId=".$userId."<br/>";
// echo "internshipId=".$internshipId."<br/>";


	// select loggedin users detail
	$res=mysqli_query($conn,"SELECT * FROM favs WHERE internshipId=".$internshipId." AND userId= ".$userId.";");
	$row=mysqli_fetch_array($res);

	if(!$res)
	{
		echo "Error:: ".mysqli_error($conn);
	}

	// echo "db-favstate = ".$row['favstate'];

	if($row['favId'])
	{
			
			if($row['favstate']=="true"){
			
			$favstate="false";
			  $query= "UPDATE  `favs` SET  `favstate` =  '".$favstate."' WHERE internshipId=".$internshipId." AND userId= ".$userId.";";
			  $result=mysqli_query($conn,$query);
			}else if($row['favstate']=="false"){
			
			$favd="true";
			  $query= "UPDATE  `favs` SET  `favstate` =  '".$favd."' WHERE internshipId=".$internshipId." AND userId= ".$userId.";";
			  $result=mysqli_query($conn,$query);
			}
			$res=mysqli_query($conn,"SELECT * FROM favs WHERE internshipId=".$internshipId." AND userId= ".$userId.";");
			$row=mysqli_fetch_array($res);
			// echo "</br>new db-favstate = ".$row['favstate'];
			

	}else {
	
	$query="INSERT INTO `favs` (`favId`, 
		`userId`,
		`internshipId`,
		`favstate`) 
		VALUES (NULL, 
		'$userId',
		 '$internshipId', 
		 'true');";
		$result=mysqli_query($conn,$query);
	}
	 	
	

	$path="viewinternship.php?internshipId=".$internshipId;
//	mail to company
	//mail("dr.scrolls@gmail.com", $subject, $message);
	//echo '<script>alert("Success - your application has been successful sent");</script>';
		$_SESSION['title']='<b><center>Great job</center></b>';
	$_SESSION['message'] ='You have  marked this as your favourite';
	header("Location:".$path);


?>