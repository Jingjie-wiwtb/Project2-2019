<div class="nav">      <!--导航栏-->
    <img class="nav_background" src="../images/nav.jpg">
    <img class="logo" src="../images/logo.png">
    <ul>

        <li><a href="cart.php">购物车</a></li>
        <div id="login_change">
            <li><a id="register_btn">注册</a></li>
            <li><a id="login_btn" class="">登陆</a></li>
        </div>
        <div id="logout_change">
            <li id="logout_btn"><a  >登出</a></li>
            <li><a href="personal_info.php"><?php echo $_SESSION['username'] ?></a></li>
        </div>
        <li> <a class="drop-btn" href="#">分类</a></li>
        <li><a class="new.php" href="Home.php">主页</a></li>
    </ul>
</div>


<img class="black_pointer" src="../images/black_pointer_cut.png">
<!--   搜索框  -->



<!-------------登陆窗口------------->

<div class="pop_back" id="login_pop_back" >
    <div id="login_pop_content" class="pop_content">
        <span id="login_close-btn">×</span>
        <div class="pop_head">
            <h2>Welcome to Art Market!</h2>
        </div>
        <div class="pop_body">
            <h2>登陆</h2>
            <form action="../php/login.php" method="POST" onsubmit="return login_validate()">
                <div>
                    <label for="login_name">用户名:</label>
                    <input type="text" name="username" id="login_name" placeholder="用户名" onblur="checklogin_name()" required >
                    <span class="default" id="errLname"></span>
                </div>
                <div>
                    <label for="login_password">密码:</label>
                    <input type="password" name="userpassword" id="login_password" onblur="checklogin_psw()" placeholder="密码（注意大小写）" required >
                    <span class="default" id="errLpsw"></span>
                </div>
                <div>


                    <label for="input_vcode">验证码</label>
                    <input type="text" name="input_vcode" id="input_vcode"  onblur="validate()" placeholder="请输入图中的验证码">
                    <span class="default" id="errVerifycode"></span>
                    <a class="change_vcode" onclick="createCode()"> 换一张</a>
                    <label for="print_vcode"></label>
                    <input  id="print_vcode" class="code" disabled="disabled"/>

                </div>
                <input type="submit" class="pop_submit" value="登陆"></input>   <!--pop_submit-->
            </form>
        </div>
    </div>
</div>
<!-- 弹窗内容结束 -->


<!-------------注册窗口------------>

<div class="pop_back" id="register_pop_back" >
    <div id="register_pop_content" class="pop_content">
        <span id="register_close-btn">×</span>
        <div class="pop_head">
            <h2>Welcome to Art Market!</h2>
        </div>
        <div class="pop_body">
            <h2>注册</h2>
            <form action="../php/register.php" method="POST" onsubmit="return register_validate()">
                <div>
                    <label for="username">请设置用户名:</label>
                    <input type="text" name="username" id="username" placeholder="（不能为纯数字或纯字母" onblur="checkUsername()">
                    <span class="default" id="errname"></span>
                </div>
                <div>
                    <label for="userpassword">请设置密码:</label>
                    <input type="password" name="userpassword" id="userpassword" placeholder="（至少6位，注意大小写）" onblur="checkPassword()">
                    <span class="default" id="errpsw"></span>
                </div>
                <div>
                    <label for="confirm_password">确认密码:</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="请再次输入密码" onblur="confirmPassword()">
                    <span class="default" id="errpsw2"></span>
                </div>
                <div>
                    <label for="telephone">请输入手机号码:</label>
                    <input type="tel" name="telephone" id="telephone" placeholder="手机号码" onblur="checktel()">
                    <span class="default" id="errtel"></span>
                </div>
                <div>
                    <label for="email">请输入电子邮箱：</label>
                    <input type="email" name="email" id="email" placeholder="电子邮箱" onblur="checkemail()">
                    <span class="default" id="erremail"></span>
                </div>
                <div>
                    <label for="address">请输入地址：</label>
                    <input type="text" name="address" id="address" placeholder="联系地址" onblur="checkaddr()">
                    <span class="default" id="erraddr"></span>
                </div>
                <input type="submit" class="pop_submit" value="注册" ></input>
            </form>
        </div>
    </div>
</div>

