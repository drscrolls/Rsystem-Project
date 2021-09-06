<?php 

session_start();
require_once 'dbconnect.php';

try {
 // if session is not set this will redirect to login page
    if(isset($_SESSION['company'])=="" ) {
        header("Location: index.php");
        exit;
    }
    

    $query = "SELECT * FROM `company` WHERE `companyId`=".$_SESSION['company'];
    // echo "query = ". $query;
    // exit();

    $tres=mysqli_query($conn,"SELECT * FROM `company` WHERE `companyId`=".$_SESSION['company']);

    // echo "Session ".$_SESSION['company'];

    $userRow=mysqli_fetch_array($tres);
    if(!$tres)
    {
        echo "Error: ".mysqli_error($conn);
    }



//-----------SUBMIT FORM-------------------
if(isset($_POST['submit-internship']))
{
    $title=$_POST['title'];
    $desc=$_POST['description'];
    $skillsneeded=$_POST['skillsneeded'];
    $city=$_POST['city'];
    $region=$_POST['region'];

    $attributes=$_POST['attributes'];

    $companyId=$_SESSION['company'];

    $companyName=$userRow['companyname'];
        
    $query="INSERT INTO `internships` (
            `internshipId`, 
            `title`,
            `description`,
            `companyId`, 
            `companyname`, 
            `skillsneeded`, 
            `city`,
            `region`, 
            `attributes`,
            `additionalinfo`) 
            VALUES (NULL, 
            '$title',
            '$desc',
            '$companyId',
            '$companyName', 
            '$skillsneeded', 
            '$city',
            '$region',
            '$attributes',
            '$additionalinfo');";
    
    echo "query = ".$query;
    exit();


    $result=mysqli_query($conn,$query);
    
    if($result)
    {
        $smsg="Internship inserted successfully";
        $_SESSION["message"] = $smsg;
        header("Location: maincompany.php");
        exit;
    }else
    {
        $fmsg="Internship entry failed" . mysqli_error($conn);
        $_SESSION["error"] = $fmsg;
        header("Location: maincompany.php");
        exit;
    }
                
}

} catch (\Throwable $th) {
    $_SESSION["error"] = "error occured: ".$th;
    echo "error: ".$th;
    header("Location: maincompany.php");
    exit;
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
                                        <form class="form-horizontal form-material mb-0" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label>Company name</label> 
                                                    <input type="text" placeholder="Company Name" class="form-control" name="companyname" id="companyname" readonly value="<?=$userRow['companyname'];?>" required/>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Job title</label>     
                                                    <input type="text" placeholder="Enter job title" class="form-control" name="title" id="title" required/>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Location</label>     
                                                    <input type="text" placeholder="Enter location" class="form-control" name="city" id="city" required/>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label>Region</label> 
                                                    <select class="form-control" id="region"  name="region" placeholder="Select region" required>
                                                        <option value="" selected=""> - Select region - </option>
                                                        <option value="Greater Accra Region">Greater Accra Region</option>
                                                        <option value="Ashanti Region">Ashanti Region</option>
                                                        <option value="Eastern Region">Eastern Region</option>
                                                        <option value="Western Region">Western Region</option>
                                                        <option value="Volta Region">Volta Region</option>
                                                        <option value="Northern Region">Northern Region</option>
                                                        <option value="Brong Ahafo Region">Brong Ahafo Region</option>
                                                        <option value="Upper East Region">Upper East Region</option>
                                                        <option value="Upper West Region">Upper West Region</option>
                                                    </select>        
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Skills needed</label>  
                                                <textarea rows="5" name="skillsneeded" placeholder="Address..." class="form-control" required></textarea>
                                            </div>
                                                    

                                            <div class="form-group">
                                                <label>Job description</label> 
                                                <textarea id="elm1" name="description" required></textarea>
                                            </div>

                                            
                                            <div class="form-group">
                                                <button class="btn btn-danger btn-sm text-light px-4 mt-3 float-right mb-0 ml-2">Cancel</button>
                                                <button type="submit" name="submit-internship" class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0">Save</button>                                                
                                            </div>
                                        </form>
                                    </div>
      
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