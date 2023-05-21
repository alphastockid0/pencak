<?php


use App\Libraries\InputJuri;

function collectData($clientData)
{
    $dataCollector = new InputJuri();
    $dataCollector->addData($clientData);
}

function reverse($ket)
{
    // $db = \Config\Database::connect();
    // // Cek data di database
    // $query = $db->table('new_nilai_tanding')
    //     ->where('gelanggang', $gelanggang)
    //     ->where('partai', $partai)
    //     ->where('babak', $babak)
    //     ->where('sudut', $sudut)
    //     ->where('ket', $ket)
    //     ->orderBy('id', 'DESC')
    //     ->get();

    // if ($query->getNumRows() > 0) {
    //     $data = $query->getRow();

    //     // Hapus data
    //     $db->table('new_nilai_tanding')
    //         ->where('id', $data->id)
    //         ->delete();

    //     // Update nilai di jadwal_tanding
    //     $db->table('jadwal_tanding')
    //         ->set('nilai_' . $sudut, 'nilai_' . $sudut . '-' . $value, false)
    //         ->where('id_partai', $id_partai)
    //         ->update();

    //     $response = json_encode(array("status" => "success", "msg" => "Data Berhasil Dihapus"));
    // } else {
    //     // Peroleh max_id
    //     $query = $db->table('new_nilai_tanding')
    //         ->selectMax('valid_id')
    //         ->where('partai', $partai)
    //         ->where('gelanggang', $gelanggang)
    //         ->get();

    //     $row = $query->getRow();
    //     $max_id = $row->valid_id;

    //     // Insert data baru ke new_nilai_tanding
    //     $data = [
    //         'partai' => $partai,
    //         'gelanggang' => $gelanggang,
    //         'babak' => $babak,
    //         'sudut' => $sudut,
    //         'user' => $user,
    //         'value' => $value,
    //         'ket' => $ket,
    //         'status' => 'valid',
    //         'valid_id' => $max_id + 1,
    //         'time' => $time
    //     ];
    //     $db->table('new_nilai_tanding')->insert($data);

    //     // Update nilai di jadwal_tanding
    //     $db->table('jadwal_tanding')
    //         ->set('nilai_' . $sudut, 'nilai_' . $sudut . '+' . $value, false)
    //         ->where('id_partai', $id_partai)
    //         ->update();

        $response = json_encode(array("status" => "success", "msg" => "Data Berhasil Ditambah"));
    // }
    return $response;
}

function reverse_p($ket)
{
    // global $gelanggang, $partai, $babak, $sudut, $conn, $user, $value, $time, $id_partai;
    // ### CEK DATABASE ###

    // $sql = "SELECT * FROM new_nilai_tanding WHERE gelanggang='$gelanggang' AND partai='$partai' AND sudut='$sudut' 
    // AND ket='$ket' ORDER BY id DESC";

    // $exec = $db->query($sql);

    // if (mysqli_num_rows($exec) > 0) {
    //     $data = mysqli_fetch_assoc($exec);

    //     $sql = "DELETE FROM new_nilai_tanding WHERE id='" . $data['id'] . "'";
    //     $db->query($sql);

    //     $sql = "UPDATE jadwal_tanding SET nilai_" . $sudut . " = nilai_" . $sudut . "-" . $value . " WHERE id_partai='" . $id_partai . "' ";
    //     $db->query($sql);

    //     $response = json_encode(array("status" => "success", "msg" => "Data Berhasil Dihapus"));
    // } else {
    //     $exec = mysqli_query($conn, "SELECT MAX(valid_id) FROM new_nilai_tanding WHERE partai='$partai' AND gelanggang='$gelanggang'");
    //     $max_id = mysqli_fetch_row($exec)[0];

    //     $sql = "INSERT INTO new_nilai_tanding VALUES ('', '$partai', '$gelanggang', '$babak',
    //             '$sudut', '$user', '$value', '$ket', 'valid','$max_id'+1, '$time')";
    //     $db->query($sql);

    //     $sql = "UPDATE jadwal_tanding SET nilai_" . $sudut . " = nilai_" . $sudut . "+" . $value . " WHERE id_partai='" . $id_partai . "' ";
    //     $db->query($sql);
        $response = json_encode(array("status" => "success", "msg" => "Data Berhasil Ditambah"));
    // }
    return $response;
}
