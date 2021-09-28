<?php 
    session_start();
    require_once 'dbconnect.php'; 

?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rsystem Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A premium admin dashboard template by Mannatthemes" name="description" />
        <meta content="Mannatthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

    </head>

    

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