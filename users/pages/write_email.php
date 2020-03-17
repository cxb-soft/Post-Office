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
<center><h2>写一个邮件</h2></center>
<br>
<div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">收件人</label>
    <input class="mdui-textfield-input" type="text" id="receiver" />
</div>
<div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">收件人称呼</label>
    <input class="mdui-textfield-input" type="text" id="receiver_name" />
</div>
<div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">标题</label>
    <input class="mdui-textfield-input" type="text" id="title" />
</div>

<div class="mdui-textfield">
  <textarea class="mdui-textfield-input" rows="15" placeholder="内容" id="content"></textarea>
</div>

<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    发件邮箱
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <!--<li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>-->
    <?php
            
        $acc_mg = new account_mg;
        $acc_list = $acc_mg -> get_acc_list($username);
        if($acc_list == "empty"){
            //goto empty_if;
        }
        else{
            foreach( $acc_list as $acc_item ){
                $account_name = $acc_item[5];
                $account = $acc_item[3];
                echo("<li><a href='javascript:void(0);' onclick='sender_select(\"$account_name\")'>$account_name|$account</a></li>");
                
            }
            //goto not_empty;
        }
            
    ?>
        </tbody>
  </ul>
</div>

<button class="mdui-fab" style="float:right" onclick="send_mail()">
    <svg t="1583415145629" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3793" width="32" height="32"><path d="M768 992c-6.4 0-12.8 0-19.2-6.4L512 838.4l-115.2 115.2c0 12.8-12.8 12.8-25.6 6.4s-19.2-19.2-19.2-32v-236.8c0-6.4 6.4-19.2 6.4-25.6L710.4 320c12.8-12.8 32-12.8 44.8 0 12.8 12.8 12.8 32 0 44.8L409.6 704v147.2l76.8-76.8c12.8-6.4 32-12.8 44.8-6.4l217.6 134.4L908.8 128l-768 409.6 166.4 96c6.4 6.4 12.8 25.6 6.4 38.4-6.4 12.8-25.6 19.2-44.8 12.8L57.6 563.2c-12.8-6.4-19.2-19.2-19.2-32s6.4-19.2 19.2-25.6L934.4 38.4c12.8-6.4 25.6-6.4 32 0 12.8 6.4 12.8 19.2 12.8 32L800 960c0 12.8-6.4 19.2-19.2 25.6 0 0-6.4 6.4-12.8 6.4z" fill="#14ADC4" p-id="3794"></path></svg>
</button>

<script>
    window.account_name_sel = "";
    function send_mail(){
        var receiver = $("#receiver").val()
        var receiver_name = $("#receiver_name").val()
        var title = $("#title").val()
        var content = $("#content").val()
        var reg=new RegExp("\r\n","g");
        content = content.replace(reg,"\r\n");
        content = content.replace(/\n/g,'<br />');
        $.pjax({
            url : "../../apps/send_mail.php",
            container : "#pjax-change",
            type : "post",
            data : {
                "receiver" : receiver,
                "title" : title,
                "content" : content,
                "account_name" : window.account_name_sel,
                "receiver_name" : receiver_name,
                "username" : "<?php echo($username) ?>"
            },
            timeout : 10000
        })
    }
    function sender_select(account_name_sel){
        var obj = document.getElementById("dropdownMenu1");

        window.account_name_sel = account_name_sel
        obj.innerText = window.account_name_sel
        console.log(account_name_sel)
    }
</script>