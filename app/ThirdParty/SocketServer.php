<?php

namespace App\ThirdParty;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Ketika koneksi baru dibuka, tambahkan ke koleksi klien
        $this->clients->attach($conn);
        echo "Koneksi baru: {$conn->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Kirim pesan dari klien ke semua klien yang terhubung
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Hapus koneksi yang tertutup dari koleksi klien
        $this->clients->detach($conn);
        echo "Koneksi tertutup: {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // Tangani kesalahan pada koneksi
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}
