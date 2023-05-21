<?php

namespace App\Models;

use CodeIgniter\Model;

class InputNilai extends Model
{
    protected $table = 'new_nilai_tanding';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'partai',
        'gelanggang',
        'babak',
        'sudut',
        'user',
        'value',
        'ket',
        'status',
        'valid_id',
        'time'
    ];

    public function getAll()
    {
        return $this->findAll();
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function create($data)
    {
        return $this->insert($data);
    }

    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteData($id)
    {
        return $this->delete($id);
    }

    public function validation($g, $b)
    {
        $data = $this->where('status IS NULL')->where('valid_id', 0)->where('gelanggang', $g)->where('babak', $b)->findAll();

        $result = [];

        foreach ($data as $item) {
            $ket = $item['ket'];
            $sudut = $item['sudut'];

            if (!isset($result[$ket])) {
                $result[$ket] = [];
            }

            if (!isset($result[$ket][$sudut])) {
                $result[$ket][$sudut] = [];
            }

            $result[$ket][$sudut][] = [
                'id' => $item['id'],
                'user' => $item['user'],
                'value' => $item['value'],
                'time' => $item['time'],
                'ket' => $item['ket'],
                'partai' => $item['partai'],
                'gelanggang' => $item['gelanggang'],
                'babak' => $item['babak'],
                'sudut' => $item['sudut']
            ];
        }

        return $result;
    }
    public function max_validId()
    {
        $query = $this->selectMax('valid_id')->get();
        $row = $query->getRow();

        if ($row) {
            return $row->valid_id;
        }

        return 0; // Nilai default jika tidak ada data atau kolom kosong
    }
}
