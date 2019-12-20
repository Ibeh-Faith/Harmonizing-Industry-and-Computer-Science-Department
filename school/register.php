<?php include "core/controller.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>Dashboard | Register</title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.css" />
        <link rel="stylesheet" href="css/unicorn-login.css" />
    		<script type="text/javascript" src="js/respond.min.js"></script>
	
        </head>    <body>
        <div id="container">
            <div id="logo">
                <h3 style="color: white">Register</h3>
            </div>
            <div id="here"></div>
            <div id="loginbox">            
                <form action="core/register.php" method="post" >
    				<p> </p>
                    <div class="input-group input-sm">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span><input class="form-control" type="text" name="fname" id="fname" placeholder="Full Name/ Company Name" />
                    </div>
                    <div class="input-group input-sm">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span><input class="form-control" type="text" name="email" id="email" placeholder="Email Address" />
                    </div>
                    <div class="input-group input-sm">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span><input class="form-control" type="number" name="phone"  placeholder="Phone Number" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span><input class="form-control" type="password" name="password" id="password" placeholder="Choose Password" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span><input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </span>
                            <select name="type" id="" required class="form-control">
                                <option value="">Select</option>
                                <option value="S">School</option>
                                <option value="C">Company</option>
                            </select>
                        
                    </div>
                    <div id="profi" class="form-actions clearfix">
                        <button  type="submit" class="btn  btn-block btn-primary btn-default" value="">Submit</button>
                    </div>                    
                </form>
            </div>
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/jquery-ui.custom.min.js"></script>
        <!-- <script src="js/custom.js" type="text/javascript"></script> -->
    </body>
</html>
