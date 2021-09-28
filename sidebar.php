<?php 
        session_start();
        require_once 'dbconnect.php';   

        if(!isset($_SESSION['user']) && !isset($_SESSION['company'])) {    
            header("Location: index.php");
            exit;
        }

        $homeClass= "";
        $chatClass="";

        switch($_SESSION['page-title']){
            case 'Chat':
                $homeClass = "";
                $chatClass = "active";
            ;break;

            default:
                $homeClass = "active";
                $chatClass = "";
            ;break;
        }
?>



<?php
        if(isset($_SESSION['user'])){
?>
<!-- Left Sidenav -->
<div class="left-sidenav">
    <div class="main-icon-menu">
        <nav class="nav">
            <a href="#MetricaHospital" class="nav-link <?php echo $homeClass; ?>" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Home">
                    <!-- Generator: Adobe Illustrator 19.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                        
                    <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path style="fill: #d3deff !important;" d="M208 448V320h96v128h97.6V256H464L256 64 48 256h62.4v192z"></path>
                    </svg>
                    
            </a><!--end MetricaHospital-->

            <a href="#MetricaHospitalStaff" class="nav-link <?php echo $chatClass; ?>" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Chat">
                <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M132.8 368c-20.2 0-44.8-24.6-44.8-44.8V160h-9.6C61.7 160 48 173.7 48 190.4V464l58.5-58h215.1c16.7 0 30.4-14.1 30.4-30.9V368H132.8z"/>
                    <path style="fill: #d3deff;" d="M429.1 48H149.9C130.7 48 115 63.7 115 82.9V309c0 19.2 15.7 35 34.9 35h238.2l75.9 53V82.9c0-19.2-15.7-34.9-34.9-34.9z"/>
                </svg>
            </a><!--end MetricaHospitalStaff-->                        

        </nav><!--end nav-->
    </div><!--end main-icon-menu-->

    <div class="main-menu-inner">
        <div class="menu-body slimscroll">
            
            <div id="MetricaHospital" class="main-icon-menu-pane <?php echo $homeClass; ?>">
        
                <ul class="nav metismenu">
                    <li class="nav-item"><a class="nav-link" href="main.php"><i class="dripicons-article"></i>Internships</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="applications.php"><i class="dripicons-article"></i><span class="w-100">My Applications</span></a>
                    </li><!--end nav-item-->
                                                    
                </ul><!--end nav-->
            </div><!-- end Hospital -->
            
            <div id="MetricaHospitalStaff" class="main-icon-menu-pane <?php echo $chatClass; ?>">
                <ul class="nav metismenu">  
                    <li class="nav-item"><a class="nav-link" href="chat.php"><i class="mdi mdi-chat"></i>Chat</a></li>
                </ul><!--end nav-->                           
            </div><!-- end Staff -->
            
            
        </div><!--end menu-body-->
    </div><!-- end main-menu-inner-->
</div>
<!-- end left-sidenav-->
<?php 
        }

?>



<?php
        if(isset($_SESSION['company'])){
?>
<!-- Left Sidenav -->
<div class="left-sidenav">
    <div class="main-icon-menu">
        <nav class="nav">
            <a href="#MetricaHospital" class="nav-link <?php echo $homeClass; ?>" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Home">
                    <!-- Generator: Adobe Illustrator 19.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                        
                    <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path style="fill: #d3deff !important;" d="M208 448V320h96v128h97.6V256H464L256 64 48 256h62.4v192z"></path>
                    </svg>
                    
            </a><!--end MetricaHospital-->

            <a href="#MetricaHospitalStaff" class="nav-link <?php echo $chatClass; ?>" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Chat">
                <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M132.8 368c-20.2 0-44.8-24.6-44.8-44.8V160h-9.6C61.7 160 48 173.7 48 190.4V464l58.5-58h215.1c16.7 0 30.4-14.1 30.4-30.9V368H132.8z"/>
                    <path style="fill: #d3deff;" d="M429.1 48H149.9C130.7 48 115 63.7 115 82.9V309c0 19.2 15.7 35 34.9 35h238.2l75.9 53V82.9c0-19.2-15.7-34.9-34.9-34.9z"/>
                </svg>
            </a><!--end MetricaHospitalStaff-->                        

        </nav><!--end nav-->
    </div><!--end main-icon-menu-->

    <div class="main-menu-inner">
        <div class="menu-body slimscroll">
            <div id="MetricaHospital" class="main-icon-menu-pane <?php echo $homeClass; ?>">
        
                <ul class="nav metismenu">
                    <li class="nav-item"><a class="nav-link" href="maincompany.php"><i class="mdi mdi-account-multiple"></i>Interns</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="companyapplications.php"><i class="dripicons-article"></i><span class="w-100">Applications</span></a>
                    </li><!--end nav-item-->
                        
                    <li class="nav-item"><a class="nav-link" href="hiredinterns.php"><i class="mdi mdi-account-multiple-check"></i>Hired Interns</a></li>                            
                </ul><!--end nav-->
            </div><!-- end Hospital -->
            <div id="MetricaHospitalStaff" class="main-icon-menu-pane <?php echo $chatClass; ?>">
                <ul class="nav metismenu">  
                    <li class="nav-item"><a class="nav-link" href="companychat.php"><i class="mdi mdi-chat"></i>Chat</a></li>
                </ul><!--end nav-->                           
            </div><!-- end Staff -->
            
        </div><!--end menu-body-->
    </div><!-- end main-menu-inner-->
</div>
<!-- end left-sidenav-->
<?php 
        }

?>