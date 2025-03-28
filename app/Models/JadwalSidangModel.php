<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class JadwalSidangModel extends Model
{
    protected $table = 'simta_rilis_jadwal_sidang';
    protected $primaryKey = 'id_rilis_jadwal_sidang';
    protected $allowedFields = [
        'ruangan',
        'jam_start',
        'jam_end',
        'tgl_ujian',
        'id_penguji1',
        'id_penguji2',
        'id_penguji3',
        'id_pengajuansidang',
        'surat_undangan',
        'surat_tugas',
    ];

    public function getJadwal($tahun = null) 
    {
        $tahun = $tahun ?? date('Y');
        return $this->select('mahasiswa.id_user as id_user, mahasiswa.nama as nama_mhs, mahasiswa.nim as nim,  mahasiswa.prodi as prodi, u3.id as id_mhs, u1.nama as penguji1, u2.nama as penguji2, u4.nama as penguji3, simta_acc_judul.judul_acc as judul, simta_rilis_jadwal_sidang.*, simta_pengajuan_sidang.revisi_laporan as revisi_laporan, simta_pengajuan_sidang.status_laporan as status_laporan, simta_pengajuan_sidang.id_sidang as id_sidang')
            ->join('users as u1', 'simta_rilis_jadwal_sidang.id_penguji1=u1.id')
            ->join('users as u2', 'simta_rilis_jadwal_sidang.id_penguji2=u2.id')
            ->join('users as u4', 'simta_rilis_jadwal_sidang.id_penguji3=u4.id')
            ->join('simta_pengajuan_sidang', 'simta_rilis_jadwal_sidang.id_pengajuansidang=simta_pengajuan_sidang.id_sidang')
            ->join('users as u3', 'simta_pengajuan_sidang.id_mhs=u3.id')
            ->join('mahasiswa', 'u3.id=mahasiswa.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_sidang.id_accjudul=simta_acc_judul.id_accjudul')
            ->where('mahasiswa.th_lulus', $tahun)
            ->findAll();
    }

    public function getBeritaAcara($id) 
    {
        return $this->select('mahasiswa.nama as nama_mhs, mahasiswa.nim as nim,  mahasiswa.prodi as prodi, u3.id as id_mhs, u1.nama as penguji1, u2.nama as penguji2, u4.nama as penguji3, s1.nip as nip_penguji1, s2.nip as nip_penguji2, s4.nip as nip_penguji3, simta_acc_judul.judul_acc as judul, dosen.nama, simta_pengajuan_sidang.*, simta_rilis_jadwal_sidang.*,            
        GROUP_CONCAT(CASE WHEN simta_revisi_sidang.id_penguji = u1.id THEN simta_revisi_sidang.catatan_revisi END SEPARATOR " | ") as catatan_revisi_penguji1,
            GROUP_CONCAT(CASE WHEN simta_revisi_sidang.id_penguji = u2.id THEN simta_revisi_sidang.catatan_revisi END SEPARATOR " | ") as catatan_revisi_penguji2,,
            GROUP_CONCAT(CASE WHEN simta_revisi_sidang.id_penguji = u4.id THEN simta_revisi_sidang.catatan_revisi END SEPARATOR " | ") as catatan_revisi_penguji3')
            ->join('users as u1', 'simta_rilis_jadwal_sidang.id_penguji1=u1.id')
            ->join('users as u2', 'simta_rilis_jadwal_sidang.id_penguji2=u2.id')
            ->join('users as u4', 'simta_rilis_jadwal_sidang.id_penguji3=u4.id')
            ->join('simta_pengajuan_sidang', 'simta_rilis_jadwal_sidang.id_pengajuansidang=simta_pengajuan_sidang.id_sidang')
            ->join('users as u3', 'simta_pengajuan_sidang.id_mhs=u3.id')
            ->join('mahasiswa', 'u3.id=mahasiswa.id_user')
            ->join('staf as s1', 'u1.id=s1.id_user')
            ->join('staf as s2', 'u2.id=s2.id_user')
            ->join('staf as s4', 'u4.id=s4.id_user')
            ->join('simta_acc_judul', 'simta_pengajuan_sidang.id_accjudul=simta_acc_judul.id_accjudul')
            ->join('users as dosen', 'simta_acc_judul.dospem_acc=dosen.id')
            ->join('simta_revisi_sidang', 'simta_rilis_jadwal_sidang.id_rilis_jadwal_sidang=simta_revisi_sidang.id_rilis_jadwal_sidang', 'left') // Join with revisions table
            ->groupBy('simta_rilis_jadwal_sidang.id_rilis_jadwal_sidang')
            ->find($id);
    }
}
