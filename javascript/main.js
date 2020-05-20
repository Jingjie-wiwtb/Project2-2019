
//弹窗控制

//登陆弹窗
var login_btn = document.getElementById('login_btn');
var login_div = document.getElementById('login_pop_back');
var login_close = document.getElementById('login_close-btn');

login_btn.onclick = function show() {
    console.log("clicked!");
    login_div.style.display = "block";
};

$('#login_close-btn').click(function(){
    login_div.style.display = "none";
});


//注册弹框
var register_btn = document.getElementById('register_btn');
var register_div = document.getElementById('register_pop_back');
var register_close = document.getElementById('register_close-btn');


register_btn.onclick = function show() {
    register_div.style.display = "block";
};

$('#register_close-btn').click(function(){

    register_div.style.display = "none";
});

/*
//获取搜索结果排序方式
$("#order_key").change(function(){
    var	order_key = $('input[name=order_key]:checked').val();
    console.log("order_key"+order_key);

});

//获取关键词查询字段
$("#search_key").change(function(){
    var	search_key = $('input[name=search_key]:checked').val();
    console.log("search_key"+search_key);

});
*/
//搜索关键词传递

$(".search_btn").click(function(){

    var keyword = document.getElementById("keyword").value;

    window.location.href = "search.php?keyword="+keyword;

});


//登出变化

$('#logout_btn').click(function(){

    var r=confirm("确认登出？");

    //若确认登出
    if(r==true){
        $.ajax({
            type:"GET",
            async:false,   //同步   默认是true（异步）
            url:"../php/logout.php",
            data:{

            },
            dataType:"TEXT",
            success:function(){
                alert('您已登出！');
                logout();

            }
        });
    }
});

/*
//登陆提交
$('.login_submit').click(function () {

    username = $("input[name=username]");
    password = $('input[name = userpassword]');
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
            if(data){
                alert('登陆成功！');
                document.getElementById('logout_change').style.display = "block";
                document.getElementById('login_change').style.display = "none";
                $('logout_change').append('<li><a href="personal_info.php">'+username+'</a>');
            }
            if(data=='error0'){
                alert('用户不存在！请先注册');
            }
            if(data=='error1'){
                alert('密码错误！');
            }
        }

    });

});
*/


$(document).on('click','.result_link',function() {
    let artworkID = $(this).data('artworkid');
    location.href="goods_details.php?artworkID="+artworkID;

});


/*
//商品链接点击事件
$('.result_link').click(function() {
    let artworkID = $(this).data('artworkid');
    location.href="goods_details.php?artworkID="+artworkID;

});

*/


//   on()写法
$(document).on('click', '.addcart', function() {
    //function code here.

    var artworkID = $(this).data('artworkid');
    console.log("artworkID:" + artworkID);

    //把artworkID传到addcart.php
    $.ajax({
        type: "GET",
        async: false,   //同步   默认是true（异步）
        url: "../php/addcart.php",
        data: {
            artworkID: artworkID
        },
        dataType: "TEXT",
        success: function (data) {
            console.log(data);
            if (data=="success") {
                console.log("success")
                alert("添加成功！");
            }
            if(data=="notlogin"){
                alert("请先登录！");
            }
            if(data=="added") {
                alert("您已添加该商品！");
            }

            if(data=="bought"){
                alert("已经被人买走啦！");
            }

                }
            });

	});






 //登陆表单验证

function checklogin_name() {
    var login_name=document.getElementById('login_name');
    var errLname = document.getElementById('errLname');
    if(login_name.value.length==0) {
        errLname.innerHTML="用户名不得为空！";
        errLname.className="error";
        return false;
    }

    else if(login_name.value== "wrong") {
        errLname.innerHTML="用户名不存在！";
        errLname.className="error";
        return false;
    }
    else {
        errLname.innerHTML="✔";
        errLname.className="success";
        return true;
    }
}

function checklogin_psw(){
    var login_psw=document.getElementById('login_password');
    var errLpsw=document.getElementById('errLpsw');
    if(login_psw.value.length==0){
        errLpsw.innerHTML="密码不得为空！";
        errLpsw.className="error";
        return false;
    }
    else if(login_psw.value== "wrong"){
        errLpsw.innerHTML="密码错误！";
        errLpsw.className="error";
        return false;
    }
    else {
        errLpsw.innerHTML="✔";
        errLpsw.className="success";
        return true;
    }
}


//登陆提交验证

function login_validate() {
	var login_namecheck = checklogin_name();
    var login_pswcheck = checklogin_psw();
	var validate_code = validate();
	return ((login_namecheck) && (login_pswcheck)&&(validate_code));
}
	
	

//登陆变化




//登出变化

function logout() {


	/*
	<?php 
	   session_unset();
	   session_destroy();
	?>
	*/
    document.getElementById('logout_change').style.display="none";
    document.getElementById('login_change').style.display="block";
}
//删除购物车事件





//【验证码】

function createCode(){
    var code="";
    var codeLength=4;
    var print_vcode=document.getElementById("print_vcode");
    print_vcode.value="";
    var selectChar="1234567890";
    for(var i=0;i<codeLength;i++) {
        var charIndex = Math.floor(Math.random() * 10) ;  //math.random返回的是浮点数，math.floor返回小于~的最大整数
        code+=selectChar[charIndex]
    }
    print_vcode.value=code;
}

function validate() {
    var input_vcode = document.getElementById("input_vcode");
    var errVerifycode = document.getElementById('errVerifycode');
    var print_vcode = document.getElementById('print_vcode');
    if (input_vcode.value != print_vcode.value) {
        errVerifycode.className = "error";
        errVerifycode.innerHTML = "验证码错误！";
        return false;
    } else {
        errVerifycode.innerHTML = "✔";
        errVerifycode.className = "success";
        return true;
    }
}

window.onload = function (){
    createCode();
}



//注册表单验证

var username = document.getElementById('username');
var errname=document.getElementById('errname');
	


function checkUsername(){

    var pattern = /^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/;
    if(username.value.length== 0){
        errname.innerHTML="用户名不能为空";
        errname.className="error";
        return false;
    }
    else if(!pattern.test(username.value)){
        errname.innerHTML="不低于6位，且不能为纯数字或纯密码！  如：a1b2c33";
        errname.className="error";
        return false;
    }
    else {
        errname.innerHTML="✔";
        errname.className="success";
        return true;
    }
}

function checkemail() {
	
	var email = document.getElementById('email');
	var erremail = document.getElementById('erremail');
	
	var pattern = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	if(email.value.length == 0 ){
		erremail.innerHTML = "不得为空！";
		erremail.className="error";
		return false;
	}
	else if(!pattern.test(email.value)){
		erremail.innerHTML = "邮箱格式不正确！";
		erremail.className = "error";
		return false;
	}
	else {
		erremail.innerHTML = "✔";
		erremail.className = "success";
		return true;
	}
}
	
function checkaddr() {
	var address = document.getElementById('address');
	var erraddr = document.getElementById('erraddr');
    if(address.value.length== 0){
        erraddr.innerHTML="地址不能为空";
        erraddr.className="error";
        return false;
    }
	else {
		erraddr.innerHTML = "✔";
		erraddr.className = "success";
		return true;
	}
}



function checkPassword(){
	var userpassword = document.getElementById('userpassword');
    var errpsw = document.getElementById('errpsw');
    if(userpassword.value.length<6){
        errpsw.innerHTML="密码不得少于6位！如：a1b2c3";
        errpsw.className="error";
        return false;
    }
    if(userpassword.value==username.value){
        errpsw.innerHTML="密码不得与用户名相同！";
        errpsw.className="error";
        return false;
    }
    else {
        errpsw.innerHTML="✔";
        errpsw.className="success";
        return true;
    }
}

function confirmPassword(){
    var confirm_password=document.getElementById('confirm_password');
    var errpsw2 = document.getElementById('errpsw2');
    if(confirm_password.value!=userpassword.value) {
        errpsw2.innerHTML="上下密码不一致！";
        errpsw2.className="error";
        return false;
    }
    else {
        errpsw2.innerHTML="✔";
        errpsw2.className="success";
        return true;
    }
}

function checktel() {
    var telephone=document.getElementById('telephone');
    var errtel = document.getElementById('errtel');
    var pattern = /^\d{11}$/;
    if(!pattern.test(telephone.value)) {
        errtel.innerHTML="手机号码不合规范  实例：13310109292";
        errtel.className="error";
        return false;
    }
    else {
        errtel.innerHTML="✔";
        errtel.className="success";
        return true;
    }
}


//注册提交验证

function register_validate() {
	var regstname_ck = checkUsername();
	var regstpsw_ck = checkPassword();
	var regsttel_ck = checktel();
	return ((regstname_ck)&&(regstpsw_ck)&&(regsttel_ck)) ;

}

