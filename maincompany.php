<?php 

session_start();
require_once 'dbconnect.php';

try {
// echo "Session = ".$_SESSION['company'];
 // function openUser($var)
 // {
    
 //     header("Location:");
 // }
// $_SESSION['message']='You internship has been successfully posted';

 // if session is not set this will redirect to login page
    if(isset($_SESSION['company'])=="" ) {
            echo "Session == ''";
        //header("Location: index.php");
        exit;
    }
    // select loggedin users detail
    $query = "SELECT COUNT(*) FROM applications WHERE status NOT LIKE 'Approved' AND companyId=".$_SESSION['company'];
    // echo "query = ".$query;
    // exit();

    // select applications detail
  $appres=mysqli_query($conn,$query);
  
  $appRow=mysqli_fetch_array($appres);
  $app_count=$appRow['COUNT(*)'];

//   $query = "SELECT COUNT(*) FROM messages WHERE status='unread' AND recepientId=".$_SESSION['company'];
//   echo "query = ".$query;
//     exit();


//   // select messages
//   $msgres=mysqli_query($conn,$query);
//   $msgRow=mysqli_fetch_array($msgres);
//   if(!$msgres)
//     {
//         echo "Error: ".mysqli_error($conn);
    // }
  $msg_count=0;



    $tres=mysqli_query($conn,"SELECT * FROM `company` WHERE `companyId`=".$_SESSION['company']);
    //echo "Session ".$_SESSION['company'];
    $userRow=mysqli_fetch_array($tres);
    if(!$tres)
    {
        echo "Error: ".mysqli_error($conn);
    }



    $res=mysqli_query($conn,"SELECT * FROM representatives WHERE repId=". $userRow['repId']);
    $repRow=mysqli_fetch_array($res);


if(!empty($userRow['companylogo']))
{

$str=strpos($userRow['companylogo'],'uploads/');
$len=strlen($userRow['companylogo']);
$imgCustPath=substr($userRow['companylogo'], $str,$len);

}
else{

    $imgCustPath="uploads/pictures/default.png";
}





//-----------SUBMIT FORM-------------------
if(isset($_POST['submit-internship']))
{
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
        header("Refresh: 1; URL = index.php");
    ?>
        <script type='text/javascript'>confirm('New internship successfully posted');</script>
    <?php
        header("Location: main_company.php");
    exit;
    
    }else
    {
        
        $fmsg="Internship entry failed" . mysqli_error($conn);
    }
                
}

} catch (\Throwable $th) {
    $_SESSION["error"] = "error occured: ".$th;
    echo "error: ".$th;
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
                    <div class="row mt-lg-3">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="float-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                        <li class="breadcrumb-item active">Interns</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Interns</h4>
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div>
                    <!-- end page title end breadcrumb -->

                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h5 class="mt-0">Here the list of all registered interns.</h5>
                                </li>
                            </ul>
                        </div><!--end col-->

                        <div class="col-lg-6 text-right">
                            <div class="text-right">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="postinternship.php" class="btn btn-primary">Post New Internship</a>
                                    </li>
                                </ul>
                            </div>                            
                        </div><!--end col-->
                    </div>



                    <div class="row">

            <?php
              $query = $conn->query("SELECT * FROM `users`") or die(mysqli_error());
              while($f_query = $query->fetch_array()){
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

                }
                else{

                    $imgCustPath="uploads/pictures/default.png";
                }
                // print_r($f_query);
            ?>
               
               <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body" style=";background-size: cover;background-position: initial;">
                            <div class="media">
                                <a class="" href="viewintern.php?userId=<?php echo $f_query['userId']?>">
                                    <img src="<?php echo $imgCustPath; ?>" style="border: 5px solid #eaf0f7; height: 57px; width: 57px;" onerror="this.src='./uploads/default.png'" alt="user" class="rounded-circle thumb-md">
                                </a>                                                
                                <div class="media-body align-self-center ml-3">
                                    
                                <a class="" href="viewintern.php?userId=<?php echo $f_query['userId']?>">
                                    <p class="font-14 font-weight-bold mb-0 text-capitalize"><?php echo $f_query['userfname']; ?> <?php echo $f_query['userlname']?></p>
                                    <p class="mb-0 font-12 text-secondary"><?php echo $f_query['useremail']?></p>
                                    <?php 
                                        $skillsArray [] = array('' => '');
                                        $skillString = $f_query['userskill'];
                                        $skillsArray = explode(',', $skillString);

                                        // var_dump($skillsArray);
                                        $skillcount = 0;
                                        foreach($skillsArray as $skill){
                                            ++$skillcount;
                                            if($skillcount <= 2){
                                            // var_dump($skill);
                                            if($skill == "" || $skill == " " || $skill == null){
                                                continue;
                                            } 
                                        ?>
                                            <span class="badge badge-soft-secondary"><?php echo $skill; ?></span>
                                        <?php
                                            }
                                            $skillsArray [] = array('' => '');
                                        }
                                    ?>
                                    </a>
                                </div>
                            </div><!--end media-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            <?php 
              }
            ?>
                          
                    </div><!--end row-->   

                </div><!-- container -->

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html>