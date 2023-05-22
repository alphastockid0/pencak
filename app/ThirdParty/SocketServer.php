<?php

namespace App\ThirdParty;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketServer implements MessageComponentInterface
{
    protected $clients;
    protected $users;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->users = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Tambahkan user ke daftar pengguna yang terhubung
        $this->clients->attach($conn);
        $this->users[$conn->resourceId] = $conn;
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Hapus user dari daftar pengguna yang terhubung
        $this->clients->detach($conn);
        unset($this->users[$conn->resourceId]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // Tangani kesalahan pada koneksi
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $message)
    {
        // Kirim pesan dari server ke semua pengguna di "Gelanggang A"
        $data = json_decode($message, true);
        $gelanggang = $data['gelanggang'];
        $message = $data['message'];

        if ($gelanggang === 'A') {
            foreach ($this->users as $user) {
                if ($user->session->get('gelanggang') === 'A') {
                    $user->send($message);
                }
            }
        }
    }
}
