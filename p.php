<?php
 

 $server = new Swoole\Websocket\Server("0.0.0.0", 9501);

 $server->on('open', function($server, $req) {
     echo "connection open: {$req->fd}\n";
 });
 $server->on("request", function ($request, $response) {
     var_dump("http 请求");
    $response->header("Content-Type", "text/plain");
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