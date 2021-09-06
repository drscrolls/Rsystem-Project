<?php 
session_start();
require_once 'dbconnect.php';


	//echo "$_REQUEST[userId]=".$_REQUEST[userId];
	//echo "Session=".$_SESSION['company']."<br/>";

$res=mysqli_query($conn,"SELECT * FROM `company` WHERE `companyId`=".$_SESSION['company']);
$userRow=mysqli_fetch_array($res);
//echo "userfname=".$userRow['userfname'];


//$q="select * from jobs where j_active=1 order by j_id desc ";
//$res=mysqli_query($link,$q) or die ("can not select database");
//echo "Welcome ". $userRow['useremail'];

if(!empty($userRow['companylogo']))
{

$str=strpos($userRow['companylogo'],'uploads/');
$len=strlen($userRow['companylogo']);
$imgCustPath=substr($userRow['companylogo'], $str,$len);

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
                                            <li class="breadcrumb-item"><a href="maincompany.php">Home</a></li>
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
                                                        <h4 class="mt-0 mb-1"><?php echo $userRow['companyname'];?></h4>
                                                        <p class="mb-1 text-muted"><?php echo $userRow['companycity'].", ". $userRow['companyregion']; ?></p>
                                                       
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
                                        <div class="slimscroll education-activity">
                                            <div class="activity">
                                                <i class="mdi mdi-face-recognition icon-success"></i>
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-0">Company Profile</h6>
                                                        </div>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Industry: <?php echo $userRow['companyfield']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Speciality: <?php echo $userRow['companyalsospecializes']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">City/Town: <?php echo $userRow['companycity']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Region: <?php echo $userRow['companyregion']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Postal Address: <?php echo $userRow['userpostaladdress']; ?></p>

                                                    </div>
                                                </div>
                                                <i class="mdi mdi-clipboard-account-outline icon-pink"></i>                                                                                                           
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-0">Account information</h6>
                                                        </div>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Email: <?php echo $userRow['companyemail']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Website: <?php echo $userRow['companywebsite']; ?></p>
                                                    </div>                                            
                                                </div>
                                                <i class="mdi mdi-cellphone-basic icon-warning"></i> 
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-0">Contact</h6>
                                                        </div>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Primary phone number: <?php echo $userRow['companyprimaryphone']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Secondary phone number: <?php echo $userRow['companysecondaryphone']; ?></p>
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
                                        <h4 class="header-title mt-0 mb-3">Description</h4>
                                        <div class="row">
                                            <div class="col-8 align-self-center">
                                                <p class="skill-detail">
                                                    <?php echo $userRow['companyabout']; ?>
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