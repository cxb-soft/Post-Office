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

    class user_mg{
        function __construct(){
            require_once("../config/config.php");
            $this -> db = $db;
        }
        function add_user($username,$password,$name){
            $this -> command = "select * from users where username='$username'";
            $this -> result = mysqli_fetch_all(mysqli_query($this -> db , $this -> command));
            if(empty($this -> result)){
                $this -> command = "insert into users values('$username','$password','$name')";
                mysqli_query($this -> db , $this -> command);
                return "suc";
            }
            else{
                return "User_incl";
            }
        }
    }

?>

<?php

    if( isset($_POST['username_reg']) ){
        $username = $_POST['username_reg'];
        $password = $_POST['password_reg'];
        $name = $_POST['name_reg'];
        $user_ctl = new user_mg;
        $user_return = $user_ctl -> add_user($username,$password,$name);
        if($user_return == "User_incl"){
            echo("<center><h2>已经有了此用户啦，换个试试吧</h2></center>");
            echo("<meta http-equiv=\"Refresh\" content=\"1; url=../\"/>");
        }
        else{
            echo("<center><h2>注册成功</h2></center>");
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['name'] = $name;
            echo("<meta http-equiv=\"Refresh\" content=\"1; url=../users/\"/>");
        }
    }

?>