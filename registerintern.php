<?php
ob_start();
session_start();
if(isset($_SESSION['user'])!=""){
	header("Location: index.php");
}

require('dbconnect.php');

//echo "Hello World! ".$photosource;
$photosource="uploads/pictures/default.png";

if(isset($_POST['submitbutton']))
{

    //variables
    $userfname=$_POST['userfname'];
    $userlname=$_POST['userlname'];
    $userdob=$_POST['userdob'];
    $username=$_POST['username'];
    $usergender=$_POST['usergender'];
    $usercityofresidence=$_POST['usercityofresidence'];
    $userregionofresidence=$_POST['userregionofresidence'];
    $mobilenumber=$_POST['mobilenumber'];
    $usersecondaryphone=$_POST['usersecondaryphone'];
    $username=$_POST['username'];
    $useremail=$_POST['useremail'];
    $userpassword=$_POST['userpassword'];
    $confirmpassword=$_POST['confirmpassword'];
    $userskill=$_POST['userskill'];



    // password encrypt using SHA256();
    $userpassword = hash('sha256', $userpassword);
    $userpassword = substr($userpassword, 0, 50);
    


    $userphoto = "./uploads/default.png";
    //upload_Photo
    if (isset($_FILES['userphoto'])){
        $fileTmpPath = $_FILES['userphoto']['tmp_name'];
        $fileName = $_FILES['userphoto']['name'];
        $fileSize = $_FILES['userphoto']['size'];
        $fileType = $_FILES['userphoto']['type'];
        $fileNameCmps = explode(".",$fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time().$fileName). '.'.$fileExtension;

        $uploadFileDir = './uploads/pictures/';
        $dest_path = $uploadFileDir.$newFileName;
        $message = "";

        if(move_uploaded_file($fileTmpPath, $dest_path)){
            $userphoto = $dest_path;
            $message = "File is uploaded successfully";
        }else{
            $message = "There was an error uploading the file.";
        }
    }	
    

    $userresume = "";
    //upload Resume
    if (isset($_FILES['userresume'])){
        $fileTmpPath = $_FILES['userresume']['tmp_name'];
        $fileName = $_FILES['userresume']['name'];
        $fileSize = $_FILES['userresume']['size'];
        $fileType = $_FILES['userresume']['type'];
        $fileNameCmps = explode(".",$fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time().$fileName). '.'.$fileExtension;

        $uploadFileDir = './uploads/resumes/';
        $dest_path = $uploadFileDir.$newFileName;
        $message = "";

        if(move_uploaded_file($fileTmpPath, $dest_path)){
            $userresume = $dest_path;
            $message = "User resume file is uploaded successfully";
        }else{
            $message = "There was an error uploading the user resume file.";
        }
        // echo "message = ".$message;
        // exit();
    }	
    
	
	$query="INSERT INTO `users` (`userId`, 
        `userfname`,
        `userlname`,
        `username`,
        `userdob`,
        `usergender`,
        `userregionofresidence`,
        `usersecondaryphone`,
        `usercityofresidence`,
        `useremail`,
        `userpassword`, 
        `userprimaryphone`,
        `userskill`,
        `userresume`,
        `userphoto`) VALUES (NULL,
        '$userfname',
        '$userlname',
        '$username',
        '$userdob',
        '$usergender',
        '$userregionofresidence',
        '$usersecondaryphone',
        '$usercityofresidence',
        '$useremail',
        '$userpassword',
        '$mobilenumber',
        '$userskill',
        '$userresume',
        '$userphoto');";


    // echo "query = ". $query;
    // exit();


	$result=mysqli_query($conn,$query);
	
	if($result)
	{
        $smsg="User created successfully";
        // echo "smsm = ". $smsg;
        // exit();
		header("Location: index.php");
		exit;
	
	}else
	{
		
		$fmsg="User registration failed" . mysqli_error($conn);
        $_SESSION["error"] = $fmsg;
        // echo "fmsg = ". $fmsg;
        // exit();
	}
		
		
}

	//echo $imgData;

?>
	
			
			
		

<!DOCTYPE html>
<html lang="en">
    <body class="account-body accountbg" >

        <?php include 'header_loggedout.php'; ?>

        <!-- Log In page -->
        <div class="row vh-100 ">
            <div class="col-12 align-self-center py-5" style="background-image: url('assets/images/uenr11.jpg'); background-size: cover;">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
                                <div class="auth-logo-box">
                                    <a href="index.php" class="logo logo-admin"><img src="./assets/images/logo-sm.png" height="55" alt="logo" class="auth-logo"></a>
                                </div><!--end auth-logo-box-->
                                
                                <div class="text-center auth-logo-text">
                                    <h4 class="mt-0 mb-3 mt-5">Register as an Intern</h4>
                                    <p class="text-muted mb-0">Get your free Rsystem account now.</p>  
                                </div> <!--end auth-logo-text-->  

                                
                                <form method="post" class="form-horizontal auth-form my-4" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        
                                <div class="col-12 row mx-0 px-0">
                                        <div class="col-lg-6 form-group ml-lg-0 mx-0 pl-lg-0 px-0 mb-0 pb-0">
                                            <label for="userfname">First name</label>
                                            <div class="input-group mb-3">
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-user"></i> 
                                                </span>                                                                                                              
                                                <input type="text" class="form-control" id="userfname"  name="userfname" placeholder="Enter username">
                                            </div>                                    
                                        </div>
                                        <div class="col-lg-6 form-group ml-lg-0 mx-0 pl-lg-0 px-0 mb-0 pb-0">
                                            <label for="userlname">Last name</label>
                                            <div class="input-group mb-3">
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-user"></i> 
                                                </span>                                                                                                              
                                                <input type="text" class="form-control" id="userlname"  name="userlname" placeholder="Enter username">
                                            </div>                                    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-user"></i> 
                                            </span>                                                                                                              
                                            <input type="text" class="form-control" id="username"  name="username" placeholder="Enter username">
                                        </div>                                    
                                    </div><!--end form-group--> 
                                    
                                        <div class="form-group">
                                            <label for="userdob">Date of birth</label>
                                            <div class="input-group mb-3">
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-calendar"></i> 
                                                </span>                                                                                                              
                                                <input type="date" max="new Date('dd-mm-yyy');" class="form-control" id="userdob"  name="userdob" placeholder="Enter username">
                                            </div>                                    
                                        </div>
                                        <div class="form-group">
                                            <label for="userlname">Gender</label>
                                            <div class="input-group mb-3">
                                                <select class="form-control" id="usergender"  name="usergender" placeholder="Select gender">
                                                    <option value="" selected=""> - Select your gender - </option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>                                    
                                        </div>

                                    
                                    <div class="form-group">
                                        <label for="userfname">Region</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-location"></i> 
                                            </span>  
                                            <select class="form-control" id="userregionofresidence"  name="userregionofresidence" placeholder="Select region">
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
                                        <label for="userlname">City</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="usercityofresidence"  name="usercityofresidence" placeholder="Enter city" />
                                        </div>                                    
                                    </div>

                                    
                                    <div class="col-12 row mx-0 px-0">
                                        <div class="col-lg-6 form-group ml-lg-0 mx-0 pl-lg-0 px-0 mb-0 pb-0">
                                            <label for="mo_number">Mobile number</label>                                            
                                            <div class="input-group mb-3"> 
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-phone"></i> 
                                                </span>                                                       
                                                <input type="phone" class="form-control" id="mo_number" name="mobilenumber" placeholder="Enter mobile number">
                                            </div>                                     
                                        </div>
                                        <div class="col-lg-6 form-group ml-lg-0 mx-0 pl-lg-0 px-0 mb-0 pb-0">
                                            <label for="usersecondaryphone">Secondary mobile number</label>                                            
                                            <div class="input-group mb-3"> 
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-phone"></i> 
                                                </span>                                                       
                                                <input type="phone" class="form-control" id="usersecondaryphone" name="usersecondaryphone" placeholder="Enter secondary number">
                                            </div>                                      
                                        </div>
                                    </div>


                                    
                                    <div class="form-group">
                                        <label for="useremail">Email</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-mail"></i> 
                                            </span>                                                                                                              
                                            <input type="email" class="form-control" id="useremail" name="useremail" placeholder="Enter Email">
                                        </div>                                    
                                    </div><!--end form-group-->
        

        


                                    <div class="col-12 row mx-0 px-0">
                                        <div class="col-lg-6 form-group ml-lg-0 mx-0 pl-lg-0 px-0 mb-0 pb-0">
                                            <label for="userpassword">Password</label>                                            
                                            <div class="input-group mb-3"> 
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-lock"></i> 
                                                </span>                                                       
                                                <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Enter password">
                                            </div>                                    
                                        </div>
                                        <div class="col-lg-6 form-group ml-lg-0 mx-0 pl-lg-0 px-0 mb-0 pb-0">
                                        <label for="conf_password">Confirm Password</label>                                            
                                            <div class="input-group mb-3"> 
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-lock-open"></i> 
                                                </span>                                                       
                                                <input type="password" class="form-control" id="conf_password" name="confirmpassword" placeholder="Enter Confirm Password">
                                            </div>                                      
                                        </div>
                                    </div>



        
                                    <div class="form-group border-bottom pt-2">
                                        <label for="userskill">Skills</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-briefcase"></i> 
                                            </span>                                                                                                              
                                            <textarea rows="3" cols="21" class="form-control" id="userskill" name="userskill" placeholder="Enter your skills each seperated by a comma ','"></textarea>
                                        </div>                                    
                                    </div>


        
                                    <div class="form-group border-bottom pt-2">
                                        <label for="userPicture">Profile picture</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-camera"></i> 
                                            </span>                                                                                                              
                                            <input type="file" accept="image/*" class="form-control" id="userPicture" name="userphoto" placeholder="upload your picture" />
                                        </div>                                    
                                    </div>


        
                                    <div class="form-group border-bottom pt-2">
                                        <label for="userresume">Resume/CV</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-camera"></i> 
                                            </span>                                                                                                              
                                            <input type="file" accept=".pdf,.doc,.docx,.docs" class="form-control" id="userresume" name="userresume" placeholder="upload your resume/cv" />
                                        </div>                                    
                                    </div>



                                    <div class="form-group row mt-4">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-switch switch-success">
                                                <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                                <label class="custom-control-label text-muted" for="customSwitchSuccess">By registering you agree to the Frogetor <a href="#" class="text-primary">Terms of Use</a></label>
                                            </div>
                                        </div><!--end col-->                                             
                                    </div><!--end form-group--> 
        
        
                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit" name="submitbutton">Register <i class="fas fa-sign-in-alt ml-1"></i></button>
                                        </div><!--end col--> 
                                    </div> <!--end form-group-->                           
                                </form><!--end form-->
                            </div><!--end /div-->
                            
                            <div class="m-3 text-center text-muted">
                                <p class="">Already have an account ? <a href="./index.php" class="text-primary ml-2">Log in</a></p>
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