<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Idol.php');
include('classes/Lagu.php');
//include('tambah.php');
include('classes/Template.php');

$lagu = new Lagu($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$lagu->open();

$data = nulL;

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($lagu->deleteLagu($id) > 0) {
            echo "
                <script>
                    alert('Data berhasil dihapus!');
                    document.location.href = 'index.php';
                </script>
				";
        } else {
            echo "
                <script>
                    alert('Data gagal dihapus!');
                    document.location.href = 'index.php';
                </script>
				";
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $lagu->getLaguById($id);
        $row = $lagu->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['judul'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto'] . '" class="img-thumbnail" alt="' . $row['foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Judul</td>
                                    <td>:</td>
                                    <td>' . $row['judul'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td>' . $row['tahun_keluar'] . '</td>
                                </tr>
                                <tr>
                                    <td>Album</td>
                                    <td>:</td>
                                    <td>' . $row['nama_album'] . '</td>
                                </tr>
                                <tr>
                                    <td>Agensi</td>
                                    <td>:</td>
                                    <td>' . $row['nama_agensi'] . '</td>
                                </tr>
                                <tr>
                                    <td>Idol</td>
                                    <td>:</td>
                                    <td>' . $row['nama_idol'] . '</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>:</td>
                                    <td>' . $row['deskripsi'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="update.php?id=' . $row['id_lagu'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['id_lagu'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$lagu->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_LAGU', $data);
$detail->write();
