<?php require_once "core/controller.php";?>
<?php
if(!isset($_SESSION['user_id']))
    echo "Not Logged In";
?>
<?php

$id = $_SESSION['user_id'];
// $type = $_SESSION['type'];

$sql = mysqli_query($con, "SELECT * FROM messages 
                            JOIN users on messages.from = users.id
                            WHERE messages.to = '$id'
                            ORDER BY created_at ");


?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title>Dashboard</title>
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
                                <span class="icon with-checkbox">
                                    <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                                </span>
                                <h5>Messages</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered table-striped table-hover with-check">
                                    <thead>
                                        <tr>
                                            <!-- <th><i class="fa fa-resize-vertical"></i></th> -->
                                            <th>From</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($data = mysqli_fetch_object($sql)) { ?>
                                        <tr>
                                            
                                                <td>
                                                    <a style="cursor: pointer" href="message-details.php?mid=<?php echo $data->id?>"><?php echo $data->name?></a></td>
                                            
                                            <td><?php echo $data->email?></td>
                                            <td><?php
                                                if($data->stat == 1)
                                                    echo "Read";
                                                else
                                                    echo "Unread";

                                                ?></td>
                                            <td><?php echo date("D M j, H:i", strtotime($data->created_at)) ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>                            
                            </div>
                        </div>                </div>

            </div>
            <?php include "inc_footer.php";?>
        </div>

            <?php include "inc_scripts.php";?>
<script>
    
</script>
    </body>

</html>
