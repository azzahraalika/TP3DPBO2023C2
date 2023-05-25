<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Template.php');

$agensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$agensi->open();
$agensi->getAgensi();

if (!isset($_GET['id_agensi'])) {
    if (isset($_POST['submit'])) {
        if ($agensi->addAgensi($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'agensi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'agensi.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Agensi';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Profil</th>
<th scope="row">Nama Agensi</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'agensi';

while ($div = $agensi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td> 
        <img src="assets/images/' . $div['foto_agensi'] . '" class="card-img-top" alt="' . $div['foto_agensi'] . '">
    </td>
    <td>' . $div['nama_agensi'] . '</td>
    <td style="font-size: 22px;">
        <a href="agensi.php?id_agensi=' . $div['id_agensi'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="agensi.php?hapus=' . $div['id_agensi'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}


if (isset($_GET['id_agensi'])) {
    $id_agensi = $_GET['id_agensi'];
    if ($id_agensi > 0) {
        if (isset($_POST['submit'])) {
            if ($agensi->updateAgensi($id_agensi, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'agensi.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'agensi.php';
            </script>";
            }
        }

        $agensi->getAgensiById($id_agensi);
        $row = $agensi->getResult();
        $dataUpdate = $row['foto_agensi'];
        $dataUpdate = $row['nama_agensi'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id_agensi = $_GET['hapus'];
    if ($id_agensi > 0) {
        if ($agensi->deleteAgensi($id_agensi) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'agensi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'agensi.php';
            </script>";
        }
    }
}

$agensi->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();

