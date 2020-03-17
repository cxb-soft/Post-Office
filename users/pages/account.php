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

    class account_mg{
        function __construct(){
            require_once("../../config/config.php");
            $this -> db = $db;
        }
        function get_acc_list($username){
            $this -> command = "select * from userinfo where username='$username'";
            $this -> result = mysqli_fetch_all(mysqli_query($this -> db , $this -> command));
            if( empty($this -> result) ){
                return "empty";
            }
            else{
                return $this -> result;
            }
        }
    }

?>



<br><br>
<center><h2><?php echo($user_name); ?>的邮箱管理</h2></center>
<br>
<button class="mdui-fab mdui-fab-mini mdui-ripple" style="float:right" onclick="new_acc()">
    <svg t="1583410966470" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2887" width="16" height="16"><path d="M900.7 432.2H548.4V109.3c0-20.2-16.5-36.7-36.7-36.7-20.2 0-36.7 16.5-36.7 36.7v322.9H122.8c-20.2 0-36.7 16.5-36.7 36.7 0 20.2 16.5 36.7 36.7 36.7h352.3v381.6c0 20.2 16.5 36.7 36.7 36.7 20.2 0 36.7-16.5 36.7-36.7V505.6h352.3c20.2 0 36.7-16.5 36.7-36.7-0.1-20.2-16.6-36.7-36.8-36.7z" fill="" p-id="2888"></path></svg>
</button>
<br>
<div class="mdui-table-fluid">
    <table class="mdui-table mdui-hoverable">
        <thead>
            <th>邮箱名</th>
            <th>邮箱账号</th>
            <th>邮箱发送者</th>
            <th>操作</th>
        </thead>
        <tbody>
            <?php
            
                $acc_mg = new account_mg;
                $acc_list = $acc_mg -> get_acc_list($username);
                if($acc_list == "empty"){
                    //goto empty_if;
                }
                else{
                    foreach( $acc_list as $acc_item ){
                        $account_name = $acc_item[5];
                        $account_username = $acc_item[3];
                        $sender = $acc_item[2];
                        echo("<tr>");
                        echo("<td>$account_name</td>");
                        echo("<td>$account_username</td>");
                        echo("<td>$sender</td>");
                        echo("<td></td>");
                        echo("</tr>");
                    }
                    //goto not_empty;
                }
            
            ?>
        </tbody>
<?php

//empty_if:
    //echo("<center><h2>没有账号，点击创建一个</h2></center>");
//not_empty:
    
?>
    </table>
</div>

<script>
    function new_acc(){
        $.pjax({
            url : "new_acc_req.php",
            container : "#pjax-change",
            timeout : 10000
        })
    }
</script>