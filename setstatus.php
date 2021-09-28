<?php 
session_start();
require_once 'dbconnect.php';



if(isset($_REQUEST['applicationId']) && isset($_REQUEST['status']))
{
	//-----varaibles-------------
	$requ=$_REQUEST['applicationId'];
	$status=$_REQUEST['status'];
	$iRow = null;
	
	$query="UPDATE `applications` SET  `status` =  '$status' WHERE  `applicationId` =".$requ;
	

	$invoice_link="";

	if($requ!=""){
		// select loggedin users detail
		$res=mysqli_query($conn,"SELECT * FROM applications WHERE applicationId= '$_REQUEST[applicationId]'");
		$iRow=mysqli_fetch_array($res);
	}
		
			

	$senderId=$_SESSION['company'];
	$recepientId=$iRow['userId'];
		
	$internshipId=$iRow['internshipId'];
	$applicationId=$iRow['applicationId'];
		
	$invoiceNo="IP-".mt_rand(999999,9999999);;

	$result=mysqli_query($conn,$query);
	if($result)
	{
		// echo "Success";
	}
	else
	{
		echo "Error:: ".mysqli_error($conn);
		exit;
	}

	if($status=="Approved"){
		$invoice_link='Print Invoice: <a href="invoice.php?invoiceNumber='.$invoiceNo.'" target="_blank" style="color:rgba(230, 161, 52, 1);font-size:14px;"><u>Click here </u></a>';

	//INSERT INTO INVOICE
	$query="INSERT INTO `invoice` (`invoiceId`, 
		`userId`,
		`companyId`,
		`internshipId`,
		`applicationId`,
		`invoiceNumber`) 
		VALUES (NULL, 
		'$recepientId',
		'$senderId',
		'$internshipId',
		'$applicationId',
		'$invoiceNo');";
		$result=mysqli_query($conn,$query); 

	if($result)
	{
		// echo "Success";
	}
	else
	{
		echo "Error:: ".mysqli_error($conn);
		exit;
	}
}
$internshipId=$iRow['internshipId'];

$link_visit='Internship details: <a href="viewinternship.php?internshipId='.$internshipId.'" target="_blank"  style="color:rgba(230, 161, 52, 1);font-size:14px;"><u>Click here</u></a>';
	  
  switch ($status) {
    case 'Pending':
       $status_span='<span class="label label-warning">Pending</span>';
      break;
    
    case 'Approved':
	   	$status_span='<span class="label label-primary">Approved</span>';
		$_SESSION['title']="Great";
		$_SESSION['message'] ='Hiring successful. Intern has been informed.';
      break;

      case 'Denied':
		$status_span='<span class="label label-danger">Denied</span>';
		$_SESSION['title']="Great";
		$_SESSION['message'] ='Application has been rejected. Intern has been informed.';
      break;
  }
if($invoice_link=="" && $status!="Approved"){
	$message="Your application status has been updated as ".$status_span."<br/>".$link_visit;
}else if($invoice_link!="" && $status=="Approved")
{

$link_visit='Internship details: <a href="viewinternship.php?internshipId='.$internshipId.'" style="color:rgba(230, 161, 52, 1);font-size:14px;"><u>Click here</u></a>';
	$message="Congratulations! Your application has been ".$status_span."<br/>".$link_visit."<br/>".$invoice_link;
}
 	//SEND CHAT MESSAGE
	$query="INSERT INTO `messages` (`messageId`, 
		`senderId`,
		`recepientId`,
		`message`) 
		VALUES (NULL, 
		'$senderId',
		 '$recepientId', 
		 '$message');";
		$result=mysqli_query($conn,$query);



	if($result)
	{
		// echo "Success";
	}
	else
	{
		echo "Error:: ".mysqli_error($conn);
		exit();
	}

	$path="companyapplications.php";
// //	mail to company
// 	//mail("dr.scrolls@gmail.com", $subject, $message);
// 	//echo '<script>alert("Success - your application has been successful sent");</script>';
	header("Refresh: 0; URL =".$path);



}

?>