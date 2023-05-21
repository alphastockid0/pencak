<?php

namespace App\Controllers;

use CodeIgniter\Session\Session;
use App\Libraries\Server;

class Home extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {

        return view('login/login.php');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $this->request->getPost('username');
            $pass = $this->request->getPost('password');

            $user = $this->db->table('users')
                ->where('username', $username)
                ->where('password', $pass)
                ->limit(1)
                ->get()
                ->getRow();

            if ($user) {
                $data = array(
                    'username' => $user->username,
                    'uid' => $user->uid,
                    'namaLengkap' => $user->namaLengkap,
                    'email' => $user->email,
                    'auth_key' => $user->auth_key,
                    'title_name' => $user->title_name,
                    'type' => $user->type,
                    'user_logged' => TRUE,
                );
                // Set session
                $session = session();
                $session->set($data);
                if (Session('type') == 'juri') {
                    $this->_updateLastLogin(session()->uid);
                    return redirect()->to(base_url('juri'));
                } elseif (Session('type') == 'author') {
                    $this->_updateLastLogin(session()->uid);
                    return view('admin/dashboard',$data);
                }
            } else {
                // Jika user tidak ditemukan, tampilkan pesan error
                return redirect()->to(base_url());
            }
        }
    }
    private function _updateLastLogin($uid)
    {
        $db = db_connect();
        $sql = "UPDATE `users` SET `last_login` = now() WHERE `users`.`uid` = {$uid}";
        $db->query($sql);

        $logsuser = array(
            'uid' => $uid,
            'username' => session()->username,
            'nama' => session()->namaLengkap,
            'aktivitas' => session()->namaLengkap . ' Masuk Aplikasi sebagai ' . session()->type,
            'gelanggang' => session()->gelanggang,
        );
        $db->table('log_users')->insert($logsuser);
    }
    public function logout()
    {
        $db = db_connect();
        $logsuser = array(
            'uid' => session()->uid,
            'username' => session()->username,
            'nama' => session()->namaLengkap,
            'aktivitas' => session()->namaLengkap . ' Keluar dari Aplikasi',
            'gelanggang' => session()->gelanggang,
        );
        $db->table('log_users')->insert($logsuser);
        session_destroy();
        return redirect()->to(base_url());
    }
    public function dashboard()
    {
        return view('admin/dashboard.php');
    }
}
