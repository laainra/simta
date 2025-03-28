<?php

namespace App\Controllers;

use TCPDF;
use App\Models\StafModel;
use App\Libraries\CustomPDF;
use App\Models\JudulAccModel;
use App\Models\MahasiswaModel;
use App\Models\JadwalSemhasModel;
use App\Models\JadwalSidangModel;
use App\Controllers\BaseController;
use App\Models\PengajuanJudulModel;
use App\Models\PengajuanSidangModel;
use App\Models\JadwalUjianPropoModel;
use App\Models\PengajuanSeminarHasilModel;

class JadwalSidangController extends BaseController
{
    public function table()
    {
        $model = new JadwalSidangModel();
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $data = $model->getJadwal($tahun);
        $getData = []; // Inisialisasi sebagai array kosong
        
        foreach ($data as $jadwal) {
            if (session()->get('role') == 'Dosen') {
                if ($jadwal['id_penguji1'] == session()->get('user_id')) {
                    $getData[] = $jadwal;
                }elseif ($jadwal['id_penguji2'] == session()->get('user_id')) {
                    $getData[] = $jadwal;
                }elseif ($jadwal['id_penguji3'] == session()->get('user_id')) {
                    $getData[] = $jadwal;
                }
            } elseif (session()->get('role') == 'Mahasiswa') {
                if ($jadwal['id_mhs'] == session()->get('user_id')) {
                    $getData[] = $jadwal;
                }
            }else {
                $getData[] = $jadwal;
            }
        }
        $operation['data'] = $getData;
        $operation['tahun'] = $tahun;
        $operation['title'] = 'Rilis Jadwal Sidang TA';
        $operation['sub_title'] = 'Daftar Jadwal Sidang TA';
        // dd($operation['data']);
        return view("rilisjadwalsidang/index", $operation);
    }

    public function store()
    {
        $data = $this->request->getPost();
        // dd($data);
        $jadwalModel = new JadwalSidangModel();
        $jadwalModel->save($data);
        return redirect()->to('rilisjadwalsidang');
    }


    public function edit($id)
    {
        $jadwalModel = new JadwalSidangModel();
        $dataForm = $jadwalModel->find($id);
        $operation['dataForm'] = $dataForm;
        $operation['title'] = 'Rilis Jadwal Sidang TA';
        $operation['sub_title'] = 'Edit Jadwal Sidang TA';
        $operation['dosen'] = (new StafModel())->asArray()->findAll();
        return view('rilisjadwalsidang/edit', $operation);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $jadwalModel = new JadwalSidangModel();
        $jadwalModel->update($id, $data);
        return redirect()->to('rilisjadwalsidang');
    }

    public function delete($id)
    {
        $jadwalModel = new JadwalSidangModel();
        $jadwalModel->delete($id);
        return redirect()->to('rilisjadwalsidang');
    }

    public function uploadSuratUndangan($jadwalSidangId)
    {
        $uploadedFile = $this->request->getFile('file');

        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            $namaFile = date('Ymdhis') . '_' . $uploadedFile->getName();
            $uploadedFile->move('public/assets/surat-undangan/', $namaFile);

            $suratUndanganModel = new JadwalSidangModel();
            $suratUndanganModel->update($jadwalSidangId, ['surat_undangan' => $namaFile]);

            return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'File tidak valid atau bukan PDF']);
        }
    }

    public function uploadSuratTugas($jadwalSidangId)
    {
        $uploadedFile = $this->request->getFile('file');

        if ($uploadedFile->isValid() && $uploadedFile->getClientMimeType() === 'application/pdf') {
            $namaFile = date('Ymdhis') . '_' . $uploadedFile->getName();
            $uploadedFile->move('public/assets/surat-tugas/', $namaFile);

            $suratTugasModel = new JadwalSidangModel();
            $suratTugasModel->update($jadwalSidangId, ['surat_tugas' => $namaFile]);

            return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'File tidak valid atau bukan PDF']);
        }
    }

    public function beritaacara($id)
    {
        helper('my_date_helper');

        $imagePath = FCPATH . 'assets/img/logo-uns.jpg';
        $jadwal = (new JadwalSidangModel())->getBeritaAcara($id);
        $indonesian_date = convert_datetime_to_indonesian($jadwal['tgl_ujian']);

        $data = [
            'imagePath' => $imagePath,
            'day' => $indonesian_date['day'],
            'date' => $indonesian_date['date'],
            'month' => $indonesian_date['month'],
            'year' => $indonesian_date['year'],
            'jadwal' => $jadwal,
            'tahapUjian' => 'Sidang'
        ];
        // dd($data);

        $html = view('rilisjadwal/berita-acara', $data);
        $html2 = view('rilisjadwal/lembar-revisi-1', $data);
        $html3 = view('rilisjadwal/lembar-revisi-2', $data);
        $html4 = view('rilisjadwal/lembar-revisi-3', $data);

        $pdf = new CustomPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'F4', true, 'UTF-8', false);
        // Setel margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(false);

        // Tambahkan halaman baru
        $pdf->AddPage();
        $pdf->Ln(25);
        $pdf->SetFont('times', '', 12);
        // Tulis konten HTML
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->AddPage();
        $pdf->Ln(25);
        $pdf->SetFont('times', '', 12);
        $pdf->writeHTML($html2, true, false, true, false, '');

        $pdf->AddPage();
        $pdf->Ln(25);
        $pdf->SetFont('times', '', 12);
        $pdf->writeHTML($html3, true, false, true, false, '');

        $pdf->AddPage();
        $pdf->Ln(25);
        $pdf->SetFont('times', '', 12);
        $pdf->writeHTML($html4, true, false, true, false, '');

        // Atur response untuk menampilkan PDF
        $this->response->setContentType('application/pdf');
        $pdf->Output('berita-acara.pdf', 'I');
    }
}
