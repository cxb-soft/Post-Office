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
<div class="mdui-card-content mdui-typo">
    <center><h2>注册账号</h2></center>
    <br>
    
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">用户名</label>
        <input class="mdui-textfield-input" type="text" id="username_reg" />
    </div>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">密码</label>
        <input class="mdui-textfield-input" type="password" id="password_reg" />
    </div>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">称呼</label>
        <input class="mdui-textfield-input" type="text" id="name_reg" />
    </div>
    <br>
    <center><button class="mdui-fab" onclick="reg_go()">
        <svg t="1583458664699" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2119" width="32" height="32"><path d="M632.555 583.662a334.724 334.724 0 0 1 34.43 15.764c13.844 7.312 19.14 24.463 11.828 38.308-7.312 13.845-24.463 19.14-38.308 11.829-39.825-21.033-84.256-32.18-130.354-32.18-134.46 0-249.156 95.628-274.315 225.944-2.968 15.373-17.837 25.43-33.21 22.462-15.374-2.968-25.43-17.837-22.462-33.21 22.237-115.181 102.51-207.796 207.629-248.892-76.518-42.868-128.233-124.698-128.233-218.602 0-138.316 112.198-250.435 250.592-250.435 138.392 0 250.59 112.12 250.59 250.435 0 93.886-51.695 175.702-128.187 218.577z m71.487-218.577c0-106.992-86.804-193.735-193.89-193.735-107.088 0-193.892 86.742-193.892 193.735 0 106.992 86.804 193.734 193.892 193.734 107.086 0 193.89-86.743 193.89-193.734z m12.694 346.77V626.83a28.26 28.26 0 0 1 3.87-14.324 28.468 28.468 0 0 1 10.175-10.174 28.26 28.26 0 0 1 14.324-3.87 28.26 28.26 0 0 1 14.324 3.87 28.468 28.468 0 0 1 10.174 10.174 28.26 28.26 0 0 1 3.87 14.324v85.025h84.179c15.656 0 28.348 12.692 28.348 28.349 0 15.656-12.692 28.348-28.348 28.348h-84.18v84.08a28.26 28.26 0 0 1-3.87 14.324 28.468 28.468 0 0 1-10.173 10.174 28.26 28.26 0 0 1-14.324 3.87 28.26 28.26 0 0 1-14.324-3.87 28.468 28.468 0 0 1-10.175-10.174 28.26 28.26 0 0 1-3.87-14.324v-84.08h-85.124c-15.656 0-28.348-12.692-28.348-28.348 0-15.657 12.692-28.349 28.348-28.349h85.124z" p-id="2120"></path></svg>
    </button></center>
</div>

<script>
    function reg_go(){
        var username_reg = $("#username_reg").val()
        var password_reg = $("#password_reg").val()
        var name_reg = $("#name_reg").val()
        $.pjax({
            url : "/apps/reg_go.php",
            container : "#pjax-change",
            type : "post",
            data : {
                "username_reg" : username_reg,
                "password_reg" : password_reg,
                "name_reg" : name_reg
            }
        })
    }
</script>