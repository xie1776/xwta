$().ready(function(){
	$.topNotice({
		str:'http://m.laijiemi.cn/也可以访问本站',
	});
});

$('.loading_top').animate({'width':'100%'},2000);
window.setTimeout("hide_loading()",2000);
function hide_loading(){
	$(".loading_top").css("display","none")
}
/* //关闭
$().ready(function(){
	var JsonDateValue = new Date();
	var curDate = JsonDateValue.getYear()+"-"+JsonDateValue.getMonth()+"-"+JsonDateValue.getDay();
	var name = 'laijiemi';
	if((cDate = $.cookie(name)) && (cDate>=curDate) ){
	}else{
		$.cookie(name,curDate,{ expires: 1});
		$.fullPopBox({
			imgSrc:'http://laijiemi.cn/Public/images/ad3.png',
			href:'http://www.laijiemi.cn',
			showtime:5,
		});
	}
});
*/
function back_top()
{
	$(window).scrollTop = 0;
}