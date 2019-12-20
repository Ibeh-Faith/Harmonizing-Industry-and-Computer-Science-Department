<!DOCTYPE html>
<html lang="en">
<head>
        <title>Dashboard | Login</title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.css" />
        <link rel="stylesheet" href="css/unicorn-login.css" />
    		<script type="text/javascript" src="js/respond.min.js"></script>
	
        </head>    <body>
        <div id="container">
            <div id="logo">
                <h3 style="color: white">Welcome to the Industry Curriculum</h3>
            </div>
            <div id="here"></div>
            <div id="loginbox" style="height: 170px">            
                <form action="core/login.php" method="post">
    				<p>  </p>
                    <div class="input-group input-sm">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span><input class="form-control" type="text" name="email" id="email" placeholder="Email Address" />
                    </div>
                    
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span><input class="form-control" type="password" name="password" id="password" placeholder="Password" />
                    </div>
                    <div id="profi" class="form-actions clearfix">
                        <button id="subo" type="submit" class="btn  btn-block btn-primary btn-default" value="">Login</button>
                    </div>  
                    <div class="input-group">
                        <a href="register.php"> Register</a>
                    </div>                  
                </form>
            </div>
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/jquery-ui.custom.min.js"></script>
        <!-- <script src="js/unicorn.login.js"></script>  -->
        <script src="js/custom.js" type="text/javascript"></script>
    </body>
</html>
