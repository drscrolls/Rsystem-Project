<?php session_start();
require_once 'dbconnect.php';
$recepientId=1;
$_SESSION['page-title'] = "Chat";

if(!empty($_REQUEST[userId]))
{
  $guest=$_REQUEST[userId];
  $recepientId=$guest;
  $_SESSION['temp_guest']=$guest;
   $gres=mysqli_query($conn,"SELECT * FROM `users` WHERE `userId`=".$guest);
    $guestRow=mysqli_fetch_array($gres);
    if(!$gres)
    {
        echo "Error: ".mysqli_error($conn);
    }
    
    if(!empty($guestRow['userphoto']))
    {
    $str=strpos($guestRow['userphoto'],'uploads/');
    $len=strlen($guestRow['userphoto']);
    $guestphoto=substr($guestRow['userphoto'], $str,$len);
    }
    else{
      $guestphoto="uploads/pictures/default.png";
    }

}


if(!empty($_REQUEST[userId]))
{
  $guest=$_REQUEST[userId];
  $recepientId=$guest;
  $_SESSION['temp_guest']=$guest;
   $gres=mysqli_query($conn,"SELECT * FROM `users` WHERE `userId`=".$guest);
    $guestRow=mysqli_fetch_array($gres);
    // echo $guestRow['companylogo'];
    if(!$gres)
    {
        echo "Error: ".mysqli_error($conn);
        exit();
    }

     $gres=mysqli_query($conn,"UPDATE messages SET STATUS =  'read' WHERE STATUS =  'unread' AND senderId = $guest AND recepientId=".$_SESSION['company']);
   if(!$gres)
    {
        echo "Error: ".mysqli_error($conn);
        exit();
    }


}

  // select applications detail
  $appres=mysqli_query($conn,"SELECT COUNT(*) FROM applications WHERE status NOT LIKE 'Approved' AND companyId=".$_SESSION['company']);
  $appRow=mysqli_fetch_array($appres);
  $app_count=$appRow['COUNT(*)'];

 // function openUser($var)
 // {
    
 //     header("Location:");
 // }
// echo "Company = ".$_SESSION['company'];
 // if session is not set this will redirect to login page
    // if(isset($_SESSION['company'])=="" ) {
            
    //     header("Location: index.php");
    //     exit;
    
    // }
    // // select loggedin users detail
    

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



//-----------PROCESS CHAT MESSAGE ---------------------------
$senderId=$_SESSION['company'];


//PROCESS MESSAGE
  if(isset($_POST['message']) ) {  
    
    $message=$_POST['message'];
    $senderId=$_SESSION['company'];
    $recepientId=$_SESSION['temp_guest'];

    // echo "senderId: ".$senderId."<br/>";
    // echo "recepientId: ".$recepientId."<br/>";
    // exit();


      $query="INSERT INTO `messages` (`messageId`, 
      `senderId`,
      `recepientId`,
      `message`) 
    VALUES (NULL,
     '$senderId',
      '$recepientId',
       '$message');";
  $result=mysqli_query($conn,$query);
if(!$result)
{
  echo "Error:: ".mysqli_error($conn);
}
// echo "Message sent successfully";
// exit();

 header("Location: companychat.php?userId=".$recepientId); 

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
    <body>


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
                                        <li class="breadcrumb-item"><a href="maincompany.php">Home</a></li>
                                        <li class="breadcrumb-item active">Chat</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Chat</h4>
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div>
                    <!-- end page title end breadcrumb -->
                    <div class="row">
                        <div class="col-12">
                            <div class="chat-box-left">
                                <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="active bg-info nav-link shadow-none" id="general_chat_tab" data-toggle="pill" href="#general_chat">General</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" id="group_chat_tab" data-toggle="pill" href="#group_chat">Groups</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="personal_chat_tab" data-toggle="pill" href="#personal_chat">Personal</a>
                                    </li> -->
                                </ul>
                                <div class="chat-search">
                                    <div class="form-group"> 
                                        <div class="input-group">                                                
                                            <input type="text" id="chat-search" name="chat-search" class="form-control" placeholder="Search">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary shadow-none"><i class="fas fa-search"></i></button>
                                            </span>
                                        </div>                                                    
                                    </div>
                                </div><!--end chat-search-->

                                <div class="tab-content chat-list slimscroll" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="general_chat">
                                    <?php
                                        $query = $conn->query("SELECT * FROM applications WHERE companyId = ".$_SESSION['company']) or die(mysqli_error());
                                        $u_array = array("");
                                        $c=1;
                                        $isFound=false;
                                        while($f_query = $query->fetch_array()){

                                        if(!in_array($f_query['userId'], $u_array) && $f_query['userId']!=0){
                                        $u_array[$c]=$f_query['userId'];
                                        $c++;
                                        $tres=mysqli_query($conn,"SELECT * FROM `users` WHERE `userId`=".$f_query['userId']);
                                        $userRow=mysqli_fetch_array($tres);
                                        if(!$tres)
                                        {
                                            echo "Error: ".mysqli_error($conn);
                                        }

                                        //CORRECT IMAGE FILE PATH
                                        if(!empty($userRow['userphoto']))
                                        {
                                        $str=strpos($userRow['userphoto'],'uploads/');
                                        $len=strlen($userRow['userphoto']);
                                        $userphoto=substr($userRow['userphoto'], $str,$len);
                                        }
                                        else{
                                            $userphoto="uploads/pictures/default.png";
                                        }

                                        $u_id=$f_query['userId'];
                                        // if($f_query['recepientId']==$_SESSION['company']){

                                        $favres=mysqli_query($conn,"SELECT COUNT(*) FROM messages WHERE status='unread' AND senderId=$u_id AND recepientId=".$_SESSION['company']);
                                        $favRow=mysqli_fetch_array($favres);
                                        if(!$favres)
                                        {
                                            echo "Error: ".mysqli_error($conn);
                                            exit();
                                        }
                                        $count=$favRow['COUNT(*)'];


                                        ?>
                                        <a href="companychat.php?userId=<?php echo $u_id; ?>" class="media">
                                            <div class="media-left">
                                                <img src="<?php echo $userphoto; ?>" onerror='this.src="uploads/pictures/default.png";' alt="user" class="rounded-circle thumb-md">
                                                <span class="round-10 bg-success"></span>
                                            </div><!-- media-left -->
                                            <div class="media-body">
                                                <div class="d-inline-block">
                                                    <h6 class="text-capitalize"><?php echo $userRow['userfname']." ".$userRow['userlname']; ?></h6>
                                                    <p class="teaser"><?php echo $f_query['message'];?> </p>
                                                </div>
                                                <div>
                                                    <!-- <span>20 Feb</span> -->
                                                    <?php  
                                                        if($count>0)
                                                        {
                                                    ?>
                                                        <span><?php echo $count; ?></span>
                                                    <?php 
                                                        }
                                                    ?>
                                                </div>
                                            </div><!-- end media-body -->
                                        </a> <!--end media--> 

                                        <?php
                                        
                                                }
                                            }
                                        ?>                                           
                                    </div><!--end general chat-->
                                </div><!--end tab-content-->
                            </div><!--end chat-box-left -->

                            <div class="chat-box-right">

                            <?php 

                                if($guestRow != null){

                                ?>

                                <div class="chat-header">
                                    <a href="#" class="media">
                                        <div class="media-left">
                                            <img src="<?php echo $guestphoto; ?>" alt="user" class="rounded-circle thumb-md">
                                        </div><!-- media-left -->
                                        <div class="media-body">
                                            <div>
                                                <h6 class="mb-1 mt-0 text-capitalize"><?php echo $guestRow["userfname"]." ". $guestRow["userlname"]; ?></h6>
                                                <p class="mb-0">Last seen: 2 hours ago</p>
                                            </div>
                                        </div><!-- end media-body -->
                                    </a><!--end media-->   
                                    <div class="chat-features">
                                        <div class="d-none d-sm-inline-block">
                                            <a href="tel:<?php echo $guestRow["userprimaryphone"]; ?>"><i class="fas fa-phone"></i></a>
                                            <a href=""><i class="fas fa-ellipsis-v"></i></a>                                                       
                                        </div>
                                    </div><!-- end chat-features -->
                                </div><!-- end chat-header -->

                                <?php
                                }

                            ?>
                                <div class="chat-body ">
                                    <div class="chat-detail slimscroll" style="height: 630px !important;">

                                    
            <?php
           // SELECT A CONTACT       
            if(empty($_REQUEST[userId]))
            {
              echo '<center class="mt-5 pt-5">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 130px;">
                    <path style="fill: #d3deff;" d="M132.8 368c-20.2 0-44.8-24.6-44.8-44.8V160h-9.6C61.7 160 48 173.7 48 190.4V464l58.5-58h215.1c16.7 0 30.4-14.1 30.4-30.9V368H132.8z"></path>
                    <path style="fill: #4d79f6;" d="M429.1 48H149.9C130.7 48 115 63.7 115 82.9V309c0 19.2 15.7 35 34.9 35h238.2l75.9 53V82.9c0-19.2-15.7-34.9-34.9-34.9z"></path>
                </svg>
              <h3>Welcome to the Chat Portal</h3>
              <h5 class="text-muted">Select a contact to begin</h5>
              <br/></center>';
            }


            // TYPE A MESSAGE
            if(!empty($_REQUEST[userId])){
              $compId=$_SESSION['company'];
              $usrId=$_REQUEST[userId];
              // select messages
              $msgres=mysqli_query($conn,"SELECT COUNT(*) FROM messages WHERE (recepientId=$compId AND senderId=$usrId) OR  (recepientId=$usrId AND senderId=$compId);");
              $msgRow=mysqli_fetch_array($msgres);
              
              if(!$msgres)
                {
                    echo "Error: ".mysqli_error($conn);
                }
               
                $msg_count=$msgRow['COUNT(*)'];

                if(empty($msg_count))
                {
                  echo "<center><h3>Type something in the message box to start a conversation</h3><br/><span style='font-size:60px;' class='glyphicon glyphicon-hand-down'></span></center>";
                }



            }







              $query = $conn->query("SELECT * FROM `messages` ORDER BY `timesent` ASC") or die(mysqli_error());
              
              $prevMsgDirection = '';
              while($f_query = $query->fetch_array()){

              if(!empty($guestRow['userphoto']))
                {
                $str=strpos($guestRow['userphoto'],'uploads/');
                $len=strlen($guestRow['userphoto']);
                $guestphoto=substr($guestRow['userphoto'], $str,$len);
                }
                else{
                  $guestphoto="uploads/pictures/default.png";
                }

              // $ires=mysqli_query($conn,"SELECT * FROM `internships` WHERE internshipId=".$f_query['internshipId']);
              // $iRow=mysqli_fetch_array($ires);

              // $cres=mysqli_query($conn,"SELECT * FROM `company` WHERE companyId=".$f_query['companyId']);
              // $cRow=mysqli_fetch_array($cres);

                //if company is the receiver...
                if($f_query['senderId']==$_REQUEST[userId] && $f_query['recepientId']==$_SESSION['company'] ){

                  //EXTRACT TIME
                  $str=strpos($f_query['timesent'],' ');
                  $len=strlen($f_query['timesent']);
                  $time=substr($f_query['timesent'], $str,$len);
            ?>

                <!-- MESSAGE TO THE LEFT -->
                <div class="media">
                    <?php if($prevMsgDirection != "left")
                        {
                    ?>
                        <div class="media-img">     
                            <img src="<?php echo $guestphoto; ?>" alt="user" class="rounded-circle thumb-md">
                        </div>
                        <?php
                        }
                    ?>
                    <div class="media-body">
                        <div class="chat-msg">
                            <p><?php echo $f_query['message']; ?></p>
                        </div>
                    </div><!--end media-body--> 
                </div><!--end media-->  

<?php
//If company is the sender...

$prevMsgDirection = 'left';
}else if($f_query['senderId'] == $_SESSION['company'] && $f_query['recepientId']==$_REQUEST[userId]){

                  //EXTRACT TIME
                  $str=strpos($f_query['timesent'],' ');
                  $len=strlen($f_query['timesent']);
                  $time=substr($f_query['timesent'], $str,$len);

                  //BACKUP
                  // $str=strpos($f_query['timesent'],' ');
                  // $len=strlen($f_query['timesent']);
                  // $time=substr($f_query['timesent'], $str,$len);
  ?>


                <!-- MESSAGE TO THE RIGHT -->
                <div class="media">                                                        
                    <div class="media-body reverse">
                        <div class="chat-msg">
                            <p><?php echo $f_query['message']; ?></p>
                        </div>                                                           
                    </div><!--end media-body--> 
                    <?php if($prevMsgDirection != "right")
                        {
                    ?>
                        <div class="media-img">     
                            <img src="<?php echo $imgCustPath; ?>" alt="user" class="rounded-circle thumb-md">
                        </div>
                        <?php
                        }
                    ?>
                </div><!--end media-->  

<?php

$prevMsgDirection = 'right';
}
}
                
                ?>

                                    </div>  <!-- end chat-detail -->                                               
                                </div><!-- end chat-body -->
                                <div class="chat-footer">
                                    <div class="row">                                                    
                                        <div class="col-12 col-md-9">
                                            <span class="chat-admin"><img src="<?php echo $imgCustPath; ?>" alt="user" class="rounded-circle thumb-sm"></span>
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                                                <input type="text" class="form-control" placeholder="Type something here..." name="message">
                                            </form>
                                        </div><!-- col-8 -->
                                        <div class="col-3 text-right">
                                            <div class="d-none d-sm-inline-block chat-features">
                                                <a href=""><i class="fas fa-camera"></i></a>
                                                <a href=""><i class="fas fa-paperclip"></i></a>
                                                <a href=""><i class="fas fa-microphone"></i></a>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end chat-footer -->
                            </div><!--end chat-box-right --> 
                        </div> <!-- end col -->                           
                    </div><!-- end row -->

                </div><!-- container -->
            </div>
            <!-- end page content -->
        </div>

        <?php include 'footer.php'; ?>  
</body>                                           
                

<script>
    $(".chat-detail").slimScroll({
        height: 'auto'
    });
</script>