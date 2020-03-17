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
    class login_auther{
        function __construct(){
            require_once("../config/config.php");
            $this -> db = $db;
        }
        function login_auth($username , $password){
            $this -> command = "select * from users where username='$username'";
            $this -> result = mysqli_fetch_assoc(mysqli_query($this -> db , $this -> command));
            if( empty($this -> result) ){
                return "No_user";
            }
            else{
                $this -> cor_password = $this -> result['password'];
                if( $password == $this -> cor_password ){
                    return "suc";
                }
                else{
                    return "pass_incor";
                }
            }
        
        }
    }

?>
<br><br>
<?php

    if( isset($_POST['username_login']) ){
        $username_login = $_POST['username_login'];
        $password_login = $_POST['password_login'];
        $login_auther_1 = new login_auther;
        $check_user = $login_auther_1 -> login_auth($username_login , $password_login);
        if($check_user == "suc"){
            session_start();
            $_SESSION['username'] = $username_login;
            $_SESSION['password'] = $password_login;
            echo("<center><h2>登录成功</h2></center>");
            echo("<meta http-equiv=\"Refresh\" content=\"1; url=../users/index.php\"/>");
            /*echo <<<EOF
            <script>
            
                $.pjax({
                    url : "/users/index.php",
                    container : "#pjax-body"
                })
            
            </script>
EOF;*/
        }
        elseif ( $check_user == "No_user" ) {
            echo("<center><h2>未找到此用户</h2></center>");
            echo <<<EOF
            <script>
            
                $.pjax({
                    url : "/pages/index.php",
                    container : "#pjax-change"
                })
            
            </script>
EOF;
        }
        elseif ( $check_user == "pass_incor" ) {
            echo("<center><h2>密码错误</h2></center>");
            echo <<<EOF
            <script>
            
                $.pjax({
                    url : "/pages/index.php",
                    container : "#pjax-change"
                })
            
            </script>
EOF;
        }
    }
    else{
        header("location:../");
        exit();
    }

?>