<?php

// $file_data = APPPATH . 'Views/data.json';
// $file_config = APPPATH . 'Views/config.json';
// $db = \Config\Database::connect();
// $data = json_decode(file_get_contents($file_data), true);
// while (true) {
//     $config = json_decode(file_get_contents($file_config), true);
//     foreach ($data as $ket => $value) {
//         foreach ($value as $sudut => $val) {
//             foreach ($val as $k => $v) {
//                 if ((time() - $v['time']) >= $config['interval']) {
//                     $c = count($v['user']);
//                     $query = $db->table('new_nilai_tanding')
//                         ->selectMax('valid_id')
//                         ->where('partai', $v['partai'])
//                         ->where('gelanggang', $v['gelanggang'])
//                         ->get();
//                     $max_id = $query->getRow()->valid_id;
//                     $data[$ket][$sudut][$k]['status'] = $c >= $config['juri_min'] ? 'valid' : 'invalid';
//                     $data[$ket][$sudut][$k]['valid_id'] = $c >= $config['juri_min'] ? $max_id + 1 : 0;
//                     $data[$ket][$sudut][$k]['user'] = json_encode($v['user']);
//                     if ($config['start'] != false) {
//                         $db->table('new_nilai_tanding')->insert($data[$ket][$sudut][$k]);
//                     }
//                     unset($data[$ket][$sudut][$k]);
//                 }
//             }
//         }
//     }
//     $jsonData = json_encode($data, JSON_PRETTY_PRINT);
//     file_put_contents($file_data, $jsonData);
//     sleep($config['interval']);
// }
