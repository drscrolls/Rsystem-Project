<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';

	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['user'])!="" ) {
		
		header("Location: main.php");
		?>
		<script>
			alert('You are logged in');
		</script>
		<?php		
		exit;
	}
	
	$error = false;
	
	if( isset($_POST['btn-login']) ) {	
		
			$email=$_POST['email'];
            $password=$_POST['password'];
            // echo "email = ".$email;
            // echo "<br>";
            // echo "password = ".$password;
            // exit();
            
            
			
		    // password encrypt using SHA256();
			$password = hash('sha256', $password);
			$password=substr($password,0,50);
			
		    //  echo "email : ".$email."  password : ".$password; 
            //  exit();

            $query = "SELECT userId, useremail, `userpassword` FROM users WHERE useremail='$email' AND `userpassword`='$password'";

		    //  echo "query = ".$query;
            //  exit();

             //runs the query
            $res=mysqli_query($conn, $query);
            
            //stores the query response as an array ['','','']
            $row=mysqli_fetch_array($res);
            
            // counts the records/rows in the array
            $count = mysqli_num_rows($res);
            // echo " user count = ".$count;
            // echo " password = ".$row['userpassword'];
            // // echo " user count = ".$count;
            // exit(); 
		
				
			if( $count == 1 && $row['userpassword']==$password ) {
				$_SESSION['user'] = $row['userId'];
				$_SESSION['message']="";
				header("Location: main.php");
            } 
            else {
            $query = "SELECT companyId, companyemail, companypassword FROM company WHERE companyemail='$email'";
            // echo " query = ".$query;
            // exit(); 
		
			//Retrieve from company 
            $res=mysqli_query($conn,$query);
            
            $row=mysqli_fetch_array($res);
            // echo var_dump($row);
            //  exit();
			
			/*echo "company email:".$row['companyemail']."  password:".$row['companypassword'];
			
			if($row['companypassword']==$password)
			{
			//	echo "  password are equal; db-password=".$row['companypassword']." \ password=".$password;
			}
			else
			{
				echo "  password are Not equal;  db-password=".$row['companypassword']." \ password=".$password;
			}
			*/
			
			
            $count = mysqli_num_rows($res); // if uname/password correct it returns must be 1 row
            
				if($count==1 && $row['companypassword']==$password)
				{
                    $_SESSION['company'] = $row['companyId'];
                    // echo " _SESSION[company]= ". $_SESSION['company'];
                    // exit();
					header("Location: maincompany.php");
					
				}else{
                    $_SESSION["message"] = "Incorrect login details, Try again...";
				}
	
		
				
			}
				
		unset($_POST['btn-login']);
        unset($_POST['email']);
        unset($_POST['password']);
		
	}
?>

<!DOCTYPE html>
<html lang="en">
    <body class="account-body accountbg" 
    style="background-image: url('assets/images/uenr5.jpg');"
    style="background-image: url('assets/images/uenr6.jpg');"
    style="background-image: url('assets/images/uenr7.jpg');"
    style="background-image: url('assets/images/uenr8.jpg');"
    style="background-image: url('assets/images/uenr9.jpg');"
    >

        <?php include 'header_loggedout.php'; ?>

        <!-- Log In page -->
        <div class="row vh-100 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">

                    <?php 
                        if(isset($_SESSION["message"]) &&  $_SESSION["message"] != ""){
                    ?>

                               
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                                </button>
                                <?php 
                                    echo $_SESSION["message"];
                                    $_SESSION["message"] = "";
                                ?>
                            </div> 
                    <?php
                        }    
                    ?>


                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
                                <div class="auth-logo-box">
                                    <a href="#" class="logo logo-admin"><img src="assets/images/logo-sm.png" height="55" alt="logo" class="auth-logo"></a>
                                </div><!--end auth-logo-box-->
                                
                                <div class="text-center auth-logo-text">
                                <marquee width="60%" direction="left" height="50px">
                                <h1><em> You are welcome to Rsystem</em></h1>
                               </marquee>
                                    <h4 class="mt-0 mb-3 mt-5"> Get Started with Rsystem</h4>
                                    <p class="text-muted mb-0">Sign in to continue to Rsystem</p>  
                                </div> <!--end auth-logo-text-->  

                                
                                <form class="form-horizontal auth-form my-4" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
        
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-mail"></i> 
                                            </span>                                                                                                              
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required/>
                                        </div>                                    
                                    </div><!--end form-group--> 
        
                                    <div class="form-group">
                                        <label for="password">Password</label>                                            
                                        <div class="input-group mb-3"> 
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i> 
                                            </span>                                                       
                                            <input type="password" name="password" class="form-control" id="password" required placeholder="Enter password">
                                        </div>                               
                                    </div><!--end form-group--> 
        
                                    <div class="form-group row mt-4">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-switch switch-success">
                                                <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                                <label class="custom-control-label text-muted" for="customSwitchSuccess">Remember me</label>
                                            </div>
                                        </div><!--end col--> 
                                        <div class="col-sm-6 text-right">
                                            <a href="#" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>                                    
                                        </div><!--end col--> 
                                    </div><!--end form-group--> 
        
                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit" name="btn-login">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                        </div><!--end col--> 
                                    </div> <!--end form-group-->                           
                                </form><!--end form-->
                            </div><!--end /div-->
                            
                            <div class="m-3 text-center text-muted">
                                <p class="">Don't have an account? <a href="registeras.php" class="text-primary ml-2"> Register here</a></p>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                    <div class="account-social text-center mt-4">
                        <h6 class="my-4">Or Login With</h6>
                        <ul class="list-inline mb-4">
                            <li class="list-inline-item">
                                <a href="" class="">
                                    <i class="fab fa-facebook-f facebook"></i>
                                </a>                                    
                            </li>
                            <li class="list-inline-item">
                                <a href="" class="">
                                    <i class="fab fa-twitter twitter"></i>
                                </a>                                    
                            </li>
                            <li class="list-inline-item">
                                <a href="" class="">
                                    <i class="fab fa-google google"></i>
                                </a>                                    
                            </li>
                        </ul>
                    </div><!--end account-social-->
                </div><!--end auth-page-->
            </div><!--end col-->           
        </div>
        <!-- End Log In page -->
        <?php include 'footer.php'; ?>
    </body>
</html>