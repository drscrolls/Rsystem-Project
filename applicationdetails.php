<?php 
    session_start();
    require_once 'dbconnect.php';

    if(!isset($_SESSION['company']))
    {
        header("Location: index.php");
    }
    if(!isset($_REQUEST['applicationId']))
    {
        header("Location: companyapplications.php");
    }
    //echo "count=";
    // if session is not set this will redirect to login page
            
    $c_query = $conn->query("SELECT * FROM `applications` WHERE `applicationId` = '$_REQUEST[applicationId]'") or die(mysqli_error());
    $aRow = $c_query->fetch_array();

    // select loggedin users detail
    $res=mysqli_query($conn,"SELECT * FROM company WHERE companyId=".$_SESSION['company']);
    $cRow=mysqli_fetch_array($res);


    $c_query = $conn->query("SELECT * FROM `users` WHERE `userId` =".$aRow['userId']) or die(mysqli_error());
    $auserRow = $c_query->fetch_array();


    //$q="select * from jobs where j_active=1 order by j_id desc ";
    //$res=mysqli_query($link,$q) or die ("can not select database");
    //echo "Welcome ". $auserRow['useremail'];

        //$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_REQUEST['user_Id']);
    //	echo "Session ".$_SESSION['company'];
        //$cRow=mysqli_fetch_array($res);





    if(!empty($auserRow['userphoto']))
    {

    $str=strpos($auserRow['userphoto'],'uploads/');
    $len=strlen($auserRow['userphoto']);
    $aimgCustPath=substr($auserRow['userphoto'], $str,$len);

    }
    else{

        $aimgCustPath="uploads/pictures/default.png";
    }


        if(!empty($auserRow['userresume']))
    {

    $str=strpos($auserRow['userresume'],'uploads/');
    $len=strlen($auserRow['userresume']);
    $resumeCustPath=substr($auserRow['userresume'], $str,$len);

    }

				



if(isset($_POST['save-status-btn']))
{
	header("Location:main_company.php");
	
}

?>
<!DOCTYPE html>
<html lang="en">
    <body>

        <?php include 'header_loggedin.php'; ?>

        <div class="page-wrapper">
                
            <?php include 'sidebar.php'; ?>

            <div class="page-content">

                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="float-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="maincompany.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="companyapplications.php">All Applications</a></li>
                                        <li class="breadcrumb-item active">Application Details</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Application Details</h4>
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div>
                    <!-- end page title end breadcrumb -->
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content detail-list" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="general_detail">
                                    <div class="row">
                                        <div class="col-12">                                            
                                            <div class="card">
                                                <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                    <div class="client-card">                               
                                                        <div class="card-body text-center">                                    
                                                            <img src="<?php echo $aimgCustPath; ?>" onerror="this.src='assets/images/users/user-8.jpg';" alt="user" class="rounded-circle thumb-xl">
                                                            <h5 class="text-capitalize client-name"><?php echo $auserRow['userfname'].' '.$auserRow['userlname']; ?></h5> 
                                                            <span class="text-muted mr-3 text-capitalize"><i class="dripicons-location mr-2 text-info"></i><?php echo $auserRow['usercityofresidence'].', '.$auserRow['userregionofresidence']; ?></span>
                                                            <span class="text-muted"><i class="dripicons-phone mr-2 text-info"></i><?php echo $auserRow['userprimaryphone']; ?></span>
                                                            <p class="text-muted text-center mt-3"><?php echo $auserRow['useraboutyou']; ?></p>
                                                            <p>
                                                            <?php 
                                                                $skillsArray [] = array('' => '');
                                                                $skillString = $auserRow['userskill'];
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
                                                            </p>
                                                            <?php
                                                                $resume=$userRow['userresume'];
                                                            ?>
                                                            <a href="<?php echo $resumeCustPath; ?>" target="_blank">
                                                                <button type="button" class="btn btn-sm btn-soft-secondary">Download CV</button>
                                                            </a>
                                                            <a href="viewintern.php?userId=<?php echo $auserRow['userId']; ?>">
                                                                <button type="button" class="btn btn-sm btn-soft-primary">View Profile</button>
                                                            </a>
                                                        </div><!--end card-body-->                                                                     
                                                    </div>    
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="met-basic-detail">
                                                                <h3 class="text-capitalize"><?php echo $aRow['subject']; ?></h3>
                                                                <p class="text-uppercase font-14"><?php echo $aRow['date']; ?>  </p>
                                                                <p class="text-muted font-14" style="max-height: 400px; overflow-y: auto; ">
                                                                    <?php echo $aRow['message']; ?>    
                                                                </p>
                                                                
                                                                <div class="my-3">
                                                                    <button class="btn btn-success px-3 waves-effect waves-light d-flex my-2" data-toggle="modal" data-animation="bounce" data-target="#hireModal">
                                                                        Accept Application
                                                                        <span class="fa fa-thumbs-up p-1 px-3"></span>
                                                                    </button>
                                                                    <button class="btn btn-danger px-3 waves-effect waves-light d-flex my-2" data-toggle="modal" data-animation="bounce" data-target="#rejectModal">
                                                                        Reject Application
                                                                        <span class="fa fa-times font-16 p-1 px-3"></span>
                                                                    </button>
                                                                </div> 
                                                                
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="row">

                                                            <div class="col-12">
                                                                <img src="assets/images/widgets/p-1.svg" alt="" class="img-fluid">
                                                            </div>                                      
                                                        </div>                                                                                                                       
                                                    </div>
                                                </div>         
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                        </div><!--end col-->
                                    </div><!--end row-->                                             
                                </div><!--end general detail-->
                            </div><!--end tab-content--> 
                            
                        </div><!--end col-->
                    </div><!--end row-->

                </div><!-- container -->
            </div>
        </div>




        <div class="modal fade bs-example-modal-center" id="hireModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-white">
                        <h5 class="modal-title mt-0" id="exampleModalLabel">Accept Application</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body bg-white">
                                                                   
                                                                    
                        <h5 class="pb-2 text-center">Are you sure you want to accept this application?</h5>


                        <div class="mt-2" align="center">
                            <div class="my-3">
                                <a href="setstatus.php?applicationId=<?php echo $aRow['applicationId']; ?>&status=Approved"><button class="btn btn-success px-3">Accept Application</button></a>
                                <button class="btn btn-outline-info px-3 waves-effect waves-light ml-2" data-dismiss="modal" >Cancel</button>
                            </div> 
                        </div>
                        
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>






        <div class="modal fade bs-example-modal-center" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-white">
                        <h5 class="modal-title mt-0" id="exampleModalLabel">Reject Application</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body bg-white">
                                                                    
                        <h5 class="pb-2 text-center">Are you sure you want to reject this application?</h5>


                        <div class="mt-2" align="center">
                            <div class="my-3">
                                <a href="setstatus.php?applicationId=<?php echo $aRow['applicationId']; ?>&status=Denied"><button class="btn btn-danger px-3">Reject Application</button></a>
                                <button class="btn btn-outline-info px-3 waves-effect waves-light ml-2" data-dismiss="modal" >Cancel</button>
                            </div> 
                        </div>
                        
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <?php include 'footer.php'; ?>

    </body>
           
</html>
            
                                            
                