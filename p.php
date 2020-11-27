<?php
 

 $server = new Swoole\Websocket\Server("0.0.0.0", 9501);

 $server->on('open', function($server, $req) {
     echo "connection open: {$req->fd}\n";
 });
 $server->on("request", function ($request, $response) use($server) {
     var_dump("http 请求");
    $response->header("Content-Type", "text/plain");
    go(function() use($response){
        \Co::sleep(2);
        var_dump("cbbbbbbbbbbbb");
        $server->send()
        $response->end("bbbbbxcxd\n");
    });  
    $response->write("66666666666666666");
    $response->end("Hello World\n".time());
});
 $server->on('message', function($server, $frame) {
     echo "received message: {$frame->data}\n";
     $server->push($frame->fd, json_encode(["hello", "world"]));
 });

 $server->on('close', function($server, $fd) {
     echo "connection close: {$fd}\n";
 });

 $server->start();