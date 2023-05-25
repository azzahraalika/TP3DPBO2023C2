<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Idol.php');
include('classes/Lagu.php');
//include('detail.php');
include('classes/Template.php');

// open db
$lagu = new Lagu($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$lagu->open();

$idol = new Idol($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$idol->open();

$agensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$agensi->open();

// call get method
$idol->getIdol();
$agensi->getAgensi();

// if user clicked submit btn
if (isset($_POST['btn-save'])) {
    if ($lagu->addLagu($_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'index.php';
        </script>";
    }
}

$title = 'Tambah';

// fetch all records from agensi
$dataAgensi = null;
while (list($id_agensi, $nama_agensi) = $agensi->getResult()) {

    // create input select option
    $dataAgensi .= "
        <option value='". $id_agensi ."'>". $nama_agensi ."</option>
    ";
}

// fetch all records from idol
$dataIdol = null;
while (list($id_idol, $nama_idol) = $idol->getResult()) {
    
    // create input select option
    $dataIdol .= "
        <option value='". $id_idol ."'>". $nama_idol ."</option>
    ";
}



// close db
$lagu->close();
$idol->close();
$agensi->close();

// apply to the template
$title = "Add Lagu";
$tpl = new Template("templates/tambah.html");
$tpl->replace("DATA_AGENSI", $dataAgensi);
$tpl->replace("DATA_IDOL", $dataIdol);
$tpl->replace("DATA_TITLE", $title);
$tpl->write();

?>
