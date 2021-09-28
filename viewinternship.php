<?php 
    session_start();
    require_once 'dbconnect.php';
    include 'sendapplication.php';

    $userId=$_SESSION['user'];
        
	// select loggedin users detail
	$res=mysqli_query($conn,"SELECT * FROM internships WHERE internshipId= '$_REQUEST[internshipId]'");
	$iRow=mysqli_fetch_array($res);

    $requ=$_REQUEST['internshipId'];
    if(!empty($_REQUEST['applicationId'])){
    $applicationId=$_REQUEST['applicationId'];
    }
        if(isset($_SESSION['user']))
        {
            $qres=mysqli_query($conn,"SELECT * FROM users WHERE userId= ".$_SESSION['user']);
            $userRow=mysqli_fetch_array($qres);
        }
            //echo "Session:: ".$_SESSION['user']."<br/>";
    
        if(isset($_SESSION['user'])!="")
        {
            $qres=mysqli_query($conn,"SELECT * FROM users WHERE userId= ".$_SESSION['user']);
            $userRow=mysqli_fetch_array($qres);


        }
            $res=mysqli_query($conn,"SELECT * FROM company WHERE companyId= ".$iRow['companyId']);
            $cRow=mysqli_fetch_array($res);

    if(isset($_POST['fav-btn']))
    {
        $path="viewinternship.php?internshipId=".$requ;
        echo '<script>alert("Favorite clicked");</script>';
        header("Refresh: 1; URL =".$path);


    }


    if(isset($_SESSION['user']) && !empty($applicationId)){
    $res=mysqli_query($conn,"SELECT * FROM applications WHERE applicationId=$applicationId AND internshipId= $requ AND userId=$userId;");
    $applyRow=mysqli_fetch_array($res);

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
            <div class="page-title-box mb-2">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Internship detail</a></li>
                    </ol>
                </div>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body  met-pro-bg">
                    <div class="met-profile">
                        <div class="row">
                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                <div class="met-profile-main">
                                    <div class="met-profile-main-pic">
                                        <img src="<?php echo $cRow['companylogo']; ?>" style="width: 128px; height: 128px;" onerror="this.src='assets/images/users/user-2.jpg';" alt="" class="rounded-circle">
                                        <span class="fro-profile_main-pic-change bg-info" style="cursor: default !important;">
                                            <i class="fas fa-briefcase"></i>
                                        </span>
                                    </div>
                                    <div class="met-profile_user-detail">
                                        <h5 class="met-user-name"><?php echo $cRow['companyname']; ?></h5>                                                        
                                        <p class="mb-0 met-user-name-post"><?php echo $cRow['companycity']. ", " . $cRow['companyregion']; ?></p>
                                    </div>
                                </div>                                                
                            </div><!--end col-->
                            <div class="col-lg-4 ml-auto">
                                <ul class="list-unstyled personal-detail">
                                    <li class=""><i class="dripicons-phone mr-2 text-info font-18"></i> <b> Phone </b> : <?php echo $cRow['companyprimaryphone']; ?></li>
                                    <li class="mt-2"><i class="dripicons-mail text-info font-18 mt-2 mr-2"></i> <b> Email </b> : <?php echo $cRow['companyemail']; ?></li>
                                    <li class="mt-2"><i class="dripicons-location text-info font-18 mt-2 mr-2"></i> <b>Postal Address</b> : <?php echo $cRow['companypostaladdress']; ?></li>
                                </ul>
                                <div class="button-list btn-social-icon"> 
                                <?php 
                                    if($cRow['companyfbname']){
                                        ?>
                                      <a target="_blank" href="facebook.com/<?=$cRow['companyfbname']; ?>" class="btn btn-blue btn-round">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                <?php       
                                    } 
                                ?> 
                                <?php 
                                    if($cRow['companytwitterhandle']){
                                        ?>
                                      <a target="_blank" href="twitter.com/<?=$cRow['companytwitterhandle']; ?>" class="btn btn-secondary btn-round">
                                        <i class="fab fa-twitter-f"></i>
                                    </a>
                                <?php       
                                    } 
                                ?>   
                                <?php 
                                    if($cRow['companywebsite']){
                                        ?>
                                      <a target="_blank" href="<?php echo $cRow['companywebsite']; ?>" class="btn btn-pink btn-round">
                                        <i class="fab fa-chrome"></i>
                                    </a>
                                <?php       
                                    } 
                                ?>   

                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end f_profile-->                                                                                
                </div><!--end card-body-->
                <div class="card-body">
                    <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="internship_detail_tab" data-toggle="pill" href="#internship_detail">Details</a>
                        </li>
                    </ul>        
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-12">
            <div class="tab-content detail-list" id="pills-tabContent">
                <div class="tab-pane fade show active" id="internship_detail">                                                
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">                                       
                                <div class="card-body"> 
                                    <h4 class="header-title mt-0 mb-3 mt-2 font-weight-bold">Description</h4>
                                    <p class="ml-3 mb-5"><?php echo $iRow['description']; ?></p>
                                    
                                    <h4 class="header-title mt-0 mb-3 mt-2 font-weight-bold">Skills</h4>
                                    <p class="ml-3 mb-5"><?php echo $iRow['skillsneeded']; ?></p>
                                    
                                    <h4 class="header-title mt-0 mb-3 mt-2 font-weight-bold">Other skills</h4>
                                    <p class="ml-3 mb-5"><?php echo $iRow['attributes']; ?></p>
                                    
                                    <h4 class="header-title mt-0 mb-3 mt-2 font-weight-bold">Location</h4>
                                    <p class="ml-3 mb-5"><?php echo $iRow['city'].", ".$iRow['region']; ?></p>

                                    
                                    <h4 class="header-title mt-0 mb-3 mt-2 font-weight-bold">More info</h4>
                                    <p class="mb-2 ml-3 mr-3 p-1 bg-light rounded"><b>Gender</b>: <?php echo $iRow['genderspecific']; ?></p>
                                    <p class="mb-2 ml-3 mr-3 p-1 bg-light rounded"><b>Course</b>: <?php echo $iRow['coursespecific']; ?></p>
                                    <p class="mb-2 ml-3 mr-3 p-1 bg-light rounded"><b>Allowance</b>: <?php 	echo $iRow['agemin']." to ".$iRow['agemax']." years"; ?></p>
                                    <p class="mb-2 ml-3 mr-3 p-1 bg-light rounded"><b>Age range</b>: <?php echo $iRow['genderspecific']; ?></p>
                                    <p class="mb-2 ml-3 mr-3 p-1 bg-light rounded"><b>Experience</b>: <?php echo $iRow['needexperience']; ?></p>
                                    <p class="mb-2 ml-3 mr-3 p-1 bg-light rounded"><b>Work hours</b>: <?php	echo $iRow['hoursmin']."am to ".$iRow['hoursmax']."pm"; ?> </p>

                                    
                                </div>  <!--end card-body-->                                     
                            </div><!--end card-->
                        </div><!--end col-->

                        <?php

                        $tres=mysqli_query($conn,"SELECT * FROM `applications` WHERE userId=$userId AND `internshipId`=".$iRow['internshipId']);
                        $appRow=mysqli_fetch_array($tres);


                        ?>
                        <div class="col-lg-6">
                            <div class="card">                                       
                                <div class="card-body"> 
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="button-items">
                                            <?php
                                                if($iRow['internshipId']!=$appRow['internshipId'])
                                                {
                                            ?>
                                                <button type="button" class="btn btn-dark btn-lg btn-block waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg">Apply Now </button>
                                            <?php
                                                }else{
                                                ?>
                                                    <button type="button" disabled="true" class="btn btn-info btn-lg btn-block waves-effect waves-light disabled" style="cursor: not-allowed;">Already applied</button>
                                                <?php
                                                }
                                            ?>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="button-items">
                                                <button onclick="window.location.href='fav.php?internshipId=<?php echo $iRow['internshipId']; ?>&userId=<?php echo $userId; ?>';" type="button" class="btn btn-yellow btn-lg btn-block">Add to Favourites</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <img src="assets/images/widgets/p-1.svg" alt="" class="img-fluid">
                                    </div>
                                </div>  <!--end card-body-->                                     
                            </div><!--end card-->
                        </div><!--end col-->

                    </div><!--end row-->  
                </div><!--end experience detail-->
            </div><!--end tab-content--> 
            
        </div><!--end col-->
    </div><!--end row-->

</div><!-- container -->

<!-- end page content -->


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="exampleModalLabel">Compose Mail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card mb-0 p-3">
                                    <form method="post" action="sendapplication.php">
                                        <div class="form-group mb-3">
                                            <input type="email" value="<?php echo $cRow['companyemail']; ?>" readonly disabled class="form-control" placeholder="To">
                                        </div><!--end form-group-->
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject">
                                            <input type="hidden" class="form-control" name="internshipId" value="<?php echo $_REQUEST['internshipId'];?>">
                                            <input type="hidden" class="form-control" name="companyId" value="<?php echo $cRow['companyId'];?>">
                                            <textarea name="message" class="form-control" placeholder="Message" hidden id="msgTextbox"></textarea>
                                        </div><!--end form-group-->
                                        <div class="form-group mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="checkbox2" type="checkbox" name="attach_cv">
                                                        <label for="checkbox2">
                                                            Attach my CV
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--end form-group-->
                                        <div class="form-group mb-3">
                                            <div class="summernote" style="display: none;">
                                                
                                            </div>
                                        </div></div>
                                        </div><!--end form-group-->
            
                                        <div class="btn-toolbar form-group mb-0 modal-footer">
                                            <div class="pull-left">
                                                <button type="submit" name="send-btn" class="btn btn-primary waves-effect waves-light"><span>Send</span> <i class="far fa-paper-plane ml-3"></i></button>

                                                <button type="button"  data-dismiss="modal" class="btn btn-danger waves-effect waves-light "><span>Discard</span><i class="far fa-trash-alt ml-3"></i></button>
                                                
                                            </div>
                                        </div><!--end form-group-->
                                    </form><!--end form-->
                                </div><!--end card-->
                            </div>
                        </div>
    </div><!-- /.modal-dialog -->
</div>

            </div>
            <!-- end page-wrapper -->

        <?php include 'footer.php'; ?>
    </body>
    
    
    <script>
        jQuery(document).ready(function(){

            $('.summernote').summernote({
                height: 320,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false,              // set focus to editable area after initializing summernote
                callbacks: {
                    onKeyup: function(e) {
                        composeMessage();
                    }
                }
            });

        });

        function composeMessage(){
            var textareaValue = $('.summernote').summernote('code');
            $("#msgTextbox").val(textareaValue);
        }
    </script>   
</html>