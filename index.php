<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Idol.php');
include('classes/Lagu.php');
include('classes/Template.php');

$listLagu = new Lagu($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listLagu->open();
$listLagu->getLaguJoin();

if (isset($_POST['btn-cari'])) {
    $listLagu->searchLagu($_POST['cari']);
} else {
    $listLagu->getLaguJoin();
}

$data = null;

while ($row = $listLagu->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 lagu-thumbnail">
        <a href="detail.php?id=' . $row['id_lagu'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['foto'] . '" class="card-img-top" alt="' . $row['foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text judul my-0">' . $row['judul'] . '</p>
                <p class="card-text agensi-nama">' . $row['nama_agensi'] . '</p>
                <p class="card-text idol-nama my-0">' . $row['nama_idol'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

$listLagu->close();
$home = new Template('templates/skin.html');
$home->replace('DATA_LAGU', $data);
$home->write();