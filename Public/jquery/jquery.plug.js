//顶部弹框
$.extend({
	topNotice:function(options){ //topNotice 表示插件的名字
		options = $.extend({
			str:'',
			color:'red', //通知字体的颜色
		},options);
		if(options.str){ //存在消息则调用
			$("body").append("<div class='notice'>通知："+options.str+"&nbsp;&nbsp;<span>X</span></div>");
			var obj = $(".notice");
			obj.css({
				"width":"100%",
				"height":"20px",
				"position":"fixed",
				"top":"2px",
				"background":"#E5E5E5",
				"text-align":"center",
				"font-size":"12px",
				"line-height":"20px",
				"color":options.color,
			});
			$(".notice span").css({
				"cursor":"pointer",
				"font-weight":500,
			});
			$(".notice span").click(function(){
				$(".notice").fadeOut(700);
			});
		}
	}
});
//全局弹框 需要jquery.cookie支持
$.extend({
	fullPopBox:function(options){
		options = $.extend({
			imgSrc:'',
			href:'',
			showtime:3,
		},options);
		if(options.imgSrc){
			var img = new Image();
			img.src = options.imgSrc;
			img.onload=function(){
				var iheight = img.height; 
				var iwidth = img.width;
				iwidth = iwidth>500?500:iwidth;
				iheight = iheight>350?350:iheight;
				$("body").append("<div class='fullBack'></div><div class='fullPopBox'><a href='"+options.href+"'><img src='"+options.imgSrc+"' width='"+iwidth+"' /></a><span>关闭 X</span></div>");
				width = $(window).width();
				height = $(window).height();
				$(".fullBack").css({
					// "position":"absolute",
					// //"z-index":999,
					// "left":0,
					// "top":0,
					// "width":"100%",
					// "height":"100%",
					// "background":"rgba(255,250,240,0.5)",
					"position": "fixed",
		            "top":0,
		            'left': 0,
		            'width': '100%',
		            'height': '100%',
		            'background': '#ccc',
		            'filter':'alpha(opacity=70)',
		            '-moz-opacity':'0.7',
		            '-khtml-opacity': '0.7',
		            'opacity': '0.7',
		            'z-index': '999'
				});
				$(".fullPopBox").css({
					"position":"fixed",
					"top":(height-iheight)/2+"px",
					"left":(width-iwidth)/2+"px",
					"z-index":'1001',
					"width":iwidth+"px",
					"height":iheight+"px",
				});
				$(".fullPopBox span").css({
					"position":"absolute",
					"top":"2px",
					"right":"5px",
					"z-index":'1001',
					"font-size":"12px",
					"cursor":"pointer",
				});
				$(".fullPopBox span").click(function(){
					$(".fullBack").fadeOut(800);
					$(".fullPopBox").fadeOut(800);
				});
			};
			var showtime = parseInt(options.showtime);
			setTimeout(function(){
				$(".fullBack").fadeOut(800);
				$('.fullPopBox').fadeOut(800);
			},showtime*1000); //默认3秒关闭
		}
	}
});
/**
 * 全屏提示消息 代替alert
 *@param str 提示的消息 若消息未空不显示
 *@param time 显示时间
 *@param color 文字颜色
 *
 */

//调用方法
// 	$.tipNotice({
// 		str:"提示消息",
// 		time:3,
// 		color:"red",
// 	});
$.extend({
	tipNotice:function(options){
		options = $.extend({
			str:'',
			time:3,
			color:"black",
		},options);
		if(options.str){ //消息存在则显示
			$("body").append("<span class='mytips'>"+options.str+"</span>");
			var tip = $(".mytips");
			tip.css({
				"display":"inline-block",
				"min-width":"120px",
				"text-align":"center",
				"height":"35px",
				"line-height":"35px",
				"background":"rgba(204,204,204,0.8)",
				"padding":"0 8px",
				"border-radius":"5px",
				"position":"fixed",
				"color":options.color,
			});
			var w_width = $(window).width();
			var w_height = $(window).height();
			var t_width = tip.outerWidth();
			var t_height = tip.outerHeight();
			tip.css({
				"left":(w_width-t_width)/2+"px",
				"top":(w_height-t_height)/2+"px",
			});
			setTimeout(function(){
				tip.fadeOut(1000);
			},options.time*1000);
		}
	}
});
/**
 * 全屏加载 等待
 * @param  
 * @param  
 */
//调用方法
// $.FullShade({
// 	str:"加载提示语",
// });

$.extend({
	FullShade:function(options){
		options = $.extend({
			str:'',
			time:5,
			color:"#00CC99",
		},options);
		$("body").prepend("<div class='shade'><span class='tip'>"+options.str+"</span></div>");
		var shade = $(".shade");
		var b_height = $(document.body).outerHeight(true);
		shade.css({
			"position":"absolute",
			"z-index":10000,
			"left":0,
			"top":0,
			"width":"100%",
			"height":b_height+"px",
			"background":options.color,
		});
		var tip = $(".tip");
		tip.css({
			"display":"in-block",
			"font-size":"18px",
			"width":"220px",
			"text-align":"center",
		});
		var width = $(window).width();
		var height = $(window).height();
		var t_width = tip.outerWidth();
		var t_height = tip.outerHeight();
		tip.css({
			"position":"fixed",
			"left":(width-220)/2+"px",
			"top":height*0.3+"px",
		});
		function abc(){
			tip.animate({fontSize:"40px",},1000,function(){
				tip.animate({fontSize:"18px"},1000,function(){
					abc();
				});
			});
		}
		abc();
		// setTimeout(function(){
		// 	shade.fadeOut(1200);
		// 	tip.fadeOut(1200);
		// },(options.time)*1000);
		// $(window).load(function(){//页面加载完成的方法
		// 	shade.fadeOut(1200);
		// 	tip.fadeOut(1200);
		// });
		$(document).ready(function(){
			shade.fadeOut(1200);
			tip.fadeOut(1200);
		});
	}
});