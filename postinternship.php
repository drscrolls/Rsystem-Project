<?php 

session_start();
require_once 'dbconnect.php';

try {
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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="float-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="maincompany.php">Home</a></li>
                                        <li class="breadcrumb-item active">Post Internship</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Post Internship</h4>
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div>
                    <!-- end page title end breadcrumb -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">  
                                
                                <div class="">
                                        <form class="form-horizontal form-material mb-0">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label>Company name</label> 
                                                    <input type="text" placeholder="Company Name" class="form-control" name="First_Name" id="First_Name" readonly value="<?=$userRow['companyname'];?>" />
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Job title</label>     
                                                    <input type="text" placeholder="Enter job title" class="form-control" name="Last_Name" id="Last_Name"/>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Location</label>     
                                                    <input type="text" placeholder="Enter location" class="form-control" name="Last_Name" id="Last_Name"/>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <input type="text" placeholder="Admit Date" class="form-control" name="Admit_Date" id="Admit_Date">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" placeholder="Department" class="form-control" name="Department" id="Department">
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control">
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>                                                
                                                <div class="col-md-3">
                                                    <input type="text" placeholder="Age" class="form-control" name="Age" id="Age">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <input type="email" placeholder="Email" class="form-control" name="Email" id="Email">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" placeholder="Phone No" class="form-control" name="Phone_No" id="Phone_No">
                                                </div>   
                                                <div class="col-md-2">
                                                    <input type="text" placeholder="ID0000" class="form-control" name="ID" id="ID">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" placeholder="Addvance Fees" class="form-control" name="Addvance_Fees" id="Addvance_Fees">
                                                </div>                                              
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <input type="text" placeholder="Doctor Name" class="form-control" name="Doctor_Name" id="Doctor_Name">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" placeholder="Ward No" class="form-control" name="Ward_No" id="Ward_No">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea rows="5" placeholder="Address..." class="form-control"></textarea>
                                                <button class="btn btn-danger btn-sm text-light px-4 mt-3 float-right mb-0 ml-2">Cancel</button>
                                                <button class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0">Save</button>                                                
                                            </div>
                                        </form>
                                    </div>


                                    <h4 class="mt-0 header-title">Tinymce wysihtml5</h4>
                                    <p class="text-muted mb-3">Bootstrap-wysihtml5 is a javascript
                                        plugin that makes it easy to create simple, beautiful wysiwyg editors
                                        with the help of wysihtml5 and Twitter Bootstrap.
                                    </p>        
                                    <form method="post">
                                        <textarea id="elm1" name="area"></textarea>
                                    </form>        
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!-- end col -->
                    </div> <!-- end row -->



                </div>

        </div>

        <?php include 'footer.php'; ?>
    </body>

    <!--Wysiwig js-->
    <script src="./assets/plugins/tinymce/tinymce.min.js"></script>
    <script src="./assets/pages/jquery.form-editor.init.js"></script> 
</html>