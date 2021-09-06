<?php
session_start();
require_once 'dbconnect.php';

// if(isset($_SESSION['user'])!=""){
// 	header("Location: main.php");
// }
// if(!isset($_SESSION['company']))
// {
// 	header("Location: index.php");
// }

if(isset($_SESSION['company'])=="" ) {
	echo "Session == ''";
	header("Location: index.php");
	exit;	
}


$s=$_SESSION['company'];
$res=mysqli_query($conn,"SELECT * FROM company where `companyId`=".$s);

$res=mysqli_query($conn,"SELECT * FROM company WHERE companyId= ".$_SESSION['company']);
$cRow=mysqli_fetch_array($res);
//	echo "Session ".$_SESSION['company'];
	//$userRow=mysqli_fetch_array($res);
	
//	$ores=mysqli_query($conn,"SELECT * FROM constants");
	//$orderbyRow=mysqli_fetch_array($ores);


	while($userRow=mysqli_fetch_array($res))
	{
		$companyName=$userRow['companyname'];
//	echo "companyName = ".$userRow['companyname'];
		//$varo=$orderbyRow['orderby'];
	}

//echo "Session name= ".$companyName;



if(isset($_POST['title']) && isset($_POST['desc']))
{
	//variables
	$title=$_POST['title'];
	$desc=$_POST['desc'];
	$skillsneeded=$_POST['skillsneeded'].",".$_POST['getskill'];
	
	$city=$_POST['city'];
	$region=$_POST['region'];
	$genderspecific=$_POST['genderspecific'];
	$coursespecific=$_POST['coursespecific'];
	$giveallowance=$_POST['giveallowance'];
	$allowanceprice=$_POST['allowanceprice'];
	$allowanceperiod=$_POST['allowanceperiod'];
	if ($giveallowance=='No') {
		$allowanceperiod="none";
		$allowanceprice="none";
	
	}

	$attributes=$_POST['attributes'];
	$agemin=$_POST['agemin'];
	$agemax=$_POST['agemax'];
	

	$levelspecific=$_POST['levelspecific'];
	$hoursmin=$_POST['hoursmin'];
	$hoursmax=$_POST['hoursmax'];
	
	if($hoursmax=="" && $hoursmin=="")
	{
		$hoursmin=0;
		$hoursmax=0;
	}
	else{
		$hoursmin=$_POST['hoursmin'];
		$hoursmax=$_POST['hoursmax'];
	}
	
	$needexperience=$_POST['needexperience'];
	if($needexperience=='-Please Select-')
	{
		$needexperience='<none>';
	}
	$yearsexperience=$_POST['yearsexperience'];
	if($needexperience=='<none>')
	{
		
			$yearsexperience=0;
		
		
	}

	if(empty($yearsexperience))
		{
			$yearsexperience=0;
		}
		

	$additionalinfo=$_POST['additionalinfo'];
if($additionalinfo=="")
	{
		$additionalinfo="<none>";
	}



	// $currTime=gmmktime();
	// $currDate=gmdate(d);
	// $currDate+='/'.gmdate(m);
	// $currDate+='/'.gmdate(y);
	// $agerange='From '.$agemin.' to '.$agemax;
	// $workhours='From '.$hoursmin.'am to '.$hoursmax.'pm';
	

	$companyId=$_SESSION['company'];

	//$companyName=$_SESSION['companyname'];
		
	$query="INSERT INTO `internships` (
	`internshipId`, 
	`title`,
	`description`,
	`companyId`, 
	`companyname`, 
	`skillsneeded`, 
	`city`,
	`region`, 
	`genderspecific`,
	`giveallowance`,
	`allowanceamount`,
	`allowanceperiod`,
	`coursespecific`,
	`attributes`,
	`currentdate`,
	`currenttime`,
	`agerange`,
	`agemin`,
	`agemax`,
	`level`,

	`needexperience`,
	`yearsexperience`,

	`workinghours`,
	`hoursmin`,
	`hoursmax`,
	`additionalinfo`) 
VALUES (NULL, 
'$title',
 '$desc',
 '$companyId',
 '$companyName', 
 '$skillsneeded', 
 '$city',
 '$region',
 '$genderspecific', 
 '$giveallowance',
 '$allowanceprice',
 '$allowanceperiod',
 '$coursespecific',
 '$attributes',
 '$currDate',
 '$currTime',
 '$agerange',
 '$agemin',
 '$agemax',
 '$levelspecific',
 '$needexperience',
 '$yearsexperience',
 '$workhours',
 '$hoursmin',
 '$hoursmax',
 '$additionalinfo');";
	
	
	$result=mysqli_query($conn,$query);
	
	if($result)
	{
		$smsg="Internship inserted successfully";
		header("Refresh: 1; URL = main_company.php");
		$_SESSION['message']="You internship has been successfully posted";
		$_SESSION['title']="Great";
		// header("Location: main_company.php");
	exit;
	
	}else
	{
		
		$fmsg="Internship entry failed" . mysqli_error($conn);
	}
		
		
}
	
		
?>
