<br><br>


<?php

    class login_mg{
        function __construct(){
            require_once("../config/config.php");
            $this -> username = $admin_user;
            $this -> password = $admin_password;
        }
        function login_auth($username,$password){
            if( $this -> username == $username and $this -> password == $password ){
                return "success";
            }
            else{
                return "error";
            }
        }
    }
    function is_pjax(){ 
      return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']; 
    }
    if(is_pjax()){
        $mg_login = new login_mg;
        $username = $_POST['username'];
        $password = $_POST['password'];
        if( $mg_login -> login_auth($username,$password) == "success" ){
            echo("<center><h2>登录成功</h2></center>");
            session_start();
            $_SESSION['username_back'] = $username;
            $_SESSION['password_back'] = $password;
            echo("<meta http-equiv=\"Refresh\" content=\"1; url=./index.php\"/>");
        }
        else{
            echo("<center><h2>登录失败，请检查</h2></center>");
        }
    }
    else{
        $server = $_SERVER['HTTP_HOST'];
        header("location:http://$server");
    }


?>