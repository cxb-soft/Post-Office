<br><br>
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
        header("location:../");
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

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    function send_mail($username,$smtp_server,$password,$smtp_port,$name,$receiver,$receiver_name,$mail_title,$mail_content){
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //服务器配置
            $mail->CharSet ="UTF-8";                     //设定邮件编码
            $mail->SMTPDebug = 0;                        // 调试模式输出
            $mail->isSMTP();                             // 使用SMTP
            $mail->Host = $smtp_server;                // SMTP服务器
            $mail->SMTPAuth = true;                      // 允许 SMTP 认证
            $mail->Username = $username;                // SMTP 用户名  即邮箱的用户名
            $mail->Password = $password;             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
            $mail->Port = $smtp_port;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持
        
            $mail->setFrom($username, $name);  //发件人
            $mail->addAddress($receiver, $receiver_name);  // 收件人
            //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
            $mail->addReplyTo($username, $name); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                    //抄送
            //$mail->addBCC('bcc@example.com');                    //密送
        
            //发送附件
            // $mail->addAttachment('../xy.zip');         // 添加附件
            // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名
        
            //Content
            $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = $mail_title;
            $mail->Body    = $mail_content;
            $mail->AltBody = '抱歉，此内容不支持';
        
            $mail->send();
            echo '<center><h2>邮件发送成功</h2></center>';
        } catch (Exception $e) {
            echo '<center><h2>邮件发送失败: ', $mail->ErrorInfo ."</h2></center>";
        }
    }
    //send_mail("cxbsoft@bsot.cn","smtp.exmail.qq.com","Wabadmin1",465,"cxbsoft","3319066174@qq.com","cxb","测试","测试邮件");
    
    class send_mail_ctl{
        function __construct(){
            require_once("../config/config.php");
            $this -> db = $db;
        }
        function get_mail_info($account_name,$username){
            $this -> command = "select * from userinfo where account_name='$account_name' and username='$username'";
            $this -> result = mysqli_fetch_assoc(mysqli_query($this -> db,$this -> command));
            return $this -> result;
        }
    }
    
    if( isset($_POST['account_name']) ){
        $account_name = $_POST['account_name'];
        $title = $_POST['title'];
        $receiver = $_POST['receiver'];
        $content = $_POST['content'];
        $username = $_POST['username'];
        $ctl = new send_mail_ctl;
        $mail_info = $ctl -> get_mail_info($account_name,$username);
        $smtp_server = $mail_info['smtp_server'];
        $smtp_port = $mail_info['smtp_port'];
        $sender = $mail_info['sender'];
        $account = $mail_info['account'];
        $receiver_name = $_POST['receiver_name'];
        $account_password = $mail_info['account_password'];
        send_mail($account,$smtp_server,$account_password,$smtp_port,$sender,$receiver,$receiver_name,$title,$content);
    }
    
?>