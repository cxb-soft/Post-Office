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

?>

<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:../");
        exit();
    }
    else{
        //require_once("../../config/config.php");
        //$site_name = $site_name;
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
    }
    //require_once("../../config.php");
    //$db = $db;
    class user_mg{
        function __construct(){
            require_once("../../config/config.php");
            $this -> db = $db;
        }
        function get_user_name($username){
            $this -> command = "select * from users where username='$username'";
            $this -> result = mysqli_fetch_assoc(mysqli_query($this -> db , $this -> command));
            return $this -> result['name'];
        }
    }
    
    $user = new user_mg;
    $user_name = $user -> get_user_name($username);
    $_SESSION['user_name'] = $user_name;

?>
<br><br>
<center>
    <h2>你好，<?php echo($user_name); ?></h2>
</center>