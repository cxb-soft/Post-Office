<?php
    
    class ver_mg{
        function __construct(){
            require_once("../../config/config.php");
            $this -> db = $db;
        }
        function getver(){
            $this -> command = "select * from config where config_name='ver'";
            $this -> result = mysqli_fetch_assoc(mysqli_query($this -> db , $this -> command));
            return $this -> result;
        }
        function get_last_ver(){
            $this -> url = 'http://service.bsot.cn/post/check_update.php/?com=get_last_ver';
            $this -> file_contents = file_get_contents($this -> url);
            return $this -> file_contents;
        }
        
    }
    
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

<style>
    .beauty-mdui{
        padding-right: 5%;
        padding-left: 5%;
    }
</style>
<br>
<?php

    $mg_ver = new ver_mg;
    $this_ver = $mg_ver -> getver();
    $this_ver = $this_ver['config_value'];
    $last_ver = $mg_ver -> get_last_ver();

?>
<div class="beauty-mdui">
    <center>
        <p>当前版本:&emsp;&emsp;<?php echo($this_ver); ?></p>
        <p>最新版本:&emsp;&emsp;<?php echo($last_ver); ?></p>
    </center>
    
    <?php
    
        if( $this_ver == $last_ver ){
            echo <<<EOF
            <center><h2>恭喜现在已经是最新版本!</h2></center>
EOF;
        }
        else{
            echo <<<EOF
            <center>
                <button class="mdui-btn mdui-ripple mdui-color-green" onclick="update_go()">
                    更新
                </button>
                
            </center>
EOF;
        }
    
    ?>
    
    <!--<center>
        <button class="mdui-btn mdui-ripple mdui-color-green" onclick="check_update()">
            更新
        </button>
        
    </center>-->
</div>

<script>
    function update_go(){
        $.pjax({
            url : "/admin/pages/update_go.php",
            container : "#pjax-change",
            type: "post",
            data : {
                "version" : "<?php echo($last_ver); ?>"
            },
            timeout : 10000
        })
    }
</script>