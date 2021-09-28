<?php session_start();
require_once 'dbconnect.php';
$recepientId=1;
$_SESSION['page-title'] = "Chat";



// select applications detail
$appres=mysqli_query($conn,"SELECT COUNT(*) FROM applications WHERE status NOT LIKE 'Approved' AND companyId=".$_SESSION['company']);
$appRow=mysqli_fetch_array($appres);
$app_count=$appRow['COUNT(*)'];


$tres=mysqli_query($conn,"SELECT * FROM `company` WHERE `companyId`=".$_SESSION['company']);
//echo "Session ".$_SESSION['company'];
$userRow=mysqli_fetch_array($tres);
if(!$tres)
{
    echo "Error: ".mysqli_error($conn);
}




//PROCESS MESSAGE
  if(isset($_POST['send-message-btn']) ) {  
    
    $message=$_POST['message'];
    $senderId=$_POST['companyId'];
    $recepientId=$_POST['userId'];

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
//   exit();
}
// echo "Message sent successfully";
// exit();

 header("Location: companychat.php?userId=".$recepientId."#send"); 

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
                                        $query = $conn->query("SELECT * FROM applications WHERE companyId = ".$_SESSION['company']);
                                        $u_array = array("");
                                        $isFound=false;
                                        while($f_query = $query->fetch_array()){

                                        if(!in_array($f_query['userId'], $u_array) && $f_query['userId']!=0){
                                        // $u_array[$c]=$f_query['companyId'];
                                        array_push($u_array,$f_query['userId']);
                                        $tres=mysqli_query($conn,"SELECT * FROM `users` WHERE `userId`=".$f_query['userId']);
                                        $userRow=mysqli_fetch_array($tres);
                                        if(!$tres)
                                        {
                                            echo "Error: ".mysqli_error($conn);
                                        }
                                        
                                        
                                        $msgQuery = "SELECT * FROM `messages` WHERE senderId = '".$f_query['userId']."' ORDER BY timesent DESC LIMIT 1;";
                                        $msgres=mysqli_query($conn,$msgQuery);
                                        $msgRow=mysqli_fetch_array($msgres);

                                        $lastMessageTime=date_create($f_query['date']);
                                        $lastMessageTime = date_format($lastMessageTime,"h:i A");
                                        $lastMessage = $f_query['message'];
                                        $isLastMessageRead = true;

                                        // echo "lastmessage q = ".$msgQuery;
                                        if($msgRow){
                                            $lastMessage = $msgRow['message'];
                                            $length = 40;
                                            $lastMessage = strlen($lastMessage) > $length ? substr($lastMessage,0,$length)."..." : $lastMessage;
                                            
                                            $isLastMessageRead = $msgRow["status"] == "read" ? true : false;
                                            $lastMessageTime=date_create($msgRow['timesent']);
                                            $lastMessageTime = date_format($lastMessageTime,"h:i A");
                                        }

                                        ?>
                                        <a href="companychat.php?userId=<?php echo $userRow['userId']; ?>" class="media border-bottom <?php echo $userRow['userId'] == $_REQUEST['userId']? 'bg-soft-info' :''; ?>">
                                            <div class="media-left">
                                                <img src="<?php echo $userRow['userphoto']; ?>" onerror="this.src='uploads/default.png';" alt="<?= $userRow['userfname']; ?>" class="rounded-circle thumb-md">
                                                <span class="round-10 bg-success"></span>
                                            </div><!-- media-left -->
                                            <div class="media-body">
                                                <div class="d-inline-block">
                                                    
                                                    <h6 class="text-capitalize <?= $isLastMessageRead ? 'font-weight-normal' : ''?>"><?php echo $userRow['userfname']. " ". $userRow['userlname']; ?></h6>
                                                    <p class="teaser float-left text-muted"><?php echo $f_query['message'];?> </p>
                                                </div>
                                                <!-- <div>
                                                    <span><?php echo $lastMessageTime; ?></span>
                                                </div> -->
                                            </div><!-- end media-body -->
                                        </a> <!--end media--> 

                                        <?php
                                        
                                                }
                                            }
                                        ?>                                           
                                    </div><!--end general chat-->
                                </div><!--end tab-content-->
                            </div><!--end chat-box-left -->

                            <div class="bg-light chat-box-right">

                                
                                
                                
                                <div class="chat-body bg-light">
                                    <div class="chat-detail slimscroll" style="height: 630px !important;">

                                    
                                    <?php
                                    // SELECT A CONTACT       
                                    if(empty($_REQUEST['userId']))
                                    {
                                        echo '<center class="mt-5 pt-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 130px;">
                                                <path style="fill: #d3deff;" d="M132.8 368c-20.2 0-44.8-24.6-44.8-44.8V160h-9.6C61.7 160 48 173.7 48 190.4V464l58.5-58h215.1c16.7 0 30.4-14.1 30.4-30.9V368H132.8z"></path>
                                                <path style="fill: #4d79f6;" d="M429.1 48H149.9C130.7 48 115 63.7 115 82.9V309c0 19.2 15.7 35 34.9 35h238.2l75.9 53V82.9c0-19.2-15.7-34.9-34.9-34.9z"></path>
                                            </svg>
                                        <h3>Welcome to the Chat Portal</h3>
                                        <h5 class="text-muted">Select a conversation to begin</h5>
                                        <br/></center>';
                                    }
                                    else
                                    {

                                        $companyId=$_SESSION['company'];
                                        $userId=$_REQUEST['userId'];




                                        // TYPE A MESSAGE
                                        if(!empty($_REQUEST['userId'])){

                                            // select messages
                                            $msgres=mysqli_query($conn,"SELECT COUNT(*) FROM messages WHERE (recepientId=$userId AND senderId=$companyId) OR  (recepientId=$companyId AND senderId=$userId);");
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

                                        $mquery = $conn->query("SELECT * FROM messages WHERE (recepientId=$userId AND senderId=$companyId) OR  (recepientId=$companyId AND senderId=$userId) ORDER BY `timesent` ASC");
                                        $prevMsgDirection = '';
                                        
                                        while($f_query = $mquery->fetch_array()){

                                            // 
                                            //EXTRACT TIME
                                            $time=date_create($f_query['timesent']);
                                            $time= date_format($time,"H:i a");


                                            if($f_query['senderId'] == $userId && $f_query['recepientId']==$companyId){
                                        ?>

                                        <!-- MESSAGE TO THE LEFT -->
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="chat-msg mb-0" style="margin-left: 0px !important;">
                                                    <p class="bg-blue text-white shadow-sm mb-1" style="border-radius: 0px 20px 20px 20px;padding: 14px;min-width:5em;">
                                                        <?php echo $f_query['message']; ?>
                                                    </p>
                                                </div>
                                                <span class="float-left font-11 text-muted mb-2"><?= $time;?></span>
                                            </div><!--end media-body--> 
                                        </div><!--end media-->  

                                        <?php
                                        //If company is the sender...

                                        $prevMsgDirection = 'left';
                                        }else {

                                        ?>


                                            <!-- MESSAGE TO THE RIGHT -->
                                            <div class="media">                                                        
                                                <div class="media-body reverse">
                                                    <div class="chat-msg" style="margin-right: 0px !important;">
                                                        <p class="bg-white shadow-sm d-flex mb-1" style="border-radius: 20px 0px 20px 20px;padding: 14px;min-width:5em;">
                                                            <?php echo $f_query['message']; ?>
                                                        </p>
                                                        <span class="float-right font-11 text-muted"><?= $time;?></span>
                                                    </div>                                                           
                                                </div><!--end media-body--> 
                                                
                                            </div><!--end media-->  

                                        <?php

                                        $prevMsgDirection = 'right';
                                        }
                                    }

                                        
                                    }
                
                                    ?>

                                    </div>  <!-- end chat-detail -->                                               
                                </div><!-- end chat-body -->
                                <div class="chat-footer bg-white" id="send">

                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                                    <div class="row">                                                    
                                        <div class="col-12 col-md-9">
                                            <span class="chat-admin"><img src="<?php echo $imgCustPath; ?>" alt="user" class="rounded-circle thumb-sm"></span>
                                                <input type="text" class="form-control" placeholder="Type something here..." name="message" required/>
                                                <input type="hidden" class="form-control" value="<?php echo $_SESSION['company']; ?>" name="companyId">
                                                <input type="hidden" class="form-control" value="<?php echo $_REQUEST['userId']; ?>" name="userId">
                                            </form>
                                        </div><!-- col-8 -->
                                        <div class="col-3 text-right">
                                            <div class="d-none d-sm-inline-block chat-features">
                                                <button type="submit" name="send-message-btn" class="btn btn-blue rounded-circle shadow-sm"><i class="fas fa-paper-plane"></i></button>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </form>
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
        height: '630px',
        start: 'bottom',
        scrollTo: '630px'
    });
</script>