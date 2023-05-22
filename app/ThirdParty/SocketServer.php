<?php

namespace App\ThirdParty;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $connection)
    {
        $this->clients->attach($connection);
        echo "User connected: " . $connection->resourceId . "\n";
    }

    public function onMessage(ConnectionInterface $from, $message)
    {
        // Logika penanganan pesan yang diterima
    }

    public function onClose(ConnectionInterface $connection)
    {
        $this->clients->detach($connection);
        echo "User disconnected: " . $connection->resourceId . "\n";
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        echo "An error occurred: " . $e->getMessage() . "\n";
        $connection->close();
    }

    public function broadcastToAll($message)
    {
        foreach ($this->clients as $client) {
            $client->send($message);
        }
    }
    public function broadcastToUsers($users, $message)
    {
        foreach ($this->clients as $client) {
            $userId = $client->resourceId;
            if (in_array($userId, $users)) {
                $client->send($message);
            }
        }
    }
}
