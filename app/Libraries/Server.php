<?php

namespace App\Libraries;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Server implements MessageComponentInterface
{
    protected $clients;
    protected $connectedUsers;
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->connectedUsers = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $uid = session('uid');
        if (!$uid) {
            $conn->close(); // Menutup koneksi jika uid tidak tersedia dalam session
            return;
        }

        $type = session('type');
        $gelanggang = session('gelanggang');
        $juriNumber = session('juri_number');

        $this->connectedUsers[$uid] = [
            'type' => $type ?? '',
            'gelanggang' => $gelanggang ?? '',
            'juri_number' => $juriNumber ?? '',
        ];

        // ...
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Mengidentifikasi pengguna pengirim
        $senderUid = $this->getUidByConnection($from);

        // Menangani pesan yang diterima
        // ...

        // Contoh pengiriman pesan balasan ke pengguna lain
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $uid = $this->getUidByConnection($conn);

        // Menghapus data pengguna yang terputus
        unset($this->connectedUsers[$uid]);

        // ...
    }

    private function getUidByConnection(ConnectionInterface $conn)
    {
        foreach ($this->connectedUsers as $uid => $userData) {
            if ($userData['connection'] === $conn) {
                return $uid;
            }
        }

        return null;
    }


    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
    public function getConnectedUsers()
    {
        return $this->connectedUsers;
    }
}
