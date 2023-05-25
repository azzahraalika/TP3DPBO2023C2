<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Idol.php');
include('classes/Template.php');

$idol = new Idol($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$idol->open();
$idol->getIdol();

if (!isset($_GET['id_idol'])) {
    if (isset($_POST['submit'])) {
        if ($idol->addIdol($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'idol.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'idol.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Idol';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Profil</th>
<th scope="row">Nama Idol</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'idol';

while ($div = $idol->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td> 
        <img src="assets/images/' . $div['foto_idol'] . '" class="card-img-top" alt="' . $div['foto_idol'] . '">
    </td>
    <td>' . $div['nama_idol'] . '</td>
    
    <td style="font-size: 22px;">
        <a href="idol.php?id_idol=' . $div['id_idol'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="idol.php?hapus=' . $div['id_idol'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id_idol'])) {
    $id_idol = $_GET['id_idol'];
    if ($id_idol > 0) {
        if (isset($_POST['submit'])) {
            if ($idol->updateIdol($id_idol, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'idol.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'idol.php';
            </script>";
            }
        }

        $idol->getIdolById($id_idol);
        $row = $idol->getResult();
        $dataUpdate = $row['foto_idol'];
        $dataUpdate = $row['nama_idol'];
        
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id_idol = $_GET['hapus'];
    if ($id_idol > 0) {
        if ($idol->deleteIdol($id_idol) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'idol.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'idol.php';
            </script>";
        }
    }
}

$idol->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
