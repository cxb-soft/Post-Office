<?php

    function is_pjax(){ 
      return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']; 
    }
    
    if( is_pjax() ){
    
    }
    else{
        header("location:../");
        exit();
    }
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../");
        exit();
    }
    else{
        //require_once("../../config/config.php");
        //$site_name = $site_name;
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $user_name = $_SESSION['user_name'];
    }
    

?>

<?php

    class create_ac{
        function __construct(){
            require_once("../../config/config.php");
            $this -> db = $db;
        }
        function create_acc($account,$account_name,$account_password,$smtp_server,$smtp_port,$username,$sender){
            $this -> command = "insert into userinfo values('$username','$smtp_server','$sender','$account','$account_password','$account_name','$smtp_port')";
            mysqli_query($this -> db , $this -> command);
        }
    }

?>

<?php

    if( isset($_POST['account']) ){
        $account = $_POST['account'];
        $account_name = $_POST['account_name'];
        $account_password = $_POST['account_password'];
        $smtp_server = $_POST['smtp_server'];
        $smtp_port = $_POST['smtp_port'];
        $sender = $_POST['sender'];
        $username = $username;
        $ct_ac = new create_ac;
        $ct_ac -> create_acc($account,$account_name,$account_password,$smtp_server,$smtp_port,$username,$sender);
        echo("<center><h2>邮箱账号已添加</h2></center>");
         echo <<<EOF
        <script>
         $.pjax({
                url : "/users/pages/index.php",
                container : "#pjax-change",
                timeout : 10000
            })
        </script>
EOF;
    }
    else{
        echo <<<EOF
        <script>
         $.pjax({
                url : "/users/pages/index.php",
                container : "#pjax-change",
                timeout : 10000
            })
        </script>
EOF;
        exit();
    }
    

?>