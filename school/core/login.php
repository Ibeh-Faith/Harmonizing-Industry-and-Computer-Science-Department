<?php include 'conn.php';?>
<?php
if(isset($_POST['email'])){

    if(empty($_POST['email']) || empty($_POST['password'])){

        echo "All fileds required";
    
    }else
    {
     
        $emailNumber = mysqli_real_escape_string($con,$_POST["email"]);

        $password = md5($_POST["password"]);

        $sql = "SELECT * FROM users WHERE email = '$emailNumber' AND password = '$password' ";

        $run_query = mysqli_query($con,$sql)or die(mysqli_error($con));

        $count = mysqli_num_rows($run_query);
        
        if($count == 1){
            $row = mysqli_fetch_assoc($run_query);
            session_start();
            if($row["type"] == 'C'){
               
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['type'] =  'C';

                header('Location: ../company.php');

            }else if($row["type"] == 'S'){
                
                $_SESSION['type'] =  'S';
                $_SESSION['name'] = $row['name'];
                $_SESSION["user_id"] = $row['id'];
                header('Location: ../school.php');
            }
            
        }else
        {
            echo "User not found please check your details properly ";

        }
    }
}
?>