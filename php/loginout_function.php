<?php
if(isset($_SESSION['username'])) {
    ?>
    <script>
        document.getElementById("logout_change").style.display = "block";
        document.getElementById("login_change").style.display = "none";
        $('logout_change').append("<li><a href='personal_info.php'>" + username + "</a></li>");
    </script>
    <?php
}
?>

<script>
    $('.login_submit').click(function () {
        /*
                var username = $('input[name=username]');
                var password = $('input[name = userpassword]');

                */
        var username = document.getElementById("login_name").value;
        var password = document.getElementById("login_password").value;

        console.log(username+password);
        $.ajax({
            type:"POST",
            async:false,   //同步   默认是true（异步）
            url:"../php/login.php",
            data:{
                username:username,
                password:password
            },
            dataType:"TEXT",
            success:function(data){

                switch(data){
                    case 0: alert("用户不存在!");  break;
                    case 1: alert("密码错误！"); break;
                    case 2: alert("登陆成功！"); break;

                }
                /*
                if(data=='success'){
                alert('登陆成功！');
                document.getElementById("logout_change").style.display = "block";
                document.getElementById("login_change").style.display = "none";
                $('logout_change').append("<li><a href='personal_info.php'>"+username+"</a></li>");
                }
                if(data=='error0'){
                    alert('用户不存在！请先注册');
                }
                if(data=='error1'){
                    alert('密码错误！');
                }
   */
            }

        });

    });

    //登陆变化



</script>