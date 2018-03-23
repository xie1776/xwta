<?php
    $config = include('config.php');
?>
<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes"/>
        <title>mychat</title>
    <style>
        *{margin:0;padding: 0;}
        .log{width: 90%; height: 400px;display:block;margin:20px auto;border-radius: 5px;resize:none;}
        .login,.msg,.my_users{margin:8px 5%;}
        .login .username{height: 20px;border-radius: 1px;}
        .msg textarea{width: 80%;height: 30px;border-radius: 3px;resize:none;}
        .msg span{display: block;float: right;margin-right: 20%;}
        .clear{clear: both;}
        .my_users{border: 1px dashed #ccc;border-radius: 2px;}
        .my_users span{display: block;background-color: #ccc;padding-left: 4px;}
        .my_users ul{width: 100%; height: auto;padding: 4px;}
        .my_users li{font-size: 12px;font-family: '楷体';list-style-type:none}
    </style>
    </head>
    <body>
        <textarea class="log" >
=======websocket======
        </textarea>

        <div class="login">
            <span class="myUser">UserName: </span><input type="text" class="username"><span class="cur_user"></span>
            <input type="button" value="连接" onClick="link(this)"> 
        </div>
        <div class="msg">
            Message: <textarea id="text" ></textarea>
            <span>
            发送给：<select class="toUser"></select>
            <input type="button" value="发送" onClick="send2()">
            </span>
        </div>
        <div class="clear"></div>
        <div class="my_users">
            <span>用户列表</span>
            <ul class="users">
                
            </ul>
        </div>
    </body>
</html>

<script type="text/javascript" src="Public/js/jquery-1.9.1.js"></script>
<script>
$(function(){
    //键盘响应事件
    $(document).keyup(function(event){
      if(event.keyCode ==13){
         send();
      }
    });
});
var socket;
function link(input){
    var obj = $(input);
    var st = obj.val();

    if(st=='连接'){
        var username = $(".username").val();
        if(username.length==0){
            alert('用户名不能为空');
            return ;
        }
        var url = "ws://<?php echo $config['server'];?>:<?php echo $config['port'];?>";
        socket = new WebSocket(url);
        socket.onopen = function(event){
            log('连接成功');
            obj.val('断开');       
            getUsers(username); //连接成功触发获取用户
        }
    }
    socket.onmessage = function(msg){
        //更新用户列表
        var myMsg = JSON.parse(msg.data);
        if(myMsg.status==6){
            $(".cur_user").html(myMsg.info);
        }
        else if(myMsg.status==5){ //更新用户列表 状态专用
            var users = myMsg.users;
            $(".users li").remove();
            $('.toUser').empty();
            var toUserObj = $('.toUser');
            toUserObj.append('<option value="">所有人</option>');

            //注意jquery数组循环 
            $.each(users,function(index,element){
                if(element){
                    $(".users").append('<li>'+element+'</li>');
                    toUserObj.append('<option value="'+element+'">'+element+'</option>');
                }
            });
            if(myMsg.info)
                log(myMsg.info);
        }
        else{
            log(myMsg.info);
        }
        console.log(myMsg);
    }
    socket.onclose = function(){
        log('断开连接');
        obj.val('连接');
        $(".cur_user").html('');
        if($('.username').length==0)
            $(".myUser").after('<input type="text" class="username">');
    }

    if(st=='断开'){ 
        //socket.send('me_quit'); //告知服务器退出
        socket.close();
        socket = null;
    }
}

function log(var1){
    $('.log').append(var1+"\r\n");
}

//发送消息方法
function send(){
    //$(".users").remove();
    var textObj = $('#text');
    socket.send(textObj.val());
    textObj.val(''); //发送之后清空
}
//发送json字符串
function send2(){
    var textObj = $('#text');
    var content = textObj.val();
    var toUser = $(".toUser").val();
    var json = JSON.stringify({'toUser':toUser,'msg':content});
    socket.send(json);
    textObj.val(''); //发送之后清空
}

//获取用户列表
function getUsers(username){
    socket.send('userList'+username);
    $(".username").remove();
    //$(".cur_user").html(username);
}
</script>
