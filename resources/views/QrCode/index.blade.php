<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<button onclick="WebSocketTest()">WebSocket</button>
</body>
<script>
    function WebSocketTest()
    {
        if ("WebSocket" in window)
        {
            alert("您的浏览器支持 WebSocket!");

            // 打开一个 web socket
            var ws = new WebSocket("ws://47.94.251.251:8080");

            ws.onopen = function()
            {
                // Web Socket 已连接上，使用 send() 方法发送数据
                ws.send("发送数据");
                alert("数据发送中...");
            };

            ws.onmessage = function (evt)
            {
                var received_msg = evt.data;
                alert("数据已接收...");
            };

            ws.onclose = function()
            {
                // 关闭 websocket
                alert("连接已关闭...");
            };
        }

        else
        {
            // 浏览器不支持 WebSocket
            alert("您的浏览器不支持 WebSocket!");
        }
    }
</script>
</html>