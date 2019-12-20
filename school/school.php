<?php require_once "core/controller.php";?>
<?php
if(!isset($_SESSION['user_id']))
    echo "Not Logged In";

if($_SESSION['type'] != 'S')
    header('Location: logout.php')
?>
<?php

$sql = mysqli_query($con, "SELECT * FROM users WHERE status = 'Verified' AND type = 'C' ");


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
                                <span class="icon">
                                    <i class="fa fa-bell"></i>
                                </span>
                                <h5>Send Message</h5>
                            </div>
                            <div class="widget-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="msg-form" action="core/controller.php" method="post">
                                      <!-- <div class="form-group">
                                        <label for="exampleInputEmail1">Student Name</label>
                                        <input type="text" name="sname" class="form-control" placeholder="Student Name">
                                      </div> -->
                                      <div class="form-group">
                                        <label for="">Select Company</label>
                                        <select name="school" class="form-control">
                                            <option value="">---Select---</option>
                                            <?php while ($data = mysqli_fetch_object($sql)) { ?>
                                                <option value="<?php echo $data->id?>"><?php echo $data->name?></option>
                                            <?php } ?>
                                        </select>
                                      </div>

                                      <div class="form-group">
                                            <label> Message: </label>
                                            <textarea name="message" class="form-control" id="" cols="30" rows="10"></textarea>
                                      </div>
                                      
                                      <button type="submit" class="btn btn-default">Submit</button>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                </div>

            </div>
            <?php include "inc_footer.php";?>
        </div>

            <?php include "inc_scripts.php";?>
<script>
    $('#msg-form').on('submit', function(){
        var that = $(this), 
            url  = that.attr('action'),
            method = that.attr('method'),
            data = {};

            that.find('[name]').each(function (index, value) {
                var that = $(this),
                name = that.attr('name'),
                value = that.val();

                data[name] = value;
            });
            // console.log(data);

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(response){
                    console.log(response);
                    $('#msg-form').trigger('reset')
                    alert("Message Sent")
                }
            })
        return false;
    })
</script>
    </body>

</html>
