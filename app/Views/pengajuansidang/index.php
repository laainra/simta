<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>
<div class="card card-flush pb-0 bgi-position-y-top bgi-no-repeat mb-10" style="background-size: auto calc(50% + 5rem); background-position-x: 100%; background-image: url('assets/media/illustrations/sketchy-1/4.png')">
    <!--begin::Card header-->
    <div class="card-header pt-10">
        <div class="d-flex align-items-center">
            <!--begin::Icon-->
            <div class="symbol symbol-circle me-5">
                <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs020.svg-->
                    <span class="svg-icon svg-icon-2x svg-icon-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M17.302 11.35L12.002 20.55H21.202C21.802 20.55 22.202 19.85 21.902 19.35L17.302 11.35Z" fill="black" />
                            <path opacity="0.3" d="M12.002 20.55H2.802C2.202 20.55 1.80202 19.85 2.10202 19.35L6.70203 11.45L12.002 20.55ZM11.302 3.45L6.70203 11.35H17.302L12.702 3.45C12.402 2.85 11.602 2.85 11.302 3.45Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
            </div>
            <!--end::Icon-->
            <!--begin::Title-->
            <div class="d-flex flex-column">
                <h2 class="mb-1">Sidang Tugas Akhir</h2>
                <!-- <div class="text-muted fw-bolder">
                <a href="#">Keenthemes</a>
                <span class="mx-3">|</span>
                <a href="#">File Manager</a>
                <span class="mx-3">|</span>2.6 GB
                <span class="mx-3">|</span>758 items</div> -->
            </div>
            <!--end::Title-->
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pb-0">
        <!--begin::Navs-->
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold flex-nowrap">
                <!--begin::Nav item-->
                <!-- <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('pengajuanbimbingan') ?>">Pengajuan Bimbingan</a>
                </li> -->
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 active" href="<?= base_url('pengajuansidang') ?>">Pengajuan Sidang Tugas Akhir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('rilisjadwalsidang') ?>">Jadwal Sidang Tugas Akhir</a>
                </li>
                <?php if(session()->get('role') == 'Dosen' || session()->get('role') == 'Koordinator' || session()->get('nama') == 'Masbahah '): ?>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('penilaiansidang') ?>">Penilaian Sidang Akhir</a>
                </li>
                <?php endif; ?>
                <?php if(session()->get('role') == 'Mahasiswa'): ?>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 active" href="<?= base_url('syaratkelulusan') ?>">Unggah Syarat Kelulusan</a>
                </li>
                <?php endif; ?>
                <!--end::Nav item-->
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
<!--begin::Card-->
<div class="card card-flush">
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-subscription-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Pengajuan Sidang" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
                    <!--begin::Filter-->
                    <div class="my-1 me-4">
                        <!--begin::Select-->
                        <form action="/pengajuansidang" method="get" class="d-flex align-items-center position-relative my-1 mt-3" id="myForm" role="form">
                            <select id="tahun_filter" name="tahun" class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="Select Tahun" data-hide-search="true">
                                <!-- <option value="1" selected="selected">1 Hours</option>
                                <option value="2">6 Hours</option>
                                <option value="3">12 Hours</option>
                                <option value="4">24 Hours</option> -->
                                <?php
                                    $thn_skr = date('Y');
                                    for ($x = $thn_skr; $x >= 2020; $x--) {
                                    ?>
                                    <option value="<?= $x; ?>" <?= ($x == $tahun) ? 'selected' : ''; ?>><?= $x; ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </form>
                        <!--end::Select-->
                    </div>
                    <!--end::Filter-->
                    <!--begin::Add subscription-->
                    <?php if (session()->get('role') == 'Mahasiswa' && !$mahasiswaSudahMengajukan): ?>
                        <a href="<?= base_url('pengajuansidang/create') ?>" class="btn btn-sm btn-primary my-4">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>Pengajuan</a>
                    <?php endif; ?>
                    <!--end::Add subscription-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-subscription-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-subscription-table-select="selected_count"></span>Selected</div>
                    <button type="button" class="btn btn-danger" data-kt-subscription-table-select="delete_selected">Delete Selected</button>
                </div>
                <!--end::Group actions-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Body-->
    <?php if (!empty($data) && is_array($data)) : ?>
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9" width="100%">
                    <!--begin::Thead-->
                    <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                        <tr>
                            <?php if(session()->get('role') != 'Mahasiswa'): ?>
                                <th width="23%" class="min-w-175px text-center">Mahasiswa</th>
                                <th width="25%" class="min-w-150px text-center">Judul TA</th>
                            <?php endif; ?>
                            <th width="25%" class="min-w-175px text-center">Abstrak</th>
                            <!-- <th width="22%" class="min-w-150px text-center">Revisi Laporan</th> -->
                            <th width="15%" class="min-w-150px text-center">Laporan Tugas Akhir</th>
                            <!-- <th width="22%" class="min-w-150px text-center">Transkrip Nilai</th> -->
                            <!-- <th width="22%" class="min-w-150px text-center">Berita Acara KMM</th> -->
                            <!-- <th width="22%" class="min-w-150px text-center">Surat Rekomendasi</th> -->
                            <!-- <th width="22%" class="min-w-150px text-center">KRS</th> -->
                            <th width="22%" class="min-w-150px text-center">Ajuan Tanggal Ujian</th>
                            <th width="23%"class="min-w-150px text-center">Status Pengajuan</th>
                            <th width="15%" class="min-w-150px text-center">#</th>
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody class="fw-6 fw-bold text-gray-600">
                        <?php foreach ($data as $vdata) : ?>
                            
                            <tr>
                                <?php if(session()->get('role') != 'Mahasiswa'): ?>
                                    <td>
                                        <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['nama_mhs'] ?></span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['judul'] ?></span>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['abstrak'] ?></span>
                                </td>
                                <?php if(session()->get('role') !== 'Mahasiswa'): ?>
                                    <!-- <td>
                                        <div>
                                            <a href="<?= base_url('public/assets/revisi_sidang/' . $vdata['revisi_laporan']) ?>" target="_blank">
                                                <?php if (!empty($vdata['revisi_laporan'])): ?>
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['revisi_laporan'] ?? '-'?></span>
                                                <?php else: ?>
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6">-</span>
                                                <?php endif; ?>
                                            </a>
                                            </div>
                                    </td> -->
                                    <td>
                                        <?php if (!empty($vdata['laporan_ta'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/proposal/' . $vdata['laporan_ta']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['laporan_ta'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                <?php else: ?>
                                        <td>
                                            <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['revisi_laporan'] ?? '-' ?></span>
                                        </td>
                                        <!-- <td>
                                            <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['laporan_ta'] ?></span>
                                        </td> -->
                                <?php endif; ?>
                                <!-- <td>
                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['transkrip_nilai'] ?></span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['beritaacara_kmm'] ?></span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['surat_rekomendasi'] ?></span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['krs'] ?></span>
                                </td> -->
                                <td>
                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['ajuan_tgl_ujian'] ?></span>
                                </td>
                                <td class="text-center">
                                    <?php if(session()->get('role') == 'Dosen'|| session()->get('role') == 'Koordinator'): ?>
                                        <?php if (!empty($vdata) && isset($vdata['status_pengajuan'])) : ?>
                                            <?php if ($vdata['status_pengajuan'] == 'PENDING') : ?>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-warning dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        PENDING
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-dark">
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <form class="alert-verifikasi" action="/update/status_up/sidang/<?= $vdata['id_sidang']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="DITERIMA" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITERIMA</button>
                                                                </form>
                                                            </a>
                                                        </li>
                                                        <!-- <li>
                                                            <a class="dropdown-item" href="#">
                                                                <form class="alert-verifikasi" action="/update/status_up/sidang/<?= $vdata['id_sidang']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="REVISI" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">REVISI</button>
                                                                </form>
                                                            </a>
                                                        </li> -->
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <form class="alert-verifikasi" action="/update/status_up/sidang/<?= $vdata['id_sidang']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="DITOLAK" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITOLAK</button>
                                                                </form>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php elseif ($vdata['status_pengajuan'] == 'REVISI') : ?>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-info dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        REVISI
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-dark">
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <form class="alert-verifikasi" action="/update/status_up/sidang/<?= $vdata['id_sidang']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="DITERIMA" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITERIMA</button>
                                                                </form>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <form class="alert-verifikasi" action="/update/status_up/sidang/<?= $vdata['id_sidang']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="DITOLAK" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITOLAK</button>
                                                                </form>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php elseif ($vdata['status_pengajuan'] == 'DITOLAK') : ?>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-danger dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    DITOLAK
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <form class="alert-verifikasi" action="/update/status_up/sidang/<?= $vdata['id_sidang']; ?>" method="POST">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" value="DITERIMA" name="status">
                                                                <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITERIMA</button>
                                                            </form>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <form class="alert-verifikasi" action="/update/status_up/sidang/<?= $vdata['id_sidang']; ?>" method="POST">
                                                                <?= csrf_field() ?>
                                                                <input type="hidden" value="REVISI" name="status">
                                                                <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">REVISI</button>
                                                            </form>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <?php elseif ($vdata['status_pengajuan'] == 'DITERIMA') : ?>
                                                <div class="badge badge-success"><?= $vdata['status_pengajuan'] ?></div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    <?php elseif(session()->get('role') == 'Mahasiswa' || session()->get('role') == 'Koordinator' ) : ?>
                                        <!-- Button code here -->
                                        <?php if (!empty($vdata) && isset($vdata['status_pengajuan'])) : ?>
                                            <?php if ($vdata['status_pengajuan'] == 'PENDING') : ?>
                                                <div class="badge badge-warning center"><?= $vdata['status_pengajuan'] ?></div>
                                            <?php elseif ($vdata['status_pengajuan'] == 'DITOLAK') : ?>
                                                <div class="badge badge-danger"><?= $vdata['status_pengajuan'] ?></div>
                                            <?php elseif ($vdata['status_pengajuan'] == 'DITERIMA') : ?>
                                                <div class="badge badge-success"><?= $vdata['status_pengajuan'] ?></div>
                                            <?php elseif ($vdata['status_pengajuan'] == 'REVISI') : ?>
                                                <div class="badge badge-info"><?= $vdata['status_pengajuan'] ?></div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        <?php if (empty($vdata['jadwal_id']) && (session()->get('role') == 'Koordinator' || session()->get('nama') == 'Masbahah '  )): ?>
                                            <a href="<?= base_url('pengajuansidang/create-jadwal/'. $vdata['id_sidang']) ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Buat Rilis Jadwal">
                                                <span class="svg-icon svg-icon-muted svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
                                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(session()->get('role') == 'Mahasiswa' && $vdata['status_pengajuan'] == 'REVISI'): ?>
                                            <button onclick="openFileUploaderLaporan(<?php echo $vdata['id_sidang']; ?>)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Upload Revisi">
                                                <span class="svg-icon svg-icon-muted svg-icon-3">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/>
                                                        <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM12 16.8C11 16.8 10.2 16.4 9.5 15.8C8.8 15.1 8.5 14.3 8.5 13.3C8.5 12.8 8.59999 12.3 8.79999 11.9L10 13.1V10.1C10 9.50001 9.6 9.10001 9 9.10001H6L7.29999 10.4C6.79999 11.3 6.5 12.2 6.5 13.3C6.5 14.8 7.10001 16.2 8.10001 17.2C9.10001 18.2 10.5 18.8 12 18.8C12.6 18.8 13 18.3 13 17.8C13 17.2 12.6 16.8 12 16.8ZM16.7 16.2C17.2 15.3 17.5 14.4 17.5 13.3C17.5 11.8 16.9 10.4 15.9 9.39999C14.9 8.39999 13.5 7.79999 12 7.79999C11.4 7.79999 11 8.19999 11 8.79999C11 9.39999 11.4 9.79999 12 9.79999C12.9 9.79999 13.8 10.2 14.5 10.8C15.2 11.5 15.5 12.3 15.5 13.3C15.5 13.8 15.4 14.3 15.2 14.7L14 13.5V16.5C14 17.1 14.4 17.5 15 17.5H18L16.7 16.2Z" fill="currentColor"/>
                                                        <path opacity="0.3" d="M12 16.8C11 16.8 10.2 16.4 9.5 15.8C8.8 15.1 8.5 14.3 8.5 13.3C8.5 12.8 8.59999 12.3 8.79999 11.9L7.29999 10.4C6.79999 11.3 6.5 12.2 6.5 13.3C6.5 14.8 7.10001 16.2 8.10001 17.2C9.10001 18.2 10.5 18.8 12 18.8C12.6 18.8 13 18.3 13 17.8C13 17.2 12.6 16.8 12 16.8Z" fill="currentColor"/>
                                                        <path opacity="0.3" d="M15.5 13.3C15.5 13.8 15.4 14.3 15.2 14.7L16.7 16.2C17.2 15.3 17.5 14.4 17.5 13.3C17.5 11.8 16.9 10.4 15.9 9.39999C14.9 8.39999 13.5 7.79999 12 7.79999C11.4 7.79999 11 8.19999 11 8.79999C11 9.39999 11.4 9.79999 12 9.79999C12.9 9.79999 13.8 10.2 14.5 10.8C15.1 11.5 15.5 12.4 15.5 13.3Z" fill="currentColor"/>
                                                    </svg>
                                                </span>
                                            </button>
                                        <?php endif; ?>
                                        
                                        <?php if ($vdata['revisi_laporan'] != null) : ?>
                                        <!-- Icon untuk unduh berkas -->
                                            <a href="<?= base_url('pengajuansidang/unduh-revisi/'. $vdata['id_sidang']) ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Unduh Revisi">
                                                <span class="svg-icon svg-icon-muted svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/>
                                                    <path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        <?php endif; ?>

                                        <a href="#" class="btn btn-icon btn-light-info btn-active-color-light btn-sm me-1" data-bs-toggle="modal" data-bs-target="#detailPengajuanSidang<?= $vdata['id_sidang'] ?>">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z" fill="black"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </td>
                                <!-- button -->
                                <!-- <td class="d-flex justify-content-center text-center">
                                    <a href="#" class="btn btn-icon btn-light-info btn-active-color-light btn-sm me-1" data-bs-toggle="modal" data-bs-target="#detailPengajuanSidang">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z" fill="black"/></svg>
                                        </span>
                                    </a>
                                    <form action="<?= base_url('pengajuansidang/delete/' . $vdata['id_sidang']) ?>" method="post">
                                        
                                        <button type="submit" class="btn btn-icon btn-light-danger btn-active-color-light btn-sm">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                </svg>
                                            </span>
                                        </button>
                                    </form>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <!--end::Tbody-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
    <?php else : ?>
        <div class="card-body pb-0">
            <!--begin::Heading-->
            <div class="card-px text-center pt-20 pb-5">
            <?php if(session()->get('role') == 'Mahasiswa'): ?>
                <!--begin::Title-->
                <h2 class="fs-2x fw-bolder mb-0">Ajukan Pengajuan Sidang</h2>
                <!--end::Title-->
                <!--begin::Description-->
                <p class="text-gray-400 fs-4 fw-bold py-7">Klik tombol dibawah untuk menambahkan
                <br />Pengajuan Sidang.</p>
                <!--end::Description-->
                <!--begin::Action-->
                <button id="tambahPengajuanButton" class="btn btn-primary my-4">
                    Tambah Pengajuan Sidang
                </button>
                <!--end::Action-->
                <?php else : ?>
                <h2 class="fs-2x fw-bolder mb-0">Belum Ada Pengajuan Sidang</h2>
                <?php endif; ?>
            </div>
            <!--end::Heading-->
            <!--begin::Illustration-->
            <div class="text-center px-5">
                <img src="<?= base_url('assets/media/illustrations/sketchy-1/17.png') ?>" alt="" class="mw-100 h-200px h-sm-325px" />
            </div>
            <!--end::Illustration-->
        </div>
    <?php endif; ?>
</div>

<?php foreach ($data as $vdata) : ?>
    <div class="modal fade" id="detailPengajuanSidang<?= $vdata['id_sidang'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="mb-3">Detail Pengajuan Sidang</h1>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Users-->
                    <div class="mb-15">
                        <!--begin::List-->
                        <div class="mh-375px scroll-y me-n7 pe-7">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-3 gs-2" width="100%">
                                    <tbody>
                                        <tr>
                                            <th width="40%" class="fs-6 fw-bolder">Laporan Tugas Akhir</th>
                                            <td width="60%">
                                                <a href="<?= base_url('public/assets/proposal/' . $vdata['laporan_ta']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['laporan_ta'] ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Transkrip Nilai</th>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['transkrip_nilai'] ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Berita Acara KMM</th>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['beritaacara_kmm'] ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Surat Rekomendasi</th>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['surat_rekomendasi'] ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">KRS</th>
                                            <td class="text-dark fs-6">
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['krs'] ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--end::Tbody-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::List-->
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
<?php endforeach; ?>

<script>
    function openFileUploaderLaporan(sidangID) {

        var fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'application/pdf'; // Set hanya menerima file PDF

        fileInput.onchange = function(e) {
            var file = e.target.files[0];
            
            if (!file || file.type !== 'application/pdf') {
                alert('Mohon pilih file PDF.');
                return;
            }

            var formData = new FormData();
            formData.append('file', file);

            var route = 'upload/revisi/sidang/' + sidangID;
            console.log('Upload route:', route); // Debugging log

            fetch(route, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengunggah file');
                }
                return response.text();
            })
            .then(data => {
                console.log('Respon dari server:', data);

                //Reload halaman setelah file berhasil diunggah
                location.reload();
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        };

        fileInput.click();
    }



</script>

<script>
    document.getElementById('tambahPengajuanButton').addEventListener('click', function() {
        // Fetch the approved count from a data attribute or a variable
        const approvedCount = <?= $approvedCount; ?>; // Assuming you pass this variable from the controller

        if (approvedCount < 9) {
            // Display a SweetAlert if the count is less than 9
            Swal.fire({
                icon: 'warning',
                title: 'Pengajuan Sidang Tidak Dapat Dilakukan',
                text: `Anda tidak dapat mengajukan sidang karena jumlah logbook hanya ${approvedCount} kali. Silakan isi logbook terlebih dahulu.`,
                confirmButtonText: 'OK',
            }).then(() => {
                // Redirect to the bimbingan page after the alert is closed
                window.location.href = '<?= base_url('logbook') ?>'; // Adjust the URL as necessary
            });
        } else {
            // Redirect to the pengajuan form if the count is 9 or more
            window.location.href = '<?= base_url('pengajuansidang/create') ?>'; // Adjust the URL as necessary
        }
    });
</script>
<?= $this->endSection() ?>

