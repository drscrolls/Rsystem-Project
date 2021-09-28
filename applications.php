
<?php session_start();
require_once 'dbconnect.php';


 // if session is not set this will redirect to login page
	/*if( !isset($_SESSION['company']) ) {
			
		header("Location: index.php");
		exit;
	
	}*/
		if( !isset($_SESSION['user']) ) {
			
		header("Location: index.php");
        exit;

	}

if(isset($_SESSION['user'])){
	// select loggedin users detail
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
//	echo "Session ".$_SESSION['company'];
	$userRow=mysqli_fetch_array($res);
	}
//$q="select * from jobs where j_active=1 order by j_id desc ";
//$res=mysqli_query($link,$q) or die ("can not select database");
//echo "Welcome ". $userRow['useremail'];



if(isset($_POST['remove-btn']))
{
	//echo "Clicked remove-btn";
	
}
if(isset($_POST['edit-btn']))
{

}
if(isset($_POST['view-btn']))
{

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
                                                <th>Company</th>
                                                <th>Job title</th>
                                                <th>Description</th>
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
                                                    
                                                    $query = $conn->query("SELECT * FROM `applications` WHERE userId=".$_SESSION['user']." ORDER BY `date` DESC") or die(mysqli_error());
                                                    
                                                    while($f_query = $query->fetch_array()){

                                                    $ires=mysqli_query($conn,"SELECT * FROM `internships` WHERE internshipId=".$f_query['internshipId']);
                                                    $iRow=mysqli_fetch_array($ires);

                                                    $cres=mysqli_query($conn,"SELECT * FROM `company` WHERE companyId=".$f_query['companyId']);
                                                    $cRow=mysqli_fetch_array($cres);

                                                    $applicationId=$f_query['applicationId'];
                                                    $internshipId= $iRow['internshipId'];
                                                    if(!empty($internshipId)){

                                                        $length = 140;
                                                        $description = strlen($iRow['description']) > $length ? substr($iRow['description'],0,$length)."..." : $iRow['description'];
                                                        $dateApplied=date_create($f_query['date']);
                                                        $dateApplied = date_format($dateApplied,"Y/m/d h:i A");
                                                   
                                                ?>
                                            <tr>
                                                <td class="d-flex">
                                                    <img src="<?php echo $cRow['companylogo']; ?>" onerror="this.style.display='none';" alt="" class="thumb-sm rounded-circle mr-2">
                                                    <?php echo $cRow['companyname'];?>
                                                </td>
                                                <td><?php echo $iRow['title']; ?></td>
                                                <td><?php echo $description; ?></td>
                                                <td style="vertical-align:middle;">
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
                                                <td><?php echo $dateApplied;?></td>
                                                <td>
                                                    <a href="viewinternship.php?internshipId=<?php echo $internshipId; ?>">
                                                            <button class="float-left btn btn-light btn-sm py-1"><i class="far fa-eye"></i></button>
                                                    </a>
                                                    </td>
                                               
                                          </tr>    
                                            <?php
                                                    }
                                                }
                                            ?>  
                                             </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
        </div>
    </div>
</div>
           
</div>

</td>
</tr>
	
</table>
			
		
 
                                 
                     </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
        </div>
    </div>
</div>
           
</div>

</td>
</tr>
	 -->
</table>
                         
  </body>

 </html>