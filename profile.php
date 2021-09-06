<?php 
session_start();
require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
	
	// select loggedin users detail
		

	//echo "$_REQUEST[userId]=".$_REQUEST[userId];
	//echo "Session=".$_SESSION['company']."<br/>";
	if(!empty($_REQUEST[userId]))
	{
		//echo "Is not empty;=".$_REQUEST[userId];

				$c_query = $conn->query("SELECT * FROM `users` WHERE `userId` = '$_REQUEST[userId]'") or die(mysqli_error());
				$userRow = $c_query->fetch_array();
				$club = $userRow['userId'];
	}else
	{
		$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
//	echo "Session ".$_SESSION['user'];
		$userRow=mysqli_fetch_array($res);
	}
	//echo "userfname=".$userRow['userfname'];


//$q="select * from jobs where j_active=1 order by j_id desc ";
//$res=mysqli_query($link,$q) or die ("can not select database");
//echo "Welcome ". $userRow['useremail'];

	if(!empty($userRow['userphoto']))
{

$str=strpos($userRow['userphoto'],'uploads/');
$len=strlen($userRow['userphoto']);
$imgCustPath=substr($userRow['userphoto'], $str,$len);

}
else{

	$imgCustPath="uploads/pictures/default.png";
}

?>
<!DOCTYPE html>
<html lang="en">
    <body>

        <?php include 'header_loggedin.php'; ?>

        <div class="page-wrapper">
                
            <?php include 'sidebar.php'; ?>
                
                <!-- Page Content-->
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="float-right">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                                            <li class="breadcrumb-item active">Profile</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Profile</h4>
                                </div><!--end page-title-box-->
                            </div><!--end col-->
                        </div>
                        <!-- end page title end breadcrumb -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">                                                            
                                    <div class="card-body">   
                                        <div class="row">
                                            <div class="col-lg-9 align-self-center">
                                                <div class="media">
                                                    <img  src="<?php echo $imgCustPath; ?>" onerror="this.src='assets/images/users/user-8.jpg';" alt="user" style="width: 120px; height: 120px;" class="rounded-circle mr-3 align-self-center">
                                                    <div class="media-body align-self-center">
                                                        <h4 class="mt-0 mb-1"><?php echo $userRow['userfname']." ". $userRow['userlname'];?></h4>
                                                        <p class="mb-1 text-muted"><?php echo $userRow['useremail']; ?></p>
                                                        <p class="mb-1 text-muted"><?php echo $userRow['userprimaryphone']; ?></p>
                                                        <p class="mb-1 text-muted"><?php echo $userRow['usercityofresidence'].", ". $userRow['userregionofresidence']; ?></p>
                                                       
                                                    </div>
                                                </div> 
                                            </div><!--end col--> 
                                            <div class="col-lg-3 ml-auto">
                                                <div class="button-items mt-4">
                                                    <!-- <button type="button" class="btn btn-dark  btn-block">Edit</button> -->
                                                </div>
                                            </div><!--end col--> 
                                        </div><!--end row-->
                                    </div><!--end card-body-->                                                                     
                                </div><!--end card-->
                            </div><!--end col-->
                            
                            
                        </div><!--end row-->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">                                       
                                    <div class="card-body"> 
                                        <h4 class="header-title mt-0 mb-3">About me</h4>
                                        <div class="slimscroll education-activity">
                                            <div class="activity">
                                                <i class="mdi mdi-face-recognition icon-success"></i>
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-0">Personal information</h6>
                                                        </div>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Firstname: <?php echo $userRow['userfname']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Lastname: <?php echo $userRow['userlname']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Date of birth: <?php echo $userRow['userdob']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Gender: <?php echo $userRow['usergender']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">City/Town: <?php echo $userRow['usercityofresidence']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Region: <?php echo $userRow['userregionofresidence']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Postal Address: <?php echo $userRow['userpostaladdress']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Residential Address: <?php echo $userRow['userresidentialadd']; ?></p>

                                                    </div>
                                                </div>
                                                <i class="mdi mdi-clipboard-account-outline icon-pink"></i>                                                                                                           
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-0">Account information</h6>
                                                        </div>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Email: <?php echo $userRow['useremail']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Identification Card: <?php echo $userRow['userIdType']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Id Number: <?php echo $userRow['userIdNumber']; ?></p>
                                                    </div>                                            
                                                </div>
                                                <i class="mdi mdi-cellphone-basic icon-warning"></i> 
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-0">Contact</h6>
                                                        </div>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Primary phone number: <?php echo $userRow['userprimaryphone']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Secondary phone number: <?php echo $userRow['usersecondaryphone']; ?></p>
                                                    </div>
                                                </div>                                         
                                                <i class="mdi mdi-account-check icon-purple"></i>
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-0">Skills</h6>
                                                        </div>
                                                                                                            
                                                        <div>
                                                            <?php 

                                                                $skillsArray [] = explode(',', $userRow['userskill']);
                                                                foreach($skillsArray as $i => $skill){
                                                            ?>
                                                                <span class="badge badge-soft-secondary"><?php echo $skill[$i]; ?></span>
                                                            <?php
                                                                }

                                                            ?>
                                                        </div>                                                
                                                    </div>
                                                </div>                                                                                                                                                                                                        
                                            </div><!--end activity-->
                                        </div><!--end education-activity-->
                                    </div>  <!--end card-body-->                                     
                                </div><!--end card-->
                            </div><!--end col-->

                            <div class="col-lg-6">
                                <div class="card">                                       
                                    <div class="card-body"> 
                                        <h4 class="header-title mt-0 mb-3">Summary</h4>
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="assets/images/widgets/p-5.svg" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-8 align-self-center">
                                                <p class="skill-detail">
                                                    <?php echo $userRow['useraboutyou']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>  <!--end card-body-->                                     
                                </div><!--end card-->
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!-- container -->
                </div>
                <!-- end page content -->

            </div>
            <!-- end page-wrapper -->

        <?php include 'footer.php'; ?>
    </body>
</html>