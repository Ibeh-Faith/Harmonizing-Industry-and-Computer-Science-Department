<?php include 'Hash.php'; ?>
<?php

/**
* Banker Classs
* Dapo Believe
*/
class User
{
    private $userId;
    private $balance;
    private $fname;
    private $lname; 
    public  $accountNumber;
    private $currency = '&#x20A6;';
    private $userTable = 'users';
    private $walletId = '';
    private $walletBalance = '';
    private $walletFlag;
    
    function __construct($con, $user_id)
    {
        $sql = "SELECT * 
                FROM $this->userTable
                WHERE $this->userTable.id = '$user_id' ";

        $query = mysqli_query($con, $sql)or die (mysqli_error($con));

        $userData = mysqli_fetch_object($query);

        $this->userId = $userData->id;
        $this->balance = $userData->balance;
        $this->fname = $userData->fname;
        $this->lname = $userData->lname;
        $this->accountNumber = $userData->account;
        $this->connect = $con;

        //get wallet info
    }

    public function getUsers()
    {
        $output = array();
        $sql = "SELECT * 
                FROM users
                WHERE status = 1
                ";
        $query = mysqli_query($this->connect, $sql);
         $x = 1;
        while ($data = mysqli_fetch_object($query)) {
            if($data->type == 'C'){
                $type = 'Customer';
            }else if($data->type == 'B'){
                $type = 'Banker';
            }

            $output[] = array(
                'key'      => $x,
                'fullName' => $data->lname." ".$data->fname,
                'balance'  => number_format($data->balance),
                'account'  => $data->account,
                'type'     => $type,
                'date'     => $data->created_at
            );

            $x++;
        }

        return json_encode($output);
    }

    public function fundWallet($amount){
        //deduct from main account
        $sqlSender = "UPDATE $this->userTable 
                SET balance = balance - $amount 
                WHERE account = '$this->accountNumber' ";
        $querySender = mysqli_query($this->connect, $sqlSender)or die(mysqli_error($this->connect));

        //add to wallet
        $sqlReciever = "UPDATE `wallet` 
                        SET `wbal` = `wbal` + '$amount' 
                        WHERE user_id = '$this->userId'";
        $query = mysqli_query($this->connect,$sqlReciever);

        $rMsg = 'Credited Wallet';
        $rName = $this->fname;
        $rId   = $this->userId;

        $this->logTrxn($rName, $amount, $rId, $this->accountNumber, 'D', $rMsg);
    }

    public function getBalance()
    {
        return $this->balance;
    }

    private function getFullName()
    {
        return ucfirst($this->fname)." ".ucfirst($this->lname);
    }

    public function getUserData()
    {
        $fullName = $this->getFullName();
        $balance     = $this->balance ;
        $trxnHistory = $this->getHistory();
        $accountNumber = $this->accountNumber;

        $userData = array(
            'name'    => $fullName,
            'balance' => number_format($balance),
            'logs'    => $trxnHistory,
            'account' => $accountNumber
        );

        return json_encode($userData);
    }

    

    public function transfer($amount, $reciever, $desc = '' ){
        //deduct from sender
        $sqlSender = "UPDATE $this->userTable 
                SET balance = balance - $amount 
                WHERE account = '$this->accountNumber' ";
        $querySender = mysqli_query($this->connect, $sqlSender)or die(mysqli_error($this->connect));

        //add to reciever
        $sqlReciever = "UPDATE $this->userTable 
                        SET balance = balance + $amount 
                        WHERE account = '$reciever' ";

        $queryReciever = mysqli_query($this->connect, $sqlReciever)or die(mysqli_error($this->connect));

        $sName = $this->getFullName();
        $rName = $this->getFullNamex($reciever);

        $sId = $this->getUserId($this->accountNumber);
        $rId = $this->getUserId($reciever);

        $sMsg = "Cash Deposit to ".$rName;
        $rMsg = "Account credited from ".$sName." ".$desc;

        //log transaction twice
        //senders
        $this->logTrxn($sName, $amount, $sId, $reciever, 'D', $sMsg);

        //recievers
        $this->logTrxn($rName, $amount, $rId, $this->accountNumber, 'C', $rMsg);
    }

    private function getHistory(){
        $output = array();
        $id = $this->getUserId($this->accountNumber);
        $sql = "SELECT * 
                FROM logs
                WHERE user_id = '$this->userId' 
                ";

        $query = mysqli_query($this->connect, $sql);
        $x = 1;

        while ($data = mysqli_fetch_object($query)) {
            $amt = number_format($data->amount);
            $output[] = array(
                'key'      => $x,
                'amount'   => $amt,
                'type'     => $data->type,
                'account'  => $data->account,
                'name'     => $data->name,
                'details'  => $data->details,
                'trxn_ref' => $data->trxn_ref,
                'date'     => $data->created_at
            );

            $x++;
        }

        return $output;
    }

    public function withDraw($amount, $name)
    {
        $sql = "UPDATE $this->userTable 
                SET balance = balance - $amount 
                WHERE account = '$this->accountNumber' ";
        $query = mysqli_query($this->connect, $sql)or die(mysqli_error($this->connect));


        $this->logTrxn($name, $amount, $this->userId, $this->accountNumber, 'W', 'Withdrawal');
    }

    public function checkAccountNumber($acn)
    {
        $sql = "SELECT * 
                FROM users
                WHERE account = '$acn'
                ";
        $query = mysqli_query($this->connect, $sql) or die (mysqli_error($this->connect));
        $data = mysqli_fetch_object($query);
        // print_r($data);
        if(mysqli_num_rows($query) == 1){
            return true;
        }else{
            return false;
        }
    }

    public function deposit($amount, $acNumber, $name)
    {
        $sql = "UPDATE $this->userTable 
                SET balance = balance + $amount 
                WHERE account = '$acNumber' ";
        $query = mysqli_query($this->connect, $sql)or die(mysqli_error($this->connect));

        $userId = $this->getUserId($acNumber);

        $this->logTrxn($name, $amount, $userId, $acNumber, 'D', 'Cash Deposit');
    }

    private function logTrxn($name, $amount, $userId, $account, $type, $details)
    {
        $ref = TransRef::getHashedToken();
        $sql = "INSERT INTO logs (name, amount, user_id, account, type, details, trxn_ref) VALUES ('$name','$amount','$userId', '$account', '$type', '$details', '$ref')";
        $query = mysqli_query($this->connect,$sql)or die(mysqli_error($this->connect));
    }

    public function getUserId($accountNum)
    {
        $sql = "SELECT * 
                FROM users
                WHERE account = '$accountNum'
                ";
        $query = mysqli_query($this->connect, $sql) or die (mysqli_error($this->connect));

        $userData = mysqli_fetch_object($query);
        return $userData->id;
    }

    public function getFullNamex($accountNum)
    {
        $sql = "SELECT * 
                FROM users
                WHERE account = '$accountNum'
                ";
        $query = mysqli_query($this->connect, $sql) or die (mysqli_error($this->connect));

        $userData = mysqli_fetch_object($query);
        return $userData->fname." ".$userData->lname;
    }
}