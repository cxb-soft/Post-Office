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
    session_start();
    if(isset($_SESSION['username_back'])){
        $username = $_SESSION['username_back'];
        $password = $_SESSION['password_back'];
        $mg_login = new login_mg;
        if( $mg_login -> login_auth($username,$password) == "success" ){
            $site_name = $_SESSION['site_name'];
        }
        else{
            echo("<meta http-equiv=\"Refresh\" content=\"0; url=../index.php\"/>");
            exit();
            //header("location:../index.php");
        }
    }
    else{
        echo("<meta http-equiv=\"Refresh\" content=\"0; url=../index.php\"/>");
        exit();
    }
    
    //echo($username . "  " .$password);
    

?>

<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <link rel="shortcut icon" href="../favicon.ico" >
	    <link rel="stylesheet" href="//cdnjs.loli.net/ajax/libs/mdui/0.4.3/css/mdui.min.css">
	    <!--<link rel="stylesheet" href="all-a.css">-->
        <script src="//cdnjs.loli.net/ajax/libs/mdui/0.4.3/js/mdui.min.js"></script>
        <title><?php echo("$site_name"); ?>的后台</title>
        <link rel="shortcut icon" href="/favicon.ico" >
        <link rel="stylesheet" href="/fw/node_modules/nprogress/nprogress.css">
        <link rel="stylesheet" href="../all-a.css">
    </head>
    <body class="mdui-typo" background='https://www.toptal.com/designers/subtlepatterns/patterns/repeated-square.png'>
        <div class="mdui-tab mdui-tab-centered" mdui-tab>
            <a href="javascript:void(0)" onclick="go_index()" class="mdui-ripple">主页</a>
            <a href="javascript:void(0)" onclick="update_check()" class="mdui-ripple">检查更新</a>
          
        </div>
        <div id="pjax-change">
        </div>
    </body>
    <script src="/fw/node_modules/jquery/dist/jquery.js"></script>
    <script src="/fw/node_modules/jquery-pjax/jquery.pjax.js"></script>
    <script src="/fw/node_modules/nprogress/nprogress.js"></script>
    <script>
        $(document).on('pjax:start', function() { NProgress.start(); });
        $(document).on('pjax:end',   function() { NProgress.done();  });
        $.pjax({
                url : "/admin/pages/index.php",
                container : "#pjax-change"
            })
        function go_index(){
            $.pjax({
                url : "/admin/pages/index.php",
                container : "#pjax-change"
            })
        }
        function update_check(){
            $.pjax({
                url : "/admin/pages/update_page.php",
                container : "#pjax-change"
            })
        }
    </script>
</html>


