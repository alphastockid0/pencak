<?php

namespace App\Libraries;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class JuriLib implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $connection)
    {
        // Mendapatkan informasi pengguna yang terhubung berdasarkan koneksi (misalnya melalui token atau ID pengguna)
        $userId = $this->getUserIdFromConnection($connection);

        // Mengatur status online pengguna di database menjadi true
        $this->setUserOnlineStatus($userId, true);
    }

    public function onMessage(ConnectionInterface $connection, $message)
    {
        // Dilakukan saat pesan diterima dari koneksi tertentu
    }

    public function onClose(ConnectionInterface $connection)
    {
        // Mendapatkan informasi pengguna yang terhubung berdasarkan koneksi (misalnya melalui token atau ID pengguna)
        $userId = $this->getUserIdFromConnection($connection);

        // Mengatur status online pengguna di database menjadi false
        $this->setUserOnlineStatus($userId, false);
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        // Dilakukan saat terjadi kesalahan pada koneksi
    }
}
