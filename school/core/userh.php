<?php session_start(); ?>
<?php require_once "process-login.php";?>
<?php require_once "userProcess.php";?>
<?php
if(isset($_GET['loaded'])){
    $user = new User($con, 3);

    echo $user->getUsers();
}


if(isset($_GET['loader'])){
    $user = new User($con, $_SESSION['user_id']);

    echo $user->getUserData();
}

if(isset($_GET['type'])){
      $name = $_GET['wname'];
      $amount = $_GET['wamount'];
      $user = new User($con, $_SESSION['user_id']);

        if( ((int)$user->getBalance())  < $amount){
          echo "insufficient funds";
          exit();
        }else{
          echo $user->withDraw($amount, $name);
          echo "Transaction Successful";
        }
}

if(isset($_GET['fdata'])){
    $accountNumber = $_GET['rAcc'];
    $amount = $_GET['amount'];

    $user = new User($con, $_SESSION['user_id']);
    // echo $user->checkAccountNumber($accountNumber);

    if($user->checkAccountNumber($accountNumber)){
        // echo "sender is ==>". $user->accountNumber ." receiver is ==>". $formData['rAcc'];

        if($accountNumber != $user->accountNumber ){

            if($user->getBalance() < $amount){
                echo $amount;
                echo "Account balance too low";
            }else{
                $user->transfer($amount, $accountNumber);
                echo "Transaction Successful";
            }
        }else{
            echo "You cant transfer to yourself";
        }
    }else{
        echo "Account Number does not exist";
    }
}

if(isset($_GET['funddata'])){
    $formData = json_decode($_GET['funddata'], true);
    $user = new User($con, $_SESSION['user_id']);

    if($user->checkAccountNumber($formData['rAcc'])){
        // echo "sender is ==>". $user->accountNumber ." receiver is ==>". $formData['rAcc'];

        if($formData['rAcc'] != $user->accountNumber ){

            if($user->getBalance() < $formData['amount']){
                echo "Account balance too low";
            }else{
                $user->transfer($formData['amount'], $formData['rAcc']);
                echo "Transaction Successful";
            }
        }else{
            echo "You cant transfer to yourself";
        }
    }else{
        echo "Account Number does not exist";
    }

}



?>