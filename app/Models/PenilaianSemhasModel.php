<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PenilaianSemhasModel extends Model
{
    protected $table = 'simta_penilaian_seminarhasil';
    protected $primaryKey = 'id_penilaian';
    protected $allowedFields = ['id_penilaian', 'id_staf', 'id_mhs', 'nilai_total', 'created_at', 'updated_at', 'id_rilis_jadwal'];

    // Tambahkan metode sesuai kebutuhan


    public function withStaff()
    {
        return $this->join('users as staff', 'staff.id = simta_penilaian_seminarhasil.id_staf');
    }

    public function withMhs()
    {
        return $this->join('users as mhs', 'mhs.id = simta_penilaian_seminarhasil.id_mhs')
        ->join('mahasiswa', 'mhs.id=mahasiswa.id_user');
    }
    
    
    public function rilisJadwal()
    {
        return $this->join('simta_rilis_jadwal_semhas as jdw', 'jdw.id_rilis_jadwal_semhas = simta_penilaian_seminarhasil.id_rilis_jadwal')
        ->join('simta_pengajuan_seminarhasil', 'jdw.id_pengajuansemhas=simta_pengajuan_seminarhasil.id_seminarhasil')
        ->join('users as pembimbing', 'pembimbing.id = simta_pengajuan_seminarhasil.id_dospem')
        ->join('simta_acc_judul as judul', 'simta_pengajuan_seminarhasil.id_accjudul=judul.id_accjudul');
    }


    public function getKriteria($tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        return $this->select('simta_penilaian_seminarhasil.*,pembimbing.nama as dospem_nama, judul.judul_acc as judul_judul_acc, jdw.tgl_ujian as jadwal, mhs.nama as mhs_nama, staff.nama as staff_nama')
                    ->withStaff()
                    ->withMhs()
                    ->rilisJadwal()
                    ->where('mahasiswa.th_lulus', $tahun)
                    ->findAll();
    }

}