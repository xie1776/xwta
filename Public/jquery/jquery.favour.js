(function($) {
$.extend({
    tipsBox: function(options) {
        options = $.extend({
            obj: null,  //jq对象，要在那个html标签上显示
            str: "+1",  //字符串，要显示的内容;也可以传一段html，如: "<b style='font-family:Microsoft YaHei;'>+1</b>"
            startSize: "12px",  //动画开始的文字大小
            endSize: "30px",    //动画结束的文字大小
            interval: 600,  //动画时间间隔
            color: "red",    //文字颜色
            callback: function() {}    //回调函数
        }, options);
        $("body").append("<span class='num'>"+ options.str +"</span>");
        var box = $(".num");
        var left = options.obj.offset().left + options.obj.width() / 2;
        var top = options.obj.offset().top - options.obj.height();
        box.css({
            "position": "absolute",
            "left": left + "px",
            "top": top + "px",
            "z-index": 9999,
            "font-size": options.startSize,
            "line-height": options.endSize,
            "color": options.color
        });
        box.animate({
            "font-size": options.endSize,
            "opacity": "0",
            "top": top - parseInt(options.endSize) + "px"
        }, options.interval , function() {
            box.remove();
            options.callback();
        });
    }
});
})(jQuery);
(function($){
$.extend({
    tipsImg: function(options) {
       options = $.extend({
            obj: null,
            baseNum: 0,
            color:null,
            img_path:null,
        }, options);
       $("body").append("<div class=\"favour_png\"><img src='"+options.img_path+"' /><sup class=\"favour_amount\">"+options.baseNum+"</sup></div>");
        var height = options.obj.height();
        var width = options.obj.width();
        var numWidth = $(".favour_amount").width();
        var top = options.obj.offset().top;
        var left = options.obj.offset().left;
        $(".favour_png").css({
            "position":"absolute",
            "z-index":99,
            "top":top+height-22-10,
            "left":left+width-32-numWidth-10,
            "min-width":"35px",
            "width":"auto",
            "cursor":"pointer",
        });
        $(".favour_amount").css({
            "color":options.color,
        });
   }
});
})(jQuery)