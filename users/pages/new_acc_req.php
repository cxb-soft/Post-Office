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

<br><br>
<center><h2>新建一个邮箱账号</h2></center>
<div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">起个名字</label>
    <input class="mdui-textfield-input" type="text" id="account_name" />
</div>
<div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">邮箱账号</label>
    <input class="mdui-textfield-input" type="text" id="account" />
</div>
<div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">发件人</label>
    <input class="mdui-textfield-input" type="text" id="sender" />
</div>
<div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">邮箱密码</label>
    <input class="mdui-textfield-input" type="password" id="account_password" />
</div>
<div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">SMTP服务器</label>
    <input class="mdui-textfield-input" type="text" id="smtp_server" />
</div>
<div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">SMTP SSL端口</label>
    <input class="mdui-textfield-input" type="text" id="smtp_port" />
</div>

<button class="mdui-btn mdui-ripple" onclick="create_account()">创建</button>

<script>
    function create_account(){
        var account_name = $("#account_name").val()
        var account_password = $("#account_password").val()
        var account = $("#account").val()
        var smtp_server = $("#smtp_server").val()
        var smtp_port = $("#smtp_port").val()
        var sender = $("#sender").val()
        var username = "<?php echo($username); ?>"
        $.pjax({
            url : "create_acc.php",
            container : "#pjax-change",
            type : "post",
            data : {
                "account" : account,
                "account_name" : account_name,
                "account_password" : account_password,
                "smtp_server" : smtp_server,
                "smtp_port" : smtp_port,
                "sender" : sender,
                "username" : username
            },
            timeout : 10000
        })
    }
</script>