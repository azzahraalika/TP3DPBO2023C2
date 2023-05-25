<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Idol.php');
include('classes/Lagu.php');
include('classes/Template.php');
$tpl = new Template("templates/tambah.html");
 $lagu = new Lagu($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $lagu->open();
    $lagu->getLagu();

    $idol = new Idol($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $idol->open();

    $agensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $agensi->open();

// if user clicked edit btn
if (isset($_GET['id'])) {
    // fetch the pk
    $id = $_GET['id'];
    if ($id > 0){
        $lagu->getLaguById($id); 
        $data = $lagu->getResult();
        $judul = $data['judul'];
        $nama_album = $data['nama_album'];
        $tahun_keluar = $data['tahun_keluar'];
        $deskripsi = $data['deskripsi'];
        $foto = $data['foto'];
        $tpl->replace('DATA_JUDUL', $judul);
        $tpl->replace('DATA_TAHUN', $tahun_keluar);
        $tpl->replace('DATA_ALBUM', $nama_album);
        $tpl->replace('DATA_DESKRIPSI', $deskripsi);
        $tpl->replace('DATA_FOTO', $foto);
        


    }
    if (isset($_POST['btn-save'])) {
        if($lagu->updateLagu($id, $_POST, $_FILES) > 0){
             echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
             } else {
            echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'index.php';
            </script>";
        }
        }
       
    }

    $idol->getIdol();
    $agensi->getAgensi();    // fetch all data from lagu
  
  
    $optionsidol = null;
while ($row = $idol->getResult()) {
    $optionsidol .= "<option value=" . $row['id_idol'] . " " . (($row['id_idol'] == $data['id_idol']) ? "selected" : " ") . ">" . $row['nama_idol'] . "</option>";
}

    $options = null;
while ($row = $agensi->getResult()) {
    $options .= "<option value=" . $row['id_agensi'] . " " . (($row['id_agensi'] == $data['id_agensi']) ? "selected" : " ") . ">" . $row['nama_agensi'] . "</option>";
}

$lagu->close();
$idol->close();
$agensi->close();

    // apply to the template
   
 
    $tpl->replace("DATA_AGENSI", $options);
    $tpl->replace("DATA_IDOL", $optionsidol);
    $title = "Edit Lagu";
    $tpl->replace("DATA_TITLE", $title);
   
    
    $tpl->write();


?>
