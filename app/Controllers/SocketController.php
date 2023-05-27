<?php

namespace App\Controllers;

use App\ThirdParty\SocketServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\Server;

class SocketController extends BaseController
{
    public function start()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Server()
                )
            ),
            8080 // Ganti dengan port yang sesuai
        );

        $server->run();
    }

    public function index()
    {
        // Memulai server socket saat halaman diakses
        $this->start();
    }
}
