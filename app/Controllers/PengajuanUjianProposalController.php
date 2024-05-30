<?php

namespace App\Controllers;

use TCPDF;
use App\Libraries\CustomPDF;
use App\Models\JudulAccModel;
use App\Models\MahasiswaModel;
use App\Controllers\BaseController;
use App\Models\PengajuanJudulModel;
use App\Models\JadwalUjianPropoModel;
use App\Models\PengajuanUjianProposalModel;

class PengajuanUjianProposalController extends BaseController
{
    public function table()
    {
        $data = (new PengajuanUjianProposalModel())->getAllPengajuanWithJadwal();
        $getData = []; // Inisialisasi sebagai array kosong
        
        foreach ($data as $ujian) {
            if (session()->get('role') == 'Dosen') {
                // Jika rolenya adalah "Mahasiswa", maka hanya data yang sesuai dengan ID mahasiswa yang sedang login yang akan ditampilkan
                if ($ujian['id_dospem'] == session()->get('user_id')) {
                    $getData[] = $ujian; // Tambahkan ke array
                }
            } elseif (session()->get('role') == 'Mahasiswa') {
                if ($ujian['mahasiswa'] == session()->get('user_id')) {
                    $getData[] = $ujian; // Tambahkan ke array
                }
            }elseif (session()->get('role') == 'Koordinator') {
                // Jika rolenya adalah "Dosen", maka hanya data yang sesuai dengan ID staf yang sedang login yang akan ditampilkan
                    $getData[] = $ujian; // Tambahkan ke array
            }
        }
        // Cek apakah mahasiswa yang login sudah memiliki data pengajuan
        $mahasiswaId = session()->get('user_id');
        // dd($mahasiswaId);
        $mahasiswaSudahMengajukan = false;
        foreach ($data as $item) {
            if ($item['mahasiswa'] == $mahasiswaId && $item['status_pengajuan'] != 'DITOLAK') {
                $mahasiswaSudahMengajukan = true;
                break;
            }
        }
        $operation['data'] = $getData;
        $operation['mahasiswaSudahMengajukan'] = $mahasiswaSudahMengajukan;
        // dd($data);
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Daftar Pengajuan Ujian Proposal';
        return view("pengajuanujianproposal/index", $operation);
    }
    
    public function create()
    {
        // $id_mhs = session()->get('user_id');
        $judulAcc = new JudulAccModel();
        $dataJudul = $judulAcc->where('mhs.id',session()->get('user_id'))->getPengajuan();
        // dd($dataJudul);
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Buat Pengajuan Ujian Proposal Baru';
        $operation['pjudul'] = $dataJudul;
        // dd($operation['pjudul']);
        return view('pengajuanujianproposal/create', ['pjudul' => $operation['pjudul']]);
    }

    public function store()
    {
        $id_mhs = session()->get('user_id');

        // Ambil data post
        $data = $this->request->getPost();
        
        // Tambahkan id_mhs ke data
        $data['mahasiswa'] = $id_mhs;
        // $data['judul_acc_id'] = $this->request->getVar('judul_acc_id');

        $judulAcc = new JudulAccModel();
        $id_dospem = $judulAcc->where('id_accjudul', $this->request->getPost('judul_acc_id'))->get()->getRow()->dospem_acc;
        $data['id_dospem'] = $id_dospem;

        // Mengelola file upload
        $file = $this->request->getFile('proposal_ta');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getName();
            $file->move('public/assets/proposal/', $newName);
            $data['proposal_ta'] = $newName;
        }

        // Insert ke database
        $data['status'] = $this->request->getPost('status');
        // $data['judul_acc_id'] = $this->request->getPost('id_accjudul');

        // dd($data);
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->insert($data);

        return redirect()->to('pengajuanujianproposal');
    }



    public function edit($id)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $dataForm = $pengajuanUjianProposalModel->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Pengajuan Ujian Proposal';
        $operation['sub_title'] = 'Edit Pengajuan Ujian Proposal';
        return view('pengajuanujianproposal/create', $operation);
    }

    public function updateStatus($id = null)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $data = $this->request->getPost('status');
        // dd($data);
        $pengajuanUjianProposalModel->update($id, ['status_pengajuan' => $data]);
        // $model->update($id, ['status' => $status]);
        return redirect()->to('pengajuanujianproposal');
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->update($id, $data);
        return redirect()->to('pengajuanujianproposal');
    }

    public function uploadJadwal($proposalId)
    {
        $uploadedFile = $this->request->getFile('file');

        // Pastikan file berhasil diunggah
        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            // Pindahkan file yang diunggah ke folder yang diinginkan
            $newFileName = $uploadedFile->getName();
            $uploadedFile->move('public/assets/jadwalujian/', $newFileName);

            // Simpan detail file ke dalam database
            $proposalModel = new PengajuanUjianProposalModel();
            $proposalModel->update($proposalId, ['jadwal' => $newFileName]);

            // Kirim respon ke client
            return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah']);
        } else {
            // Jika file tidak valid atau bukan PDF, kirim respon dengan status error
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'File tidak valid atau bukan PDF']);
        }
    }

    public function uploadRevisi($proposalId)
    {
        $uploadedFile = $this->request->getFile('file');

        // Pastikan file berhasil diunggah
        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            // Pindahkan file yang diunggah ke folder yang diinginkan
            $newFileName = $uploadedFile->getName();
            $uploadedFile->move('public/assets/revisi_ujian/', $newFileName);

            // Simpan detail file ke dalam database
            $proposalModel = new PengajuanUjianProposalModel();
            $proposalModel->update($proposalId, [
                'revisi_proposal' => $newFileName,
                'revisi_proposal_date' => date('Y-m-d H:i:s')
            ]);

            // Kirim respon ke client
            return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah']);
        } else {
            // Jika file tidak valid atau bukan PDF, kirim respon dengan status error
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'File tidak valid atau bukan PDF']);
        }
    }


    public function delete($id)
    {
        $pengajuanUjianProposalModel = new PengajuanUjianProposalModel();
        $pengajuanUjianProposalModel->delete($id);
        return redirect()->to('pengajuanujianproposal');
    }
}
