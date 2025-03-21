<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>
<!--begin::Card-->
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <input type="text" data-kt-subscription-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Logbook" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
                <div class="my-1 me-4">
                    <form action="/jadwalbimbingan" method="get" class="d-flex align-items-center position-relative my-1 mt-3" id="myForm" role="form">
                        <select id="tahun_filter" name="tahun" class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="Select Tahun" data-hide-search="true">
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
                </div>
                <?php if(session()->get('role') == 'Dosen'): ?>
                    <a href="<?= base_url('jadwalbimbingan/create') ?>" class="btn btn-sm btn-primary my-4">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg>
                    </span>Tambah Jadwal Bimbingan</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if (!empty($data) && is_array($data)) : ?>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9" width="100%">
                    <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                        <tr>
                            <th width="10%">No</th>
                            <?php if(session()->get('role') == 'Koordinator'): ?>
                            <th width="10%" class="min-w-150px">Nama Dosen</th>
                            <?php endif; ?>
                            <th width="10%" class="min-w-150px ps-5">Tanggal Bimbingan</th>
                            <th width="10%" class="min-w-150px ps-5">Waktu Bimbingan</th>
                            <th width="10%" class="min-w-150px ps-5">Lokasi</th>
                            <th width="10%" class="min-w-150px ps-5"></th>
                        </tr>
                    </thead>
                    <tbody class="fw-6 fw-bold text-gray-600">
                    <?php $counter = 1; ?>
                        <?php foreach ($data as $vdata) : ?>
                            <tr>
                                <td class="ps-5"><?= $counter++; ?></td>
                                <?php if(session()->get('role') == 'Koordinator'): ?>
                            <th width="10%" class="min-w-150px"><?= $vdata['nama_dosen'] ?></th>
                            <?php endif; ?>
                                <td class="ps-5"><?= $vdata['tanggal'] ?></td>
                                <td class="ps-5"><?= $vdata['waktu'] ?></td>
                                <td class="ps-5"><?= $vdata['tempat'] ?></td>
                
                                <?php if(session()->get('role') == 'Dosen'): ?>
                                <td class="align-middle ps-5">
                                    <div class="d-flex justify-content-center">
                                    <a href="<?= base_url('jadwalbimbingan/edit/'.$vdata['id_jadwal_bimbingan']) ?>" class="btn btn-icon btn-light-primary btn-active-color-light btn-sm me-1" title="Edit Data">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <form action="<?= base_url('jadwalbimbingan/delete/'.$vdata['id_jadwal_bimbingan']) ?>" method="POST">
                                                <button type="submit" class="btn btn-icon btn-light-danger btn-active-color-light btn-sm" title="Hapus Data">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V7H5V5Z" fill="black" />
                                                            <path opacity="0.5" d="M9 3C9 2.44772 9.44772 2 10 2H14C14.5523 2 15 2.44772 15 3V5H9V3Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </form>
                                    </div> 
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else : ?>
        <div class="card-body pb-0">
            <div class="card-px text-center pt-20 pb-5">
                <h2 class="fs-2x fw-bolder mb-0">Jadwal Bimbingan</h2>
                <p class="text-gray-400 fs-4 fw-bold py-7"><?= session()->get('role') == 'Dosen' ? 'Klik tombol dibawah untuk menambahkan' : 'Belum ada data' ?>
                <br />Jadwal Bimbingan.</p>
                <?php if(session()->get('role') == 'Dosen'): ?>
                    <a href="<?= base_url('jadwalbimbingan/create') ?>" class="btn btn-primary er fs-6 px-8 py-4">Tambah Jadwal Bimbingan</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php foreach ($data as $vdata) : ?>
<div class="modal fade" id="detailJadwal<?= $vdata ['id_jadwal_bimbingan']; ?>" tabindex="-1" aria-hidden="true">
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
                <div class="text-center mb-13">
                    <h1 class="mb-3">Detail Jadwal Bimbingan</h1>
                </div>
                <div class="mb-15">
                    <div class="mh-375px scroll-y me-n7 pe-7">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td><?= $vdata['tanggal'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Waktu</th>
                                        <td><?= $vdata['waktu'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Lokasi</th>
                                        <td><?= $vdata['tempat'] ?></td>
                                    </tr>
                  
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<?= $this->endSection() ?>