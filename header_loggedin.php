<?php 
    try {
        session_start();
        require_once 'dbconnect.php';   

        if(!isset($_SESSION['user']) && !isset($_SESSION['company'])) {    
        header("Location: index.php");
        exit;
        }
        $homeLink = '';
        $profileLink = '';

        $userName = null;
        if(isset($_SESSION['user'])){
            $homeLink = 'main.php';
            $profileLink = 'profile.php';

            $usrId=$_SESSION['user'];
            // select loggedin users detail
            $res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
            //	echo "Session ".$_SESSION['user'];
            $userRow=mysqli_fetch_array($res);
            $userName = $userRow['userfname'];


            // select favs detail
            // $favres=mysqli_query($conn,"SELECT COUNT(*) FROM favs WHERE favstate='true' AND userId=".$_SESSION['user']);
            // $favRow=mysqli_fetch_array($favres);
    
    
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
        }



        if(isset($_SESSION['company'])){
                        
            $homeLink = 'maincompany.php';
            $profileLink = 'companyprofile.php';

            // select applications detail
            $appres=mysqli_query($conn,"SELECT COUNT(*) FROM applications WHERE status NOT LIKE 'Approved' AND companyId=".$_SESSION['company']);
            $appRow=mysqli_fetch_array($appres);
        
            $app_count=$appRow['COUNT(*)'];

            // select messages
            // $msgres=mysqli_query($conn,"SELECT COUNT(*) FROM messages WHERE status='unread' AND recepientId=".$_SESSION['company']);
            // $msgRow=mysqli_fetch_array($msgres);
            // if(!$msgres)
            //     {
            //         echo "Error: ".mysqli_error($conn);
            //     }
            $msg_count=0;



            $tres=mysqli_query($conn,"SELECT * FROM `company` WHERE `companyId`=".$_SESSION['company']);
            //echo "Session ".$_SESSION['company'];
            $userRow=mysqli_fetch_array($tres);
            
            $userName = $userRow['companyname'];
            if(!$tres)
            {
                echo "Error: ".mysqli_error($conn);
            }



            $res=mysqli_query($conn,"SELECT * FROM representatives WHERE repId=". $userRow['repId']);
            $repRow=mysqli_fetch_array($res);
            // echo 'companylogo = '.$userRow['companylogo'];

            if(!empty($userRow['companylogo']))
            {

                $str=strpos($userRow['companylogo'],'uploads/');
                $len=strlen($userRow['companylogo']);
                $imgCustPath=substr($userRow['companylogo'], $str,$len);

                // echo 'imgCustPath = '.$imgCustPath;
                // exit();
            }
            else{

                $imgCustPath="uploads/pictures/default.png";
            }




        }




    } catch (\Throwable $th) {
        //throw $th;
        // continue;
    }
    
?>

<html lang="en">


    <head>
        <meta charset="utf-8" />
        <title>RSystem Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A premium admin dashboard template by Mannatthemes" name="description" />
        <meta content="Mannatthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        
        <link href="assets/plugins/summernote/summernote-bs4.css" rel="stylesheet" />


    </head>


        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="<?php echo $homeLink; ?>" class="logo">
                    <span>
                        <img src="assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                    </span>
                    <span>
                        <img src="assets/images/logo-dark.png" alt="logo-large" class="logo-lg">
                    </span>
                </a>
            </div>
            <!--end logo-->
            <!-- Navbar -->
            <nav class="navbar-custom">    
            
                <ul class="list-unstyled topbar-nav float-right mb-0"> 
                   
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img onerror="this.src='assets/images/users/user-4.jpg';" src="<?php echo $imgCustPath; ?>" alt="profile-user" class="rounded-circle" /> 
                            <span class="ml-1 nav-user-name hidden-sm"><?php echo $userName; ?> <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?php echo $profileLink; ?>"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                        </div>
                    </li>
                </ul><!--end topbar-nav-->
    
                <ul class="list-unstyled topbar-nav mb-0">                        
                    <li>
                        <button class="button-menu-mobile nav-link waves-effect waves-light">
                            <i class="dripicons-menu nav-icon"></i>
                        </button>
                    </li>
                    <li class="hide-phone app-search">
                        <form role="search" class="">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fas fa-search"></i></a>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->


        <?php 
            // $_SESSION["message"] = "Test message";
            if(isset($_SESSION["message"]) &&  $_SESSION["message"] != ""){
        ?>
            <div style="position: fixed; top: 10px; right: 10px;z-index: 8840128;">
                <div class="toast fade show"  role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="min-width: 250px;">
                    <div class="toast-header">
                        <i class="mdi mdi-circle-slice-8 font-18 mr-1 text-secondary"></i>
                        <h5 class="mr-auto"><?php if($_SESSION['title']!=""){ echo $_SESSION['title']; } else { echo 'Information';} ?></h5>
                        <small>Just now</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        <?php 
                            echo $_SESSION["message"];
                            $_SESSION["message"] = "";
                        ?>
                    </div>
                </div>  
            </div>  
        <?php
            }    
        ?>



        <?php 
            if(isset($_SESSION["error"]) &&  $_SESSION["error"] != "")
            {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                </button>
                <?= $_SESSION["error"]; ?>
            </div>
        <?php
            $_SESSION["error"] = "";
            }    
        ?>
        
</html>