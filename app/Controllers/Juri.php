<?php

namespace App\Controllers;

use App\Models\InputNilai;
use App\Models\JadwalTanding;
use App\ThirdParty\SocketServer;

class Juri extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        if (!session()->user_logged) {
            session_destroy();
            return redirect()->to(base_url());
        }
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case 'GET':
                $data['title'] = 'Juri';
                $data['juri'] = array(
                    'nama' => Session('namaLengkap'),
                    'uid' => Session('uid'),
                    'auth_key' => Session('auth_key'),
                    'title_name' => Session('title_name'),
                );
                return view('juri/index', $data);
                break;
            case 'POST':
                if (isset($_POST['gelanggang'])) {
                    // session()->set($dt);
                    $data['data'] = null;
                    $data['title'] = 'Penilaian Juri';
                    $q = $this->db->table('jadwal_tanding')
                        ->where('aktif', 1)
                        ->limit(1)
                        ->get()
                        ->getRow();
                    if ($q) {
                        $data['data'] = $q;
                    }
                    $data['juri'] = array(
                        'nama' => Session('namaLengkap'),
                        'uid' => Session('uid'),
                        'auth_key' => Session('auth_key'),
                        'title_name' => Session('title_name'),
                        'gelanggang' => $this->request->getPost('gelanggang'),
                        'juri_number' => $this->request->getPost('juri_number'),
                    );
                    session()->set($data['juri']);
                    $logsuser = array(
                        'uid' => session()->uid,
                        'username' => session()->username,
                        'nama' => session()->namaLengkap,
                        'aktivitas' => session()->namaLengkap . ' Masuk sebagai Juri' . $this->request->getPost('juri_number'),
                        'gelanggang' => session()->gelanggang,
                    );
                    $db = db_connect();
                    $db->table('log_users')->insert($logsuser);
                    return view('juri/juri_tanding', $data);
                } else {
                    session_destroy();
                    return redirect()->to(base_url('login'));
                }
                break;
        }
    }
    private function daemon($g, $file_config)
    { // Aktifkan output buffering agar data bisa terus diproses tanpa henti
        ob_implicit_flush(true);
        ob_end_flush();

        // Matikan waktu timeout untuk script agar tidak berhenti secara otomatis
        set_time_limit(0);

        // Batasi akses hanya dari server sendiri
        if ($_SERVER['REMOTE_ADDR'] !== $_SERVER['SERVER_ADDR']) {
            die('Forbidden');
        }
        $nilaiModel = new InputNilai();
        $jadwalModel = new JadwalTanding();
        while (true) {
            try {
                $jm = $jadwalModel->aktifPartai($g);
                $b = $jm['active_babak'];
                $dt = $nilaiModel->validation($g, $b);
                $config = json_decode(file_get_contents($file_config), true);
                if ($config['start'] === true) {
                    foreach ($dt as $ket => $value) {
                        foreach ($value as $sudut => $val) {
                            foreach ($val as $k => $v) {
                                if ((time() - $v['time']) >= $config['interval']) {
                                    $c = count(json_decode($v['user'], true));
                                    $max_id = $nilaiModel->max_validId();
                                    $d['status'] = $c >= $config['juri_min'] ? 'valid' : 'invalid';
                                    $d['valid_id'] = $c >= $config['juri_min'] ? $max_id + 1 : 0;

                                    $nilaiModel->updateData($v['id'], $d);
                                    if ($c >= $config['juri_min']) {
                                        $jadwalModel->updateNilai($g, $v['sudut'], $v['value']);
                                    }
                                    $message ='halo';
                                    $socket = new SocketServer();
                                    $socket->broadcastToAll($message);

                                }
                            }
                        }
                    }
                } else {
                    break;
                }
                sleep(1);
                //code...
            } catch (\Exception $e) {
                $this->daemon($g, $file_config);
            }
        }
    }
    public function start()
    {
        $file_config = APPPATH . 'Views/config.json';
        $config = json_decode(file_get_contents($file_config), true);
        $g = $_GET['gelanggang'];
        $config['start'] = filter_var($_GET['start'], FILTER_VALIDATE_BOOLEAN);
        $jsonConfig = json_encode($config, JSON_PRETTY_PRINT);
        file_put_contents($file_config, $jsonConfig);

        $this->daemon($g, $file_config);
    }
    public function reload()
    {
        if (!session()->user_logged) {
            session_destroy();
            return redirect()->to(base_url('login'));
        }
        $data['data'] = null;

        $data['juri'] = array(
            'nama' => Session('namaLengkap'),
            'uid' => Session('uid'),
            'auth_key' => Session('auth_key'),
            'title_name' => Session('title_name'),
        );
        while (true) {
            $q = $this->db->table('jadwal_tanding')
                ->where('aktif', 1)
                ->limit(1)
                ->get()
                ->getRow();

            if ($q) {
                $data['data'] = $q;
                return view('juri_tanding',);
                break;
            }
        }
    }
    public function input()
    {
        if (!session()->user_logged) {
            session_destroy();
            return redirect()->to(base_url('login'));
        }
        $file = APPPATH . 'Views/data.json';
        $time = time();
        $id_partai = $_POST['id_partai'];
        $partai = $_POST['partai'];
        $gelanggang = $_POST['gelanggang'];
        $babak = $_POST['babak'];
        $user = $_POST['user'];
        $sudut = $_POST['sudut'];
        $ket = $_POST['ket'];
        $d_tanding = array(
            'partai' => $_POST['partai'],
            'gelanggang' => $_POST['gelanggang'],
            'babak' => $_POST['babak'],
            'sudut' => $_POST['sudut'],
        );
        $query = $this->db->table('new_nilai_tanding')
            ->selectMax('valid_id')
            ->where('partai', $partai)
            ->where('gelanggang', $gelanggang)
            ->get();
        $max_id = $query->getRow()->valid_id;
        switch ($ket) {
            case 'kick':
                $value = 2;
                $found = false;
                $file_config = APPPATH . 'Views/config.json';
                $config = json_decode(file_get_contents($file_config), true);
                $new = [
                    'user' => json_encode([$_POST['user']]),
                    'value' => $value,
                    'time' => time(),

                    'ket' => $_POST['ket'],
                    'partai' => $_POST['partai'],
                    'gelanggang' => $_POST['gelanggang'],
                    'babak' => $_POST['babak'],
                    'sudut' => $_POST['sudut'],
                ];
                $nilaiModel = new InputNilai();
                $dt = $nilaiModel->validation($_POST['gelanggang'], $_POST['babak']);
                if ($config['start'] === true) {
                    if (empty($dt)) {
                        $nilaiModel->create($new);
                    } else {
                        // echo json_encode($dt,true);
                        if (isset($dt[$ket][$_POST['sudut']])) {
                            foreach ($dt[$ket][$_POST['sudut']] as $key => $value) {
                                if (in_array($_POST['user'], json_decode($value['user'], true))) {
                                    $found = true;
                                    continue;
                                } elseif ((time() - $value['time']) > $config['interval']) {
                                    $nilaiModel->create($new);
                                    break;
                                } else {
                                    $found = false;

                                    $updatedUser = json_decode($value['user'], true);
                                    $updatedUser[] = $_POST['user'];

                                    $newValue = [
                                        'user' => json_encode($updatedUser)
                                    ];

                                    $nilaiModel->updateData($value['id'], $newValue);
                                    break;
                                }
                            }

                            if ($found) {
                                $nilaiModel->create($new);
                            }
                        } else {
                            $nilaiModel->create($new);
                        }
                    }
                }

                break;
            case 'punch':
                $value = 1;
                $found = false;
                $file_config = APPPATH . 'Views/config.json';
                $config = json_decode(file_get_contents($file_config), true);
                $new = [
                    'user' => json_encode([$_POST['user']]),
                    'value' => $value,
                    'time' => time(),

                    'ket' => $_POST['ket'],
                    'partai' => $_POST['partai'],
                    'gelanggang' => $_POST['gelanggang'],
                    'babak' => $_POST['babak'],
                    'sudut' => $_POST['sudut'],
                ];
                $nilaiModel = new InputNilai();
                $dt = $nilaiModel->validation($_POST['gelanggang'], $_POST['babak']);
                if ($config['start'] === true) {
                    if (empty($dt)) {
                        $nilaiModel->create($new);
                    } else {
                        // echo json_encode($dt,true);
                        if (isset($dt[$ket][$_POST['sudut']])) {
                            foreach ($dt[$ket][$_POST['sudut']] as $key => $value) {
                                if (in_array($_POST['user'], json_decode($value['user'], true))) {
                                    $found = true;
                                    continue;
                                } elseif ((time() - $value['time']) > $config['interval']) {
                                    $nilaiModel->create($new);
                                    break;
                                } else {
                                    $found = false;

                                    $updatedUser = json_decode($value['user'], true);
                                    $updatedUser[] = $_POST['user'];

                                    $newValue = [
                                        'user' => json_encode($updatedUser)
                                    ];

                                    $nilaiModel->updateData($value['id'], $newValue);
                                    break;
                                }
                            }

                            if ($found) {
                                $nilaiModel->create($new);
                            }
                        } else {
                            $nilaiModel->create($new);
                        }
                    }
                }

                break;
            case 'dropingPlus':
                $value = 3;
                $query = $this->db->table('new_nilai_tanding')
                    ->selectMax('valid_id')
                    ->where('partai', $partai)
                    ->where('gelanggang', $gelanggang)
                    ->get();
                $max_id = $query->getRow()->valid_id;
                $data = array(
                    'partai' => $_POST['partai'],
                    'gelanggang' => $_POST['gelanggang'],
                    'babak' => $_POST['babak'],
                    'sudut' => $_POST['sudut'],
                    'user' => $_POST['user'],
                    'value' => $value,
                    'ket' => 'droping',
                    'status' => 'valid',
                    'valid_id' => $max_id + 1,
                    'time' => time(),
                );
                $exec = $this->db->table('new_nilai_tanding')->insert($data);
                if ($exec) {
                    $sql = "UPDATE jadwal_tanding SET nilai_" . $sudut . " = nilai_" . $sudut . "+" . $value . " WHERE id_partai='" . $id_partai . "' ";
                    $this->db->query($sql);

                    echo json_encode(array("status" => "success"));
                } else {
                    echo json_encode(array("status" => "Failed"));
                }
                break;
            case 'dropingMinus':
                $query = $this->db->table('new_nilai_tanding')
                    ->where('gelanggang', $gelanggang)
                    ->where('partai', $partai)
                    ->where('babak', $babak)
                    ->where('ket', 'droping')
                    ->orderBy('id', 'DESC')
                    ->get();

                if ($query->getNumRows() > 0) {
                    $data = $query->getRow();

                    // Menghapus data
                    $this->db->table('new_nilai_tanding')
                        ->where('id', $data->id)
                        ->delete();

                    $sql = "UPDATE jadwal_tanding SET nilai_" . $sudut . " = nilai_" . $sudut . "-" . $data->value . " WHERE id_partai='" . $id_partai . "' ";
                    $this->db->query($sql);

                    echo json_encode(array("status" => "success", "msg" => "Nilai Berhasil dihapus"));
                } else {
                    echo json_encode(array("status" => "failed", "msg" => "Data Tidak Tersedia"));
                }

                break;
            case 'b1':
                $value = 0;
                echo reverse($ket);
                break;
            case 'b2':
                $value = 0;
                echo reverse($ket);
                break;
            case 't1':
                $value = -1;
                echo reverse($ket);
                break;
            case 't2':
                $value = -2;
                echo reverse($ket);
                break;
            case 'p1':
                $value = -5;
                echo reverse_p($ket);
                break;
            case 'p2':
                $value = -10;
                echo reverse_p($ket);
                break;
            case 'p3':
                $value = -100;
                echo reverse_p($ket);
                break;
        }
    }
}
