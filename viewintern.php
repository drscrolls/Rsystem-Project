<?php 
    session_start();
    require_once 'dbconnect.php';
    $viRow = array('' =>  '');
    // $arrayName = array('' => "" );
    $userFirstName = '';

	// echo "_REQUEST[userId]=".$_REQUEST['userId'];
    // echo "Session=".$_SESSION['company']."<br/>";
    
	if(!empty($_REQUEST['userId']))
	{
        $c_query = $conn->query("SELECT * FROM `users` WHERE `userId` = ".$_REQUEST['userId']) or die(mysqli_error());
        $viRow = $c_query->fetch_array();
        if($viRow == null){
            header("Location: maincompany.php");
            exit();
        }else{
            $userFirstName = $viRow['userfname'];
            $club = $viRow['userId'];
            // echo 'usersRow='. $usersRow['userfname'];
            // echo '<br/>viRow='. $viRow['userfname'];
            // exit();
        }
	}else
	{
		header("Location: maincompany.php");
        exit();
    }
    
	// echo "userfname=".$viRow['userfname'];


    //$q="select * from jobs where j_active=1 order by j_id desc ";
    //$res=mysqli_query($link,$q) or die ("can not select database");
    // echo "Welcome ". $viRow['useremail'];

    if(!empty($viRow['userphoto']))
    {
        $str=strpos($viRow['userphoto'],'uploads/');
        $len=strlen($viRow['userphoto']);
        $viImgPath=substr($viRow['userphoto'], $str,$len);
    }
    else{

        $viImgPath="uploads/pictures/default.png";
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
                                            <li class="breadcrumb-item active">View intern</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $viRow['userfname'];?>'s Profile</h4>
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
                                                    <img  src="<?php echo $viImgPath; ?>" onerror="this.src='assets/images/users/user-8.jpg';" alt="user" style="width: 120px; height: 120px;" class="rounded-circle mr-3 align-self-center">
                                                    <div class="media-body align-self-center">
                                                        <h4 class="font-weight-bold mb-1 mt-0 text-capitalize"><?php echo $viRow['userfname']." ". $viRow['userlname'];?></h4>
                                                        <p class="mb-1 text-secondary"><?php echo $viRow['useremail']; ?></p>
                                                        <p class="mb-1 text-muted"><?php echo $viRow['userschool']; ?></p>
                                                        <p class="mb-1 text-muted"><?php echo $viRow['userprimaryphone']; ?></p>
                                                        <p class="mb-1 text-muted"><?php echo $viRow['usercityofresidence'].", ". $viRow['userregionofresidence']; ?></p>
                                                       
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
                                                            <h6 class="mt-0">Personal information</h6>
                                                        </div>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Firstname: <?php echo $viRow['userfname']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Lastname: <?php echo $viRow['userlname']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Date of birth: <?php echo $viRow['userdob']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Gender: <?php echo $viRow['usergender']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">City/Town: <?php echo $viRow['usercityofresidence']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Region: <?php echo $viRow['userregionofresidence']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Postal Address: <?php echo $viRow['userpostaladdress']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Residential Address: <?php echo $viRow['userresidentialadd']; ?></p>

                                                    </div>
                                                </div>
                                                <i class="mdi mdi-clipboard-account-outline icon-pink"></i>                                                                                                           
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-0">Account information</h6>
                                                        </div>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Email: <?php echo $viRow['useremail']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Identification Card: <?php echo $viRow['userIdType']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Id Number: <?php echo $viRow['userIdNumber']; ?></p>
                                                    </div>                                            
                                                </div>
                                                <i class="mdi mdi-cellphone-basic icon-warning"></i> 
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-0">Contact</h6>
                                                        </div>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Primary phone number: <?php echo $viRow['userprimaryphone']; ?></p>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">Secondary phone number: <?php echo $viRow['usersecondaryphone']; ?></p>
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
                                                            $skillsArray [] = array('' => '');
                                                            $skillString = $viRow['userskill'];
                                                            $skillsArray = explode(',', $skillString);

                                                            // var_dump($skillsArray);
                                                            foreach($skillsArray as $skill){
                                                            // var_dump($skill);
                                                                if($skill == "" || $skill == " " || $skill == null){
                                                                    continue;
                                                                } 
                                                            ?>
                                                                <span class="badge badge-soft-secondary"><?php echo $skill; ?></span>
                                                            <?php
                                                                }
                                                                $skillsArray [] = array('' => '');
                                                        ?>
                                                        </div>                                                
                                                    </div>
                                                </div>                                          
                                                <i class="mdi mdi-account-circle icon-success"></i>
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-0">About me</h6>
                                                        </div>
                                                        <p class="text-muted mb-1 ml-3 mr-3 p-1 rounded">
                                                            <?php echo $viRow['useraboutyou']; ?>
                                                        </p>                                                
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
                                        <?php 
                                            $userResume = $viRow['userresume'];
                                            
                                            if($userResume != null && $userResume != ""){
                                                ?>

                                                <div class="col-12 d-block">
                                                    <p class="text-muted mb-2">Intern has uploaded their resume. Click the button below to download the CV.</p> 
                                                    <a href="<?= $userResume; ?>" class="btn btn-primary mt-2"> Download Resume/CV </a>
                                                </div>


                                                <?php
                                            }

                                        ?>
                                            <div class="col-4 mt-5">
                                                <img src="assets/images/widgets/p-5.svg" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-8 align-self-center">
                                                <p class="skill-detail">
                                                    <?php echo $viRow['useraboutyou']; ?>
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