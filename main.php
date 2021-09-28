<?php
session_start();
require_once 'dbconnect.php';
// echo "Session: ".$_SESSION['user'];
// if session is not set this will redirect to login page
// echo "Session = ".$_SESSION['user'];

  if(!isset($_SESSION['user'])) {    
      header("Location: index.php");
      exit;
  }
   if(isset($_SESSION['user'])=="" && isset($_SESSION['company'])=="") {    
      header("Location: index.php");
      exit;
  }

	if(!empty($_SESSION['message']))
	{
		
	}
  

$usrId=$_SESSION['user'];

	// select loggedin users detail
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
//	echo "Session ".$_SESSION['user'];
        
    $userRow=mysqli_fetch_array($res);
    
  // select favs detail
//   $favres=mysqli_query($conn,"SELECT COUNT(*) FROM favs WHERE favstate='true' AND userId=".$_SESSION['user']);
//   echo $favres;
//   exit(); 

//  $favRow=mysqli_fetch_array($favres);
 


 
  $fav_count=0;


  // select applications detail
  $appres=mysqli_query($conn,"SELECT COUNT(*) FROM applications WHERE userId=".$_SESSION['user']);
  $appRow=mysqli_fetch_array($appres);
  $app_count=$appRow['COUNT(*)'];


//CORRECT IMAGE FILE PATH
if(!empty($userRow['userphoto']))
{
$str=strpos($userRow['userphoto'],'uploads/');
$len=strlen($userRow['userphoto']);
$imgCustPath=substr($userRow['userphoto'], $str,$len);
}
else{
	$imgCustPath="uploads/pictures/default.png";
}
//$q="select * from jobs where j_active=1 order by j_id desc ";
//$res=mysqli_query($link,$q) or die ("can not select database");
//echo "Welcome ". $userRow['useremail'];

?>
<!DOCTYPE html>
<html lang="en">
    <body style="background-image: url('assets/images/uenr.jpg');">

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
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">Internships</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Internships</h4>
                                </div><!--end page-title-box-->
                            </div><!--end col-->
                        </div>
                        <!-- end page title end breadcrumb -->
                        <div class="row">
                        
                        <?php
                            $query = $conn->query("SELECT * FROM `internships`");

                            while($f_query = $query->fetch_array()){

                            $tres=mysqli_query($conn,"SELECT * FROM `company` WHERE `companyId`=".$f_query['companyId']);
                            $cRow=mysqli_fetch_array($tres);




                            if(!empty($f_query['userphoto']))
                            {
                            //ImgCustPath Assigning --assigns the source for all the images read from the db 
                            $str=strpos($f_query['userphoto'],'uploads/');
                            $len=strlen($f_query['userphoto']);
                            $imgCustPath=substr($f_query['userphoto'], $str,$len);

                            //IF THE IMAGE PATH ISNT A FILE(i.e is an error? set it as a default picture)
                            if(!is_file($imgCustPath))
                            {
                                //echo "Image not exists";
                                $imgCustPath="uploads/default.png";
                            }
                            // echo "<br/><font style=''><br/>imgCustPath= ".$imgCustPath."</font>";


                            }
                            else{

                            $imgCustPath="uploads/pictures/default.png";
                            }




                            $tres=mysqli_query($conn,"SELECT * FROM `applications` WHERE userId=$usrId AND `internshipId`=".$f_query['internshipId']);
                            $appRow=mysqli_fetch_array($tres);

                            
                                $length = 200;
                                $description = strlen($f_query['description']) > $length ? substr($f_query['description'],0,$length)."..." : $f_query['description'];
                            ?>
                            <div class="col-lg-3 pointer">
                                <div class="card pointer">                                                            
                                    <div class="card-body text-center">  
                                        <div class="text-right">                                                       
                                            <a href="fav.php?internshipId=<?php echo $f_query['internshipId']; ?>&userId=<?php echo $_SESSION['user']; ?>" class="mr-2" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg"><i class="far fa-star text-info font-16"></i></a>
                                        </div>                                    
                                        <img onclick="window.location='viewinternship.php?internshipId=<?php echo $f_query['internshipId']; ?>'" src="<?php echo $cRow['companylogo']; ?>" style="width: 100px; height: 100px;cursor: pointer !important;" alt="user" class="rounded-circle mt-n3">
                                        <h5 class="mb-1 client-name"><?php echo $f_query['title']; ?></h5> 
                                        <p class="text-muted"><?php echo $cRow['companyname']?></p>                                    
                                        <p class="text-center font-14"><?php echo $description;?></p>
                                        <?php
                                            if($appRow['internshipId']!=$f_query['internshipId'])
                                            {
                                        ?>
                                        <button type="button" class="btn btn-sm btn-primary w-100" onclick="window.location='viewinternship.php?internshipId=<?php echo $f_query['internshipId']; ?>'">View more</button>
                                        <?php
                                            }else{
                                                ?>
                                                    <button type="button" class="btn btn-sm btn-info w-100" onclick="window.location='viewinternship.php?internshipId=<?php echo $f_query['internshipId']; ?>'">Already applied</button>
                                                <?php
                                            }
                                        ?>
                                    
                                    
                                        </div><!--end card-body-->                                                                     
                                </div><!--end card-->
                            </div><!--end col-->

                            <?php 
                                }
                            ?> 
                        </div><!--end row-->

                    </div><!-- container -->
                        
                    <!-- end page content -->
                
                </div>
            <!-- end page-wrapper -->

        <?php include 'footer.php'; ?>
    </body>
</html>