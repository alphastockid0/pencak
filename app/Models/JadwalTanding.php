<?php


namespace App\Models;

use CodeIgniter\Model;

class JadwalTanding extends Model
{
    protected $table = 'jadwal_tanding';
    protected $primaryKey = 'id_partai';
    protected $allowedFields = [
        'id_partai', 
        'tgl', 
        'kelas', 
        'gelanggang', 
        'partai', 
        'nm_merah', 
        'kontingen_merah', 
        'nm_biru', 
        'kontingen_biru', 
        'status', 
        'pemenang', 
        'babak', 
        'medali', 
        'aktif', 
        'nilai_merah', 
        'nilai_biru', 
        'active_babak'
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
    public function aktifPartai($g)
    {
       return $this->where('aktif',1)->where('gelanggang', $g)->first();
    }

    public function updateNilai($g,$s,$val)
    {
        $d = $this->aktifPartai($g);
        $id = $d['id_partai'];
        $nilai = $d['nilai_'.$s];
        $data = [
            'nilai_'.$s => $nilai + $val
        ];

        return $this->updateData($id, $data);
    }
}
