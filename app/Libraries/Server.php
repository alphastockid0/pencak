<?php

namespace App\Libraries;

use Workerman\Worker;

class Server
{
    private $worker;
    private $connections = [];

    public function __construct()
    {
        $this->worker = new Worker();
        $this->worker->onConnect = [$this, 'handleConnect'];
        $this->worker->onMessage = [$this, 'handleMessage'];
    }

    public function run()
    {
        Worker::runAll();
    }

    public function handleConnect($connection)
    {
        $this->connections[$connection->id] = $connection;
        echo "New connection: " . $connection->id . "\n";
    }

    
    public function handleMessage($connection, $message)
    {
        $data = json_decode($message, true);

        // Lakukan identifikasi pengguna berdasarkan ID dan posisi gelanggang
        $userId = $data['userId'];
        $userPosition = $data['userPosition'];

        // Lakukan logika pengiriman pesan ke pengguna tertentu
        // Misalnya, jika posisi pengguna adalah Gelanggang A, kirim pesan ke pengguna di Gelanggang A
        foreach ($this->connections as $connId => $conn) {
            if ($connId !== $connection->id && $conn->userPosition === $userPosition) {
                $conn->send($data['message']);
            }
        }
    }
}
