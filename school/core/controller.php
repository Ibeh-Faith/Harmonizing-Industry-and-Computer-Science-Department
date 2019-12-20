<?php session_start();?>
<?php
include "conn.php";



if(isset($_POST['school'])){

    $id = $_SESSION['user_id'];
    // $name = $_POST['sname'];
    $school = $_POST['school'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (`from`,`to`,`message`) VALUES ('$id','$school','$message')";

    $query = mysqli_query($con, $sql)or die(mysqli_error($con));


}

if(isset($_POST['xpect'])){
    $id = $_SESSION['user_id'];
    $xpect = $_POST['xpect'];
    $school = $_POST['fschool'];
    $message = $_POST['message'];

    $sql = "INSERT INTO report (`from`,`to`,`xpect`,`comment`) VALUES ('$id','$school','$xpect','$message')";

    $query = mysqli_query($con, $sql)or die(mysqli_error($con));
}


?>