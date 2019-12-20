<?php require_once "core/controller.php";?>
<?php
if(!isset($_SESSION['user_id']))
    echo "Not Logged In";
?>
<?php

$id = $_GET['mid'];

$sql = mysqli_query($con, "SELECT * FROM report WHERE id = '$id' ")or die(mysqli_error($con));

$dta = mysqli_fetch_object($sql);


// $sql1 = mysqli_query($con, "UPDATE messages SET status = 1 WHERE id = '$id' ");


?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title><?php echo $_SESSION['name'] ?></title>
        <?php include "inc_head.php";?>
        
</head> 
    <body data-color="grey" class="flat">
        <div id="wrapper">
            <div id="header">
                <h1><a href="index-2.html">Unicorn Admin</a></h1>   
                <a id="menu-trigger" href="#"><i class="fa fa-bars"></i></a>    
            </div>


            <?php include "inc_menu.php";?>
            
            <div id="content">
                <div id="content-header" class="mini">
                    <h1><?php echo $_SESSION['name'] ?></h1>
                </div>

                <div id="breadcrumb">
                    <a href="#" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a>
                    <a href="#" class="current">Dashboard</a>
                </div>

                <div class="container"> 
                    <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="fa fa-bell"></i>
                                </span>
                                <h5>Report Details</h5>
                            </div>
                            <div class="widget-content">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <p>
                                        <h3>Expectations</h3>
                                        <?php echo $dta->xpect ?>
                                    </p>
                                    <hr>
                                    <br>
                                    <p>
                                        <h3>Overall Comments</h3>
                                        <?php echo $dta->comment ?>
                                    </p>
                                    <hr>
                                    <br>
                                    <br>
                                    <br>
                                    <small>Sent: <?php echo date("D M j, H:i", strtotime($dta->date)) ?></small>
                                </div>
                            </div>
                            </div>
                        </div>
                </div>

            </div>
            <?php include "inc_footer.php";?>
        </div>

            <?php include "inc_scripts.php";?>

    </body>

</html>
