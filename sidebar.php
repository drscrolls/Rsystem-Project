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
            <div id="MetricaHospital" class="main-icon-menu-pane active">
        
                <ul class="nav metismenu">
                    <li class="nav-item"><a class="nav-link" href="main.php"><i class="dripicons-article"></i>Internships</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="applications.php"><i class="dripicons-article"></i><span class="w-100">My Applications</span></a>
                    </li><!--end nav-item-->
                                                    
                </ul><!--end nav-->
            </div><!-- end Hospital -->
            <div id="MetricaHospitalStaff" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Staff</h6>
                </div>
                <ul class="nav metismenu">                                
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-clipboard"></i><span class="w-100">Staff</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="hospital/all-staff.html">All Staff</a></li>  
                            <li><a href="hospital/add-member.html">Add Member</a></li> 
                            <li><a href="hospital/edit-member.html">Edit Member</a></li>  
                            <li><a href="hospital/member-profile.html">Member Profile</a></li>  
                            <li><a href="hospital/salary.html">Staff Salary</a></li>         
                        </ul>            
                    </li><!--end nav-item-->   
                    <li class="nav-item"><a class="nav-link" href="hospital/leaves.html"><i class="dripicons-shopping-bag"></i>Leaves</a></li>
                    <li class="nav-item"><a class="nav-link" href="hospital/holidays.html"><i class="dripicons-headset"></i>Holidays</a></li>
                    <li class="nav-item"><a class="nav-link" href="hospital/attendance.html"><i class="dripicons-checkmark"></i>Attendance</a></li>                                                          
                </ul><!--end nav-->                           
            </div><!-- end Staff -->
            
            
            <div id="MetricaOthers" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Others</h6>      
                </div>
                <ul class="nav metismenu" id="main_menu_side_nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-mail"></i><span class="w-100">Email</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="others/email-inbox.html">Inbox</a></li>
                            <li><a href="others/email-read.html">Read Email</a></li>            
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-view-thumb"></i><span class="w-100">UI Elements</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="others/ui-bootstrap.html">Bootstrap</a></li>
                            <li><a href="others/ui-animation.html">Animation</a></li>
                            <li><a href="others/ui-avatar.html">Avatar</a></li>
                            <li><a href="others/ui-clipboard.html">Clip Board</a></li>
                            <li><a href="others/ui-files.html">File Manager</a></li>
                            <li><a href="others/ui-ribbons.html">Ribbons</a></li>
                            <li><a href="others/ui-dragula.html"><span>Dragula</span></a></li>
                            <li><a href="others/ui-check-radio.html"><span>Check & Radio</span></a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-anchor"></i><span class="w-100">Advanced UI</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="others/advanced-rangeslider.html">Range Slider</a></li>
                            <li><a href="others/advanced-sweetalerts.html">Sweet Alerts</a></li>
                            <li><a href="others/advanced-nestable.html">Nestable List</a></li>
                            <li><a href="others/advanced-ratings.html">Ratings</a></li>
                            <li><a href="others/advanced-highlight.html">Highlight</a></li>
                            <li><a href="others/advanced-session.html">Session Timeout</a></li>
                            <li><a href="others/advanced-idle-timer.html">Idle Timer</a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-document"></i><span class="w-100">Forms</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="others/forms-elements.html">Basic Elements</a></li>
                            <li><a href="others/forms-advanced.html">Advance Elements</a></li>
                            <li><a href="others/forms-validation.html">Validation</a></li>
                            <li><a href="others/forms-wizard.html">Wizard</a></li>
                            <li><a href="others/forms-editors.html">Editors</a></li>
                            <li><a href="others/forms-repeater.html">Repeater</a></li>
                            <li><a href="others/forms-x-editable.html">X Editable</a></li>
                            <li><a href="others/forms-uploads.html">File Upload</a></li>
                            <li><a href="others/forms-img-crop.html">Image Crop</a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-graph-line"></i><span class="w-100">Charts</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="others/charts-apex.html">Apex</a></li>
                            <li><a href="others/charts-morris.html">Morris</a></li>
                            <li><a href="others/charts-chartist.html">Chartist</a></li>
                            <li><a href="others/charts-flot.html">Flot</a></li>
                            <li><a href="others/charts-peity.html">Peity</a></li>
                            <li><a href="others/charts-chartjs.html">Chartjs</a></li>
                            <li><a href="others/charts-sparkline.html">Sparkline</a></li>
                            <li><a href="others/charts-knob.html">Jquery Knob</a></li>
                            <li><a href="others/charts-justgage.html">JustGage</a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-view-list-large"></i><span class="w-100">Tables</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="others/tables-basic.html">Basic</a></li>
                            <li><a href="others/tables-datatable.html">Datatables</a></li>
                            <li><a href="others/tables-responsive.html">Responsive</a></li>
                            <li><a href="others/tables-footable.html">Footable</a></li>
                            <li><a href="others/tables-jsgrid.html">Jsgrid</a></li>
                            <li><a href="others/tables-editable.html">Editable</a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-headset"></i><span class="w-100">Icons</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="others/icons-materialdesign.html">Material Design</a></li>
                            <li><a href="others/icons-dripicons.html">Dripicons</a></li>
                            <li><a href="others/icons-fontawesome.html">Font awesome</a></li>
                            <li><a href="others/icons-themify.html">Themify</a></li>
                            <li><a href="others/icons-typicons.html">Typicons</a></li>
                            <li><a href="others/icons-emoji.html">Emoji <i class="em em-ok_hand"></i></a></li>
                            <li><a href="others/icons-svg.html">SVG</a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-map"></i><span class="w-100">Maps</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="others/maps-google.html">Google Maps</a></li>
                            <li><a href="others/maps-vector.html">Vector Maps</a></li>        
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-article"></i><span class="w-100">Email Templates</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="others/email-templates-basic.html">Basic Action Email</a></li>
                            <li><a href="others/email-templates-alert.html">Alert Email</a></li>
                            <li><a href="others/email-templates-billing.html">Billing Email</a></li>               
                        </ul>            
                    </li><!--end nav-item-->
                </ul><!--end nav-->
            </div><!-- end Others -->

            <div id="MetricaPages" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Pages</h6>        
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="pages/pages-profile.html"><i class="dripicons-user"></i>Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-chat.html"><i class="dripicons-conversation"></i>Chat</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-contact-list.html"><i class="dripicons-user-id"></i>Contact List</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-tour.html"><i class="dripicons-rocket"></i>Tour</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-timeline.html"><i class="dripicons-clock"></i>Timeline</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-invoice.html"><i class="dripicons-document"></i>Invoice</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-treeview.html"><i class="dripicons-network-3"></i>Treeview</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-starter.html"><i class="dripicons-clipboard"></i>Starter Page</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-pricing.html"><i class="dripicons-article"></i>Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-blogs.html"><i class="dripicons-blog"></i>Blogs</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-faq.html"><i class="dripicons-question"></i>FAQs</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pages-gallery.html"><i class="dripicons-photo-group"></i>Gallery</a></li>
                </ul>
            </div><!-- end Pages -->
            <div id="MetricaAuthentication" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Authentication</h6>     
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="authentication/auth-login.html"><i class="dripicons-enter"></i>Log in</a></li>
                    <li class="nav-item"><a class="nav-link" href="authentication/auth-register.html"><i class="dripicons-pencil"></i>Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="authentication/auth-recover-pw.html"><i class="dripicons-clockwise"></i>Recover Password</a></li>
                    <li class="nav-item"><a class="nav-link" href="authentication/auth-lock-screen.html"><i class="dripicons-lock"></i>Lock Screen</a></li>
                    <li class="nav-item"><a class="nav-link" href="authentication/auth-404.html"><i class="dripicons-warning"></i>Error 404</a></li>
                    <li class="nav-item"><a class="nav-link" href="authentication/auth-500.html"><i class="dripicons-wrong"></i>Error 500</a></li>
                </ul>
            </div><!-- end Authentication-->
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