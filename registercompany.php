<?php
ob_start();
session_start();
if(isset($_SESSION['user'])!=""){
	header("Location: main.php");
}


require('dbconnect.php'); 

if(isset($_POST['register-btn']))
{

	//variables
    $companyname=$_POST['companyname'];
	$companyfield=$_POST['companyfield'];
    $companyalsospecializes=$_POST['companyalsospecializes'];
	$companywebsite=$_POST['companywebsite'];
	
    $repfname=$_POST['repfname'];
	$replname=$_POST['replname'];
	$repprimaryphone=$_POST['repprimaryphone'];
	$repsecondaryphone=$_POST['repsecondaryphone'];
	$repemail=$_POST['repemail'];
	
    // $companylogo=$photodestination;
		
    $companyemail=$_POST['companyemail'];
	$companypassword=$_POST['companypassword'];
	$companyregion=$_POST['companyregion'];
	$companycity=$_POST['companycity'];
	$companypostaladdress=$_POST['companypostaladdress'];
	$companyprimaryphone=$_POST['companyprimaryphone'];
	$companysecondaryphone=$_POST['companysecondaryphone']; 
    $companyabout=$_POST['companyabout'];

    
    $companypassword = hash('sha256', $companypassword);
    $companypassword = substr($companypassword, 0, 50);
    
    
    $photo = $_FILES['companylogo'];
    // echo var_dump($photo);
    // exit();


	$companylogo = "";
    //upload_Photo
    if (isset($_FILES['companylogo'])){
        $fileTmpPath = $_FILES['companylogo']['tmp_name'];
        $fileName = $_FILES['companylogo']['name'];
        $fileSize = $_FILES['companylogo']['size'];
        $fileType = $_FILES['companylogo']['type'];
        $fileNameCmps = explode(".",$fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time().$fileName). '.'.$fileExtension;

        $uploadFileDir = './uploads/pictures/';
        $dest_path = $uploadFileDir.$newFileName;
        $message = "";

        if(move_uploaded_file($fileTmpPath, $dest_path)){
            $companylogo = $dest_path;
            $message = "File is uploaded successfully";
        }else{
            $message = "There was an error uploading the file.";
        }
        //echo "message=".$message;
        //exit();
    }	
   
	//$query="INSERT INTO 'users' (userfname,userpassword,useremail) VALUES ('$fname','$password','$email');";
	
	
	$query="INSERT INTO representatives (
	`repId`, 
	`repfname`,
	`replname`,
	`repprimaryphone`, 
	`repsecondaryphone`, 
	`repemail`) VALUES (NULL, '$repfname', '$replname', '$repprimaryphone', '$repsecondaryphone', '$repemail');";

    $result=mysqli_query($conn,$query);
	if($result)
	{
		$smsg="Representative created successfully";
    }
    else
	{
		$fmsg =  "Representative registration failed:  " . mysqli_error($conn);
        $_SESSION["error"] = $fmsg;
		// exit();
	}
	
	
    $res=mysqli_query($conn,"SELECT * FROM representatives where repemail='".$repemail."'");
	//echo "   result ".$res;
    $userRow=mysqli_fetch_array($res);
	// echo "rep id = ".$userRow['repId'];
    $repId = intval($userRow['repId']);

		
	$query="INSERT INTO `company` (
            `companyId`, 
            `companyname`,
            `companyfield`,
            `companyalsospecializes`, 
            `repId`, 
            `companypostaladdress`,
            `companyprimaryphone`, 
            `companysecondaryphone`,
            `companycity`,
            `companyregion`,
            `companyemail`,
            `companypassword`,
            `companylogo`,
            `companyabout`) 
        VALUES (
            NULL, 
        '$companyname',
        '$companyfield',
        '$companyalsospecializes', 
        '$repId', 
        '$companypostaladdress',
        '$companyprimaryphone',
        '$companysecondaryphone', 
        '$companycity',
        '$companyregion',
        '$companyemail',
        '$companypassword',
        '$companylogo',
        '$companyabout');";
	
	
    // echo "company query = ".$query;
    // exit();


    $result=mysqli_query($conn,$query);
    
    // echo "company save result = ".$result;
    // exit();
    
	if($result)
	{
        $smsg="Company created successfully";
        header("Location: index.php");
	    exit;
	
	}else
	{
        $fmsg="Company registration failed :: " . mysqli_error($conn);
        // echo "error while registering company: ".$fmsg;
        $_SESSION["error"] = $fmsg;
        // exit;
	}
		
		
}
	
		
?>


<!DOCTYPE html>
<html lang="en">
    <body class="account-body accountbg" style="background-image: url('assets/scss/uenr16.jpg');" >

        <?php include 'header_loggedout.php'; ?>

        
        <!-- Log In page -->
        <div class="row vh-100 ">
            <div class="col-12 align-self-center pt-5">
                <div class="auth-page" style="max-width: 90%;">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
                                <div class="auth-logo-box">
                                    <a href="analytics/analytics-index.html" class="logo logo-admin"><img src="assets/images/logo-sm.png" height="55" alt="logo" class="auth-logo"></a>
                                </div><!--end auth-logo-box-->
                                
                                <div class="text-center auth-logo-text">
                                    <h4 class="mt-0 mb-3 mt-5"> welcome to Rsystem</h4>
                                    <p class="text-muted mb-0">Get your free Rsystem account now.</p>  
                                </div> <!--end auth-logo-text-->  

                                
                                <form class="form-horizontal auth-form my-4" method="post" enctype="multipart/form-data"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="col-lg-12 d-flex">
                                        <div class="col-lg-6">


                                             <!-- 2 in 1 row -->
                                            <div class="col-lg-12 d-flex m-0 p-0">
                                                <div class="col-lg-6 p-0">
                                                    <div class="form-group">
                                                        <label for="companyname">Company name</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-user"></i> 
                                                            </span>                                                                                                              
                                                            <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Enter company name">
                                                        </div>                                    
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="companyfield">Industry</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-document"></i> 
                                                            </span>                                                                                                              
                                                            <select id="job" name="companyfield" id="companyfield" class="form-control" required>
                                                                <option value="">Select industry</option>
                                                                <option value="Banking and Finance">Banking and Finance</option>
                                                                <option value="Marketing">Marketing</option>
                                                                <option value="Human Resource">Human Resource</option>
                                                                <option value="IT and Software">IT and Software</option>
                                                                <option value="Hospitality">Hospitality</option>
                                                                <option value="Construction">Construction</option>
                                                                <option value="Agriculture">Agriculture</option>
                                                                <option value="Engineering">Engineering</option>
                                                                <option value="Health">Health</option>
                                                                <option value="Education">Education</option>
                                                                <option value="Military and Security Services">Military and Security Services</option>
                                                                <option value="Travel and Tour Services">Travel and Tour Services</option>
                                                                <option value="Church">Church</option>
                                                                <option value="Food">Food</option>
                                                                <option value="Sports and Fitness">Sports and Fitness</option>
                                                                <option value="Childcare">Childcare</option>
                                                                <option value="Law">Law</option>
                                                                <option value="Entertainment">Entertainment</option>
                                                                <option value="Startup">Startup</option>
                                                                <option value="Retail and Wholesale">Retail and Wholesale</option>
                                                                <option value="Non-profit">Non-profit</option>
                                                                <option value="Media">Media</option>
                                                                <option value="Corporate">Corporate</option>
                                                            </select>
                                                        </div>                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 2 in 1 row -->



                                            
                                            <!-- single row-->   
                                            <div class="form-group">
                                                <label for="companyalsospecializes">Specialities</label>
                                                <div class="input-group mb-3">                                                                                                           
                                                    <textarea rows="3" cols="21" class="form-control" id="companyalsospecializes"  name="companyalsospecializes" placeholder="Type what your business specializes in..."></textarea>
                                                </div>                                    
                                            </div>
                                            <!-- single row-->   


                                             <!-- 2 in 1 row -->
                                             <div class="col-lg-12 d-flex m-0 p-0">
                                                <div class="col-lg-6 p-0">
                                                    <div class="form-group">
                                                        <label for="repfname">Rep firstname</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-user"></i> 
                                                            </span>                                                                                                              
                                                            <input type="text" class="form-control" id="username" name="repfname" placeholder="Enter rep firstname">
                                                        </div>                                    
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="replname">Rep lastname</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-user"></i> 
                                                            </span>                                                                                                              
                                                            <input type="text" class="form-control" id="username" name="replname" placeholder="Enter rep lastname">
                                                        </div>                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 2 in 1 row -->



                                            <!-- single row-->   
                                            <div class="form-group">
                                                <label for="repemail">Rep email adress</label>
                                                <div class="input-group mb-3">
                                                    <span class="auth-form-icon">
                                                        <i class="dripicons-mail"></i> 
                                                    </span>                                                                                                              
                                                    <input type="email" class="form-control" id="username" id="repemail" name="repemail" placeholder="Enter rep email address">
                                                </div>                                    
                                            </div>
                                            <!-- single row-->  


                                             <!-- 2 in 1 row -->
                                             <div class="col-lg-12 d-flex m-0 p-0">
                                                <div class="col-lg-6 p-0">
                                                    <div class="form-group">
                                                        <label for="repprimaryphone">Rep phone num</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-phone"></i> 
                                                            </span>                                                                                                              
                                                            <input type="phone" class="form-control" id="repprimaryphone" name="repprimaryphone" placeholder="Enter phone num">
                                                        </div>                                    
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="repsecondaryphone">Rep other num</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-phone"></i> 
                                                            </span>                                                                                                              
                                                            <input type="phone" class="form-control" id="repsecondaryphone" name="repsecondaryphone" placeholder="Enter phone num">
                                                        </div>                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 2 in 1 row -->


                                            <!-- single row-->   
                                            <div class="form-group">
                                                <label for="username">Company Website</label>
                                                <div class="input-group mb-3">
                                                    <span class="auth-form-icon">
                                                        <i class="dripicons-browser"></i> 
                                                    </span>                                                                                                              
                                                    <input type="text" class="form-control" id="username" placeholder="Enter website address">
                                                </div>                                    
                                            </div>
                                            <!-- single row-->  

                                            
                                        </div> 


                                        <div class="col-lg-6">
                                             

                                             <!-- 2 in 1 row -->
                                             <div class="col-lg-12 d-flex m-0 p-0">
                                                <div class="col-lg-6 p-0">
                                                    <div class="form-group">
                                                        <label for="companyregion">Region</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-location"></i> 
                                                            </span>                                                                                                              
                                                            <select class="form-control" id="companyregion" name="companyregion" required>
                                                                <option value="">Select region</option>
                                                                <option value="Greater Accra">Greater Accra</option>
                                                                <option value="Central Region">Central Region</option>
                                                                <option value="Eastern Region">Eastern Region</option>
                                                                <option value="Western Region">Western Region</option>
                                                                <option value="Volta Region">Volta Region</option>
                                                                <option value="Ashanti Region">Ashanti Region</option>
                                                                <option value="Brong Ahafo Region">Brong Ahafo Region</option>
                                                                <option value="Northern Region">Northern Region</option>
                                                                <option value="Upper East Region">Upper East Region</option>
                                                                <option value="Upper West Region">Upper West Region</option>
                                                            </select>
                                                        </div>                                    
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="companycity">City</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-location"></i> 
                                                            </span>                                                                                                              
                                                            <input type="text" class="form-control" name="companycity" id="companycity" placeholder="Enter name of city">
                                                        </div>                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 2 in 1 row -->


                                            <!-- single row-->   
                                            <div class="form-group">
                                                <label for="companypostaladdress">Postal Address</label>
                                                <div class="input-group mb-3">
                                                    <span class="auth-form-icon">
                                                        <i class="dripicons-location"></i> 
                                                    </span>                                                                                                              
                                                    <input type="text" class="form-control" name="companypostaladdress" id="companypostaladdress" placeholder="Enter postal address">
                                                </div>                                    
                                            </div>
                                            <!-- single row-->


                                            <!-- single row-->   
                                            <div class="form-group">
                                                        <label for="companyprimaryphone">Mobile number</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-phone"></i> 
                                                            </span>                                                                                                              
                                                            <input type="phone" class="form-control" id="companyprimaryphone" name="companyprimaryphone" placeholder="Enter your mobile number">
                                                        </div>                                    
                                                    </div>
                                            <!-- single row-->

                                            
                                            <!-- single row-->   
                                            <div class="form-group border-top pt-2">
                                                        <label for="companyemail">Email address</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-mail"></i> 
                                                            </span>                                                                                                              
                                                            <input type="email" class="form-control" id="companyemail" name="companyemail" placeholder="Enter your email">
                                                        </div>                                    
                                                    </div>
                                            <!-- single row-->


                                            <!-- 2 in 1 row -->
                                            <div class="col-lg-12 d-flex m-0 p-0">
                                                <div class="col-lg-6 p-0">
                                                    <div class="form-group">
                                                        <label for="companypassword">Password</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-lock"></i> 
                                                            </span>                                                                                                              
                                                            <input type="password" class="form-control" name="companypassword" id="companypassword" placeholder="Enter your password">
                                                        </div>                                    
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="companypassword">Confirm password</label>
                                                        <div class="input-group mb-3">
                                                            <span class="auth-form-icon">
                                                                <i class="dripicons-lock"></i> 
                                                            </span>                                                                                                              
                                                            <input type="password" class="form-control" name="companyconfirmpassword" name="companypassword" placeholder="confirm password">
                                                        </div>                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 2 in 1 row -->

                                            <div class="form-group border-top pt-2">
                                                <label for="companyemail">Company picture</label>
                                                <div class="input-group mb-3">
                                                    <span class="auth-form-icon">
                                                        <i class="dripicons-mail"></i> 
                                                    </span>                                                                                                              
                                                    <input type="file" accept="image/*" class="form-control" name="companylogo" placeholder="upload your picture" />
                                                </div>                                    
                                            </div>

                
                
                                            <div class="form-group mb-0 row">
                                                <div class="col-12 mt-2">
                                                    <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit" name="register-btn" id="body-button-reg" value="Register">Register <i class="fas fa-sign-in-alt ml-1"></i></button>
                                                </div><!--end col--> 
                                            </div> <!--end form-group-->      
                                        </div>                     
                                    </div>                     
                                </form><!--end form-->
                            </div><!--end /div-->
                            
                            <div class="m-3 text-center text-muted">
                                <p class="">Already have an account? <a href="index.php" class="text-primary ml-2">Log in</a></p>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end auth-card-->
            </div><!--end col-->           
        </div><!--end row-->
        <!-- End Log In page -->


        <?php include 'footer.php'; ?>
    </body>
</html>