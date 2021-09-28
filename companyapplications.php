
<?php 
session_start();
require_once 'dbconnect.php';
// include 'postinternship.php';

    
$_SESSION['page-title'] = "";
 // function openUser($var)
 // {
    
 //     header("Location:");
 // }

 // if session is not set this will redirect to login page
    if(isset($_SESSION['company'])=="" ) {
            
        header("Location: index.php");
        exit;
    }
    // select loggedin users detail
    

    $tres=mysqli_query($conn,"SELECT * FROM `company` WHERE `companyId`=".$_SESSION['company']);
    //echo "Session ".$_SESSION['company'];
    $userRow=mysqli_fetch_array($tres);
    if(!$tres)
    {
        echo "Error: ".mysqli_error($conn);
    }


  // select applications detail
  $appres=mysqli_query($conn,"SELECT COUNT(*) FROM applications WHERE status NOT LIKE 'Approved' AND companyId=".$_SESSION['company']);
  $appRow=mysqli_fetch_array($appres);
  $app_count=$appRow['COUNT(*)'];

  

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
                                        <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                                        <li class="breadcrumb-item active">My applications</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">My applications</h4>
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div>
                    <!-- end page title end breadcrumb -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Job Description</th>
                                                <th>Status</th>  
                                                <th>Date applied</th>    
                                                <th></th>    
                                                <!-- <th>Join Date</th> -->
                                                <!-- <th>Post</th>                                                 -->
                                                <!-- <th class="text-right">Action</th> -->
                                            <!--end tr-->
                                            </tr>
                                            </thead>
        
                                            <tbody>
                                                                        
                                            <?php
              
                                                $query = $conn->query("SELECT * FROM `applications` WHERE `status` NOT LIKE  'Approved' AND companyId=".$_SESSION['company']." ORDER BY `date` DESC") or die(mysqli_error());
                                                
                                                while($f_query = $query->fetch_array()){

                                                    $ures=mysqli_query($conn,"SELECT * FROM `users` WHERE userId=".$f_query['userId']);
                                                    $uRow=mysqli_fetch_array($ures);

                                                    $cres=mysqli_query($conn,"SELECT * FROM `company` WHERE companyId=".$_SESSION['company']);
                                                    $cRow=mysqli_fetch_array($cres);

                                                    $ires=mysqli_query($conn,"SELECT * FROM `internships` WHERE internshipId=".$f_query['internshipId']);
                                                    $iRow=mysqli_fetch_array($ires);
                                                    $status="";

                                                    if(!empty($uRow['userphoto']))
                                                    {
                                                    //ImgCustPath Assigning --assigns the source for all the images read from the db 
                                                    $str=strpos($uRow['userphoto'],'uploads/');
                                                    $len=strlen($uRow['userphoto']);
                                                    $imgCustPath=substr($uRow['userphoto'], $str,$len);

                                                    //IF THE IMAGE PATH ISNT A FILE(i.e is an error? set it as a default picture)
                                                    if(!is_file($imgCustPath))
                                                    {
                                                        //echo "Image not exists";
                                                        $imgCustPath="uploads/default.png";
                                                    }
                                                    //echo "<br/><font style='color:#f00'><br/>imgCustPath= ".$imgCustPath."</font>";


                                                }
                                                else{

                                                $imgCustPath="uploads/pictures/default.png";
                                                }

                                                switch ($f_query['status']) {
                                                    case 'Pending':
                                                    $status='<span class="label label-warning">Pending</span>';
                                                    break;
                                                    
                                                    case 'Approved':
                                                    $status='<span class="label label-primary">Approved</span>';
                                                    break;

                                                    case 'Denied':
                                                    $status='<span class="label label-danger">Denied</span>';
                                                    break;
                                                }
                                                $length = 140;
                                                $description = strlen($iRow['description']) > $length ? substr($iRow['description'],0,$length)."..." : $iRow['description'];
                                                $dateApplied=date_create($f_query['date']);
                                                $dateApplied = date_format($dateApplied,"Y/m/d h:i A");
                                                ?>
                                            <tr>
                                                <td class="text-capitalize d-flex">
                                                    <img src="<?php echo $imgCustPath; ?>" onerror="this.style.display='none';" alt="" class="thumb-sm rounded-circle mr-2">
                                                    <?php echo $uRow['userfname'];?> <?php echo $uRow['userlname']; ?>
                                                </td>
                                                <td class="teaser"><?php echo $iRow['title'].'. '.$description; ?></td>
                                                <td align ="center" style="vertical-align:middle;">
                                                    <?php if($f_query['status']=="Approved")
                                                            {
                                                            ?>
                                                                <span class="float-left text-success py-1">Approved</span>

                                                            <?php
                                                            }else if($f_query['status']=="Pending"){
                                                            ?>
                                                                <span class="float-left text-warning py-1">Pending</span>

                                                            <?php
                                                            }else if($f_query['status']=="Denied"){
                                                            ?>
                                                                <span class="float-left text-danger py-1">Denied</span>

                                                            <?php
                                                            }
                                                    ?>
                                                </td>               
                                                <td><?php echo $dateApplied; ?></td>
                                                <td>
                                                    <a href="applicationdetails.php?applicationId=<?php echo $f_query['applicationId']; ?>">
                                                            <button class="float-left btn btn-light btn-sm py-1"><i class="far fa-eye"></i></button>
                                                    </a>
                                                </td>
                                               
                                          </tr>    
                                            <?php
                                                }
                                            ?>  
                                             </tbody>
                <tfoot>
                </tfoot>
              </table></div></div></div></div>
           
</div>

</td>
</tr>
	
</table>
                             
        <?php include 'footer.php'; ?>  
   </body>
   </html>     