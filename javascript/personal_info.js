
//充值弹窗控制

var recharge_div = document.getElementById('recharge_pop_back');

function recharge_show() {
    recharge_div.style.display = "block";
}

function close_recharge() {
    recharge_div.style.display = "none";
}



//充值验证
var balance=document.getElementById('balance');
var recharge_num=document.getElementById('recharge_num');


function recharge_check() {
    var errRecharge=document.getElementById('errRecharge');
    var pattern =/^\d*/;
    if (!pattern.test(recharge_num)) {
        errRecharge.innerHTML = "请输入正确的金额！";
        errRecharge.className = "error";
        return false;
    }
    else {
        errRecharge.innerHTML = "✔";
        errRecharge.className = "success";
        return true;
    }
}

$("#recharge").click(function (){
    var recharge_num = $("#recharge_num").val();
	console.log("recharge send:"+recharge_num);
	if(recharge_check()) {
		$.ajax({
			type: "GET",
			async: false,   //同步   默认是true（异步）
			url: "../php/recharge.php",
			data: {
				recharge_num: recharge_num
			},
			dataType: "TEXT",
			success: function (data) {
				console.log("chargereturn:" + data);
				$("#balance").html(data);
			}
		});
	}

     //  recharge_div.style.display="none";
	   
	});
	
	


